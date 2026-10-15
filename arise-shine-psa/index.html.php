<?php
require __DIR__ . '/config/database.php';
$products = $pdo->query('SELECT * FROM products ORDER BY created_at DESC')->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Arise & Shine Digital World | Official Portfolio</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<style>

*{
    box-sizing:border-box;
    margin:0;
    padding:0;
}

html{
    scroll-behavior:smooth;
}

body{
    font-family:Poppins,sans-serif;
    background:#f2f3f7;color:#111;
    line-height:1.6;
}
header{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:68px;
    background:#0508d0;
    z-index:1000;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:10px 5%;
    box-shadow:0 3px 15px #0002;
}

.logo img{
    width:46px;
    height:46px;
    border-radius:50%;
    object-fit:cover;
}

.nav-links{
    display:flex;
    gap:25px;
}

.nav-links a{
    color:#fff;
    text-decoration:none;
    font-weight:600;
}

.hamburger{
    display:none;
    flex-direction:column;
    gap:5px;cursor:pointer;
}

.hamburger span{
    width:28px;
    height:3px;
    background:#fff;
    border-radius:5px;
}

.hero{
    min-height:430px;
    padding:145px 20px 80px;
    text-align:center;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    background:linear-gradient(#fff9,#fff9),url('image picture.png') center/cover;
}

.hero h1{
    font-size:clamp(2rem,5vw,3.2rem);
    color:#0508d0
}

.hero p{
    font-size:1.05rem;
}

.container{
    width:min(1100px,92%);
    margin:auto;padding:70px 0;
}

.container h2{
    text-align:center;
    margin-bottom:35px;
    font-size:2rem;
}

.about{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:35px;align-items:center;
}

.about img{
    width:100%;
    border-radius:18px;
}

.services,.products{
    display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));
    gap:20px;
}

.service,.product{
    background:#fff;
    border-radius:16px;overflow:hidden;
    box-shadow:0 5px 18px #0001;
    transition:.3s;
}

.service{
    padding:25px;text-align:center;
}

.service:hover,.product:hover{
    transform:translateY(-6px);
    box-shadow:0 10px 25px #0508d044}.product img{width:100%;
    height:190px;object-fit:cover;
}

.product-info{
    padding:20px;
}

.order-box{
    max-width:650px;
    margin:40px auto 0;
    background:#fff;
    padding:30px;
    border-radius:18px;
    box-shadow:0 5px 20px #0001;
}

.order-grid{
    display:grid;
    grid-template-columns:1fr 1fr;gap:18px;
}

.form-group{
    margin-bottom:18px;
}

.form-group.full{
    grid-column:1/-1;
}

.form-group label{
    display:block;
    font-weight:600;margin-bottom:7px;
}

.form-group input,.form-group select,.form-group textarea{
    width:100%;
    padding:13px;
    border:1px solid #ccc;
    border-radius:10px;font:inherit;
}

.form-group textarea{
    height:120px;
    resize:vertical;
}

.submit-btn{
    width:100%;
    padding:14px;
    border:0;
    border-radius:10px;
    background:#0508d0;
    color:#fff;
    font:600 1rem Poppins;
    cursor:pointer;
}

.notice{
    padding:12px 15px;
    border-radius:10px;
    background:#e8ffe9;
    color:#0000;
    margin-bottom:20px;
}


.stats{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}

.stat{
    background:#0508d0;
    color:#fff;
    padding:25px;
    text-align:center;
    border-radius:15px;
}

.stat h3{
    font-size:2.3rem;
}

.reviews{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}

.review{
    background:#fff;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 18px #0001;
}

.stars{
    margin-bottom:12px;
}

.stars i{
    color:#0508d0;
}

footer{
    background:#0508d0;
    color:#fff;
    text-align:center;padding:35px 20px;
}

.contact-icons{
    display:flex;
    justify-content:center;
    gap:15px;
    margin:15px 0;
}

.contact-icons a{
    width:48px;height:48px;border-radius:50%;
    display:grid;
    place-items:center;
    color:#fff;
    text-decoration:none;
}

.email{
    background:#007bff;
}

.whatsapp{
    background:#25d366;
}

.facebook{
    background:#1877f2;
}

.x{
    background:#000;
}


@media(max-width:768px){
    header{height:62px}
    .nav-links{position:fixed;
    top:62px;
    right:-100%;
    width:260px;height:calc(100vh - 62px);
    background:#0508d0;
    display:flex;
    flex-direction:column;
    padding:30px 25px;
    gap:18px;
    transition:.3s}.nav-links.active{right:0}
    .hamburger{display:flex}
    .about,.order-grid,.reviews,.stats{grid-template-columns:1fr}
    .container{padding:55px 0}
    .hero{min-height:390px;padding-top:120px}
    .order-box{padding:22px}
}

</style>


</head>
<body>
<header>
    <div class="logo">
        <img src="my image/logo.png" alt="Arise & Shine logo">
    </div>
    <nav>
        <div class="hamburger" id="hamburger">
            <span></span><span></span><span></span>
        </div>
        <div class="nav-links" id="navLinks">
        <a href="#about">About</a>
        <a href="#services">Services</a>
        <a href="#products">Orders</a>
        <a href="#reviews">Reports</a>
        <a href="#contact">Contact</a>
    </div>
    </nav>
</header>

<section class="hero">
    <h1>Arise & Shine Digital World</h1>
    <p>Innovative Digital Solutions | Cyber Cafe | Tech Consulting</p>
</section>

<section id="about" class="container">
    <h2>About Me</h2><div class="about">
        <p>Arise & Shine Digital World is a forward-thinking digital company
            dedicated to delivering modern, responsive, and scalable technology
            solutions. We help businesses and individuals transform ideas into
            powerful digital products through innovation, creativity, and technical
            excellence.</p>
            <img src="">
    </div>
</section>

<section id="services" class="container">
    <h2>Services</h2>
<div class="services">
    <div class="service">Company Registration</div
    ><div class="service">Banner Making</div>
    <div class="service">Plastic NIN</div
    ><div class="service">Job Application</div>
    <div class="service">Skills Acquisition</div>
    <div class="service">NSUK Direct Payment</div>
    <div class="service">2 Min Passport</div>
    <div class="service">PowerPoint</div>
</div>
</section>

<section id="products" class="container">
    <h2>Order Our Goods</h2>
    <p style="text-align:center;margin-bottom:25px">
        Choose a product and send us your order.
    </p>
    <div class="products"><?php if (!$products): ?>
        <div class="service" style="grid-column:1/-1">
            No products have been uploaded yet. Admin can add them from the dashboard.
        </div>
        <?php else: foreach($products as $product): ?>
            <article class="product">
                <img src="uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                <div class="product-info">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p><?= htmlspecialchars($product['description']) ?></p>
                </div>
            </article><?php endforeach; endif; ?>
        </div>
<div class="order-box">
    <h2 style="font-size:1.5rem;margin-bottom:20px">Place Your Order</h2>
    <?php if(isset($_GET['success'])): ?>
        <div class="notice">
            Your order was submitted successfully. We will contact you soon.
        </div>
        <?php endif; ?>  <form action="submit_order.php" method="POST">
            <div class="order-grid">
                <div class="form-group">
                    <label>Full Name</label>
                    <input name="full_name" type="text" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input name="phone" type="tel" inputmode="tel" required>
                </div>
                <div class="form-group">
                    <label>Location / Address</label>
                    <input name="address" type="text" required>
                </div>
                <div class="form-group">
                    <label>Product</label>
                <select name="product" required>
                    <option value="">Select a product</option>
                    <?php foreach($products as $product): ?>
                        <option value="<?= htmlspecialchars($product['name']) ?>">
                            <?= htmlspecialchars($product['name']) ?>
                        </option><?php endforeach; ?>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input name="quantity" type="number" min="1" value="1" required>
                </div>
                <div class="form-group full">
                    <label>What do you want to order?</label>
                    <textarea name="message" placeholder="Add details about your order..." required></textarea>
                </div>
            </div>
            <button class="submit-btn" type="submit">Submit Order</button>
        </form>
    </div>
</section>

<section id="reviews" class="container">
    <h2>Customers Reports</h2>
    <div class="reviews">
        <div class="review">
            <div class="stars">★★★★★</div>
            <p>
                I feel excited doing business with this company. I will like to connect more people with the company.
            </p>
            <b>John Cynthia</b>  <small> — Event Manager</small>
        </div>
            <div class="review">
            <div class="stars">★★★★★</div>
            <p>
                This company is one of the best. I feel comfortable doing business transactions with them.
            </p>
            <b>Ahmed Musa</b>  <small> — School Principal</small>
        </div>
        <div class="review">
            <div class="stars">★★★★★</div>
            <p>
                This company is trustworthy and I can rely on their goods and products. They deliver good and clean work.
            </p>
            <b>Thomas Paul</b>  <small> — Event Planner</small>
        </div>
    </div>
</section>

<section class="container">
    <div class="stats">
        <div class="stat">
            <h3>+540</h3>
            <p>Goods Delivered Successfully</p>
        </div>
        <div class="stat">
            <h3>+1</h3>
            <p>Society Rating</p>
        </div>
        <div class="stat">
            <h3>+467</h3>
            <p>Work Done Successfully</p>
        </div>
    </div>
</section>

<footer id="contact">
    <h3>Contact</h3>
    <div class="contact-icons">
        <a class="email" href="mailto:idowup467@gmail.com">
            <i class="fa-solid fa-envelope"></i>
        </a>
        <a class="whatsapp" href="https://wa.me/2348167956341">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <a class="facebook" href="#">
            <i class="fa-brands fa-facebook-f"></i>
        </a>
        <a class="x" href="#">
            <i class="fa-brands fa-x-twitter"></i>
        </a>
    </div>
    <p>Angwa Lambu Phase 1, opposite Central Mosque <br> by Keffi University, Nasarawa State</p> <br>
    <p>© 2026 Arise & Shine Digital World. All Rights Reserved.</p>
</footer>
<script>
const
hamburger=document.getElementById('hamburger'),navLinks=document.getElementById('navLinks');
hamburger.addEventListener('click',()=>navLinks.classList.toggle('active'));
document.querySelectorAll('.nav-links a').forEach(a=>a.addEventListener('click',()=>navLinks.classList.remove('active')));
</script>
</body>
</html>
