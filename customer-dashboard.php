<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/header.php';
$user = get_logged_in_user() ?? ['name' => 'Anita Sundaram', 'email' => 'anita@example.com', 'role' => 'customer'];
?>

<div class="container py-5">
  <div class="dashboard-container">
    <!-- Sidebar Navigation -->
    <div class="dashboard-sidebar">
      <div class="text-center mb-4 pb-3 border-bottom">
        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=120&auto=format&fit=crop&q=80" alt="Avatar" class="rounded-circle shadow mb-2" style="width:80px;height:80px;object-fit:cover;">
        <h5 class="fw-bold m-0 text-heading"><?= htmlspecialchars($user['name']) ?></h5>
        <small class="text-muted"><?= htmlspecialchars($user['email']) ?></small>
      </div>

      <ul class="dashboard-menu">
        <li class="dashboard-menu-item">
          <a href="#orders-tab" class="dashboard-menu-link active" data-bs-toggle="pill">
            <i class="bi bi-box-seam fs-5"></i> My Orders (2)
          </a>
        </li>
        <li class="dashboard-menu-item">
          <a href="#measurements-tab" class="dashboard-menu-link" data-bs-toggle="pill">
            <i class="bi bi-ruler fs-5"></i> Saved Measurements
          </a>
        </li>
        <li class="dashboard-menu-item">
          <a href="#appointments-tab" class="dashboard-menu-link" data-bs-toggle="pill">
            <i class="bi bi-calendar-check fs-5"></i> Appointments
          </a>
        </li>
        <li class="dashboard-menu-item">
          <a href="#wishlist-tab" class="dashboard-menu-link" data-bs-toggle="pill">
            <i class="bi bi-heart fs-5"></i> Saved Wishlist
          </a>
        </li>
        <li class="dashboard-menu-item">
          <a href="api/auth_action.php?action=logout" class="dashboard-menu-link text-danger">
            <i class="bi bi-box-arrow-right fs-5"></i> Sign Out
          </a>
        </li>
      </ul>
    </div>

    <!-- Main Content Area -->
    <div class="dashboard-main">
      <div class="tab-content">
        <!-- 1. Orders Tab -->
        <div class="tab-pane fade show active" id="orders-tab">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0 text-heading">Active & Recent Orders</h3>
            <a href="order.php" class="btn btn-violet btn-sm"><i class="bi bi-plus-lg me-1"></i> New Custom Order</a>
          </div>

          <!-- Order Card #1 -->
          <div class="glass-panel p-4 mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3 pb-3 border-bottom">
              <div>
                <strong class="fs-5 text-primary">#ORD-2026-8801</strong>
                <small class="text-muted d-block">Placed on July 20, 2026</small>
              </div>
              <div>
                <span class="badge badge-in_progress me-2">Stage 5: Master Stitching</span>
                <span class="badge badge-paid">Payment: Paid (₹3,850.00)</span>
              </div>
            </div>

            <div class="row align-items-center">
              <div class="col-md-8">
                <h5 class="fw-bold m-0 text-heading">Designer Bridal Blouse (Banarasi Raw Silk)</h5>
                <p class="text-muted small m-0">Custom Dori Cutout Back with Hand Zardosi Embroidery</p>
                <small class="text-success fw-bold d-block mt-2"><i class="bi bi-truck me-1"></i> Estimated Delivery: July 28, 2026</small>
              </div>
              <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="order-track.php?order=ORD-2026-8801" class="btn btn-outline-violet btn-sm me-2">Track Stage</a>
                <button class="btn btn-violet btn-sm" data-bs-toggle="modal" data-bs-target="#invoiceModal1">
                  <i class="bi bi-file-earmark-pdf me-1"></i> Invoice
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- 2. Measurements Tab -->
        <div class="tab-pane fade" id="measurements-tab">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0 text-heading">My Fit Profile</h3>
            <a href="measurement.php" class="btn btn-violet btn-sm"><i class="bi bi-pencil me-1"></i> Update Profile</a>
          </div>

          <div class="glass-panel p-4">
            <div class="row g-3">
              <div class="col-md-3 col-6"><span class="text-muted small d-block">Height</span><strong>165 cm</strong></div>
              <div class="col-md-3 col-6"><span class="text-muted small d-block">Weight</span><strong>58 kg</strong></div>
              <div class="col-md-3 col-6"><span class="text-muted small d-block">Chest / Bust</span><strong>36 in</strong></div>
              <div class="col-md-3 col-6"><span class="text-muted small d-block">Waist</span><strong>28 in</strong></div>
              <div class="col-md-3 col-6"><span class="text-muted small d-block">Hip</span><strong>38 in</strong></div>
              <div class="col-md-3 col-6"><span class="text-muted small d-block">Shoulder</span><strong>15 in</strong></div>
              <div class="col-md-3 col-6"><span class="text-muted small d-block">Sleeve Length</span><strong>22 in</strong></div>
              <div class="col-md-3 col-6"><span class="text-muted small d-block">Inseam</span><strong>30 in</strong></div>
            </div>
          </div>
        </div>

        <!-- 3. Appointments Tab -->
        <div class="tab-pane fade" id="appointments-tab">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0 text-heading">Booked Appointments</h3>
            <a href="appointment.php" class="btn btn-violet btn-sm"><i class="bi bi-calendar-plus me-1"></i> Book New</a>
          </div>

          <div class="glass-panel p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <strong class="d-block text-primary fs-5">In-Store Boutique Consultation</strong>
                <small class="text-muted"><i class="bi bi-calendar me-1"></i> Tomorrow, 11:30 AM | Master Ramesh</small>
              </div>
              <span class="badge badge-confirmed">Confirmed</span>
            </div>
          </div>
        </div>

        <!-- 4. Wishlist Tab -->
        <div class="tab-pane fade" id="wishlist-tab">
          <h3 class="fw-bold mb-4 text-heading">Wishlist Fabrics & Styles</h3>
          <div class="glass-panel p-4 text-center">
            <i class="bi bi-heart fs-1 text-primary mb-2 d-block"></i>
            <h5 class="fw-bold">Your wishlist is ready</h5>
            <p class="text-muted small">Explore our fabric collection to save items here.</p>
            <a href="fabrics.php" class="btn btn-violet btn-sm">Explore Fabrics</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Invoice Printable Modal -->
<div class="modal fade" id="invoiceModal1" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 bg-transparent">
      <div class="invoice-card">
        <div class="d-flex justify-content-between align-items-start mb-4 border-bottom pb-3">
          <div>
            <h3 class="fw-bold text-primary mb-1"><i class="bi bi-scissors"></i> TailorEase Atelier</h3>
            <small class="text-muted">100 Luxury Avenue, Suite 400, Chennai, TN</small>
          </div>
          <div class="text-end">
            <h4 class="fw-bold m-0">INVOICE</h4>
            <small class="text-muted">#ORD-2026-8801</small>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-6">
            <small class="text-muted d-block fw-bold">Billed To:</small>
            <strong>Anita Sundaram</strong><br>
            <small class="text-muted">42 Rose Garden Street, Coimbatore, TN</small>
          </div>
          <div class="col-6 text-end">
            <small class="text-muted d-block fw-bold">Date:</small>
            <span>July 20, 2026</span>
          </div>
        </div>

        <table class="table table-bordered align-middle mb-4">
          <thead class="table-light">
            <tr>
              <th>Description</th>
              <th class="text-end">Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Designer Bridal Blouse Stitching (Zardosi Work)</td>
              <td class="text-end">₹2,400.00</td>
            </tr>
            <tr>
              <td>Banarasi Raw Silk Fabric (1.5 Meters)</td>
              <td class="text-end">₹1,450.00</td>
            </tr>
            <tr>
              <th class="text-end">Total Amount Paid</th>
              <th class="text-end text-primary">₹3,850.00</th>
            </tr>
          </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center">
          <small class="text-muted">Thank you for choosing TailorEase Bespoke Couture!</small>
          <button class="btn btn-primary btn-sm" onclick="window.print()"><i class="bi bi-printer me-1"></i> Print Invoice</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
