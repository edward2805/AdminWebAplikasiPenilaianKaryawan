<?php include('main.php') ?>


<div class="sidebar bg-success" id="side-nav">
    <div class="header-box ps-2 pt-3 pb-4 d-flex justify-content-between">
        <h1 class="fs-5 p-2"><span class="bg-white text-dark rounded shadow px-2 me-1">SPI</span>
        <span class="text-white">Sinar Palasari Indonesia</span></h1>
        <button class="btn d-md-none d-block close-btn p-2 py-0 text-white"><i class="fas fa-stream"></i></button>
    </div>

    <ul class="list-unstyled p-2">
        <li class="p-2"><a href="/TA/index.php" class="text-decoration-none d-block">
            <i class="fa-solid fa-gauge me-2"></i>Dashboard</a></li><hr class="h-color mx-3">
        <li class="p-2"><a href="/TA/daftarkaryawan.php" class="text-decoration-none d-block">
            <i class="fa-solid fa-users me-2"></i>Daftar Karyawan</a></li><hr class="h-color mx-3">
        <li class="p-2"><a href="/TA/daftaradmin.php" class="text-decoration-none d-block">
            <i class="fa-solid fa-user me-2"></i>Daftar Admin</a></li><hr class="h-color mx-3">
        <li class="p-2 nav-item my-1 disable bg-success">
                <a class="nav-link text-white" href="#sidemenu" data-bs-toggle="collapse">
                    <i class="fa-solid fa-list-check me-1"></i> 
                    <span class="d-sm-inline">Daftar Tugas</span> 
                    <i class="fa fa-caret-down ms-1"></i>
                </a>
                <ul class="nav collapse ms-1 flex-column" id="sidemenu" data-bs-parent="menu">
                    <li class="nav-item">
                        <a class="nav-link text-white ps-4 mt-2" href="/TA/daftartugas.php" aria-current="page">
                        <i class="fa-solid fa-bars me-2"></i> Semua Tugas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white ps-4" href="/TA/daftartugasopen.php" aria-current="page">
                        <i class="fa-solid fa-bars me-2"></i> Tugas Aktif</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white ps-4" href="/TA/daftartugasselesai.php" aria-current="page">
                        <i class="fa-solid fa-bars me-2"></i> Tugas Selesai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white ps-4" href="/TA/daftartugassudahdinilai.php" aria-current="page">
                        <i class="fa-solid fa-bars me-2"></i> Tugas Sudah Dinilai</a>
                    </li>
                </ul>
                <hr class="h-color mx-3">
            </li>
        <li class="p-2"><a href="/TA/penilaian.php" class="text-decoration-none d-block"><i class="fa-solid fa-bars me-2"></i>Daftar Penilaian</a></li>
        <hr class="h-color mx-3">
    </ul>
    
    
    <ul class="list-unstyled p-2">
        <li class="p-2"><a href="/TA/logout.php" class="text-decoration-none d-block"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a></li>
    </ul>
</div>





<?php include('footer.php') ?>