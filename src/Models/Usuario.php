<?php

namespace Models;

use Lib\BaseDatos;

/**
 * 
 *
 * Gestiona la creación y el manejo de información de usuarios dentro de la base de datos.
 */
class Usuario {
    private ?string $id;
    private string $nombre;
    private string $apellidos;
    private string $email;
    private string $password;
    private string $rol;

    private BaseDatos $db;

    /**
     * Constructor de la clase Usuario.
     *
     * @param string|null $id El ID del usuario.
     * @param string $nombre El nombre del usuario.
     * @param string $apellidos Los apellidos del usuario.
     * @param string $email El email del usuario.
     * @param string $password La contraseña del usuario.
     * @param string $rol El rol del usuario en el sistema.
     */
    public function __construct(?string $id, string $nombre, string $apellidos, string $email, string $password, string $rol) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
        $this->db = new BaseDatos();
    }

    // Métodos getters y setters de los atributos de Usuario

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function getApellidos(): string {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getRol(): string {
        return $this->rol;
    }

    public function setRol(string $rol): void {
        $this->rol = $rol;
    }

    /**
     * Crea una instancia de Usuario a partir de datos en forma de array.
     *
     * @param array $data Datos del usuario a instanciar.
     * @return Usuario La instancia creada.
     */
    public static function fromArray(array $data): Usuario {
        return new self(
            $data['id'] ?? null,
            $data['nombre'] ?? '',
            $data['apellidos'] ?? '',
            $data['email'] ?? '',
            $data['password'] ?? '',
            $data['rol'] ?? ''
        );
    }

    /**
     * Desconecta al usuario de la base de datos, cerrando la conexión.
     */
    public function desconecta(): void {
        $this->db->cerrarConexion();
    }
}
