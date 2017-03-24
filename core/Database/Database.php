<?php

namespace Core\Database;

class Database
{
    static protected $pdo;


    public function connection($host, $dbname, $user, $pass, $driver = 'mysql')
    {
        try{
        self::$pdo = new \PDO("$driver:host=$host;dbname=$dbname", $user, $pass);
        }catch (\Exception $e){
            print_r($e);
        }
    }


    public function query($query)
    {

        $result = self::$pdo->query($query);

        if ($result)
            $result = $result->fetchAll(\PDO::FETCH_ASSOC);
        else {
            print_r($this->db->getPdo()->errorInfo());
            exit;
        }

        return $result;
    }


    public function getColumns($table, callable $callback)
    {
        $columns = $this->query("SHOW COLUMNS FROM {$table}");
        $result = [];
        if($callback) {
            foreach ($columns as $column) {
                $result[] = $callback($column);
            }
            return $result;
        }
        return $columns;
    }


    public function prepare($query, $params)
    {
        $sth = $this->prepare($query);
        return $sth->execute($params);
    }

    public function getPdo(){
        return self::$pdo;
    }
}
