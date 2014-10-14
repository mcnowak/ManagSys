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
include_once 'views/View.php';
include_once 'models/Model.php';

class Controller {
    public function __construct() {
        //$name = $_GET["controller"];
        //include $name.".php";
        //$obj = new $name;
        //$obj->$_GET["func"]();
    }
    public function url($name, $func) {
        include $name.".php";
        $_POST["controller"] = $name;
        $obj = new $name;
        $obj->$func();
    }
}
