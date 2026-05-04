<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'kasir') {
    header("location:login.php");
}

function hitungDiskon($harga, $diskon) {
    $potongan = $harga * ($diskon / 100);
    return $harga - $potongan;
}

function hitungKembalian($bayar, $total) {
    return $bayar - $total;
}

include "koneksi.php";

if (isset($_POST['harga'])) {
    $harga = $_POST['harga'];
    $diskon = $_POST['diskon'];
    $bayar = $_POST['bayar'];

    // Diskon otomatis: jika harga > 50000, diskon 5%
    if ($harga > 50000) {
        $diskon = 5;
    }

    $total = hitungDiskon($harga, $diskon);
    $kembalian = hitungKembalian($bayar, $total);

    if ($bayar < $total) {
        $pesan = "<div class='alert alert-danger'>Uang bayar kurang! Total yang harus dibayar: Rp $total</div>";
    } else {
        mysqli_query($conn, "INSERT INTO transaksi VALUES ('', NOW(), '$total', '$bayar', '$kembalian', '1')");
        $pesan = "<div class='alert alert-success'>Transaksi berhasil!<br>Total: Rp $total <br>Kembalian: Rp $kembalian</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Transaksi - Aplikasi Kasir Mini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Hasil Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <?php echo $pesan; ?>
                        <a href="kasir.php" class="btn btn-primary">Kembali ke Kasir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>