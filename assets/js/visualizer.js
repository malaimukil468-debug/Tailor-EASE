/**
 * TailorEase - Interactive Outfit Visual Customizer
 */

class OutfitVisualizer {
  constructor() {
    this.basePrice = 850; // default base price for shirt/outfit
    this.fabricCost = 650;
    this.selectedOptions = {
      collar: { name: 'Standard Point Collar', cost: 0 },
      sleeve: { name: 'Full Long Sleeve', cost: 0 },
      pocket: { name: 'Single Left Pocket', cost: 0 },
      button: { name: 'Pearl White Buttons', cost: 0 },
      embroidery: { name: 'None', cost: 0 },
      color: '#6A0DAD'
    };
    this.init();
  }

  init() {
    this.bindEvents();
    this.updatePrice();
  }

  bindEvents() {
    // Option Card Selection
    document.querySelectorAll('.option-card').forEach(card => {
      card.addEventListener('click', (e) => {
        const group = card.getAttribute('data-group');
        const name = card.getAttribute('data-name');
        const cost = parseFloat(card.getAttribute('data-cost') || 0);

        // Highlight active option in group
        document.querySelectorAll(`.option-card[data-group="${group}"]`).forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');

        // Update state
        if (group && this.selectedOptions[group] !== undefined) {
          this.selectedOptions[group] = { name, cost };
        }

        this.updatePreview();
        this.updatePrice();
      });
    });

    // Color Swatch Selection
    document.querySelectorAll('.color-swatch-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.color-swatch-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const color = btn.getAttribute('data-color');
        this.selectedOptions.color = color;
        this.updatePreview();
      });
    });
  }

  updatePreview() {
    const garmentSvg = document.getElementById('outfit-preview-path');
    if (garmentSvg) {
      garmentSvg.setAttribute('fill', this.selectedOptions.color);
    }
  }

  updatePrice() {
    let total = this.basePrice + this.fabricCost;
    Object.keys(this.selectedOptions).forEach(key => {
      if (this.selectedOptions[key].cost) {
        total += this.selectedOptions[key].cost;
      }
    });

    const displayEl = document.getElementById('calculated-total-price');
    if (displayEl) {
      displayEl.innerText = `₹${total.toFixed(2)}`;
    }

    const summaryText = document.getElementById('custom-summary-text');
    if (summaryText) {
      summaryText.innerText = `${this.selectedOptions.collar.name}, ${this.selectedOptions.sleeve.name}, ${this.selectedOptions.pocket.name}`;
    }
  }
}

document.addEventListener('DOMContentLoaded', () => {
  if (document.getElementById('outfit-visualizer-app')) {
    window.visualizer = new OutfitVisualizer();
  }
});
