<?php

session_start();

require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_book'])) {
    $title = $_POST['title'] ?? null;
    $author = $_POST['author'] ?? null;
    $status = $_POST['status'] ?? null;
    $checked_out_by = $_POST['checked_out_by'] ?? null;

    if (!empty($title) && !empty($author) && !empty($status) && !empty($checked_out_by)) {
        try {
            $sql = "INSERT INTO books (title, author,`status`, checked_out_by) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$title, $author, $status, $checked_out_by]);

            $_SESSION['message'] = [
                'text' => 'Livro registrado com sucesso!',
                'type' => 'success'
            ];

            header('Location: index.php');
            exit;
        } catch (PDOException $err) {
            $_SESSION['message'] = [
                'text' => 'Ouve um erro ao registrar um livro!',
                'type' => 'danger'
            ];
            exit;
        }
    } else {
        $_SESSION['message'] = [
            'text' => 'Preencha todos os campos pedidos!',
            'type' => 'alert'
        ];
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_book'])) {
    $book_id = $_POST['id'] ?? null;
    $title = $_POST['title'] ?? null;
    $author = $_POST['author'] ?? null;
    $status = $_POST['status'] ?? null;
    $checked_out_by = $_POST['checked_out_by'] ?? null;

    if (!$book_id || !is_numeric($book_id)) {
        $_SESSION['message'] = [
            'text' => 'ID do livro inválido.',
            'type' => 'danger'
        ];

        header('Location: index.php');
        exit;
    }

    if (!empty($title) && !empty($author) && !empty($status) && !empty($checked_out_by)) {
        try {
            $sql = "UPDATE books SET title=?, author=?,`status`=?, checked_out_by=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$title, $author, $status, $checked_out_by, $book_id]);

            $_SESSION['message'] = [
                'text' => 'Livro atualizado com sucesso!',
                'type' => 'success'
            ];

            header('Location: index.php');
            exit;
        } catch (PDOException $err) {
            $_SESSION['message'] = [
                'text' => 'Ouve um erro ao atualizar o livro!',
                'type' => 'warning'
            ];
            header('Location: update-book.php?id=' . $book_id);
            exit;
        }
    } else {
        $_SESSION['message'] = [
            'text' => 'Preencha todos os campos pedidos!',
            'type' => 'secondary'
        ];

        header('Location: update-book.php?id=' . $book_id);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_book'])) {
    $book_id = $_POST['id'] ?? null;

    if (!$book_id || !is_numeric($book_id)) {
        $_SESSION['message'] = [
            'text' => 'ID do livro inválido.',
            'type' => 'danger'
        ];

        header('Location: index.php');
        exit;
    }

    try {
        $sql = "DELETE FROM books WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$book_id]);

        $_SESSION['message'] = [
            'text' => 'Livro deletado com sucesso!',
            'type' => 'success'
        ];

        header('Location: index.php');
        exit;
    } catch (PDOException $err) {
        $_SESSION['message'] = [
            'text' => 'Ouve um erro ao deletar o livro!',
            'type' => 'warning'
        ];
        header('Location: update-book.php?id=' . $book_id);
        exit;
    }
}
