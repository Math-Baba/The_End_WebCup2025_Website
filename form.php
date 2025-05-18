<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Crée ta page d'adieu - Immersif</title>
  <link rel="icon" href="assets/image/logo.png" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Liens vers les feuilles de style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="assets/css/formulaire.css">
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
                <a href="cv/preview.php" class="smoothScroll">
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

<div class="step active" id="step1">
  <h1 class="animate__animated animate__fadeInDown">🌀 Une page se tourne…</h1>
  <p class="animate__animated animate__fadeInUp">Prêt à dire adieu avec style ?</p>
  <button onclick="nextStep()">Commencer</button>
</div>


<div class="step" id="step2">
  <h2>Quel est ton nom ?</h2>
  <input type="text" id="pseudo" class="form-control w-50 mx-auto">
  <button onclick="nextStep()">Continuer</button>
</div>


<div class="step" id="step3">
  <h2>Qu’est-ce que tu quittes aujourd’hui ?</h2>
  <select id="type" class="form-control w-50 mx-auto">
    <option value="Travail">💼 Un travail</option>
    <option value="Amour">❤️ Une relation</option>
    <option value="Projet">💡 Un projet</option>
    <option value="Autre">🌪️ Autre</option>
  </select>
  <button onclick="nextStep()">Continuer</button>
</div>


<div class="step" id="step4">
  <h2>Comment te sens-tu actuellement ?</h2>
  <div id="tones">
    <div class="tone-option" data-tone="dramatique">😢 Triste</div>
    <div class="tone-option" data-tone="drole">😂 Gaie</div>
    <div class="tone-option" data-tone="classe">😎 Heureux</div>
    <div class="tone-option" data-tone="rage">💥 En colère</div>
  </div>
  <button onclick="nextStep()">Continuer</button>
</div>


<div class="step" id="step5">
  <h2>Lache toi !!</h2>
  <textarea id="message" class="form-control w-75 mx-auto" rows="5" placeholder="Ce que tu veux leur dire..."></textarea>
  <button onclick="nextStep()">Continuer</button>
</div>

<div class="step" id="step6">
  <h2>Quel GIF exprime mieux ton état actuel ?</h2>
  <div class="gif-cards w-75 mx-auto d-flex justify-content-around flex-wrap">
      
    <div class="gif-option" data-url="https://media.giphy.com/media/2Vuto7CotrpgAKMVoS/giphy.gif" style="cursor:pointer; border: 2px solid transparent; padding: 5px;">
      <img src="https://media.giphy.com/media/2Vuto7CotrpgAKMVoS/200w.gif" alt="GIF 1" />
    </div>
    
    <div class="gif-option" data-url="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExdDJkeWhnajhzbDhzZndhNzJkbnkzNzduaWRuc3BzcnN2aHVjeHdxNyZlcD12MV9naWZzX3NlYXJjaCZjdD1n/2RGhmKXcl0ViM/giphy.gif"  style="cursor:pointer; border: 2px solid transparent; padding: 5px;">
        <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExdDJkeWhnajhzbDhzZndhNzJkbnkzNzduaWRuc3BzcnN2aHVjeHdxNyZlcD12MV9naWZzX3NlYXJjaCZjdD1n/2RGhmKXcl0ViM/200w.gif" alt="GIF 2" />
    </div>

    <div class="gif-option" data-url="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExcHJlMng3MzN2cm1ucWtremJvM3lvMTlubnlnaHNucWE3dnFnM2t0MyZlcD12MV9naWZzX3NlYXJjaCZjdD1n/aIJB8Jtw2xDKu7eICO/giphy.gif" style="cursor:pointer; border: 2px solid transparent; padding: 5px;">
        <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExcHJlMng3MzN2cm1ucWtremJvM3lvMTlubnlnaHNucWE3dnFnM2t0MyZlcD12MV9naWZzX3NlYXJjaCZjdD1n/aIJB8Jtw2xDKu7eICO/200w.gif" alt="GIF 3" />
    </div>
    
    <div class="gif-option" data-url="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExbDJwNHZ0dm0yOHl5MGlkNjdranAyZWNqZGthY2V6M3VjbGlmd21rbSZlcD12MV9naWZzX3NlYXJjaCZjdD1n/G5X63GrrLjjVK/giphy.gif" style="cursor:pointer; border: 2px solid transparent; padding: 5px;">
        <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExbDJwNHZ0dm0yOHl5MGlkNjdranAyZWNqZGthY2V6M3VjbGlmd21rbSZlcD12MV9naWZzX3NlYXJjaCZjdD1n/G5X63GrrLjjVK/200w.gif" alt="GIF 4" />
    </div>
    
    <div class="gif-option" data-url="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExaXVwOHEwZnozNDlhdjY1Ynhod2Q1b3doaDJmZ2o0amo1bHNud3F6cSZlcD12MV9naWZzX3NlYXJjaCZjdD1n/xU1spRleFHmtjvskXw/giphy.gif" style="cursor:pointer; border: 2px solid transparent; padding: 5px;">
        <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExaXVwOHEwZnozNDlhdjY1Ynhod2Q1b3doaDJmZ2o0amo1bHNud3F6cSZlcD12MV9naWZzX3NlYXJjaCZjdD1n/xU1spRleFHmtjvskXw/200w.gif" alt="GIF 5" />
    </div>

  </div>
  <button onclick="submitForm()">Créer ma page</button>
</div>


<form id="finalForm" action="submit.php" method="POST" style="display:none;">
  <input type="hidden" name="pseudo" id="f_pseudo">
  <input type="hidden" name="type" id="f_type">
  <input type="hidden" name="tone" id="f_tone">
  <input type="hidden" name="message" id="f_message">
  <input type="hidden" name="gif" id="f_gif" value="">
</form>


<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="assets/js/formulaire.js"></script>

</body>
</html>
