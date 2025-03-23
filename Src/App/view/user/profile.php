<?php
$title = 'Profile';
ob_start();
?>
<div class="profile-container">
        <h1>Welcome, <?php echo htmlspecialchars($user->getUsername()); ?>!</h1>

        <div class="profile-details">
            <h2>Your Profile Information</h2>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user->getUsername()); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user->getEmail()); ?></p>

            <h3>Change Password</h3>
            <form action="index.php?action=update_profile" method="POST">
                <input type="hidden" name="type" value="password">
                <label for="current_password">Current Password:</label>
                <input type="password" name="current_password" id="current_password" required>

                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>

                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>

                <button type="submit">Update Password</button>
            </form>

            <h3>Update Email</h3>
            <form action="index.php?action=update_profile" method="POST">
                <input type="hidden" name="type" value="email">
                <label for="new_email">New Email:</label>
                <input type="email" name="new_email" id="new_email" required>

                <button type="submit" name="update_email">Update Email</button>
            </form>
        </div>

        <div class="logout">
            <a href="logout.php">Log Out</a>
        </div>
<?php 
$content = ob_get_clean();
require_once('App/view/layouts/UserLayout.php');
?>
