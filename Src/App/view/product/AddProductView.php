<?php
$title = 'Ajouter Produit';
ob_start();
?>
<div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9;">
    <h2 style="text-align: center; color: #333;">Ajouter un Produit</h2>
    <form action="Adminpage.php?action=insertProduct" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
        
        <!-- Nom du Produit -->
        <label for="nom" style="font-weight: bold; color: #555;">Nom du Produit:</label>
        <input type="text" id="nom" name="name" placeholder="Entrez le nom du produit" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">

        <!-- Prix Unitaire -->
        <label for="prix" style="font-weight: bold; color: #555;">Prix Unitaire:</label>
        <input type="number" id="prix" name="price" placeholder="Entrez le prix unitaire" required step="0.01" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">

        <!-- Quantité -->
        <label for="stock" style="font-weight: bold; color: #555;">Quantité:</label>
        <input type="number" id="stock" name="stock" placeholder="Entrez la quantité disponible" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">

        <!-- Description -->
        <label for="description" style="font-weight: bold; color: #555;">Description:</label>
        <textarea id="description" name="description" rows="4" placeholder="Entrez la description du produit" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></textarea>

        <!-- Catégorie -->
        <label for="categoryId" style="font-weight: bold; color: #555;">Catégorie:</label>
        <select id="categoryId" name="categoryId" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            <option value="1">Homme</option>
            <option value="2">Femme</option>
            <option value="3">Électroniques</option>
            <option value="4">Sport</option>
            <option value="5">Maison</option>
            <option value="6">Cosmétiques</option>
        </select>

        <!-- Image -->
        <label for="image" style="font-weight: bold; color: #555;">Image du Produit:</label>
        <input type="file" id="image" name="image" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">

        <!-- Boutons de soumission -->
        <div style="display: flex; justify-content: space-between;">
            <button type="submit" name="addProduct" style="padding: 10px 20px; color: #fff; background-color: #28a745; border: none; border-radius: 4px; cursor: pointer;">Ajouter</button>
            <a href="Adminpage.php?action=findAllProduct" style="padding: 10px 20px; color: #fff; background-color: #007bff; border: none; border-radius: 4px; text-decoration: none; text-align: center;">Retour</a>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
require_once('App/view/layouts/AdminLayout.php');
?>
