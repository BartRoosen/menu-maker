<?php


namespace Entities;


class Menu
{
    /** @var int */
    private $id;

    /** @var string */
    private $date;

    /** @var string */
    private $day;

    /** @var int */
    private $dishId;

    /** @var string */
    private $dishName;

    /** @var bool */
    private $delted;

    /** @var int */
    private $complexityId;

    /** @var float */
    private $time;

    /** @var int */
    private $maxComplexity;

    /** @var float */
    private $maxTime;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        if ('' !== $this->date) {
            return date('d-m-Y', strtotime($this->date));
        }
        return null;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getDishId()
    {
        return $this->dishId;
    }

    /**
     * @param int $dishId
     */
    public function setDishId($dishId)
    {
        $this->dishId = $dishId;
    }

    /**
     * @return string
     */
    public function getDishName()
    {
        return $this->dishName;
    }

    /**
     * @param string $dishName
     */
    public function setDishName($dishName)
    {
        $this->dishName = $dishName;
    }

    /**
     * @return bool
     */
    public function isDelted()
    {
        return $this->delted;
    }

    /**
     * @param bool $delted
     */
    public function setDelted($delted)
    {
        $this->delted = $delted;
    }

    /**
     * @return string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param string $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @return int
     */
    public function getComplexityId()
    {
        return $this->complexityId;
    }

    /**
     * @param int $complexityId
     */
    public function setComplexityId($complexityId)
    {
        $this->complexityId = $complexityId;
    }

    /**
     * @return float
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param float $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getMaxComplexity()
    {
        return $this->maxComplexity;
    }

    /**
     * @param int $maxComplexity
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
}
