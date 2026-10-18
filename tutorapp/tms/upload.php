<?php
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.

//$uploaddir = './upload/119/';
$uploaddir = '/home/careerp/public_html/tms/upload/119/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
echo '<pre>';
echo $uploadfile;
echo '</pre>';
echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}

echo 'Here is some more debugging info:';
print_r($_FILES);

print "</pre>";

?>