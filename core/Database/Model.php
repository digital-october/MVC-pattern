<?php

namespace Core\Database;

use Core\Registry;

abstract class Model
{
    protected $table;
    protected $db;
    protected $atributes = [];
    protected $relation;
    protected $modelName;
    protected $orderBy;


    public function __construct(array $atributes = [])
    {
        $this->table = $this->setTableName();
        $this->db = Registry::db();
        $this->modelName = get_called_class();

        foreach ($atributes as $key => $item) {
            $this->atributes[$key] = $item;
        }
    }


    public function getTable()
    {
        return $this->table;
    }


    public function setTableName()
    {
        $tableExplode = explode('\\', get_called_class());
        return $tableExplode[count($tableExplode) - 1];
    }


    public function get()
    {
        $query = "SELECT * FROM `{$this->table}`";

        $result = $this->db->query($query);

        $list = [];
        foreach ($result as $item) {
            $class = get_called_class();
            $model = new $class($item);

            $list[] = $model;
        }
        return $list;
    }


    public function orderBy($field, $sort)
    {
        $this->orderBy = "ORDER BY $field $sort";
        return $this;
    }


    public function getWith($model, $forget, $local)
    {
        $table = (new $model())->getTable();
        $columns = $this->db->getColumns($table, function ($column) use ($table) {
            return "$table.{$column['Field']} as {$table}__{$column['Field']}";
        });
        $columns = implode(',', $columns);

        $query = "SELECT {$this->table}.*, {$columns} FROM `{$this->table}`
                  LEFT JOIN `{$table}`
                  ON {$this->table}.`{$local}` = {$table}.`{$forget}`
                  {$this->orderBy}
                  ";

        $result = $this->db->query($query);

        $list = [];
        foreach ($result as $itemKey => $item) {
            $relation = new $model();
            foreach ($item as $column => $value) {
                $column = explode('__', $column);
                if ($column[0] == $table) {
                    $relation->{$column[1]} = $value;
                }
            }
            $class = get_called_class();
            $model = new $class($item);
            $model->{$table} = $relation;
            $list[] = $model;
        }
        return $list;
    }


    public function find($id)
    {
        $query = "SELECT * FROM `{$this->table}` WHERE `id` = {$id}";

        $result = $this->db->query($query)[0];
        return new $this->modelName($result);
    }


    public function save()
    {
        $fields = array_keys($this->atributes);
        $fieldsString = implode(',', $fields);

        if (array_key_exists('id', $this->atributes)) {
            $fieldsString = [];
            foreach ($this->atributes as $key => $item) {
                $fieldsString[] = "`{$key}` = '{$item}'";
            }
            $fieldsString = implode(',', $fieldsString);

            $query = "UPDATE `{$this->table}` SET {$fieldsString} WHERE `id` = {$this->atributes['id']}";

            $sth = $this->db->getPdo()->prepare($query);
            $sth->execute();
        } else {
            $fieldsLabel = str_repeat('?, ', count($fields) - 1);
            $query = "INSERT INTO {$this->table} ({$fieldsString}) VALUES ({$fieldsLabel} ?)";

            $sth = $this->db->getPdo()
                ->prepare($query);
            $sth->execute(array_values($this->atributes));
        }
    }


    public function __get($name)
    {
        return isset($this->atributes[$name]) ? $this->atributes[$name] : null;
    }


    public function __set($name, $value)
    {
        $this->atributes[$name] = $value;
    }
}