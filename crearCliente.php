<?php
try {
    $mbd = new PDO('mysql:host=localhost;dbname=Sistema_de_envios', 'root', '');
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

$post = json_decode(file_get_contents("php://input"), true);
try{
    $sql = $mbd->prepare("INSERT INTO Cliente (Nombre, Direccion, Telefono) VALUES (:nom, :dir, :tel)");
    $sql -> bindParam(':nom', $post['Nombre']);
    $sql -> bindParam(':dir', $post['Direccion']);
    $sql -> bindParam(':tel', $post['Telefono']);
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