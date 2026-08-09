<?php
require_once __DIR__ . '/includes/header.php';
$orderNum = $_GET['order'] ?? $_SESSION['last_order_num'] ?? 'ORD-2026-8801';
$currentStage = 5; // Master Stitching stage for demonstration
?>

<section class="py-5 bg-light border-bottom">
  <div class="container text-center">
    <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Real-Time Craftsmanship Tracker</span>
    <h1 class="fw-bold display-5 mt-2">Track Garment Progress</h1>
    <p class="text-muted max-w-700 mx-auto fs-5">Monitor every phase of your order from pattern drafting and hand stitching to quality checks and dispatch.</p>

    <!-- Search Order Bar -->
    <div class="row justify-content-center mt-4">
      <div class="col-md-6">
        <form action="order-track.php" method="GET" class="d-flex gap-2 glass-panel p-2">
          <input type="text" name="order" class="form-control border-0 bg-transparent fw-bold" value="<?= htmlspecialchars($orderNum) ?>" placeholder="Enter Order # (e.g. ORD-2026-8801)">
          <button type="submit" class="btn btn-violet rounded-pill px-4">Track</button>
        </form>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <!-- Order Information Card -->
    <div class="glass-panel p-4 mb-5">
      <div class="row align-items-center g-3">
        <div class="col-md-3">
          <span class="text-muted d-block small">Tracking Order #</span>
          <strong class="fs-5 text-primary"><?= htmlspecialchars($orderNum) ?></strong>
        </div>
        <div class="col-md-3">
          <span class="text-muted d-block small">Garment Service</span>
          <strong class="text-heading">Designer Bridal Blouse / Suit</strong>
        </div>
        <div class="col-md-3">
          <span class="text-muted d-block small">Est. Delivery Date</span>
          <strong class="text-success"><i class="bi bi-calendar-event me-1"></i> July 28, 2026</strong>
        </div>
        <div class="col-md-3 text-md-end">
          <span class="badge badge-in_progress fs-6">Stage 5: Master Stitching</span>
        </div>
      </div>
    </div>

    <!-- 8-Stage Animated Order Stepper Container -->
    <div class="glass-panel p-4 p-md-5">
      <h4 class="fw-bold mb-4 text-heading text-center"><i class="bi bi-clock-history text-primary me-2"></i>Garment Fabrication Lifecycle</h4>
      
      <div id="interactive-order-tracker" data-current-stage="<?= $currentStage ?>"></div>

      <!-- Active Stage Detailed Log -->
      <div class="mt-5 p-4 bg-light rounded-3 border-start border-4 border-primary">
        <div class="d-flex align-items-center justify-content-between mb-2">
          <h5 class="fw-bold m-0 text-primary"><i class="bi bi-gear-wide-connected spinner-border spinner-border-sm me-2"></i>Current Stage: Master Stitching</h5>
          <small class="text-muted">Updated: Today at 02:45 PM</small>
        </div>
        <p class="text-muted m-0">
          Master Ramesh is currently performing hand embroidery and precision seam joining on Banarasi Raw Silk material. Expected completion for Quality Check phase by tomorrow afternoon.
        </p>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
