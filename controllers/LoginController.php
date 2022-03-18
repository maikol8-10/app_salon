<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Classes\Email;

class LoginController
{
    public static function login(Router $router)
    {
        $router->render('auth/login');
        //echo "Desde Login";
    }

    public static function logout()
    {
        echo "Desde Logout";
    }

    public static function olvide(Router $router)
    {
        $router->render('auth/olvide-password', []);
        //echo "Desde Olvide";
    }

    public static function recuperar()
    {
        echo "Desde Recuperar";
    }

    public static function crear(Router $router)
    {
        $usuario = new Usuario($_POST);

        //Alertas vacias
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que alertas esté vacio
            if (empty($alertas)) {
                //Verificar que el usuario no esté registrador
                $resultado = $usuario->existeUsuario();
                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    //Hashear el Password
                    $usuario->hashPassword();

                    //Generar un token único
                    $usuario->crear_token();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    $email->enviarConfirmacion();
                }
            }
        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
        //echo "Desde Crear";
    }
}
