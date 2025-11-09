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

        .spacer {
            height: 80px;
        }

        #hero {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            min-height: 100vh;
            padding: 8rem 10% 4rem;
        }

        .hero-text {
            max-width: 600px;
            line-height: 1.7;
        }

        .hero-text h1 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #fff;
            text-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .hero-text p {
            font-size: 1.05rem;
            margin-bottom: 2.2rem;
            color: #f1f1f1;
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .hero-text a {
            display: inline-block;
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

        .hero-img img {
            width: 500px;
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
            background: rgba(0, 0, 0, 0.2);
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

            .hero-img img {
                margin-top: 2rem;
                width: 300px;
            }

            .hero-text p {
                text-align: justify;
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
        <li><a href="Contactos.php">Contactos</a></li>
    </ul>
</nav>

<section id="hero">
    <div class="hero-text">
        <h1>Importancia de la salud mental</h1>
        <p>
            La salud mental es un estado de bienestar mental que tiene un valor fundamental al ser un derecho humano.
            <br><br>
            La salud mental es un proceso que cada persona experimenta de una manera diferente, donde, factores personales, familiares, comunitarios y/o estructurales moldean a la misma.
            <br><br>
            Las afecciones de salud mental comprenden los trastornos mentales y las discapacidades psicosociales, así como otros estados mentales asociados a un alto grado de angustia, discapacidad funcional o riesgo de conducta autolesiva.
            <br><br>
            Las afecciones mentales pueden tratarse con eficacia, y buscar ayuda profesional
            es un paso valiente hacia tu bienestar emocional.
        </p>
        <a href="test.php">Realizar Test</a>
    </div>

    <div class="hero-img">
        <img src="https://cdni.iconscout.com/illustration/premium/thumb/joven-consultando-con-un-psiquiatra-illustration-svg-download-png-4609834.png" alt="Psicologo Online">
    </div>
</section>

<footer>
    © 2025 <span>PsicologosFX</span> — Todos los derechos reservados.
</footer>

</body>
</html>
