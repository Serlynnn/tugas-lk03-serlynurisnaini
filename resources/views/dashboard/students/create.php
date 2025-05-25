<!-- 
  buat tampilan halaman form tambah data siswa
  ingat, halaman siswa berkolaborasi dengan template main
  
  tambahkan div untuk menampilkan pesan error
-->

<h2><?= htmlspecialchars($title) ?></h2>

<?php if (!empty($error)) : ?>
  <div style="color: red; margin-bottom: 1em;">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<form method="POST" action="?c=dashboard&m=insertStudent">
  <div>
    <label for="name">Nama:</label><br>
    <input type="text" id="name" name="name" required value="<?= htmlspecialchars($name ?? '') ?>">
  </div>
  
  <div>
    <label for="nim">NIM:</label><br>
    <input type="text" id="nim" name="nim" required maxlength="10" value="<?= htmlspecialchars($nim ?? '') ?>">
  </div>
  
  <div>
    <label for="address">Alamat:</label><br>
    <textarea id="address" name="address"><?= htmlspecialchars($address ?? '') ?></textarea>
  </div>
  
  <button type="submit">Tambah Data</button>
</form>

<p><a href="?c=dashboard&m=getAllStudents">Kembali ke daftar siswa</a></p>
