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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #8a2be2, #6c63ff);
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
            top: 0; left: 0;
            z-index: 100;
        }

        nav .logo {
            display: flex; align-items: center; gap: 0.8rem;
        }

        nav .logo img { width: 35px; height: auto; }

        nav .logo span {
            font-size: 1.6rem; font-weight: 700; color: #fff;
        }

        nav ul {
            display: flex; gap: 2rem; list-style: none;
        }

        nav ul li a {
            color: #fff; text-decoration: none; font-weight: 500; transition: 0.3s;
        }

        nav ul li a:hover { color: #ffd700; }

        #hero {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            min-height: 100vh;
            padding: 8rem 8% 3rem;
        }

        .card {
            background-color: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        h3 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        label {
            color: #fff;
            margin-top: 0.8rem;
        }

        .btn-custom {
            background-color: #ffd700;
            color: #333;
            font-weight: 600;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
        }

        .btn-custom:hover {
            background-color: #fff;
            color: #8a2be2;
        }

        footer {
            text-align: center;
            padding: 1.5rem 0;
            background: rgba(0, 0, 0, 0.2);
            font-size: 0.9rem;
        }

        /* Estilo del pop-up */
        .modal-content {
            background: rgba(50, 0, 90, 0.9);
            color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.5);
        }
        .modal-header, .modal-footer {
            border: none;
        }
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.6);
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
        <li><a href="index.php">Inicio</a></li>
        <li><a href="Problema.php">Problemática</a></li>
        <li><a href="Contactos.php">Contactos</a></li>
    </ul>
</nav>

<section id="hero">
    <div class="container mt-5">
        <h3>Predicción con Modelo de Texto Recurrente (LSTM)</h3>
        <p>Escribe cinco frases que describan tus pensamientos o emociones actuales.
            El modelo analizará tu texto y mostrará una predicción.</p>

        <div class="card mt-4">
            <form id="formPrediccion">
                <div class="form-group"><label>Frase 1</label><input type="text" class="form-control" name="frase1" required></div>
                <div class="form-group"><label>Frase 2</label><input type="text" class="form-control" name="frase2" required></div>
                <div class="form-group"><label>Frase 3</label><input type="text" class="form-control" name="frase3" required></div>
                <div class="form-group"><label>Frase 4</label><input type="text" class="form-control" name="frase4" required></div>
                <div class="form-group"><label>Frase 5</label><input type="text" class="form-control" name="frase5" required></div>

                <button type="submit" class="btn-custom mt-3">Predecir</button>

                <div class="text-center mt-4">
                    <button type="button" onclick="window.history.back()" class="btn btn-light text-primary">
                        Volver
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Modal de resultado -->
<div class="modal fade" id="resultadoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Resultado del análisis</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="resultadoTexto"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning text-dark" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<footer>
    © 2025 PsicologosFX - Todos los derechos reservados.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById("formPrediccion").addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);

        try {
            const res = await fetch("api/auxi.php", { method: "POST", body: formData });
            const txt = await res.text();
            console.log("Respuesta cruda:", txt);
            const data = JSON.parse(txt);

            if (data.error) {
                alert("Error en Python: " + data.error);
                return;
            }

            const prob = (typeof data.probabilidad === "number" && !isNaN(data.probabilidad))
                ? data.probabilidad.toFixed(3)
                : "0.000";

            const texto = data.resultado == 1
                ? `✅ El modelo interpreta un estado emocional <b>positivo</b> (${prob}).`
                : `⚠️ El modelo detecta posibles indicadores de <b>estrés</b> (${prob}).`;

            document.getElementById("resultadoTexto").innerHTML = texto;

            const modal = new bootstrap.Modal(document.getElementById("resultadoModal"));
            modal.show();

        } catch (err) {
            alert("Error en la predicción: " + err);
            console.error(err);
        }
    });
</script>

</body>
</html>
