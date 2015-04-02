<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'template_map' => array(

        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => [


    ],
    'doctrine' => array(
      'driver' => array(
        'CronTask_entities' => array(
            	'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
            	'paths' => __DIR__ . '/xml/doctrine'
        ),

        'orm_default' => array(
          'drivers' => array(
            'CronTask\Entity' => 'CronTask_entities'
          )
    ))),

    'router' => array(
        'routes' => [],
    ),
    'controllers' => array(
        'invokables' => array(
            'CronTask\Controller\CronTask' => 'CronTask\Controller\CronTaskController'
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
                'CronTask' => [
                    'options' => array(
                        'route' => 'crontask [--execute=]',
                        'defaults' => array(
                            'controller' => 'CronTask\Controller\CronTask',
                            'action' => 'run'
                        )
                    ),
                ]
            ),
        ),
    ),
);
