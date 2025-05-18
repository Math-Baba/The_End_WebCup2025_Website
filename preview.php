<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $row = $stmt->fetch();

    if (!$row) {
        die("Aucune page trouvée.");
    }

    $pseudo = $row['nom'];
    $type = $row['categories'];
    $tone = $row['emotion'];
    $message = $row['commentaires'];
    $gif = $row['gif'];
} else {
    die("Aucun ID fourni.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>The End de <?= htmlspecialchars($pseudo) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&family=Comic+Neue&family=Montserrat:wght@400;700&family=Rubik+Mono+One&display=swap');

    body {
      margin: 0;
      padding: 40px 20px;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      transition: all 0.5s ease;
    }

    h1 {
      font-size: 3rem;
      margin-bottom: 1rem;
    }

    h2 {
      font-size: 1.4rem;
      opacity: 0.8;
      margin-bottom: 30px;
    }

    .message {
      font-size: 1.6rem;
      max-width: 850px;
      line-height: 1.6;
      margin-bottom: 30px;
    }

    .gif {
      max-width: 300px;
      border-radius: 12px;
      margin: 20px auto;
      box-shadow: 0 6px 14px rgba(0,0,0,0.3);
    }

    .button {
      margin: 10px;
      padding: 14px 28px;
      background-color: #fb6376;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 1rem;
      font-weight: bold;
      text-decoration: none;
    }

    .button:hover {
      background-color: #5d2a42;
    }

    body.dramatique {
      background-color: #5d2a42;
      color: #fff9ec;
      font-family: 'Playfair Display', serif;
    }

    body.drole {
      background-color: #fb6376;
      color: #fff9ec;
      font-family: 'Comic Neue', cursive;
    }

    body.classe {
      background-color: #fcb1a6;
      color: #5d2a42;
      font-family: 'Montserrat', sans-serif;
    }

    body.rage {
      background-color: #5d2a42;
      color: #ffdccc;
      font-family: 'Rubik Mono One', monospace;
    }

    body.rage .message {
      animation: glitch 0.4s infinite;
    }

    @keyframes glitch {
      0% { transform: translate(0); }
      20% { transform: translate(-2px, 2px); }
      40% { transform: translate(-2px, -2px); }
      60% { transform: translate(2px, 2px); }
      80% { transform: translate(2px, -2px); }
      100% { transform: translate(0); }
    }
  </style>
</head>

<body class="<?= htmlspecialchars($tone) ?>">

  <h1>The End of <?= htmlspecialchars($pseudo) ?></h1>
  <h2>
    <?php
      switch ($type) {
        case 'Travail': echo "Tu quittes un travail."; break;
        case 'Amour': echo "Tu mets fin à une relation."; break;
        case 'Projet': echo "Tu laisses derrière toi un projet."; break;
        case 'Autre': echo "Tu tournes une page."; break;
        default: echo "Tu pars, tout simplement.";
      }
    ?>
  </h2>

  <div class="message">“<?= nl2br(htmlspecialchars($message)) ?>”</div>

  <?php if ($gif): ?>
    <img src="<?= htmlspecialchars($gif) ?>" alt="GIF choisi" class="gif">
  <?php endif; ?>

  <div>
    <a class="button" href="form.php">Créer une autre page</a>
    <a class="button" href="galerie.php">Voir la galerie</a>
  </div>

</body>
</html>
