<!-- 
  buat tampilan halaman profile
  ingat, halaman profile berkolaborasi dengan template main
-->
<h2><?= htmlspecialchars($title) ?></h2>

<p>Halo, <?= htmlspecialchars($username) ?>!</p>

<hr>
<section>
  <h3>Informasi Profil</h3>
  <table>
    <tr>
      <th>Username</th>
      <td><?= htmlspecialchars($username) ?></td>
    </tr>
    <tr>
      <th>Tanggal Bergabung</th>
      <td><?= htmlspecialchars($joindate ?? 'belum tersedia') ?></td>
    </tr>
    <tr>
      <th>Terakhir Diupdate</th>
      <td><?= htmlspecialchars($updatedate ?? 'belum tersedia') ?></td>
    </tr>
  </table>
</section>

