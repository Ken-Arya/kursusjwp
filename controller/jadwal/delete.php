<?php
session_start();
if ($_SESSION['role'] == 'admin') {
	include "../../db_conn.php"; // koneksi database

	if ($_GET['id_jadwal']) {
		$id = $_GET['id_jadwal']; // mengambil id yang dipilih

		$sql = "DELETE FROM jadwal WHERE id_jadwal='$id'"; // menghapus data berdasarkan id
		$result = mysqli_query($conn, $sql);

		if ($result) {
			// menampilkan notifikasi apabila eksekusi berhasil
			header("Location: ../../jadwal/index.php?success=Data jadwal berhasil dihapus");
		} else {
			// menampilkan notifikasi apabila eksekusi gagal
			header("Location: ../../jadwal/index.php?error=Gagal menghapus data jadwal");
		}
	} else {
		header("Location: ../../");
	}
}
