document.addEventListener("DOMContentLoaded", () => {
  /* === 1. Mobile Sidebar Toggle === */
  const mobileToggle = document.querySelector(".mobile-nav-toggle");
  const sidebar = document.querySelector(".sidebar");
  const navLinks = document.querySelectorAll(".nav-menu a");

  if (mobileToggle) {
    mobileToggle.addEventListener("click", () => {
      sidebar.classList.toggle("mobile-active");
      let icon = mobileToggle.querySelector("i");
      if (sidebar.classList.contains("mobile-active")) {
        icon.classList.remove("fa-bars");
        icon.classList.add("fa-times");
      } else {
        icon.classList.remove("fa-times");
        icon.classList.add("fa-bars");
      }
    });
  }

  // إغلاق القائمة عند النقر على أي رابط في الموبايل
  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      if (window.innerWidth <= 992) {
        sidebar.classList.remove("mobile-active");
        mobileToggle
          .querySelector("i")
          .classList.replace("fa-times", "fa-bars");
      }
    });
  });

  /* === 2. Typing Effect for Home Section === */
  const typedTextSpan = document.querySelector(".typed-text");
  const textArray = [
    "backend systems.",
    "RESTful APIs.",
    "database architectures.",
  ];
  const typingDelay = 100;
  const erasingDelay = 50;
  const newTextDelay = 2000; // Delay between current and next text
  let textArrayIndex = 0;
  let charIndex = 0;

  function type() {
    if (charIndex < textArray[textArrayIndex].length) {
      typedTextSpan.textContent += textArray[textArrayIndex].charAt(charIndex);
      charIndex++;
      setTimeout(type, typingDelay);
    } else {
      setTimeout(erase, newTextDelay);
    }
  }

  function erase() {
    if (charIndex > 0) {
      typedTextSpan.textContent = textArray[textArrayIndex].substring(
        0,
        charIndex - 1,
      );
      charIndex--;
      setTimeout(erase, erasingDelay);
    } else {
      textArrayIndex++;
      if (textArrayIndex >= textArray.length) textArrayIndex = 0;
      setTimeout(type, typingDelay + 1100);
    }
  }

  if (textArray.length) setTimeout(type, newTextDelay + 250);

  /* === 3. Scroll Active Link Highlight (Fixed for Sidebar) === */
  const sections = document.querySelectorAll("section");

  function highlightNav() {
    let current = "";
    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.clientHeight;
      // Adjustment for sidebar offset, works better
      if (pageYOffset >= sectionTop - sectionHeight / 3) {
        current = section.getAttribute("id");
      }
    });

    navLinks.forEach((link) => {
      link.classList.remove("active");
      if (link.getAttribute("href").includes(current)) {
        link.classList.add("active");
      }
    });
  }

  window.addEventListener("scroll", highlightNav);
  highlightNav(); // Call once on load

  /* === 4. Intersection Observer for Scroll Animations === */
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show");
        observer.unobserve(entry.target); // إيقاف المراقبة بعد الظهور لمرة واحدة
      }
    });
  }, observerOptions);

  const hiddenElements = document.querySelectorAll(".hidden");
  hiddenElements.forEach((el) => observer.observe(el));
});
