<?php


namespace Data;


use Entities\ShoppingListItem;

class ShoppingListDataHandler extends AbstractDataHandler
{
    public function getShoppingListByPeriod($post)
    {
        $rows = $this->select(
            'select i.id,
                           i.name,
                           sum(di.amount) as amount,
                           di.unit
                    from menu m
                    left join dish_ingredients di on (di.dishId = m.dishId and di.deleted = 0)
                    left join ingredients i on (i.id = di.ingredientId and i.deleted = 0)
                    where m.date between :startDate and :endDate and m.deleted = 0 and i.name is not null
                    group by i.name, di.unit order by i.name;',
            [
                ':startDate' => $post['startDate'],
                ':endDate'   => $post['endDate'],
            ]
        );

        if (empty($rows)) {
            return null;
        }

        $result = [];
        foreach ($rows as $row) {
            $result[]         = [
                'id'     => $row['id'],
                'name'   => $row['name'],
                'amount' => $row['amount'],
                'unit'   => $row['unit'],
            ];
        }

        return $result;
    }
}