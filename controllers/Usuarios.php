<?php
    require_once "models/Usuario.php";
    class Usuarios{

        private $sesion;
        public function __construct(){
          $this->sesion = $_SESSION['sesion'];
        }
        public function main(){
          if (!empty($_SESSION['sesion'])) {
            header("Location: ?c=Dashboard");
          } else {
            header("Location: ?");
          }
        }
        
        public function crearRol(){
          if ($this->sesion == 'admin') { 
            if ($_SERVER['REQUEST_METHOD'] == 'GET'){
                require_once "views/modulos/usuarios/crear_rol.view.php";
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $rol = new Usuario;
                $rol->setRolCode(null);
                $rol->setRolNombre($_POST['rol_nombre']);
                $rol->rolCrear();
                header("Location:?c=Usuarios&a=consultarRoles");
            }
          } else {
             header("Location: ?c=Dashboard");
          }
        }
        public function consultarRoles(){
          if ($this->sesion == 'admin' || $this->sesion == 'seller') {
            $roles = new Usuario;
            $roles = $roles->rolesConsultar();
            require_once "views/modulos/usuarios/consultar_rol.view.php";
          } else {
             header("Location: ?c=Dashboard");
          }  
        }        
        public function actualizarRol(){
          if ($this->sesion == 'admin') {
            if ($_SERVER['REQUEST_METHOD'] == 'GET'){
                $rolUpd = new Usuario;
                $rolUpd = $rolUpd->getRolById($_GET['idRol']);
                require_once "views/modulos/usuarios/actualizar_rol.view.php";                
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $rol = new Usuario;
                $rol->setRolCode($_POST['rol_code']);
                $rol->setRolNombre($_POST['rol_nombre']);
                $rol->rolActualizar();
                header("Location:?c=Usuarios&a=consultarRoles");
            }
          } else {
            header("Location: ?c=Dashboard");
          }
        }        
        public function eliminarRol(){
            $rol = new Usuario;
            $rol->rolEliminar($_GET['idRol']);
            header("Location:?c=Usuarios&a=consultarRoles");            
        }
    }
?>