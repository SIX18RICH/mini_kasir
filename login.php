<?php $page_title = 'Login - Mini Kasir'; include 'header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-5 col-md-6 col-sm-8">
        <div class="card fade-in">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="fas fa-cash-register fa-3x text-primary-custom mb-3"></i>
                    <h2 class="fw-bold text-dark">Selamat Datang</h2>
                    <p class="text-muted">Masuk ke sistem Mini Kasir</p>
                </div>
                <form method="POST" action="proses_login.php">
                    <div class="mb-4">
                        <label for="username" class="form-label fw-semibold">
                            <i class="fas fa-user me-2 text-primary-custom"></i>Username
                        </label>
                        <input type="text" class="form-control form-control-lg" name="username" id="username" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">
                            <i class="fas fa-lock me-2 text-primary-custom"></i>Password
                        </label>
                        <input type="password" class="form-control form-control-lg" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary-custom btn-lg w-100 py-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
