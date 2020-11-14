<?php


namespace Data;


use Entities\Complexity;
use Entities\Dish;

class DishesDataHandler extends AbstractDataHandler
{
    public function getAllDishes()
    {
        $rows = $this->select(
            'select d.id,
                           d.name,
                           d.complexity,
                           d.time,
                           c.name as complexityName,
                           (select count(dishId) from dish_ingredients where dishId = d.id) as numberOfIngredients
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
}