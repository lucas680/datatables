<?php

require_once "./conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nome'])) {
    $retorno = [
        'success' => false,
        'message' => '<div class="alert alert-danger" role="alert">
  Erro: Necessário preencher o campo nome!
</div>'
    ];
} else if (empty($dados['salario'])) {
    $retorno = [
        'success' => false,
        'message' => '<div class="alert alert-danger" role="alert">
  Erro: Necessário preencher o campo salário!
</div>'
    ];
} else if (empty($dados['idade'])) {
    $retorno = [
        'success' => false,
        'message' => '<div class="alert alert-danger" role="alert">
  Erro: Necessário preencher o campo idade!
</div>'
    ];
} else {
    $query_usuario = "INSERT INTO usuarios (nome, salario, idade) VALUES (:nome, :salario, :idade)";
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(":nome", $dados['nome'], PDO::PARAM_STR);
    $cad_usuario->bindParam(":salario", $dados['salario'], PDO::PARAM_INT);
    $cad_usuario->bindParam(":idade", $dados['idade'], PDO::PARAM_INT);
    $cad_usuario->execute();

    if ($cad_usuario->rowCount()) {
        $retorno = [
            'success' => true,
            'message' => '<div class="alert alert-success" role="alert">
  Usuário cadastrado com sucesso.
</div>'
        ];
    } else {
        $retorno = [
            'success' => false,
            'message' => '<div class="alert alert-danger" role="alert">
  Erro: Usuário não cadastrado com sucesso!
</div>'
        ];
    }
}

echo json_encode($retorno);
