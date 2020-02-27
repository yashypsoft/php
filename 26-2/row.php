<?php

require_once "Adapter.php";

class Row
{

    protected $tableName = NULL;
    protected $primaryKey = NULL;
    protected $rowsChanged = NULL;
    protected $data = [];
    protected $adapter = NULL;

    public function __construct()
    {
        $this->setAdapter();
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function setRowsChanged($rowsChanged)
    {
        $this->rowsChanged = $rowsChanged;
        return $this;
    }

    public function getRowsChanged()
    {
        return $this->rowsChanged;
    }

    public function setData($data)
    {
        if (!is_array($data)) {
            throw new Exception("Data must be array");
        }
        $this->data = array_merge($this->data, $data);
        $this->setRowsChanged(true);
        return $this;
    }

    public function getData($key = NULL)
    {
        if ($key == NULL) {
            return $this->data;
        }
        return isset($this->data[$key]) ? $this->data[$key] : NULL;
    }

    public function __set($key, $value)
    {
        return $this->setData([$key => $value]);
    }

    public function __get($key)
    {
        return $this->getData($key);
    }

    public function unsetData($key = NULL)
    {
        if ($key == NULL) {
            $this->data = [];
            $this->setRowsChanged(false);
            return true;
        }
        unset($this->data[$key]);
        return true;
    }

    public function setAdapter($adapter = NULL)
    {
        if ($adapter == NULL) {
            $this->adapter = new Adapter();
            return $this;
        }
        $this->adapter = $adapter;
        return $this;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function insert()
    {
        if (!$this->getRowsChanged()) {
            return null;
        }
        $this->unsetData($this->getPrimaryKey());


        $column = implode("`,`", array_keys($this->getData()));
        $value = implode("','", array_map(
            function ($colValue) {
                $this->getAdapter()->connect();
                return $this->getAdapter()->getConnect()->real_escape_string($colValue);
            },
            array_values($this->getData())
        ));

        $query = "INSERT INTO `{$this->getTableName()}` (`{$column}`) VALUES ('{$value}') ";

        if ($id = $this->getAdapter()->insert($query)) {
            $this->load($id);
            return $id;
        }
        return null;
    }

    public function load($id)
    {
        $id = (int) $id;
        $query = "SELECT * 
        FROM `{$this->getTableName()}` 
        WHERE `{$this->getPrimaryKey()}` = '$id'";
        $this->fetchRow($query);
    }

    public function update()
    {
        if (!$this->getRowsChanged()) {
            return false;
        }
        $id = (int) $this->getData($this->getPrimaryKey());
        $this->unsetData($this->getPrimaryKey());

        $columnAndValue = "";
        $data = $this->getData();
        $data = array_map('addslashes', $data);

        foreach ($data as $column => $value) {
            $columnAndValue .= "`{$column}` = '{$value}',";
        }

        $columnAndValue = chop($columnAndValue, ',');
        $query = "UPDATE `{$this->getTableName()}`
            SET $columnAndValue 
            WHERE `{$this->getPrimaryKey()}` = '$id'";

        if ($this->getAdapter()->update($query)) {
            $this->load($id);
            return true;
        }
        return false;
    }

    public function delete()
    {
        if (!$this->getRowsChanged()) {
            return false;
        }
        $id = (int) $this->getData($this->getPrimaryKey());

        $query = "DELETE FROM `{$this->getTableName()}` 
            WHERE `{$this->getPrimaryKey()}` = '$id'";

        if ($this->getAdapter()->delete($query)) {
            $this->unsetData();
            return true;
        }
        return false;
    }


    public function fetchRow($query)
    {
        $row = $this->getAdapter()->fetchRow($query);
        if ($row == NULL) {
            return NULL;
        }
        $this->unsetData();
        $this->setData($row);
        $this->setRowsChanged(false);
        return $this;
    }

    public function fetchAll()
    {
        $query = "SELECT * FROM `{$this->getTableName()}`";
        $rows = $this->getAdapter()->fetchAll($query);

        if ($rows == NULL) {
            return NULL;
        }
        foreach ($rows as $key => &$row) {
            $row = (new Row())->setData($row);
        }
        $this->setData($rows);
        $this->setRowsChanged(false);
        return $rows;
    }
}


echo "<pre>";

$row = new Row();

// print_r($row);
$row->product_name = "Product' 3";
$row->id = 41;
$row->setPrimaryKey('id');
$row->setTableName('products');

$row->insert();
// $row->update();

// print_r($row->getAdapter()->connect());
// print_r($row->getAdapter()->getConnect()->real_escape_string("Product' 2"));

// $row->load(11);
// $row->delete();
// $collection = $row->fetchAll();
// $collection = $row->fetchRow("SELECT * FROM products WHERE id = 11");

// print_r($collection);
print_r($row);
