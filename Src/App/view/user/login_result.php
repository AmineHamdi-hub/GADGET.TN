<?php
$title = 'signin status';
ob_start();
?>
    <h1>Login Status</h1>
    <p><?php echo htmlspecialchars($result['message']); ?></p>
    <?php if ($result['success']): ?>
        <a href="index.php">Home</a>
    <?php else: ?>
        <a href="index.php?action=login">Retry</a>
    <?php endif; ?>
<?php $content = ob_get_clean();
require_once('App/view/layouts/UserLayout.php');?>
