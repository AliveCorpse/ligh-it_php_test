<?php

namespace App\Core;

abstract class Model
{
    const TABLE = '';

    public $id;

    protected function insert()
    {
        $columns = [];
        $values  = [];
        foreach ($this as $key => $value) {
            if ('id' == $key) {
                continue;
            }
            $columns[]       = $key;
            $values[":$key"] = $value;
        }

        $sql = 'INSERT INTO ' . static::TABLE
        . ' (' . implode(',', $columns) . ')'
        . ' VALUES (' . implode(',', array_keys($values)) . ')';

        $db = Db::instance();
        $db->execute($sql, $values);

        $this->id = $db->insertedId();
    }

    protected function update()
    {
        $values    = [];
        $setString = [];
        foreach ($this as $key => $value) {
            if ('id' == $key) {
                continue;
            }
            $values[':' . $key] = $value;
            $setString[]        = $key . '=:' . $key;
        }

        $sql = 'UPDATE ' . static::TABLE
        . ' SET ' . implode(',', $setString)
            . ' WHERE id=:id';
        $values[':id'] = $this->id;

        $db = Db::instance();
        $db->execute($sql, $values);
    }

    protected function isNew()
    {
        return empty($this->id);
    }

    public function save()
    {
        if ($this->isNew()) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . static::TABLE
            . ' WHERE id=:id';
        $db = Db::instance();
        $db->execute($sql, [':id' => $this->id]);
    }

    public static function findAll()
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            [],
            static::class
        );
    }

    public static function findById($id)
    {
        $db = Db::instance();
        $result = $db->query(
            'SELECT * FROM ' . static::TABLE
            . ' WHERE id=:id',
            [':id' => $id],
            static::class
        );
        if (!empty($result)) {
            return $result[0];
        }
        return false;
    }

    public static function findBySocialId($social_id, $social_name)
    {
        $db     = Db::instance();
        $result = $db->query(
            'SELECT * FROM ' . static::TABLE
            . ' WHERE social_id=:social_id
                AND social_name=:social_name',
            [
                ':social_id'   => $social_id,
                ':social_name' => $social_name,
            ],
            static::class
        );

        if (!empty($result)) {
            return $result[0];
        }
        return false;
    }
}
