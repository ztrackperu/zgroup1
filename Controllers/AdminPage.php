<?php
class AdminPage extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }
    public function index()
    {
		$id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "AdminPage");
        if (!$perm && $id_user != 1) {
            //cunado no eres usuario 1 y verifica que no tienes permiso
            //te manada a la vista NO TIENES PERMISO
            $this->views->getView($this, "permisos");
            exit;
        }
        //$data = $this->model->selectConfiguracion();
        // SI ES USUARIO 1 O tiene permiso se va a index de AdminPage
        $this->views->getView($this, "index");
    }

}