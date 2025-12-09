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

    // volvemos a la página de inicio privado
    if (isset($_REQUEST['volver'])) {
        header('Location: inicioPrivado.php');
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
            max-width: 1400px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-bottom: 50px;
        }
        main h3 {
            text-align: center;
            color: green;
            margin: 30px 0 20px 0;
            font-size: 1.5rem;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
            overflow: auto;
            margin: 20px 0;
        }
        th {
            background-color: gainsboro;
            border: 1px solid black;
            padding: 10px;
            font-weight: bold;
            text-align: left;
        }
        td {
            border: 1px solid black;
            padding: 10px;
            overflow-wrap: break-word;
            word-wrap: break-word;
            vertical-align: top;
        }
        tr td:first-child {
            background-color: lightgreen;
            font-weight: bold;
            color: #333;
        }
        tr td:first-child, th:first-child {
            width: 30%;
        }
        tr td:nth-of-type(2), th:nth-of-type(2) {
            width: 70%;
        }
        pre {
            margin: 0;
            white-space: pre-wrap;
            word-wrap: break-word;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
        }
        .form-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
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
        #phpinfo {
            background-color: white;
            color: black;
            margin-top: 30px;
        }
        #phpinfo .v {
            background-color: white;
        }
        #phpinfo .e {
            background-color: lightgreen;
        }
        footer {
            margin: auto;
            background-color: green;
            text-align: center;
            padding: 20px;
            color: white;
            position: relative;
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
        <h1><b>Página de detalle</b></h1>
        <form action="" method="post">
            <button name="cerrarSesion" class="boton"><span>Cerrar sesión</span></button>
        </form>
    </header>
    
    <main>
        <div class="form-actions">
            <form action="" method="post">
                <button name="volver" class="boton"><span>Volver</span></button>
            </form>
        </div>
        
        <?php
        /**
        * @author: Enrique Nieto Lorenzo
        * @since: 20/11/2025
        * 0. Mostrar el contenido de las variables superglobales y phpinfo().
        */
        
        //Contenido de la variable $_SESSION-------------------------------------------------------
        echo '<h3>Contenido de la variable $_SESSION</h3>';
        echo '<table>';
        echo '<tr><th>Variable</th><th>Valor</th></tr>';
        if (!empty($_SESSION)) {
            foreach ($_SESSION as $variable => $resultado) {
                echo "<tr>";
                echo '<td>$_SESSION[' . $variable . ']</td>';
                echo "<td><pre>" . print_r($resultado, true) . "</pre></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'><em>La variable \$_SESSION está vacía.</em></td></tr>";
        }
        echo "</table>";

        //Contenido de la variable $_COOKIE---------------------------------------------------
        echo '<h3>Contenido de la variable $_COOKIE</h3>';
        echo '<table>';
        echo '<tr><th>Variable</th><th>Valor</th></tr>';
        if (!empty($_COOKIE)) {
            foreach ($_COOKIE as $variable => $resultado) {
                echo "<tr>";
                echo '<td>$_COOKIE[' . $variable . ']</td>';
                echo "<td><pre>" . $resultado . "</pre></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'><em>La variable \$_COOKIE está vacía.</em></td></tr>";
        }
        echo "</table>";

        //Contenido de la variable $_SERVER-----------------------------------------------
        echo '<h3>Contenido de la variable $_SERVER</h3>';
        echo '<table>';
        echo '<tr><th>Variable</th><th>Valor</th></tr>';
        if (!empty($_SERVER)) {
            foreach ($_SERVER as $variable => $resultado) {
                echo "<tr>";
                echo '<td>$_SERVER[' . $variable . ']</td>';
                echo "<td><pre>" . print_r($resultado, true) . "</pre></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'><em>La variable \$_SERVER está vacía.</em></td></tr>";
        }
        echo "</table>";

        //Contenido de la variable $_ENV -----------------------------------------------
        echo '<h3>Contenido de la variable $_ENV</h3>';
        echo '<table>';
        echo '<tr><th>Variable</th><th>Valor</th></tr>';
        if (!empty($_ENV)) {
            foreach ($_ENV as $variable => $resultado) {
                echo "<tr>";
                echo '<td>$_ENV[' . $variable . ']</td>';
                echo "<td><pre>" . print_r($resultado, true) . "</pre></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'><em>La variable \$_ENV está vacía.</em></td></tr>";
        }
        echo "</table>";

        //Contenido de la variable $_REQUEST -----------------------------------------------
        echo '<h3>Contenido de la variable $_REQUEST</h3>';
        echo '<table>';
        echo '<tr><th>Variable</th><th>Valor</th></tr>';
        if (!empty($_REQUEST)) {
            foreach ($_REQUEST as $variable => $resultado) {
                echo "<tr>";
                echo '<td>$_REQUEST[' . $variable . ']</td>';
                echo "<td><pre>" . print_r($resultado, true) . "</pre></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'><em>La variable \$_REQUEST está vacía.</em></td></tr>";
        }
        echo "</table>";

        //Contenido de la variable $_GET -----------------------------------------------
        echo '<h3>Contenido de la variable $_GET</h3>';
        echo '<table>';
        echo '<tr><th>Variable</th><th>Valor</th></tr>';
        if (!empty($_GET)) {
            foreach ($_GET as $variable => $resultado) {
                echo "<tr>";
                echo '<td>$_GET[' . $variable . ']</td>';
                echo "<td><pre>" . print_r($resultado, true) . "</pre></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'><em>La variable \$_GET está vacía.</em></td></tr>";
        }
        echo "</table>";

        //Contenido de la variable $_POST -----------------------------------------------
        echo '<h3>Contenido de la variable $_POST</h3>';
        echo '<table>';
        echo '<tr><th>Variable</th><th>Valor</th></tr>';
        if (!empty($_POST)) {
            foreach ($_POST as $variable => $resultado) {
                echo "<tr>";
                echo '<td>$_POST[' . $variable . ']</td>';
                echo "<td><pre>" . print_r($resultado, true) . "</pre></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'><em>La variable \$_POST está vacía.</em></td></tr>";
        }
        echo "</table>";

        //Contenido de la variable $_FILES -----------------------------------------------
        echo '<h3>Contenido de la variable $_FILES</h3>';
        echo '<table>';
        echo '<tr><th>Variable</th><th>Valor</th></tr>';
        if (!empty($_FILES)) {
            foreach ($_FILES as $variable => $resultado) {
                echo "<tr>";
                echo '<td>$_FILES[' . $variable . ']</td>';
                echo "<td><pre>" . print_r($resultado, true) . "</pre></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'><em>La variable \$_FILES está vacía.</em></td></tr>";
        }
        echo "</table>";

        // phpinfo()
        echo '<div id="phpinfo">';
        phpinfo();
        echo '</div>';
        ?>
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