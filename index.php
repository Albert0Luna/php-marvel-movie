<?php
const API_URL = "https://whenisthenextmcufilm.com/api";
# Inicializar una nueva sesión de cURL; ch = cURL HANDLE
$ch = curl_init(API_URL);
//Indicar que queremos recibir el resultado de la petición y no mostrarla en pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Ejecutar la petición y guardar el resultado
 $result = curl_exec($ch);
 $data = json_decode($result, true);
 curl_close($ch);

 // Si solo quieres hacer un GET a una api
// $result = file_get_contents(API_URL);
?>

<head>
    <title>Próximas Películas de Marvel | MCU</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<main>
    <div class="container">
        <header>
            <h2 class="subtitle">🎬 Marvel Cinematic Universe</h2>
            <h1 class="main-title">Próxima Película</h1>
        </header>

        <section class="movie-card">
            <div class="poster-container">
                <img src="<?= $data["poster_url"] ?>" class="poster" alt="Poster de <?= $data["title"]?>" />
                <div class="poster-shadow"></div>
            </div>

            <div class="movie-info">
                <h3 class="movie-title"><?= $data["title"] ?></h3>
                <div class="release-date">
                    <span class="label">Fecha de estreno</span>
                    <span class="date"><?= $data["release_date"]?></span>
                </div>

                <div class="days-until">
                    <span class="days-number"><?= $data["days_until"]?></span>
                    <span class="days-text">días restantes</span>
                </div>
            </div>
        </section>

        <section class="next-production">
            <p class="next-label">Después viene...</p>
            <p class="next-title"><?= $data["following_production"]["title"]?></p>
        </section>
    </div>
</main>
</body>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        color-scheme: dark;
        --bg-primary: #0a0e27;
        --bg-secondary: #141b3d;
        --bg-card: #1a2147;
        --accent-red: #e62429;
        --accent-gold: #ffd700;
        --text-primary: #ffffff;
        --text-secondary: #b8c5d6;
        --shadow-color: rgba(230, 36, 41, 0.3);
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(230, 36, 41, 0.05) 0%, transparent 70%);
        animation: pulse 15s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    .container {
        max-width: 600px;
        width: 100%;
        position: relative;
        z-index: 1;
    }

    header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .subtitle {
        color: var(--accent-red);
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 0.5rem;
    }

    .main-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 3.5rem;
        color: var(--text-primary);
        letter-spacing: 3px;
        text-transform: uppercase;
        background: linear-gradient(90deg, var(--accent-red) 0%, var(--accent-gold) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .movie-card {
        background: var(--bg-card);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .movie-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 70px var(--shadow-color);
    }

    .poster-container {
        position: relative;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .poster {
        width: 280px;
        max-width: 100%;
        border-radius: 12px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
        transition: transform 0.3s ease;
        position: relative;
        z-index: 2;
    }

    .poster:hover {
        transform: scale(1.05);
    }

    .poster-shadow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 280px;
        height: 100%;
        background: linear-gradient(135deg, var(--accent-red), var(--accent-gold));
        border-radius: 12px;
        filter: blur(30px);
        opacity: 0.3;
        z-index: 1;
    }

    .movie-info {
        text-align: center;
    }

    .movie-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 2rem;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        letter-spacing: 1px;
    }

    .release-date {
        background: rgba(230, 36, 41, 0.1);
        border: 1px solid var(--accent-red);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .label {
        color: var(--text-secondary);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .date {
        color: var(--accent-red);
        font-size: 1.3rem;
        font-weight: 700;
    }

    .days-until {
        display: flex;
        align-items: baseline;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .days-number {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 3rem;
        color: var(--accent-gold);
        line-height: 1;
    }

    .days-text {
        color: var(--text-secondary);
        font-size: 1rem;
    }

    .next-production {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        backdrop-filter: blur(10px);
    }

    .next-label {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .next-title {
        color: var(--text-primary);
        font-size: 1.3rem;
        font-weight: 700;
    }

    @media (max-width: 480px) {
        .main-title {
            font-size: 2.5rem;
        }

        .movie-card {
            padding: 1.5rem;
        }

        .poster {
            width: 220px;
        }

        .movie-title {
            font-size: 1.5rem;
        }

        .days-number {
            font-size: 2.5rem;
        }
    }
</style>