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

class msTest extends Model {   
    public function getTests() {
        $sql = "SELECT e.exam_id, e.name "
                . "FROM exam e "
                . "ORDER BY e.date DESC, e.name ASC";
        $this->_setSql($sql);
        $aTest = $this->getAll(null, PDO::FETCH_ASSOC);
         
        if(empty($aTest)) return false;
         
        return $aTest;
    }
    
    public function getStudents($iTeacherId) {
        $sql = "SELECT e.exam_id, s.student_id, CONCAT_WS(\" \", s.first_name, s.last_name) as name "
                . "FROM student s, grade_section gs, grade g, course c, exam e, classroom cl, teacher t "
                . "WHERE s.student_id = gs.student_id AND gs.grade_id = g.grade_id AND c.grade_id = g.grade_id AND c.course_id = e.course_id AND "
                . "gs.classroom_id = cl.classroom_id AND cl.teacher_id = t.teacher_id AND t.teacher_id = $iTeacherId "
                . "GROUP BY e.exam_id, s.student_id "
                . "ORDER BY s.student_id ASC";
        $this->_setSql($sql);
        $aStudents = $this->getAll(null, PDO::FETCH_GROUP|PDO::FETCH_ASSOC);
         
        if(empty($aStudents)) return false;
         
        return $aStudents;
    }
    
    public function addStudentMark($iExamId, $iStudentId, $iMark) {
        $sql = "INSERT INTO exam_result (exam_id,student_id,marks) VALUES (:exam_id,:student_id,:marks)";
        $this->_setSql($sql);
        
        $data = array();
        $data[':exam_id'] = $iExamId;
        $data[':student_id'] = $iStudentId;
        $data[':marks'] = $iMark;
        print_r($data);
        $bAdded = $this->insertRow($data);
         
        if(empty($bAdded)) return false;
         
        return $bAdded;
    }
}