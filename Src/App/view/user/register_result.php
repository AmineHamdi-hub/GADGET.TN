<?php
$title = 'Register status';
ob_start();
?>
    <h1>Registration Status</h1>
    <p><?php echo htmlspecialchars($result['message']); ?></p>
    <?php if ($result['success']): ?>
        <a href="?action=login">Login</a>
    <?php else: ?>
        <a href="?action=register">Try Again</a>
    <?php endif; ?>
<?php $content = ob_get_clean();
require_once('App/view/layouts/UserLayout.php');?>
