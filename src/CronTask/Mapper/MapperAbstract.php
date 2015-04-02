<?php

namespace CronTask\Mapper;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class MapperAbstract implements ServiceManagerAwareInterface{
    
    protected $serviceManager;
    protected $entityName;
    protected $eventManager;
    
    const EVENT_PRE_INSERT = 'pre_insert';
    const EVENT_POST_INSERT = 'post_insert';
    const EVENT_PRE_UPDATE = 'pre_update';
    const EVENT_POST_UPDATE = 'post_update';
    const EVENT_PRE_REMOVE = 'pre_remove';
    const EVENT_POST_REMOVE = 'post_remove';
    
    
    public function setServiceManager(\Zend\ServiceManager\ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
    }
    
    /**
     * 
     * @return ServiceManagerAwareInterface
     */
    public function getServiceManager(){
        return $this->serviceManager;
    }
    
    
    /**
     * 
     * @return EntityRepository
     */
    public function getEntityRepository(){
        return $this->getEntityManager()->getRepository($this->entityName);
    }
    
    /**
     * 
     * @return EntityManager
     */
    public function getEntityManager(){
        return $this->getServiceManager()->get('doctrine_em');
    }
    
    /**
     * 
     * @return \Zend\EventManager\EventManager
     */
    public function getEventManager(){
        if(!isset($this->eventManager)){
            $this->eventManager = new \Zend\EventManager\EventManager();
        }
        return $this->eventManager;
    }
    
    
    public function insert($entity){
        $this->getEventManager()->trigger(self::EVENT_PRE_INSERT,['entity' => $entity]);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(self::EVENT_POST_INSERT,['entity' => $entity]);
        return $entity;
    }
    
    public function update($entity){
        $this->getEventManager()->trigger(self::EVENT_PRE_UPDATE,['entity' => $entity]);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(self::EVENT_POST_UPDATE,['entity' => $entity]);
        return $entity;
    }
    
    public function remove($entity){
        $this->getEventManager()->trigger(self::EVENT_PRE_REMOVE,['entity' => $entity]);
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(self::EVENT_POST_REMOVE);
        return true;
    }
    
}