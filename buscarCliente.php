<?php
try {
    $mbd = new PDO('mysql:host=localhost;dbname=Sistema_de_envios', 'root', '');
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {   
    $sql=$mbd->prepare("SELECT * FROM Cliente WHERE id = :id");
    $sql->bindParam(':id', $_GET['id']);
    $sql-> execute();
    $cliente = $sql->fetchAll(PDO::FETCH_ASSOC);
    $mbd = null;

    header('Content-type:application/json;charset=utf-8');
    echo json_encode($cliente);

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>