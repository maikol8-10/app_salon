<?php

namespace Model;

class Usuario extends ActiveRecord
{
    //Base de datos
    protected static $tabla = 'usuarios';

    protected static $columnaDB = ['id', 'nombre', 'apellidos', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellidos;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? null;
        $this->confirmado = $args['confirmado'] ?? null;
        $this->token = $args['token'] ?? '';
    }

    //Mensajes de validación para la creacion de una cuenta
    public function validarNuevaCuenta()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }

        if (!$this->apellidos) {
            self::$alertas['error'][] = 'Los Apellidos son Obligatorio';
        }

        if (!$this->email) {
            self::$alertas['error'][] = 'El correo es Obligatorio';
        }

        if (!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatorio';
        }

        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password tiene contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    //Verifica si el usuario ya existe
    public function existeUsuario()
    {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'EL Usuario ya está registrado';
        }
        return $resultado;
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crear_token()
    {
        $this->token = uniqid(); //Funcion para generar un ID unico

    }
}
