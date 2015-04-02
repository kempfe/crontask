<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace CronTask\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ConsoleModel;

class CronTaskController extends \Zend\Mvc\Controller\AbstractActionController
{   
   
    
    public function runAction()
    {
        $exectutionService = $this->getServiceLocator()->get('CronTask\Service\Execution');
        $execute = $this->params("execute",null);
        if($execute){
           
            foreach(explode(",",$execute) as $taskId){
                 
                $exectutionService->executeTask($taskId);
                
            }
        }else{
            $response = $exectutionService->executeTasks();
        }
        $model =  new ConsoleModel();
        $model->setResult($response);
        return $model;
    }
}
