<?php

class Controller
{
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli(Config::$host, Config::$login, Config::$password, Config::$dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function render($name, $vars, $layout = null)
    {
        if ($layout) {
            ob_start();
        }

        extract($vars);
        include 'Views/'.$name.'.php';

        if ($layout) {
            $content = ob_get_clean();
            include 'Views/'.$layout.'.php';
        }
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}