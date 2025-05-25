<?php
// todo: tambahkan koneksi database
// 1. tambahkan kode koneksi database sesuai yang ada di slide

  class Model {
      protected $dbconn;
  
      public function __construct() {
          $dbhostname = $_ENV['DB_HOST'] ?? '127.0.0.1';
          $dbusername = $_ENV['DB_USERNAME'] ?? 'root';
          $dbpassword = $_ENV['DB_PASSWORD'] ?? '';
          $dbname = $_ENV['DB_DATABASE'] ?? 'lk03_mvc';
          $port = $_ENV['DB_PORT'] ?? '3306';

          $this->dbconn = new mysqli($dbhostname, $dbusername, $dbpassword, $dbname, $port);

          if($this->dbconn->connect_errno)
            die("Database connection error!");
      }
  }
  