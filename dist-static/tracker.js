/**
 * TailorEase - Order Progress Tracker Renderer
 */

const STAGES = [
  { num: 1, title: 'Order Received', sub: 'Verified in system', icon: 'bi-file-earmark-check' },
  { num: 2, title: 'Measurement Confirmed', sub: 'Fit profile assigned', icon: 'bi-ruler' },
  { num: 3, title: 'Fabric Selected', sub: 'Material allocated', icon: 'bi-scissors' },
  { num: 4, title: 'Precision Cutting', sub: 'Pattern cut by master', icon: 'bi-vector-pen' },
  { num: 5, title: 'Master Stitching', sub: 'Craftsmanship in progress', icon: 'bi-suit-club' },
  { num: 6, title: 'Quality Check', sub: 'Fitting & seam inspection', icon: 'bi-patch-check' },
  { num: 7, title: 'Ready For Delivery', sub: 'Luxury gift packed', icon: 'bi-box-seam' },
  { num: 8, title: 'Delivered', sub: 'Handed to customer', icon: 'bi-house-check' }
];

function renderOrderTracker(containerId, currentStageNum = 5) {
  const container = document.getElementById(containerId);
  if (!container) return;

  let html = '<div class="order-stepper">';
  STAGES.forEach(stage => {
    let stateClass = '';
    if (stage.num < currentStageNum) {
      stateClass = 'completed';
    } else if (stage.num === currentStageNum) {
      stateClass = 'in_progress';
    }

    html += `
      <div class="step-item ${stateClass}">
        <div class="step-icon-box">
          <i class="bi ${stage.icon}"></i>
        </div>
        <div class="step-label">${stage.title}</div>
        <div class="step-subtext">${stage.sub}</div>
      </div>
    `;
  });
  html += '</div>';
  container.innerHTML = html;
}

document.addEventListener('DOMContentLoaded', () => {
  const trackerEl = document.getElementById('interactive-order-tracker');
  if (trackerEl) {
    const stage = parseInt(trackerEl.getAttribute('data-current-stage') || '5');
    renderOrderTracker('interactive-order-tracker', stage);
  }
});
