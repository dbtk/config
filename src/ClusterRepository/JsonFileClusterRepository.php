<?php

namespace DbTk\Config\ClusterRepository;

use DbTk\Config\Model\Cluster;
use DbTk\Config\Model\Server;
use DbTk\Config\Model\Account;
use DbTk\Config\Model\Connection;

class JsonFileClusterRepository
{
    private $basepath;
    
    public function __construct($basepath)
    {
        $this->basepath = $basepath;
    }
    
    public function getById($id)
    {
        $cluster = new Cluster($id);
        $filename = $this->basepath . $id . '.json';
        if (!file_exists($filename)) {
            throw new RuntimeException("Cluster config jsonfile not found: " . $filename);
        }
        $json = file_get_contents($filename);
        $data = json_decode($json, true);
        
        $cluster->setComment($data['comment']);
        foreach ($data['servers'] as $serverdata) {
            $serverid = $serverdata['id'];
            $server = new Server($serverid);
            $server->setAddress($serverdata['address']);
            $server->setPort($serverdata['port']);
            
            $cluster->addServer($server);
        }

        foreach ($data['accounts'] as $accountdata) {
            $accountid = $accountdata['id'];
            $account = new Account($accountid);
            $account->setUsername($accountdata['username']);
            $account->setPassword($accountdata['password']);
            
            $cluster->addAccount($account);
        }

        foreach ($data['connections'] as $connectiondata) {
            $connectionid = $connectiondata['id'];
            $connection = new Connection($connectionid);
            
            $server = $cluster->getServerById($connectiondata['server']);
            $connection->setServer($server);

            $account = $cluster->getAccountById($connectiondata['account']);
            $connection->setAccount($account);
            
            $cluster->addConnection($connection);
        }


        return $cluster;
    }
}
