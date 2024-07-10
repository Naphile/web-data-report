<?php
include('../dbconnect.php');

$u = $_GET['u'];
$cekdulu = mysqli_query($conn, "SELECT * FROM userdata WHERE `namaproyek`='$u'");
$ambil = mysqli_fetch_array($cekdulu);

require_once("../dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$query = mysqli_query($conn, "select * from userdata where namaproyek='$u'");
$html = '<center><h3>Pelaporan Data Proyek</h3></center><hr/><br/>';
$html .= '<div class="row mt-5 mb-5">
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
                                <p>' . $ambil['namaproyek'] . '</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Nama Mitra*</label>
                                <p>' . $ambil['namamitra'] . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Tanggal Lapor*</label>
                                <p>' . $ambil['tgllapor'] . '</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>File Mancore*</label>
                                <p>' . $ambil['filemancore'] . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>File KML*</label>
                                <p>' . $ambil['filekml'] . '</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>File APD*</label>
                                <p>' . $ambil['fileapd'] . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="fotoep" class="form-control-label">Foto Eviden Pembangunan</label>
                                <img src="../user/' . $ambil['fotoep'] . '" width="50%">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="fotoqr" class="form-control-label">Foto Validasi (QR)</label>
                                <img src="../user/' . $ambil['fotoqr'] . '" width="50%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';

$html .= "</html>";

$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream($u . '.pdf');
