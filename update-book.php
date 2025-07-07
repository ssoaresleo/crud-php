<?php

session_start();

require 'connection.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Atualizar Livro</title>

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
                    <?php

                    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
                        $id = (int) $_GET['id'];

                        try {
                            $sql = 'SELECT * FROM books WHERE id=?';
                            $stmt = $conn->prepare($sql);
                            $stmt->execute([$id]);

                            $book = $stmt->fetch();

                            if (!$book) {
                                $_SESSION['message'] = [
                                    'text' => "Parece que esse livro não existe!",
                                    'type' => 'warning'
                                ];
                                header('Location: index.php');
                                exit;
                            }
                        } catch (PDOException $err) {
                            $_SESSION['message'] = [
                                'text' => "Ouve um problema ao buscar o livro",
                                'type' => 'danger'
                            ];
                            header('Location: index.php');
                            exit;
                        }
                    ?>

                        <div class="card border-0 shadow-sm p-3">
                            <div class="card-body">
                                <form method="POST" action="process.php">
                                    <input type="hidden" name="id" value="<?= $book['id'] ?>">

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h5>Editar Livro</h5>
                                        <div class="d-flex align-items-center">
                                            <a href="/excluir-livro.php?id=123" class="btn btn-link text-secondary me-2 text-decoration-none btn-sm">Excluir</a>
                                            <button class="btn btn-dark rounded-pill btn-sm" type="submit" name="update_book">Salvar</button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="titulo" class="col-sm-2 col-form-label">Título</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título do livro" value="<?= htmlspecialchars($book['title']) ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="author" class="col-sm-2 col-form-label">Autor</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="author" name="author" placeholder="Autor do livro" value="<?= htmlspecialchars($book['author']) ?>">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="status" class="col-sm-2 col-form-label">Situação</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="status" name="status">
                                                <option value="disponivel" <?= $book['status'] === 'disponivel' ? 'selected' : '' ?>>Disponível</option>
                                                <option value="emprestado" <?= $book['status'] === 'emprestado' ? 'selected' : '' ?>>Emprestado</option>
                                                <option value="reservado" <?= $book['status'] === 'reservado' ? 'selected' : '' ?>>Reservado</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="checked_out_by" class="col-sm-2 col-form-label">Retirado por</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="checked_out_by" name="checked_out_by">
                                                <option value="João Ferreira" <?= $book['checked_out_by'] === 'João Ferreira' ? 'selected' : '' ?>>João Ferreira</option>
                                                <option value="Maria Souza" <?= $book['checked_out_by'] === 'Maria Souza' ? 'selected' : '' ?>>Maria Souza</option>
                                                <option value="Ana Oliveira" <?= $book['checked_out_by'] === 'Ana Oliveira' ? 'selected' : '' ?>>Ana Oliveira</option>
                                                <option value="Carlos Lima" <?= $book['checked_out_by'] === 'Carlos Lima' ? 'selected' : '' ?>>Carlos Lima</option>
                                            </select>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    <?php
                    } else {
                        $_SESSION['message'] = [
                            'text' => "Id inválido.",
                            'type' => 'danger'
                        ];
                        header('Location: index.php');
                        exit;
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

</body>

</html>