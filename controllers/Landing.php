<?php

    class Landing{
        public function main(){
            require_once "views/empresa/header.view.php";
            require_once "views/empresa/index.view.php";
            require_once "views/empresa/footer.view.php";
        }
        public function about(){
            require_once "views/empresa/header.view.php";
            require_once "views/empresa/about.view.php";
            require_once "views/empresa/footer.view.php";
        }
    }
?>