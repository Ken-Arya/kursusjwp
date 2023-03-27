<?php
include '../partials/header.php'; // import header
include '../db_conn.php'; // memanggil database
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>

<!-- Navigasi Bar -->
<div class="navbar-collapse collapse justify-content-stretch" id="collapsibleNavbar">
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" href="../">Home</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="../kursus/">Kursus</a>
		</li>
		<?php if (isset($_SESSION['role'])) { ?>
			<!-- Tambahan menu pada role admin dan peserta -->
			<li class="nav-item">
				<a class="nav-link" href="../jadwal/">Jadwal</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="../pendaftaran/">Daftar</a>
			</li>
		<?php }
		if ($_SESSION['role'] == 'admin') { ?>
			<!-- Tambahan menu pada role admin -->
			<li class="nav-item">
				<a class="nav-link active" href="#">Mahasiswa</a>
			</li>
		<?php } ?>
	</ul>

	<ul class="navbar-nav ml-auto">
		<?php if ($_SESSION['role'] == 'admin') { ?>
			<!-- Jika role admin maka menampilkan nama admin -->
			<span class="navbar-text text-white">
				Selamat Datang Admin, <?php echo $_SESSION['name']; ?>
			</span>
		<?php } elseif ($_SESSION['role'] == 'peserta') { ?>
			<!-- Jika role peserta maka menampilkan nama peserta -->
			<span class="navbar-text text-white">
				Selamat Datang, <?php echo $_SESSION['name']; ?>
			</span>
		<?php } ?>
		<li class="nav-item ml-3">
			<button type="button" class="btn btn-light" data-toggle="modal" data-target="#modalLogout">Logout</button>
		</li>
	</ul>
</div>
</nav>