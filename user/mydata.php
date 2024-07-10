<!doctype html>
<html class="no-js" lang="en">

<?php
include '../dbconnect.php';
include '../cek.php';
if ($role !== 'User') {
    header("location:../login.php");
};
$userid = $_SESSION['userid'];

include 'submit.php';

// Cek dulu sudah pernah submit belum
$cekdulu = mysqli_query($conn, "SELECT * FROM userdata WHERE userid='$userid'");
$ambil = mysqli_fetch_array($cekdulu);

// Periksa apakah $ambil tidak kosong
if ($ambil) {
    $status = $ambil['status'];

    // Kalau udah pernah verify
    if ($status == 'Verified') {
        header("location:verified.php");
        exit();
    } 
} else {
    // Tambahkan penanganan jika data tidak ditemukan
    echo "Data tidak ditemukan.";
};

//Ambil data dari database
$sql = "SELECT * FROM userdata WHERE userid='$userid";
$result = $conn->query($sql);
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Telkom Report System: Pelaporan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-144808195-1');
    </script>
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <a href="index.php"><img src="../trs-logo.png" alt="logo" width="100%"></a>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li><a href="index.php"><span>Dashboard</span></a></li>
                            <li class="active">
                                <a href="pelaporan.php"><i class="ti-layout"></i><span>Pelaporan</span></a>
                            </li>
                            <p>________________________________________________________</p>
                            <li>
                                <a href="../logout.php"><span>Logout</span></a>

                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li>
                                <h3>
                                    <div class="date">
                                        <script type='text/javascript'>
                                            <!--
                                            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                            var date = new Date();
                                            var day = date.getDate();
                                            var month = date.getMonth();
                                            var thisDay = date.getDay(),
                                                thisDay = myDays[thisDay];
                                            var yy = date.getYear();
                                            var year = (yy < 1000) ? yy + 1900 : yy;
                                            document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                                            //
                                            -->
                                        </script></b>
                                    </div>
                                </h3>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->

            <!-- page title area end -->
            <div class="main-content-inner">

                <!-- panduan -->
                <!-- <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <h2>Pelaporan</h2>
                                </div>
                                <div class="market-status-table mt-4">
                                    <div class="table-responsive">
                                        Selamat datang di sistem pelaporan Witel Makassar.
                                        <br><br>
                                        <br>
                                        <br>*Note: Pihak SDI baru akan menerima data Anda setelah Anda klik 'Confirm'
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->


                <!------------------ Pisahin ------------------->


                <form method="post" enctype="multipart/form-data">
                    <!-- formulir -->
                    <div class="row mt-5 mb-5">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                        <h2>Data Report</h2>
                                    </div>
                                    <div class="market-status-table mt-4">
                                        <div class="table-responsive" style="overflow-x:hidden;">

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Nama Proyek*</label>
                                                        <input name="nama-proyek" type="text" class="form-control" value="<?php echo $ambil['namaproyek'] ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Nama Mitra*</label>
                                                        <input name="nama-mitra" type="text" class="form-control" value="<?php echo $ambil['namamitra'] ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Tanggal Lapor*</label>
                                                        <input name="tgllapor" type="date" class="form-control" value="<?php echo $ambil['tgllapor'] ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>File Mancore*</label><br>
                                                        <?php if (!empty($ambil['filemancore'])) : ?>
                                                            <a href="../user/<?php echo $ambil['filemancore'] ?>" class="btn btn-secondary" download>Download File Mancore</a>
                                                        <?php else : ?>
                                                            <p>File Mancore tidak tersedia</p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>File KML*</label><br>
                                                        <?php if (!empty($ambil['filekml'])) : ?>
                                                            <a href="../user/<?php echo $ambil['filekml'] ?>" class="btn btn-secondary" download>Download File KML</a>
                                                        <?php else : ?>
                                                            <p>File KML tidak tersedia</p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>File APD*</label><br>
                                                        <?php if (!empty($ambil['fileapd'])) : ?>
                                                            <a href="../user/<?php echo $ambil['fileapd'] ?>" class="btn btn-secondary" download>Download File APD</a>
                                                        <?php else : ?>
                                                            <p>File APD tidak tersedia</p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="fotoep" class=" form-control-label">Foto Eviden Pembangunan</label><br>
                                                        <img src="<?php echo $ambil['fotoep'] ?>" width="100%">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="fotoqr" class=" form-control-label">Foto Validasi (QR)</label><br>
                                                        <img src="<?php echo $ambil['fotoqr'] ?>" width="50%">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" value="<?= $userid; ?>" name="id">
                                            <div class="modal-footer">
                                                <p>*Klik Konfirmasi agar data diterima SDI</p>
                                                <input type="submit" name="update" class="btn btn-primary" value="Simpan">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Konfirmasi</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>


            <!-- The Modal -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form method="post">

                            <!-- Modal body -->
                            <div class="modal-body">
                                Apakah Anda yakin untuk konfirmasi data Anda?
                                <input type="hidden" value="<?= $userid; ?>" name="id">
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <input type="submit" class="btn btn-success" name="ok" value="Konfirmasi">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- row area start-->
        </div>
    </div>
    <!-- main content area end -->
    <!-- footer area start-->
    <footer>
        <div class="footer-area">
            <p>Telkom Report System by BONAGA UNM</p>
        </div>
    </footer>
    <!-- footer area end-->
    </div>
    <!-- page container area end -->

    <!-- jquery latest version -->
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="../assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="../assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>