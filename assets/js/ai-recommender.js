/**
 * TailorEase - AI Smart Style & Dress Recommender
 */

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('ai-recommender-form');
  if (!form) return;

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const gender = document.getElementById('ai-gender').value;
    const bodyShape = document.getElementById('ai-body-shape').value;
    const occasion = document.getElementById('ai-occasion').value;
    const height = document.getElementById('ai-height').value;

    const resultBox = document.getElementById('ai-result-box');
    resultBox.innerHTML = `
      <div class="text-center p-4">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2 text-muted fw-medium">AI is analyzing your body proportions & occasion parameters...</p>
      </div>
    `;

    setTimeout(() => {
      let recTitle = "";
      let recFabric = "";
      let recColor = "";
      let recTip = "";

      if (gender === 'men') {
        if (occasion === 'wedding') {
          recTitle = "Royal Velvet Bandhgala Sherwani with Zari Detailing";
          recFabric = "Banarasi Raw Silk or Royal Velvet";
          recColor = "Deep Royal Violet, Imperial Navy, or Antique Gold";
          recTip = "High Mandarin collar lengthens your torso. Opt for structured shoulder padding for an regal posture.";
        } else if (occasion === 'formal') {
          recTitle = "Slim-Fit Italian 3-Piece Peak Lapel Suit";
          recFabric = "Superfine Wool Blend or Egyptian Giza Linen";
          recColor = "Charcoal Slate, Dark Violet, or Navy Blue";
          recTip = "Single-button jacket cut enhances waist taper. French cuffs add effortless corporate luxury.";
        } else {
          recTitle = "Mandarin Collar Casual Linen Shirt & Chinos";
          recFabric = "100% Belgian Pure Linen";
          recColor = "Soft Lavender, Cream, or Ocean Blue";
          recTip = "Breathable relaxed fit with curved hemline.";
        }
      } else {
        if (occasion === 'wedding') {
          recTitle = "Grand Zardosi Embroidered Royal Lehenga Choli";
          recFabric = "Banarasi Raw Silk & High-Gloss Satin";
          recColor = "Rich Plum Violet, Crimson Red, or Pastel Lavender";
          recTip = "Deep U cutout back with tasselled dori adds elegance while maintaining structured waist fitting.";
        } else if (occasion === 'formal') {
          recTitle = "Structured Indo-Western Peplum Kurti & Trousers";
          recFabric = "Pure Mulberry Satin or Egyptian Cotton";
          recColor = "Dark Violet, Dusty Pink, or Emerald";
          recTip = "Asymmetrical flared waistline balances hip proportions beautifully.";
        } else {
          recTitle = "Flowy Designer Anarkali Suit with Pleated Pants";
          recFabric = "Breathable Soft Georgette or Rayon";
          recColor = "Lavender, Aqua Blue, or Ivory";
          recTip = "High waist seam creates an elongate silhouette.";
        }
      }

      resultBox.innerHTML = `
        <div class="glass-panel p-4 animate__animated animate__fadeIn">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="stat-icon" style="width:42px;height:42px;font-size:1.2rem;"><i class="bi bi-stars"></i></div>
            <h5 class="m-0 fw-bold text-primary">AI Style Recommendation</h5>
          </div>
          <h4 class="fw-bold mb-3">${recTitle}</h4>
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <span class="text-muted d-block small">Recommended Fabric</span>
              <strong class="text-dark">${recFabric}</strong>
            </div>
            <div class="col-md-6">
              <span class="text-muted d-block small">Optimal Color Palette</span>
              <strong class="text-dark">${recColor}</strong>
            </div>
          </div>
          <div class="p-3 bg-light rounded-3 border-start border-4 border-primary mb-3">
            <small class="text-muted d-block fw-bold mb-1">TailorEase Styling Tip:</small>
            <p class="m-0 small text-dark">${recTip}</p>
          </div>
          <a href="order.php?recommended=${encodeURIComponent(recTitle)}" class="btn btn-violet btn-sm w-100">
            <i class="bi bi-magic me-2"></i>Customize & Order This Style Now
          </a>
        </div>
      `;
    }, 1000);
  });
});
