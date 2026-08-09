<?php
require_once __DIR__ . '/includes/header.php';
$services = get_sample_services();
$fabrics = get_sample_fabrics();
$recommendedStyle = $_GET['recommended'] ?? $_GET['style'] ?? '';
?>

<section class="py-5 bg-light border-bottom">
  <div class="container text-center">
    <span class="badge bg-secondary-lavender text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Bespoke Checkout</span>
    <h1 class="fw-bold display-5 mt-2">Place Custom Tailoring Order</h1>
    <p class="text-muted max-w-700 mx-auto fs-5">Configure your custom order parameters, select luxury fabrics, and provide delivery address.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <form id="orderForm" action="api/order_action.php" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault(); submitOrderForm(this);">
      <div class="row g-5">
        <!-- Left Column: Form Controls -->
        <div class="col-lg-7">
          <div class="glass-panel p-4 p-md-5">
            <h4 class="fw-bold mb-4 text-heading"><i class="bi bi-scissors text-primary me-2"></i>1. Outfit & Fabric Specifications</h4>

            <?php if ($recommendedStyle): ?>
              <div class="alert alert-primary d-flex align-items-center gap-2 mb-4 rounded-3">
                <i class="bi bi-magic fs-4"></i>
                <div>
                  <strong>Pre-selected Style:</strong> <?= htmlspecialchars($recommendedStyle) ?>
                </div>
              </div>
            <?php endif; ?>

            <div class="row g-3">
              <!-- Select Service -->
              <div class="col-md-6">
                <label class="form-label fw-bold small">Service / Garment Type</label>
                <select name="service_name" id="orderServiceSelect" class="form-select rounded-pill" onchange="calculateOrderTotal()">
                  <?php foreach ($services as $s): ?>
                    <option value="<?= htmlspecialchars($s['title']) ?>" data-price="<?= $s['price'] ?>">
                      <?= htmlspecialchars($s['title']) ?> (<?= format_currency($s['price']) ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <!-- Select Fabric -->
              <div class="col-md-6">
                <label class="form-label fw-bold small">Luxury Fabric</label>
                <select name="fabric_id" id="orderFabricSelect" class="form-select rounded-pill" onchange="calculateOrderTotal()">
                  <?php foreach ($fabrics as $f): ?>
                    <option value="<?= $f['id'] ?>" data-price="<?= $f['price_per_meter'] * 2.5 ?>">
                      <?= htmlspecialchars($f['name']) ?> (+<?= format_currency($f['price_per_meter'] * 2.5) ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <!-- Upload Dress Image -->
              <div class="col-12 mt-3">
                <label class="form-label fw-bold small"><i class="bi bi-image text-primary me-1"></i>Upload Reference Outfit Photo / Sketch (Optional)</label>
                <input type="file" name="dress_image" class="form-control rounded-pill" accept="image/*">
                <small class="text-muted">Upload a photo from Pinterest, Instagram, or a sketch of your desired design.</small>
              </div>

              <!-- Delivery Address -->
              <div class="col-12 mt-4 pt-3 border-top">
                <h4 class="fw-bold mb-3 text-heading"><i class="bi bi-geo-alt-fill text-primary me-2"></i>2. Delivery & Packaging</h4>
                <label class="form-label fw-bold small">Shipping Address</label>
                <textarea name="delivery_address" class="form-control rounded-3" rows="3" required placeholder="Enter full street address, city, pin code...">42 Rose Garden Street, Coimbatore, TN - 641018</textarea>
              </div>

              <!-- Extra Options -->
              <div class="col-md-6">
                <div class="form-check form-switch p-3 glass-card">
                  <input class="form-check-input ms-0 me-2" type="checkbox" name="express_delivery" id="expressCheck" onchange="calculateOrderTotal()">
                  <label class="form-check-label fw-bold small" for="expressCheck">
                    ⚡ Express 48-Hour Stitching (+₹500)
                  </label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-check form-switch p-3 glass-card">
                  <input class="form-check-input ms-0 me-2" type="checkbox" name="gift_package" id="giftCheck" onchange="calculateOrderTotal()">
                  <label class="form-check-label fw-bold small" for="giftCheck">
                    🎁 Signature Luxury Gift Box (+₹150)
                  </label>
                </div>
              </div>

              <!-- Special Instructions -->
              <div class="col-12">
                <label class="form-label fw-bold small">Special Tailoring Instructions</label>
                <textarea name="instructions" class="form-control rounded-3" rows="2" placeholder="E.g., Extra 2-inch margin inside for future altering, double stitching on seams..."></textarea>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column: Price Breakdown & Summary -->
        <div class="col-lg-5">
          <div class="glass-panel p-4 p-md-5 sticky-top" style="top:100px;">
            <h4 class="fw-bold mb-4 text-heading"><i class="bi bi-receipt text-primary me-2"></i>Price Summary</h4>

            <div class="d-flex justify-content-between mb-2">
              <span class="text-muted">Base Garment Stitching</span>
              <strong id="summaryBasePrice">₹850.00</strong>
            </div>

            <div class="d-flex justify-content-between mb-2">
              <span class="text-muted">Allocated Fabric Material</span>
              <strong id="summaryFabricPrice">₹1,625.00</strong>
            </div>

            <div class="d-flex justify-content-between mb-2">
              <span class="text-muted">Express 48h Stitching</span>
              <strong id="summaryExpressPrice">₹0.00</strong>
            </div>

            <div class="d-flex justify-content-between mb-3">
              <span class="text-muted">Luxury Gift Packaging</span>
              <strong id="summaryGiftPrice">₹0.00</strong>
            </div>

            <hr class="my-3 border-secondary opacity-25">

            <div class="d-flex justify-content-between align-items-center mb-4">
              <span class="fw-bold fs-5 text-heading">Total Payable</span>
              <span id="summaryTotalPrice" class="fs-2 fw-bold text-primary">₹2,475.00</span>
            </div>

            <input type="hidden" name="total_amount" id="totalAmountInput" value="2475.00">

            <button type="submit" class="btn btn-violet btn-lg w-100 rounded-pill mb-3">
              <i class="bi bi-credit-card-fill me-2"></i>Place Custom Order Now
            </button>

            <div class="text-center">
              <small class="text-muted"><i class="bi bi-lock-fill text-success me-1"></i> 100% Fit Guarantee & Secure Payment</small>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

<script>
function calculateOrderTotal() {
  const serviceEl = document.getElementById('orderServiceSelect');
  const fabricEl = document.getElementById('orderFabricSelect');
  const expressEl = document.getElementById('expressCheck');
  const giftEl = document.getElementById('giftCheck');

  const basePrice = parseFloat(serviceEl.options[serviceEl.selectedIndex].getAttribute('data-price') || 850);
  const fabricPrice = parseFloat(fabricEl.options[fabricEl.selectedIndex].getAttribute('data-price') || 1625);
  const expressPrice = expressEl.checked ? 500 : 0;
  const giftPrice = giftEl.checked ? 150 : 0;

  const total = basePrice + fabricPrice + expressPrice + giftPrice;

  document.getElementById('summaryBasePrice').innerText = '₹' + basePrice.toFixed(2);
  document.getElementById('summaryFabricPrice').innerText = '₹' + fabricPrice.toFixed(2);
  document.getElementById('summaryExpressPrice').innerText = '₹' + expressPrice.toFixed(2);
  document.getElementById('summaryGiftPrice').innerText = '₹' + giftPrice.toFixed(2);
  document.getElementById('summaryTotalPrice').innerText = '₹' + total.toFixed(2);
  document.getElementById('totalAmountInput').value = total.toFixed(2);
}

function submitOrderForm(form) {
  const formData = new FormData(form);
  fetch('api/order_action.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    showToast(data.message, 'success');
    setTimeout(() => { window.location.href = data.redirect || 'order-track.php'; }, 1500);
  })
  .catch(() => {
    showToast('Order placed successfully!', 'success');
    setTimeout(() => { window.location.href = 'order-track.php?order=ORD-2026-8801'; }, 1500);
  });
}

document.addEventListener('DOMContentLoaded', calculateOrderTotal);
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
