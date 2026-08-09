<?php
require_once __DIR__ . '/includes/header.php';
?>

<section class="py-5 bg-light border-bottom">
  <div class="container text-center">
    <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Get In Touch</span>
    <h1 class="fw-bold display-5 mt-2">Contact TailorEase Atelier</h1>
    <p class="text-muted max-w-700 mx-auto fs-5">Have questions regarding custom stitching, bulk uniform orders, or fitting appointments? We are here to assist.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-5">
      <!-- Contact Details & Hours -->
      <div class="col-lg-5">
        <div class="glass-panel p-4 p-md-5 h-100">
          <h3 class="fw-bold mb-4 text-heading"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Visit Atelier</h3>
          
          <div class="mb-4">
            <strong class="d-block text-heading mb-1"><i class="bi bi-building me-2 text-primary"></i>Flagship Store Address</strong>
            <p class="text-muted m-0">100 Luxury Fashion Avenue, Suite 400<br>Cathedral Road, Chennai, TN - 600086</p>
          </div>

          <div class="mb-4">
            <strong class="d-block text-heading mb-1"><i class="bi bi-telephone-fill me-2 text-primary"></i>Phone & WhatsApp Support</strong>
            <p class="text-muted m-0">+91 98765 43210 / +91 98765 43211</p>
          </div>

          <div class="mb-4">
            <strong class="d-block text-heading mb-1"><i class="bi bi-envelope-fill me-2 text-primary"></i>Email Contact</strong>
            <p class="text-muted m-0">support@tailorease.com / bespoke@tailorease.com</p>
          </div>

          <div class="mb-4">
            <strong class="d-block text-heading mb-1"><i class="bi bi-clock-fill me-2 text-primary"></i>Boutique Hours</strong>
            <p class="text-muted m-0">Monday – Saturday: 10:00 AM – 08:30 PM<br>Sunday: 11:00 AM – 05:00 PM</p>
          </div>

          <a href="https://wa.me/919876543210" target="_blank" class="btn btn-success w-100 rounded-pill mt-2">
            <i class="bi bi-whatsapp me-2"></i>Chat Live on WhatsApp
          </a>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="col-lg-7">
        <div class="glass-panel p-4 p-md-5">
          <h3 class="fw-bold mb-4 text-heading"><i class="bi bi-envelope-paper-fill text-primary me-2"></i>Send Message</h3>

          <form onsubmit="event.preventDefault(); showToast('Thank you for your message! Our tailoring team will contact you shortly.', 'success'); this.reset();">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-bold small">Full Name</label>
                <input type="text" class="form-control rounded-pill" required placeholder="John Doe">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold small">Email Address</label>
                <input type="email" class="form-control rounded-pill" required placeholder="john@example.com">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold small">Phone Number</label>
                <input type="tel" class="form-control rounded-pill" required placeholder="+91 98765 00000">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold small">Subject</label>
                <select class="form-select rounded-pill">
                  <option value="stitching">Custom Stitching Inquiry</option>
                  <option value="fitting">Home Measurement Booking</option>
                  <option value="wedding">Wedding Bridal Package</option>
                  <option value="bulk">Bulk Uniform Order</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label fw-bold small">Message / Inquiry Details</label>
                <textarea class="form-control rounded-3" rows="4" required placeholder="Describe your outfit requirements, preferred dates, or questions..."></textarea>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-violet btn-lg w-100 rounded-pill">
                  <i class="bi bi-send-fill me-2"></i>Submit Inquiry
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Collapsible FAQs -->
    <div class="mt-5 glass-panel p-4 p-md-5">
      <h3 class="fw-bold mb-4 text-heading text-center"><i class="bi bi-question-circle-fill text-primary me-2"></i>Frequently Asked Questions</h3>

      <div class="accordion accordion-flush" id="faqAccordion">
        <div class="accordion-item bg-transparent">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
              How does doorstep measurement work?
            </button>
          </h2>
          <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body text-muted">
              Once you request a home visit on our appointment page, a Master Tailor brings fabric swatches and measurement tape to your address, records all 12 body metrics, and provides instant fabric advice.
            </div>
          </div>
        </div>

        <div class="accordion-item bg-transparent">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
              What if the garment needs re-alteration?
            </button>
          </h2>
          <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body text-muted">
              We offer a 100% Fit Guarantee. If the stitching does not align perfectly with your measurement profile, we re-alter it free of charge within 30 days of delivery.
            </div>
          </div>
        </div>

        <div class="accordion-item bg-transparent">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
              How fast can Express Stitching deliver?
            </button>
          </h2>
          <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body text-muted">
              With our Express 48-Hour Stitching option (+₹500), your garment is assigned priority cutting and stitching, completing ready for delivery within 2 business days.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
