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

class msStatistics extends Model {    
    public function getGradeData($iTeacherId) {
        $sql = "SELECT cl.year, g.name as grade, se.name as section, co.name as course, e.name as exam, e.exam_id "
                . "FROM classroom cl, teacher t, grade g, section se, grade_section gs, course co, exam e "
                . "WHERE g.grade_id = co.grade_id AND co.course_id = e.course_id AND g.grade_id = gs.grade_id AND "
                . "gs.section_id = se.section_id AND gs.classroom_id = cl.classroom_id AND cl.teacher_id = t.teacher_id AND "
                . "t.teacher_id = $iTeacherId "
                . "GROUP BY e.exam_id "
                . "ORDER BY cl.year DESC, g.name ASC, se.name ASC, co.name ASC, e.date DESC";
        $this->_setSql($sql);
        $aGradeData = $this->getAll(null, PDO::FETCH_ASSOC);
         
        if(empty($aGradeData)) return false;
         
        return $aGradeData;
    }
    
    public function getStudentsMarks() {
        $sql = "SELECT er.exam_id, CONCAT_WS(\" \", s.first_name, s.last_name) as name, er.marks "
                . "FROM exam_result er, student s "
                . "WHERE er.student_id = s.student_id "
                . "ORDER BY er.marks DESC";
        $this->_setSql($sql);
        $aStudentsMarks = $this->getAll(null, PDO::FETCH_GROUP|PDO::FETCH_ASSOC);
         
        if(empty($aStudentsMarks)) return false;
         
        return $aStudentsMarks;
    }
    
    public function getStudents($iTeacherId) {
        $sql = "SELECT cl.year, g.name as grade, se.name as section, CONCAT_WS(\" \", s.first_name, s.last_name) as StudentName, s.student_id, avg(er.marks) as avg "
                . "FROM classroom cl, teacher t, grade g, section se, grade_section gs, course co, exam e, exam_result er, student s "
                . "WHERE g.grade_id = co.grade_id AND co.course_id = e.course_id AND g.grade_id = gs.grade_id AND "
                . "gs.section_id = se.section_id AND gs.classroom_id = cl.classroom_id AND cl.teacher_id = t.teacher_id AND "
                . "er.exam_id = e.exam_id AND s.student_id = er.student_id AND gs.student_id = s.student_id AND "
                . "t.teacher_id = $iTeacherId "
                . "GROUP BY cl.year, g.name, se.name, StudentName "
                . "ORDER BY cl.year DESC, g.name ASC, se.name ASC, StudentName ASC, e.date DESC";
        $this->_setSql($sql);
        $aStudents = $this->getAll(null, PDO::FETCH_ASSOC);
         
        if(empty($aStudents)) return false;
         
        return $aStudents;
    }
}

