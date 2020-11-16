<?php


namespace Entities;


class Preference
{
    /** @var int */
    private $day;

    /** @var string */
    private $maxComplexity;

    /** @var float */
    private $maxTime;

    /** @var string */
    private $complexityName;

    /**
     * @return int
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param int $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @return string
     */
    public function getMaxComplexity()
    {
        return $this->maxComplexity;
    }

    /**
     * @param string $maxComplexity
     */
    public function setMaxComplexity($maxComplexity)
    {
        $this->maxComplexity = $maxComplexity;
    }

    /**
     * @return float
     */
    public function getMaxTime()
    {
        return $this->maxTime;
    }

    /**
     * @param float $maxTime
     */
    public function setMaxTime($maxTime)
    {
        $this->maxTime = $maxTime;
    }

    /**
     * @return string
     */
    public function getComplexityName()
    {
        return $this->complexityName;
    }

    /**
     * @param string $complexityName
     */
    public function setComplexityName($complexityName)
    {
        $this->complexityName = $complexityName;
    }
}
