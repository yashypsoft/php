<?php

require_once 'Adapter.php';

class Row
{

    protected $tableName = NULL;
    protected $primaryKey = NULL;
    protected $rowChanged = NULL;
    protected $data = [];
    protected $adapter = NULL;

    function __construct()
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

    public function setRowChanged($rowChanged)
    {
        $this->rowChanged = $rowChanged;
        return $this;
    }

    public function getRowChanged()
    {
        return $this->rowChanged;
    }

    function __set($key, $value)
    {
        $this->setData([$key => $value]);
        return $this;
    }

    function __get($key)
    {
        if ($this->getData($key)) {
            return $this->getData($key);
        }
        return null;
    }

    public function setData($data)

    {
        if (!is_array($data)) {
            throw new Exception("Data Must Be Array");
        }
        $this->data = array_merge($this->data, $data);
        // $this->data = $data;
        $this->setRowChanged(true);
        return $this;
    }

    public function getData($key = null)
    {
        if ($key != "") {
            return isset($this->data[$key]) ? $this->data[$key] : NULL;
        }
        return $this->data;
    }

    public function unsetData($key = null)
    {
        if ($key == null) {
            $this->data = [];
            $this->setRowChanged(false);
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
        if (!$this->getRowChanged()) {
            return null;
        }

        $this->unsetData($this->getPrimaryKey());

        $column = implode("`,`", array_keys($this->getData()));
        $value = implode("','", array_values($this->getData()));
        $query = "INSERT INTO `" . $this->getTableName() . "` 
                (`$column`) VALUES ('$value') ";

        if ($id = $this->getAdapter()->insert($query)) {
            $this->load($id);
            return $id;
        }
        return null;
    }

    public function update()
    {
        if (!$this->getRowChanged()) {
            return false;
        }

        $id = $this->getData($this->getPrimaryKey());
        $this->unsetData($this->getPrimaryKey());

        $columnAndValue = "";
        $data = $this->getData();
        foreach ($data as $key => $value) {
            $columnAndValue .= "`$key` = '$value' ,";
        }
        $columnAndValue = chop($columnAndValue, ',');

        $query = "UPDATE `" . $this->getTableName() . "` SET $columnAndValue 
            WHERE `" . $this->getPrimaryKey() . "` = $id ";

        if ($this->getAdapter()->update($query)) {
            $this->load($id);
            return true;
        }
        return false;
    }

    public function delete()
    {
        if (!$this->getRowChanged()) {
            return false;
        }
        $id = $this->getData($this->getPrimaryKey());
        $query = "DELETE FROM `" . $this->getTableName() . "`
             WHERE `" . $this->getPrimaryKey() . "` = $id";

        return $this->getAdapter()->delete($query);
    }

    public function load($id)
    {
        $query = "SELECT * FROM `" . $this->getTableName() . "` WHERE
             `" . $this->getPrimaryKey() . "` = $id";

        $data = $this->getAdapter()->fetchRow($query);
        $this->unsetData();
        $this->setData($data);
        $this->setRowChanged(false);
        return $this;
    }

    public function fetchRow($query)
    {
        $data = $this->getAdapter()->fetchRow($query);
        $this->setData($data);
        $this->setRowChanged(false);
        return $this;
    }

    public function fetchAll($query)
    {
        $data = $this->getAdapter()->fetchAll($query);
        $fetchArray = [];
        for ($i = 0; $i < sizeof($data); $i++) {
            $row = new Row();
            if($row->setData($data[$i])){
                $row->setRowChanged(false);
                $fetchArray[] = $row;
            }
        }
        $this->setRowChanged(false);
        return $fetchArray;
    }
}
echo "<pre>";

$row = new Row();
print_r($row);
// $row->setRowChanged(false);
$row->product_name = "Title 5";
$row->sku = 1;
$row->url_key = "gjhbkj";
$row->status = "fhgjhkjl";
$row->description = "edefrgg";
$row->id = 41;

$row->setTableName('products');
$row->setPrimaryKey('id');

// var_dump($row->delete());
// var_dump($row->insert());
// $row->load(11);
// $row->update();
// print_r($row->fetchRow("SELECT * FROM products WHERE id = 13"));
print_r($row->fetchAll("SELECT * FROM products"));


print_r($row);
