<?php include('inc/header.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'GADGET.TN'; ?></title>
    <link rel="stylesheet" href="inc/css/style.css">
    <style>
        /* Styles globaux pour toutes les pages */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
        }

        .categories {
            display: flex;
            justify-content: center;
            gap: 20px;
            background-color: #333;
            padding: 10px 0;
        }

        .categories a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .categories a:hover {
            background-color: #007bff;
        }

        /* Styles pour le contenu principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1, h2, h3 {
            color: #333;
            font-size: 24px;
            margin-bottom: 15px;
        }

        p {
            color: #666;
            font-size: 16px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="submit"], button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover, button:hover {
            background-color: #0056b3;
        }

        /* Section pour les liens de déconnexion et autres actions */
        .logout {
            text-align: center;
            margin-top: 20px;
        }

        .logout a {
            background-color: #dc3545;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
        }

        .logout a:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="categories">
    <a href="index.php?action=category&category_id=1">Homme</a>
    <a href="index.php?action=category&category_id=2">Femme</a>
    <a href="index.php?action=category&category_id=3">Electroniques</a>
    <a href="index.php?action=category&category_id=4">Sport</a>
    <a href="index.php?action=category&category_id=5">Pour Maison</a>
    <a href="index.php?action=category&category_id=6">Cosmétiques</a>
</div>

<div class="container">
    <?php
    // Display dynamic content based on the current action
    if (isset($content)) {
        echo $content;
    } else {
        // Default content or action if not set
        echo "<h2>Bienvenue sur GADGET.TN</h2>";
        echo "<p>Explorez nos catégories et découvrez nos produits.</p>";
    }
    ?>
</div>

</body>
</html>
