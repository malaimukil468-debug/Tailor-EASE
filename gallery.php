<?php
require_once __DIR__ . '/includes/header.php';

$galleryItems = [
    ['id' => 1, 'category' => 'men', 'title' => 'Italian Navy 3-Piece Tuxedo', 'image' => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=600&auto=format&fit=crop&q=80', 'desc' => 'Peak lapel bespoke tuxedo with satin trim.'],
    ['id' => 2, 'category' => 'wedding', 'title' => 'Royal Velvet Zardosi Lehenga', 'image' => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?w=600&auto=format&fit=crop&q=80', 'desc' => 'Grand velvet lehenga with hand zardosi weave.'],
    ['id' => 3, 'category' => 'women', 'title' => 'Contemporary Cutout Blouse', 'image' => 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=600&auto=format&fit=crop&q=80', 'desc' => 'Deep U back cut with tassels.'],
    ['id' => 4, 'category' => 'traditional', 'title' => 'Silk Bandhgala Sherwani', 'image' => 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?w=600&auto=format&fit=crop&q=80', 'desc' => 'Banarasi silk sherwani with golden buttons.'],
    ['id' => 5, 'category' => 'kids', 'title' => 'Pastel Silk Party Frock', 'image' => 'https://images.unsplash.com/photo-1518831959646-742c3a14ebf7?w=600&auto=format&fit=crop&q=80', 'desc' => 'Handcrafted frock with soft inner cotton lining.'],
    ['id' => 6, 'category' => 'western', 'title' => 'Double-Breasted Houndstooth Blazer', 'image' => 'https://images.unsplash.com/photo-1479064555552-3ef4979f8908?w=600&auto=format&fit=crop&q=80', 'desc' => 'Pure wool tailored double breasted blazer.']
];

$activeCat = $_GET['cat'] ?? 'all';
?>

<section class="py-5 bg-light border-bottom">
  <div class="container text-center">
    <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Couture Showcase</span>
    <h1 class="fw-bold display-5 mt-2">TailorEase Portfolio & Gallery</h1>
    <p class="text-muted max-w-700 mx-auto fs-5">Inspect our finest finished garments, intricate hand embroideries, and bespoke fit creations.</p>

    <!-- Filters -->
    <div class="d-flex flex-wrap justify-content-center gap-2 mt-4">
      <a href="gallery.php?cat=all" class="filter-btn <?= ($activeCat=='all')?'active':'' ?>">All Creations</a>
      <a href="gallery.php?cat=men" class="filter-btn <?= ($activeCat=='men')?'active':'' ?>">Men's Collection</a>
      <a href="gallery.php?cat=women" class="filter-btn <?= ($activeCat=='women')?'active':'' ?>">Women's Collection</a>
      <a href="gallery.php?cat=wedding" class="filter-btn <?= ($activeCat=='wedding')?'active':'' ?>">Wedding Couture</a>
      <a href="gallery.php?cat=traditional" class="filter-btn <?= ($activeCat=='traditional')?'active':'' ?>">Traditional Wear</a>
      <a href="gallery.php?cat=western" class="filter-btn <?= ($activeCat=='western')?'active':'' ?>">Western Wear</a>
      <a href="gallery.php?cat=kids" class="filter-btn <?= ($activeCat=='kids')?'active':'' ?>">Kids Wear</a>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <?php 
      $items = ($activeCat === 'all') ? $galleryItems : array_values(array_filter($galleryItems, function($g) use ($activeCat){
          return $g['category'] === $activeCat;
      }));

      foreach ($items as $item):
      ?>
        <div class="col-lg-4 col-md-6">
          <div class="glass-card overflow-hidden">
            <div class="card-img-wrap" style="height:320px;">
              <img src="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['title']) ?>">
              <span class="card-tag"><?= strtoupper($item['category']) ?></span>
            </div>
            <div class="p-4">
              <h5 class="fw-bold text-heading mb-1"><?= htmlspecialchars($item['title']) ?></h5>
              <p class="text-muted small m-0"><?= htmlspecialchars($item['desc']) ?></p>
              <button class="btn btn-outline-violet btn-sm mt-3 w-100" data-bs-toggle="modal" data-bs-target="#lightboxModal<?= $item['id'] ?>">
                <i class="bi bi-zoom-in me-1"></i> Preview Lightbox
              </button>
            </div>
          </div>
        </div>

        <!-- Lightbox Modal -->
        <div class="modal fade" id="lightboxModal<?= $item['id'] ?>" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content glass-panel p-2">
              <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold"><?= htmlspecialchars($item['title']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body text-center">
                <img src="<?= $item['image'] ?>" class="img-fluid rounded-3 mb-3 shadow" style="max-height:500px;object-fit:cover;">
                <p class="text-muted"><?= htmlspecialchars($item['desc']) ?></p>
                <a href="order.php?style=<?= urlencode($item['title']) ?>" class="btn btn-violet rounded-pill">
                  <i class="bi bi-scissors me-2"></i>Order Garment In This Style
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
