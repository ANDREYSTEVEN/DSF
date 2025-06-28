<?php
    class Dashboard{
        public function main(){
            $sesion = $_SESSION['sesion'];            
            if (!empty($_SESSION['sesion'])) {
                require_once "views/roles/" . $sesion . "/". $sesion . ".view.php";
            } else {
                header("Location: ?");
            }
        }
    }
?>