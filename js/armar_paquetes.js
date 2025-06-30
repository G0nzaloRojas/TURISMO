class InfinitePackageSlider {
  constructor() {
    this.currentSlide = 0;
    this.totalSlides = document.querySelectorAll(".slide").length;
    this.sliderWrapper = document.getElementById("sliderWrapper");
    this.sliderContainer = document.querySelector(".slider-container");
    this.prevBtn = document.getElementById("prevBtn");
    this.nextBtn = document.getElementById("nextBtn");
    this.indicators = document.querySelectorAll(".indicator");
    this.currentPackageDisplay = document.getElementById("current-package");

    this.init();
  }

  init() {
    this.updateSlide();
    this.bindEvents();
    this.adjustContainerHeight();
  }

  bindEvents() {
    this.prevBtn.addEventListener("click", () => this.prevSlide());
    this.nextBtn.addEventListener("click", () => this.nextSlide());

    this.indicators.forEach((indicator, index) => {
      indicator.addEventListener("click", () => this.goToSlide(index));
    });

    document.addEventListener("keydown", (e) => {
      if (e.key === "ArrowLeft") this.prevSlide();
      if (e.key === "ArrowRight") this.nextSlide();
    });

    let startX = 0;
    let endX = 0;

    this.sliderWrapper.addEventListener("touchstart", (e) => {
      startX = e.touches[0].clientX;
    });

    this.sliderWrapper.addEventListener("touchend", (e) => {
      endX = e.changedTouches[0].clientX;
      this.handleSwipe();
    });

    if (window.ResizeObserver) {
      const resizeObserver = new ResizeObserver(() => {
        this.adjustContainerHeight();
      });

      document.querySelectorAll(".slide").forEach((slide) => {
        resizeObserver.observe(slide);
      });
    }
  }

  handleSwipe() {
    const threshold = 50;
    const diff = startX - endX;

    if (Math.abs(diff) > threshold) {
      if (diff > 0) {
        this.nextSlide();
      } else {
        this.prevSlide();
      }
    }
  }

  updateSlide() {
    const translateX = -this.currentSlide * (100 / this.totalSlides);
    this.sliderWrapper.style.transform = `translateX(${translateX}%)`;

    this.indicators.forEach((indicator, index) => {
      indicator.classList.toggle("active", index === this.currentSlide);
    });

    this.currentPackageDisplay.textContent = this.currentSlide + 1;

    setTimeout(() => {
      this.adjustContainerHeight();
    }, 50);
  }

  adjustContainerHeight() {
    const currentSlideElement =
      document.querySelectorAll(".slide")[this.currentSlide];
    if (currentSlideElement) {
      const slideHeight = currentSlideElement.offsetHeight;

      this.sliderContainer.style.transition = "height 0.3s ease";
      this.sliderContainer.style.height = slideHeight + "px";

      setTimeout(() => {
        this.sliderContainer.style.transition = "";
      }, 300);
    }
  }

  nextSlide() {
    this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
    this.updateSlide();
  }

  prevSlide() {
    this.currentSlide =
      (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
    this.updateSlide();
  }

  goToSlide(index) {
    this.currentSlide = index;
    this.updateSlide();
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const slider = new InfinitePackageSlider();

  setTimeout(() => {
    slider.adjustContainerHeight();
  }, 100);
});
