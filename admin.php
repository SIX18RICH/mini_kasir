<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("location:login.php");
}
?>

<?php $page_title = 'Dashboard Admin - Mini Kasir'; include 'header.php'; ?>

<div class="row g-4 mb-5">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card fade-in">
            <i class="fas fa-box fa-3x mb-3 opacity-75"></i>
            <?php 
            include 'koneksi.php'; 
            $jumlah_barang = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) as total FROM barang"))['total'];
            ?>
            <h3 class="mb-1"><?php echo $jumlah_barang; ?></h3>
            <p class="mb-0">Total Barang</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card fade-in">
            <i class="fas fa-receipt fa-3x mb-3 opacity-75"></i>
            <?php $jumlah_transaksi = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) as total FROM transaksi"))['total']; ?>
            <h3 class="mb-1"><?php echo $jumlah_transaksi; ?></h3>
            <p class="mb-0">Transaksi Hari Ini</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card fade-in">
            <i class="fas fa-chart-line fa-3x mb-3 opacity-75"></i>
            <?php $total_penjualan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(total) as total FROM transaksi"))['total'] ?? 0; ?>
            <h3 class="mb-1">Rp <?php echo number_format($total_penjualan); ?></h3>
            <p class="mb-0">Total Penjualan</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card fade-in">
            <i class="fas fa-users fa-3x mb-3 opacity-75"></i>
            <h3 class="mb-1">2</h3>
            <p class="mb-0">Role Pengguna</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card fade-in">
            <div class="card-header bg-primary-custom text-white">
                <i class="fas fa-grip-lines me-2"></i>Aksi Cepat
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="barang.php" class="btn btn-primary-custom btn-lg w-100 h-100 p-4 text-center">
                            <i class="fas fa-plus-circle fa-2x mb-2 d-block"></i>
                            <h5>Kelola Barang</h5>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="tampil_transaksi.php" class="btn btn-secondary-custom btn-lg w-100 h-100 p-4 text-center">
                            <i class="fas fa-chart-bar fa-2x mb-2 d-block"></i>
                            <h5>Laporan Transaksi</h5>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="kasir.php" class="btn btn-success-custom btn-lg w-100 h-100 p-4 text-center">
                            <i class="fas fa-cash-register fa-2x mb-2 d-block"></i>
                            <h5>Mode Kasir</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card fade-in">
            <div class="card-header bg-secondary-custom text-white text-center">
                <i class="fas fa-info-circle"></i> Info Sistem
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-success me-2"></i>Online</li>
                    <li><i class="fas fa-database me-2 text-primary-custom"></i>DB Connected</li>
                    <li><i class="fas fa-shield-alt me-2 text-warning"></i>Secure Login</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
