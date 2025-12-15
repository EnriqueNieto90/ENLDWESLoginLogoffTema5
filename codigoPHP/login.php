<?php
    /**
    * @author: Enrique Nieto Lorenzo
    * @since: 02/12/2025
    * Proyecto Login logoff Tema 5.
    */

    // volvemos al index principal al dar a cancelar
    if (isset($_REQUEST['cancelar'])) {
        header('Location: ../indexLoginLogoffTema5.php');
        exit;
    }

    // importamos el archivo con los datos de conexión
    require_once '../config/confDBPDO.php';
    require_once "../core/231018libreriaValidacion.php"; // importamos nuestra libreria
    
    $entradaOK = true; //Variable que nos indica que todo va bien
    $aErrores = [  //Array donde recogemos los mensajes de error
        'usuario' => '', 
        'contrasena'=>''
    ];
    $aRespuestas=[ //Array donde recogeremos la respuestas correctas (si $entradaOK)
        'usuario' => '',  
        'contrasena'=>''
    ]; 
    
    //Para cada campo del formulario: Validar entrada y actuar en consecuencia
    if (isset($_REQUEST["entrar"])) {//Código que se ejecuta cuando se envía el formulario

        // Validamos los datos del formulario
        $aErrores['usuario']= validacionFormularios::comprobarAlfabetico($_REQUEST['usuario'],100,0,1);
        $aErrores['contrasena'] = validacionFormularios::validarPassword($_REQUEST['contrasena'],20,4,2);
        
        foreach($aErrores as $campo => $valor){
            if(!empty($valor)){ // Comprobar si el valor es válido
                $entradaOK = false;
            } 
        }
        
    } else {//Código que se ejecuta antes de rellenar el formulario
        $entradaOK = false;
    }
    
    //Tratamiento del formulario
    if($entradaOK){ //Cargar la variable $aRespuestas y tratamiento de datos OK

        try {

            // Conectamos a la base de datos
            $miDB = new PDO(DSN,USERNAME,PASSWORD);

            // Consulta preparada: Busca un usuario y contraseña coincidentes
            $sql = "SELECT * FROM T01_Usuario WHERE T01_CodUsuario = :usuario AND T01_Password = sha2(:contras,256)";
            $consulta = $miDB->prepare($sql);
            $consulta->execute([
                ':usuario' => $_REQUEST['usuario'],
                ':contras' => $_REQUEST['usuario'].$_REQUEST['contrasena']
            ]);
            
            // Si encuentra una fila, las credenciales son correctas
            $usuarioBD = $consulta->fetchObject();
            if ($usuarioBD){

                $oFechaActual = new DateTime();
                // sino se inicia la session y guardamos datos de sesión
                session_start();
                $_SESSION['usuarioDAW205AppLoginLogoffTema5'] = [
                'CodUsuario' => $usuarioBD->T01_CodUsuario,
                'Password' => $usuarioBD->T01_Password,
                'DescUsuario' => $usuarioBD->T01_DescUsuario,
                'FechaHoraUltimaConexionAnterior' => $usuarioBD->T01_FechaHoraUltimaConexion,
                'FechaHoraUltimaConexion' => $oFechaActual->format('Y-m-d H:i:s'),
                'NumConexiones' => $usuarioBD->T01_NumConexiones+1,
                'Perfil' => $usuarioBD->T01_Perfil
                ];

                //Se actualiza la fecha de ultima session y el contador de conexiones
                $actualizacion = <<<SQL
                                UPDATE T01_Usuario SET
                                T01_FechaHoraUltimaConexion = now(),
                                T01_NumConexiones = T01_NumConexiones + 1
                                WHERE T01_CodUsuario = :usuario
                                SQL;
                $consulta2 = $miDB->prepare($actualizacion);
                $consulta2->execute([':usuario' => $_REQUEST['usuario']]);

                // Avanzamos a la pagina inicio privado
                header('Location: inicioPrivado.php');
                exit;

            // Si el usuario NO es válido vuelve a cargar el login.
            } else {
                header('Location: login.php');
                exit;
            }

        } catch (PDOException $miExceptionPDO) {
            // temporalmente ponemos estos errores para que se muestren en pantalla
            echo 'Error: '.$miExceptionPDO->getMessage().' con código de error: '.$miExceptionPDO->getCode();
        } finally {
            unset($miDB);
        }   

    } else { //Mostrar el formulario hasta que lo rellenemos correctamente
        //Mostrar formulario
        //Mostrar los datos tecleados correctamente en intentos anteriores
        //Mostrar mensajes de error (si los hay y el formulario no se muestra por primera vez)
?>
<!DOCTYPE html>
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
        }
        h1 {
            margin: 0;
        }
        main {
            max-width: 600px;
            margin: 30px auto;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            min-height: 500px;
            margin-bottom: 200px;
        }
        main h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8rem;
            color: green;
        }
        main p {
            text-align: center;
            margin: 20px 0;
        }
        form * {
            margin-top: 10px;
        }
        input[type="text"], 
        input[type="password"] {
            padding: 15px 20px;
            margin: 15px 0;
            font-size: 1.1rem;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            border: 2px solid #ddd;
            width: 100%;
            box-sizing: border-box;
            background-color: #fff9c4;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: green;
            outline: none;
        }
        .form-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        button, 
        input[type="submit"], 
        input[type="button"] {
            padding: 12px 30px;
            border-radius: 5px;
            background-color: lightgreen;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        button:hover,
        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: green;
        }
        #registrarse {
            background-color: purple;
            width: 100%;
            margin-top: 20px;
        }
        #registrarse:hover {
            background-color: #6b0f6b;
        }
        hr {
            margin: 30px 0;
            border: none;
            border-top: 1px solid #ddd;
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
        <h1><b>Login</b></h1>
    </header>
    
    <main>
        <h2>INICIO SESIÓN</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post"> 
            <input type="text" id="usuario" name="usuario" value="<?php echo $_REQUEST['usuario']??'' ?>" placeholder="Usuario">
            <br>
            <input type="password" id="contrasena" name="contrasena" value="<?php echo $_REQUEST['contrasena']??'' ?>" placeholder="Contraseña">
            <br>   
            <div class="form-actions">
                <button name="entrar" id="entrar"><span>Entrar</span></button>
                <button name="cancelar" id="cancelar"><span>Cancelar</span></button>
            </div>
            <hr>
            <p>¿No tienes cuenta?</p>
            <input type="button" value="Registrarse" name="registrarse" id="registrarse">
        </form>
    </main>
    <?php
        }
    ?> 
    
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