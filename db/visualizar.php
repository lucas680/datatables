<?php

require_once "./conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    $retorno = [
        'success' => false,
        'message' => '<div class="alert alert-danger" role="alert">
  Erro ao buscar dados do usuário!
</div>'
    ];
} else {
    $query_usuario = "SELECT id, nome, salario, idade FROM usuarios WHERE id = :id LIMIT 1";
    $retornar_usuario = $conn->prepare($query_usuario);
    $retornar_usuario->bindParam(":id", $id, PDO::PARAM_INT);
    $retornar_usuario->execute();

    if (($retornar_usuario) and ($retornar_usuario->rowCount() != 0)) {
        $row_usuario = $retornar_usuario->fetch(PDO::FETCH_ASSOC);
        $retorno = [
            'success' => true,
            'dados' => $row_usuario
        ];
    } else {
        $retorno = [
            'success' => false,
            'message' => '<div class="alert alert-danger" role="alert">
  Erro ao buscar dados do usuário!
</div>'
        ];
    }
}

echo json_encode($retorno);
