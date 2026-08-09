/**
 * TailorEase - Core Application JavaScript
 * Handles Dark Mode, English/Tamil i18n, Toast Notifications, Sticky Nav, Counter Animations
 */

document.addEventListener('DOMContentLoaded', () => {
  initDarkMode();
  initi18n();
  initCounters();
  initSmoothScroll();
});

/* 1. Dark Mode Toggle */
function initDarkMode() {
  const toggleBtn = document.getElementById('dark-mode-toggle');
  const currentTheme = localStorage.getItem('tailorease_theme') || 'light';
  
  if (currentTheme === 'dark') {
    document.documentElement.setAttribute('data-theme', 'dark');
    if (toggleBtn) toggleBtn.innerHTML = '<i class="bi bi-sun-fill text-warning"></i>';
  }

  if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
      let theme = document.documentElement.getAttribute('data-theme');
      if (theme === 'dark') {
        document.documentElement.removeAttribute('data-theme');
        localStorage.setItem('tailorease_theme', 'light');
        toggleBtn.innerHTML = '<i class="bi bi-moon-stars-fill"></i>';
        showToast('Switched to Light Mode', 'info');
      } else {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('tailorease_theme', 'dark');
        toggleBtn.innerHTML = '<i class="bi bi-sun-fill text-warning"></i>';
        showToast('Switched to Dark Mode', 'info');
      }
    });
  }
}

/* 2. English / Tamil i18n Translation Switcher */
const dictionary = {
  en: {
    hero_title: "Custom Tailoring Crafted Just For You",
    hero_sub: "Design your dream outfit with premium fabrics, expert craftsmanship, and personalized fitting.",
    book_appt: "Book Appointment",
    explore_designs: "Explore Designs",
    nav_home: "Home",
    nav_about: "About Us",
    nav_services: "Services",
    nav_gallery: "Gallery",
    nav_fabrics: "Fabrics",
    nav_designs: "Designs",
    nav_measurement: "Measurement",
    nav_appointment: "Appointment",
    nav_pricing: "Pricing",
    nav_blog: "Blog",
    nav_contact: "Contact",
    happy_customers: "Happy Customers",
    years_experience: "Years Experience",
    dresses_delivered: "Dresses Delivered",
    satisfaction: "Satisfaction Rate"
  },
  ta: {
    hero_title: "உங்களுக்காகவே உருவாக்கப்பட்ட தையல் கலை",
    hero_sub: "சிறந்த துணிகள், கைதேர்ந்த தையல் கலைஞர்கள் மற்றும் துல்லியமான அளவுகளுடன் உங்கள் கனவு உடையை வடிவமைக்கவும்.",
    book_appt: "நேரத்தை முன்பதிவு செய்க",
    explore_designs: "வடிவமைப்புகளைக் காண்க",
    nav_home: "முகப்பு",
    nav_about: "எங்களைப் பற்றி",
    nav_services: "சேவைகள்",
    nav_gallery: "கேலரி",
    nav_fabrics: "துணி வகைகள்",
    nav_designs: "வடிவமைப்புகள்",
    nav_measurement: "ஆன்லைன் அளவுகள்",
    nav_appointment: "முன்பதிவு",
    nav_pricing: "விலைப்பட்டியல்",
    nav_blog: "பதிவுகள்",
    nav_contact: "தொடர்புகொள்ள",
    happy_customers: "மகிழ்ச்சியான வாடிக்கையாளர்கள்",
    years_experience: "ஆண்டுகள் அனுபவம்",
    dresses_delivered: "வழங்கப்பட்ட ஆடைகள்",
    satisfaction: "வாடிக்கையாளர் திருப்தி"
  }
};

function initi18n() {
  const langSelect = document.getElementById('language-selector');
  const currentLang = localStorage.getItem('tailorease_lang') || 'en';
  
  if (langSelect) {
    langSelect.value = currentLang;
    applyLanguage(currentLang);
    
    langSelect.addEventListener('change', (e) => {
      const selected = e.target.value;
      localStorage.setItem('tailorease_lang', selected);
      applyLanguage(selected);
      showToast(selected === 'ta' ? 'தமிழ் மொழி தேர்ந்தெடுக்கப்பட்டது' : 'Language set to English', 'success');
    });
  }
}

function applyLanguage(lang) {
  const texts = dictionary[lang] || dictionary.en;
  document.querySelectorAll('[data-i18n]').forEach(el => {
    const key = el.getAttribute('data-i18n');
    if (texts[key]) {
      el.textContent = texts[key];
    }
  });
}

/* 3. Toast Notification Generator */
function showToast(message, type = 'success') {
  let container = document.getElementById('toast-container');
  if (!container) {
    container = document.createElement('div');
    container.id = 'toast-container';
    container.style.cssText = 'position:fixed;bottom:25px;right:25px;z-index:9999;display:flex;flex-direction:column;gap:10px;';
    document.body.appendChild(container);
  }

  const toast = document.createElement('div');
  const bgClass = type === 'success' ? 'bg-success' : type === 'error' ? 'bg-danger' : 'bg-primary';
  toast.className = `toast align-items-center text-white ${bgClass} border-0 show`;
  toast.setAttribute('role', 'alert');
  toast.innerHTML = `
    <div class="d-flex p-3 align-items-center">
      <div class="toast-body font-weight-medium">${message}</div>
      <button type="button" class="btn-close btn-close-white ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
    </div>
  `;
  container.appendChild(toast);
  setTimeout(() => { if (toast) toast.remove(); }, 4000);
}

/* 4. Animated Counters */
function initCounters() {
  const counters = document.querySelectorAll('.counter-number');
  if (!counters.length) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;
        const target = parseInt(el.getAttribute('data-target'));
        let count = 0;
        const speed = target / 60;
        const update = () => {
          count += speed;
          if (count < target) {
            el.innerText = Math.ceil(count) + (el.innerText.includes('%') ? '%' : '+');
            setTimeout(update, 25);
          } else {
            el.innerText = target + (el.innerText.includes('%') ? '%' : '+');
          }
        };
        update();
        observer.unobserve(el);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(counter => observer.observe(counter));
}

/* 5. Smooth Scroll */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
}
