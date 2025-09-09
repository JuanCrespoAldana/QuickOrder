<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificar Código</title>
    <link rel="stylesheet" href="../css/contrasena.css">
</head>
<body>
    <div class="form-container">
        <h2>Verificar Código</h2>

        <form action="../controlador/verificar_codigo.php" method="POST">

            <input type="email" name="correo" placeholder="Correo" required>
            <input type="text" name="codigo" placeholder="Código recibido" required>
            
            <input type="submit" value="Verificar">
        </form>
    </div>
</body>
</html>