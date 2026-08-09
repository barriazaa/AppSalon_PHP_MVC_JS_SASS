<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        
        $router->render('auth/login');
    }

    public static function logout() {
        echo "Desde el logout";
    }

    public static function olvide(Router $router) {
        $router -> render('auth/olvide-password', [
            
        ]);
    }

    public static function recuperar() {
        echo "Desde el recuperar";
    }

    public static function crear(Router $router) {
        
        $usuario = new Usuario;


        //Alertas vacias
        $alertas = []; 
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que alertas este vacio
            if(empty($alertas)) {
                //verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if(!empty($resultado)) {
                    $alertas = Usuario::getAlertas();
                } else {        
                    //Hash de password
                    $usuario->hashPassword();

                    //Generar un token unico
                    $usuario->crearToken();

                    //Enviar el email
                    $email = new Email($usuario->nombre, $usuario->email,
                    $usuario->token);

                    $email->enviarConfirmacion();
                    
                    //Crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado) {
                        header('Location: /mensaje');
                    }

                    //debuguear($usuario);

                }
            }
                
        }

        $router -> render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {
    
        $router -> render('auth/mensaje');
    }

    //Alertas
    public static function confirmar (Router $router) {
        $alertas = [];

        $token = s($_GET['token']);
        /** @var Usuario $usuario */
        $usuario = Usuario::where('token', $token);
        //debuguear($usuario);

                    
        if(empty ($usuario)) {
            //Mostrar mensaje error
            Usuario::setAlerta('error', 'Token no valido');

        } else {
            //Modificar a usuario confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta comprobada correctamente');
        }

        //Obtener alertas
        $alertas = Usuario::getAlertas();

        //Renderizar la vista
        $router -> render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}