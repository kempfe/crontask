<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace CronTask;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;


class Module
{
    public function onBootstrap(MvcEvent $e)
    {

        
        
        
    }

    
    public function getConfig()
    {
        return  include __DIR__ . '/config/module.config.php';
       
    }

    
    public function getServiceConfig(){
        return array(
            'invokables' => array(
            ),
            'aliases' => array(
            ),
            'factories' => array(

            ),
            'abstract_factories' => array(
                'CronTask\Factory\AbstractServiceFactory',
                'CronTask\Factory\AbstractMapperFactory'
            ),
            'initializers' => [
            ]
            
        );
    }


    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    

}
