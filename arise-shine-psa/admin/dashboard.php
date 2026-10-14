<?php
require __DIR__ . '/../config/auth.php'; require_admin(); require __DIR__ . '/../config/database.php';
$products=(int)$pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();$orders=(int)$pdo->query('SELECT COUNT(*) FROM orders')->fetchColumn();$pending=(int)$pdo->query("SELECT COUNT(*) FROM orders WHERE status='Pending'")->fetchColumn();
$latest=$pdo->query('SELECT * FROM orders ORDER BY created_at DESC LIMIT 8')->fetchAll();
?>
<!doctype html>
<html>
    <head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard</title>

    
    <style>

    *{box-sizing:border-box}body{margin:0;font-family:Poppins,Arial,sans-serif;background:#f4f6f8;color:#111}
    .top{background:#0508d0;color:#fff;padding:18px 5%;display:flex;justify-content:space-between;align-items:center}
    .top a{color:#fff;text-decoration:none;background:#0003;padding:8px 14px;border-radius:8px}
    .wrap{width:min(1150px,92%);margin:30px auto}.cards{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
    .card{background:#fff;padding:25px;border-radius:15px;box-shadow:0 4px 15px #0001}.card h2{font-size:2rem;color:#0508d0;margin:0}
    .actions{display:flex;gap:15px;margin:25px 0;flex-wrap:wrap}.btn{background:#0508d0;color:#fff;text-decoration:none;padding:12px 18px;border-radius:9px}
    .tablebox{background:#fff;padding:20px;border-radius:15px;overflow:auto}table{width:100%;border-collapse:collapse;min-width:700px}
    th,td{padding:12px;border-bottom:1px solid #eee;text-align:left}
    th{background:#f4f6f8}@media(max-width:700px){.cards{grid-template-columns:1fr}.top{gap:10px}.top h2{font-size:1rem}}

    </style>

    </head>
    <body>
        <header class="top">
            <h2>Arise & Shine Admin</h2>
            <a href="logout.php">Logout</a>
        </header>
        <main class="wrap">
            <div class="cards">
                <div class="card">
                    <p>Products / Images</p>
                    <h2><?=$products?></h2>
                </div>
                <div class="card">
                    <p>Total Orders</p>
                    <h2><?=$orders?></h2>
                </div><div class="card"
                ><p>Pending Orders</p>
                <h2><?=$pending?></h2>
            </div>
        </div>
        <div class="actions">
            <a class="btn" href="products.php">Manage Images & Products</a>
            <a class="btn" href="orders.php">View All Orders</a>
            <a class="btn" href="../index.php">View Website</a>
        </div>
        <div class="tablebox">
            <h3>Latest Orders</h3>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
<?php foreach($latest as $o): ?>
    <tr>
        <td>
            <?=htmlspecialchars($o['full_name'])?>
        </td>
        <td>
            <?=htmlspecialchars($o['product'])?>
        </td>
        <td>
            <?=$o['quantity']?>
        </td>
        <td>
            <?=htmlspecialchars($o['status'])?>
        </td>
        <td>
            <?=htmlspecialchars($o['created_at'])?>
        </td>
    </tr>
    <?php endforeach; ?>
    </table>
</div>
</main>
</body>
</html>
