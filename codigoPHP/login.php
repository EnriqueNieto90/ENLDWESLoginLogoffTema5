<?php
    if(isset($_REQUEST['cancelar'])){
        header('Location: ../indexLoginLogoffTema5.php');
        exit;
    }
    if(isset($_REQUEST['entrar'])){
        header('Location: inicioPrivado.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
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
        }
        h1 {
            margin: 0;
        }
        main {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background: #ecf0f1;
            margin: 10px 0;
            padding: 15px;
            border-left: 5px solid green;
            border-right: 5px solid green;
            transition: 0.3s;
	    border-radius:8px;
        }
        li:hover {
            background: #d6eaf8;
            border-left: 5px solid purple;
            border-right: 5px solid purple;
        }
        img {
            height: 25px;
        }

        footer{
            margin: auto;
            background-color: green;
            text-align: center;
            height: 150px;
	    color: white;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }
        footer i{
            font-size: 2.1rem;
        }
	.form-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 100px;
        }
        .boton, input[type="submit"] {
            padding: 12px 25px;
            border-radius: 5px;
            background-color: lightgreen;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            text-decoration: none; /* Para los enlaces <a> */
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s;
        }

    </style>
</head>
<body>
    <header>
        <h1><b>Login</b></h1>
    </header>
    
    <div class="form-actions">
        <form action="" method="post">
            <input type="submit" name="entrar" value='Entrar' id="entrar">
            <input type="submit" name="cancelar" value='Cancelar' id="cancelar">
            <input type="submit" name="registrarse" value='Registrarse' id="registrarse">
        </form>
    </div>
    
    <footer>
        <div>
            <h4>2025-26 IES LOS SAUCES. © Todos los derechos reservados.</h4>
        <p><a href="https://enriquenielor.ieslossauces.es/">Enrique Nieto Lorenzo</a> Fecha de Actualización : 20-11-2025</p>
        <a href="https://github.com/EnriqueNieto90/ENLDWESLoginLogoffTema5.git" target="_blank"><i class="fa-brands fa-github"></i></a>
        </div>
    </footer>
</body>
</html>
