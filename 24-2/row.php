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
        return $this;
    }

    public function getData($key = null)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        return $this->data;
    }

    public function unsetData($key = null)
    {
        if ($key) {
            unset($this->data[$key]);
            return true;
        }
        $this->data = [];
        return true;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function __get($key)
    {
        return $this->data[$key];
    }

    public function insert()
    {
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

    public function update($id)
    {
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

    public function delete($id)
    {
        $primaryKey = $this->getPrimaryKey();
        $tableName = $this->getTableName();

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
}

echo "<pre>";

$row = new Row();
print_r($row);

$row->product_name = "Title 2";
$row->sku = 1;
$row->url_key = "gjhbkj";
$row->status = "fhgjhkjl";
$row->description = "edefrgg";

$row->setTableName('products');
$row->setPrimaryKey('id');
// var_dump($row->delete(338));
// $row->insert();
$row->load(11);
// $row->update(28);

print_r($row);
