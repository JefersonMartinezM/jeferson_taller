<?php
try {
    $mbd = new PDO('mysql:host=localhost;dbname=Sistema_de_envios', 'root', '');
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

$post = json_decode(file_get_contents("php://input"), true);
print_r($post);
try{
    $sql = $mbd->prepare("INSERT INTO Pedido (id_cliente, nombre, fecha_entrega, fecha_pedido, precio, categoria, direccion, email) VALUES (:idc, :nom, :fent, :fped, :pre, cat, :dir, :ema)");
    $sql -> bindParam(':idc', $post['id_cliente']);
    $sql -> bindParam(':nom', $post['nombre']);
    $sql -> bindParam(':fent', $post['fecha_entrega']);
    $sql -> bindParam(':fped', $post['fecha_pedido']);
    $sql -> bindParam(':pre', $post['precio']);
    $sql -> bindParam(':cat', $post['categoria']);
    $sql -> bindParam(':dir', $post['direccion']);
    $sql -> bindParam(':ema', $post['email']);
    $sql -> execute();

    header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            $post
        ]);
    } catch (PDOException $e) {
        header('Content-type:application/json;charset=utf-8');
        echo json_encode([
            'error' => [
                'codigo' => $e->getCode(),
                'mensaje' => $e->getMessage()
            ]
        ]);
    }