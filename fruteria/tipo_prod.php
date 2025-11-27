<?php
declare(strict_types=1);

require __DIR__ . '/auth/session.php';
require __DIR__ . '/config/db.php';

$pdo = db();
$message = '';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = trim($_POST['nom_tprod'] ?? '');
        $id = isset($_POST['id_tipo_prod']) ? (int)$_POST['id_tipo_prod'] : null;

        if ($nombre === '') {
            $message = 'El nombre es obligatorio.';
        } else {
            if ($id) {
                $stmt = $pdo->prepare('UPDATE tipo_prod SET nom_tprod = ? WHERE id_tipo_prod = ?');
                $stmt->execute([$nombre, $id]);
                $message = 'Tipo actualizado.';
            } else {
                $stmt = $pdo->prepare('INSERT INTO tipo_prod (nom_tprod) VALUES (?)');
                $stmt->execute([$nombre]);
                $message = 'Tipo creado.';
            }
        }
    }

    if (isset($_GET['delete'])) {
        $id = (int)$_GET['delete'];

        $stmt = $pdo->prepare('SELECT COUNT(*) AS total FROM productos WHERE fk_tprod = ?');
        $stmt->execute([$id]);
        $total = (int)$stmt->fetchColumn();

        if ($total > 0) {
            $message = 'No puedes eliminar este tipo porque tiene productos asociados.';
        } else {
            $stmt = $pdo->prepare('DELETE FROM tipo_prod WHERE id_tipo_prod = ?');
            $stmt->execute([$id]);
            $message = 'Tipo eliminado.';
        }
    }
} catch (PDOException $e) {
    $message = 'Error en la operación: ' . $e->getMessage();
}

$editar = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $pdo->prepare('SELECT * FROM tipo_prod WHERE id_tipo_prod = ?');
    $stmt->execute([$id]);
    $editar = $stmt->fetch();
}

$tipos = $pdo->query('SELECT * FROM tipo_prod ORDER BY id_tipo_prod DESC')->fetchAll();

require __DIR__ . '/includes/header.php';
?>

<section>
    <h2>Tipos de producto</h2>
    <?php if ($message): ?>
        <p class="alert alert-info"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <div class="grid-2">
        <article>
            <h3><?php echo $editar ? 'Editar tipo' : 'Nuevo tipo'; ?></h3>
            <form method="post" class="form">
                <?php if ($editar): ?>
                    <input type="hidden" name="id_tipo_prod" value="<?php echo (int)$editar['id_tipo_prod']; ?>">
                <?php endif; ?>
                <label>
                    Nombre
                    <input type="text" name="nom_tprod" maxlength="25" value="<?php echo htmlspecialchars($editar['nom_tprod'] ?? ''); ?>" required>
                </label>
                <button type="submit" class="btn btn-primary"><?php echo $editar ? 'Actualizar' : 'Crear'; ?></button>
                <?php if ($editar): ?>
                    <a class="btn btn-secondary" href="tipo_prod.php">Cancelar</a>
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
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tipos as $tipo): ?>
                    <tr>
                        <td><?php echo (int)$tipo['id_tipo_prod']; ?></td>
                        <td><?php echo htmlspecialchars($tipo['nom_tprod']); ?></td>
                        <td>
                            <a class="btn btn-link" href="tipo_prod.php?edit=<?php echo (int)$tipo['id_tipo_prod']; ?>">Editar</a>
                            <a class="btn btn-link link-danger" href="tipo_prod.php?delete=<?php echo (int)$tipo['id_tipo_prod']; ?>" onclick="return confirm('¿Eliminar este tipo?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </article>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

