<?php

namespace Data;

use Config\Config;
use Entities\Address;
use PDO;

class AbstractDataHandler
{
    /** @var PDO | null */
    private $dbh = null;

    protected function select($query, array $params = null)
    {
        $this->openDataBase();

        $stmt = $this->dbh->prepare($query);
        $stmt->execute($params);

        $this->closeDataBase();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function insert($query, array $params)
    {
        $lastInsertedId = null;
        $this->openDataBase();

        $stmt = $this->dbh->prepare($query);
        $stmt->execute($params);
        $lastInsertedId = $this->dbh->lastInsertId();

        $this->closeDataBase();

        return $lastInsertedId;
    }

    protected function delete($query, array $params)
    {
        $this->openDataBase();

        $stmt = $this->dbh->prepare($query);
        $stmt->execute($params);

        $this->closeDataBase();
    }

    protected function truncate($query)
    {
        $this->openDataBase();

        $stmt = $this->dbh->prepare($query);
        $stmt->execute();

        $this->closeDataBase();
    }

    private function openDataBase()
    {
        $this->dbh = new PDO(Config::DB_CONNECTIONSTRING, Config::DB_USER, Config::DB_PASSWORD);
    }

    private function closeDataBase()
    {
        $this->dbh = null;
    }

    protected function objectify(array $rows, $object)
    {
        $result = [];
        foreach ($rows as $row) {
            $obj = new $object();
            foreach ($row as $setter => $value) {
                $obj->{$setter}($value);
            }
            $result[] = $obj;
        }

        if (empty($result)) {
            return null;
        }

        return $result;
    }

    protected function objectifySingleObject(array $row, $object)
    {
        if (empty($row)) {
            return null;
        }

        $obj = new $object();
        foreach ($row as $setter => $value) {
            $obj->{$setter}($value);
        }

        return $obj;
    }

    protected function deleteById($id, $table)
    {
        if ('' === $id || '' === $table) {
            return false;
        }

        $this->delete(sprintf('delete from %s where id = :d', $table), [':d' => $id]);

        return true;
    }
}
