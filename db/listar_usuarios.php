<?php

include_once './conexao.php';

//receber dados da requisição
$dados_requisicao = $_REQUEST;

//lista de colunas da tabela
$colunas = [
    0 => 'id',
    1 => 'nome',
    2 => 'salario',
    3 => 'idade',
];

//listando quantidade de usuários
$query_qnt_usuarios = "SELECT COUNT(id) AS qnt_usuarios FROM usuarios";
//Se tem pesquisa fazer
if(!empty($dados_requisicao['search']['value'])){
    $query_qnt_usuarios .= " WHERE id::text LIKE :id "; 
    $query_qnt_usuarios .= " OR nome::text ILIKE :nome "; 
    $query_qnt_usuarios .= " OR salario::text LIKE :salario "; 
    $query_qnt_usuarios .= " OR idade::text LIKE :idade "; 
}
$result_qnt_usuarios = $conn->prepare($query_qnt_usuarios);
if(!empty($dados_requisicao['search']['value'])){
    $valor_pesq = "%".$dados_requisicao['search']['value']."%";
    $result_qnt_usuarios->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':salario', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':idade', $valor_pesq, PDO::PARAM_STR);
}
$result_qnt_usuarios->execute();
$row_qnt_usuarios = $result_qnt_usuarios->fetch(PDO::FETCH_ASSOC);

//listando usuários

$query_usuarios = "SELECT id, nome, salario, idade 
                    FROM usuarios";

//Se tem pesquisa fazer
if(!empty($dados_requisicao['search']['value'])){
    $query_usuarios .= " WHERE id::text LIKE :id "; 
    $query_usuarios .= " OR nome::text ILIKE :nome "; 
    $query_usuarios .= " OR salario::text LIKE :salario "; 
    $query_usuarios .= " OR idade::text LIKE :idade "; 
}

$query_usuarios .= " ORDER BY " . $colunas[$dados_requisicao['order'][0]['column']]. 
" " . $dados_requisicao['order'][0]['dir'] . " LIMIT :quantidade OFFSET :inicio";

$result_usuarios = $conn->prepare($query_usuarios);
$result_usuarios->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);
$result_usuarios->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);

if(!empty($dados_requisicao['search']['value'])){
    $valor_pesq = "%".$dados_requisicao['search']['value']."%";
    $result_usuarios->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':salario', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':idade', $valor_pesq, PDO::PARAM_STR);
}

$result_usuarios->execute();

while ($row_usuarios = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
    extract($row_usuarios);
    $registro = [];
    $registro[] = $id;
    $registro[] = $nome;
    $registro[] = $salario;
    $registro[] = $idade;
    $registro[] = '<button type="button" id="'.$id.'" onClick="visUsuario('.$id.')" class="btn btn-outline-primary">Visualizar</button>';
    $dados[] = $registro;
}

$resultado = [
    "draw" => intval($dados_requisicao["draw"]), // para cada requisição é enviado um número como parâmetro
    "recordsTotal" => intval($row_qnt_usuarios["qnt_usuarios"]), // quantidade de registros do banco
    "recordsFiltered" => intval($row_qnt_usuarios["qnt_usuarios"]), // quantidade de registros quando há pesquisa
    "data" => $dados, // registros retornados
];

//retornando para o javascript
echo json_encode($resultado);
