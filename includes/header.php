<?php
/**
 * TailorEase - Dynamic Sticky Header
 */
require_once __DIR__ . '/functions.php';
$currentUser = get_logged_in_user();
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TailorEase – Smart Tailor Shop Website | Perfect Stitching, Perfect Style.</title>
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons & FontAwesome -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <!-- Chart.js (for Dashboards) -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Custom Stylesheets -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/dashboard.css">
  <link rel="stylesheet" href="assets/css/visualizer.css">
</head>
<body>

  <!-- Sticky Luxury Navbar -->
  <nav class="navbar navbar-expand-xl navbar-custom">
    <div class="container-fluid px-lg-5">
      <!-- Brand Logo -->
      <a class="navbar-brand" href="index.php">
        <i class="bi bi-scissors text-primary"></i>
        <span>TailorEase</span>
      </a>

      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#tailorEaseNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="tailorEaseNav">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link <?= ($currentPage=='index.php')?'active':'' ?>" href="index.php" data-i18n="nav_home">Home</a></li>
          <li class="nav-item"><a class="nav-link <?= ($currentPage=='about.php')?'active':'' ?>" href="about.php" data-i18n="nav_about">About</a></li>
          <li class="nav-item"><a class="nav-link <?= ($currentPage=='services.php')?'active':'' ?>" href="services.php" data-i18n="nav_services">Services</a></li>
          <li class="nav-item"><a class="nav-link <?= ($currentPage=='gallery.php')?'active':'' ?>" href="gallery.php" data-i18n="nav_gallery">Gallery</a></li>
          <li class="nav-item"><a class="nav-link <?= ($currentPage=='fabrics.php')?'active':'' ?>" href="fabrics.php" data-i18n="nav_fabrics">Fabrics</a></li>
          <li class="nav-item"><a class="nav-link <?= ($currentPage=='designs.php')?'active':'' ?>" href="designs.php" data-i18n="nav_designs">Designs</a></li>
          <li class="nav-item"><a class="nav-link <?= ($currentPage=='measurement.php')?'active':'' ?>" href="measurement.php" data-i18n="nav_measurement">Measurement</a></li>
          <li class="nav-item"><a class="nav-link <?= ($currentPage=='appointment.php')?'active':'' ?>" href="appointment.php" data-i18n="nav_appointment">Appointment</a></li>
          <li class="nav-item"><a class="nav-link <?= ($currentPage=='pricing.php')?'active':'' ?>" href="pricing.php" data-i18n="nav_pricing">Pricing</a></li>
          <li class="nav-item"><a class="nav-link <?= ($currentPage=='blog.php')?'active':'' ?>" href="blog.php" data-i18n="nav_blog">Blog</a></li>
          <li class="nav-item"><a class="nav-link <?= ($currentPage=='contact.php')?'active':'' ?>" href="contact.php" data-i18n="nav_contact">Contact</a></li>
        </ul>

        <!-- Right Controls (Search, Theme, i18n, Auth) -->
        <div class="d-flex align-items-center gap-2">
          <!-- Search Icon Modal Trigger -->
          <button class="btn btn-outline-violet rounded-circle p-2" data-bs-toggle="modal" data-bs-target="#searchModal" style="width:40px;height:40px;">
            <i class="bi bi-search"></i>
          </button>

          <!-- Language Selector -->
          <select id="language-selector" class="form-select form-select-sm rounded-pill" style="width:105px; border-color:var(--border-color);">
            <option value="en">🌐 English</option>
            <option value="ta">🌐 தமிழ்</option>
          </select>

          <!-- Dark Mode Toggle Button -->
          <button id="dark-mode-toggle" class="btn btn-outline-violet rounded-circle p-2" style="width:40px;height:40px;">
            <i class="bi bi-moon-stars-fill"></i>
          </button>

          <!-- User Auth / Dashboard Button -->
          <?php if ($currentUser): ?>
            <div class="dropdown">
              <button class="btn btn-violet dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle"></i> <?= htmlspecialchars($currentUser['name']) ?>
              </button>
              <ul class="dropdown-menu dropdown-menu-end shadow">
                <?php if ($currentUser['role'] === 'admin'): ?>
                  <li><a class="dropdown-menu-item dropdown-item fw-bold text-primary" href="admin-dashboard.php"><i class="bi bi-speedometer2 me-2"></i>Admin Dashboard</a></li>
                <?php else: ?>
                  <li><a class="dropdown-menu-item dropdown-item fw-bold" href="customer-dashboard.php"><i class="bi bi-grid-fill me-2"></i>My Dashboard</a></li>
                  <li><a class="dropdown-menu-item dropdown-item" href="order-track.php"><i class="bi bi-truck me-2"></i>Track Order</a></li>
                <?php endif; ?>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="api/auth_action.php?action=logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
              </ul>
            </div>
          <?php else: ?>
            <a href="login.php" class="btn btn-outline-violet">Login</a>
            <a href="register.php" class="btn btn-violet d-none d-sm-inline-flex">Register</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <!-- Global Search Overlay Modal -->
  <div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content glass-panel p-3">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title fw-bold"><i class="bi bi-search text-primary me-2"></i>Search TailorEase</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form action="services.php" method="GET" class="d-flex gap-2">
            <input type="text" name="q" class="form-control form-control-lg rounded-pill" placeholder="Search fabrics, suit styles, blouses, alterations...">
            <button type="submit" class="btn btn-violet rounded-pill px-4">Search</button>
          </form>
        </div>
      </div>
    </div>
  </div>
