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
    <?php if($Added == 1): ?><h1>Added New Row to Database</h1>
    <?php elseif($Added == 2): ?><h1>Selected options are in database</h1>
    <?php endif; ?>
    <form action="index.php?controller=Test&func=index" method="post">
        <fieldset>
            <label>Select a test: </label>
            <select name="tests" id="tests">
                <option selected="selected"></option>
                <?php foreach ($Tests as $key => $value) {
                    ?><option value="<?php echo $value['exam_id'];?>"><?php echo $value['name'];?></option><?php
                } ?>
            </select>
            <div id="div-students">
                <label>Select student: </label>
                <select name="students" id="students"></select>
            </div>
            <div id="div-marks">
                <label>Select mark: </label>
                <select name="marks" id="marks">
                    <?php for ($i = 0; $i < 101; $i++) {
                        ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php
                    } ?>
                </select>
            </div>
            <input id="submit" type="submit" value="Submit">
        </fieldset>
    </form>
    
    <footer>
        <p>Copyright by: Machey Nowakowski</p>
        <p><time pubdate datetime="2019-10-19"></time></p>
    </footer> 
</article>
<script>
    $( document ).ready(function() {
        jQuery('#div-students').hide();
        jQuery('#div-marks').hide();
        jQuery('#submit').hide();
    });
    $('#tests').change(function(){
        $('#students').empty();
        jQuery('#div-students').hide();
        jQuery('#div-marks').hide();
        jQuery('#submit').hide();
        var aSelectedResult = $("#tests option:selected").get();
        var aValue = $.map(aSelectedResult, function(element){
                return $(element).attr("value");
            });
        var aData = <?php echo json_encode($Students); ?>;
        if(aValue.toString()) {
            jQuery('#div-students').show();
            $('#students').append("<option></option>");
            $.each(aData[aValue], function(key, value) {
                $('#students').append("<option value="+value["student_id"].toString()+">"+value["name"].toString()+"</option>");
            });
        }
    });
    $('#students').change(function(){
        jQuery('#div-marks').hide();
        jQuery('#submit').hide();
        var aSelectedResult = $("#students option:selected").get();
        var aValue = $.map(aSelectedResult, function(element){
                return $(element).attr("value");
            });
        if(aValue.toString()) {
            jQuery('#div-marks').show();
            jQuery('#submit').show();
        }
    });
</script>
</body>
</html>