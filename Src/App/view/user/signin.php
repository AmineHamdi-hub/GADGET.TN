<?php
$title = 'Se connecter';
ob_start();
?>
    <h1>Se connecter</h1>
    <form action="index.php?action=login" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br>

    <button type="submit">Se connecter</button>
    </form>
<?php $content = ob_get_clean();
require_once('App/view/layouts/UserLayout.php');?>
