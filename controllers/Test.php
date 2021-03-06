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

class Test extends View {
    public function index() {
        $iTeacherId = 1; //default value teacher id
        $bAdded = 0;
        
        require_once './models/msTest.php';
        $dbTest = new msTest();
        $aTests = $dbTest->getTests();
        $aStudents = $dbTest->getStudents($iTeacherId);

        if(!empty($_POST['students'])) {
            $bResult = $dbTest->getExamResult($_POST['tests'], $_POST['students']);
            
            if(empty($bResult)) {
                $bAdded = $dbTest->addStudentMark($_POST['tests'], $_POST['students'], $_POST['marks']);
            } else {
                $bAdded = 2;
            }
        } 

        $this->assign("Added", $bAdded);
        $this->assign("Tests", $aTests);
        $this->assign("Students", $aStudents);
    }
}