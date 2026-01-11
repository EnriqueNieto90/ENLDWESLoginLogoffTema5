<?php
/**
 * @author: Enrique Nieto Lorenzo
 * @since: 15/12/2025
 * @description: Vista de Inicio Público.
 */

    session_start();
    
    // Comprobar sesión activa
    if (isset($_SESSION["userENLLoginLogoffTema5"])) {
        $textoBotonIniciarSesion = 'Hola '.$_SESSION["userENLLoginLogoffTema5"]['CodUsuario'];

        if (isset($_REQUEST['iniciarSesion'])) {
            header('Location: codigoPHP/inicioPrivado.php');
            exit;
        }
    }

    // Botón Iniciar Sesión
    if (isset($_REQUEST['iniciarSesion'])) {
        header('Location: codigoPHP/login.php');
        exit;
    }

    // Cookie Idioma
    if (!isset($_COOKIE['idioma'])) {
        setcookie("idioma", "ES", time()+604800);
        header('Location: ./indexLoginLogoffTema5.php');
        exit;
    }

    // Cambio de Idioma
    if (isset($_REQUEST['idioma'])) {
        setcookie("idioma", $_REQUEST['idioma'], time()+604800);
        header('Location: ./indexLoginLogoffTema5.php');
        exit;
    }
    
    // Variable para saber qué idioma está activo y pintar la clase CSS
    $idiomaActivo = $_COOKIE['idioma'] ?? 'ES';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Público | Enrique Nieto</title>
    <link rel="stylesheet" href="webroot/css/all.min.css">
    <link rel="stylesheet" href="webroot/css/estilosLogin.css?v=2">
</head>
<body>

    <header class="header-app">
        <div class="logo-seccion">
            <span class="titulo-tema">Bienvenido</span>
            <span class="subtitulo-tema">LOGIN LOGOFF</span>
        </div>

        <div class="header-controls">
            <form action="" method="post" class="idioma-buttons">
                <?php $lang = $_COOKIE['idioma'] ?? 'ES'; ?>

                <button type="submit" name="idioma" value="ES" class="btn-flag <?php echo ($lang == 'ES') ? 'active' : ''; ?>" title="Español">
                    <img src="webroot/images/esp.png" alt="ES">
                </button>
                <button type="submit" name="idioma" value="EN" class="btn-flag <?php echo ($lang == 'EN') ? 'active' : ''; ?>" title="English">
                    <img src="webroot/images/uk.png" alt="EN">
                </button>
                <button type="submit" name="idioma" value="FR" class="btn-flag <?php echo ($lang == 'FR') ? 'active' : ''; ?>" title="Français">
                    <img src="webroot/images/francia.png" alt="FR">
                </button>
            </form>

            <form action="" method="post" class="form-no-margin">
                <button name="iniciarSesion" class="btn-login-header">
                    Iniciar Sesión
                </button>
            </form>
        </div>
    </header>

    <main>
        <div class="card-central card-dashboard text-center">
            <h2 class="titulo-login text-center">Bienvenido a la aplicación Login Logoff</h2>
            <p>Sistema de gestión de usuarios con autenticación y control de sesiones.</p>

            <div class="home-image-container">
                <img src="webroot/images/arbol.png" alt="Diagrama de navegación" onerror="this.style.display='none'">
            </div>
        </div>
    </main>
    
    <footer class="footer-microsoft">
        <div class="footer-content">
            <p class="copy-text">2025-26 IES LOS SAUCES. © Todos los derechos reservados.</p>
            <p>Enrique Nieto Lorenzo | Actualizado: 07-01-2026</p>
            <div class="footer-links">
                <a href="https://github.com/EnriqueNieto90/ENLDWESLoginLogoffTema5" target="_blank"><i class="fa-brands fa-github"></i></a>
                <a href="../index.html"><i class="fa-solid fa-house"></i></a>
            </div>
        </div>
    </footer>

</body>
</html>