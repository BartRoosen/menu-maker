<?php


namespace Entities;


class Ingredient
{
    /** @var int */
    private $ingredientId;

    /** @var string */
    private $ingredientName;

    /** @var int */
    private $ingredientCategoryId;

    /** @var string */
    private $categoryName;

    /** @var int */
    private $dishIngredientId;

    /** @var string */
    private $amount;

    /**
     * @return int
     */
    public function getIngredientId()
    {
        return $this->ingredientId;
    }

    /**
     * @param int $ingredientId
     */
    public function setIngredientId($ingredientId)
    {
        $this->ingredientId = $ingredientId;
    }

    /**
     * @return string
     */
    public function getIngredientName()
    {
        return $this->ingredientName;
    }

    /**
     * @param string $ingredientName
     */
    public function setIngredientName($ingredientName)
    {
        $this->ingredientName = $ingredientName;
    }

    /**
     * @return int
     */
    public function getIngredientCategoryId()
    {
        return $this->ingredientCategoryId;
    }

    /**
     * @param int $ingredientCategoryId
     */
    public function setIngredientCategoryId($ingredientCategoryId)
    {
        $this->ingredientCategoryId = $ingredientCategoryId;
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * @param string $categoryName
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
    }

    /**
     * @return int
     */
    public function getDishIngredientId()
    {
        return $this->dishIngredientId;
    }

    /**
     * @param int $dishIngredientId
     */
    public function setDishIngredientId($dishIngredientId)
    {
        $this->dishIngredientId = $dishIngredientId;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }
}
