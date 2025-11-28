<?php
declare(strict_types=1);

require __DIR__ . '/auth/session.php';
require __DIR__ . '/config/db.php';

$pdo = db();
$message = '';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = trim($_POST['nom_prod'] ?? '');
        $precio = (int)($_POST['precio'] ?? 0);
        $tipo = (int)($_POST['fk_tprod'] ?? 0);
        $id = isset($_POST['id_producto']) ? (int)$_POST['id_producto'] : null;

        if ($nombre === '' || $precio <= 0 || $tipo <= 0) {
            $message = 'Todos los campos son obligatorios y deben ser válidos.';
        } else {
            if ($id) {
                $stmt = $pdo->prepare('UPDATE productos SET nom_prod = ?, precio = ?, fk_tprod = ? WHERE id_producto = ?');
                $stmt->execute([$nombre, $precio, $tipo, $id]);
                $message = 'Producto actualizado correctamente.';
            } else {
                $stmt = $pdo->prepare('INSERT INTO productos (nom_prod, precio, fk_tprod) VALUES (?, ?, ?)');
                $stmt->execute([$nombre, $precio, $tipo]);
                $message = 'Producto creado correctamente.';
            }
        }
    }

    if (isset($_GET['delete'])) {
        $id = (int)$_GET['delete'];
        $stmt = $pdo->prepare('DELETE FROM productos WHERE id_producto = ?');
        $stmt->execute([$id]);
        $message = 'Producto eliminado.';
    }
} catch (PDOException $e) {
    $message = 'Error en la operación: ' . $e->getMessage();
}

$editar = null;
if (isset($_GET['edit'])) {
   $id = filter_input(INPUT_GET, 'edit', FILTER_VALIDATE_INT);
    $stmt = $pdo->prepare('SELECT * FROM productos WHERE id_producto = ?');
    $stmt->execute([$id]);
    $editar = $stmt->fetch();
}

$productos = $pdo->query('SELECT p.*, t.nom_tprod FROM productos p INNER JOIN tipo_prod t ON p.fk_tprod = t.id_tipo_prod ORDER BY p.id_producto DESC')->fetchAll();
$tipos = $pdo->query('SELECT * FROM tipo_prod ORDER BY nom_tprod')->fetchAll();

require __DIR__ . '/includes/header.php';
?>

<section>
    <h2>Productos</h2>
    <?php if ($message): ?>
        <p class="alert alert-info"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <div class="grid-2">
        <article>
            <h3><?php echo $editar ? 'Editar producto' : 'Nuevo producto'; ?></h3>
            <form method="post" class="form">
                <?php if ($editar): ?>
                    <input type="hidden" name="id_producto" value="<?php echo (int)$editar['id_producto']; ?>">
                <?php endif; ?>
                <label>
                    Nombre
                    <input type="text" name="nom_prod" maxlength="20" value="<?php echo htmlspecialchars($editar['nom_prod'] ?? ''); ?>" required>
                </label>
                <label>
                    Precio
                    <input type="number" name="precio" min="1" value="<?php echo htmlspecialchars($editar['precio'] ?? ''); ?>" required>
                </label>
                <label>
                    Tipo
                    <select name="fk_tprod" required>
                        <option value="">Selecciona...</option>
                        <?php foreach ($tipos as $tipo): ?>
                            <option value="<?php echo (int)$tipo['id_tipo_prod']; ?>" <?php echo (!empty($editar['fk_tprod']) && (int)$editar['fk_tprod'] === (int)$tipo['id_tipo_prod']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($tipo['nom_tprod']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <button type="submit" class="btn btn-primary"><?php echo $editar ? 'Actualizar' : 'Crear'; ?></button>
                <?php if ($editar): ?>
                    <a class="btn btn-secondary" href="productos.php">Cancelar</a>
                <?php endif; ?>
            </form>
        </article>

        <article>
            <h3>Listado</h3>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($productos as $prod): ?>
                    <tr>
                        <td><?php echo (int)$prod['id_producto']; ?></td>
                        <td><?php echo htmlspecialchars($prod['nom_prod']); ?></td>
                        <td>$<?php echo number_format((int)$prod['precio'], 0, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($prod['nom_tprod']); ?></td>
                        <td>
                            <a class="btn btn-link" href="productos.php?edit=<?php echo (int)$prod['id_producto']; ?>">Editar</a>
                            <a class="btn btn-link link-danger" href="productos.php?delete=<?php echo (int)$prod['id_producto']; ?>" onclick="return confirm('¿Eliminar este producto?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </article>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

