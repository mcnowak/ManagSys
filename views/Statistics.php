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
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>

<article>
    <header>
        <h1>Statistics</h1>
    </header>
    <form action="#">
        <fieldset>
            <label for="test">Select a test</label>
                <select name="tests" id="test">
                    <option selected="selected"></option>
                    <option>1</option>
                </select>
        </fieldset>
    </form>
    
    <footer>
        <p>Copyright by: Maciej Nowakowski</p>
        <p><time pubdate datetime="2019-10-09"></time></p>
    </footer> 
</article>
<script>
    $(document).ready(function(){
        $("#btn1").click(function(){
            $("#test1").text("Hello world!");
        });
        $("#btn2").click(function(){
            $("#test2").html("<b>Hello world!</b>");
        });
        $("#btn3").click(function(){
            $("#test3").val("Dolly Duck");
        });
    });
</script>
</body>
</html>

