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
}