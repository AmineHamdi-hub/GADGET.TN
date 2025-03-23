<?php
$title = 'Liste des Produits';
ob_start();
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        padding: 20px;
    }

    .table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px 15px;
        text-align: center;
        border: 1px solid #dee2e6;
    }

    .table th {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }

    .btn {
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        margin: 0 5px;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #fff;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-sm {
        font-size: 12px;
        padding: 6px 10px;
    }

    .btn:hover {
        opacity: 0.8;
    }

    .add-button {
        margin-top: 20px;
        display: block;
        text-align: right;
    }

</style>

<table class="table table-striped">
    <tr>
        <th>Id</th>
        <th>Nom du Produit</th>
        <th>Prix</th>
        <th>Stock</th>
        <th>Action</th>
    </tr>
    <?php foreach($products as $p) { ?>
    <tr>
        <td> <?php echo $p->getId() ?> </td>
        <td> <?php echo $p->getName() ?> </td>
        <td> <?php echo $p->getPrice() ?> </td>
        <td> <?php echo $p->getStock() ?> </td>
        <td>
            <a href="Adminpage.php?action=editProduct&id=<?php echo $p->getID() ?>" class="btn btn-warning btn-sm">Modifier</a>
            <a href="Adminpage.php?action=destroyProduct&id=<?php echo $p->getID() ?>" class="btn btn-danger btn-sm">Supprimer</a>
        </td>
    </tr>
    <?php } ?>
</table>

<div class="add-button">
    <a href="Adminpage.php?action=addProduct" class="btn btn-primary btn-sm">Ajouter un Produit</a>
</div>

<?php
$content = ob_get_clean();
require_once('App/view/layouts/AdminLayout.php');
?>
