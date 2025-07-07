<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Cadastrar Livro</title>

    <style>
        body {
            background-color: #f5f5f5;

        }
    </style>
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-4">
        <div class="row">
            <div>
                <div class="col-md-8 mx-auto">
                    <div class="card border-0 shadow-sm p-3">
                        <div class="card-body">
                            <form method="POST" action="process.php">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5>Cadastrar Livro</h5>
                                    <button href="/register-book.php" type="submit" name="register_book" class="btn btn-dark rounded-pill btn-sm">Salvar</button>
                                </div>
                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-2 col-form-label">Título</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Título do livro">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="author" class="col-sm-2 col-form-label">Autor</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="author" name="author" placeholder="Autor do livro">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="status" class="col-sm-2 col-form-label">Situação</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="status" name="status">
                                            <option selected disabled>Selecione o status</option>
                                            <option value="disponivel">Disponível</option>
                                            <option value="emprestado">Emprestado</option>
                                            <option value="reservado">Reservado</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="checked_out_by" class="col-sm-2 col-form-label">Retirado por</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="checked_out_by" name="checked_out_by">
                                            <option selected disabled>Selecione o usuário</option>
                                            <option value="João Ferreira">João Ferreira</option>
                                            <option value="Maria Souza">Maria Souza</option>
                                            <option value="Ana Oliveira">Ana Oliveira</option>
                                            <option value="Carlos Lima">Carlos Lima</option>
                                        </select>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>