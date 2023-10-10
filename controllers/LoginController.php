<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;

class LoginController {
    public static function index(Router $router){
        if(!isset($_SESSION['auth_user'])){
            $router->render('login/index', []);
        }else{
            header('Location: /examen_prueba/menu');
        }
    }

    public static function menuAdministrador(Router $router){
        if(isset($_SESSION['auth_user'])){
            $router->render('menus/menuAdministrador/index', []);
        }else{
            header('Location: /examen_prueba/');
        }
    }

    public static function menuTecnico(Router $router){
        if(isset($_SESSION['auth_user'])){
            $router->render('menus/menuTecnico/index', []);
        }else{
            header('Location: /examen_prueba/');
        }
    }

    public static function menuCliente(Router $router){
        if(isset($_SESSION['auth_user'])){
            $router->render('menus/menuCliente/index', []);
        }else{
            header('Location: /examen_prueba/');
        }
    }

    public static function indexx(Router $router){

        $router->render('registro/index', [
            'registro' => $registro,
        ]);
    }


public static function loginAPI(){
    $dpi = filter_var($_POST['usu_dpi'], FILTER_SANITIZE_NUMBER_INT);
    $password = filter_var($_POST['usu_password'], FILTER_DEFAULT);
    $usuarioRegistrado = Usuario::fetchFirst("SELECT * FROM usuario WHERE usu_dpi = $dpi");

    try {
        if (is_array($usuarioRegistrado)) {
            $verificacion = password_verify($password, $usuarioRegistrado['usu_password']);
            $nombre = $usuarioRegistrado['usu_nombre'];
            $rol = $usuarioRegistrado['usu_rol'];

            if (!$verificacion) {
                echo json_encode([
                    'codigo' => 4,
                    'mensaje' => 'Contraseña incorrecta'
                ]);

            } elseif ($rol == 4) {
                echo json_encode([
                    'codigo' => 4,
                    'mensaje' => "Usuario Pendiente"
                ]);
            } elseif ($rol == 1) {
                session_start();
                $_SESSION['auth_user'] = $dpi;

                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => "Sesión iniciada correctamente. Bienvenido ADMINISTRADOR $nombre"
                ]);

            } elseif ($rol == 2) {
                session_start();
                $_SESSION['auth_user'] = $dpi;

                echo json_encode([
                    'codigo' => 2,
                    'mensaje' => "Sesión iniciada correctamente. Bienvenido TECNICO $nombre"
                ]);
            } elseif ($rol == 3) {
                session_start();
                $_SESSION['auth_user'] = $dpi;

                echo json_encode([
                    'codigo' => 3,
                    'mensaje' => "Sesión iniciada correctamente. Bienvenido CLIENTE $nombre"
                ]);
            }

        } else {
            echo json_encode([
                'codigo' => 4,
                'mensaje' => 'Usuario no encontrado'
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            'detalle' => $e->getMessage(),
            'codigo' => 0,
            'mensaje' => 'Usuario no encontrado'
        ]);
    }
}
public static function logout(){
    $_SESSION = [];
    session_unset();
    session_destroy();
    header('Location: /examen_prueba/');
}

    //!Funcion guardar
    public static function guardarAPI(){
        try {
            $usuarioData = $_POST; 
            
            $nombreUsuario = $usuarioData['usu_nombre'];
            $dpiUsuario = $usuarioData['usu_dpi'];
            
            // Verificar si ya existe un usuario con el mismo nombre o catálogo
            $usuarioExistente = Usuario::fetchFirst("SELECT * FROM usuario WHERE usu_nombre = '$nombreUsuario' OR usu_dpi = $dpiUsuario");
    
            if ($usuarioExistente) {
                if ($usuarioExistente['usu_nombre'] === $nombreUsuario) {
                    echo json_encode([
                        'mensaje' => 'El nombre de usuario ya existe',
                        'codigo' => 2
                    ]);
                    return;
                } elseif ($usuarioExistente['usu_dpi'] == $dpiUsuario) {
                    echo json_encode([
                        'mensaje' => 'El número de catálogo ya existe',
                        'codigo' => 3
                    ]);
                    return;
                }
            }
            
            $password = filter_var($usuarioData['usu_password'], FILTER_DEFAULT);
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $usuarioData['usu_password'] = $hashedPassword;
    
            $usuario = new Usuario($usuarioData);
            
            $resultado = $usuario->crear();
            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro Enviado, Pendiente a ser Aprobado',
                    'codigo' => 1
                ]);
            }else{
                echo json_encode([
                    'mensaje' => 'Ocurrio un error',
                    'codigo' => 0
                ]);
            }
                
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje'=> 'Ocurrio un Error',
                'codigo' => 0
            ]);
        }
    }
    
    
}