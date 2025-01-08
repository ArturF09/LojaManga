<?php
require_once 'response.php';

class PrincipalController{

    public function index(){
        include 'includes/header.php';
        include 'views/principalView.php';
        include 'includes/footer.php';
        
    }
}