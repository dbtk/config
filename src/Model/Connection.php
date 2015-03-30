<?php

namespace DbTk\Config\Model;

class Connection
{
    use ConfigTrait;

    private $id;
    private $account;
    private $server;
    
    public function __construct($id)
    {
        $this->id = $id;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getAccount()
    {
        return $this->account;
    }
    
    public function setAccount($account)
    {
        $this->account = $account;
    }
    
    public function getServer()
    {
        return $this->server;
    }
    
    public function setServer($server)
    {
        $this->server = $server;
    }
    
    
}
