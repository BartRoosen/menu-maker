<?php


namespace Data;


use Entities\Menu;

class MenuDataHandler extends AbstractDataHandler
{
    public function getMenu()
    {
        $rows = $this->select(
            'select m.id,
                           m.date,
                           m.day,
                           m.dishId,
                           d.name,
                           d.complexity,
                           d.time,
                           p.max_complexity,
                           p.max_time
                    from menu m
                    left join dishes d on (d.id = m.dishId)
                    left join preferences p on (p.day = m.day)
                    where m.deleted = 0 and date >= :dateString order by m.date;',
            [
                ':dateString' => date('Y-m-d'),
            ]
        );

        if (empty($rows)) {
            return null;
        }

        $result = [];
        foreach ($rows as $row) {
            $menu = new Menu();
            $menu->setId($row['id']);
            $menu->setDate($row['date']);
            $menu->setDishId($row['dishId']);
            $menu->setDay($row['day']);
            $menu->setDishName($row['name']);
            $menu->setComplexityId($row['complexity']);
            $menu->setTime($row['time']);
            $menu->setMaxComplexity($row['max_complexity']);
            $menu->setMaxTime($row['max_time']);

            $result[] = $menu;
        }

        return $result;
    }

    public function changeMenuOfTheDay($post)
    {
        $this->insert(
            'update menu set dishId = :dishId where id = :id;',
            [
                ':dishId' => $post['dishId'],
                ':id'     => $post['id'],
            ]
        );
    }

    public function findExistingDate($post)
    {
        $rows = $this->select(
            'select id from menu where date = :date;',
            [
                ':date' => $post['date'],
            ]
        );

        if (empty($rows)) {
            return true;
        }

        return false;
    }

    public function getPossibleDishesByDay($day)
    {
        $row = null;
        if ('' !== $day) {
            $rows = $this->select(
                'select max_complexity,
                               max_time
                        from preferences
                        where day = :day;',
                [
                    ':day' => $day,
                ]
            );

            if (1 === count($rows)) {
                $row    = $rows[0];
                $dishes = $this->select(
                    'select id, name
                            from dishes
                            where complexity <= :max_complexity
                              and time <= :max_time
                              and deleted = 0;',
                    [
                        ':max_time'       => $row['max_time'],
                        ':max_complexity' => $row['max_complexity'],
                    ]
                );

                if (empty($dishes)) {
                    return null;
                }

                $result = [];
                foreach ($dishes as $dish) {
                    $result[$dish['id']] = $dish['name'];
                }

                return $result;
            }
        }

        return null;
    }

    public function addMenuItem($post)
    {
        return $this->insert(
            'insert into menu (date, dishId) VALUES (:date, :dishId);',
            [
                ':dishId' => $post['dishId'],
                ':date'   => $post['date'],
            ]
        );
    }

    public function deleteMenuItem($post)
    {
        $this->delete(
            'delete from menu where id = :id;',
            [
                ':id' => $post['id'],
            ]
        );
    }
}