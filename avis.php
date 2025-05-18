<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Crée ta page d'adieu - Immersif</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Liens vers les feuilles de style -->
  <link rel="stylesheet" href="assets/css/formulaire.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
</head>
<body>

<!-- side bar -->
<div class="sidebar">
    <nav class="mainMenu">
        <ul class="menu">
            <li>
                <a href="index.php" class="smoothScroll">
                    <i class="fas fa-house icon-img"></i>
                    <span class="text">Accueil</span>
                </a>
            </li>
            <li>
                <a href="form.php" class="smoothScroll">
                    <i class="fas fa-file-lines icon-img"></i>
                    <span class="text">Form de Ragequit</span>
                </a>
            </li>
            <li>
                <a href="preview.php" class="smoothScroll">
                    <i class="fas fa-eye icon-img"></i>
                    <span class="text">Ton CV inversé</span>
                </a>
            </li>
            <li>
                <a href="galerie.php" class="smoothScroll">
                    <i class="fas fa-paper-plane icon-img"></i>
                    <span class="text">Galerie</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- fin -->

<div id="backButton" onclick="previousStep()" style="display: none;">
  ← Retour
</div>

<form id="finalForm" action="storage.php" method="post">
    
<div class="step active" id="step1">
  <h1 class="animate__animated animate__fadeInDown">🌀 Une page se tourne…</h1>
  <p class="animate__animated animate__fadeInUp">Prêt à dire adieu avec style ?</p>
  <button type="button" onclick="nextStep()">Commencer</button> 
  <!--
  Sans type = "button" =>  Il soumet immédiatement le formulaire, même si tu voulais juste passer à l'étape suivante.
  
  Avec type = "button" => Ici dans la balise button j'ai comme type button pour indiquer
  que par défaut le bouton ne va rien faire (ne retournera donc pas un formulaire lorsqu'on appuie sur pour éviter de 
  stocker de suite des informations dans la base de donnée après avoir effectuer une clique sur la boutton sans avoir même 
  poursuivi à la récupération des autres données-->
</div>

<div class="step" id="step2">
  <h2>Quel est ton nom ?</h2>
  <input type="text" id="pseudo" class="form-control w-50 mx-auto" name="pseudo">
  <button type="button" onclick="nextStep()">Continuer</button>
</div>

<div class="step" id="step3">
  <h2>Qu’est-ce que tu quittes aujourd’hui ?</h2>
  <select id="type" name="categories" class="form-control w-50 mx-auto">
    <option value="travail">💼 Un travail</option>
    <option value="amour">❤️ Une relation</option>
    <option value="projet">💡 Un projet</option>
    <option value="autre">🌪️ Autre</option>
  </select>
  <button type="button" onclick="nextStep()">Continuer</button>
</div>

<!-- Input caché pour la valeur sélectionnée -->
<input type="hidden" name="tone" id="selectedTone">

<div class="step" id="step4">
  <h2>Comment te sens-tu actuellement ?</h2>
  <div id="tones">
    <div class="tone-option" data-tone="dramatique">😢 Triste</div>
    <div class="tone-option" data-tone="drole">😂 Gaie</div>
    <div class="tone-option" data-tone="classe">😎 Heureux</div>
    <div class="tone-option" data-tone="rage">💥 En colère</div>
  </div>
  <button type="button" onclick="nextStep()">Continuer</button>
</div>

<div class="step" id="step5">
  <h2>Lache toi !!</h2>
  <textarea name="commentaires" id="message" class="form-control w-75 mx-auto" rows="5" placeholder="Ce que tu veux leur dire..."></textarea>
  <button type="submit">Créer ma page</button>
</div>

</form>

<!-- Boutons de partage -->
<div class="text-center mt-4">
  <h3>Partager cette page :</h3>
  <a class="button-share" id="facebookBtn" target="_blank">Partager sur Facebook</a>
  <a class="button-share" id="whatsappBtn" target="_blank">Partager sur WhatsApp</a>
</div>

<!-- Réponses d'autres personnes -->
<div id="responses" class="w-75 mx-auto">
  <h4>Messages des autres :</h4>
  <textarea id="otherMessage" class="form-control" rows="3" placeholder="Ajoute ta réaction..."></textarea>
  <button onclick="addResponse()" class="btn btn-primary mt-2">Envoyer</button>
  <div id="messageList"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="assets/js/formulaire.js"></script>
<script src="assets/js/partageAvis.js"></script>
<script src="assets/js/reactionAvis.js"></script>

<script>
  const toneOptions = document.querySelectorAll('.tone-option');

  toneOptions.forEach(option => {
    option.addEventListener('click', () => {
      // Récupérer la valeur cliquée
      const selectedTone = option.dataset.tone;

      // Mettre la valeur dans le champ caché
      document.getElementById('selectedTone').value = selectedTone;
    });
  });
</script>


</body>
</html>
