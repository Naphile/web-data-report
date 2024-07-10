<?php

if (isset($_POST['submit'])) {
    $namaproyek = $_POST['nama-proyek'];
    $namamitra = $_POST['nama-mitra'];
    $tgllapor = $_POST['tgllapor'];
    $userid = $_POST['id'];

    $mancore = 'mancore_' . $namaproyek . '_';
    $kml = 'kml_' . $namaproyek . '_';
    $apd = 'apd_' . $namaproyek . '_';

    // Menentukan direktori tujuan untuk menyimpan file yang diunggah
    $target_dir_mancore = "files/mancore/" . $mancore;
    $target_dir_kml = "files/kml/" . $kml;
    $target_dir_apd = "files/apd/" . $apd;

    // Mengunggah file Mancore
    $file_mancore = $_FILES["file-mancore"]["name"];
    $target_file_mancore = $target_dir_mancore . basename($file_mancore);
    // move_uploaded_file($_FILES["file-mancore"]["tmp_name"], $target_file_mancore);

    // Mengunggah file KML
    $file_kml = $_FILES["file-kml"]["name"];
    $target_file_kml = $target_dir_kml . basename($file_kml);
    // move_uploaded_file($_FILES["file-kml"]["tmp_name"], $target_file_kml);

    // Mengunggah file APD
    $file_apd = $_FILES["file-apd"]["name"];
    $target_file_apd = $target_dir_apd . basename($file_apd);
    // move_uploaded_file($_FILES["file-apd"]["tmp_name"], $target_file_apd);

    $efidenpembangunan = 'fotoep_' . $namaproyek;
    $validasiqr = 'fotoqr_' . $namaproyek;

    // Perihal gambar
    $nama_file_ep = $_FILES['fotoep']['name'];
    $nama_file_qr = $_FILES['fotoqr']['name'];
    $ext2 = pathinfo($nama_file_ep, PATHINFO_EXTENSION);
    $ext3 = pathinfo($nama_file_qr, PATHINFO_EXTENSION);
    $ukuran_file_ep = $_FILES['fotoep']['size'];
    $ukuran_file_qr = $_FILES['fotoqr']['size'];
    $ukurantotal = $ukuran_file_ep + $ukuran_file_qr;
    $tipe_file_ep = $_FILES['fotoep']['type'];
    $tipe_file_qr = $_FILES['fotoqr']['type'];
    $tmp_file_ep = $_FILES['fotoep']['tmp_name'];
    $tmp_file_qr = $_FILES['fotoqr']['tmp_name'];
    $path_ep = "images/efiden_pembangunan/" . $efidenpembangunan . '.' . $ext2;
    $path_qr = "images/validasi_qr/" . $validasiqr . '.' . $ext3;

    // Debugging
    // echo "tmp_file_mancore: $tmp_file_mancore, path_mancore: $path_mancore<br>";
    // echo "tmp_file_kml: $tmp_file_kml, path_kml: $path_kml<br>";
    // echo "tmp_file_apd: $tmp_file_apd, path_apd: $path_apd<br>";
    echo "tmp_file_ep: $tmp_file_ep, path_ep: $path_ep<br>";
    echo "tmp_file_qr: $tmp_file_qr, path_qr: $path_qr<br>";

    // Validasi file
    if (($tipe_file_ep == "image/jpeg" || $tipe_file_ep == "image/png") &&
        ($tipe_file_qr == "image/jpeg" || $tipe_file_qr == "image/png")
    ) {

        if ($ukurantotal <= 2000000) {
            // $upload_mancore = move_uploaded_file($tmp_file_mancore, $path_mancore);
            // $upload_kml = move_uploaded_file($tmp_file_kml, $path_kml);
            // $upload_apd = move_uploaded_file($tmp_file_apd, $path_apd);
            $upload_mancore = move_uploaded_file($_FILES["file-mancore"]["tmp_name"], $target_file_mancore);
            $upload_kml = move_uploaded_file($_FILES["file-kml"]["tmp_name"], $target_file_kml);
            $upload_apd = move_uploaded_file($_FILES["file-apd"]["tmp_name"], $target_file_apd);
            $upload_ep = move_uploaded_file($tmp_file_ep, $path_ep);
            $upload_qr = move_uploaded_file($tmp_file_qr, $path_qr);

            // Debugging
            if (!$upload_mancore) {
                echo "Error uploading File Mancore: " . $_FILES['file-mancore']['error'] . "<br>";
            }
            if (!$upload_kml) {
                echo "Error uploading File KML: " . $_FILES['file-kml']['error'] . "<br>";
            }
            if (!$upload_apd) {
                echo "Error uploading File APD: " . $_FILES['file-apd']['error'] . "<br>";
            }
            if (!$upload_ep) {
                echo "Error uploading Eviden Pembangunan: " . $_FILES['fotoep']['error'] . "<br>";
            }
            if (!$upload_qr) {
                echo "Error uploading Validasi QR: " . $_FILES['fotoqr']['error'] . "<br>";
            }

            if ($upload_mancore && $upload_kml && $upload_apd && $upload_ep && $upload_qr) {
                $submitdata = mysqli_query($conn, "INSERT INTO userdata (userid, namaproyek, namamitra, filemancore, filekml, fileapd, tgllapor, fotoep, fotoqr) VALUES ('$userid', '$namaproyek', '$namamitra', '$target_file_mancore', '$target_file_kml', '$target_file_apd', '$tgllapor', '$path_ep', '$path_qr')");

                if ($submitdata) {
                    echo " <div class='alert alert-success'>
                            Berhasil submit data.
                        </div>
                        <meta http-equiv='refresh' content='2; url= pelaporan.php'/>  ";
                } else {
                    echo "<div class='alert alert-warning'>
                            Gagal submit data. Silakan coba lagi nanti.
                        </div>
                        <meta http-equiv='refresh' content='3; url= pelaporan.php'/> ";
                }
            } else {
                echo "Sorry, there's a problem while uploading the file.";
                echo "<br><meta http-equiv='refresh' content='5; URL=pelaporan.php'> You will be redirected to the form in 5 seconds";
            }
        } else {
            echo "Sorry, the file size is not allowed to be more than 1.5MB";
            echo "<br><meta http-equiv='refresh' content='5; URL=pelaporan.php'> You will be redirected to the form in 5 seconds";
        }
    } else {
        echo "Sorry, the image format should be JPG/PNG.";
        echo "<br><meta http-equiv='refresh' content='5; URL=pelaporan.php'> You will be redirected to the form in 5 seconds";
    }
}

//get timezone jkt
date_default_timezone_set("Asia/Bangkok");
$today = date("Y-m-d"); //now

//kalau konfirmasi
if (isset($_POST['ok'])) {
    $id = $_POST['id'];
    $updateaja = mysqli_query($conn, "update userdata set status='Verified', tglkonfirmasi='$today' where userid='$id'");

    if ($updateaja) {
        //berhasil bikin
        echo " <div class='alert alert-success'>
          Berhasil submit data.
      </div>
      <meta http-equiv='refresh' content='1; url= mydata.php'/>  ";
    } else {
        echo "<div class='alert alert-warning'>
              Gagal submit data. Silakan coba lagi nanti.
          </div>
          <meta http-equiv='refresh' content='3; url= mydata.php'/> ";
    }
};
