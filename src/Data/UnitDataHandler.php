<?php


namespace Data;


use Entities\Unit;

class UnitDataHandler extends AbstractDataHandler
{
    public function getUnits()
    {
        $rows = $this->select(
            'select id, name from units where deleted = 0;'
        );

        if (empty($rows)) {
            return null;
        }

        $result = [];

        foreach ($rows as $row) {
            $unit = new Unit();
            $unit->setId($row['id']);
            $unit->setName($row['name']);

            $result[] = $unit;
        }

        return $result;
    }

    public function deleteUnit($post)
    {
        $this->insert(
            'update units set deleted = 1 where id = :id;',
            [
                ':id' => $post['id'],
            ]
        );
    }

    public function updateUnit($post)
    {
        $this->insert(
            'update units set name = :name where id = :id;',
            [
                ':name' => $post['name'],
                ':id'   => $post['id'],
            ]
        );
    }

    public function saveNewUnit($post)
    {
        return $this->insert(
            'insert into units (name) values (:name);',
            [
                ':name' => $post['name'],
            ]
        );
    }
}