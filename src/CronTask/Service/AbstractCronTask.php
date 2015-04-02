<?php

namespace CronTask\Service;
use CronTask\Service\CronLog;

abstract class AbstractCronTask implements CronTaskInterface
{
    
    protected $tasklog;
    
    /**
     * 
     * @return \CronTask\Service\CronLogInterface
     */
    public function getTaskLog() {
        if(!isset($this->tasklog)){
            $this->tasklog = new CronLog();
        }
        return $this->tasklog;
    }
    
    /**
     * 
     * @param \CronTask\Service\CronLogInterface $log
     */
    public function setTaskLog(CronLogInterface $log) {
        $this->tasklog = $log;
    }
    
    
    
}