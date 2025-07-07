<?php
session_start();

require 'connection.php'

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD simples PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

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
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm p-3">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                            <h5>Livros</h5>
                            <a href="/register-book.php" class="btn btn-dark rounded-pill btn-sm">Adicionar</a>
                        </div>
                        <div class="card-body mt-4">
                            <input type="text" class="form-control" placeholder="Buscar livro">
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th scope="col">Título</th>
                                        <th scope="col">Autor</th>
                                        <th scope="col">Situação</th>
                                        <th scope="col">Retirado por</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM books";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    if (empty($books)) {
                                        echo '<tr><td colspan="5" class="text-center">
                                        Nenhum livro encontrado.
                                        </td></tr>';
                                    } else {
                                        foreach ($books as $book):
                                    ?>
                                            <tr>
                                                <td> <a href="/update-book.php?id=<?= $book['id'] ?>" class="btn btn-link btn-sm">Editar</a></td>
                                                <td scope="col"><?= htmlspecialchars($book['title']) ?></td>
                                                <td scope="col"><?= htmlspecialchars($book['author']) ?></td>
                                                <td scope="col"><?= htmlspecialchars($book['status']) ?></td>
                                                <td scope="col"><?= htmlspecialchars($book['checked_out_by']) ?></td>
                                            </tr>
                                    <?php

                                        endforeach;
                                    }
                                    ?>





                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>