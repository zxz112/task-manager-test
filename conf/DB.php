<?php

namespace Conf;

class DB
{
    private $db;
    const USER = "root";
    const PASS = 'root';
    const HOST = 'localhost';
    const DB = 'task';

    public static function connect()
    {
        $db = self::DB;
        $user = self::USER;
        $host = self::HOST;
        $pass = self::PASS;
        return new \PDO("mysql:dbname=$db;host=$host", $user, $pass);
    }
}
