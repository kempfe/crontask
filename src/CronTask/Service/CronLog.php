<?php

namespace CronTask\Service;


class CronLog implements CronLogInterface {
    
    protected $duration;
    protected $log = [];
    
    public function getExecutionDuration() {
        return $this->duration;
    }
    
    public function setExecutionDuration($duration) {
        $this->duration = (int)$duration;
        return $this;
    }
    
    public function getLog() {
        return $this->log;
    }
    
    public function addlog($log, $error = false) {
        $this->log[] = [
            'content' => (string)$log,
            'error' => (bool) $error
        ];
        return $this;
    }
    
    public function hasError(){
        foreach($this->log as $log){
            if($log['error']){
                return true;
            }
        }
        return false;
    }
    
    public function __toString() {
        $str = '';
        foreach($this->log as $log){
            $str .=  $log['content'] . PHP_EOL;
        }
        return $str;
    }
}