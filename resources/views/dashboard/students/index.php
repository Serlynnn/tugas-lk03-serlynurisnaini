<!-- 
  buat tampilan halaman siswa
  ingat, halaman siswa berkolaborasi dengan template main

  tambahkan link untuk menambahkan data siswa
  tambahkan link untuk setiap aksi (edit dan delete) berdasarkan id siswa
-->

<h2><?= htmlspecialchars($title) ?></h2>

<p><a href="?c=dashboard&m=createStudent">Tambah Data Siswa</a></p>

<?php if (empty($students)): ?>
  <p>Belum ada data siswa.</p>
<?php else: ?>
  <table border="1" cellpadding="8" cellspacing="0">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($students as $student): ?>
        <tr>
          <td><?= htmlspecialchars($student->id) ?></td>
          <td><?= htmlspecialchars($student->name) ?></td>
          <td><?= htmlspecialchars($student->nim) ?></td>
          <td><?= htmlspecialchars($student->address) ?></td>
          <td>
            <a href="?c=dashboard&m=editStudent&id=<?= urlencode($student->id) ?>">Edit</a> |
            <a href="?c=dashboard&m=deleteStudent&id=<?= urlencode($student->id) ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>