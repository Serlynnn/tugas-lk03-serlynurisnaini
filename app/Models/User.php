<?php
// untuk model autentikasi
// berkaitan dengan login, register
class User extends Model {
  public function getByName($name) {
    $sql = "SELECT * FROM users WHERE name = '$name'";
    $result = $this->dbconn->query($sql);
    return $result->fetch_object();
  }

  public function create($name, $password) {
    // todo: menambah user
    // 1. tambahkan parameter nama dan password
    // 2. lakukan hashing terhadap password
    // 3. masukkan data user ke dalam tabel users
    // 4. kembalikan hasil dari querynya

    // 1. hashing password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 2. insert ke tabel users dengan prepared statement
    $stmt = $this->dbconn->prepare("INSERT INTO users (name, password) VALUES (?, ?)");
    $stmt->bind_param('ss', $name, $hashedPassword);
    
    $execResult = $stmt->execute();

    // 3. kembalikan hasil query (true/false)
    return $execResult;
  }
}