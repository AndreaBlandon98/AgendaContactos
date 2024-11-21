<?php
include_once 'config/Database.php';
include_once 'models/Contacto.php';

$database = new Database();
$db = $database->getConnection();

$contacto = new Contacto($db);

if (isset($_GET['id'])) {
    $contacto->id = $_GET['id'];

    if ($contacto->eliminar()) {
     
        echo "<script>
            alert('Contacto eliminado exitosamente');
            window.location.href = 'index.php'; // Redirigir a la lista de contactos
        </script>";
    } else {
     
        echo "<script>
            alert('Error al eliminar el contacto');
            window.location.href = 'index.php'; // Redirigir a la lista de contactos
        </script>";
    }
} else {
  
    echo "<script>
        alert('ID no válido');
        window.location.href = 'index.php'; // Redirigir a la lista de contactos
    </script>";
}
?>


