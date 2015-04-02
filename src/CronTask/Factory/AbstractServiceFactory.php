<?php


namespace CronTask\Factory;
 
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
 
class AbstractServiceFactory implements AbstractFactoryInterface
{
    public function canCreateServiceWithName(ServiceLocatorInterface $locator, $name, $requestedName)
    {
        if (preg_match("/CronTask\\\Service/",$requestedName) && class_exists($requestedName.'Service')){
            return true;
        }
 
        return false;
    }
 
    public function createServiceWithName(ServiceLocatorInterface $locator, $name, $requestedName)
    {
        $class = $requestedName.'Service';
        return new $class;
    }
}