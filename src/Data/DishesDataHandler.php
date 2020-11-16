<?php


namespace Data;


use Entities\Complexity;
use Entities\Dish;

class DishesDataHandler extends AbstractDataHandler
{
    /**
     * @return array|null
     */
    public function getAllDishes()
    {
        $rows = $this->select(
            'select d.id,
                           d.name,
                           d.complexity,
                           d.time,
                           c.name as complexityName,
                           (select count(dishId) from dish_ingredients where dishId = d.id and deleted = 0) as numberOfIngredients
                    from dishes d
                    left join complexity c on (c.id = d.complexity)
                    where d.deleted = 0;'
        );

        if (empty($rows)) {
            return null;
        }

        $result = [];
        foreach ($rows as $row) {
            $dish = new Dish();
            $dish->setId($row['id']);
            $dish->setName($row['name']);
            $dish->setComplexity($row['complexity']);
            $dish->setComplexityName($row['complexityName']);
            $dish->setTime($row['time']);
            $dish->setNumberOfIngredients($row['numberOfIngredients']);

            $result[] = $dish;
        }

        return $result;
    }

    /**
     * @param array $post
     */
    public function addDish($post)
    {
        $this->insert(
            'insert into dishes (name, complexity, time) values 
                    (:name, :complexity, :time);',
            [
                'name'       => $post['name'],
                'complexity' => $post['complexity'],
                'time'       => $post['time'],
            ]
        );
    }

    /**
     * @return array|null
     */
    public function getComplexity()
    {
        $rows = $this->select(
            'select id,
                           name
                    from complexity
                    where deleted = 0;'
        );

        if (empty($rows)) {
            return null;
        }

        $result = [];
        foreach ($rows as $row) {
            $complexity = new Complexity();
            $complexity->setComplexityId($row['id']);
            $complexity->setComplexityName($row['name']);

            $result[] = $complexity;
        }

        return $result;
    }

    /**
     * @param array $post
     */
    public function deleteDish($post)
    {
        $this->insert(
            'update dishes set deleted = 1 where id = :id;',
            [
                ':id' => $post['id'],
            ]
        );
    }

    public function updateDish($post)
    {
        $this->insert(
            'update dishes
                    set name = :name,
                        complexity = :complexity,
                        time = :time
                    where id = :id;',
            [
                ':name'       => $post['name'],
                ':complexity' => $post['complexity'],
                ':time'       => $post['time'],
                ':id'         => $post['id'],
            ]
        );
    }

    public function getDishById($id)
    {
        $rows = $this->select(
            'select d.id,
                           d.name,
                           d.complexity,
                           d.time,
                           c.name as complexityName
                    from dishes d
                    left join complexity c on (c.id = d.complexity)
                    where d.id = :id;',
            [
                ':id' => $id,
            ]
        );

        if (empty($rows) || 1 < count($rows)) {
            return null;
        }

        $row  = $rows[0];
        $dish = new Dish();
        $dish->setId($row['id']);
        $dish->setName($row['name']);
        $dish->setComplexityName($row['complexityName']);
        $dish->setTime($row['time']);

        return $dish;
    }

    public function deleteIngredientFromDish($post)
    {
        if (!empty($post) && isset($post['id'])) {
            $this->insert(
                'update dish_ingredients set deleted = 1 where id = :id;',
                [
                    ':id' => $post['id'],
                ]
            );
        }
    }

    public function addIngredientToDish($post)
    {
        $this->insert(
            'insert into dish_ingredients (dishId, ingredientId, amount, unit) values
                    (:dishId, :ingredientId, :amount, :unit);',
            [
                'dishId'       => $post['dishId'],
                'ingredientId' => $post['ingredientId'],
                'amount'       => $post['amount'],
                'unit'         => $post['unit'],
            ]
        );
    }
}