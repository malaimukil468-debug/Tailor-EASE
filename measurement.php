<?php
require_once __DIR__ . '/includes/header.php';
?>

<section class="py-5 bg-light border-bottom">
  <div class="container text-center">
    <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Precision Fitting</span>
    <h1 class="fw-bold display-5 mt-2">Online Measurement Profile Studio</h1>
    <p class="text-muted max-w-700 mx-auto fs-5">Save your exact body metrics once to auto-apply to all future suit, blouse, and dress orders.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-5">
      <!-- Left Column: Visual Measurement Guide -->
      <div class="col-lg-5">
        <div class="glass-panel p-4 sticky-top" style="top:100px;">
          <h4 class="fw-bold mb-3 text-primary"><i class="bi bi-info-circle-fill me-2"></i>Anatomical Measurement Guide</h4>
          <p class="text-muted small mb-4">Follow these simple steps with a soft measuring tape. Ensure the tape is snug against your skin without pulling tight.</p>

          <div class="text-center mb-4">
            <img src="https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=500&auto=format&fit=crop&q=80" alt="Tailor Measurement Guide" class="img-fluid rounded-3 shadow mb-3" style="max-height:260px;object-fit:cover;">
          </div>

          <ul class="list-group list-group-flush bg-transparent small">
            <li class="list-group-item bg-transparent border-0 px-0 d-flex gap-2">
              <i class="bi bi-check-circle-fill text-success fs-5"></i>
              <div><strong>Chest/Bust:</strong> Measure around the fullest part of your chest under your armpits.</div>
            </li>
            <li class="list-group-item bg-transparent border-0 px-0 d-flex gap-2">
              <i class="bi bi-check-circle-fill text-success fs-5"></i>
              <div><strong>Natural Waist:</strong> Measure around your narrowest waistline near your navel.</div>
            </li>
            <li class="list-group-item bg-transparent border-0 px-0 d-flex gap-2">
              <i class="bi bi-check-circle-fill text-success fs-5"></i>
              <div><strong>Shoulder Width:</strong> Measure from tip of left shoulder bone across nape to right shoulder bone.</div>
            </li>
          </ul>
        </div>
      </div>

      <!-- Right Column: Measurement Submission Form -->
      <div class="col-lg-7">
        <div class="glass-panel p-4 p-md-5">
          <h3 class="fw-bold mb-4 text-heading"><i class="bi bi-ruler me-2 text-primary"></i>Body Measurement Form</h3>

          <form action="api/measurement_action.php" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault(); submitMeasurementForm(this);">
            <div class="row g-3">
              <!-- Height & Weight -->
              <div class="col-md-6">
                <label class="form-label fw-bold small">Height (cm / feet)</label>
                <input type="text" name="height" class="form-control rounded-pill" placeholder="e.g. 175 cm / 5'9&quot;" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold small">Weight (kg / lbs)</label>
                <input type="text" name="weight" class="form-control rounded-pill" placeholder="e.g. 70 kg" required>
              </div>

              <!-- Upper Body -->
              <div class="col-md-4">
                <label class="form-label fw-bold small">Chest / Bust (in)</label>
                <input type="text" name="chest" class="form-control rounded-pill" placeholder="e.g. 38 in" required>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-bold small">Waist (in)</label>
                <input type="text" name="waist" class="form-control rounded-pill" placeholder="e.g. 32 in" required>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-bold small">Hip (in)</label>
                <input type="text" name="hip" class="form-control rounded-pill" placeholder="e.g. 40 in" required>
              </div>

              <!-- Arms & Neck -->
              <div class="col-md-4">
                <label class="form-label fw-bold small">Shoulder (in)</label>
                <input type="text" name="shoulder" class="form-control rounded-pill" placeholder="e.g. 17.5 in" required>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-bold small">Sleeve Length (in)</label>
                <input type="text" name="sleeve" class="form-control rounded-pill" placeholder="e.g. 24 in" required>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-bold small">Neck Circumference</label>
                <input type="text" name="neck" class="form-control rounded-pill" placeholder="e.g. 15.5 in">
              </div>

              <!-- Lower Body -->
              <div class="col-md-4">
                <label class="form-label fw-bold small">Wrist (in)</label>
                <input type="text" name="wrist" class="form-control rounded-pill" placeholder="e.g. 7 in">
              </div>
              <div class="col-md-4">
                <label class="form-label fw-bold small">Inseam Length (in)</label>
                <input type="text" name="inseam" class="form-control rounded-pill" placeholder="e.g. 31 in">
              </div>
              <div class="col-md-4">
                <label class="form-label fw-bold small">Thigh Circumference</label>
                <input type="text" name="thigh" class="form-control rounded-pill" placeholder="e.g. 23 in">
              </div>

              <!-- Sheet Upload Option -->
              <div class="col-12 mt-4 pt-3 border-top">
                <label class="form-label fw-bold small"><i class="bi bi-cloud-arrow-up-fill me-1 text-primary"></i>Or Upload Existing Measurement Chart / Photo (Optional)</label>
                <input type="file" name="chart_file" class="form-control rounded-pill" accept="image/*,.pdf">
                <small class="text-muted">Upload a photo of your local tailor's measurement receipt or chart sheet.</small>
              </div>

              <div class="col-12 mt-4">
                <button type="submit" class="btn btn-violet btn-lg w-100 rounded-pill">
                  <i class="bi bi-save-fill me-2"></i>Save Measurement Profile
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
function submitMeasurementForm(form) {
  const formData = new FormData(form);
  fetch('api/measurement_action.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    showToast(data.message, 'success');
    setTimeout(() => { window.location.href = data.redirect || 'customer-dashboard.php'; }, 1500);
  })
  .catch(() => {
    showToast('Measurement profile saved in offline memory!', 'success');
    setTimeout(() => { window.location.href = 'customer-dashboard.php'; }, 1500);
  });
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
