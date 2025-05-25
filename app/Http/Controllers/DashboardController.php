<?php
// untuk dashboard (dashboard utama, profil, settings, dll)
// untuk CRUD data siswa
// berkaitan dengan views/dashboard/*.php
class DashboardController extends Controller {
  public function __construct() {
    session_start();
    if (!isset($_SESSION['user'])) {
      header("Location:?c=auth&m=login");
      exit();
    }
  }
  
  public function index() {
    $title = 'Dashboard';

    $this->loadView(
      "dashboard/index",
      [
        'title' => $title,
        'username' => $_SESSION['user']['name']
      ],
      'main'
    );
  }

  public function profile() {
    // todo: menampilkan halaman profile pengguna yang login
    // 1. tampilkan halaman profile. gunakan layout 'main'
    // 2. gunakan data session untuk menampilkan profile pengguna
    $title = 'Profile';

    $this->loadView(
      "dashboard/profile",
      [
        'title' => $title,
        'username' => $_SESSION['user']['name'],
        'joindate' => $_SESSION['user']['created_at'],
        'updatedate' => $_SESSION['user']['updated_at']
      ],
      'main'
    );
  }

  public function getAllStudents() {
    // todo: menampilkan semua data siswa
    // 1. ambil data seluruh siswa dari database
    // 2. tampilkan halaman students (index). gunakan layout 'main'
    $title = 'Data Siswa';

    $studentModel = $this->loadModel('Student');
    $students = $studentModel->getAll(); // Ambil semua data siswa

    $this->loadView(
      'dashboard/students/index',
      [
        'title' => $title,
        'students' => $students
      ],
      'main'
    );
  }

  public function createStudent() {
    // todo: menampilkan halaman tambah siswa
    // 1. tampilkan halaman tambah siswa (create). gunakan layout 'main'
    $title = 'Tambah Siswa';

    $this->loadView(
      'dashboard/students/create',
      ['title' => $title],
      'main'
    );
  }

  public function insertStudent() {
    // todo: menambahkan data siswa
    // 1. baca data yang dikirim dari form
    // 2. tambah data siswa ke dalam database.
    //    - jika sukses tampilkan halaman seluruh data siswa
    //    - jika gagal, tetap tampilkan halaman tambah siswa 
    //      dengan menampilkan pesan error
    $title = 'Tambah Siswa';

    $name = $_POST['name'] ?? '';
    $nim = $_POST['nim'] ?? '';
    $address = $_POST['address'] ?? '';

    $studentModel = $this->loadModel('Student');

    $result = $studentModel->create($name, $nim, $address);

    if ($result) {
      // Jika sukses, redirect ke halaman daftar siswa
      header("Location:?c=dashboard&m=getAllStudents");
      exit();
    } else {
      // Jika gagal, tampilkan halaman tambah dengan error
      $this->loadView(
        'dashboard/students/create',
        [
          'title' => $title,
          'error' => 'Gagal menambah data siswa, coba lagi.',
          'name' => $name,
          'nim' => $nim,
          'address' => $address
        ],
        'main'
      );
    }
  }

  public function editStudent() {
    // todo: menampilkan halaman ubah data siswa
    // 1. baca data id yang dikirimkan melalui url 
    //    sesuai id siswa yang akan diubah
    // 2. ambil data siswa dari database berdasarkan id tersebut
    // 3. tampilkan halaman ubah data siswa (edit). gunakan layout 'main'.
    //    seluruh data siswa dengan id tersebut ditampilkan di form
    $title = 'Ubah Data Siswa';

    $id = $_GET['id'] ?? null;
    if (!$id) {
      header("Location:?c=dashboard&m=getAllStudents");
      exit();
    }

    $studentModel = $this->loadModel('Student');
    $student = $studentModel->getById($id);

    if (!$student) {
      header("Location:?c=dashboard&m=getAllStudents");
      exit();
    }

    $this->loadView(
      'dashboard/students/edit',
      [
        'title' => $title,
        'student' => $student
      ],
      'main'
    );
  }

  public function updateStudent() {
    // todo: mengubah data siswa
    // 1. baca data yang dikirim dari form
    // 2. ubah data siswa ke dalam database.
    //    - jika sukses tampilkan halaman seluruh data siswa
    //    - jika gagal, tetap tampilkan halaman ubah data siswa 
    //      dengan menampilkan pesan error
    $title = 'Ubah Data Siswa';

    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? '';
    $nim = $_POST['nim'] ?? '';
    $address = $_POST['address'] ?? '';

    if (!$id) {
      header("Location:?c=dashboard&m=getAllStudents");
      exit();
    }

    $studentModel = $this->loadModel('Student');

    $result = $studentModel->update(
      $id, $name, $nim, $address
    );

    if ($result) {
      header("Location:?c=dashboard&m=getAllStudents");
      exit();
    } else {
      // Jika gagal, tampilkan halaman edit dengan error
      $student = (object)[
        'id' => $id,
        'name' => $name,
        'nim' => $nim,
        'address' => $address
      ];

      $this->loadView(
        'dashboard/students/edit',
        [
          'title' => $title,
          'error' => 'Gagal mengubah data siswa, coba lagi.',
          'student' => $student
        ],
        'main'
      );
    }
  }

  public function deleteStudent() {
    // todo: menghapus data siswa
    // 1. baca data id yang dikirimkan melalui url 
    //    sesuai id siswa yang akan dihapus
    // 2. hapus data siswa yang ada di dalam database.
    //    - jika sukses tampilkan halaman seluruh data siswa
    $id = $_GET['id'] ?? null;
    if (!$id) {
      header("Location:?c=dashboard&m=getAllStudents");
      exit();
    }

    $studentModel = $this->loadModel('Student');
    $result = $studentModel->delete($id);

    // Setelah hapus, langsung redirect ke daftar siswa
    header("Location:?c=dashboard&m=getAllStudents");
    exit();
  }
}