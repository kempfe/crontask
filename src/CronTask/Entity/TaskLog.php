<?php

namespace CronTask\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaskLog
 */
class TaskLog
{
    /**
     * @var \DateTime
     */
    private $executionTime;

    /**
     * @var integer
     */
    private $executionDuration;

    /**
     * @var string
     */
    private $cronLog;

    /**
     * @var integer
     */
    private $hasError;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Cron\Entity\Task
     */
    private $cron;


    /**
     * Set executionTime
     *
     * @param \DateTime $executionTime
     * @return TaskLog
     */
    public function setExecutionTime($executionTime)
    {
        $this->executionTime = $executionTime;

        return $this;
    }

    /**
     * Get executionTime
     *
     * @return \DateTime 
     */
    public function getExecutionTime()
    {
        return $this->executionTime;
    }

    /**
     * Set executionDuration
     *
     * @param float $executionDuration
     * @return TaskLog
     */
    public function setExecutionDuration($executionDuration)
    {
        $this->executionDuration = $executionDuration;

        return $this;
    }

    /**
     * Get executionDuration
     *
     * @return float 
     */
    public function getExecutionDuration()
    {
        return $this->executionDuration;
    }

    /**
     * Set cronLog
     *
     * @param string $cronLog
     * @return TaskLog
     */
    public function setCronLog($cronLog)
    {
        $this->cronLog = $cronLog;

        return $this;
    }

    /**
     * Get cronLog
     *
     * @return string 
     */
    public function getCronLog()
    {
        return $this->cronLog;
    }

    /**
     * Set hasError
     *
     * @param integer $hasError
     * @return TaskLog
     */
    public function setHasError($hasError)
    {
        $this->hasError = $hasError;

        return $this;
    }

    /**
     * Get hasError
     *
     * @return integer 
     */
    public function getHasError()
    {
        return $this->hasError;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cron
     *
     * @param \Cron\Entity\Task $cron
     * @return TaskLog
     */
    public function setCron(\CronTask\Entity\Task $cron = null)
    {
        $this->cron = $cron;

        return $this;
    }

    /**
     * Get cron
     *
     * @return \CronTask\Entity\Task 
     */
    public function getCron()
    {
        return $this->cron;
    }
    
    public function __construct() {
        $this->executionTime = new \DateTime();
    }
}
