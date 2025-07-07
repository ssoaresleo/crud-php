<?php
session_start();

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
} else {
    $message = null;
}
?>

<?php if ($message): ?>
    <div class="container mt-4">
        <div class="alert alert-<?php echo $message['type'] ?>" role="alert">
            <?= htmlspecialchars($message['text']) ?>
            <button class="btn btn-close btn-sm float-end" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    </div>
<?php endif; ?>