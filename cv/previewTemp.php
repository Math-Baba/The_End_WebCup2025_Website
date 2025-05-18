<!-- previewTemp.php -->
<?php
function securise($data) {
    return htmlspecialchars(trim($data));
}

$nom          = securise($_POST['nom'] ?? 'Anonymous');
$metier       = securise($_POST['metier'] ?? 'Partir sans prevenir');
$competences  = securise($_POST['competences'] ?? '');
$experience   = securise($_POST['experience'] ?? '');
$humeur       = securise($_POST['humeur'] ?? '');
$message      = securise($_POST['message'] ?? '');
$profil       = securise($_POST['profil'] ?? '');
$punchline    = securise($_POST['punchline'] ?? '');
$non_regret   = securise($_POST['non_regret'] ?? '');
$regret       = securise($_POST['regret'] ?? '');
$anecdote     = securise($_POST['anecdote'] ?? '');

function svg_humeur($humeur) {
    return match ($humeur) {
        'colere' => '😡',
        'triste' => '😢',
        'joyeux' => '😄',
        default  => '😐',
    };
}
$emoji = svg_humeur($humeur);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Prévisualisation du CV</title>
    <link rel="stylesheet" href="style.css" />
    <script src="script.js" defer></script>

</head>
<body>
<h1 style="
  text-align: center;
  font-family: 'Poppins', 'Arial Black', sans-serif;
  text-transform: uppercase;
  letter-spacing: 0.15em;
  font-weight: 700;
  color: #8f5863;
  margin-top: 20px;
  font-size: 2.5rem;
">
   C'EST CIAO 🫡
</h1>


<div class="page-wrapper">
    <div class="container">
        <div class="left_side">
            <h1>JE ME CASSE LES CASSOS</h1>
            <div class="profile_Text">
                <h2><?= $nom ?></h2>
                <p><strong>Metier :</strong> <?= $metier ?></p>
            </div>
            <div class="section"><h3>Ma dernière punchline</h3><p><?= nl2br($punchline) ?></p></div>
            <div class="section"><h3>Message personnel</h3><p><?= nl2br($message) ?></p></div>
            <div class="section"><h3>A propos</h3><p><?= nl2br($profil) ?></p></div>
        </div>

        <div class="right_side">
            <div class="section"><h3>Humeur actuelle</h3><span><?= $emoji ?></span><hr></div>
            <div class="section"><h3>Competences</h3><p><?= nl2br($competences) ?></p><hr></div>
            <div class="section"><h3>Experience</h3><p><?= nl2br($experience) ?></p><hr></div>
            <div class="section"><h3>Ce que je ne vais PAS regretter</h3><p><?= nl2br($non_regret) ?></p><hr></div>
            <div class="section"><h3>Ce que je vais VRAIMENT regretter</h3><p><?= nl2br($regret) ?></p><hr></div>
            <div class="section"><h3>Anecdote mémorable</h3><p><?= nl2br($anecdote) ?></p><hr></div>
        </div>
    </div>
</div>
</body>
</html>
