<?php

namespace Services;

use Repositories\UsuarioRepository;

/**
 * Capa de servicio para gestionar las operaciones relacionadas con los usuarios,
 * interactuando con el UsuarioRepository.
 */
class UsuarioService {
    private UsuarioRepository $usuarioRepository;

    /**
     * Constructor que inicializa el servicio con una instancia de UsuarioRepository.
     *
     * @param UsuarioRepository $usuarioRepository Repositorio que maneja las operaciones de datos de los usuarios.
     */
    public function __construct(UsuarioRepository $usuarioRepository) {
        $this->usuarioRepository = $usuarioRepository;
    }

    /**
     * Crea un nuevo usuario en la base de datos.
     *
     * @param array $usuario Datos del usuario.
     * @return bool Verdadero si la creación es exitosa, falso de lo contrario.
     */
    public function create($usuario) {
        return $this->usuarioRepository->create($usuario);
    }

    /**
     * Recupera todos los usuarios existentes.
     *
     * @return array Lista de todos los usuarios.
     */
    public function verTodos() {
        return $this->usuarioRepository->verTodos();
    }

    /**
     * Realiza el proceso de inicio de sesión de un usuario.
     *
     * @param array $usuario Datos del usuario para el inicio de sesión.
     * @return bool Verdadero si el inicio de sesión es exitoso, falso de lo contrario.
     */
    public function login($usuario) {
        return $this->usuarioRepository->login($usuario);
    }

    /**
     * Busca un usuario por su correo electrónico.
     *
     * @param string $email El correo electrónico a buscar.
     * @return array|null Datos del usuario si se encuentra, nulo si no existe.
     */
    public function buscaMail($email) {
        return $this->usuarioRepository->buscaMail($email);
    }

    /**
     * Recupera un usuario específico por su ID.
     *
     * @param int $id El identificador del usuario.
     * @return array Datos del usuario específico.
     */
    public function usuarioPorId($id) {
        return $this->usuarioRepository->usuarioPorId($id);
    }

    /**
     * Actualiza la información de un usuario en la base de datos.
     *
     * @param array $usuario Datos actualizados del usuario.
     * @return bool Verdadero si la actualización es exitosa, falso de lo contrario.
     */
    public function actualizarUsuario($usuario) {
        return $this->usuarioRepository->actualizarUsuario($usuario);
    }

    /**
     * Elimina un usuario de la base de datos por su ID.
     *
     * @param int $id El identificador del usuario a eliminar.
     * @return bool Verdadero si la eliminación es exitosa, falso de lo contrario.
     */
    public function borrarUsuario($id) {
        return $this->usuarioRepository->borrarUsuario($id);
    }

}

