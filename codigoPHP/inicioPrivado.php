<?php
    /**
    * @author: Enrique Nieto Lorenzo
    * @since: 02/12/2025
    * Proyecto Login logoff Tema 5.
    */
    session_start();
    
    // comprobamos que existe la sesion para este usuario, sino redirige al login
    if (!isset($_SESSION["usuarioDAW205AppLoginLogoffTema5"])) {
        header("location: login.php"); 
        exit;
    }

    // Volvemos al índice general destruyendo la sesión
    if (isset($_REQUEST['cerrarSesion'])) {
        // Destruye la sesión
        session_destroy();
        header('Location: ../indexLoginLogoffTema5.php');
        exit;
    }

    // vamos a la página detalle
    if (isset($_REQUEST['detalle'])) {
        header('Location: detalle.php');
        exit;
    }
?>
<!DOCTYPE html>
<!--
    Autor: Enrique Nieto Lorenzo
    Fecha modificación: 20/11/2025
    Descripción: Aplicación Login Logoff Tema 5
-->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEMA 5 - DESARROLLO DE APLICACIONES WEB</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" type="text/css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        header {
            background: green;
            color: white;
            padding: 15px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            margin: 0;
            flex-grow: 1;
        }
        header form {
            margin: 0;
        }
        main {
            max-width: 800px;
            margin: 30px auto;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            min-height: 400px;
            margin-bottom: 200px;
        }
        main h2 {
            text-align: center;
            color: green;
            margin: 20px 0;
            font-size: 1.5rem;
            line-height: 1.6;
        }
        main h3 {
            text-align: center;
            color: green;
            margin-bottom: 30px;
        }
        .form-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
        }
        .boton, 
        input[type="submit"],
        button {
            padding: 12px 25px;
            border-radius: 5px;
            background-color: lightgreen;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s;
        }
        .boton:hover,
        input[type="submit"]:hover,
        button:hover {
            background-color: green;
        }
        .user-info {
            background: #f0f8f0;
            padding: 30px;
            border-radius: 8px;
            border-left: 5px solid green;
            border-right: 5px solid green;
            margin: 20px 0;
        }
        footer {
            margin: auto;
            background-color: green;
            text-align: center;
            padding: 20px;
            color: white;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }
        footer i {
            font-size: 2.1rem;
            color: white;
        }
        footer a {
            color: white;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1><b>Inicio privado</b></h1>
        <form action="" method="post">
            <button name="cerrarSesion" class="boton"><span>Cerrar sesión</span></button>
        </form>
    </header>
    
    <main>
        <h3>Bienvenido a la Zona Privada</h3>
        
        <div class="user-info">
            <?php
                $aUsuarioEnCurso = $_SESSION['usuarioDAW205AppLoginLogoffTema5'];
                $fechaUltimaConexion = new DateTime($aUsuarioEnCurso['FechaHoraUltimaConexionAnterior']);

                // Detectar idioma (por defecto español si no existe cookie)
                $idioma = isset($_COOKIE["idioma"]) ? $_COOKIE["idioma"] : "ES";

                if ($idioma == "ES") {
                    setlocale(LC_TIME, 'es_ES.utf8');

                    echo '<h2>Bienvenido '.$aUsuarioEnCurso['DescUsuario'].'.</h2>';
                    echo '<h2>Esta es la '.$aUsuarioEnCurso['NumConexiones'].'ª vez que se conecta.</h2>';
                    if (($aUsuarioEnCurso['NumConexiones']) > 1) {
                        echo '<h2>Usted se conectó por última vez el '.strftime("%d de %B de %Y a las %H:%M:%S", $fechaUltimaConexion->getTimestamp()).'.</h2>';
                    }
                    
                } elseif ($idioma == "EN") {
                    setlocale(LC_TIME, 'en_GB.utf8');

                    echo '<h2>Welcome '.$aUsuarioEnCurso['DescUsuario'].'.</h2>';
                    echo '<h2>This is the '.$aUsuarioEnCurso['NumConexiones'].' time you have connected.</h2>';
                    if (($aUsuarioEnCurso['NumConexiones']) > 1) {
                        echo '<h2>You were last connected on '.strftime("%B %d, %Y at %H:%M:%S", $fechaUltimaConexion->getTimestamp()).'.</h2>';
                    }
                    
                } elseif ($idioma == "FR") {
                    setlocale(LC_TIME, 'fr_FR.UTF-8');

                    echo '<h2>Bienvenue '.$aUsuarioEnCurso['DescUsuario'].'.</h2>';
                    echo '<h2>Voici votre '.$aUsuarioEnCurso['NumConexiones'].'e connexion.</h2>';
                    if (($aUsuarioEnCurso['NumConexiones']) > 1) {
                        echo '<h2>Votre dernière connexion remonte au '.strftime("%d %B %Y à %H:%M:%S", $fechaUltimaConexion->getTimestamp()).'.</h2>';
                    }
                }
            ?>
        </div>
        
        <div class="form-actions">
            <form action="" method="post">
                <button name="detalle" class="boton"><span>Detalle</span></button>
            </form>
        </div>
    </main>
    
    <footer>
        <div>
            <h4>2025-26 IES LOS SAUCES. © Todos los derechos reservados.</h4>
            <p>
                <a href="https://enriquenielor.ieslossauces.es/">Enrique Nieto Lorenzo</a> 
                Fecha de Actualización: <time datetime="2025-11-20">20-11-2025</time>
            </p>
            <a href="https://github.com/EnriqueNieto90/ENLDWESLoginLogoffTema5.git" target="_blank">
                <i class="fa-brands fa-github"></i>
            </a>
        </div>
    </footer>
</body>
</html>