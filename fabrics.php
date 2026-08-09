<?php
require_once __DIR__ . '/includes/header.php';
$fabrics = get_sample_fabrics();
?>

<section class="py-5 bg-light border-bottom">
  <div class="container text-center">
    <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Material Excellence</span>
    <h1 class="fw-bold display-5 mt-2">Luxury Fabric Collection</h1>
    <p class="text-muted max-w-700 mx-auto fs-5">Sourced from renowned mills in Egypt, Belgium, Banaras, and Kashmir. Inspect thread counts, texture, and color palettes.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($fabrics as $f): ?>
        <div class="col-lg-4 col-md-6">
          <div class="glass-card h-100 d-flex flex-column">
            <div class="card-img-wrap" style="height:220px;">
              <img src="<?= $f['image'] ?>" alt="<?= htmlspecialchars($f['name']) ?>">
              <span class="card-tag bg-success">IN STOCK</span>
            </div>
            <div class="p-4 d-flex flex-column flex-grow-1">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                  <h5 class="fw-bold text-heading m-0"><?= htmlspecialchars($f['name']) ?></h5>
                  <small class="text-primary fw-bold"><?= htmlspecialchars($f['type']) ?> Fabric</small>
                </div>
                <div class="text-end">
                  <span class="price-badge"><?= format_currency($f['price_per_meter']) ?></span>
                  <small class="d-block text-muted">per meter</small>
                </div>
              </div>
              
              <p class="text-muted small mb-3 flex-grow-1"><?= htmlspecialchars($f['description']) ?></p>

              <!-- Color Swatches -->
              <div class="mb-3">
                <small class="text-muted d-block fw-bold mb-1">Available Color Palette:</small>
                <div class="d-flex gap-2">
                  <?php 
                  $colors = explode(',', $f['colors']);
                  foreach ($colors as $c): 
                    $c = trim($c);
                  ?>
                    <span class="rounded-circle shadow-sm" style="width:22px;height:22px;background:<?= $c ?>;border:1px solid rgba(0,0,0,0.15);" title="<?= $c ?>"></span>
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="d-flex gap-2 pt-3 border-top">
                <button class="btn btn-outline-violet btn-sm p-2 rounded-circle" onclick="showToast('Added fabric to your wishlist!', 'success')" title="Add to Wishlist">
                  <i class="bi bi-heart"></i>
                </button>
                <a href="order.php?fabric_id=<?= $f['id'] ?>" class="btn btn-violet btn-sm flex-grow-1">
                  <i class="bi bi-scissors me-1"></i> Select For Stitching
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
