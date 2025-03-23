<?php
$title = 'Supprimer Produit';
ob_start();
?>
<div style="text-align: center; padding: 20px;">
    <p style="font-size: 18px; font-weight: bold; color: #333;">Voulez-vous vraiment supprimer ce produit ?</p>
    <p style="font-size: 16px; color: #555;">ID du produit : <span style="font-weight: bold;"><?php echo htmlspecialchars($id); ?></span></p>

    <div style="margin-top: 20px;">
        <a href="Adminpage.php?action=findAllProduct" 
           class="btn btn-warning btn-sm" 
           style="padding: 10px 20px; font-size: 14px; color: #fff; background-color: #f0ad4e; border: none; text-decoration: none; border-radius: 5px; margin-right: 10px;">
           Annuler la suppression
        </a>

        <a href="Adminpage.php?action=deleteProduct&id=<?php echo htmlspecialchars($id); ?>" 
           class="btn btn-danger btn-sm" 
           style="padding: 10px 20px; font-size: 14px; color: #fff; background-color: #d9534f; border: none; text-decoration: none; border-radius: 5px;">
           Valider la suppression
        </a>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once('App/view/layouts/AdminLayout.php');
?>
