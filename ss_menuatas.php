<?php include "koneksi.php";

?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a href="frmawal.php" class="navbar-brand ps-3">
        <img src="alat2/sangkuriang.png" alt="logo" height="25"> Sangkuriang</a>
        
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
    </button>

    <div class="ms-2 my-2">
    </div>

    <div class="ms-auto me-3 my-2">
    </div>

    <?php if (isset($_SESSION['namaUser'])) : ?>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 m3-lg-4">
            <li class="nav-item dropdown">
                <a href="#" role="button" class="nav-link dropdown-toggle" id="mnuUser"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i> <?= $_SESSION['namaUser']; ?></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="mnuUser">
                    <li><a href="keluar.php" class="dropdown-item">Keluar</a></li>
                </ul>
            </li>
        </ul>
    <?php endif; ?>
</nav>