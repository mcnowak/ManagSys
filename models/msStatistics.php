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

class msStatistics extends Model{
    
    public function getStudentsMarks() {
        $sql = "SELECT e.subject, e.date, s.first_name, s.last_name, er.marks "
                . "FROM exam e, exam_result er, student s "
                . "WHERE s.student_id = er.student_id AND "
                . "e.exam_id = er.exam_id "
                . "ORDER BY er.marks DESC ";
                
         
        $this->_setSql($sql);
        $aStudentsMarks = $this->getAll(null, PDO::FETCH_GROUP);
         
        if(empty($aStudentsMarks)) return false;
         
        return $aStudentsMarks;
    }
}

