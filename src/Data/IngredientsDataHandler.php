<?php


namespace Data;


use Entities\Category;
use Entities\Ingredient;

class IngredientsDataHandler extends AbstractDataHandler
{
    public function getAllIngredients()
    {
        $rows = $this->select(
            'select i.id       as ingredientId,
                           i.name     as ingredientName,
                           i.category as ingredientCategoryId,
                           c.id       as categoryId,
                           c.name     as categoryName
                    from ingredients i
                             left join category c on i.category = c.id
                    where i.deleted = 0 and c.deleted = 0 order by i.name;'
        );

        if (empty($rows)) {
            return null;
        }

        $result = [];
        foreach ($rows as $row) {
            $ingredient = new Ingredient();
            $ingredient->setIngredientId($row['ingredientId']);
            $ingredient->setIngredientName($row['ingredientName']);
            $ingredient->setIngredientCategoryId($row['ingredientCategoryId']);
            $ingredient->setCategoryName($row['categoryName']);

            $result[] = $ingredient;
        }

        return $result;
    }

    public function getCategories()
    {
        $rows = $this->select(
            'select id,
                           name
                    from category where deleted = 0 order by name'
        );

        if (empty($rows)) {
            return null;
        }

        $result = [];
        foreach ($rows as $row) {
            $category = new Category();
            $category->setCategoryId($row['id']);
            $category->setCategoryName($row['name']);

            $result[] = $category;
        }

        return $result;
    }

    public function addNewIngredient($post)
    {
        if (0 === (int)$post['id']) {
            $this->insert(
                'insert into ingredients (name, category)
                    values (:name, :category);',
                [
                    ':name'     => $post['ingredientName'],
                    ':category' => $post['category'],
                ]
            );
        } else {
            $this->insert(
                'update ingredients set name = :name, category = :category where id = :id;',
                [
                    ':name'     => $post['ingredientName'],
                    ':category' => $post['category'],
                    ':id'       => $post['id'],
                ]
            );
        }
    }

    public function deleteIngredient($id)
    {
        $this->insert(
            'update ingredients set deleted = 1 where id = :id;',
            [
                ':id' => $id,
            ]
        );
    }
}