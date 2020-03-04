<?php

class Adapter
{
    protected $config = [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'testDb'
    ];
    protected $conn;
    protected $query;

    public function setConfig($config)
    {
        if (is_array($config)) {
            $this->config = array_merge($this->config, $config);
            return $this;
        }
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function connect()
    {
        $config = $this->getConfig();
        $conn = new mysqli(
            $config['host'],
            $config['username'],
            $config['password'],
            $config['dbname']
        );
        $this->setConnect($conn);
    }

    public function setConnect($conn)
    {
        $this->conn = $conn;
        return $this;
    }

    public function getConnect()
    {
        return $this->conn;
    }

    public function isConnect()
    {
        if (!$this->getConnect()) {
            return false;
        }
        return true;
    }

    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function query($query)
    {
        if (!$this->isConnect()) {
            $this->connect();
        }
        $conn = $this->getConnect();
        $this->setQuery($query);
        return $conn->query($this->getQuery());
    }

    public function insert($query)
    {
        $result = $this->query($query);
        if ($result) {
            return $this->getConnect()->insert_id;
        }
        return null;
    }

    public function update($query)
    {
        $result = $this->query($query);
        if ($result) {
            return true;
        }
        return false;
    }

    public function delete($query)
    {
        $result = $this->query($query);
        if ($result) {
            return true;
        }
        return false;
    }

    public function fetchAll($query)
    {
        $this->setQuery($query);
        $result = $this->query($this->getQuery());

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function fetchRow($query)
    {
        $this->setQuery($query);
        $result = $this->query($this->getQuery());

        return $result->fetch_assoc();
    }

    public function fetchOne($query)
    {
        $this->setQuery($query);
        $result = $this->query($this->getQuery());

        return $result->fetch_row()[0];
    }

    public function fetchPairs($query)
    {
        $this->setQuery($query);
        $result = $this->query($this->getQuery());
        $resultArray = [];
        if ($result->num_rows == 0) {
            return null;
        }
        while ($temp = $result->fetch_row()) {
            $resultArray[$temp[0]] = $temp[1];
        }
        return $resultArray;
    }
}

echo "<pre>";

$adapter = new Adapter();
print_r($adapter);

$config = [
    'host' => 'localhost',
    'User' => 'root',
    'password' => '',
    'dbname' => 'testDB'
];

// $adapter->setConfig($config)->connect();
// var_dump($adapter->setConfig($config)->isConnect());

// echo $adapter->insert("INSERT INTO `posts` (`title`) VALUES ('hello')" );
// $adapter->update("UPDATE `posts` SET `title` = 'h' WHERE `id` = 330");
print_r($adapter->delete("DELETE FROM `posts` WHERE `id` = 330"));
// print_r($adapter->fetchOne("SELECT count(title) FROM  posts"));
// print_r($adapter->fetchRow("SELECT * FROM  posts"));
// print_r($adapter->fetchAll("SELECT * FROM  posts"));
// print_r($adapter->fetchPairs("SELECT title,content FROM  posts"));


print_r($adapter);
