<?php
    /**
    * @author: Enrique Nieto Lorenzo
    * @since: 02/12/2025
    * Proyecto Login logoff Tema 5.
    */

    if (isset($_REQUEST['cancelar'])) {
        header('Location: ../indexLoginLogoffTema5.php');
        exit;
    }

    require_once '../config/confDBPDO.php';
    require_once "../core/231018libreriaValidacion.php";
    
    $entradaOK = true; 
    $aErrores = ['usuario' => '', 'contrasena'=>''];
    
    if (isset($_REQUEST["entrar"])) {
        $aErrores['usuario']= validacionFormularios::comprobarAlfabetico($_REQUEST['usuario'],100,0,1);
        $aErrores['contrasena'] = validacionFormularios::validarPassword($_REQUEST['contrasena'],20,4,2);
        
        foreach($aErrores as $campo => $valor){
            if(!empty($valor)){ $entradaOK = false; } 
        }
    } else {
        $entradaOK = false;
    }
    
    if($entradaOK){ 
        try {
            $miDB = new PDO(DSN,USERNAME,PASSWORD);
            $sql = "SELECT * FROM T01_Usuario WHERE T01_CodUsuario = :usuario AND T01_Password = sha2(:contras,256)";
            $consulta = $miDB->prepare($sql);
            $consulta->execute([
                ':usuario' => $_REQUEST['usuario'],
                ':contras' => $_REQUEST['usuario'].$_REQUEST['contrasena']
            ]);
            
            $usuarioBD = $consulta->fetchObject();
            if ($usuarioBD){
                $oFechaActual = new DateTime();
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

                $actualizacion = "UPDATE T01_Usuario SET T01_FechaHoraUltimaConexion = now(), T01_NumConexiones = T01_NumConexiones + 1 WHERE T01_CodUsuario = :usuario";
                $consulta2 = $miDB->prepare($actualizacion);
                $consulta2->execute([':usuario' => $_REQUEST['usuario']]);

                header('Location: inicioPrivado.php');
                exit;
            } else {
                $entradaOK = false; 
            }
        } catch (PDOException $miExceptionPDO) {
            echo 'Error: '.$miExceptionPDO->getMessage();
        } finally {
            unset($miDB);
        }    
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Enrique Nieto</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../webroot/css/estilosLogin.css">
</head>
<body>
    
    <header class="header-app">
        <div class="logo-seccion">
            <span class="titulo-tema">LOGIN</span>
            <span class="subtitulo-tema">LOGIN LOGOFF TEMA 5</span>
        </div>
        <div class="nav-derecha">
            <form action="" method="post">
                <button name="cancelar" class="btn-header">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Salir
                </button>
            </form>
        </div>
    </header>

    <main>
        <div class="card-central">
            
            <div class="logo-app-img">
                <i class="fa-brands fa-microsoft" style="font-size: 2.5rem; color: #0078D4;"></i>
            </div>

            <h2 class="titulo-login">Iniciar sesión</h2>
            
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post"> 
                
                <div class="grupo-input">
                    <input type="text" class="input-microsoft" name="usuario" value="<?php echo $_REQUEST['usuario']??'' ?>" placeholder="Usuario">
                    <?php if(!empty($aErrores['usuario'])){ echo "<span style='color:red; font-size:0.8rem;'>".$aErrores['usuario']."</span>"; } ?>
                </div>
                
                <div class="grupo-input">
                    <input type="password" class="input-microsoft" name="contrasena" value="<?php echo $_REQUEST['contrasena']??'' ?>" placeholder="Contraseña">
                    <?php if(!empty($aErrores['contrasena'])){ echo "<span style='color:red; font-size:0.8rem;'>".$aErrores['contrasena']."</span>"; } ?>
                </div>

                <div class="acciones-login">
                    <span class="btn-link">¿No tienes cuenta? <br>
                    <input type="submit" value="Crea una aquí" name="registrarse" class="btn-link" style="font-weight:600;"></span>
                    
                    <button name="entrar" class="btn-primary">Entrar</button>
                </div>

            </form>
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