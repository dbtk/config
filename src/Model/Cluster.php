<?php

namespace DbTk\Config\Model;

class Cluster
{
    use ConfigTrait;
    
    private $id;
    private $comment;
    private $connections = array();
    private $accounts = array();
    private $servers = array();
    
    public function getComment()
    {
        return $this->comment;
    }
    
    public function setComment($comment)
    {
        $this->comment = $comment;
    }
    
    public function addServer(Server $server)
    {
        $this->servers[$server->getId()] = $server;
    }
    
    public function getServerById($id)
    {
        return $this->servers[$id];
    }
    
    public function addAccount(Account $account)
    {
        $this->accounts[$account->getId()] = $account;
    }

    public function getAccountById($id)
    {
        return $this->accounts[$id];
    }
    
    public function addConnection(Connection $connection)
    {
        $this->connections[$connection->getId()] = $connection;
    }
    
    public function getConnections()
    {
        return $this->connections;
    }
}
