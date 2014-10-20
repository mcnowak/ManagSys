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

class Statistics extends View {
    public function index() {
        $iTeacherId = 1; //default value teacher id
        
        require_once './models/msStatistics.php';
        $dbStatistics = new msStatistics();
        $aStudentsMarks = $dbStatistics->getStudentsMarks();
        $aStudents = $dbStatistics->getStudents($iTeacherId);
        $aGradeData = $dbStatistics->getGradeData($iTeacherId);
        
        if (!empty($aStudentsMarks)) {
            foreach ($aStudentsMarks as $key => $value) {
                $arr_length = count($value);
                $iSumMarks = $this->testAverageScores($value);
                $aStudentsMarks[$key]['TestAverageScore'] = intval($iSumMarks / $arr_length);
            }
            
            foreach ($aStudentsMarks as $key => $value) {
                $aStudentsMarks[$key]['StudentsBelowAverageScore'] = $this->studentsBelowAverageScore($value, $aStudentsMarks[$key]['TestAverageScore']);
            }
        }

        $this->assign("StudentsMarks", $aStudentsMarks);
        $this->assign("GradeData", $aGradeData);
        $this->assign("Students", $aStudents);
    }
    
    private function testAverageScores($aStudentsMarks = array()) {        
        if (!empty($aStudentsMarks)) {
            $iSumMarks = 0;
            foreach ($aStudentsMarks as $value) {
                    $iSumMarks += (int) $value['marks'];
            }
            return $iSumMarks;
        } else {
            return false;
        }
    }
    
    private function studentsBelowAverageScore($aStudentsMarks = array(), $testAverageScore = NULL) {
        if (!empty($aStudentsMarks) && !empty($testAverageScore)) {
            $iSumBelowStudents = 0;
            foreach ($aStudentsMarks as $value) {
                if ($testAverageScore > $value['marks'] && !empty($value['marks'])) {
                    $iSumBelowStudents++;
                }
            }
            return $iSumBelowStudents;
        } else {
            return false;
        }
    }
}

