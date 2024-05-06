<?php
class Almacen extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        // verificacion del permiso 
        $perm = $this->model->verificarPermisos($id_user, "Almacen");
        if (!$perm && $id_user != 1) {
            // no tines permiso 
            $this->views->getView($this, "permisos");
            exit;
        }
    }
    /*public function index()
    {
        $this->views->getView($this, "listar");
    }*/

    public function Solicitudes(){
        $this->views->getView($this, "solicitudes");
    }

    public function listarTareas(){
        $data = $this->model->listarTareas();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
