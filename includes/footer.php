<?php
/**
 * TailorEase - Dynamic Footer Component
 */
?>
  <!-- Footer Section -->
  <footer class="footer-custom">
    <div class="container">
      <div class="row g-4">
        <!-- Col 1: Brand Info -->
        <div class="col-lg-4 col-md-6">
          <div class="footer-brand">
            <i class="bi bi-scissors"></i> TailorEase
          </div>
          <p class="text-muted mb-4">
            "Perfect Stitching, Perfect Style."<br>
            Bespoke tailoring, luxury fabrics, online measurement guides, and real-time order tracking for men, women & kids.
          </p>
          <div class="d-flex gap-3">
            <a href="#" class="btn btn-outline-violet btn-sm rounded-circle" style="width:36px;height:36px;"><i class="bi bi-facebook"></i></a>
            <a href="#" class="btn btn-outline-violet btn-sm rounded-circle" style="width:36px;height:36px;"><i class="bi bi-instagram"></i></a>
            <a href="#" class="btn btn-outline-violet btn-sm rounded-circle" style="width:36px;height:36px;"><i class="bi bi-whatsapp"></i></a>
            <a href="#" class="btn btn-outline-violet btn-sm rounded-circle" style="width:36px;height:36px;"><i class="bi bi-youtube"></i></a>
          </div>
        </div>

        <!-- Col 2: Quick Links -->
        <div class="col-lg-2 col-md-6">
          <h5 class="fw-bold mb-3 text-white">Quick Navigation</h5>
          <a href="index.php" class="footer-link">Home</a>
          <a href="about.php" class="footer-link">About Us</a>
          <a href="services.php" class="footer-link">Our Services</a>
          <a href="gallery.php" class="footer-link">Gallery</a>
          <a href="fabrics.php" class="footer-link">Fabrics</a>
          <a href="designs.php" class="footer-link">Design Catalog</a>
        </div>

        <!-- Col 3: Customer Care -->
        <div class="col-lg-3 col-md-6">
          <h5 class="fw-bold mb-3 text-white">Customer Services</h5>
          <a href="measurement.php" class="footer-link">Online Measurement</a>
          <a href="appointment.php" class="footer-link">Book Fitting Session</a>
          <a href="order-track.php" class="footer-link">Track Your Order</a>
          <a href="pricing.php" class="footer-link">Pricing & Plans</a>
          <a href="contact.php" class="footer-link">Help & FAQs</a>
          <a href="privacy.php" class="footer-link">Privacy Policy</a>
        </div>

        <!-- Col 4: Newsletter -->
        <div class="col-lg-3 col-md-6">
          <h5 class="fw-bold mb-3 text-white">Newsletter</h5>
          <p class="text-muted small">Subscribe for seasonal fashion trends, fabric care tips, and exclusive discount codes.</p>
          <form onsubmit="event.preventDefault(); showToast('Thank you for subscribing to TailorEase!', 'success');" class="mt-2">
            <div class="input-group mb-2">
              <input type="email" class="form-control form-control-sm rounded-start-pill" placeholder="Enter your email" required>
              <button class="btn btn-violet btn-sm rounded-end-pill px-3" type="submit"><i class="bi bi-send-fill"></i></button>
            </div>
          </form>
          <div class="mt-3">
            <small class="text-muted"><i class="bi bi-shield-check text-success me-1"></i> ISO 9001:2026 Certified Fitting Quality</small>
          </div>
        </div>
      </div>

      <hr class="my-4 border-secondary opacity-25">

      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 small text-muted">
        <div>&copy; <?= date('Y') ?> <strong>TailorEase</strong> – Smart Tailor Shop Website. All rights reserved.</div>
        <div>Designed with <i class="bi bi-heart-fill text-danger ms-1 me-1"></i> for Premium Bespoke Couture</div>
      </div>
    </div>
  </footer>

  <!-- WhatsApp Floating Direct Chat Button -->
  <a href="https://wa.me/919876543210?text=Hi%20TailorEase,%20I%20would%20like%20to%20inquire%20about%20custom%20stitching" 
     target="_blank" 
     class="position-fixed bottom-0 end-0 m-4 btn btn-success rounded-circle shadow-lg d-flex align-items-center justify-content-center"
     style="width:55px;height:55px;z-index:999;"
     title="Chat with Master Tailor on WhatsApp">
    <i class="bi bi-whatsapp fs-3"></i>
  </a>

  <!-- Back to Top Button -->
  <button onclick="window.scrollTo({top:0, behavior:'smooth'})" 
          class="position-fixed bottom-0 start-0 m-4 btn btn-violet rounded-circle shadow p-0 d-flex align-items-center justify-content-center"
          style="width:45px;height:45px;z-index:999;"
          title="Back to Top">
    <i class="bi bi-arrow-up fs-5"></i>
  </button>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS Application Files -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/visualizer.js"></script>
  <script src="assets/js/tracker.js"></script>
  <script src="assets/js/ai-recommender.js"></script>
  <script src="assets/js/dashboard.js"></script>
</body>
</html>
