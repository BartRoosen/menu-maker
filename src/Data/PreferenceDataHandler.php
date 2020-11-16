<?php


namespace Data;


use Entities\Preference;

class PreferenceDataHandler extends AbstractDataHandler
{
    public function getPreferences()
    {
        $rows = $this->select(
            'select p.day,
                           p.max_complexity,
                           p.max_time,
                           c.name
                    from preferences p
                    left join complexity c on (c.id = p.max_complexity);'
        );

        if (empty($rows)) {
            return null;
        }

        $result = [];
        foreach ($rows as $row) {
            $preference = new Preference();
            $preference->setDay($row['day']);
            $preference->setMaxComplexity($row['max_complexity']);
            $preference->setMaxTime($row['max_time']);
            $preference->setComplexityName($row['name']);

            $result[] = $preference;
        }

        return $result;
    }

    public function setComplexityLevel($post)
    {
        if (!empty($post) && isset($post['day'], $post['level'])) {
            $this->insert(
                'update preferences set max_complexity = :level where day = :day;',
                [
                    ':day'   => $post['day'],
                    ':level' => $post['level'],
                ]
            );
        }
    }

    public function setNewMaxTime($post)
    {
        if (!empty($post) && isset($post['day'], $post['time'])) {
            $this->insert(
                'update preferences set max_time = :time where day = :day;',
                [
                    ':day'  => $post['day'],
                    ':time' => $post['time'],
                ]
            );
        }
    }
}
