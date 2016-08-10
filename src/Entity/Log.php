<?php

namespace CronManager\Entity;

/**
 * Log
 */
class Log
{
    /**
     * @var string
     */
    private $log;

    /**
     * @var \DateTime
     */
    private $crDate;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \CronManager\Entity\Cron
     */
    private $cron;


    /**
     * Set log
     *
     * @param string $log
     *
     * @return Log
     */
    public function setLog($log)
    {
        $this->log = $log;

        return $this;
    }

    /**
     * Get log
     *
     * @return string
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * Set crDate
     *
     * @param \DateTime $crDate
     *
     * @return Log
     */
    public function setCrDate($crDate)
    {
        $this->crDate = $crDate;

        return $this;
    }

    /**
     * Get crDate
     *
     * @return \DateTime
     */
    public function getCrDate()
    {
        return $this->crDate;
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
     * @param \CronManager\Entity\Cron $cron
     *
     * @return Log
     */
    public function setCron(\CronManager\Entity\Cron $cron)
    {
        $this->cron = $cron;

        return $this;
    }

    /**
     * Get cron
     *
     * @return \CronManager\Entity\Cron
     */
    public function getCron()
    {
        return $this->cron;
    }
    /**
     * @var boolean
     */
    private $hasError;


    /**
     * Set hasError
     *
     * @param boolean $hasError
     *
     * @return Log
     */
    public function setHasError($hasError)
    {
        $this->hasError = $hasError;

        return $this;
    }

    /**
     * Get hasError
     *
     * @return boolean
     */
    public function getHasError()
    {
        return $this->hasError;
    }

    public function __construct()
    {
        $this->setCrDate(new \DateTime());
    }
}
