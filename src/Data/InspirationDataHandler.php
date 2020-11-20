<?php


namespace Data;


use Entities\Inspiration;

class InspirationDataHandler extends AbstractDataHandler
{
    public function getAllInspirations()
    {
        $rows = $this->select(
            'select id,
                           link,
                           picture,
                           caption,
                           deleted
                    from inspiration
                    where deleted = 0 order by caption;'
        );

        if (empty($rows)) {
            return null;
        }

        $result = [];
        foreach ($rows as $row) {
            $inspiration = new Inspiration();
            $inspiration->setId($row['id']);
            $inspiration->setLink($row['link']);
            $inspiration->setPicture($row['picture']);
            $inspiration->setCaption($row['caption']);

            $result[] = $inspiration;
        }

        return $result;
    }

    public function removeInspiration($post)
    {
        $this->delete(
            'delete from inspiration where id = :id;',
            [
                ':id' => $post['id'],
            ]
        );
    }

    public function saveInspiration($post)
    {
        $this->insert(
            'insert into inspiration (link, picture, caption) VALUES
                    (:link, :picture, :caption);',
            [
                ':caption' => $post['name'],
                ':picture' => $post['picture'],
                ':link'    => $post['link'],
            ]
        );
    }
}