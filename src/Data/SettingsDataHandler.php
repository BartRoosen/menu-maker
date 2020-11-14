<?php


namespace Data;


use Entities\Category;
use Entities\Complexity;

class SettingsDataHandler extends AbstractDataHandler
{
    public function getAllCategories()
    {
        $rows = $this->select(
            'select id,
                           name,
                           deleted
                    from category order by name;'
        );

        if (empty($rows)) {
            return null;
        }

        $result = [];
        foreach ($rows as $row) {
            $category = new Category();
            $category->setCategoryId($row['id']);
            $category->setCategoryName($row['name']);
            $category->setDeleted($row['deleted']);

            $result[] = $category;
        }

        return $result;
    }

    public function getAllComplexities()
    {
        $rows = $this->select(
            'select id,
                           name,
                           deleted
                    from complexity;'
        );

        if (empty($rows)) {
            return null;
        }

        $result = [];
        foreach ($rows as $row) {
            $complexity = new Complexity();
            $complexity->setComplexityId($row['id']);
            $complexity->setComplexityName($row['name']);
            $complexity->setComplexityDeleted($row['deleted']);

            $result[] = $complexity;
        }

        return $result;
    }

    public function addCategory($post)
    {
        $this->insert(
            'insert into category (name, deleted) VALUES (:name, :deleted);',
            [
                ':name'    => $post['name'],
                ':deleted' => $post['deleted'],
            ]
        );
    }
}