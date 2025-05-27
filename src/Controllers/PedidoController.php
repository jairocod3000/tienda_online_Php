<?php

namespace Controllers;

use Repositories\PedidoRepository;
use Repositories\ProductoRepository;
use Services\ProductoService;
use Utils\Utils;
use Lib\Pages;
use Services\PedidoService;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function dd(...$vars) {
    echo '<pre>';
    foreach ($vars as $var) {
        echo '<br>';
        print_r($var);
    }
    echo '</pre>';
    die();
}

/**
 * Clase PedidoController
 *
 * Esta clase maneja la lógica para las acciones relacionadas con los pedidos.
 */
class PedidoController {
    private Pages $pages;
    private PedidoService $pedidoService;
    private ProductoService $productoService; 

    /**
     * Constructor de PedidoController.
     *
     * Inicializa una nueva instancia de la clase PedidoController.
     */
    public function __construct() {
        $this->pages = new Pages();
        $this->pedidoService = new PedidoService(new PedidoRepository());
        $this->productoService = new ProductoService(new ProductoRepository());
    }

    /**
     * Obtiene todos los pedidos.
     *
     * @return array Los pedidos obtenidos.
     */
    public function mostrarPedido(){
        if(!isset($_SESSION['login'])){
            $this->pages->render('usuario/login' , ['errores' => 'No hay productos en el carrito']);
        }
        elseif(isset($_SESSION['login']) && count($_SESSION['carrito']) >= 1){
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['cantidad'] > $elemento['stock']) {
                    $errores = 'No hay suficiente stock para el producto ' . $elemento['nombre'];
                    $total = $this->pedidoService->getTotalCarrito($_SESSION['carrito']);
                    $this->pages->render('carrito/ver' , ['errores' => $errores, 'productos' => $_SESSION['carrito'], 'total' => $total]);
                }
            }
        
            $this->pages->render('pedido/crear');
        } elseif (isset($_SESSION['login']) && count($_SESSION['carrito']) == 0) {
            $this->pages->render('carrito/ver' , ['errores' => 'No hay productos en el carrito']);
        }
    }

    /**
     * Obtiene todos los pedidos.
     *
     * @return array Los pedidos obtenidos.
     */
    public function todosLosPedidos(){
        if (!isset($_SESSION['login'])) {
            header('Location: ' . BASE_URL . 'usuario/login');
        }
        else {
            $usuario = $_SESSION['login'];
            if ($usuario->rol == 'admin') {
                $pedidos = $this->pedidoService->recuperarTodosPedidos();
                $this->pages->render('pedido/gestionarPedidos', ['pedidos' => $pedidos]);
            }
            else {
                header('Location: ' . BASE_URL . 'usuario/login');
            }
        }
    }

    /**
     * Obtiene todos los pedidos de un usuario.
     *
     * @return array Los pedidos obtenidos.
     */
    public function misPedidos(){
        if (!isset($_SESSION['login'])) {
            header('Location: ' . BASE_URL . 'usuario/login');
        }
        else {
            $usuario = $_SESSION['login'];
            $pedidos = $this->pedidoService->obtenerPedidosPorUsuario($usuario->id);
            $this->pages->render('pedido/misPedidos', ['pedidos' => $pedidos]);
        }
    }

    /**
     * Valida un pedido
     */
    public function validarPedido($provincia, $localidad, $direccion) {
        $errores = [];
        if (empty($provincia) || strlen($provincia) < 2) {
            $errores['provincia'] = 'La provincia no puede estar vacía y debe tener al menos 2 caracteres';
        }
        if (empty($localidad) || strlen($localidad) < 2) {
            $errores['localidad'] = 'La localidad no puede estar vacía y debe tener al menos 2 caracteres';
        }
        if (empty($direccion) || strlen($direccion) < 5) {
            $errores['direccion'] = 'La dirección no puede estar vacía y debe tener al menos 5 caracteres';
        }
        return $errores;
    }

    /**
     * Crea un pedido
     */
    public function crear () {

        if (!isset($_SESSION['login']) || $_SESSION['carrito'] == "") {
            header('Location: ' . BASE_URL . 'usuario/login');
        }

        else {
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $coste = isset($_POST['coste']) ? $_POST['coste'] : false;
            $estado = 'pendiente';
            $fecha = Utils::getCurrentDate();
            $hora = Utils::getCurrentTime();

            $errores = $this->validarPedido($provincia, $localidad, $direccion);

            if (!empty($errores)) {
                $this->pages->render('pedido/crear', ['errores' => $errores]);
            } else {
            
            $usuario = $_SESSION['login'];
            $carrito = $_SESSION['carrito'];
            $total = $this->pedidoService->getTotalCarrito($carrito);
            $pedido = $this->pedidoService->guardarPedido($usuario->id, $provincia, $localidad, $direccion, $total, $estado, $fecha, $hora, $carrito);
            unset($_SESSION['carrito']);
            header('Location: ' . BASE_URL . 'pedido/misPedidos');
            
            }
        }
    }

    /**
     * Elimina un pedido
     */
    public function eliminar($id){
        $usuario = $_SESSION['login'];

        if ($usuario->rol == 'admin') {
            $this->pedidoService->eliminarPedido($id);
            header('Location: ' . BASE_URL . 'pedido/todosLosPedidos');
        }
    }

    /**
     * Edita un pedido
     */
    public function editar($id){
        $pedidos = $this->pedidoService->recuperarTodosPedidos();
        $this->pages->render('pedido/gestionarPedidos', ['pedidos' => $pedidos, 'id' => $id]);
    }

    /**
     * Valida un pedido al actualizarlo
     */
    public function validarPedidoActualizado($data) {
        $errores = [];
        if (empty($data['coste']) || !is_numeric($data['coste'])) {
            $errores['coste'] = 'El coste es requerido y debe ser un número';
        }
        return $errores;
    }

    public function actualizar(){
        $usuario = $_SESSION['login'];
        $pedido = $_POST['data'];
        $id = $pedido['id'];
        $coste = $pedido['coste'];
        $usuario_id = $pedido['usuario_id'];
        
        if ($usuario->rol == 'admin') {
            $data = $_POST['data'];
            
    
            if (!empty($errores)) {
                $pedidos = $this->pedidoService->recuperarTodosPedidos();
                $this->pages->render('pedido/gestionarPedidos', ['pedidos' => $pedidos ,'errores' => $errores]);
            } else {
                $this->pedidoService->actualizarPedido($id, $coste, $usuario_id);
                header('Location: ' . BASE_URL . 'pedido/todosLosPedidos');
            }
        }
    }

    public function confirmarPedido($id) {
        $usuario = $_SESSION['login'];
        $usuario_email = $this->pedidoService->getUsuarioPedido($id);

        if ($usuario->rol == 'admin') {
            
            $this->pedidoService->confirmarPedido($id);
            
            $this->enviarEmail($id, $usuario_email);
            header('Location: ' . BASE_URL . 'pedido/todosLosPedidos');
        }

    }


    /**
     * Envia un correo electrónico al cliente.
     * @return void
     */
    public function enviarEmail($id, $usuario_email) {
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = 'jairoalejandro71@gmail.com';
        $mail->Password = 'ezas onxe xcfx mdua';

        $mail->setFrom('jairoalejandro71@gmail.com', 'Tienda de Jairo');
        $mail->addReplyTo('replyto@example.com', 'First Last');
        $mail->addAddress($usuario_email, 'Cliente');
        $mail->Subject = 'Ya puede recoger su pedido en la tienda online';
        ob_start();
        $nombre = $_SESSION['login']->nombre;
        $idPedido = $id;
        
        $fecha = Utils::getCurrentDate();
        $hora = Utils::getCurrentTime();
        
        include __DIR__ . '/../Views/pedido/correo.php';
        $html = ob_get_contents();
        ob_end_clean();
        $mail->msgHTML($html, __DIR__);
        $mail->AltBody = '';
        $mail->SMTPDebug = 0;

        if (!$mail->send()) {
            dd("ërror");
        } else {
            header('Location: ' . BASE_URL . 'pedido/misPedidos');
        }
    }
    
        //Section 2: IMAP
        //IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
        //Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
        //You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
        //be useful if you are trying to get this working on a non-Gmail IMAP server.
        function save_mail($mail)
        {
            //You can change 'Sent Mail' to any other folder or tag
            $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
    
            //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
            $imapStream = imap_open($path, $mail->Username, $mail->Password);
    
            $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
            imap_close($imapStream);
    
            return $result;
        }
        
        }

