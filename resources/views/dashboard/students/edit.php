<!-- 
  buat tampilan halaman form ubah data siswa
  ingat, halaman siswa berkolaborasi dengan template main
  
  tambahkan div untuk menampilkan pesan error
-->

<h2><?= htmlspecialchars($title) ?></h2>

<?php if (!empty($error)) : ?>
  <div style="color: red; margin-bottom: 1em;">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<form method="POST" action="?c=dashboard&m=updateStudent">
  <!-- ID siswa disembunyikan agar tetap dikirim saat submit -->
  <input type="hidden" name="id" value="<?= htmlspecialchars($student->id ?? '') ?>">

  <div>
    <label for="name">Nama:</label><br>
    <input type="text" id="name" name="name" required value="<?= htmlspecialchars($student->name ?? '') ?>">
  </div>
  
  <div>
    <label for="nim">NIM:</label><br>
    <input type="text" id="nim" name="nim" required maxlength="10" value="<?= htmlspecialchars($student->nim ?? '') ?>">
  </div>
  
  <div>
    <label for="address">Alamat:</label><br>
    <textarea id="address" name="address"><?= htmlspecialchars($student->address ?? '') ?></textarea>
  </div>
  
  <button type="submit">Simpan Perubahan</button>
</form>

<p><a href="?c=dashboard&m=getAllStudents">Kembali ke daftar siswa</a></p>