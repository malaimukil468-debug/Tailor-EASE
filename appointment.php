<?php
require_once __DIR__ . '/includes/header.php';
$tailors = get_sample_tailors();
$services = get_sample_services();
?>

<section class="py-5 bg-light border-bottom">
  <div class="container text-center">
    <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Bespoke Fitting Consultation</span>
    <h1 class="fw-bold display-5 mt-2">Book Fitting Session</h1>
    <p class="text-muted max-w-700 mx-auto fs-5">Schedule a personal measurement appointment at our luxury atelier or request a home visit by a Master Tailor.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="glass-panel p-4 p-md-5">
          <form action="api/appointment_action.php" method="POST" onsubmit="event.preventDefault(); submitAppointment(this);">
            <div class="row g-4">
              <!-- Fitting Location Mode -->
              <div class="col-12">
                <label class="form-label fw-bold">1. Select Fitting Mode</label>
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="form-check custom-radio-box p-3 glass-card text-center">
                      <input class="form-check-input float-none mb-2" type="radio" name="fitting_type" id="modeStore" value="in_store" checked>
                      <label class="form-check-label d-block fw-bold" for="modeStore">
                        <i class="bi bi-shop fs-3 d-block text-primary mb-1"></i> In-Store Boutique Consultation
                      </label>
                      <small class="text-muted">Visit our luxury atelier in Chennai</small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-check custom-radio-box p-3 glass-card text-center">
                      <input class="form-check-input float-none mb-2" type="radio" name="fitting_type" id="modeHome" value="home_visit">
                      <label class="form-check-label d-block fw-bold" for="modeHome">
                        <i class="bi bi-house-door fs-3 d-block text-primary mb-1"></i> Doorstep Master Visit
                      </label>
                      <small class="text-muted">Tailor brings fabric samples & tape measure</small>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Service Type -->
              <div class="col-md-6">
                <label class="form-label fw-bold small">2. Service Required</label>
                <select name="service_type" class="form-select rounded-pill" required>
                  <?php foreach ($services as $s): ?>
                    <option value="<?= htmlspecialchars($s['title']) ?>"><?= htmlspecialchars($s['title']) ?> (<?= format_currency($s['price']) ?>)</option>
                  <?php endforeach; ?>
                </select>
              </div>

              <!-- Preferred Tailor -->
              <div class="col-md-6">
                <label class="form-label fw-bold small">3. Preferred Master Tailor</label>
                <select name="tailor_id" class="form-select rounded-pill">
                  <?php foreach ($tailors as $t): ?>
                    <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['name']) ?> (<?= htmlspecialchars($t['specialization']) ?>)</option>
                  <?php endforeach; ?>
                </select>
              </div>

              <!-- Date Picker -->
              <div class="col-md-6">
                <label class="form-label fw-bold small">4. Appointment Date</label>
                <input type="date" name="appointment_date" class="form-control rounded-pill" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
              </div>

              <!-- Time Slot -->
              <div class="col-md-6">
                <label class="form-label fw-bold small">5. Preferred Time Slot</label>
                <select name="appointment_time" class="form-select rounded-pill" required>
                  <option value="10:00 AM">10:00 AM - 11:30 AM</option>
                  <option value="11:30 AM">11:30 AM - 01:00 PM</option>
                  <option value="02:30 PM">02:30 PM - 04:00 PM</option>
                  <option value="05:00 PM">05:00 PM - 06:30 PM</option>
                </select>
              </div>

              <!-- Additional Notes -->
              <div class="col-12">
                <label class="form-label fw-bold small">6. Special Requests / Fitting Notes</label>
                <textarea name="notes" class="form-control rounded-3" rows="3" placeholder="Mention special fitting requirements, fabric preferences, or event dates..."></textarea>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-violet btn-lg w-100 rounded-pill">
                  <i class="bi bi-calendar-check me-2"></i>Confirm Appointment Booking
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function submitAppointment(form) {
  const formData = new FormData(form);
  fetch('api/appointment_action.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    showToast(data.message, 'success');
    setTimeout(() => { window.location.href = 'customer-dashboard.php'; }, 1500);
  })
  .catch(() => {
    showToast('Appointment booked in demo memory!', 'success');
    setTimeout(() => { window.location.href = 'customer-dashboard.php'; }, 1500);
  });
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
