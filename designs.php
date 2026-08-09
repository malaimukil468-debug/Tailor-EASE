<?php
require_once __DIR__ . '/includes/header.php';
?>

<section class="py-5 bg-light border-bottom">
  <div class="container text-center">
    <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Interactive Outfit Visualizer</span>
    <h1 class="fw-bold display-5 mt-2">Custom Design Catalog & Studio</h1>
    <p class="text-muted max-w-700 mx-auto fs-5">Configure collar styles, sleeve cuffs, pockets, back cutouts, buttons, and embroidery in real-time.</p>
  </div>
</section>

<section class="py-5">
  <div class="container" id="outfit-visualizer-app">
    <div class="visualizer-container">
      <!-- Left Column: Visual Preview Canvas -->
      <div class="visualizer-preview-box">
        <span class="badge bg-violet text-white px-3 py-2 rounded-pill mb-3">Live Interactive Preview</span>
        
        <!-- Garment Vector Canvas -->
        <svg class="outfit-svg-canvas" viewBox="0 0 300 400" xmlns="http://www.w3.org/2000/svg">
          <!-- Torso Base -->
          <path id="outfit-preview-path" d="M80,90 L220,90 L240,360 L60,360 Z" fill="#6A0DAD" transition="all 0.5s ease"/>
          <!-- Shoulders -->
          <path d="M80,90 L120,40 L180,40 L220,90 Z" fill="#550991"/>
          <!-- Collar Cutout Overlay -->
          <polygon points="120,40 180,40 150,110" fill="#FFFFFF" opacity="0.9"/>
          <!-- Buttons overlay -->
          <circle cx="150" cy="140" r="4" fill="#D4AF37"/>
          <circle cx="150" cy="180" r="4" fill="#D4AF37"/>
          <circle cx="150" cy="220" r="4" fill="#D4AF37"/>
          <!-- Pocket outline -->
          <rect x="180" y="150" width="30" height="35" rx="3" fill="none" stroke="#FFFFFF" stroke-width="2"/>
        </svg>

        <!-- Color Swatch Selector -->
        <div class="mt-4 text-center">
          <small class="text-muted d-block fw-bold mb-2">Select Primary Garment Tone:</small>
          <div class="d-flex justify-content-center gap-2">
            <button class="color-swatch-btn btn rounded-circle p-0 active" data-color="#6A0DAD" style="width:28px;height:28px;background:#6A0DAD;border:2px solid #FFF;" title="Royal Violet"></button>
            <button class="color-swatch-btn btn rounded-circle p-0" data-color="#1E1E2F" style="width:28px;height:28px;background:#1E1E2F;border:2px solid #FFF;" title="Midnight Slate"></button>
            <button class="color-swatch-btn btn rounded-circle p-0" data-color="#800020" style="width:28px;height:28px;background:#800020;border:2px solid #FFF;" title="Burgundy"></button>
            <button class="color-swatch-btn btn rounded-circle p-0" data-color="#1B4D3E" style="width:28px;height:28px;background:#1B4D3E;border:2px solid #FFF;" title="Emerald Green"></button>
            <button class="color-swatch-btn btn rounded-circle p-0" data-color="#D4AF37" style="width:28px;height:28px;background:#D4AF37;border:2px solid #FFF;" title="Champagne Gold"></button>
          </div>
        </div>
      </div>

      <!-- Right Column: Option Selectors -->
      <div>
        <h4 class="fw-bold text-heading mb-4"><i class="bi bi-sliders text-primary me-2"></i>Customize Specifications</h4>

        <!-- Option Group 1: Collar Style -->
        <div class="custom-option-group">
          <div class="custom-option-title"><i class="bi bi-tag-fill"></i> 1. Collar & Neck Style</div>
          <div class="option-cards-grid">
            <div class="option-card selected" data-group="collar" data-name="French Cutaway" data-cost="150">
              <div class="option-icon"><i class="bi bi-bounding-box-circles"></i></div>
              <div class="option-name">French Cutaway</div>
              <div class="option-price">+₹150</div>
            </div>
            <div class="option-card" data-group="collar" data-name="Mandarin Collar" data-cost="100">
              <div class="option-icon"><i class="bi bi-dash-lg"></i></div>
              <div class="option-name">Mandarin / Band</div>
              <div class="option-price">+₹100</div>
            </div>
            <div class="option-card" data-group="collar" data-name="Peak Lapel" data-cost="250">
              <div class="option-icon"><i class="bi bi-caret-up-fill"></i></div>
              <div class="option-name">Peak Lapel</div>
              <div class="option-price">+₹250</div>
            </div>
          </div>
        </div>

        <!-- Option Group 2: Sleeves & Cuffs -->
        <div class="custom-option-group">
          <div class="custom-option-title"><i class="bi bi-tag-fill"></i> 2. Sleeves & Cuff Style</div>
          <div class="option-cards-grid">
            <div class="option-card selected" data-group="sleeve" data-name="French Double Cuff" data-cost="200">
              <div class="option-icon"><i class="bi bi-app"></i></div>
              <div class="option-name">French Cuff</div>
              <div class="option-price">+₹200</div>
            </div>
            <div class="option-card" data-group="sleeve" data-name="Single Barrel Cuff" data-cost="0">
              <div class="option-icon"><i class="bi bi-square"></i></div>
              <div class="option-name">Single Barrel</div>
              <div class="option-price">Included</div>
            </div>
            <div class="option-card" data-group="sleeve" data-name="Short Sleeve" data-cost="0">
              <div class="option-icon"><i class="bi bi-scissors"></i></div>
              <div class="option-name">Short Sleeve</div>
              <div class="option-price">Included</div>
            </div>
          </div>
        </div>

        <!-- Option Group 3: Embroidery & Details -->
        <div class="custom-option-group">
          <div class="custom-option-title"><i class="bi bi-tag-fill"></i> 3. Hand Embroidery & Back Cutout</div>
          <div class="option-cards-grid">
            <div class="option-card" data-group="embroidery" data-name="Heavy Zardosi Work" data-cost="1500">
              <div class="option-icon"><i class="bi bi-flower1"></i></div>
              <div class="option-name">Zardosi Work</div>
              <div class="option-price">+₹1,500</div>
            </div>
            <div class="option-card" data-group="embroidery" data-name="Dori Tassels Back" data-cost="300">
              <div class="option-icon"><i class="bi bi-suit-heart-fill"></i></div>
              <div class="option-name">Dori & Cutout</div>
              <div class="option-price">+₹300</div>
            </div>
            <div class="option-card selected" data-group="embroidery" data-name="Clean Minimal Seams" data-cost="0">
              <div class="option-icon"><i class="bi bi-check-circle"></i></div>
              <div class="option-name">Clean Seams</div>
              <div class="option-price">Included</div>
            </div>
          </div>
        </div>

        <!-- Calculated Live Total Bar -->
        <div class="live-price-bar">
          <div>
            <span class="d-block small text-white-50">Estimated Stitching Total</span>
            <span id="custom-summary-text" class="small fw-bold">French Cutaway, French Cuff</span>
          </div>
          <div class="d-flex align-items-center gap-3">
            <span id="calculated-total-price" class="fs-3 fw-bold">₹1,850.00</span>
            <a href="order.php?customized=1" class="btn btn-light text-primary fw-bold rounded-pill">Proceed to Order</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
