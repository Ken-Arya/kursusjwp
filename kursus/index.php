<?php
session_start();
include '../partials/navbar/kursus.php'; // menampilkan header

$no = 1; // mendeklarasikan variabel nomor
if ($_SESSION['role'] == 'admin') {
?>

	<!-- Tampilan kursus admin -->
	<div class="container">
		<!-- Form tambah data -->
		<form action="../controller/kursus/tambah.php" method="post" class="needs-validation" novalidate>
			<center>
				<h1 class="pt-3">Kursus Jewepe</h1>
				<ul class="list-unstyled">
					<li>Dibawah ini merupakan daftar materi kursus</li>
					<li>yang tersedia di Lembaga Kursus Universitas Jewepe</li>
				</ul>
			</center>
			<h5 class="pt-3"><b>TAMBAH DATA MATERI KURSUS</b></h5>
			<div class="form-group">
				<label for="name">Nama Kursus:</label>
				<input type="text" class="form-control" id="nama kursus" placeholder="Masukkan nama kursus" name="nama" maxlength="64" required>
			</div>
			<div class="form-group">
				<label for="ket">Keterangan Kursus:</label>
				<input type="text" class="form-control" id="keterangan" placeholder="Masukkan keterangan kursus" name="ket" maxlength="255" required>
			</div>
			<div class="form-group">
				<label for="lama">Lama Kursus:</label>
				<input type="text" class="form-control" id="lamakursus" placeholder="Masukkan lama kursus" name="lama" maxlength="32" required>
			</div>
			<button type="submit" class="btn btn-primary mb-5" name="tambah_kursus">Submit</button>

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

		<!-- Tabel daftar kursus -->
		<h2 class="pt-3">Daftar Kursus</h2>
		<div class="table-responsive mb-5">
			<table class="table table-striped">
				<thead class="text-center table-dark">
					<tr>
						<th>ID</th>
						<th>Nama Kursus</th>
						<th>Keterangan Kursus</th>
						<th>Lama Kursus</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// mengambil data kursus
					$sql = "SELECT * FROM kursus";
					$query = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($query)) {
						// mendefinisikan variabel
						$id = $row['id_kursus'];

						// menampilkan data pada baris tabel
					?>
						<tr>
							<td>
								<center><?= $id ?></center>
							</td>
							<td><?= $row['nama'] ?></td>
							<td><?= $row['keterangan'] ?></td>
							<td><?= $row['lama'] ?></td>
							<td class="text-center"><a href="edit.php?id_kursus=<?= $id ?>">
									<button type="button" class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></button>
								</a>
								<button type="button" class="btn btn-outline-danger" onclick="myFunction('../controller/kursus/delete.php?id_kursus=', '<?= $id ?>')">
									<i class="bi bi-trash"></i>
								</button>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

<?php } else { ?>

	<!-- Tampilan Kursus -->
	<div class="container">
		<center>
			<h1 class="pt-3">Kursus Jewepe</h1>
			<ul class="list-unstyled">
				<li>Dibawah ini merupakan daftar materi kursus</li>
				<li>yang tersedia di Lembaga Kursus Universitas Jewepe</li>
			</ul>
		</center>
		<h2 class="pt-3">Daftar Kursus</h2>
		<div class="table-responsive mb-5">
			<table class="table table-striped">
				<thead class="text-center table-dark">
					<tr>
						<th>ID</th>
						<th>Nama Kursus</th>
						<th>Keterangan Kursus</th>
						<th>Lama Kursus</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// mengambil data kursus
					$sql = "SELECT * FROM kursus";
					$query = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($query)) {
						// mendefinisikan variabel
						$id = $row['id_kursus'];

						// menampilkan data pada baris tabel
						echo '<tr>
								<td><center>' . $id . '</center></td>
								<td>' . $row['nama'] . '</td>
								<td>' . $row['keterangan'] . '</td>
								<td>' . $row['lama'] . '</td>
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