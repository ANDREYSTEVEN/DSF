<?php
    require_once "models/Usuario.php";
    class Login{
        function main(){
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (empty($_SESSION['sesion'])) {                    
                    require_once "views/empresa/header.view.php";                    
                    require_once "views/empresa/login.view.php";                    
                    require_once "views/empresa/footer.view.php";                    
                } else {
                    header("Location: ?c=Dashboard");
                }
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {                               
                $user = new Usuario($_POST['email'], $_POST['pass']);
                $user = $user->login();
                if ($user) {
                    $activo = $user->getUsuarioEstado();
                    if ($activo != 0) {
                         $sesion = $user->getRolCode();
                         if ($sesion == 1) {
                            $_SESSION['sesion'] = 'admin';
                        } elseif ($sesion == 2){
                             $_SESSION['sesion'] = 'customer';
                        } elseif ($sesion == 3){
                             $_SESSION['sesion'] = 'seller';
                        }
                        header("Location:?c=Dashboard");
                    } else {
                        require_once "views/empresa/login.view.php";
                        echo "USUARIO NO ESTÁ ACTIVO";
                    }
                    
                    // header ("Location: ?c=Dashboard");
                } else {
                    require_once "views/empresa/login.view.php";
                    echo "USUARIO NO ENCONTRADO";
                }
                
                
            }
        }
    }
?>