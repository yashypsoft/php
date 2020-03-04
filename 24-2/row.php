<?php
require_once 'Adapter.php';
class Row
{
    protected $tableName = null;
    protected $primaryKey = null;
    protected $data = null;
    protected $rowChanged = null;


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

    public function setData($data)
    {
        $this->data = $data;
        $this->setRowChanged(true);
        return $this;
    }

    public function getData($key = null)
    {
        if ($key != "") {
            return isset($this->data[$key])?$this->data[$key]:NULL;
        }
        return $this->data;
    }

    public function unsetData($key = null)
    {
        if ($key != null) {
            unset($this->data[$key]);
            return true;
        }
        $this->data = [];
        return true;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
        $this->setRowChanged(true);
        return $this;
    }

    public function __get($key)
    {
        if ($this->getData($key)) {
            return $this->getData($key);
        }
        return null;
    }

    public function insert()
    {
        if (!$this->getRowChanged()) {
            return null;
        }

        $this->unsetData($this->getPrimaryKey());
        $data = $this->getData();
        $tableName = $this->getTableName();
        $column = implode(',', array_keys($data));
        $value = implode("','", array_values($data));

        $query = "INSERT INTO `$tableName` ($column) VALUES ('$value')";

        $adapter = new Adapter();
        $id = $adapter->insert($query);
        $this->unsetData();
        $this->load($id);
        return $id;
    }

    public function update()
    {
        if (!$this->getRowChanged()) {
            return false;
        }
        $id = $this->getData($this->primaryKey);
        $primaryKey = $this->getPrimaryKey();
        $this->unsetData($primaryKey);
        $tableName = $this->getTableName();
        $data = $this->getData();
        $columnAndValue = "";
        foreach ($data as $key => $value) {
            $columnAndValue .= " `$key` = '$value',";
        }
        $columnAndValue = chop($columnAndValue, ',');

        $query = "UPDATE `$tableName` SET  $columnAndValue WHERE `$primaryKey` = $id";
        $adapter = new Adapter();
        return $adapter->update($query);
    }

    public function delete()
    {
        $primaryKey = $this->getPrimaryKey();
        $tableName = $this->getTableName();
        $id = $this->getData($this->primaryKey);


        $query = "DELETE FROM `$tableName` WHERE $primaryKey = $id";
        $adapter = new Adapter();
        return $adapter->delete($query);
    }

    public function load($id)
    {
        $primaryKey = $this->getPrimaryKey();
        $tableName = $this->getTableName();
        $query = "SELECT * FROM `$tableName` WHERE `$primaryKey` = $id ";
        $adapter = new Adapter();
        $data = $adapter->fetchRow($query);
        $this->unsetData();
        $this->setData($data);
        return $this;
    }

    public function fetchRow()
    {
        $primaryKey = $this->getPrimaryKey();
        $tableName = $this->getTableName();
        $id = $this->getData($this->primaryKey);

        $query = "SELECT * FROM `$tableName` WHERE `$primaryKey` = $id ";
        $adapter = new Adapter();
        return $adapter->fetchRow($query);
    }
}

echo "<pre>";

$row = new Row();
print_r($row);
// $row->setRowChanged(false);
$row->product_name = "Title 3";
$row->sku = 1;
$row->url_key = "gjhbkj";
$row->status = "fhgjhkjl";
$row->description = "edefrgg";
$row->id = 18;  

$row->setTableName('products');
$row->setPrimaryKey('id');

// var_dump($row->delete() );
// var_dump($row->insert());
// $row->load(11);
// $row->update();
// print_r($row->fetchRow());

print_r($row);
