<?php
require_once __DIR__ . '/includes/header.php';

$blogs = [
    ['id' => 1, 'title' => '10 Essential Tips to Care for Pure Silk & Velvet Outfits', 'category' => 'Fabric Care', 'excerpt' => 'Learn how to preserve the sheen, color, and texture of your premium raw silk and royal velvet garments for decades.', 'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=600&auto=format&fit=crop&q=80', 'author' => 'Meenakshi Devi', 'time' => '4 min read'],
    ['id' => 2, 'title' => 'How to Measure Yourself accurately at Home like a Master Tailor', 'category' => 'Measurement Guide', 'excerpt' => 'Follow our step-by-step anatomical guide with a tape measure to get flawless custom stitching results every single time.', 'image' => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=600&auto=format&fit=crop&q=80', 'author' => 'Master Ramesh', 'time' => '6 min read'],
    ['id' => 3, 'title' => '2026 Bridal Fashion Trends: Zardosi, Pastel Velvets & Cutout Backs', 'category' => 'Fashion Trends', 'excerpt' => 'Discover the hottest wedding season color palettes and embroidery trends dominating Indian couture this year.', 'image' => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=600&auto=format&fit=crop&q=80', 'author' => 'Editorial Team', 'time' => '5 min read']
];
?>

<section class="py-5 bg-light border-bottom">
  <div class="container text-center">
    <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Couture Insights</span>
    <h1 class="fw-bold display-5 mt-2">TailorEase Style Journal & Blog</h1>
    <p class="text-muted max-w-700 mx-auto fs-5">Expert fabric care tutorials, seasonal style guides, and master tailoring advice.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($blogs as $b): ?>
        <div class="col-lg-4 col-md-6">
          <div class="glass-card h-100 d-flex flex-column">
            <div class="card-img-wrap" style="height:220px;">
              <img src="<?= $b['image'] ?>" alt="<?= htmlspecialchars($b['title']) ?>">
              <span class="card-tag"><?= strtoupper($b['category']) ?></span>
            </div>
            <div class="p-4 d-flex flex-column flex-grow-1">
              <div class="d-flex justify-content-between text-muted small mb-2">
                <span><i class="bi bi-person me-1"></i> <?= $b['author'] ?></span>
                <span><i class="bi bi-clock me-1"></i> <?= $b['time'] ?></span>
              </div>
              <h5 class="fw-bold text-heading mb-2"><?= htmlspecialchars($b['title']) ?></h5>
              <p class="text-muted small flex-grow-1"><?= htmlspecialchars($b['excerpt']) ?></p>
              <button class="btn btn-outline-violet btn-sm mt-3 w-100" data-bs-toggle="modal" data-bs-target="#blogModal<?= $b['id'] ?>">
                Read Full Article <i class="bi bi-arrow-right me-1"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Article Reader Modal -->
        <div class="modal fade" id="blogModal<?= $b['id'] ?>" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content glass-panel p-4">
              <div class="modal-header border-0 pb-0">
                <div>
                  <span class="badge bg-primary mb-2"><?= $b['category'] ?></span>
                  <h4 class="fw-bold m-0"><?= htmlspecialchars($b['title']) ?></h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <img src="<?= $b['image'] ?>" class="img-fluid rounded-3 mb-4 shadow w-100" style="max-height:350px;object-fit:cover;">
                <p class="fs-5 text-dark fw-medium"><?= htmlspecialchars($b['excerpt']) ?></p>
                <p class="text-muted">
                  Garment longevity depends fundamentally on thread elasticity, fiber hydration, and proper storage. When handling pure silks or heavy velvets, always avoid direct iron contact on embroidered areas. Store your garments in breathable cotton garment bags instead of plastic covers.
                </p>
                <p class="text-muted m-0">
                  For bespoke fitting and maintenance questions, feel free to visit our master tailors at TailorEase Atelier or book a consultation session anytime.
                </p>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
