<?php

require 'connection.php';

if (!isset($_SESSION)) {
    session_start();
}


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
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
    <?php include('message.php'); ?>
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
                                            <button class="btn btn-link text-secondary me-2 text-decoration-none btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#deleteBook">Excluir</button>
                                            <button class="btn btn-dark rounded-pill btn-sm" type="submit" name="update_book">Salvar</button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="title" class="col-sm-2 col-form-label">Título</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Título do livro" value="<?= htmlspecialchars($book['title']) ?>">
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
                                                <?php if ($_SESSION['user']): ?>
                                                    <option value="<?= htmlspecialchars($_SESSION['user']['id']) ?>" selected>
                                                        <?= htmlspecialchars($_SESSION['user']['name']) ?>
                                                    </option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal" id="deleteBook" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteBookLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteBookLabel">Deletar Livro</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Deseja apagar mesmo este livro?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link text-secondary me-2 text-decoration-none btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" name="delete_book" class="btn btn-dark rounded-pill">Confirmar</button>
                                                </div>
                                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>