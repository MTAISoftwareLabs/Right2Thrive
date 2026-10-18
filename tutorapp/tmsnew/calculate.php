<?php
$responses = $_POST['responses'] ?? [];
$score = array_sum($responses);

$message = ($score >= 10) ? "Consider clinical follow-up." : "Minimal indication of depression.";

echo "Your score: $score<br>";
echo $message;
?>
