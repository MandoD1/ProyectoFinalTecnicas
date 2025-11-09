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
                background: linear-gradient(120deg, #8a2be2, #6c63ff);
                color: #fff;
                overflow-x: hidden;
            }

            nav {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1rem 8%;
                background: linear-gradient(90deg, #6a11cb, #8a2be2);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
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
                width: 35px;
                height: auto;
            }

            nav .logo span {
                font-size: 1.6rem;
                font-weight: 700;
                color: #fff;
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
                transition: 0.3s;
            }

            nav ul li a:hover {
                color: #ffd700;
            }

            .spacer {
                height: 80px;
            }

            @media (max-width: 768px) {
                nav {
                    flex-direction: column;
                    text-align: center;
                }

                nav ul {
                    margin-top: 0.8rem;
                }
            }

            #hero {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: center;
                min-height: 100vh;
                padding: 7rem 8% 3rem;
            }

            .hero-text {
                max-width: 600px;
            }

            .hero-text h1 {
                font-size: 3rem;
                font-weight: 700;
                margin-bottom: 1rem;
                line-height: 1.2;
            }

            .hero-text p {
                font-size: 1.1rem;
                margin-bottom: 2rem;
            }

            .hero-text a {
                display: inline-block;
                background-color: #ffd700;
                color: #333;
                padding: 0.9rem 2rem;
                border-radius: 30px;
                text-decoration: none;
                font-weight: 600;
                transition: 0.3s;
            }

            .hero-text a:hover {
                background-color: #fff;
                color: #8a2be2;
            }

            .hero-img img {
                width: 550px;
                animation: float 3s ease-in-out infinite;
            }

            @keyframes float {
                0%, 100% {
                    transform: translateY(0);
                }
                50% {
                    transform: translateY(-15px);
                }
            }

            footer {
                text-align: center;
                padding: 1.5rem 0;
                background: rgba(0, 0, 0, 0.2);
                font-size: 0.9rem;
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
            <li><a href="Contactos.php">Contactos</a></li>
        </ul>
    </nav>

    <section id="hero">
    </section>

    <footer>
        © 2025 PsicologosFX - Todos los derechos reservados.
    </footer>

    </body>
    </html>
