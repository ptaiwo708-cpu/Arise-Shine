<?php
require __DIR__ . '/../config/auth.php';
require_admin();
require __DIR__ . '/../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';
$success = '';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        $error = 'Invalid request. Please try again.';
    } else {

        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($current === '' || $new === '' || $confirm === '') {
            $error = 'Please fill in all password fields.';
        } elseif ($new !== $confirm) {
            $error = 'New password and confirmation do not match.';
        } elseif (strlen($new) < 8) {
            $error = 'New password must be at least 8 characters long.';
        } elseif ($current === $new) {
            $error = 'Your new password must be different from the current password.';
        } else {

            $stmt = $pdo->prepare(
                'SELECT password FROM admins WHERE id = ? LIMIT 1'
            );

            $stmt->execute([$_SESSION['admin_id']]);
            $admin = $stmt->fetch();

            if (!$admin || !password_verify($current, $admin['password'])) {

                $error = 'Current password is incorrect.';

            } else {

                $hash = password_hash($new, PASSWORD_DEFAULT);

                $update = $pdo->prepare(
                    'UPDATE admins SET password = ? WHERE id = ?'
                );

                $update->execute([
                    $hash,
                    $_SESSION['admin_id']
                ]);

                session_regenerate_id(true);

                $success = 'Password changed successfully.';
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Change Password | Arise & Shine Admin</title>

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Poppins, Arial, sans-serif;
    background: #f5f7fb;
    color: #11152a;
}

.top {
    background: #0508d0;
    color: #fff;
    padding: 18px 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
}

.top h2 {
    margin: 0;
    font-size: 1.15rem;
}

.top a {
    color: #fff;
    text-decoration: none;
    background: rgba(255,255,255,.12);
    padding: 9px 14px;
    border-radius: 10px;
}

.wrap {
    width: min(650px, 92%);
    margin: 45px auto;
}

.card {
    background: #fff;
    border: 1px solid #e7eaf2;
    border-radius: 22px;
    padding: 32px;
    box-shadow: 0 18px 45px rgba(16,24,40,.08);
}

.icon {
    width: 58px;
    height: 58px;
    display: grid;
    place-items: center;
    border-radius: 16px;
    background: #eef0ff;
    color: #0508d0;
    font-size: 24px;
    margin-bottom: 18px;
}

h1 {
    margin: 0 0 8px;
    font-size: 1.8rem;
}

.intro {
    color: #687085;
    margin: 0 0 25px;
}

.field {
    margin-bottom: 18px;
}

.field label {
    display: block;
    font-weight: 600;
    font-size: .9rem;
    margin-bottom: 7px;
}

.password-wrap {
    position: relative;
}

.password-wrap input {
    width: 100%;
    padding: 13px 45px 13px 14px;
    border: 1px solid #d9ddea;
    border-radius: 12px;
    background: #fbfcff;
    font: inherit;
    outline: none;
}

.password-wrap input:focus {
    border-color: #0508d0;
    box-shadow: 0 0 0 4px rgba(5,8,208,.08);
}

.toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    border: 0;
    background: transparent;
    color: #687085;
    cursor: pointer;
}

.hint {
    font-size: .82rem;
    color: #687085;
    margin-top: 6px;
}

button.submit {
    width: 100%;
    border: 0;
    background: #0508d0;
    color: #fff;
    padding: 14px;
    border-radius: 12px;
    font: 700 1rem Poppins;
    cursor: pointer;
}

button.submit:hover {
    background: #03069f;
}

.message {
    padding: 13px 15px;
    border-radius: 12px;
    margin-bottom: 20px;
}

.error {
    background: #fff0f0;
    color: #a40000;
    border: 1px solid #ffd1d1;
}

.success {
    background: #eafaf0;
    color: #176b35;
    border: 1px solid #c9efd7;
}

.back {
    display: inline-block;
    margin-top: 18px;
    color: #0508d0;
    font-weight: 600;
    text-decoration: none;
}

@media (max-width: 600px) {

    .card {
        padding: 23px;
    }

    .wrap {
        margin: 25px auto;
    }

    .top h2 {
        font-size: 1rem;
    }

}

</style>

</head>

<body>

<header class="top">

    <h2>
        <i class="fa-solid fa-shield-halved"></i>
        Arise & Shine Admin
    </h2>

    <a href="dashboard.php">
        <i class="fa-solid fa-arrow-left"></i>
        Dashboard
    </a>

</header>

<main class="wrap">

<section class="card">

    <div class="icon">
        <i class="fa-solid fa-key"></i>
    </div>

    <h1>Change Password</h1>

    <p class="intro">
        Update your administrator password securely.
        Use a strong password that you do not use elsewhere.
    </p>

    <?php if ($error): ?>

        <div class="message error">
            <?= htmlspecialchars($error) ?>
        </div>

    <?php endif; ?>


    <?php if ($success): ?>

        <div class="message success">

            <i class="fa-solid fa-circle-check"></i>

            <?= htmlspecialchars($success) ?>

        </div>

    <?php endif; ?>


    <form method="post" autocomplete="off">

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>"
        >


        <div class="field">

            <label for="current_password">
                Current Password
            </label>

            <div class="password-wrap">

                <input
                    id="current_password"
                    name="current_password"
                    type="password"
                    required
                    autocomplete="current-password"
                >

                <button
                    class="toggle"
                    type="button"
                    data-target="current_password"
                    aria-label="Show current password"
                >
                    <i class="fa-solid fa-eye"></i>
                </button>

            </div>

        </div>


        <div class="field">

            <label for="new_password">
                New Password
            </label>

            <div class="password-wrap">

                <input
                    id="new_password"
                    name="new_password"
                    type="password"
                    minlength="8"
                    required
                    autocomplete="new-password"
                >

                <button
                    class="toggle"
                    type="button"
                    data-target="new_password"
                    aria-label="Show new password"
                >
                    <i class="fa-solid fa-eye"></i>
                </button>

            </div>

            <div class="hint">
                Minimum 8 characters.
            </div>

        </div>


        <div class="field">

            <label for="confirm_password">
                Confirm New Password
            </label>

            <div class="password-wrap">

                <input
                    id="confirm_password"
                    name="confirm_password"
                    type="password"
                    minlength="8"
                    required
                    autocomplete="new-password"
                >

                <button
                    class="toggle"
                    type="button"
                    data-target="confirm_password"
                    aria-label="Show confirmation password"
                >
                    <i class="fa-solid fa-eye"></i>
                </button>

            </div>

        </div>


        <button class="submit" type="submit">

            <i class="fa-solid fa-lock"></i>

            Change Password

        </button>

    </form>


    <a class="back" href="dashboard.php">
        ← Back to dashboard
    </a>

</section>

</main>


<script>

document.querySelectorAll('.toggle').forEach(button => {

    button.addEventListener('click', () => {

        const input =
            document.getElementById(button.dataset.target);

        const icon =
            button.querySelector('i');

        const showing =
            input.type === 'text';

        input.type =
            showing ? 'password' : 'text';

        icon.classList.toggle(
            'fa-eye',
            showing
        );

        icon.classList.toggle(
            'fa-eye-slash',
            !showing
        );

    });

});

</script>

</body>
</html>