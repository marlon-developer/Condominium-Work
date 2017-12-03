<?php
//conecta-se ao banco

include_once "./ClassContaBancaria.php";
$objectContaBancaria = new ContaBancaria;

$action = 1;

if ( !empty($_GET["action"]) ) {
    $action = $_GET["action"];
}

switch ($action) {

    case "add":
        $objectContaBancaria->add($_POST);
        $redirect = true;
        break;
    
    case "edit":
        echo "edit";
        # code...
        break;
    
    case "delete":
        # code...
        $objectContaBancaria->delete($_GET['id']);
        $redirect = true;
        break;
    
    default:
        # code...
        $redirect = true;
        break;
}

if ( $redirect ) {
    header("Location: ../pages/forms/ContaBancaria.php");
    die();
}
