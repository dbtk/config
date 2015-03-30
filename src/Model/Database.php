<?php

namespace DbTk\Config\Model;

use RuntimeException;

class Database
{
    private $id;
    private $cluster;
    private $connections = array();
    
    
    public function __construct($id)
    {
        $this->id = $id;
    }
    
    public function setCluster(Cluster $cluster)
    {
        $this->cluster = $cluster;
    }
    
    public function getConnectionByClassname($classname)
    {
        $connections = $this->getConnections();
        // TODO: Filter by classname
        return $this->connections;
    }
    
    public function getConnections()
    {
        if (count($this->connections)>0) {
            return $this->connections;
        }
        return $this->cluster->getConnections();
    }

    public function getConnection($classname = null)
    {
        $connections = $this->getConnections();
        print_r($connections);
        if (count($connections)!=1) {
            //print_r($connections);
            throw new RuntimeException("Multiple available connections, can't choose");
        }
        return array_shift($connections);
    }
    
    public function addConnection(Connection $connection)
    {
        $this->connections[$connection->getId()] = $connection;
    }

}
