<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables Estudo</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap4.css">
</head>

<body>
    <div class="container">
        <div class="d-flex align-items-center justify-content-between pt-3 pb-2">
            <h1 class="display-5 mb-4">Listar usuários</h1>
            <button type="button" class="btn btn-outline-success btn-sm"
                data-bs-toggle="modal" data-bs-target="#cadUsuarioModal">Cadastrar</button>
        </div>
        <span id="msgAlert"></span>
        <table id="table-list-users" class="display" style="width: 100%;">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Salário</th>
                    <th>Idade</th>
                    <th>Ações</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cadUsuarioModal" tabindex="-1" aria-labelledby="cadUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadUsuarioModalLabel">Cadastrar usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-cad-usuario">
                        <span id="msgAlertErrorCad"></span>
                        <div class="row mb-3">
                            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome completo">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="salario" class="col-sm-2 col-form-label">Salário</label>
                            <div class="col-sm-10">
                                <input type="number" name="salario" class="form-control" id="salario" placeholder="Seu Salário">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="idade" class="col-sm-2 col-form-label">Idade</label>
                            <div class="col-sm-10">
                                <input type="number" name="idade" class="form-control" id="idade" placeholder="Sua Idade">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-success btn-sm" value="Cadastrar">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="visUsuarioModal" tabindex="-1" aria-labelledby="visUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visUsuarioModalLabel">Detalhes do usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <dl class="row">
                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9"><span id="idUsuario"></span></dd>

                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9"><span id="nomeUsuario"></span></dd>

                    <dt class="col-sm-3">Salário</dt>
                    <dd class="col-sm-9"><span id="salarioUsuario"></span></dd>

                    <dt class="col-sm-3">Idade</dt>
                    <dd class="col-sm-9"><span id="idadeUsuario"></span></dd>
                  </dl>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/custom.js"></script>
</body>

</html>