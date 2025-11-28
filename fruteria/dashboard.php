<?php
declare(strict_types=1);

require __DIR__ . '/auth/session.php';

require __DIR__ . '/includes/header.php';
?>

<section class="dashboard">
    <h2>Panel principal</h2>
    <p>Bienvenido, <?= htmlspecialchars($_SESSION['user']) ?>.</p>
    <div class="card-grid">
        <article class="card">
            <h3>Gestión de productos</h3>
            <p>Administra el catálogo completo de frutas.</p>
            <a class="btn btn-secondary" href="productos.php">Ir a productos</a>
        </article>
        <article class="card">
            <h3>Tipos de producto</h3>
            <p>Controla las categorías como ácidas o neutras.</p>
            <a class="btn btn-secondary" href="tipo_prod.php">Ir a tipos</a>
        </article>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

