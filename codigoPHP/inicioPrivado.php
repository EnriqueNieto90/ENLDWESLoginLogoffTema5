<?php
    /**
    * @author: Enrique Nieto Lorenzo
    * @since: 02/12/2025
    * Proyecto Login logoff Tema 5.
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
    if (isset($_REQUEST['detalle'])) {
        header('Location: detalle.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Privado | Enrique Nieto</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../webroot/css/estilosLogin.css">
</head>
<body>

    <header class="header-app">
        <div class="logo-seccion">
            <span class="titulo-tema">Inicio Privado</span>
            <span class="subtitulo-tema">LOGIN LOGOFF TEMA 5</span>
        </div>
        <div class="nav-derecha">
            <form action="" method="post">
                <button name="cerrarSesion" class="btn-header">Cerrar sesión</button>
            </form>
        </div>
    </header>
    
    <main>
        <div class="card-central card-dashboard">
            
            <div class="welcome-msg">
                <?php
                    $aUsuarioEnCurso = $_SESSION['usuarioDAW205AppLoginLogoffTema5'];
                    $fechaUltimaConexion = new DateTime($aUsuarioEnCurso['FechaHoraUltimaConexionAnterior']);
                    $idioma = isset($_COOKIE["idioma"]) ? $_COOKIE["idioma"] : "ES";

                    if ($idioma == "ES") {
                        setlocale(LC_TIME, 'es_ES.utf8');
                        echo '<h2>Bienvenido <strong>'.$aUsuarioEnCurso['DescUsuario'].'</strong></h2>';
                        echo '<p style="margin-top:10px;">Esta es la <strong>'.$aUsuarioEnCurso['NumConexiones'].'ª</strong> vez que se conecta.</p>';
                    } elseif ($idioma == "EN") {
                        // ... lógica idiomas ...
                        echo '<h2>Welcome <strong>'.$aUsuarioEnCurso['DescUsuario'].'</strong></h2>';
                    }
                ?>
            </div>

            <?php if (($aUsuarioEnCurso['NumConexiones']) > 1) { ?>
                <div class="info-conexion">
                    <i class="fa-regular fa-clock"></i> Última conexión: 
                    <strong><?php echo strftime("%d de %B de %Y a las %H:%M:%S", $fechaUltimaConexion->getTimestamp()); ?></strong>
                </div>
            <?php } ?>
        
            <div style="text-align: center; margin-top: 40px;">
                <form action="" method="post">
                    <button name="detalle" class="btn-primary" style="width: auto; padding: 10px 40px;">
                        Ver Detalle <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>
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