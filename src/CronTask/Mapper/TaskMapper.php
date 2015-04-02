<?php

namespace CronTask\Mapper;


class TaskMapper extends MapperAbstract {
    
    protected $entityName = 'CronTask\Entity\Task';
    
    public function getActiveTasks(){
        return $this->getEntityRepository()->findBy(array('active' => 1));
    }
    
}