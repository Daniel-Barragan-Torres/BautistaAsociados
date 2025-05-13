document.addEventListener("DOMContentLoaded", () => {
    const reveals = document.querySelectorAll(".reveal");

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("active");
          observer.unobserve(entry.target); // solo una vez
        }
      });
    }, { threshold: 0.5, rootMargin: "0px 0px -100px 0px" });

    reveals.forEach(section => {
      observer.observe(section);
    });
  });