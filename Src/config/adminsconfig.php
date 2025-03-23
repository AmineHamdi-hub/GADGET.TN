<?php
$password1 = password_hash('admin123', PASSWORD_DEFAULT);
$password2 = password_hash('securepass456', PASSWORD_DEFAULT);
$password3 = password_hash('mypassword789', PASSWORD_DEFAULT);
echo 'mp1';
echo $password1;
echo 'mp2';
echo $password2;
echo 'mp3';
echo $password3;
?>
