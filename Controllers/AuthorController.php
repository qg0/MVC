<?php

class AuthorController extends Controller
{
    public function addAction()
    {
        if ($_POST) {
            $sql  = 'INSERT INTO authors (name) VALUES ("'.$_POST['name'].'")';
            $this->conn->query($sql);

            header('Location: /');
        }

        $this->render('author_add', ['submited' => $_POST['name']], 'layout');
    }

    public function editAction()
    {
        $_GET['id'] = (int)$_GET['id'];

        if ($_POST) {
            $sql  = 'UPDATE authors SET name="'.$_POST['name'].'" WHERE id='.$_GET['id'];
            $this->conn->query($sql);

            header('Location: /');
        }

        $sql = 'SELECT * FROM authors WHERE id='.$_GET['id'];
        $author = $this->conn->query($sql);

        $this->render('author_edit', [
            'author'     => $author->fetch_assoc(),
            'submited'   => $_POST['name']
        ], 'layout');
    }

    public function booksAction()
    {
        $_GET['id'] = (int)$_GET['id'];

        $sql   = 'SELECT books.id as book_id, books.name as book_name FROM `authors_books` left join books on authors_books.book_id=books.id WHERE authors_books.author_id='.$_GET['id'];
        $books = $this->conn->query($sql);

        $sql = 'SELECT * FROM authors WHERE id='.$_GET['id'];
        $author = $this->conn->query($sql);

        $this->render('author_books', [
            'books'     => $books->fetch_all(MYSQLI_ASSOC),
            'author'     => $author->fetch_assoc(),
        ], 'layout');
    }

    public function coauthorsAction()
    {
        $author_ids = implode(', ', $_POST['authors']);

        $sql   = 'SELECT books.id as book_id, books.name as book_name FROM `authors_books` left join books on authors_books.book_id=books.id WHERE authors_books.author_id IN ('.$author_ids.') GROUP BY books.id';
        $books = $this->conn->query($sql);

        $sql = 'SELECT * FROM authors WHERE id IN ('.$author_ids.')';
        $authors = $this->conn->query($sql);

        $this->render('author_coauthors', [
            'books'   => $books->fetch_all(MYSQLI_ASSOC),
            'authors' => $authors->fetch_all(MYSQLI_ASSOC),
        ], 'layout');

    }
}