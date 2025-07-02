document.addEventListener("DOMContentLoaded", () => {
  // Hamburger Menu Toggle
  document.querySelector(".hamburger").addEventListener("click", () => {
    document.querySelector(".nav-menu").classList.toggle("active");
  });

  // Back to Top Button
  const backToTop = document.getElementById("back-to-top");
  window.addEventListener("scroll", () => {
    if (
      document.body.scrollTop > 100 ||
      document.documentElement.scrollTop > 100
    ) {
      backToTop.style.display = "block";
    } else {
      backToTop.style.display = "none";
    }
  });
  backToTop.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  // Animations with IntersectionObserver
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          // For skills, add animate class to skill bars after a delay
          if (entry.target.classList.contains("skill")) {
            setTimeout(() => {
              entry.target.querySelector(".skill-bar").classList.add("animate");
            }, 400);
          }
        }
      });
    },
    {
      threshold: 0.1, // Reduced threshold to ensure visibility
    }
  );

  // Observe sections and elements
  document
    .querySelectorAll(
      ".home-info, .home-img, .projects h2, .card, .skill, .skill h2, .container h1, .contact-box, .form-d"
    )
    .forEach((element) => {
      observer.observe(element);
    });
});
