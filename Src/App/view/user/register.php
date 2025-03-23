<?php
$title = 'Register';
ob_start();
?>
<h1>Register</h1>
<form action="index.php?action=register" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <button type="submit">Register</button>
</form>
    <?php $content = ob_get_clean();
require_once('App/view/layouts/UserLayout.php');?>
