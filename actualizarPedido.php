<?php
try {
    $mbd = new PDO('mysql:host=localhost;dbname=Sistema_de_envios', 'root', '');
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

$post = json_decode(file_get_contents("php://input"), true);
try{
    $sql = $mbd->prepare("UPDATE Pedido SET id_cliente = :idc, nombre = :nom, fecha_entrega = :fent, fecha_pedido = :fped, precio = :pre, categoria = :cat, direccion = :dir, email = :ema WHERE id = :id");
    $sql -> bindParam(':id', $post['id']);
    $sql -> bindParam(':nom', $post['nombre']);
    $sql -> bindParam(':fent', $post['fecha_entrega']);
    $sql -> bindParam(':fped', $post['fecha_pedido']);
    $sql -> bindParam(':pre', $post['precio']);
    $sql -> bindParam(':cat', $post['categoria']);
    $sql -> bindParam(':dir', $post['direccion']);
    $sql -> bindParam(':ema', $post['email']);
    $sql -> execute();

    header('Content-type:application/json;charset=utf-8');
        echo json_encode([$post]);
    } catch (PDOException $e) {
        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'error' => [
                'codigo' => $e->getCode(),
                'mensaje' => $e->getMessage()
            ]
        ]);
    }