<?php
require_once __DIR__ . '/includes/header.php';
$services = get_sample_services();
?>

<section class="py-5 bg-light border-bottom">
  <div class="container text-center">
    <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Transparent Pricing</span>
    <h1 class="fw-bold display-5 mt-2">Pricing & Stitching Packages</h1>
    <p class="text-muted max-w-700 mx-auto fs-5">No hidden charges. Transparent pricing for individual tailoring services and luxury membership packages.</p>
  </div>
</section>

<!-- Pricing Packages Tiers -->
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <!-- Basic Plan -->
      <div class="col-lg-4">
        <div class="glass-card p-4 text-center h-100 d-flex flex-column">
          <span class="badge bg-secondary text-white px-3 py-1 rounded-pill mx-auto mb-3">ESSENTIAL</span>
          <h3 class="fw-bold">Basic Stitching</h3>
          <div class="display-5 fw-bold text-primary my-3">₹850 <small class="fs-6 text-muted">/ item</small></div>
          <p class="text-muted small">Ideal for casual shirts, trousers, and basic blouse stitching.</p>
          <ul class="list-unstyled text-start my-4 flex-grow-1">
            <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Standard 4-day turnaround</li>
            <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Standard cotton / poly thread</li>
            <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> In-store fitting trial</li>
            <li class="mb-2 text-muted"><i class="bi bi-x-lg text-danger me-2"></i> Doorstep measurement visit</li>
            <li class="text-muted"><i class="bi bi-x-lg text-danger me-2"></i> Free 30-day alteration guarantee</li>
          </ul>
          <a href="order.php" class="btn btn-outline-violet w-100 rounded-pill">Choose Basic</a>
        </div>
      </div>

      <!-- Premium Plan (Featured) -->
      <div class="col-lg-4">
        <div class="glass-card p-4 text-center h-100 d-flex flex-column border-primary position-relative" style="border-width:2px;">
          <span class="badge bg-primary text-white px-3 py-1 rounded-pill mx-auto mb-3">MOST POPULAR</span>
          <h3 class="fw-bold">Bespoke Premium</h3>
          <div class="display-5 fw-bold text-primary my-3">₹2,400 <small class="fs-6 text-muted">/ item</small></div>
          <p class="text-muted small">Perfect for designer blouses, suits, and grand celebration attires.</p>
          <ul class="list-unstyled text-start my-4 flex-grow-1">
            <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Fast 48-hour turnaround</li>
            <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> German Gutermann silk thread</li>
            <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> 1 Home doorstep fitting visit</li>
            <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Visual outfit customizer access</li>
            <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> 100% Fit alteration guarantee</li>
          </ul>
          <a href="order.php" class="btn btn-violet w-100 rounded-pill">Choose Premium</a>
        </div>
      </div>

      <!-- Luxury Plan -->
      <div class="col-lg-4">
        <div class="glass-card p-4 text-center h-100 d-flex flex-column">
          <span class="badge bg-warning text-dark px-3 py-1 rounded-pill mx-auto mb-3">ROYAL COUTURE</span>
          <h3 class="fw-bold">Royal Luxury</h3>
          <div class="display-5 fw-bold text-primary my-3">₹6,500 <small class="fs-6 text-muted">/ item</small></div>
          <p class="text-muted small">Dedicated to wedding lehengas, 3-piece suits, and royal sherwanis.</p>
          <ul class="list-unstyled text-start my-4 flex-grow-1">
            <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Priority VIP handcrafting</li>
            <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Hand zardosi / zari embroidery</li>
            <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Personal Senior Master Designer assigned</li>
            <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Unlimited home fitting sessions</li>
            <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Signature luxury gift box</li>
          </ul>
          <a href="order.php" class="btn btn-outline-violet w-100 rounded-pill">Choose Luxury</a>
        </div>
      </div>
    </div>

    <!-- Itemized Stitching Price Table -->
    <div class="mt-5 glass-panel p-4 p-md-5">
      <h3 class="fw-bold mb-4 text-heading"><i class="bi bi-list-ul text-primary me-2"></i>Itemized Stitching Rates</h3>
      
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>Category</th>
              <th>Garment Type</th>
              <th>Estimated Days</th>
              <th>Stitching Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($services as $s): ?>
              <tr>
                <td><span class="badge bg-secondary-lavender text-primary"><?= strtoupper($s['category']) ?></span></td>
                <td><strong><?= htmlspecialchars($s['title']) ?></strong></td>
                <td><i class="bi bi-clock me-1 text-muted"></i> <?= $s['est_days'] ?></td>
                <td class="fw-bold text-primary"><?= format_currency($s['price']) ?></td>
                <td><a href="order.php?service_id=<?= $s['id'] ?>" class="btn btn-violet btn-sm">Order Now</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
