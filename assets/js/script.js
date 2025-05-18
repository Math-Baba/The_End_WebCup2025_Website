// Animation au chargement, plus lente
gsap.from(".nlink", {
  stagger: 0.3,
  y: 15,
  duration: 2,
  ease: "power2.out",
  opacity: 0,
});

Shery.textAnimate("#heading h1", {
  style: 2,
  y: 15,
  delay: 0.5,
  duration: 4,
  ease: "cubic-bezier(0.23, 1, 0.320, 1)",
  multiplier: 0.1,
});

gsap.from(".anim2", {
  y: 60,
  opacity: 0,
  ease: "expo.out",
  stagger: 0.4,
  duration: 2,
});

// Animation lors du scroll avec ScrollTrigger
gsap.utils.toArray(" p").forEach(elem => {
  gsap.from(elem, {
    scrollTrigger: {
      trigger: elem,
      start: "top 85%", // quand le haut de l'élément arrive à 85% de la fenêtre
      toggleActions: "play none none none",
    },
    y: 30,
    opacity: 0,
    duration: 1,
    ease: "power2.out",
  });
});

document.getElementById('visit').addEventListener('click', () => {
  document.getElementById('ftext').scrollIntoView({ behavior: 'smooth' });
});

