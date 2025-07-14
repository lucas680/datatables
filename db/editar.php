<?php

require_once "./conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['editId'])) {
    $retorno = [
        'success' => false,
        'message' => '<div class="alert alert-danger" role="alert">
  Erro: Tente mais tarde!
</div>'
    ];
} else if (empty($dados['editNome'])) {
    $retorno = [
        'success' => false,
        'message' => '<div class="alert alert-danger" role="alert">
  Erro: Necessário preencher o campo nome!
</div>'
    ];
} else if (empty($dados['editSalario'])) {
    $retorno = [
        'success' => false,
        'message' => '<div class="alert alert-danger" role="alert">
  Erro: Necessário preencher o campo salário!
</div>'
    ];
} else if (empty($dados['editIdade'])) {
    $retorno = [
        'success' => false,
        'message' => '<div class="alert alert-danger" role="alert">
  Erro: Necessário preencher o campo idade!
</div>'
    ];
} else {
    $query_usuario = "UPDATE usuarios SET nome=:nome, salario=:salario, idade=:idade WHERE id=:id";
    $edit_usuario = $conn->prepare($query_usuario);
    $edit_usuario->bindParam(":nome", $dados['editNome'], PDO::PARAM_STR);
    $edit_usuario->bindParam(":salario", $dados['editSalario'], PDO::PARAM_INT);
    $edit_usuario->bindParam(":idade", $dados['editIdade'], PDO::PARAM_INT);
    $edit_usuario->bindParam(":id", $dados['editId'], PDO::PARAM_INT);

    if ($edit_usuario->execute()) {
        $retorno = [
            'success' => true,
            'message' => '<div class="alert alert-success" role="alert">
  Usuário editado com sucesso.
</div>'
        ];
    } else {
        $retorno = [
            'success' => false,
            'message' => '<div class="alert alert-danger" role="alert">
  Erro: Usuário não editado com sucesso!
</div>'
        ];
    }
}

echo json_encode($retorno);
