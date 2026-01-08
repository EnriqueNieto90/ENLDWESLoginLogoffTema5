<?php
    /**
    * @author: Enrique Nieto Lorenzo
    * @since: 02/12/2025
    */
    session_start();
    
    if (!isset($_SESSION["usuarioDAW205AppLoginLogoffTema5"])) {
        header("location: login.php"); 
        exit;
    }
    if (isset($_REQUEST['cerrarSesion'])) {
        session_destroy();
        header('Location: ../indexLoginLogoffTema5.php');
        exit;
    }
    if (isset($_REQUEST['volver'])) {
        header('Location: inicioPrivado.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Variables | Enrique Nieto</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../webroot/css/estilosLogin.css">
</head>
<body>

    <header class="header-app">
        <div class="logo-seccion">
            <span class="titulo-tema">Detalle</span>
            <span class="subtitulo-tema">LOGIN LOGOFF TEMA 5</span>
        </div>
        <div class="nav-derecha">
            <form action="" method="post">
                <button name="cerrarSesion" class="btn-header">Cerrar sesión</button>
            </form>
        </div>
    </header>
    
    <main>
        <div style="width: 100%; max-width: 900px; margin-bottom: 20px;">
            <form action="" method="post">
                <button name="volver" class="btn-link" style="color: #666;">
                    <i class="fa-solid fa-arrow-left"></i> Volver a Inicio
                </button>
            </form>
        </div>

        <div class="card-central card-dashboard">
            
            <h3 style="color:var(--ms-blue); margin-bottom:15px;">Sesión</h3>
            <table class="tabla-microsoft">
                <tr><th>Clave</th><th>Valor</th></tr>
                <?php
                if (!empty($_SESSION)) {
                    foreach ($_SESSION as $variable => $resultado) {
                        echo "<tr><td>".$variable."</td><td><pre>" . print_r($resultado, true) . "</pre></td></tr>";
                    }
                } else { echo "<tr><td colspan='2'>Vacía</td></tr>"; }
                ?>
            </table>

            <h3 style="color:var(--ms-blue); margin: 30px 0 15px;">Cookies</h3>
            <table class="tabla-microsoft">
                <tr><th>Clave</th><th>Valor</th></tr>
                <?php
                if (!empty($_COOKIE)) {
                    foreach ($_COOKIE as $variable => $resultado) {
                        echo "<tr><td>".$variable."</td><td><pre>" . $resultado . "</pre></td></tr>";
                    }
                } else { echo "<tr><td colspan='2'>Vacía</td></tr>"; }
                ?>
            </table>

            <h3 style="color:var(--ms-blue); margin: 30px 0 15px;">Server</h3>
            <div style="height: 300px; overflow-y: scroll; border:1px solid #eee;">
                <table class="tabla-microsoft">
                    <tr><th>Clave</th><th>Valor</th></tr>
                    <?php
                    foreach ($_SERVER as $variable => $resultado) {
                        echo "<tr><td>".$variable."</td><td><pre>" . print_r($resultado, true) . "</pre></td></tr>";
                    }
                    ?>
                </table>
            </div>
            
            <h3 style="color:var(--ms-blue); margin: 30px 0 15px;">PHP Info</h3>
            <div style="overflow-x: auto; padding: 10px; border: 1px solid #ddd;">
                <?php phpinfo(); ?>
            </div>

        </div>
    </main>
    
    <footer class="footer-microsoft">
        <div class="footer-content">
            <p class="copy-text">2025-26 IES LOS SAUCES. © Todos los derechos reservados.</p>
            <p>Enrique Nieto Lorenzo | Actualizado: 07-01-2026</p>
            <div class="footer-links">
                <a href="https://github.com/EnriqueNieto90/ENLDWESLoginLogoffTema5" target="_blank"><i class="fa-brands fa-github"></i></a>
                <a href="../../index.html"><i class="fa-solid fa-house"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>