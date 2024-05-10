<?php
session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["level"])) {
  header("location:index.php");
  exit();
}

require 'config/connection.php';

$username = $_SESSION["username"];

$data = mysqli_query($db, "SELECT * FROM tb_login WHERE username = '$username'");
$row = mysqli_fetch_assoc($data);

if ($row) {
  $nama = $row['nama'];
  $level = $row['level'];
} else {
  $nama = '';
  $level = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/kkuro.png" rel="icon">
  <link href="img/kkuro.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard.php" class="logo d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
          <text x="0" y="13" font-family="Arial" font-size="15" fill="#00FF00">B</text>
          <text x="10" y="13" font-family="Arial" font-size="15" fill="#0000FF">B</text>
        </svg>
        <span class="d-none d-lg-block" style="margin-left: 5px;">ABUL WEB</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->




    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="img/kk.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $username; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header d-flex align-items-center">
              <img src="img/kk.png" alt="Gambar Profil" class="rounded-circle mr-2" width="40" height="40">
              <div>
                <h6 class="mb-0"><?php echo $nama; ?></h6>
                <span><?php echo $level; ?></span>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <!-- Logout -->
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">


        <!-- Tim -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="card-body">
              <h5 class="card-title">TIM <span>| TPHP</span></h5>
              <a href="#" data-category="obat">OBAT</a> |
              <a href="#" data-category="bmhp">BMHP</a> |
              <a href="#" data-category="alkesd">ALKES DISPO</a> |
              <a href="#" data-category="alkes">ALKES</a> |
              <a href="#" data-category="sc">SUKU CADANG</a> |
              <a href="#" data-category="gasm">GAS MEDIS</a> |
              <a href="#" data-category="pemeliharaan">PEMELIHARAAN</a>

              <div id="info-table-container">
                <!-- Table data will be loaded here -->
              </div>

              <script>
                document.addEventListener("DOMContentLoaded", function() {
                  var links = document.querySelectorAll('a');
                  links.forEach(function(link) {
                    link.addEventListener('click', function() {
                      var category = this.getAttribute('data-category');
                      fetchData(category);
                    });
                  });

                  function fetchData(category) {
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                      if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                          document.getElementById('info-table-container').innerHTML = xhr.responseText;
                        } else {
                          document.getElementById('info-table-container').innerHTML = '<p>Error fetching data. Please try again later.</p>';
                        }
                      }
                    };

                    xhr.open('GET', 'get_data_' + category + '.php', true);
                    xhr.send();
                  }
                });
              </script>

            </div>

          </div>
        </div><!-- End Recent Sales -->

        <!-- Perusahaan Card -->
        <div class="col-xxl-4 col-md-3">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title"><a href="per.php">Perusahaan</a><span>| total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="ri-user-3-fill"></i>
                </div>
                <div class="ps-3">
                  <h6>
                    <?php
                    require "config/connection.php";

                    $queryPer = "SELECT COUNT(*) AS total FROM tb_per";
                    $resultPer = mysqli_query($db, $queryPer);

                    if (!$resultPer) {
                      die("Query failed: " . mysqli_error($db));
                    }

                    $rowPer = mysqli_fetch_assoc($resultPer);

                    $totalPer = $rowPer['total'];

                    echo $totalPer;
                    ?>
                  </h6>
                  <span class="text-success small pt-1 fw-bold">Perusahaan</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Perusahaan Card -->

        <!-- BAST 100 Card -->
        <div class="col-xxl-4 col-md-3">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title"><a href="bast1.php">BAST 100</a><span>| total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="ri-user-3-fill"></i>
                </div>
                <div class="ps-3">
                  <h6>
                    <?php
                    require "config/connection.php";

                    $queryPer = "SELECT COUNT(*) AS total FROM tb_bast100";
                    $resultPer = mysqli_query($db, $queryPer);

                    if (!$resultPer) {
                      die("Query failed: " . mysqli_error($db));
                    }

                    $rowPer = mysqli_fetch_assoc($resultPer);

                    $totalPer = $rowPer['total'];

                    echo $totalPer;
                    ?>
                  </h6>
                  <span class="text-success small pt-1 fw-bold">BAST 100</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End BAST 100 Card -->

        <!-- BAST TERMYN Card -->
        <div class="col-xxl-4 col-md-3">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title"><a href="bastt.php">BAST TERMYN</a><span>| total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="ri-user-3-fill"></i>
                </div>
                <div class="ps-3">
                  <h6>
                    <?php
                    require "config/connection.php";

                    $queryPer = "SELECT COUNT(*) AS total FROM tb_bastter";
                    $resultPer = mysqli_query($db, $queryPer);

                    if (!$resultPer) {
                      die("Query failed: " . mysqli_error($db));
                    }

                    $rowPer = mysqli_fetch_assoc($resultPer);

                    $totalPer = $rowPer['total'];

                    echo $totalPer;
                    ?>
                  </h6>
                  <span class="text-success small pt-1 fw-bold">BAST TERMYN</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End BAST TERMYN Card -->

        <!-- ADD Card -->
        <div class="col-xxl-4 col-md-3">
          <div class="card info-card sales-card">
            <div class="card-body">
              <table class="table datatable">
                <tr>
                  <td colspan="2" align="center"><a href="#">ADD BAST</a></td>
                </tr>
                <tr>
                  <td>BAST 100</td>
                  <td><a href="bast100.php"><span class="bi-list"></span></a></td>
                </tr>
                <tr>
                  <td>BAST TERMYN</td>
                  <td><a href="bastter.php"><span class="bi-list"></span></a></td>
                </tr>
              </table>
            </div>
          </div>
        </div><!-- End ADD Card -->
      </div>
    </section>

    <div>
      <div>
        <div class="d-flex justify-content-between align-items-center">
          <a href="tam-bar.php" class=""><span class='bi bi-plus'></span>Tambah Barang 100</a>
          <a href="tam-bart1.php" class=""><span class='bi bi-plus'></span>Tambah Barang TERMYN I</a>
          <a href="tam-bart2.php" class=""><span class='bi bi-plus'></span>Tambah Barang TERMYN II dst</a>
        </div>
      </div>
    </div>
    <div class="col-12">
      <table class="table datatable">
        <thead>
          <tr>
            <th scope="col" width="50px" valign="middle">NO</th>
            <th scope="col" width="250px" valign="middle">NO KONTRAK</th>
            <th scope="col" width="250px" valign="middle">BAST</th>
            <th scope="col" width="250px" valign="middle">NAMA BARANG</th>
            <th scope="col" width="100px" valign="middle">SATUAN</th>
            <th scope="col" width="150px" valign="middle">HARGA</th>
            <th scope="col" width="100px" valign="middle">BARANG SESUAI KONTRAK</th>
            <th scope="col" width="100px" valign="middle">BARANG DITERIMA</th>
            <th scope="col" width="100px" valign="middle">SISA</th>
            <th scope="col" width="100px" valign="middle">TOTAL</th>
            <th scope="col" width="100px" valign="middle">AKSI</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $data = mysqli_query($db, "select * from tb_brg ORDER BY id DESC");
          $nomor = 1;
          while ($tampil = mysqli_fetch_array($data)) {
            echo "
            <tr>
            <td>$nomor</td>
            <td>$tampil[nokontrak]</td>
            <td>$tampil[bast]</td>
            <td>$tampil[nm_brg]</td>
            <td>$tampil[satuan]</td>
            <td>$tampil[hrg]</td>
            <td>$tampil[brg_kontrak]</td>
            <td>$tampil[brg_diterima]</td>
            <td>$tampil[sisa]</td>
            <td>$tampil[total]</td>
            <td>
              <a href='ed-bar100.php?id=$tampil[id]'><span class='bi bi-pencil'></span></a>
              <a href='hap-bar.php?id=$tampil[id]'><span class='bi bi-trash'></span></a>
            </td>
            </tr>
            ";

            $nomor++;
          }
          ?>
        </tbody>
      </table>
    </div>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>