let currentStep = 1;
let toneSelected = "";

// Appliquer classe d’ambiance initiale
document.body.classList.add("intro-mode");

function updateBackButton() {
  const btn = document.getElementById('backButton');
  // Affiche le bouton à partir de l'étape 3 (donc index 2)
  if (currentStep > 2) {
    btn.style.display = 'block';
  } else {
    btn.style.display = 'none';
  }
}

function nextStep() {
  if (!validateStep()) return;

  document.getElementById('step' + currentStep).classList.remove('active');

  // Retirer ambiance intro après la première étape
  if (currentStep === 1) {
    document.body.classList.remove("intro-mode");
  }

  currentStep++;
  const next = document.getElementById('step' + currentStep);
  next.classList.add('active');
  gsap.from(next, { opacity: 0, y: 50, duration: 0.8 });

  updateBackButton();
}

function previousStep() {
  if (currentStep > 1) {
    document.getElementById('step' + currentStep).classList.remove('active');
    currentStep--;
    const previous = document.getElementById('step' + currentStep);
    previous.classList.add('active');
    gsap.from(previous, { opacity: 0, y: 50, duration: 0.6 });

    // Réactiver l’ambiance intro si on revient à l’étape 1
    if (currentStep === 1) {
      document.body.classList.add("intro-mode");
    }

    updateBackButton();
  }
}

let selectedGif = "";

document.querySelectorAll('.gif-option').forEach(gif => {
  gif.addEventListener('click', () => {
    // Retirer la sélection sur tous les gifs
    document.querySelectorAll('.gif-option').forEach(g => g.classList.remove('selected'));

    // Ajouter la classe sélectionnée sur le gif cliqué
    gif.classList.add('selected');

    // Récupérer l'URL dans data-url
    selectedGif = gif.dataset.url;
    console.log("GIF sélectionné :", selectedGif); 
  });
});



function validateStep() {
  switch (currentStep) {
    case 2:
      const pseudo = document.getElementById('pseudo').value.trim();
      if (pseudo === "") {
        alert("Merci d’entrer ton nom ou pseudo.");
        return false;
      }
      break;
    case 3:
      const type = document.getElementById('type').value;
      if (!type) {
        alert("Merci de sélectionner ce que tu quittes.");
        return false;
      }
      break;
    case 4:
      if (!toneSelected) {
        alert("Merci de choisir un ton.");
        return false;
      }
      break;
    case 5:
      const msg = document.getElementById('message').value.trim();
      if (msg === "") {
        alert("Ton message ne peut pas être vide.");
        return false;
      }
      break;
    case 6:
      if (!selectedGif) {
        alert("Merci de choisir un GIF.");
        return false;
      }
      break;
    }
  return true;
}



document.querySelectorAll('.tone-option').forEach(el => {
  el.addEventListener('click', () => {
    document.querySelectorAll('.tone-option').forEach(e => e.classList.remove('selected'));
    el.classList.add('selected');
    toneSelected = el.dataset.tone;

    // Nettoyer ambiance actuelle
    document.body.classList.remove('ambiance-dramatique', 'ambiance-drole', 'ambiance-classe', 'ambiance-rage');

    // Appliquer l’ambiance correspondante
    switch (toneSelected) {
      case 'dramatique':
        document.body.classList.add('ambiance-dramatique');
        break;
      case 'drole':
        document.body.classList.add('ambiance-drole');
        break;
      case 'classe':
        document.body.classList.add('ambiance-classe');
        break;
      case 'rage':
        document.body.classList.add('ambiance-rage');
        break;
    }
  });
});



function submitForm() {
  if (!validateStep()) return;

  document.getElementById('f_pseudo').value = document.getElementById('pseudo').value;
  document.getElementById('f_type').value = document.getElementById('type').value;
  document.getElementById('f_tone').value = toneSelected;
  document.getElementById('f_message').value = document.getElementById('message').value;
  document.getElementById('f_gif').value = selectedGif;
  document.getElementById('finalForm').submit();
}
