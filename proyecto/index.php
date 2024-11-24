<?php
include_once 'config/Database.php';
include_once 'models/Contacto.php';

$database = new Database();
$db = $database->getConnection();

$contacto = new Contacto($db);
$stmt = $contacto->leer();


if (isset($_GET['success'])) {
    $message = "La operación fue exitosa.";
    $type = "success"; 
} elseif (isset($_GET['error'])) {
    $message = "Hubo un error al procesar la operación.";
    $type = "error";  
} else {
    $message = "";
    $type = "";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contactos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4 text-center">Agenda de Contactos</h2>
    
   
    <a href="crear.php" class="btn btn-success mb-3">Agregar Nuevo Contacto</a>
    
   
    <?php if ($message) { ?>
    <script>
        Swal.fire({
            title: '<?php echo ucfirst($type); ?>',
            text: '<?php echo $message; ?>',
            icon: '<?php echo $type; ?>',
            confirmButtonText: 'Aceptar'
        });
    </script>
    <?php } ?>

    
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['apellido']; ?></td>
                    <td><?php echo $row['telefono']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['direccion']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="eliminar.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este contacto?');">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

