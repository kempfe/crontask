<?php

namespace CronTask\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 */
class Task
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $expression;

    /**
     * @var string
     */
    private $cronClass;

    /**
     * @var integer
     */
    private $active = 0;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set name
     *
     * @param string $name
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set expression
     *
     * @param string $expression
     * @return Task
     */
    public function setExpression($expression)
    {
        $this->expression = $expression;

        return $this;
    }

    /**
     * Get expression
     *
     * @return string 
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * Set cronClass
     *
     * @param string $cronClass
     * @return Task
     */
    public function setCronClass($cronClass)
    {
        $this->cronClass = $cronClass;

        return $this;
    }

    /**
     * Get cronClass
     *
     * @return string 
     */
    public function getCronClass()
    {
        return $this->cronClass;
    }

    /**
     * Set active
     *
     * @param integer $active
     * @return Task
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer 
     */
    public function getActive()
    {
        return $this->active;
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
     * @var \DateTime
     */
    private $lastExecutionTime;

    /**
     * @var \DateTime
     */
    private $nextExecutionTime;


    /**
     * Set lastExecutionTime
     *
     * @param \DateTime $lastExecutionTime
     * @return Task
     */
    public function setLastExecutionTime($lastExecutionTime)
    {
        $this->lastExecutionTime = $lastExecutionTime;

        return $this;
    }

    /**
     * Get lastExecutionTime
     *
     * @return \DateTime 
     */
    public function getLastExecutionTime()
    {
        return $this->lastExecutionTime;
    }

    /**
     * Set nextExecutionTime
     *
     * @param \DateTime $nextExecutionTime
     * @return Task
     */
    public function setNextExecutionTime($nextExecutionTime)
    {
        $this->nextExecutionTime = $nextExecutionTime;

        return $this;
    }

    /**
     * Get nextExecutionTime
     *
     * @return \DateTime 
     */
    public function getNextExecutionTime()
    {
        return $this->nextExecutionTime;
    }
}
