<?php

class DefaultController extends Controller
{
    public function indexAction()
    {
        $sql = "SELECT GROUP_CONCAT(a.name SEPARATOR ', ') as authors, b.id as book_id, b.name as book_name FROM books AS b, 
          authors_books AS ab, authors as a WHERE b.id=ab.book_id AND a.id = ab.author_id group by b.id";

        $result_books_with_authors = $this->conn->query($sql);

        $sql = "SELECT * FROM books";
        $result_books = $this->conn->query($sql);

        $sql = "SELECT * FROM authors";
        $result_authors = $this->conn->query($sql);

        $this->render('index', [
            'books_with_authors' => $result_books_with_authors->fetch_all(MYSQLI_ASSOC),
            'books'              => $result_books->fetch_all(MYSQLI_ASSOC),
            'authors'            => $result_authors->fetch_all(MYSQLI_ASSOC),
        ], 'layout');
    }
}

