<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frutería</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header class="main-header">
    <div class="header-logo-container">
        <img src="assets/images/logo.png" alt="Logo Frutería Los Cardona" class="header-logo">
    </div>
    <h1 class="header-title">Frutería Los Cardona</h1>
    <?php if (!empty($_SESSION['user'])): ?>
        <nav class="header-nav">
            <a href="dashboard.php">Inicio</a>
            <a href="productos.php">Productos</a>
            <a href="tipo_prod.php">Tipos</a>
            <a href="auth/logout.php" class="link-danger">Salir</a>
        </nav>
    <?php endif; ?>
</header>
<main class="container">

