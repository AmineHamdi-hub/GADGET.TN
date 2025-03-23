<?php
$title = 'Modifier Produit';
ob_start();
?>
<div style="max-width: 600px; margin: 50px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h2 style="text-align: center; margin-bottom: 20px; color: #333333;">Modifier Produit</h2>
    <form action="Adminpage.php?action=updateProduct&id=<?php echo $product->getId(); ?>" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
        
        <!-- Nom du Produit -->
        <label for="name" style="font-weight: bold; color: #555;">Nom du Produit:</label>
        <input type="text" id="name" name="name" value="<?php echo $product->getName(); ?>" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        
        <!-- Prix -->
        <label for="price" style="font-weight: bold; color: #555;">Prix Unitaire:</label>
        <input type="text" id="price" name="price" value="<?php echo $product->getPrice(); ?>" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        
        <!-- Quantité -->
        <label for="stock" style="font-weight: bold; color: #555;">Quantité (Stock):</label>
        <input type="text" id="stock" name="stock" value="<?php echo $product->getStock(); ?>" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        
        <!-- Description -->
        <label for="description" style="font-weight: bold; color: #555;">Description:</label>
        <input type="text" id="description" name="description" value="<?php echo $product->getDescription(); ?>" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        
        <!-- ID de Catégorie -->
        <label for="categoryId" style="font-weight: bold; color: #555;">Catégorie:</label>
        <input type="text" id="categoryId" name="categoryId" value="<?php echo $product->getCategoryId(); ?>" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        
        <!-- Image -->
        <label for="image" style="font-weight: bold; color: #555;">Image:</label>
        <input type="text" id="image" name="image" value="<?php echo $product->getImage(); ?>" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        
        <!-- Affichage de l'Image Actuelle -->
        <?php if ($product->getImage()): ?>
            <p>Image actuelle:</p>
            <img src="<?php echo $product->getImage(); ?>" alt="Product Image" style="display: block; margin: 10px auto; max-width: 100px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <?php endif; ?>
        
        <!-- Boutons de soumission et retour -->
        <div style="display: flex; justify-content: space-between;">
            <input type="submit" class="btn btn-primary btn-sm" value="Mettre à jour" style="padding: 10px 20px; color: #fff; background-color: #007bff; border: none; border-radius: 4px; cursor: pointer; margin-top: 20px;">
            <a href="Adminpage.php?action=findAllProduct" style="padding: 10px 20px; color: #fff; background-color: #007bff; border: none; border-radius: 4px; text-decoration: none; text-align: center; margin-top: 20px;">Retour</a>
        </div>
    </form>
</div>
<?php
$content = ob_get_clean();
require_once('App/view/layouts/AdminLayout.php');
?>
