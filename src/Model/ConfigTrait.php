<?php

namespace DbTk\Config\Model;

trait ConfigTrait
{
    protected $config = array();
    
    public function setConfig($key, $value)
    {
        $this->config[$key] = $value;
    }

    public function hasConfig($key)
    {
        if (isset($this->config[$key])) {
            return true;
        }
        return false;
    }
    
    public function getConfig($key)
    {
        return $this->config[$key];
    }

}
