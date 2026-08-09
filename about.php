<?php
require_once __DIR__ . '/includes/header.php';
$tailors = get_sample_tailors();
?>

<!-- About Hero -->
<section class="py-5 bg-light border-bottom">
  <div class="container text-center py-4">
    <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Our Story</span>
    <h1 class="fw-bold display-5 mt-2">Crafting Elegance Since 2006</h1>
    <p class="text-muted max-w-700 mx-auto fs-5">
      TailorEase was born from a passion for timeless sartorial elegance, merging classical bespoke tailoring with digital precision fitting.
    </p>
  </div>
</section>

<!-- Mission & Vision -->
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="glass-panel p-5 h-100 border-start border-4 border-primary">
          <div class="stat-icon mb-3" style="width:50px;height:50px;font-size:1.5rem;"><i class="bi bi-compass"></i></div>
          <h3 class="fw-bold mb-3">Our Mission</h3>
          <p class="text-muted">
            To provide every individual with hand-crafted, perfectly fitted garments made from ethically sourced luxury fabrics, eliminating fitting compromises through modern measurement technology.
          </p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="glass-panel p-5 h-100 border-start border-4 border-primary">
          <div class="stat-icon mb-3" style="width:50px;height:50px;font-size:1.5rem;"><i class="bi bi-eye"></i></div>
          <h3 class="fw-bold mb-3">Our Vision</h3>
          <p class="text-muted">
            To become South Asia's premier digital bespoke couture platform, preserving traditional hand embroidery and suit canvas techniques while pioneering AI-assisted fitting and seamless doorstep delivery.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Timeline Animation Section -->
<section class="py-5 bg-white">
  <div class="container">
    <div class="text-center max-w-700 mx-auto mb-5">
      <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Historical Milestones</span>
      <h2 class="fw-bold mt-2 display-6">Our Journey Timeline</h2>
    </div>

    <div class="timeline">
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-content glass-card">
          <span class="badge bg-primary mb-2">2006</span>
          <h4 class="fw-bold">The Heritage Atelier</h4>
          <p class="text-muted m-0">Founded as a modest 3-master suit workshop in Chennai, delivering bespoke formalwear to local leaders and executives.</p>
        </div>
      </div>

      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-content glass-card">
          <span class="badge bg-primary mb-2">2014</span>
          <h4 class="fw-bold">Bridal Couture Division</h4>
          <p class="text-muted m-0">Expanded into heavy zardosi hand embroidery, establishing our dedicated women's wedding atelier.</p>
        </div>
      </div>

      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-content glass-card">
          <span class="badge bg-primary mb-2">2020</span>
          <h4 class="fw-bold">Doorstep Fitting Sessions</h4>
          <p class="text-muted m-0">Pioneered home measurement visits and luxury sample swatches delivered directly to clients' homes.</p>
        </div>
      </div>

      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-content glass-card">
          <span class="badge bg-primary mb-2">2026</span>
          <h4 class="fw-bold">TailorEase Digital Platform</h4>
          <p class="text-muted m-0">Launched our smart platform featuring visual outfit customizers, 8-stage live order tracking, and AI style recommendations.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Meet Our Master Tailors -->
<section class="py-5">
  <div class="container">
    <div class="text-center max-w-700 mx-auto mb-5">
      <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Master Artisans</span>
      <h2 class="fw-bold mt-2 display-6">Meet Our Tailors</h2>
      <p class="text-muted">Decades of combined tailoring mastery guaranteeing flawless seams, drape, and posture alignment.</p>
    </div>

    <div class="row g-4">
      <?php foreach ($tailors as $t): ?>
        <div class="col-md-4">
          <div class="glass-card text-center p-4">
            <img src="<?= $t['image'] ?>" alt="<?= htmlspecialchars($t['name']) ?>" class="rounded-circle mb-3 shadow" style="width:130px;height:130px;object-fit:cover;">
            <h4 class="fw-bold mb-1 text-heading"><?= htmlspecialchars($t['name']) ?></h4>
            <span class="badge bg-secondary-lavender text-primary mb-2"><?= htmlspecialchars($t['role']) ?></span>
            <p class="text-muted small mb-2"><?= htmlspecialchars($t['specialization']) ?></p>
            <div class="d-flex justify-content-center align-items-center gap-2 text-warning font-weight-bold">
              <i class="bi bi-star-fill"></i> <?= $t['rating'] ?> / 5.0 (<?= $t['experience_years'] ?> Yrs Exp)
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
