<?php
require_once __DIR__ . '/includes/header.php';
$services = get_sample_services();
$fabrics = get_sample_fabrics();
?>

<!-- Hero Banner Section -->
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="hero-badge animate__animated animate__fadeInDown">
          <i class="bi bi-award-fill"></i> Luxury Bespoke Tailoring Platform
        </div>
        <h1 class="hero-title" data-i18n="hero_title">
          Custom Tailoring Crafted <span>Just For You</span>
        </h1>
        <p class="hero-subtitle" data-i18n="hero_sub">
          Design your dream outfit with premium fabrics, expert craftsmanship, and personalized fitting. Experiencing luxury couture made effortlessly accessible online.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <a href="appointment.php" class="btn btn-violet btn-lg" data-i18n="book_appt">
            <i class="bi bi-calendar-event me-2"></i>Book Appointment
          </a>
          <a href="designs.php" class="btn btn-outline-violet btn-lg" data-i18n="explore_designs">
            <i class="bi bi-palette me-2"></i>Explore Customizer
          </a>
        </div>

        <!-- Quick AI Widget Trigger -->
        <div class="mt-4 p-3 glass-panel d-flex align-items-center justify-content-between">
          <div class="d-flex align-items-center gap-3">
            <div class="stat-icon" style="width:40px;height:40px;font-size:1.1rem;"><i class="bi bi-magic"></i></div>
            <div>
              <strong class="d-block text-heading">Not sure what style suits you?</strong>
              <small class="text-muted">Try our AI Smart Outfit Recommender tool!</small>
            </div>
          </div>
          <a href="#ai-recommender-section" class="btn btn-violet btn-sm rounded-pill">Try AI Recommender</a>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="hero-image-wrap">
          <img src="https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=800&auto=format&fit=crop&q=80" 
               alt="Luxury Tailor Workshop" 
               class="hero-image-main">
          
          <!-- Floating Stat Badge -->
          <div class="floating-stat-card">
            <div class="floating-stat-icon">
              <i class="bi bi-patch-check-fill"></i>
            </div>
            <div>
              <div class="fw-bold fs-5 text-heading">100% Fit Guarantee</div>
              <small class="text-muted">Free re-alterations within 30 days</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Animated Statistics Section -->
<section class="py-5 bg-white border-bottom border-top">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-3 col-6">
        <div class="counter-box">
          <div class="counter-number" data-target="5000">0+</div>
          <p class="text-muted m-0 fw-medium" data-i18n="happy_customers">Happy Customers</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="counter-box">
          <div class="counter-number" data-target="20">0+</div>
          <p class="text-muted m-0 fw-medium" data-i18n="years_experience">Years Experience</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="counter-box">
          <div class="counter-number" data-target="10000">0+</div>
          <p class="text-muted m-0 fw-medium" data-i18n="dresses_delivered">Dresses Delivered</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="counter-box">
          <div class="counter-number" data-target="98">0%</div>
          <p class="text-muted m-0 fw-medium" data-i18n="satisfaction">Satisfaction Rate</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Featured Services Showcase -->
<section class="py-5">
  <div class="container">
    <div class="text-center max-w-700 mx-auto mb-5">
      <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Bespoke Offerings</span>
      <h2 class="fw-bold mt-2 display-6">Our Tailoring Services</h2>
      <p class="text-muted">From formal executive suits to royal bridal wear and quick alterations, we stitch perfection for every occasion.</p>
    </div>

    <div class="row g-4">
      <?php foreach (array_slice($services, 0, 6) as $s): ?>
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
                <small class="text-muted"><i class="bi bi-clock me-1 text-primary"></i> <?= $s['est_days'] ?></small>
                <a href="order.php?service_id=<?= $s['id'] ?>" class="btn btn-violet btn-sm">Book Now</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    
    <div class="text-center mt-5">
      <a href="services.php" class="btn btn-outline-violet btn-lg">View All Services <i class="bi bi-arrow-right ms-2"></i></a>
    </div>
  </div>
</section>

<!-- AI Smart Style & Dress Recommender Tool -->
<section id="ai-recommender-section" class="py-5 bg-light position-relative">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <span class="badge bg-primary text-white px-3 py-2 rounded-pill fw-bold text-uppercase mb-2"><i class="bi bi-stars me-1"></i> AI Powered</span>
        <h2 class="fw-bold display-6 mb-3">AI Dress & Style Recommender</h2>
        <p class="text-muted mb-4">
          Unsure which garment style, collar cut, or fabric texture complements your body height and skin tone best? Let our intelligent styling algorithm guide your next outfit creation.
        </p>

        <form id="ai-recommender-form" class="glass-panel p-4">
          <div class="row g-3">
            <div class="col-6">
              <label class="form-label small fw-bold">Gender</label>
              <select id="ai-gender" class="form-select rounded-pill">
                <option value="men">Men</option>
                <option value="women">Women</option>
              </select>
            </div>
            <div class="col-6">
              <label class="form-label small fw-bold">Occasion</label>
              <select id="ai-occasion" class="form-select rounded-pill">
                <option value="wedding">Wedding / Grand Reception</option>
                <option value="formal">Corporate & Executive</option>
                <option value="casual">Casual & Festive Wear</option>
              </select>
            </div>
            <div class="col-6">
              <label class="form-label small fw-bold">Body Shape</label>
              <select id="ai-body-shape" class="form-select rounded-pill">
                <option value="athletic">Athletic / V-Taper</option>
                <option value="lean">Slim / Rectangular</option>
                <option value="rounded">Round / Pear</option>
                <option value="hourglass">Hourglass</option>
              </select>
            </div>
            <div class="col-6">
              <label class="form-label small fw-bold">Height (cm)</label>
              <input type="number" id="ai-height" class="form-control rounded-pill" value="175">
            </div>
            <div class="col-12 mt-3">
              <button type="submit" class="btn btn-violet w-100 rounded-pill">
                <i class="bi bi-magic me-2"></i>Generate AI Recommendation
              </button>
            </div>
          </div>
        </form>
      </div>

      <div class="col-lg-7">
        <div id="ai-result-box">
          <div class="glass-panel p-5 text-center">
            <div class="stat-icon mx-auto mb-3" style="width:60px;height:60px;font-size:1.8rem;">
              <i class="bi bi-cpu-fill"></i>
            </div>
            <h4 class="fw-bold mb-2">Ready to Discover Your Ideal Style?</h4>
            <p class="text-muted m-0">Fill out your parameters on the left to receive custom recommendations for fabric, garment silhouette, and styling tips.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Carousel Section -->
<section class="py-5">
  <div class="container">
    <div class="text-center max-w-700 mx-auto mb-5">
      <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Client Reviews</span>
      <h2 class="fw-bold mt-2 display-6">Loved By Fashion Enthusiasts</h2>
      <p class="text-muted">Read how our bespoke craftsmanship transformed wardrobes across the country.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="glass-card p-4 h-100 d-flex flex-column">
          <div class="text-warning mb-3">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p class="text-muted flex-grow-1 italic">"TailorEase crafted my bridal lehenga to absolute perfection! The fitting was 100% precise and the visual customizer helped me pick the exact back cutout design."</p>
          <div class="d-flex align-items-center gap-3 pt-3 border-top">
            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=100&auto=format&fit=crop&q=80" alt="Dr. Kavitha" class="rounded-circle" style="width:45px;height:45px;object-fit:cover;">
            <div>
              <strong class="d-block text-heading">Dr. Kavitha Raman</strong>
              <small class="text-muted">Verified Bride</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="glass-card p-4 h-100 d-flex flex-column">
          <div class="text-warning mb-3">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p class="text-muted flex-grow-1 italic">"The 3-piece Italian suit fits better than any off-the-rack designer brand. The online measurement form was super clear and order tracking kept me updated."</p>
          <div class="d-flex align-items-center gap-3 pt-3 border-top">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80" alt="Vikram" class="rounded-circle" style="width:45px;height:45px;object-fit:cover;">
            <div>
              <strong class="d-block text-heading">Vikram Chandran</strong>
              <small class="text-muted">Corporate Executive</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="glass-card p-4 h-100 d-flex flex-column">
          <div class="text-warning mb-3">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p class="text-muted flex-grow-1 italic">"Fast delivery, luxury gift packaging, and incredible hand embroidery! TailorEase is the gold standard for bespoke tailoring."</p>
          <div class="d-flex align-items-center gap-3 pt-3 border-top">
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Priya" class="rounded-circle" style="width:45px;height:45px;object-fit:cover;">
            <div>
              <strong class="d-block text-heading">Priya Senthil</strong>
              <small class="text-muted">Fashion Blogger</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
