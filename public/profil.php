<?php
require_once __DIR__ . '/../src/Middlewares/AuthMiddleware.php';
require_once __DIR__ . '/../src/Models/User.php';

AuthMiddleware::check();
$user = User::findById($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>profil</title>
  <link rel="stylesheet" href="/css/style.css" />
  <link rel="icon" href="/assets/favico.png" type="image/png">

</head>
<body>
    


<div class="section">
    <h2>Mon profil</h2>

    <div style="display: flex; align-items: center; gap: 1rem;">
        <img src="/uploads/<?= htmlspecialchars($user['avatar'] ?? 'default.png') ?>"
             alt="Avatar"
             style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">

        <div>
            <p><strong>Pseudo :</strong> <?= htmlspecialchars($user['username']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>bio :</strong> <?= htmlspecialchars($user['bio']) ?></p>
        </div>
    </div>
</div>

<!-- Option : formulaire pour modifier les infos -->
<form method="POST" action="/profil/update" enctype="multipart/form-data">
    <label>Pseudo :
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>">
    </label><br><br>

    <label>Email :
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
    </label><br><br>

    <label>Biographie :<br>
        <textarea name="bio" rows="5" cols="40"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
    </label><br><br>

    <label>Nouvel avatar :
        <input type="file" name="avatar">
    </label><br><br>

    <button type="submit">Enregistrer</button>
</form>

</body>
</html>