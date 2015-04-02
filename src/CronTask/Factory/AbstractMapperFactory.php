<?php


namespace CronTask\Factory;
 
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
 
class AbstractMapperFactory implements AbstractFactoryInterface
{
    public function canCreateServiceWithName(ServiceLocatorInterface $locator, $name, $requestedName)
    {
        if (preg_match("/CronTask\\\Mapper/",$requestedName) && class_exists($requestedName.'Mapper')){
            return true;
        }
 
        return false;
    }
 
    public function createServiceWithName(ServiceLocatorInterface $locator, $name, $requestedName)
    {
        $class = $requestedName.'Mapper';
        return new $class;
    }
}