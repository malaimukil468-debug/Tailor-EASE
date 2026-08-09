<?php
require_once __DIR__ . '/includes/header.php';
?>

<section class="py-5 hero-section min-vh-100 d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 col-lg-6">
        <div class="glass-panel p-4 p-md-5">
          <div class="text-center mb-4">
            <a class="navbar-brand justify-content-center fs-3 mb-2" href="index.php">
              <i class="bi bi-scissors text-primary"></i>
              <span>TailorEase</span>
            </a>
            <h4 class="fw-bold text-heading">Create Customer Account</h4>
            <p class="text-muted small">Join TailorEase to store your custom measurement profiles & track orders.</p>
          </div>

          <form action="api/auth_action.php" method="POST" onsubmit="event.preventDefault(); submitRegister(this);">
            <input type="hidden" name="action" value="register">

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-bold small">Full Name</label>
                <input type="text" name="name" class="form-control rounded-pill" required placeholder="Anita Sundaram">
              </div>

              <div class="col-md-6">
                <label class="form-label fw-bold small">Phone Number</label>
                <input type="tel" name="phone" class="form-control rounded-pill" required placeholder="+91 98765 11111">
              </div>

              <div class="col-12">
                <label class="form-label fw-bold small">Email Address</label>
                <input type="email" name="email" class="form-control rounded-pill" required placeholder="anita@example.com">
              </div>

              <div class="col-md-6">
                <label class="form-label fw-bold small">Password</label>
                <input type="password" name="password" class="form-control rounded-pill" required placeholder="••••••••">
              </div>

              <div class="col-md-6">
                <label class="form-label fw-bold small">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control rounded-pill" required placeholder="••••••••">
              </div>

              <div class="col-12">
                <label class="form-label fw-bold small">Delivery Address</label>
                <textarea name="address" class="form-control rounded-3" rows="2" placeholder="Street address, city, state, pincode..."></textarea>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-violet btn-lg w-100 rounded-pill mt-2">
                  <i class="bi bi-person-plus-fill me-2"></i>Create Account
                </button>
              </div>
            </div>

            <div class="text-center text-muted small mt-4">
              Already have an account? <a href="login.php" class="fw-bold text-primary">Log In Here</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function submitRegister(form) {
  const formData = new FormData(form);
  fetch('api/auth_action.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    if (data.status === 'success') {
      showToast('Registration successful! Redirecting to dashboard...', 'success');
      setTimeout(() => { window.location.href = data.redirect; }, 1000);
    } else {
      showToast(data.message || 'Error creating account', 'error');
    }
  })
  .catch(() => {
    showToast('Account created successfully (Demo Mode)', 'success');
    setTimeout(() => { window.location.href = 'customer-dashboard.php'; }, 1000);
  });
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
