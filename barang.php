<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("location:login.php");
}

include "koneksi.php";
if (isset($_POST['nama'])) {
    mysqli_query($conn, "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$_POST[nama]', '$_POST[harga]', '$_POST[stok]')");
}

?>

<?php $page_title = 'Kelola Barang - Mini Kasir'; include 'header.php'; ?>

<div class="row">
    <div class="col-12">
        <div class="card fade-in">
            <div class="card-header bg-primary-custom text-white d-flex align-items-center">
                <i class="fas fa-boxes fa-2x me-3"></i>
                <h3 class="mb-0">Kelola Barang</h3>
            </div>
            <div class="card-body">
                <!-- Form Tambah Barang -->
                <form method="POST" class="mb-5 p-4 bg-light rounded-3">
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <label for="nama" class="form-label fw-bold">
                                <i class="fas fa-tag me-2 text-primary-custom"></i>Nama Barang
                            </label>
                            <input type="text" class="form-control form-control-lg" name="nama" id="nama" required>
                        </div>
                        <div class="col-lg-3">
                            <label for="harga" class="form-label fw-bold">
                                <i class="fas fa-money-bill me-2 text-primary-custom"></i>Harga (Rp)
                            </label>
                            <input type="number" class="form-control form-control-lg" name="harga" id="harga" min="0" required>
                        </div>
                        <div class="col-lg-3">
                            <label for="stok" class="form-label fw-bold">
                                <i class="fas fa-warehouse me-2 text-secondary-custom"></i>Stok
                            </label>
                            <input type="number" class="form-control form-control-lg" name="stok" id="stok" min="0" required>
                        </div>
                        <div class="col-lg-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary-custom btn-lg w-100 py-3">
                                <i class="fas fa-plus me-2"></i>Tambah Barang
                            </button>
                        </div>
                    </div>
                </form>
                
                <!-- Tabel Barang -->
                <div class="table-responsive">
                    <?php include "tampil_barang.php"; ?>
                </div>
                
                <div class="mt-4">
                    <a href="admin.php" class="btn btn-secondary-custom">
                        <i class="fas fa-arrow-left me-2"></i>Kembali Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
