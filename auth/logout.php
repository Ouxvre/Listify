<?php
session_start();
session_destroy();
setcookie(session_name(), '', time() - 3600, '/');

// Mengatur header untuk mencegah caching di browser
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache");

// Arahkan ke halaman login dengan pesan logout
header("Location: ../public/login.php?logout=true");
exit();
?>