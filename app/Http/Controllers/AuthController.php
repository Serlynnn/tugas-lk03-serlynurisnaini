<?php
// untuk login, register, logout
// berkaitan dengan views/auth/*.php
// password saat register menggunakan password_hash
// password saat login menggunakan password_verify
class AuthController extends Controller {
  
  public function login() {
    session_start();
    if (isset($_SESSION['user'])) {
      header("Location:?c=dashboard&m=index");
      exit();
    }
    
    $this->loadView("auth/login", ['title' => 'Login'], "auth");
  }

  public function loginProcess() {
    session_start();

    $title = 'Login';

    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';

    $userModel = $this->loadModel("user");
    $user = $userModel->getByName($name);

    if ($user && password_verify($password, $user->password)) {
      $_SESSION['user'] = [
        'id' => $user->id,
        'name' => $user->name,
        'created_at' => $user->created_at,
        'updated_at'=> $user->updated_at

      ];
      header("Location:?c=dashboard&m=index");
    } else {
      $this->loadView(
        "auth/login", 
        [
          'title' => $title,
          'error' => 'Login gagal, cek username/password'
        ],
        'auth'
      );
    }
  }
  
  public function register() {
    session_start();
    if (isset($_SESSION['user'])) {
      header("Location:?c=dashboard&m=index");
      exit();
    }

    // Tampilkan halaman register dengan layout 'auth'
    $this->loadView("auth/register", ['title' => 'Register'], "auth");
  }

    // REGISTER PROCESS
    // todo: memproses register
    // 1. baca data yang dikirim dari form
    // 2. bandingkan antara password dengan konfirmasi password, 
    //    jika tidak sama, maka tampilkan pesan error
    // 3. cek data user di database, jika sudah ada, maka tampilkan pesan error
    // 4. jika semua aman, tampilkan halaman login. gunakan layout 'auth'

  public function registerProcess() {
    session_start();

    $title = 'Register';

    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // 1. cek kecocokan password dan konfirmasi password
    if ($password !== $confirmPassword) {
      $this->loadView(
        "auth/register",
        [
          'title' => $title,
          'error' => 'Password dan konfirmasi password tidak sama',
          'name' => $name
        ],
        'auth'
      );
      return;
    }

    $userModel = $this->loadModel("user");
    $existingUser = $userModel->getByName($name);

    // 2. cek user sudah ada atau belum
    if ($existingUser) {
      $this->loadView(
        "auth/register",
        [
          'title' => $title,
          'error' => 'Username sudah terdaftar',
          'name' => $name
        ],
        'auth'
      );
      return;
    }

    // 3. jika semua aman, simpan user baru dengan password hash
    $userModel->create($name, $password);

    // 4. setelah register sukses, redirect ke login
    header("Location:?c=auth&m=login");
    exit();
  }

  public function logout() {
    session_start();
    session_destroy();
    header("Location:?c=auth&m=login");
    exit();
  }
}