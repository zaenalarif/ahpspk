
</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?= $_SESSION['username']; ?> </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="kriteria.php">
          <div>Kriteria
            <span class="tag is-link is-small is-pulled-right is-success"><?= getJumlahKriteria(); ?></span>
           </div>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="alternatif.php">
          <div>Alternatif
            <span class="tag is-link is-small is-pulled-right is-success"><?= getJumlahAlternatif(); ?></span>
           </div>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Perbandingan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <?php
                if (getJumlahKriteria() > 0) {
                	for ($i=0; $i <= (getJumlahKriteria()-1); $i++) { 
                    echo "<a class='collapse-item' href='bobot.php?c=".($i+1)."'>".getKriteriaNama($i)."</a>";
                	}
                }
              ?>
          </div>
        </div>
      </li>
      <!-- hasil -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="hasil.php">
          <div>Hasil
           </div>
        </a>
      </li>

      <!-- logout -->
      <br><br><br>
      <li class="nav-item">
        <a class="nav-link collapsed" href="logout.php">
                Logout
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
              <h1 class="has-text-centered">Sistem Pengambil Keputusan</h1>
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
           