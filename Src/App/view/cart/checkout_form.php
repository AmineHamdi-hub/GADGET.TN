<?php
$title = 'Validation de la commande';
ob_start();
?>

<h1>Validation de la commande</h1>
<form action="index.php?action=checkout" method="POST">
    <label for="address">Adresse de livraison :</label>
    <textarea name="address" id="address" rows="4" cols="50" required></textarea>
    <br><br>
    <button type="submit">Passer la commande</button>
</form>

<?php
$content = ob_get_clean();
require_once 'App/view/layouts/UserLayout.php';
?>
