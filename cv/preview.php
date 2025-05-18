<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
$host = 'localhost';
$db   = 'infiniteroots_users';
$user = 'infiniteroots_mathieu';
$pass = 'teamspirit';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Erreur connexion DB : ' . $e->getMessage());
}

?>


<?php 
function securise($data) {
    return htmlspecialchars(trim($data));
}

function svg_humeur($humeur) {
    return match ($humeur) {
        'colere' => '😡',
        'triste' => '😢',
        'joyeux' => '😄',
        default  => '😐',
    };
}

$nom          = securise($_POST['nom'] ?? 'Anonymous');
$metier       = securise($_POST['metier'] ?? 'Partir sans prevenir');
$competences  = securise($_POST['competences'] ?? '');
$experience   = securise($_POST['experience'] ?? '');
$humeur       = securise($_POST['humeur'] ?? 'inconnue');
$message      = securise($_POST['message'] ?? '');
$profil       = securise($_POST['profil'] ?? '');
$punchline    = securise($_POST['punchline'] ?? '');
$non_regret   = securise($_POST['non_regret'] ?? '');
$regret       = securise($_POST['regret'] ?? '');
$anecdote     = securise($_POST['anecdote'] ?? '');
$emoji = svg_humeur($humeur);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO cv 
        (nom, metier, punchline, message, profil, competences, experience, non_regret, regret, anecdote, humeur) 
        VALUES 
        (:nom, :metier, :punchline, :message, :profil, :competences, :experience, :non_regret, :regret, :anecdote, :humeur)");

    $stmt->execute([
        ':nom' => $nom,
        ':metier' => $metier,
        ':punchline' => $punchline,
        ':message' => $message,
        ':profil' => $profil,
        ':competences' => $competences,
        ':experience' => $experience,
        ':non_regret' => $non_regret,
        ':regret' => $regret,
        ':anecdote' => $anecdote,
        ':humeur' => $humeur
    ]);
}

// Textes par défaut
$default_texts = [
    'punchline' => "Adieu, et que la mémoire de ces instants perdure.",
    'non_regret' => "Franchement, certains vont voir ce qu'ils perdent... ou pas.",
    'regret' => "Je ne regrette RIEN",
    'anecdote' => "Pas encore définie...",
    'message' => "Le prenez pas personnellement mais... je vous aime pas",
    'competences' => "Aucune à part tromper",
    'experience' => "Negative",
    'profil' => "Personne hautement capable de tout plaquer en une fraction de seconde",
];

// Si champ vide, on remplace par texte par défaut
$punchline  = $punchline ?: $default_texts['punchline'];
$non_regret = $non_regret ?: $default_texts['non_regret'];
$regret     = $regret ?: $default_texts['regret'];
$anecdote   = $anecdote ?: $default_texts['anecdote'];
$message    = $message ?: $default_texts['message'];
$competences= $competences ?: $default_texts['competences'];
$experience = $experience ?: $default_texts['experience'];
$profil     = $profil ?: $default_texts['profil'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>CV de <?= $nom ?></title>
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="../assets/image/logo.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/sidebar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="script.js" defer></script>
</head>
<body>
    <!-- side bar -->
<div class="sidebar">
    <nav class="mainMenu">
        <ul class="menu">
            <li>
                <a href="../index.php" class="smoothScroll">
                    <i class="fas fa-house icon-img"></i>
                    <span class="text">Accueil</span>
                </a>
            </li>
            <li>
                <a href="../form.php" class="smoothScroll">
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
                <a href="../galerie.php" class="smoothScroll">
                    <i class="fas fa-paper-plane icon-img"></i>
                    <span class="text">Galerie</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- fin -->
    
    <h1 class="title-cv">Clique partout pour modifier les champs de texte !</h1>
    
    <div class="page-wrapper">
        <div class="container">
            <div class="left_side">
                <h1>JE ME CASSE LES CASSOS</h1>
                <div class="profile_Text">
                    <h2 contenteditable="true" id="nom"><?= $nom ?></h2>
                    <p><strong>Metier :</strong><span contenteditable="true" id="metier"> <?= $metier ?></span></p>
                </div>

                <div class="section">
                    <h3>Ma dernière punchline</h3>
                    <p contenteditable="true" id="punchline"><?= nl2br($punchline) ?></p>
                </div>

                <div class="section">
                    <h3>Message personnel</h3>
                    <p contenteditable="true" id="message"><?= nl2br($message) ?></p>
                </div>

                <div class="section">
                    <h3>A propos</h3>
                    <p contenteditable="true" id="profil"><?= nl2br($profil) ?></p>
                </div>
            </div>

            <div class="right_side">
                <div class="section">
                    <div class="humeur-ligne">
                        <h3>Humeur actuelle</h3>
                        <span class="emoji" id="emoji_display" contenteditable="false"><?= $emoji ?></span>
                            <select id="humeur_select" onchange="changerEmoji()" style="margin-left: 10px;">
                                <option value="colere">😡</option>
                                <option value="triste">😢</option>
                                <option value="joyeux">😄</option>
                                <option value="autre">😐</option>
                            </select>
                    </div>
                    <hr>
                </div>

                <div class="section">
                    <h3>Competences</h3>
                    <p contenteditable="true" id="competences"><?= nl2br($competences) ?></p>
                    <hr>
                </div>

                <div class="section">
                    <h3>Experience</h3>
                    <p contenteditable="true" id="experience"><?= nl2br($experience) ?></p>
                    <hr>
                </div>

                <div class="section">
                    <h3>Ce que je ne vais PAS regretter</h3>
                    <p contenteditable="true" id="non_regret"><?= nl2br($non_regret) ?></p>
                    <hr>
                </div>

                <div class="section">
                    <h3>Ce que je vais VRAIMENT regretter</h3>
                    <p contenteditable="true" id="regret"><?= nl2br($regret) ?></p>
                    <hr>
                </div>

                <div class="section">
                    <h3>Anecdote mémorable</h3>
                    <p contenteditable="true" id="anecdote"><?= nl2br($anecdote) ?></p>
                    <hr>
                </div>
            </div>
        </div>

    </div>
    
    <button id="btnEnregistrer" onclick="enregistrer()">Enregistrer</button>

    
    <form id="hiddenForm" method="POST" action="" style="display:none;">
        <input type="hidden" name="nom" id="input_nom">
        <input type="hidden" name="punchline" id="input_punchline">
        <input type="hidden" name="message" id="input_message">
        <input type="hidden" name="profil" id="input_profil">
        <input type="hidden" name="competences" id="input_competences">
        <input type="hidden" name="humeur" id="input_humeur">
        <input type="hidden" name="experience" id="input_experience">
        <input type="hidden" name="non_regret" id="input_non_regret">
        <input type="hidden" name="regret" id="input_regret">
        <input type="hidden" name="anecdote" id="input_anecdote">

    </form>
    

    
    <script>
    function changerEmoji() {
        const humeur = document.getElementById("humeur_select").value;
        const emojiMap = {
            colere: "😡",
            triste: "😢",
            joyeux: "😄",
            autre: "😐"
        };
        document.getElementById("emoji_display").textContent = emojiMap[humeur];
    }
    
    
    function enregistrer() {
      document.getElementById('input_nom').value = document.getElementById('nom').innerText;
      document.getElementById('input_punchline').value = document.getElementById('punchline').innerText;
      document.getElementById('input_message').value = document.getElementById('message').innerText;
      document.getElementById('input_profil').value = document.getElementById('profil').innerText;
      document.getElementById('input_competences').value = document.getElementById('competences').innerText;
      document.getElementById('input_humeur').value = document.getElementById('humeur_select').value;
      document.getElementById('input_experience').value = document.getElementById('experience').innerText;
      document.getElementById('input_non_regret').value = document.getElementById('non_regret').innerText;
      document.getElementById('input_regret').value = document.getElementById('regret').innerText;
      document.getElementById('input_anecdote').value = document.getElementById('anecdote').innerText;
      

      document.getElementById('hiddenForm').submit();
    }
    
    
  </script>

    
</body>
</html>
