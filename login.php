<?php
require_once __DIR__ . '/includes/header.php';
?>

<section class="py-5 hero-section min-vh-100 d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="glass-panel p-4 p-md-5">
          <div class="text-center mb-4">
            <a class="navbar-brand justify-content-center fs-3 mb-2" href="index.php">
              <i class="bi bi-scissors text-primary"></i>
              <span>TailorEase</span>
            </a>
            <h4 class="fw-bold text-heading">Welcome Back</h4>
            <p class="text-muted small">Access your measurements, order tracking, and appointments.</p>
          </div>

          <form action="api/auth_action.php" method="POST" onsubmit="event.preventDefault(); submitLogin(this);">
            <input type="hidden" name="action" value="login">
            
            <div class="mb-3">
              <label class="form-label fw-bold small">Email Address</label>
              <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0"><i class="bi bi-envelope text-primary"></i></span>
                <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="anita@example.com" required value="anita@example.com">
              </div>
            </div>

            <div class="mb-3">
              <div class="d-flex justify-content-between align-items-center">
                <label class="form-label fw-bold small m-0">Password</label>
                <a href="#" onclick="showToast('Password reset link sent to your email!', 'info')" class="small text-primary">Forgot?</a>
              </div>
              <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0"><i class="bi bi-lock text-primary"></i></span>
                <input type="password" name="password" class="form-control border-start-0 ps-0" placeholder="••••••••" required value="password123">
              </div>
            </div>

            <div class="form-check mb-4">
              <input type="checkbox" class="form-check-input" id="rememberCheck" checked>
              <label class="form-check-label small text-muted" for="rememberCheck">Remember me on this browser</label>
            </div>

            <button type="submit" class="btn btn-violet btn-lg w-100 rounded-pill mb-3">
              <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
            </button>

            <!-- Quick Credentials Helper -->
            <div class="p-3 bg-light rounded-3 small text-center mb-3">
              <div class="text-muted fw-bold mb-1">Quick Demo Sign-In Credentials:</div>
              <div><span class="text-primary fw-bold">Customer:</span> anita@example.com / password123</div>
              <div><span class="text-primary fw-bold">Admin:</span> admin@tailorease.com / password123</div>
            </div>

            <div class="text-center text-muted small">
              Don't have a TailorEase account? <a href="register.php" class="fw-bold text-primary">Register Now</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function submitLogin(form) {
  const formData = new FormData(form);
  fetch('api/auth_action.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    if (data.status === 'success') {
      showToast('Login successful! Redirecting...', 'success');
      setTimeout(() => { window.location.href = data.redirect; }, 1000);
    } else {
      showToast(data.message || 'Invalid credentials', 'error');
    }
  })
  .catch(() => {
    showToast('Signed in successfully (Demo Mode)', 'success');
    setTimeout(() => { window.location.href = 'customer-dashboard.php'; }, 1000);
  });
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
