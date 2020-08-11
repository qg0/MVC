<?php

class BookController extends Controller
{
    public function addAction()
    {
        if ($_POST) {
            $sql  = 'INSERT INTO books (name) VALUES ("'.$_POST['name'].'")';
            $this->conn->query($sql);
            $last_id = $this->conn->insert_id;

            foreach ($_POST['authors'] as $author_id) {
                $sql  = 'INSERT INTO authors_books (book_id, author_id) VALUES ("'.$last_id.'", "'.$author_id.'")';
                $this->conn->query($sql);
            }

            header('Location: /?controller=book&action=edit&id='.$last_id);
        }

        $sql = 'SELECT * FROM authors';
        $authors = $this->conn->query($sql);

        $this->render('book_add', [
            'authors' => $authors->fetch_all(MYSQLI_ASSOC),
        ], 'layout');
    }

    public function deleteAction()
    {
        $sql = 'DELETE FROM books WHERE id='.(int)$_GET['id'];
        $this->conn->query($sql);
        header('Location: /');
    }

    public function editAction()
    {
        $_GET['id'] = (int)$_GET['id'];

        if ($_POST) {
            $sql  = 'UPDATE books SET name="'.$_POST['name'].'" WHERE id='.$_GET['id'];
            $this->conn->query($sql);

            $sql  = 'DELETE FROM authors_books WHERE book_id='.$_GET['id'];
            $this->conn->query($sql);

            foreach ($_POST['authors'] as $author_id) {
                $sql  = 'INSERT INTO authors_books (book_id, author_id) VALUES ("'.$_GET['id'].'", "'.$author_id.'")';
                $this->conn->query($sql);
            }

            header('Location: /');
        }

        $sql = 'SELECT * FROM books WHERE id='.$_GET['id'];
        $book = $this->conn->query($sql);

        $sql = 'SELECT * FROM authors';
        $authors = $this->conn->query($sql);

        $sql = 'SELECT author_id FROM authors_books WHERE book_id='.$_GET['id'];
        $checked_authors = $this->conn->query($sql);
        $checked_authors = $checked_authors->fetch_all(MYSQLI_ASSOC);

        $checked_author_ids = [];
        foreach ($checked_authors as $checked_author) {
            $checked_author_ids[] = $checked_author['author_id'];
        }

        $this->render('book_edit', [
            'book'               => $book->fetch_assoc(),
            'authors'            => $authors->fetch_all(MYSQLI_ASSOC),
            'checked_author_ids' => $checked_author_ids,
        ], 'layout');
    }
}