<?php
/**
 * @author: Enrique Nieto Lorenzo
 * @since: 15/12/2025
 * @description: Vista de Inicio Privado.
 */

session_start();

if (!isset($_SESSION["usuarioENLLoginLogoffTema5"])) {
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
        <link rel="stylesheet" href="../webroot/css/all.min.css">
        <link rel="stylesheet" href="../webroot/css/estilosLogin.css?v=2">
    </head>
    <body>

        <header class="header-app">
            <div class="logo-seccion">
                <span class="titulo-tema">Portal Privado</span>
                <span class="subtitulo-tema">LOGIN LOGOFF</span>
            </div>
            <div class="nav-derecha">
                <form action="indexLoginLogoffTema5.php" method="post">
                    <button name="cerrarSesion" class="btn-header">Cerrar sesión</button>
                </form>
            </div>
        </header>

        <main>
            <div class="card-central card-dashboard">

                <div class="welcome-msg">
                    <?php
                    $aUsuarioEnCurso = $_SESSION['usuarioENLLoginLogoffTema5'];

                    $fechaUltimaConexionAnterior = new DateTime($aUsuarioEnCurso->getFechaHoraUltimaConexionAnterior());
                    $idioma = $_COOKIE["idioma"] ?? "ES";

                    if ($idioma == "ES") {
                        setlocale(LC_TIME, 'es_ES.utf8');
                        echo '<h2>Bienvenido <strong>' . $aUsuarioEnCurso->getDescUsuario() . '</strong></h2>';
                        echo '<p>Esta es la <strong>' . $aUsuarioEnCurso->getNumConexiones() . 'ª</strong> vez que se conecta.</p>';
                    } elseif ($idioma == "EN") {
                        echo '<h2>Welcome <strong>' . $aUsuarioEnCurso->getDescUsuario() . '</strong></h2>';
                        echo '<p>This is the <strong>' . $aUsuarioEnCurso->getNumConexiones() . '</strong> time you have connected.</p>';
                    } else {
                        echo '<h2>Bienvenue <strong>' . $aUsuarioEnCurso->getDescUsuario() . '</strong></h2>';
                        echo '<p>C\'est la <strong>' . $aUsuarioEnCurso->getNumConexiones() . 'e</strong> fois que vous vous connectez.</p>';
                    }
                    ?>
                </div>

                <?php if (($aUsuarioEnCurso->getNumConexiones()) > 1) { ?>
                    <div class="info-conexion">
                        <i class="fa-regular fa-clock"></i> Última conexión: 
                        <strong><?php echo $fechaUltimaConexionAnterior->format('d/m/Y H:i:s'); ?></strong>
                    </div>
                <?php } ?>

                <div class="contenedor-boton-centro">
                    <form action="indexLoginLogoffTema5.php" method="post">
                        <button name="detalle" class="btn-primary btn-detalle">
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