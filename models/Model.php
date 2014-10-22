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

require('./config/db.php'); 

class Model extends Db {
    protected $_db;
    protected $_sql;
     
    public function __construct() {
        $this->_db = Db::init();
    }
     
    protected function _setSql($sql) {
        $this->_sql = $sql;
    }
     
    public function getAll($data = null, $fetch_style = null) {
        if (!$this->_sql) {
            throw new Exception("No SQL query!");
        }
         
        $db = $this->_db->prepare($this->_sql);
        $db->execute($data);        
        return $db->fetchAll($fetch_style);
    }
     
    public function getRow($data = null, $fetch_style = null) {
        if (!$this->_sql) {
            throw new Exception("No SQL query!");
        }
         
        $db = $this->_db->prepare($this->_sql);
        $db->execute($data);
        return $db->fetch($fetch_style);
    }
    
    public function insertRow($data = null) {
        if (!$this->_sql) {
            throw new Exception("No SQL query!");
        }
         
        $db = $this->_db->prepare($this->_sql);
        $db->execute($data);
    }
}

