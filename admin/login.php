<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin - SiPeDes</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #f5f5f7; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
    .card { background: white; border-radius: 12px; padding: 40px; width: 380px; border: 1px solid #e5e7eb; }
    .header { background: #7c3aed; color: white; border-radius: 8px; padding: 20px; text-align: center; margin-bottom: 24px; }
    .header h2 { font-size: 20px; margin-bottom: 4px; }
    .header p { font-size: 13px; opacity: 0.85; }
    label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; margin-top: 16px; }
    input { width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; background: #f9fafb; }
    input:focus { outline: none; border-color: #7c3aed; background: white; }
    button { width: 100%; margin-top: 20px; padding: 12px; background: #7c3aed; color: white; border: none; border-radius: 8px; font-size: 14px; cursor: pointer; }
    button:hover { background: #6d28d9; }
    .error { background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 6px; font-size: 13px; margin-bottom: 12px; }
  </style>
</head>
<body>

<div class="card">
  <div class="header">
    <h2>SiPeDes Admin</h2>
    <p>Masuk ke panel admin</p>
  </div>

  <?php if (isset($_GET['error'])): ?>
  <div class="error">Username atau password salah.</div>
  <?php endif; ?>

  <form action="proses-login.php" method="POST">
    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit">Masuk</button>
  </form>
</div>

</body>
</html>