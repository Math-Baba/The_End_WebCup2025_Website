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


$stmt = $pdo->query('SELECT id, nom, categories, emotion, commentaires, gif, votes FROM users');

$endings = [];
while ($row = $stmt->fetch()) {
    $endings[] = [
        "id" => $row["id"],
        'title' => $row['nom'],
        'description' => $row['commentaires'],
        'previewFile' => $row['gif'],
        'votes' => (int)$row['votes'],
        'category' => $row['categories'],
        'emotion' => $row['emotion'] ?? 'inconnue',
        'previewUrl' => 'preview.php?id=' . $row['id']
    ];
}

function generatePreviewURL($row) {
    $category = strtolower($row['categories'] ?? 'default');
    $emotion = strtolower($row['emotion'] ?? 'default');
    return "https://via.placeholder.com/300x200?text=" . urlencode($category . '+' . $emotion);
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TheEnd.page - Vote pour la fin !</title>
  <link rel="icon" href="assets/image/logo.png" type="image/png">
  <link rel="stylesheet" href="assets/css/galerie.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
  <link rel="stylesheet" href="assets/css/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

</head>
<body>
    
<!-- side bar -->
<div class="sidebar sidebar-delayed">
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

    
  <h1>Vote pour la meilleure fin !</h1>
  <p style="text-align:center">Les créations les plus plébiscitées rejoindront le <strong>LE BIG THREE</strong> du prestigieux Hall of Fame de <strong>TheEnd.page</strong>.</p>
    
  <section id="hall-of-fame">
      <h2>🏆 Hall of Fame</h2>
      <div id="fame-list" class="fame-cards"></div>
  </section>
  <div class="container" id="vote-container">
    <!-- Cards avec fin -->
  </div>
 
  
  <div class="fun-container">
      <p class="fun-text">🏃  Ton ticket pour la liberté, c’est ce CV inversé !</p>
      
      <a href="cv/preview.php" class="btn">
    <svg height="24" width="24" fill="#FFFFFF" viewBox="0 0 24 24" data-name="Layer 1" id="Layer_1" class="sparkle">
        <path d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z"></path>
    </svg>

    <span class="text">Click & Bye Bye</span>
</a>
  </div>
  
  



<footer class="footer">
  <div class="footer-content">
    <div class="footer-section about">
      <h3>Infinite Roots</h3>
      <p>Une bande de curieux qui aiment expérimenter, coder, créer… et relever des défis, même sans expérience concrète !</p>
    </div>
    <div class="footer-section team">
      <h4>Notre équipe</h4>
      <ul>
        <li>Junior YISSIBI</li>
        <li>Amy RATSIHOARANA</li>
        <li>Bryan RASOLONDRAIBE</li>
        <li>Mathieu BABA</li>
      </ul>
    </div>
    <div class="footer-section values">
      <h4>Nos valeurs</h4>
      <p>Créativité, rigueur, collaboration<br> et un brin de folie.</p>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2025 Infinite Roots. Tous droits réservés.</p>
  </div>
</footer>

  

  
<script>
  window.endings = <?= json_encode($endings, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
</script>
<script>
  window.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.querySelector('.sidebar-delayed');
    if (sidebar) {
      setTimeout(() => {
        sidebar.classList.add('visible');
      }, 100);
    }
  });
</script>

<script src="assets/js/galerie.js"></script>

 
</body>
</html>