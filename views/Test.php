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
        <h1>Add Test Scores</h1>
        
        <nav>
            <h1>Navigation</h1>
            <ul>
                <li><a href="index.php">Back to home page</a></li>
                <li><a href="index.php?controller=Statistics&func=index">Statistics</a></li>
            </ul>
        </nav>
    </header>
    <?php if($Added == 1): ?><h1>Added New Row to Database</h1><?php endif; ?>
    <form action="index.php?controller=Test&func=index" method="post">
        <fieldset>
            <label>Select a test: </label>
            <select name="tests" id="tests">
                <option selected="selected"></option>
                <?php foreach ($Tests as $key => $value) {
                    ?><option value="<?php echo $value['exam_id'];?>"><?php echo $value['name'];?></option><?php
                } ?>
            </select>
            <label>Select student: </label>
            <select name="students" id="students"></select>
            <label>Select mark: </label>
            <select name="marks" id="marks">
                <?php for ($i = 0; $i < 101; $i++) {
                    ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php
                } ?>
            </select>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
    
    <footer>
        <p>Copyright by: Machey Nowakowski</p>
        <p><time pubdate datetime="2019-10-19"></time></p>
    </footer> 
</article>
<script>
    $('#tests').change(function(){
        $('#students').empty();
        var aSelectedResult = $("#tests option:selected").get();
        var aValue = $.map(aSelectedResult, function(element){
                return $(element).attr("value");
            });
        var aData = <?php echo json_encode($Students); ?>;
        if(aValue.toString()) {
            var rowS = $("");
            $.each(aData[aValue], function(key, value) {
                $('#students').append("<option value="+value["student_id"].toString()+">"+value["name"].toString()+"</option>");
            });
        }
    });
</script>
</body>
</html>