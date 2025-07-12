<?php

if (!isset($_SESSION)) {
  session_start();
}

$username = $_SESSION['user']['name']

?>

<nav class="navbar bg-white shadow-sm">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center w-100">
      <a href="/index.php" class="navbar-brand mb-0 h1">CRUD - PHP</a>
      <div class="d-flex align-items-center gap-3">
        <span><?= htmlspecialchars($username) ?></span>
        <a class="btn btn-outline-secondary btn-sm" href="logout.php">Sair da conta</a>
      </div>
    </div>
  </div>
</nav>