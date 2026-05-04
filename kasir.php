<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'kasir') {
    header("location:login.php");
}
?>

<?php $page_title = 'Kasir - Mini Kasir'; include 'header.php'; ?>

<div class="row justify-content-center">
    <div class="col-xl-5 col-lg-6 col-md-8">
        <div class="card fade-in">
            <div class="card-header bg-primary-custom text-white text-center py-4">
                <i class="fas fa-cash-register fa-2x mb-2"></i>
                <h2 class="mb-0">Poin Kasir</h2>
            </div>
            <div class="card-body p-5">
                <form method="POST" action="transaksi.php" id="kasirForm">
                    <div class="row g-4">
                        <div class="col-12">
                            <label for="harga" class="form-label fw-bold">
                                <i class="fas fa-tag me-2 text-primary-custom"></i>Harga (Rp)
                            </label>
                            <input type="number" class="form-control form-control-lg" name="harga" id="harga" min="0" step="100" required>
                        </div>
                        <div class="col-12">
                            <label for="diskon" class="form-label fw-bold">
                                <i class="fas fa-percent me-2 text-secondary-custom"></i>Diskon (%)
                            </label>
                            <input type="number" class="form-control form-control-lg" name="diskon" id="diskon" min="0" max="100" value="0">
                        </div>
                        <div class="col-12">
                            <label for="bayar" class="form-label fw-bold">
                                <i class="fas fa-money-bill-wave me-2 text-success-custom"></i>Bayar (Rp)
                            </label>
                            <input type="number" class="form-control form-control-lg" name="bayar" id="bayar" min="0" step="1000" required>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <small class="text-muted">Total</small>
                                    <h4 class="text-primary-custom mb-0" id="totalDisplay">Rp 0</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <small class="text-muted">Kembalian</small>
                                    <h4 class="text-success mb-0" id="kembalianDisplay">Rp 0</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary-custom btn-lg w-100 py-3">
                            <i class="fas fa-calculator me-2"></i><span id="btnText">Proses Transaksi</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = ['harga', 'diskon', 'bayar'];
    inputs.forEach(id => document.getElementById(id).addEventListener('input', calculate));

    function calculate() {
        const harga = parseFloat(document.getElementById('harga').value) || 0;
        const diskon = parseFloat(document.getElementById('diskon').value) || 0;
        const bayar = parseFloat(document.getElementById('bayar').value) || 0;
        
        const total = harga * (1 - diskon / 100);
        const kembalian = bayar - total;
        
        document.getElementById('totalDisplay').textContent = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('kembalianDisplay').textContent = 'Rp ' + (kembalian > 0 ? kembalian.toLocaleString('id-ID') : 0);
        
        const btn = document.querySelector('#btnText');
        if (kembalian >= 0 && total > 0) {
            btn.textContent = 'Proses Transaksi';
        } else {
            btn.textContent = 'Cek Ulang';
        }
    }
});
</script>

<?php include 'footer.php'; ?>
