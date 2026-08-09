<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/header.php';
$adminUser = get_logged_in_user() ?? ['name' => 'Admin Master', 'role' => 'admin'];
?>

<div class="container-fluid px-lg-5 py-5">
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div>
      <span class="badge bg-primary px-3 py-1 rounded-pill mb-1">EXECUTIVE PANEL</span>
      <h2 class="fw-bold m-0 text-heading">TailorEase Master Admin Dashboard</h2>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-violet btn-sm" data-bs-toggle="modal" data-bs-target="#addFabricModal">
        <i class="bi bi-plus-circle me-1"></i> Add New Fabric
      </button>
      <button class="btn btn-violet btn-sm" onclick="showToast('Sales Report PDF Generated', 'success')">
        <i class="bi bi-download me-1"></i> Download Financial Report
      </button>
    </div>
  </div>

  <!-- Summary Metric Cards -->
  <div class="row g-4 mb-5">
    <div class="col-xl-3 col-md-6">
      <div class="stat-card">
        <div>
          <span class="text-muted small d-block">Total Revenue</span>
          <h3 class="fw-bold m-0 text-heading">₹4,85,000</h3>
          <small class="text-success fw-bold"><i class="bi bi-graph-up-arrow me-1"></i> +24% this month</small>
        </div>
        <div class="stat-icon"><i class="bi bi-currency-rupee"></i></div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="stat-card">
        <div>
          <span class="text-muted small d-block">Active Orders</span>
          <h3 class="fw-bold m-0 text-heading">142</h3>
          <small class="text-primary fw-bold">18 pending stitching</small>
        </div>
        <div class="stat-icon" style="background:linear-gradient(135deg, #9B51E0, #6A0DAD);"><i class="bi bi-box-seam"></i></div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="stat-card">
        <div>
          <span class="text-muted small d-block">Total Clients</span>
          <h3 class="fw-bold m-0 text-heading">86</h3>
          <small class="text-success fw-bold">98% satisfaction</small>
        </div>
        <div class="stat-icon" style="background:linear-gradient(135deg, #27AE60, #2ECC71);"><i class="bi bi-people-fill"></i></div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="stat-card">
        <div>
          <span class="text-muted small d-block">Master Tailors</span>
          <h3 class="fw-bold m-0 text-heading">3 Artisans</h3>
          <small class="text-muted">100% capacity</small>
        </div>
        <div class="stat-icon" style="background:linear-gradient(135deg, #D4AF37, #F39C12);"><i class="bi bi-award-fill"></i></div>
      </div>
    </div>
  </div>

  <!-- Chart.js Visualization Row -->
  <div class="row g-4 mb-5">
    <div class="col-lg-8">
      <div class="glass-panel p-4">
        <h5 class="fw-bold mb-3 text-heading"><i class="bi bi-bar-chart-line-fill text-primary me-2"></i>Monthly Revenue Trends (2026)</h5>
        <canvas id="adminRevenueChart" height="120"></canvas>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="glass-panel p-4">
        <h5 class="fw-bold mb-3 text-heading"><i class="bi bi-pie-chart-fill text-primary me-2"></i>Order Breakdown By Service</h5>
        <canvas id="adminCategoryChart" height="240"></canvas>
      </div>
    </div>
  </div>

  <!-- Orders Management Table -->
  <div class="glass-panel p-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="fw-bold m-0 text-heading"><i class="bi bi-list-task text-primary me-2"></i>Garment Orders Management</h4>
      <span class="badge bg-secondary-lavender text-primary fw-bold px-3 py-2 rounded-pill">Showing 3 Recent Orders</span>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Order #</th>
            <th>Customer</th>
            <th>Garment / Service</th>
            <th>Total Amount</th>
            <th>Current Stage</th>
            <th>Update Stage</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong class="text-primary">#ORD-2026-8801</strong></td>
            <td>
              <strong>Anita Sundaram</strong><br>
              <small class="text-muted">+91 98765 11111</small>
            </td>
            <td>Designer Bridal Blouse</td>
            <td class="fw-bold">₹3,850.00</td>
            <td><span class="badge badge-in_progress">Stage 5: Stitching</span></td>
            <td>
              <select class="form-select form-select-sm rounded-pill" onchange="updateOrderStatus(1, this.value)">
                <option value="1">Stage 1: Order Received</option>
                <option value="2">Stage 2: Measurement Confirmed</option>
                <option value="3">Stage 3: Fabric Selected</option>
                <option value="4">Stage 4: Precision Cutting</option>
                <option value="5" selected>Stage 5: Master Stitching</option>
                <option value="6">Stage 6: Quality Check</option>
                <option value="7">Stage 7: Ready For Delivery</option>
                <option value="8">Stage 8: Delivered</option>
              </select>
            </td>
            <td>
              <a href="order-track.php?order=ORD-2026-8801" class="btn btn-outline-violet btn-sm p-1 px-2" title="View Stepper"><i class="bi bi-eye"></i></a>
            </td>
          </tr>

          <tr>
            <td><strong class="text-primary">#ORD-2026-8802</strong></td>
            <td>
              <strong>Rajesh Kumar</strong><br>
              <small class="text-muted">+91 98765 22222</small>
            </td>
            <td>3-Piece Italian Suit</td>
            <td class="fw-bold">₹7,800.00</td>
            <td><span class="badge badge-in_progress">Stage 3: Fabric Selected</span></td>
            <td>
              <select class="form-select form-select-sm rounded-pill" onchange="updateOrderStatus(2, this.value)">
                <option value="1">Stage 1: Order Received</option>
                <option value="2">Stage 2: Measurement Confirmed</option>
                <option value="3" selected>Stage 3: Fabric Selected</option>
                <option value="4">Stage 4: Precision Cutting</option>
                <option value="5">Stage 5: Master Stitching</option>
                <option value="6">Stage 6: Quality Check</option>
                <option value="7">Stage 7: Ready For Delivery</option>
                <option value="8">Stage 8: Delivered</option>
              </select>
            </td>
            <td>
              <a href="order-track.php?order=ORD-2026-8802" class="btn btn-outline-violet btn-sm p-1 px-2" title="View Stepper"><i class="bi bi-eye"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal: Add New Fabric -->
<div class="modal fade" id="addFabricModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content glass-panel p-3">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle text-primary me-2"></i>Add Fabric To Catalog</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="api/admin_action.php" method="POST" onsubmit="event.preventDefault(); showToast('New fabric added to inventory!', 'success'); bootstrap.Modal.getInstance(document.getElementById('addFabricModal')).hide();">
          <input type="hidden" name="action" value="add_fabric">
          <div class="mb-3">
            <label class="form-label small fw-bold">Fabric Name</label>
            <input type="text" name="name" class="form-control rounded-pill" required placeholder="e.g. Kashmir Cashmere Wool">
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Fabric Category / Type</label>
            <input type="text" name="type" class="form-control rounded-pill" required placeholder="e.g. Wool Blend">
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Price Per Meter (₹)</label>
            <input type="number" name="price_per_meter" class="form-control rounded-pill" required placeholder="1850">
          </div>
          <button type="submit" class="btn btn-violet w-100 rounded-pill">Add Fabric</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
