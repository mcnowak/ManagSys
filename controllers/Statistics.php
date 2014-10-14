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
        require_once './models/msStatistics.php';
        $db = new msStatistics();
        
        $aStudentsMarks = $db->getStudentsMarks();
        $aAveragedStudentsMarks = $this->averageScore($aStudentsMarks);
        $aGeneratedStudentsMarks = $this->belowAverageScore($aAveragedStudentsMarks);
        $this->assign("StudentsMarks", $aGeneratedStudentsMarks);/*
        if ($aGeneratedStudentsMarks != false) {
            session_start();
            $_SESSION["StudentsMarks"] = $aGeneratedStudentsMarks;

            header('Location: views/Statistics.php');
        }
        exit();*/
    }
    
    private function belowAverageScore($aAveragedStudentsMarks = array()) {
        if (!empty($aAveragedStudentsMarks)) {
            foreach ($aAveragedStudentsMarks as $sSubject => $aData) {
                $iSumBelowStudents = 0;
                $sDate = $aData[0]['date'];
                $arr_length = count($aData);
                for ($i = 0; $i < $arr_length; $i++) {
                    if ($aData[$sDate] > $aData[$i]['marks'] && !empty($aData[$i]['marks'])) {
                        $iSumBelowStudents++;
                    }
                }
                $aAveragedStudentsMarks[$sSubject]['below'] = $iSumBelowStudents;
            }
            return $aAveragedStudentsMarks;
        } else {
            return false;
        }
    }
    
    private function averageScore($aStudentsMarks = array()) {        
        if (!empty($aStudentsMarks)) {
            foreach ($aStudentsMarks as $sSubject => $aData) {
                $iSumMarks = 0;
                $arr_length = count($aData);
                for ($i = 0; $i < $arr_length; $i++) {
                    $iSumMarks += (int) $aData[$i]['marks'];
                }
                $iAverageScore = intval($iSumMarks / $i);
                $sDate = $aData[0]['date'];
                $aStudentsMarks[$sSubject][$sDate] = $iAverageScore;
            }
            return $aStudentsMarks;
        } else {
            return false;
        }
    }
}

