<?php

namespace Core;

const DSN = "mysql:host=serwer2266263.home.pl;port=3306;dbname=35651204_octadecimal";
const DB_USER = "35651204_octadecimal";
const DB_PASSWORD = "8&Pa!?18";

use Exception;
use \PDO;

class Database
{
    private static $instance;

    public static function getInstance(): PDO
    {
        if (!isset(Database::$instance)) {
            Database::initDb();
        }
        return Database::$instance;
    }

    private static function initDb(): void
    {
        try {
            Database::$instance = new PDO(
                DSN,
                DB_USER,
                DB_PASSWORD
            );
        } catch (Exception $ex) {
            error_log("Unable to set up db connection: " . DSN);
            die(500);
        }
    }
}