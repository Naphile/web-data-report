<?php
include('../dbconnect.php');

$u = $_GET['u'];
$cekdulu = mysqli_query($conn, "SELECT * FROM userdata WHERE `nama-proyek`='$u'");
$ambil = mysqli_fetch_array($cekdulu);

require_once("../dompdf/autoload.inc.php");

use Dompdf\Dompdf;


$query = mysqli_query($conn, "select * from userdata where nama-proyek='$u'");
$html = '
<center><h3>Pelaporan Data Proyek</h3></center><hr/><br/>';
$html .= '
<div class="row mt-5 mb-5">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-center">
                <h2>Data Report</h2>
            </div>
            <div class="market-status-table mt-4">
                <div class="table-responsive" style="overflow-x:hidden;">
                    <input type="hidden" name="id" value="' . htmlspecialchars($ambil['id']) . '">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Nama Proyek*</label>
                                <p>' . htmlspecialchars($ambil['nama-proyek']) . '</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Nama Mitra*</label>
                                <p>' . htmlspecialchars($ambil['nama-mitra']) . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Tanggal Lapor*</label>
                                <p>' . htmlspecialchars($ambil['tgllapor']) . '</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>File Mancore*</label>
                                <p>' . htmlspecialchars($ambil['file-mancore']) . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>File KML*</label>
                                <p>' . htmlspecialchars($ambil['file-kml']) . '</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>File APD*</label>
                                <p>' . htmlspecialchars($ambil['file-apd']) . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="fotoep" class="form-control-label">Foto Eviden Pembangunan</label>
                                <img src="../user/' . htmlspecialchars($ambil['fotoep']) . '" width="50%">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="fotoqr" class="form-control-label">Foto Validasi (QR)</label>
                                <img src="../user/' . htmlspecialchars($ambil['fotoqr']) . '" width="50%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';

$html .= "</html>";

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream($u);
