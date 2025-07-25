<?php
if ($_SERVER['REQUEST_URI'] === '/dashboard.php') {
    header('Location: /dashboard');
    exit;
}
require_once __DIR__ . '/../src/Middlewares/AuthMiddleware.php';
require_once __DIR__ . '/../src/Models/User.php';
require_once __DIR__ . '/../src/Models/Match.php';
require_once __DIR__ . '/../src/Models/Message.php';
AuthMiddleware::check();
$user = User::findById($_SESSION['user_id']);
if (!$user) {
    echo "Utilisateur introuvable.";
    exit;
}
$matches = MatchModel::getMatchesForUser($user['id']);
$messages = Message::getLastMessagesForUser($user['id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="/css/style.css" />
  <link rel="icon" href="/assets/favico.png" type="image/png">

</head>
<body>
  <a href="/profil">
    <div class="section" style="display: flex; align-items: center; gap: 1rem;">
        <img src="/uploads/<?= htmlspecialchars($user['avatar'] ?? 'default.png') ?>"
            alt="Avatar"
            style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
  </a>
        <div>
            <h2>Bienvenue, <?= htmlspecialchars($user['username']) ?></h2>
            <p><?= htmlspecialchars($user['bio']) ?></p>
        </div>
    </div>
  
  <h2>Matchs</h2>
  <?php if (empty($matches)): ?>
      <p>Vous n’avez pas encore de matchs.</p>
  <?php else: ?>
      <ul>
          <?php foreach ($matches as $match): ?>
              <li><?= htmlspecialchars($match['username']) ?> (<?= htmlspecialchars($match['email']) ?>)</li>
          <?php endforeach; ?>
      </ul>
  <?php endif; ?>

  <h2>Derniers messages</h2>
  <?php if (empty($messages)): ?>
      <p>Pas encore de messages.</p>
  <?php else: ?>
      <ul>
          <?php foreach ($messages as $msg): ?>
              <li>
                  <strong><?= htmlspecialchars($msg['sender_name']) ?> :</strong>
                  <?= htmlspecialchars($msg['content']) ?> <em>(<?= $msg['sent_at'] ?>)</em>
              </li>
          <?php endforeach; ?>
      </ul>
  <?php endif; ?>

  <a href="/logout">Se déconnecter</a>
</body>
</html>