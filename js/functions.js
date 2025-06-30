// Toggle mobile menu
document.addEventListener("DOMContentLoaded", function () {
  document.querySelector(".menu-toggle").addEventListener("click", function () {
    document.querySelector(".nav-menu").classList.toggle("active");
  });
});

document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    document.querySelector(this.getAttribute("href")).scrollIntoView({
      behavior: "smooth",
    });
    document.querySelector(".nav-menu").classList.remove("active");
  });
});

// Funcion filtro
function applyFilters() {
  const destination = document.getElementById("destination").value;
  const minPrice = document.getElementById("min-price").value;
  const maxPrice = document.getElementById("max-price").value;
  const hotelStars = document.getElementById("hotel-stars").value;
  const mealType = document.getElementById("meal-type").value;
  const duration = document.getElementById("duration").value;

  const packages = document.querySelectorAll(".package-card-extended");
  let visibleCount = 0;

  packages.forEach((package) => {
    let show = true;

    if (destination && package.dataset.destination !== destination) {
      show = false;
    }

    const packagePrice = parseInt(package.dataset.price);
    if (minPrice && packagePrice < parseInt(minPrice)) {
      show = false;
    }
    if (maxPrice && packagePrice > parseInt(maxPrice)) {
      show = false;
    }

    if (hotelStars && package.dataset.stars !== hotelStars) {
      show = false;
    }

    if (mealType && package.dataset.meal !== mealType) {
      show = false;
    }

    if (duration) {
      const packageDuration = parseInt(package.dataset.duration);
      if (duration === "3" && (packageDuration < 3 || packageDuration > 5)) {
        show = false;
      } else if (
        duration === "7" &&
        (packageDuration < 6 || packageDuration > 8)
      ) {
        show = false;
      } else if (
        duration === "10" &&
        (packageDuration < 9 || packageDuration > 12)
      ) {
        show = false;
      } else if (duration === "15" && packageDuration <= 12) {
        show = false;
      }
    }

    if (show) {
      package.style.display = "block";
      visibleCount++;
    } else {
      package.style.display = "none";
    }
  });

  // Update de resultados
  document.getElementById("results-count").textContent = visibleCount;

  const noResults = document.getElementById("no-results");
  if (visibleCount === 0) {
    noResults.style.display = "block";
  } else {
    noResults.style.display = "none";
  }
}

function clearFilters() {
  document.getElementById("destination").value = "";
  document.getElementById("min-price").value = "";
  document.getElementById("max-price").value = "";
  document.getElementById("hotel-stars").value = "";
  document.getElementById("meal-type").value = "";
  document.getElementById("duration").value = "";

  const packages = document.querySelectorAll(".package-card-extended");
  packages.forEach((package) => {
    package.style.display = "block";
  });

  document.getElementById("results-count").textContent = packages.length;
  document.getElementById("no-results").style.display = "none";
}

function sortPackages() {
  const sortBy = document.getElementById("sort-by").value;
  const packagesGrid = document.getElementById("packages-grid");
  const packages = Array.from(
    packagesGrid.querySelectorAll(".package-card-extended")
  );

  packages.sort((a, b) => {
    switch (sortBy) {
      case "price-low":
        return parseInt(a.dataset.price) - parseInt(b.dataset.price);
      case "price-high":
        return parseInt(b.dataset.price) - parseInt(a.dataset.price);
      case "duration":
        return parseInt(a.dataset.duration) - parseInt(b.dataset.duration);
      case "rating":
        const ratingA = parseFloat(
          a.querySelector(".rating-number").textContent.match(/\d+\.\d+/)[0]
        );
        const ratingB = parseFloat(
          b.querySelector(".rating-number").textContent.match(/\d+\.\d+/)[0]
        );
        return ratingB - ratingA;
      default:
        return 0;
    }
  });

  packages.forEach((package) => {
    packagesGrid.appendChild(package);
  });
}

const animateStats = () => {
  const statNumbers = document.querySelectorAll(".stat-number");

  statNumbers.forEach((stat) => {
    const target = parseInt(stat.getAttribute("data-count"));
    const duration = 2000; // 2 seconds
    const increment = target / (duration / 16); // 60fps
    let current = 0;

    const updateNumber = () => {
      current += increment;
      if (current < target) {
        stat.textContent = Math.floor(current);
        requestAnimationFrame(updateNumber);
      } else {
        stat.textContent =
          target +
          (stat.parentElement
            .querySelector(".stat-label")
            .textContent.includes("%")
            ? "%"
            : "+");
      }
    };

    updateNumber();
  });
};

const statsSection = document.querySelector(".stats-section");
const statsObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        animateStats();
        statsObserver.unobserve(entry.target);
      }
    });
  },
  { threshold: 0.5 }
);

statsObserver.observe(statsSection);

const faqQuestions = document.querySelectorAll(".faq-question");

faqQuestions.forEach((question) => {
  question.addEventListener("click", () => {
    const faqItem = question.parentElement;
    const answer = faqItem.querySelector(".faq-answer");
    const isActive = question.classList.contains("active");

    faqQuestions.forEach((q) => {
      q.classList.remove("active");
      q.parentElement.querySelector(".faq-answer").classList.remove("active");
    });

    if (!isActive) {
      question.classList.add("active");
      answer.classList.add("active");
    }
  });
});

// Form submission
const contactForm = document.getElementById("contact-form");
const successMessage = document.getElementById("success-message");

contactForm.addEventListener("submit", (e) => {
  e.preventDefault();

  successMessage.classList.add("show");

  contactForm.reset();

  contactForm.scrollIntoView({ behavior: "smooth", block: "start" });

  setTimeout(() => {
    successMessage.classList.remove("show");
  }, 5000);
});

const travelDateInput = document.getElementById("travel-date");
const today = new Date().toISOString().split("T")[0];
travelDateInput.setAttribute("min", today);
