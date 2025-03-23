<?php
include('inc/header_default.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'GADGET.TN'; ?></title>
    <style>
        /* Global reset for margin and padding */
        
        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        /* Additional styles for user profile and login pages */
        .profile-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-header h1 {
            font-size: 24px;
            color: #333;
        }

        .profile-info, .profile-actions {
            margin-bottom: 20px;
        }

        .profile-info p {
            font-size: 16px;
            color: #666;
        }

        .profile-info strong {
            color: #333;
        }

        .profile-actions form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .profile-actions input[type="password"],
        .profile-actions input[type="email"] {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .profile-actions button {
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .profile-actions button:hover {
            background-color: #2980b9;
        }

        .logout-button {
            display: block;
            width: 100%;
            text-align: center;
            padding: 10px 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        /* Contact page */
        .contact-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contact-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-header h1 {
            font-size: 24px;
            color: #333;
        }

        .contact-form label {
            font-size: 14px;
            color: #555;
        }

        .contact-form input[type="text"],
        .contact-form input[type="email"],
        .contact-form textarea {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
            width: 100%;
            margin-bottom: 15px;
        }

        .contact-form button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<?php 
// Ensure that $content is set before echoing, or provide a default message.
echo isset($content) ? $content : 'Contenu non disponible'; 
?>

</body>
</html>
