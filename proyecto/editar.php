<?php
include_once 'config/Database.php';
include_once 'models/Contacto.php';

$database = new Database();
$db = $database->getConnection();

$contacto = new Contacto($db);

if (isset($_GET['id'])) {
    $contacto->id = $_GET['id'];
    $stmt = $contacto->leer();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $contacto->nombre = $row['nombre'];
    $contacto->apellido = $row['apellido'];
    $contacto->telefono = $row['telefono'];
    $contacto->email = $row['email'];
    $contacto->direccion = $row['direccion'];
}

if ($_POST) {

    $contacto->nombre = $_POST['nombre'];
    $contacto->apellido = $_POST['apellido'];
    $contacto->telefono = $_POST['telefono'];
    $contacto->email = $_POST['email'];
    $contacto->direccion = $_POST['direccion'];

    if ($contacto->actualizar()) {
        echo "<script>alert('Contacto actualizado exitosamente');</script>";
        header('Location: index.php');
    } else {
        echo "<script>alert('Error al actualizar el contacto');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Editar Contacto</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $contacto->nombre; ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $contacto->apellido; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $contacto->telefono; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $contacto->email; ?>" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $contacto->direccion; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Contacto</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
