<?php

namespace DbTk\Config\DatabaseRepository;

use DbTk\Config\Model\Database;
use DbTk\Config\Model\Cluster;
use DbTk\Config\Model\Server;
use DbTk\Config\Model\Account;
use DbTk\Config\Model\Connection;
use RuntimeException;

class IniFileDatabaseRepository extends AbstractDatabaseRepository
{
    private $basepath;
    private $extension;
    
    public function __construct($basepath, $extension = '.ini')
    {
        $this->basepath = $basepath;
        $this->extension = $extension;
    }
    
    public function getById($id)
    {
        $filename = $this->basepath . $id . $this->extension;
        if (!file_exists($filename)) {
            throw new RuntimeException("Database config not found: " . $filename);
        }
        
        $inidata = parse_ini_file($filename);
        return $this->getByArray($id, $inidata);
    }
    
}
