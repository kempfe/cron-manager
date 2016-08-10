<?php

namespace CronManager\Entity;

/**
 * Cron
 */
class Cron
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
    private $command;

    /**
     * @var array
     */
    private $arguments;

    /**
     * @var \DateTime
     */
    private $lastExecution;

    /**
     * @var \DateTime
     */
    private $nextExecution;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var integer
     */
    private $processId;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $log;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->log = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Cron
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
     *
     * @return Cron
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
     * Set command
     *
     * @param string $command
     *
     * @return Cron
     */
    public function setCommand($command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Get command
     *
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Set arguments
     *
     * @param array $arguments
     *
     * @return Cron
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * Get arguments
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Set lastExecution
     *
     * @param \DateTime $lastExecution
     *
     * @return Cron
     */
    public function setLastExecution($lastExecution)
    {
        $this->lastExecution = $lastExecution;

        return $this;
    }

    /**
     * Get lastExecution
     *
     * @return \DateTime
     */
    public function getLastExecution()
    {
        return $this->lastExecution;
    }

    /**
     * Set nextExecution
     *
     * @param \DateTime $nextExecution
     *
     * @return Cron
     */
    public function setNextExecution($nextExecution)
    {
        $this->nextExecution = $nextExecution;

        return $this;
    }

    /**
     * Get nextExecution
     *
     * @return \DateTime
     */
    public function getNextExecution()
    {
        return $this->nextExecution;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Cron
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set processId
     *
     * @param integer $processId
     *
     * @return Cron
     */
    public function setProcessId($processId)
    {
        $this->processId = $processId;

        return $this;
    }

    /**
     * Get processId
     *
     * @return integer
     */
    public function getProcessId()
    {
        return $this->processId;
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
     * Add log
     *
     * @param \CronManager\Entity\Log $log
     *
     * @return Cron
     */
    public function addLog(\CronManager\Entity\Log $log)
    {
        $this->log[] = $log;

        return $this;
    }

    /**
     * Remove log
     *
     * @param \CronManager\Entity\Log $log
     */
    public function removeLog(\CronManager\Entity\Log $log)
    {
        $this->log->removeElement($log);
    }

    /**
     * Get log
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLog()
    {
        return $this->log;
    }
}
