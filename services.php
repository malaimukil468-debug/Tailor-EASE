<?php
require_once __DIR__ . '/includes/header.php';
$allServices = get_sample_services();
$selectedCat = $_GET['cat'] ?? 'all';
?>

<section class="py-5 bg-light border-bottom">
  <div class="container text-center">
    <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Bespoke Stitching</span>
    <h1 class="fw-bold display-5 mt-2">Services & Tailoring Catalog</h1>
    <p class="text-muted max-w-700 mx-auto fs-5">Explore our wide spectrum of custom garment creation, precision alterations, and grand wedding couture.</p>

    <!-- Category Filter Tabs -->
    <div class="d-flex flex-wrap justify-content-center gap-2 mt-4">
      <a href="services.php?cat=all" class="filter-btn <?= ($selectedCat=='all')?'active':'' ?>">All Services</a>
      <a href="services.php?cat=men" class="filter-btn <?= ($selectedCat=='men')?'active':'' ?>">Men's Couture</a>
      <a href="services.php?cat=women" class="filter-btn <?= ($selectedCat=='women')?'active':'' ?>">Women's Collection</a>
      <a href="services.php?cat=kids" class="filter-btn <?= ($selectedCat=='kids')?'active':'' ?>">Kids Wear</a>
      <a href="services.php?cat=special" class="filter-btn <?= ($selectedCat=='special')?'active':'' ?>">Alterations & Special</a>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <?php 
      $filtered = ($selectedCat === 'all') ? $allServices : array_values(array_filter($allServices, function($s) use ($selectedCat){
          return $s['category'] === $selectedCat;
      }));

      foreach ($filtered as $s): 
      ?>
        <div class="col-lg-4 col-md-6">
          <div class="glass-card h-100 d-flex flex-column">
            <div class="card-img-wrap">
              <img src="<?= $s['image'] ?>" alt="<?= htmlspecialchars($s['title']) ?>">
              <span class="card-tag"><?= strtoupper($s['category']) ?></span>
            </div>
            <div class="p-4 d-flex flex-column flex-grow-1">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="fw-bold m-0 text-heading"><?= htmlspecialchars($s['title']) ?></h5>
                <span class="price-badge"><?= format_currency($s['price']) ?></span>
              </div>
              <p class="text-muted small mb-3 flex-grow-1"><?= htmlspecialchars($s['description']) ?></p>
              <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <small class="text-muted"><i class="bi bi-clock me-1 text-primary"></i> Turnaround: <?= $s['est_days'] ?></small>
                <a href="order.php?service_id=<?= $s['id'] ?>" class="btn btn-violet btn-sm">Book & Customize</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
