<?php

class Adapter
{

    protected $config = [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'testDB'
    ];
    protected $conn;

    public function setConfig($config)
    {
        $this->config = array_merge($this->config, $config);
        return $this;
    }

    public function getConfig()
    {
        return $this->config;
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

    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function connect()
    {
        $config = $this->getConfig();
        $this->conn = new mysqli(
            $config['host'],
            $config['username'],
            $config['password'],
            $config['dbname']
        );
        return $this->setConnect($this->conn);
    }

    public function isConnect()
    {
        if (!$this->connect()) {
            return false;
        }
        return false;
    }

    public function query($query)
    {
        if (!$this->isConnect()) {
            $this->connect();
        }
        $conn = $this->getConnect();
        $this->setQuery($query);
        return  $conn->query($this->getQuery());
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
        $keyArray = [];
        $valueArray = [];
        foreach ($result->fetch_all() as $key => $array) {
            foreach ($array as $key => $value) {
                if ($key == 0) {
                    $keyArray[] = $value;
                } else if ($key == 1) {
                    $valueArray[] = $value;
                }
            }
        }
        return array_combine($keyArray, $valueArray);
    }
}

// echo "<pre>";

// $adapter = new Adapter();
// print_r($adapter);

// $config = [
//     'host' => 'localhost',
//     'username' => 'root',
//     'password' => '',
//     'dbname' => 'testDB'
// ];

// $adapter->setConfig($config)->connect();
// // $adapter->insert("INSERT INTO `posts` (`title`) VALUES ('hello')" );
// // $adapter->update("UPDATE `posts` SET `title` = 'h' WHERE `id` = 43");

// print_r($adapter->fetchPairs("SELECT title,content FROM  posts"));

// print_r($adapter);
