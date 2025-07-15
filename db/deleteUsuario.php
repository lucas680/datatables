<?php

include_once "./conexao.php";

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    $retorno = [
        'success' => false,
        'message' => '<div class="alert alert-danger" role="alert">
  Erro: Usuário não encontrado!
</div>'
    ];
} else {
    $query_usuario = "DELETE FROM usuarios WHERE id=:id";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':id', $id, PDO::PARAM_INT);
    
    if($result_usuario->execute()){
$retorno = [
        'success' => true,
        'message' => '<div class="alert alert-success" role="alert">
  Usuário deletado com sucesso!
</div>'
    ];
    }else{
$retorno = [
        'success' => false,
        'message' => '<div class="alert alert-danger" role="alert">
  Erro: não foi possível deletar usuário!
</div>'
    ];
    }
}

echo json_encode($retorno);
