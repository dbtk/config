<?php

namespace DbTk\Config\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
//use DbTk\Core\Service as DatabaseService;
use DbTk\Config\ClusterRepository\JsonFileClusterRepository;
use DbTk\Config\DatabaseRepository\IniFileDatabaseRepository;
use RuntimeException;

class ConfigPrintCommand extends Command
{
    protected function configure()
    {
        $this
        ->setName('config:print')
        ->setDescription('Prints a database configuration')
        ->addArgument(
            'dbname',
            InputArgument::REQUIRED,
            'Database name'
        )
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $dbid = $input->getArgument('dbname');
        
        $output->write("DbTk: Printing [$dbid]\n");
        $clusterrepo = new JsonFileClusterRepository(__DIR__ . '/../../examples/cluster/');
        
        //$cluster = $clusterrepo->getById('c1');
        //print_r($cluster);
        //exit("DOEI\n");
        
        //$databaserepo = new IniFileDatabaseRepository('/share/config/database/', '.conf');
        $databaserepo = new IniFileDatabaseRepository(__DIR__ . '/../../examples/database/', '.ini');
        $databaserepo->setClusterRepository($clusterrepo);
        
        $db = $databaserepo->getById($dbid);
        //print_r($db);
        //exit();
        $connection = $db->getConnection('writer');
        print_r($connection);
        
        
        
        /*
        $x = new PdoConnector();
        $pdo = $x->connect($connection);
        */
        
        /*
        $conf = $dbtk->getConnectionConfig('test', 'writer');
        $c = new PdoConnector();
        $pdo = $c->connect($conf);
        */
        
        $output->write("Done\n");
    }
}
