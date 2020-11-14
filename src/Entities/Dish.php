<?php


namespace Entities;


class Dish
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var int */
    private $complexity;

    /** @var float */
    private $time;

    /** @var bool */
    private $deleted;

    /** @var string */
    private $complexityName;

    /** @var array */
    private $ingredients;

    /** @var int */
    private $numberOfIngredients;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getComplexity()
    {
        return $this->complexity;
    }

    /**
     * @param int $complexity
     */
    public function setComplexity($complexity)
    {
        $this->complexity = $complexity;
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
     * @return bool
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * @return array
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param array $ingredients
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
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

    /**
     * @return int
     */
    public function getNumberOfIngredients()
    {
        return $this->numberOfIngredients;
    }

    /**
     * @param int $numberOfIngredients
     */
    public function setNumberOfIngredients($numberOfIngredients)
    {
        $this->numberOfIngredients = $numberOfIngredients;
    }
}
