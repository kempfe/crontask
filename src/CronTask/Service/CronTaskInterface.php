<?php

namespace CronTask\Service;


interface CronTaskInterface{
    
    public function run();
    /**
     * @return \CronTask\Service\CronLogInterface
     */
    public function getTaskLog();
    public function setTaskLog(\CronTask\Service\CronLogInterface $log);
    
    
    
    
}