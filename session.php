<?php
session_start();
if (isset($_SESSION['role'])) {
	include 'partials/header.php';
?>
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link active" href="#">Home</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="kursus/">Kursus</a>
		</li>
		<?php if (isset($_SESSION['role'])) { ?>
			<li class="nav-item">
				<a class="nav-link" href="jadwal/">Jadwal</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="pendaftaran/">Daftar</a>
			</li>
		<?php }
		if ($_SESSION['role'] == 'admin') { ?>
			<li class="nav-item">
				<a class="nav-link" href="mahasiswa/">Mahasiswa</a>
			</li>
		<?php } ?>
	</ul>
	<ul class="navbar-nav ml-auto">
		<?php if ($_SESSION['role'] == 'admin') { ?>
			<span class="navbar-text text-white">
				Selamat Datang Admin, <?php echo $_SESSION['name']; ?>
			</span>
		<?php } elseif ($_SESSION['role'] == 'peserta') { ?>
			<span class="navbar-text text-white">
				Selamat datang, <?php echo $_SESSION['name']; ?>
			</span>
		<?php } ?>
		<li class="nav-item ml-3">
			<button type="button" class="btn btn-light" data-toggle="modal" data-target="#modalLogout">Logout</button>
		</li>
	</ul>
	</div>
	</nav>


	<div class="modal fade" id="modalLogout">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Konfirmasi</h4>
				</div>
				<div class="modal-body">
					Apakah Anda yakin ingin keluar?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
					<a href="logout.php"><button type="button" class="btn btn-outline-danger">Keluar</button></a>
				</div>
			</div>
		</div>
	</div>

<?php include 'partials/dashboard.php';
} else {
	header("Location: index.php");
} ?>