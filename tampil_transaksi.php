<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("location:login.php");
}

include "koneksi.php";
$data = mysqli_query($conn, "SELECT * FROM transaksi");
?>

<?php $page_title = 'Laporan Transaksi - Mini Kasir'; include 'header.php'; ?>

<div class="row">
    <div class="col-12">
        <div class="card fade-in">
            <div class="card-header bg-primary-custom text-white d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-chart-bar fa-2x me-3"></i>
                    <h3 class="mb-0 d-inline">Laporan Transaksi</h3>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-light btn-sm" onclick="exportCSV()">
                        <i class="fas fa-download"></i> Export CSV
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-secondary-custom btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?filter=hari">Hari Ini</a></li>
                            <li><a class="dropdown-item" href="?filter=minggu">Minggu Ini</a></li>
                            <li><a class="dropdown-item" href="?filter=bulan">Bulan Ini</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="tampil_transaksi.php">Semua</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php
                include "koneksi.php";
                $filter = $_GET['filter'] ?? '';
                $where = '';
                if ($filter == 'hari') $where = "WHERE DATE(tanggal) = CURDATE()";
                elseif ($filter == 'minggu') $where = "WHERE WEEK(tanggal) = WEEK(CURDATE())";
                elseif ($filter == 'bulan') $where = "WHERE MONTH(tanggal) = MONTH(CURDATE())";
                
                $data = mysqli_query($conn, "SELECT * FROM transaksi $where ORDER BY id DESC");
                $total_rows = mysqli_num_rows($data);
                ?>
                
                <div class="alert alert-info d-flex align-items-center">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Total: <?php echo $total_rows; ?> transaksi</strong>
                    <?php if ($filter) echo " | Filter: " . ucfirst($filter); ?>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Bayar</th>
                                <th>Kembalian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; 
                            mysqli_data_seek($data, 0); // Reset pointer
                            while ($d = mysqli_fetch_array($data)) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><span class="badge bg-primary-custom">#<?php echo $d['id']; ?></span></td>
                                <td>
                                    <i class="fas fa-calendar me-1 text-secondary-custom"></i>
                                    <?php echo date('d/m/Y H:i', strtotime($d['tanggal'])); ?>
                                </td>
                                <td><strong class="text-primary-custom">Rp <?php echo number_format($d['total']); ?></strong></td>
                                <td>Rp <?php echo number_format($d['bayar']); ?></td>
                                <td class="text-success fw-bold">Rp <?php echo number_format($d['kembalian']); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                
                <?php if ($total_rows == 0): ?>
                <div class="text-center py-5">
                    <i class="fas fa-receipt-slash fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada transaksi</h5>
                    <p class="text-muted">Mulai buat transaksi pertama Anda!</p>
                </div>
                <?php endif; ?>
                
                <div class="mt-4">
                    <a href="admin.php" class="btn btn-secondary-custom">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function exportCSV() {
    const csvContent = "ID,Tanggal,Total,Bayar,Kembalian\\n";
    // Simple CSV generation - in production use server-side
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'laporan_transaksi.csv';
    a.click();
}

</script>

<?php include 'footer.php'; ?>
