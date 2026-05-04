<?php 
include "koneksi.php"; 
$data = mysqli_query($conn, "SELECT * FROM barang ORDER BY id DESC");
$no = 1;
?>
<div class="table-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fas fa-list me-2 text-primary-custom"></i>Data Barang (<?php echo mysqli_num_rows($data); ?>)
        </h4>
        <div class="search-box">
            <input type="text" class="form-control form-control-sm w-100" id="searchBarang" placeholder="Cari barang...">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-striped shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php while ($d = mysqli_fetch_array($data)) { ?>
                <tr data-nama="<?php echo strtolower($d['nama_barang']); ?>">
                    <td><?php echo $no++; ?></td>
                    <td>
                        <i class="fas fa-box me-2 text-secondary-custom"></i>
                        <?php echo $d['nama_barang']; ?>
                    </td>
                    <td>
                        <span class="badge bg-primary-custom fs-6 px-3 py-2">Rp <?php echo number_format($d['harga']); ?></span>
                    </td>
                    <td>
                        <span class="badge <?php echo $d['stok'] > 0 ? 'bg-success' : 'bg-danger'; ?> fs-6 px-3 py-2">
                            <?php echo $d['stok']; ?> pcs
                        </span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary-custom btn-sm edit-btn" data-id="<?php echo $d['id']; ?>" data-nama="<?php echo $d['nama_barang']; ?>" data-harga="<?php echo $d['harga']; ?>" data-stok="<?php echo $d['stok']; ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="hapus_barang.php?id=<?php echo $d['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus barang ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit Barang -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary-custom text-white">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>Edit Barang
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="edit_barang.php">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Barang</label>
                        <input type="text" class="form-control" name="nama" id="editNama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Harga (Rp)</label>
                        <input type="number" class="form-control" name="harga" id="editHarga" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Stok</label>
                        <input type="number" class="form-control" name="stok" id="editStok" min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary-custom">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search
    document.getElementById('searchBarang').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            const nama = row.dataset.nama;
            row.style.display = nama.includes(query) ? '' : 'none';
        });
    });

    // Edit modal
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('editId').value = this.dataset.id;
            document.getElementById('editNama').value = this.dataset.nama;
            document.getElementById('editHarga').value = this.dataset.harga;
            document.getElementById('editStok').value = this.dataset.stok;
            new bootstrap.Modal(document.getElementById('editModal')).show();
        });
    });
});
</script>
