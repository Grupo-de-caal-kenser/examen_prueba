<?php
namespace   Controllers;

use Exception;
use Model\Usuario;
use Model\Rol;
use Model\Router;


class ActivacionController {
    public static function index(Router $router){

        $roles = static::buscarRoles();

        $usuarios = Usuario::all();

        $router->render('activacion/index', [
            'activacion' => $activacion,
            'roles' => $roles,
        ]);
    }

    //!--------------------------

    public static function buscarRoles(){
        $sql = "SELECT * FROM rol where rol_situacion = 1";
    
        try {
            $roles = Usuario::fetchArray($sql);
    
            if($roles){
                return $roles;
            }else{
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }
    
        //!Funcion Buscar
    public static function buscarAPI()
    {

        $sql = "SELECT u.usu_id, u.usu_nombre, u.usu_dpi, u.usu_password, u.usu_email, u.usu_telefono, r.rol_nombre
        FROM usuario u
        LEFT JOIN rol r ON u.usu_rol = r.rol_id
        WHERE u.usu_situacion = 2;
         ";

        try {

            $usuarios = Usuario::fetchArray($sql);

            echo json_encode($usuarios);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    
    public static function activarAPI(){
        try {
            $usu_id = $_POST['usu_id'];
            $usuario = Usuario::find($usu_id);
    
            // Verificar si el rol es "PENDIENTE"
            if ($usuario->usu_rol === '4') {
                echo json_encode([
                    'mensaje' => 'No se puede activar el usuario con rol "PENDIENTE"',
                    'codigo' => 2
                ]);
                return;
            }
    
    
            $usuario->usu_situacion = 1;
            $resultado = $usuario->actualizar();
    
            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Usuario Activado Exitosamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrio un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrio un Error',
                'codigo' => 0
            ]);
        }
    }

}