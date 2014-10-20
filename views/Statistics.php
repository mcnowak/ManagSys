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

?>

<!DOCTYPE html>
<html>
<head>
<script src="./jquery/jquery/jquery.js"></script>
</head>
<body>

<article>
    <header>
        <h1>Statistics</h1>
        
        <nav>
            <h1>Navigation</h1>
            <ul>
                <li><a href="index.php">Back to home page</a></li>
                <li><a href="index.php?controller=Test&func=index">Add Test Scores</a></li>
            </ul>
        </nav>
    </header>
    <fieldset>
        <label>Select a test: </label>
        <select name="tests" id="tests">
            <option value="" selected="selected"></option>
            <?php foreach ($GradeData as $key => $value) {
                ?><option value="<?php echo $value['exam_id'];?>"><?php echo $value['year']." - ".$value['grade'].$value['section']." - ".$value['course']." \"".$value['exam']."\"";?></option><?php
            } ?>
        </select>
    </fieldset>
    
    <table id="StudentsMarks" border="1" style="width:300px"></table>
    </br>
    <table id="AverageScores" border="1" style="width:300px"></table>
    </br>
    
    <fieldset>
        <label>Select students across all tests of year: </label>
        <select name="students" id="students">
            <option value="" selected="selected"></option>
            <?php foreach ($Students as $key => $value) {
                ?><option value="<?php echo $key;?>"><?php echo "\"".$value['StudentName']."\" - ".$value['year']." - ".$value['grade'].$value['section'];?></option><?php
            } ?>
        </select>
    </fieldset>
    
    <table id="Students" border="1" style="width:300px"></table>
    
    <footer>
        <p>Copyright by: Machey Nowakowski</p>
        <p><time pubdate datetime="2019-10-19"></time></p>
    </footer> 
</article>
<script>
    $('#tests').change(function(){
        $('#StudentsMarks').empty();
        $('#AverageScores').empty();
        var aSelectedResult = $("#tests option:selected").get();
        var aValue = $.map(aSelectedResult, function(element){
                return $(element).attr("value");
            });
        var aData = <?php echo json_encode($StudentsMarks); ?>;
        if(aValue.toString()) makeTables(aData[aValue]);
    });
    function makeTables(data) {
        var rowSM = $("<tr/>");
        rowSM.append($("<th/>").text("Name"));
        rowSM.append($("<th/>").text("Mark"));
        $('#StudentsMarks').append(rowSM);
        $.each(data, function(key, value) {
            var rowSM = $("<tr/>");
            $.each(value, function(keyIndex, c) {
                rowSM.append($("<td/>").text(c));
            });
            $('#StudentsMarks').append(rowSM);
        });
        
        var rowAS = $("<tr/>");
        rowAS.append($("<th/>").text("Test Average Score"));
        rowAS.append($("<th/>").text("Students Below Average Score"));
        $('#AverageScores').append(rowAS);
        var rowAS = $("<tr/>");
        rowAS.append($("<td/>").text(data['TestAverageScore'].toString()));
        rowAS.append($("<td/>").text(data['StudentsBelowAverageScore'].toString()));
        $('#AverageScores').append(rowAS);
    }
    $('#students').change(function(){
        $('#Students').empty();
        var aSelectedResult = $("#students option:selected").get();
        var aValue = $.map(aSelectedResult, function(element){
                return $(element).attr("value");
            });
        var aData = <?php echo json_encode($Students); ?>;
        if(aValue.toString()) {
            var row = $("<tr/>");
            var avg = parseFloat(aData[aValue]['avg']);
            row.append($("<td/>").text(avg.toFixed(2).toString()));
            $('#Students').append(row);
        }
    });
</script>
</body>
</html>

