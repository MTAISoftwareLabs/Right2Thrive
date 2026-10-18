<?php

// phq9.php
$protocol = json_decode(file_get_contents('data.json'), true);
$questions = $protocol['tasks'][0]['questions'];


// form.php
echo '<form action="calculate.php" method="post">';
foreach ($questions as $index => $q) {
    echo "<label>{$q['text']}</label><br>";
    foreach ($q['options'] as $key => $option) {
        echo "<input type='radio' name='responses[{$index}]' value='{$key}' required> {$option}<br>";
    }
    echo "<br>";
}
echo '<input type="submit" value="Submit">';
echo '</form>';


?>