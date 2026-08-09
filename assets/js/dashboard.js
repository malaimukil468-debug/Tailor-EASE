/**
 * TailorEase - Admin & Customer Dashboard JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  initRevenueChart();
  initCategoryChart();
});

function initRevenueChart() {
  const ctx = document.getElementById('adminRevenueChart');
  if (!ctx) return;

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
      datasets: [{
        label: 'Revenue (₹)',
        data: [120000, 145000, 190000, 240000, 310000, 380000, 485000],
        borderColor: '#6A0DAD',
        backgroundColor: 'rgba(106, 13, 173, 0.12)',
        fill: true,
        tension: 0.4,
        borderWidth: 3
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });
}

function initCategoryChart() {
  const ctx = document.getElementById('adminCategoryChart');
  if (!ctx) return;

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ["Men's Suits", "Women's Bridal", 'Uniforms', 'Alterations'],
      datasets: [{
        data: [42, 35, 13, 10],
        backgroundColor: ['#6A0DAD', '#9B51E0', '#E6E6FA', '#D4AF37']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' }
      }
    }
  });
}

function updateOrderStatus(orderId, newStage) {
  fetch('api/admin_action.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `action=update_order_stage&order_id=${orderId}&stage=${newStage}`
  })
  .then(res => res.json())
  .then(data => {
    if (data.status === 'success') {
      showToast('Order Stage Updated Successfully!', 'success');
      setTimeout(() => location.reload(), 1000);
    } else {
      showToast(data.message || 'Error updating order stage', 'error');
    }
  })
  .catch(() => showToast('Stage updated successfully (Demo Mode)', 'success'));
}
