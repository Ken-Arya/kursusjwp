<?php
session_start();
include '../partials/navbar/jadwal.php'; // menampilkan header

$no = 1; // mendeklarasikan variabel nomor
if ($_SESSION['role'] == 'admin') {
	$sql = "SELECT * FROM kursus"; // mengambil data kursus
	$result = mysqli_query($conn, $sql);
?>

	<!-- Tampilan jadwal admin -->
	<div class="container">
		<!-- Form tambah data -->
		<form action="../controller/jadwal/tambah.php" method="post" class="needs-validation" novalidate>
			<center>
				<h1 class="pt-3">Jadwal Kursus Jewepe</h1>
				<ul class="list-unstyled">
					<li>Dibawah ini merupakan daftar jadwal kursus</li>
					<li>yang tersedia di Lembaga Kursus Universitas Jewepe</li>
				</ul>
			</center>
			<h5 class="pt-3"><b>TAMBAH DATA JADWAL KURSUS</b></h5>
			<div class="form-group">
				<label for="name">Nama Kursus</label>
				<select name="kursus" class="custom-select form-control" id="name" required>
					<option selected>Pilih Kursus</option>
					<?php
					while ($row = mysqli_fetch_array($result)) {
						// mendefinisikan variabel
						$id = $row['id_kursus'];

						// menampilkan nama kursus pada pilihan
						echo '<option value="' . $id . '">' . $row['nama'] . '</option>';
					}
					?>
				</select>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="waktu">Waktu Kursus</label>
				<input type="date" class="form-control" id="waktu" name="waktu" required>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<button type="submit" class="btn btn-primary mb-5" name="tambah_jadwal">Submit</button>
			<?php if (isset($_GET['error'])) { ?>
				<!-- Notifikasi error -->
				<div class="alert alert-danger" role="alert">
					<?= $_GET['error'] ?>
				</div>
			<?php } elseif (isset($_GET['success'])) { ?>
				<!-- Notifikasi success -->
				<div class="alert alert-success" role="alert">
					<?= $_GET['success'] ?>
				</div>
			<?php } ?>
		</form>

		<!-- Tabel daftar Jadwal -->
		<h2 class="pt-3">Daftar Jadwal Kursus</h2>
		<div class="table-responsive mb-5">
			<table class="table table-striped">
				<thead class="text-center table-dark">
					<tr>
						<th>ID</th>
						<th>Nama Kursus</th>
						<th>Waktu Kursus</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// mengambil data jadwal
					$sql = "SELECT * FROM jadwal";
					$query = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($query)) {
						// mendefinisikan variabel
						$id = $row['id_jadwal'];

						// mengambil nama kursus dari tabel kursus
						$sql2 = mysqli_query($conn, "SELECT nama FROM kursus WHERE id_kursus='" . $row['id_kursus'] . "'");
						$row2 = mysqli_fetch_array($sql2);

						// menampilkan data pada baris tabel
					?>
						<tr>
							<td><?= $id ?></td>
							<td><?= $row2['nama'] ?></td>
							<td><?= date_format(date_create($row['waktu']), "j F Y") ?></td>
							<td class="text-center"><a href="edit.php?id_jadwal=<?= $id ?>">
									<button type="button" class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></button>
								</a>
								<button type="button" class="btn btn-outline-danger" onclick="myFunction('../controller/jadwal/delete.php?id_jadwal=', '<?= $id ?>')">
									<i class="bi bi-trash"></i></button>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

<?php } elseif ($_SESSION['role'] == 'peserta') { ?>

	<!-- Tampilan Jadwal peserta -->
	<div class="container">
		<center>
			<h1 class="pt-3">Jadwal Kursus Jewepe</h1>
			<ul class="list-unstyled">
				<li>Dibawah ini merupakan daftar jadwal kursus</li>
				<li>yang tersedia di Lembaga Kursus Universitas Jewepe</li>
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
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// mengambil data jadwal
					$sql = "SELECT * FROM jadwal";
					$query = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($query)) {
						// mendefinisikan variabel
						$id = $row['id_jadwal'];

						// mengambil nama kursus dari tabel kursus
						$sql2 = mysqli_query($conn, "SELECT nama FROM kursus WHERE id_kursus='" . $row['id_kursus'] . "'");
						$row2 = mysqli_fetch_array($sql2);

						// menampilkan data pada baris tabel
						echo '<tr>
								<td><center>' . $id . '</center></td>
								<td>' . $row2['nama'] . '</td>
								<td>' . date_format(date_create($row['waktu']), "j F Y") . '</td>
								<td class="text-center"><a href="daftar.php?id_jadwal=' . $id . '&npm=' . $_SESSION['id'] . '">
									<button type="button" class="btn btn-primary">Daftar kursus ini</button>
								</a></td>
							</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

<?php }
include '../partials/footer.php'; // menampilkan footer 
?>