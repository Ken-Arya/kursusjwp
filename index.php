<?php
session_start();
if (!isset($_SESSION['role'])) {
	include 'partials/header.php';
?>

	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link active" href="#">Home</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="kursus/">Kursus</a>
		</li>
	</ul>
	<ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<a href="login.php" type="button" class="btn btn-primary">Login</button></a>
		</li>
	</ul>
	</div>
	</nav>

<?php include 'partials/dashboard.php';
} else {
	header("Location: session.php");
} ?>