<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title) ?> | Simple POS</title>
    <style>
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; font-family: Inter, system-ui, sans-serif; color: #1f2937; background: #eff6ff; }
        main { width: min(420px, calc(100% - 36px)); padding: 32px; background: white; border: 1px solid #dbeafe; border-radius: 14px; box-shadow: 0 12px 30px rgb(15 23 42 / 10%); }
        h1 { margin-top: 0; color: #102a43; } p { color: #64748b; } label { display: grid; gap: 7px; margin: 18px 0; font-weight: 700; } input { width: 100%; padding: 11px 12px; box-sizing: border-box; border: 1px solid #cbd5e1; border-radius: 7px; font: inherit; } button { width: 100%; padding: 11px; border: 0; border-radius: 7px; background: #2563eb; color: white; font: inherit; font-weight: 700; cursor: pointer; } .error, .notice { padding: 12px 14px; border-radius: 8px; } .error { color: #b91c1c; background: #fef2f2; } .notice { color: #047857; background: #ecfdf5; }
    </style>
</head>
<body>
<main>
    <h1>Staff Login</h1>
    <p>Sign in to manage customer and user accounts.</p>
    <?php if (session()->getFlashdata('message')): ?><div class="notice"><?= esc(session()->getFlashdata('message')) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="error"><?= esc($error) ?></div><?php endif; ?>
    <form method="post" action="<?= site_url('login') ?>">
        <?= csrf_field() ?>
        <label>Username <input type="text" name="username" value="<?= esc(old('username')) ?>" required autocomplete="username"></label>
        <label>Password <input type="password" name="password" required autocomplete="current-password"></label>
        <button type="submit">Log in</button>
    </form>
</main>
</body>
</html>
