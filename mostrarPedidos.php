<?php
try {
    $mbd = new PDO('mysql:host=localhost;dbname=Sistema_de_envios', 'root', '');
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {    
    $sql=$mbd->prepare("SELECT * FROM Pedido");
    $sql->execute();
    $pedidos = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($pedidos);

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}