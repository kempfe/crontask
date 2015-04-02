<?php

namespace CronTask\Service;


class ExecutionService implements \Zend\ServiceManager\ServiceManagerAwareInterface{
    
    protected $locator;
    protected $cronExecutionInterval = 5;
    protected $executionLog = [];
    
    /**
     * 
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function getServiceLocator() {
        return $this->locator;
    }
    
    
    public function setServiceManager(\Zend\ServiceManager\ServiceManager $serviceManager) {
        $this->locator = $serviceManager;
        return $this;
    }
    
    public function executeTask($taskId){
        $task = $this->getServiceLocator()->get('CronTask\Mapper\Task')->getEntityRepository()->find($taskId);
        if($task){           
            $this->_executeTask($task);
        }
    }
    
    public function executeTasks(){
        $tasks = $this->getServiceLocator()->get('CronTask\Mapper\Task')->getActiveTasks();
        
        foreach($tasks as $task){
            $task->setLastExecutionTime(new \DateTime());
            $this->_executeTask($task);
            $this->getServiceLocator()->get('CronTask\Mapper\Task')->update($task);
        }
        return $this->_buildLog();
    }
    
    protected function _executeTask(\CronTask\Entity\Task $task){
        if($this->getServiceLocator()->has($task->getCronClass()) !== true && !class_exists($task->getCronClass())){
            $this->addExecutionLog($task, "CronClass was not found");
            return false;
        }
        
        try {
            $cron = \CronExp\CronExpression::factory($task->getExpression());
            $cron->isDue();
        }catch(\Exception $e){
            $this->addExecutionLog($task, "Cron Expression not valid");
            return false;
        }

        if($cron->getNextRunDate() <= (new \Datetime)->modify("+" . $this->cronExecutionInterval . " minutes")){
            
            // If Service does not exist - add to Service Manager
            if(!$this->getServiceLocator()->has($task->getCronClass())){
                $this->getServiceLocator()->setInvokableClass($task->getCronClass(), $task->getCronClass());
            }

            $cronTask = $this->getServiceLocator()->get($task->getCronClass());
            /*@var $cronTask \CronTask\Service\CronTaskInterface */
            try{
                $task->setNextExecutionTime($cron->getNextRunDate());
                $start = microtime();
                $cronTask->run();
                $end = microtime();
            }catch(\Exception $e){

                $this->addExecutionLog($task, $e->getMessage());

                return false;
            }
            $taskLogMapper = $this->getServiceLocator()->get('CronTask\Mapper\TaskLog');

            $log = $cronTask->getTaskLog();
            /*@var $log \CronTask\Service\CronLog */

            $logEntity = new \CronTask\Entity\TaskLog();

            $logEntity->setCron($task);
            $logEntity->setCronLog((string)$log);
            $logEntity->setExecutionDuration($this->microtime_diff($start,$end));
            $logEntity->setHasError($log->hasError());

            $taskLogMapper->insert($logEntity);
        }
        
    }
    
    public function microtime_diff($start, $end = null)
    {
        if (!$end) {
        $end = microtime();
        }
        list($start_usec, $start_sec) = explode(" ", $start);
        list($end_usec, $end_sec) = explode(" ", $end);
        $diff_sec = intval($end_sec) - intval($start_sec);
        $diff_usec = floatval($end_usec) - floatval($start_usec);
        return floatval($diff_sec) + $diff_usec;
    } 
    
    protected function _buildLog(){
        $logs = $this->getExecutionLog();
        $res = '';
        foreach($logs as $log){
            $task = $log['task'];
            $time = $log['time'];
            $message = $log['message'];
            ob_start();
            include(__DIR__ . "/../Template/ExecutionLog.php");
            $res .= ob_get_clean();
        }
        return $res;
    }
    
    public function addExecutionLog(\CronTask\Entity\Task $task,$message){
        $this->executionLog[] = [
            'time' => new \DateTime(),
            'task' => $task,
            'message' => $message
        ];
    }
    
    public function getExecutionLog(){
        return $this->executionLog;
    }
    
}