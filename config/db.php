<?php

/* 
 * Copyright 2014 mcn.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

class Db {
    private static $db;
    private static $dbhost = 'localhost';
    private static $dbuser = 'root';
    private static $dbpass = 'Pegaz123';
    private static $dbname = 'management_systems_db';
     
    public static function init() {
        if (!self::$db) {
            try {
                $dsn = "mysql:host=".self::$dbhost.";dbname=".self::$dbname.";charset=utf8";
                self::$db = new PDO($dsn, self::$dbuser, self::$dbpass);
            } catch (PDOException $e) {
                error_log($e->getMessage());
                die("A database error was encountered -> " . $e->getMessage() );
            }
        }
        return self::$db;
    }
}

