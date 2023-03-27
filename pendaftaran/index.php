<?php
session_start();
include '../partials/navbar/pendaftaran.php'; // menampilkan header
if ($_SESSION['role'] == 'admin') {
	$sql = "SELECT * FROM kursus"; // mengambil data kursus
	$result = mysqli_query($conn, $sql);
?>

	<!-- Tampilan pendaftaran admin -->
	<div class="container">
		<!-- Tabel pendaftaran -->
		<center>
			<h1 class="pt-3">Jadwal Kursus Jewepe</h1>
			<ul class="list-unstyled">
				<li>Dibawah ini merupakan daftar jadwal kursus</li>
				<li>yang tersedia di Lembaga Kursus Universitas Jewepe</li>
			</ul>
		</center>
		<h2 class="pt-3">Daftar Pendaftaran Kursus</h2>
		<div class="table-responsive mb-5">
			<table class="table table-striped">
				<thead class="text-center table-dark">
					<tr>
						<th>ID</th>
						<th>NPM</th>
						<th>Nama Mahasiswa</th>
						<th>Kelas</th>
						<th>Nama Kursus</th>
						<th>Waktu Kursus</th>
						<th>KRS</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// mengambil data pendaftaran berdasarkan status
					$sql = "SELECT * FROM pendaftaran";
					$query = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($query)) {
						// mendefinisikan variabel
						$id = $row['id_daftar'];

						// mengambil data mahasiswa dari tabel mahasiswa berdasarkan npm
						$sql2 = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE npm='" . $row['npm'] . "'");
						$row2 = mysqli_fetch_array($sql2);

						// mengambil Jadwal dari tabel jadwal berdasarkan id_jadwal
						$sql3 = mysqli_query($conn, "SELECT * FROM jadwal WHERE id_jadwal='" . $row['id_jadwal'] . "'");
						$row3 = mysqli_fetch_array($sql3);

						// mengambil nama kursus dari tabel kursus berdasarkan id_kursus dari tabel jadwal
						$sql4 = mysqli_query($conn, "SELECT nama FROM kursus WHERE id_kursus='" . $row3['id_kursus'] . "'");
						$row4 = mysqli_fetch_array($sql4);

						// menampilkan data pada baris tabel
						echo '<tr>
								<td>' . $id . '</td>
								<td>' . $row['npm'] . '</td>
								<td>' . $row2['nama'] . '</td>
								<td>' . $row2['kelas'] . '</td>
								<td>' . $row4['nama'] . '</td>
								<td>' . date_format(date_create($row3['waktu']), "j F Y") . '</td>
								<td><a target="_blank" href="../uploads/' . $row['krs'] . '">' . $row['krs'] . '</a></td>
								
								<td>' . $row['status']  . '</td>
								';
					?>
						<td class="text-center">
							<button type="button" class="btn btn-outline-success" onclick="myFunction('terima.php?id_daftar=', '<?= $id ?>')">
								<i class="bi bi-check-square"></i>
							</button>
							<button type="button" class="btn btn-outline-danger" onclick="myFunction('tolak.php?id_daftar=', '<?= $id ?>')">
								<i class="bi bi-x-square"></i>
							</button>
						</td>
					<?php
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

<?php } elseif ($_SESSION['role'] == 'peserta') { ?>

	<!-- Tampilan pendaftaran peserta -->
	<div class="container">
		<center>
			<h1 class="pt-3">Pendaftaran Kursus Jewepe</h1>
			<ul class="list-unstyled">
				<li>Dibawah ini merupakan data pendaftaran kursus</li>
				<li>yang telah anda daftar untuk ikut serta melakukan kegiatan kursus</li>
			</ul>
		</center>
		<h2 class="pt-3">Daftar Jadwal Kursus</h2>
		<div class="table-responsive mb-5">
			<table class="table table-striped">
				<thead class="text-center table-dark">
					<tr>
						<th>ID</th>
						<th>Nama Kursus</th>
						<th>Waktu Kursus</th>
						<th>KRS</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php

					// mengambil data pendaftaran
					$sql = "SELECT * FROM pendaftaran";
					$query = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($query)) {
						// mendefinisikan variabel
						$id = $row['id_daftar'];

						// mengambil Jadwal dari tabel jadwal berdasarkan id_jadwal
						$sql2 = mysqli_query($conn, "SELECT * FROM jadwal WHERE id_jadwal='" . $row['id_jadwal'] . "'");
						$row2 = mysqli_fetch_array($sql2);

						// mengambil nama kursus dari tabel kursus berdasarkan id_kursus dari tabel jadwal
						$sql3 = mysqli_query($conn, "SELECT nama FROM kursus WHERE id_kursus='" . $row2['id_kursus'] . "'");
						$row3 = mysqli_fetch_array($sql3);

						// menampilkan data pada baris tabel
						echo '<tr>
								<td>' . $id .  '</td>
								<td>' . $row3['nama'] . '</td>
								<td>' . date_format(date_create($row2['waktu']), "j F Y") . '</td>
								<td><a target="_blank" href="../uploads/' . $row['krs'] . '">' . $row['krs'] . '</a></td>
								<td>' . $row['status'] . '</td>';
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

<?php }
include '../partials/footer.php'; // menampilkan footer
?>