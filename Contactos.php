<?php
require_once __DIR__ . '/../config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PsicologosFX</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #8a2be2, #6c63ff);
            color: #f8f9ff;
            overflow-x: hidden;
        }

        /* ---------------- NAV ---------------- */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 8%;
            background: rgba(50, 0, 120, 0.4);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 100;
        }

        nav .logo {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        nav .logo img {
            width: 40px;
            height: auto;
        }

        nav .logo span {
            font-size: 1.6rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 1px;
        }

        nav ul {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        nav ul li a:hover {
            color: #ffd700;
            transform: scale(1.05);
        }

        /* ---------------- HERO ---------------- */
        #hero {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            min-height: 100vh;
            padding: 9rem 8% 4rem;
            gap: 3rem;
        }

        .hero-text {
            flex: 1 1 60%;
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.2);
        }

        .hero-text h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            color: #fff;
        }

        /* ---------------- CARD DE ESPECIALISTA ---------------- */
        .expert-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .expert-card:hover {
            transform: scale(1.03);
            background: rgba(255, 255, 255, 0.2);
        }

        .expert-card img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ffd700;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }

        .expert-info h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.2rem;
            color: #fff;
        }

        .expert-info p {
            font-size: 0.95rem;
            color: #eaeaea;
        }

        .hero-text a {
            display: block;
            width: fit-content;
            margin: 2rem auto 0;
            background-color: #ffd700;
            color: #333;
            padding: 0.9rem 2rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .hero-text a:hover {
            background-color: #fff;
            color: #8a2be2;
            transform: scale(1.05);
        }

        .hero-img {
            flex: 1 1 35%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-img img {
            width: 210px;
            animation: float 3s ease-in-out infinite;
            filter: drop-shadow(0 5px 10px rgba(0,0,0,0.3));
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        footer {
            text-align: center;
            padding: 1.5rem 0;
            background: rgba(0, 0, 0, 0.25);
            font-size: 0.9rem;
            color: #e0e0e0;
        }

        footer span {
            color: #ffd700;
            font-weight: 600;
        }

        @media (max-width: 900px) {
            #hero {
                flex-direction: column;
                text-align: center;
            }

            .hero-text {
                width: 100%;
            }

            .hero-img img {
                margin-top: 2rem;
                width: 250px;
            }
        }
    </style>
</head>
<body>

<nav>
    <div class="logo">
        <img src="https://www2.ucsm.edu.pe/wp-content/uploads/2021/11/Psicologia.png" alt="Logo Psicologia">
        <span>PsicologosFX</span>
    </div>
    <ul>
        <li><a href="PP.php">Inicio</a></li>
        <li><a href="Problema.php">Problemática</a></li>
    </ul>
</nav>

<section id="hero">
    <div class="hero-text">
        <h1>Expertos que te recomendamos</h1>

        <div class="expert-card">
            <img src="https://tse3.mm.bing.net/th/id/OIP.g0YAUNeOPMOE7sS_xSO2vgHaHa?cb=ucfimg2ucfimg=1&w=940&h=940&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Juanito Alcachofa">
            <div class="expert-info">
                <h3>Juanito Alcachofa</h3>
                <p>Psicólogo especialista<br><strong>+57 314 3909521</strong></p>
            </div>
        </div>

        <div class="expert-card">
            <img src="https://i.pinimg.com/originals/77/b4/88/77b488880d5d87aded21efb2225daec2.jpg" alt="Armando Ando">
            <div class="expert-info">
                <h3>Armando Ando</h3>
                <p>Psicólogo social<br><strong>+57 319 3959552</strong></p>
            </div>
        </div>

        <div class="expert-card">
            <img src="https://cdn-icons-png.flaticon.com/512/7081/7081364.png" alt="Elza Pato">
            <div class="expert-info">
                <h3>Elza Pato</h3>
                <p>Psicóloga cognitiva y del desarrollo<br><strong>+57 320 9017365</strong></p>
            </div>
        </div>


    </div>

    <div class="hero-img">
        <img src="https://static.vecteezy.com/system/resources/previews/021/360/181/non_2x/doctor-character-illustration-free-png.png" alt="Psicologo Online">
    </div>
</section>

<footer>
    © 2025 <span>PsicologosFX</span> — Todos los derechos reservados.
</footer>

</body>
</html>
