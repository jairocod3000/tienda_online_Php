<?php

namespace Controllers;
use Models\Usuario;
use Lib\Pages;
use Utils\Utils;
use Services\UsuarioService;
use Repositories\UsuarioRepository;

class UsuarioController {
    private Pages $pages;
    private UsuarioService $usuarioService;
    private $errores = [];

    public function __construct() {
        $this->pages = new Pages();
        $this->usuarioService = new UsuarioService(new UsuarioRepository());
    }

    public function verTodos() {
        $usuarios = $this->usuarioService->verTodos();
        $this->pages->render('/usuario/verTodos', ['usuarios' => $usuarios]);
    }

    private function validarFormulario($data) {
        $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
        $apellidos = filter_var($data['apellidos'], FILTER_SANITIZE_STRING);
        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($data['password'], FILTER_SANITIZE_STRING);

        $nombreRegex = "/^[a-zA-ZáéíóúÁÉÍÓÚ ]*$/";
        $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $passwordRegex = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/";

        if (empty($nombre) || !preg_match($nombreRegex, $nombre)) {
            $this->errores[] = 'El nombre solo debe contener letras y espacios.';
        }
        if (empty($apellidos) || !preg_match($nombreRegex, $apellidos)) {
            $this->errores[] = 'Los apellidos solo deben contener letras y espacios.';
        }
        if (empty($email) || !preg_match($emailRegex, $email)) {
            $this->errores[] = 'El correo electrónico no es válido.';
        }
        if (empty($password) || !preg_match($passwordRegex, $password)) {
            $this->errores[] = 'La contraseña debe tener al menos una letra, un número y un mínimo de 8 caracteres.';
        }

        if (empty($this->errores)) {
            return [
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT, ['cost'=>4])
            ];
        } else {
            return $this->errores;
        }
    }

    private function validarLogin($data) {
        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($data['password'], FILTER_SANITIZE_STRING);

        $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $passwordRegex = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/";

        if (!preg_match($emailRegex, $email)) {
            $this->errores[] = 'El correo electrónico no es válido.';
        }
        if (!preg_match($passwordRegex, $password)) {
            $this->errores[] = 'La contraseña debe tener al menos una letra, un número y un mínimo de 8 caracteres.';
        }

        if (empty($this->errores)) {
            return [
                'email' => $email,
                'password' => $password
            ];
        } else {
            return false;
        }
    }

    public function registro() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['data']) {
                $registrado = $this->validarFormulario($_POST['data']);

                if ($registrado != "") {
                    if (is_array($registrado)) {
                        $usuario = Usuario::fromArray($registrado);
                        $save = $this->usuarioService->create($usuario);
                        $registrado = "";
                        $_SESSION['register'] = $save ? "complete" : "failed";
                    } else {
                        $_SESSION['register'] = "failed";
                    }
                } else {
                    $_SESSION['register'] = "failed";
                }
            }
        }

        $this->pages->render('/usuario/registro', ['errores' => $this->errores]);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['data'])) {
                $login = $this->validarLogin($_POST['data']);

                if ($login !== false) {
                    $usuario = Usuario::fromArray($login);
                    $verify = $this->usuarioService->login($usuario);

                    if ($verify !== false) {
                        $_SESSION['login'] = $verify;
                        if (isset($_POST['recordar']) && isset($verify->email)) {
                            setcookie('usuario_recordado', $verify->email, time() + (86400 * 7), "/");
                        }
                    } else {
                        $_SESSION['login'] = "failed";
                    }
                } else {
                    $_SESSION['login'] = "failed";
                }
            } else {
                $_SESSION['login'] = "failed";
            }
        }

        $this->pages->render('/usuario/login', ['errores' => $this->errores]);
    }

    public function logout() {
        Utils::removeSession('login');

        // Borrar cookie
        setcookie('usuario_recordado', '', time() - 1000, "/");

        header("Location:" . BASE_URL);
    }

    public function eliminar($id) {
        $this->usuarioService->borrarUsuario($id);
        header("Location:" . BASE_URL . "usuario/verTodos");
    }

    public function editar($id) {
        $usuarios = $this->usuarioService->verTodos();
        $this->pages->render('/usuario/verTodos', ['usuarios' => $usuarios, 'id' => $id]);
    }

    public function editarMiPerfil() {
        $this->pages->render('/usuario/editarMiPerfil');
    }

    public function actualizarMiPerfil() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = htmlspecialchars(trim($_POST['nombre']));
            $apellidos = htmlspecialchars(trim($_POST['apellidos']));

            $save = $this->usuarioService->actualizarNombreApellidos($id, $nombre, $apellidos);
            $_SESSION['perfil_update'] = $save ? "complete" : "failed";

            if (isset($_SESSION['login'])) {
                $_SESSION['login']->nombre = $nombre;
                $_SESSION['login']->apellidos = $apellidos;
            }
        }

        header("Location:" . BASE_URL);
    }

    public function validarEditar($data) {
        $id = filter_var($data['id'], FILTER_SANITIZE_STRING);
        $nombre = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
        $apellidos = filter_var($data['apellidos'], FILTER_SANITIZE_STRING);
        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        $rol = filter_var($data['rol'], FILTER_SANITIZE_STRING);

        $nombreRegex = "/^[a-zA-ZáéíóúÁÉÍÓÚ ]*$/";
        $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

        if (!preg_match($nombreRegex, $nombre)) {
            $this->errores[] = 'El nombre solo debe contener letras y espacios.';
        }
        if (!preg_match($nombreRegex, $apellidos)) {
            $this->errores[] = 'Los apellidos solo deben contener letras y espacios.';
        }
        if (!preg_match($emailRegex, $email)) {
            $this->errores[] = 'El correo electrónico no es válido.';
        }

        if (empty($this->errores)) {
            return [
                'id' => $id,
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'rol' => $rol
            ];
        } else {
            return $this->errores;
        }
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['data']) {
                $registrado = $this->validarEditar($_POST['data']);

                if ($registrado != "") {
                    $usuario = Usuario::fromArray($registrado);
                    $save = $this->usuarioService->actualizarUsuario($usuario);
                    $_SESSION['register'] = $save ? "complete" : "failed";
                } else {
                    $_SESSION['register'] = "failed";
                }
                $usuario->desconecta();
            }
        }
        header("Location:" . BASE_URL . "usuario/verTodos");
    }
}
