<?php

namespace DbTk\Config\DatabaseRepository;

use DbTk\Config\Model\Database;
use DbTk\Config\Model\Cluster;
use DbTk\Config\Model\Server;
use DbTk\Config\Model\Account;
use DbTk\Config\Model\Connection;
use RuntimeException;

abstract class AbstractDatabaseRepository
{
    private $clusterrepo;
    
    public function setClusterRepository($repo)
    {
        $this->clusterrepository = $repo;
    }
    
    
    protected function getByArray($id, $data)
    {
        $database = new Database($id);

        if (isset($data['cluster'])) {
            $cluster = $this->clusterrepository->getById($data['cluster']);
            $database->setCluster($cluster);
        } else {
            $connection = new Connection('local');

            if (isset($data['username'])) {
                $account = new Account('local');
                $account->setUsername($data['username']);
                if (isset($data['password'])) {
                    $account->setPassword($data['password']);
                }
                $connection->setAccount($account);
            }

            if (isset($data['server'])) {
                $server = new Server('local');
                $server->setAddress($data['server']);
                if (isset($data['port'])) {
                    $server->setPort($data['port']);
                }
                $connection->setServer($server);
            }
            
            
            $database->addConnection($connection);
        }
        
        
        
        return $database;
    }
    
}
