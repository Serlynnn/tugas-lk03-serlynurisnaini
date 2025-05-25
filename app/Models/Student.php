<?php
// untuk data siswa
// berkaitan dengan CRUD siswa
class Student extends Model {
  private $lastErrorCode;

  public function getAll() {
    // todo: menampilkan seluruh data siswa
    // 1. tampilkan seluruh data siswa
    // 2. kembalikan hasil dari querynya
    $sql = "SELECT * FROM students ORDER BY id DESC";
    $result = $this->dbconn->query($sql);
    if (!$result) return [];

    $students = [];
    while ($row = $result->fetch_object()) {
      $students[] = $row;
    }
    return $students;
  }

  public function getById($id) {
    // todo: menampilkan data siswa berdasarkan id
    // 1. tambahkan parameter id
    // 2. tampilkan data siswa berdasarkan id tersebut
    // 3. kembalikan hasil dari querynya cukup 1 baris saja
    $stmt = $this->dbconn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_object(); // kembalikan 1 baris
  }

  public function create($name, $nim, $address) {
    // todo: menambahkan data siswa
    // 1. tambahkan parameter nama, nim, dan alamat
    // 2. tambahkan data siswa berdasarkan parameter tersebut
    // 3. jika data siswa unik (cek struktur tabel), 
    //    kembalikan hasil dari querynya
    // 4. jika data siswa ganda, isi lastErrorCode dengan kode errornya,
    //    kembalikan nilai false
    // NB: gunakan exception handling
    try {
      $stmt = $this->dbconn->prepare("INSERT INTO students (name, nim, address) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $name, $nim, $address);
      $execResult = $stmt->execute();
      if (!$execResult) {
        $this->lastErrorCode = $this->dbconn->errno;
        return false;
      }
      return true;
    } catch (Exception $e) {
      $this->lastErrorCode = $this->dbconn->errno;
      return false;
    }
  }

  public function update($id, $name, $nim, $address) {
    // todo: mengubah data siswa
    // 1. tambahkan parameter id, nama, nim, dan alamat
    // 2. ubah data siswa berdasarkan parameter tersebut
    // 3. jika data siswa unik (cek struktur tabel), 
    //    kembalikan hasil dari querynya
    // 4. jika data siswa ganda, isi lastErrorCode dengan kode errornya,
    //    kembalikan nilai false
    // NB: gunakan exception handling
    try {
      $stmt = $this->dbconn->prepare("UPDATE students SET name = ?, nim = ?, address = ? WHERE id = ?");
      $stmt->bind_param("sssi", $name, $nim, $address, $id);
      $execResult = $stmt->execute();
      if (!$execResult) {
        $this->lastErrorCode = $this->dbconn->errno;
        return false;
      }
      return true;
    } catch (Exception $e) {
      $this->lastErrorCode = $this->dbconn->errno;
      return false;
    }
  }

  public function delete($id) {
    // todo: menghapus data siswa
    // 1. tambahkan parameter id
    // 2. hapus data siswa berdasarkan parameter tersebut
    // 3. kembalikan hasil dari querynya
    $stmt = $this->dbconn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
  }

  public function getLastErrorCode() {
    return $this->lastErrorCode;
  }
}