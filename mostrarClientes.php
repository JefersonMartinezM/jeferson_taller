<?php
try {
    $mbd = new PDO('mysql:host=localhost;dbname=Sistema_de_envios', 'root', '');
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {    
    $sql=$mbd->prepare("SELECT * from Cliente");
    $sql->execute();
    $clientes = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($clientes);

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}