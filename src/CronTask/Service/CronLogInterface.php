<?php

namespace CronTask\Service;


interface CronLogInterface{
    
    public function addLog($log,$error = false);
    public function getLog();
    public function setExecutionDuration($duration);
    public function getExecutionDuration();
    public function __toString();
    
    
}