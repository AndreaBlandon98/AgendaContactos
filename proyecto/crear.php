<?php
include_once 'config/Database.php';
include_once 'models/Contacto.php';

$database = new Database();
$db = $database->getConnection();

$contacto = new Contacto($db);

if ($_POST) {
    $contacto->nombre = $_POST['nombre'];
    $contacto->apellido = $_POST['apellido'];
    $contacto->telefono = $_POST['telefono'];
    $contacto->email = $_POST['email'];
    $contacto->direccion = $_POST['direccion'];

    if ($contacto->crear()) {
        header('Location: index.php?success=true');
        exit();
    } else {
        header('Location: index.php?error=true');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
</head>
<body>
    <div class="container mt-4">
        <h2>Crear Contacto</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear Contacto</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <?php if (isset($_GET['success'])) { ?>
    <script>
        Swal.fire({
            title: 'Éxito',
            text: 'El contacto se ha creado con éxito.',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    </script>
    <?php } elseif (isset($_GET['error'])) { ?>
    <script>
        Swal.fire({
            title: 'Error',
            text: 'Hubo un error al crear el contacto.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    </script>
    <?php } ?>

</body>
</html>
