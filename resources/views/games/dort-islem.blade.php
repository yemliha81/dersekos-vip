@extends('layouts.games_layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Animasyonlu arka plan baloncukları */
        .bubbles {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .bubble {
            position: absolute;
            bottom: -100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: rise 15s infinite ease-in;
        }

        @keyframes rise {
            0% { bottom: -100px; transform: translateX(0); }
            50% { transform: translateX(100px); }
            100% { bottom: 1080px; transform: translateX(-200px); }
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Başlık Stili */
        .main-title {
            text-align: center;
            color: #fff;
            font-family: 'Fredoka One', cursive;
            font-size: 3rem;
            text-shadow: 3px 3px 0px rgba(0,0,0,0.2);
            margin-bottom: 10px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .subtitle {
            text-align: center;
            color: rgba(255,255,255,0.9);
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        /* Navigasyon Kartları */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .operation-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
        }

        .operation-card:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .operation-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: 0.5s;
        }

        .operation-card:hover::before {
            left: 100%;
        }

        .card-icon {
            font-size: 4rem;
            margin-bottom: 10px;
            display: block;
        }

        .card-title {
            font-family: 'Fredoka One', cursive;
            font-size: 1.5rem;
            color: #333;
        }

        .card-desc {
            color: #666;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        /* Kart Renkleri */
        .addition { border-top: 5px solid #FF6B6B; }
        .addition:hover { background: linear-gradient(135deg, #FF6B6B 0%, #FFE66D 100%); }
        
        .subtraction { border-top: 5px solid #4ECDC4; }
        .subtraction:hover { background: linear-gradient(135deg, #4ECDC4 0%, #44A08D 100%); }
        
        .multiplication { border-top: 5px solid #A8E6CF; }
        .multiplication:hover { background: linear-gradient(135deg, #A8E6CF 0%, #88D8A3 100%); }
        
        .division { border-top: 5px solid #FFD93D; }
        .division:hover { background: linear-gradient(135deg, #FFD93D 0%, #F6AD55 100%); }

        /* Oyun Alanı */
        .game-area {
            display: none;
            background: white;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .game-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .back-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            font-weight: bold;
            font-size: 1rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            background: #764ba2;
            transform: scale(1.05);
        }

        .score-board {
            display: flex;
            gap: 20px;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .score-item {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .question-box {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .question-text {
            font-family: 'Fredoka One', cursive;
            font-size: 3rem;
            color: #2d3748;
            margin: 20px 0;
            letter-spacing: 5px;
        }

        .emoji-math {
            font-size: 2rem;
            margin: 0 10px;
        }

        .answer-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .answer-input {
            font-size: 2rem;
            padding: 15px 30px;
            border: 4px solid #667eea;
            border-radius: 15px;
            text-align: center;
            width: 200px;
            font-family: 'Fredoka One', cursive;
            color: #2d3748;
            transition: all 0.3s;
        }

        .answer-input:focus {
            outline: none;
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.5);
        }

        .check-btn {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            border: none;
            padding: 15px 50px;
            font-size: 1.3rem;
            font-family: 'Fredoka One', cursive;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(17, 153, 142, 0.4);
        }

        .check-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(17, 153, 142, 0.6);
        }

        .check-btn:active {
            transform: translateY(0);
        }

        /* Sonuç Animasyonları */
        .result-message {
            font-size: 1.5rem;
            font-weight: bold;
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
            display: none;
            animation: popIn 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        @keyframes popIn {
            0% { transform: scale(0); }
            80% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .correct {
            background: #d4edda;
            color: #155724;
            border: 2px solid #c3e6cb;
        }

        .wrong {
            background: #f8d7da;
            color: #721c24;
            border: 2px solid #f5c6cb;
        }

        /* Seviye Seçimi */
        .level-selector {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .level-btn {
            padding: 10px 25px;
            border: 3px solid #667eea;
            background: white;
            color: #667eea;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
        }

        .level-btn.active, .level-btn:hover {
            background: #667eea;
            color: white;
            transform: scale(1.1);
        }

        /* İlerleme Çubuğu */
        .progress-container {
            width: 100%;
            height: 20px;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #f093fb 0%, #f5576c 100%);
            width: 0%;
            transition: width 0.5s ease;
            border-radius: 10px;
        }

        /* Konfeti Efekti */
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background: #f0f;
            position: absolute;
            animation: confetti-fall 3s linear forwards;
            z-index: 1000;
        }

        @keyframes confetti-fall {
            0% { transform: translateY(-100px) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
        }

        /* Karakter Animasyonu */
        .mascot {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 4rem;
            animation: mascot-bounce 2s infinite;
            cursor: pointer;
            z-index: 100;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.3));
        }

        @keyframes mascot-bounce {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .mascot:hover {
            animation: mascot-spin 0.5s ease;
        }

        @keyframes mascot-spin {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.2); }
            100% { transform: rotate(360deg) scale(1); }
        }

        /* Mobil Uyumluluk */
        @media (max-width: 600px) {
            .main-title { font-size: 2rem; }
            .question-text { font-size: 2rem; }
            .menu-grid { grid-template-columns: 1fr; }
            .game-area { padding: 20px; }
            .mascot { font-size: 3rem; }
        }

        /* Yıldız Animasyonu */
        .star {
            position: absolute;
            color: #FFD700;
            font-size: 1.5rem;
            animation: star-pop 1s ease-out forwards;
            pointer-events: none;
        }

        @keyframes star-pop {
            0% { transform: scale(0) rotate(0deg); opacity: 1; }
            100% { transform: scale(1.5) rotate(180deg); opacity: 0; }
        }

        /* Zorluk Rozetleri */
        .badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            margin-left: 10px;
        }

        .badge-easy { background: #A8E6CF; color: #2d5a27; }
        .badge-medium { background: #FFD93D; color: #744210; }
        .badge-hard { background: #FF6B6B; color: white; }

        /* Ses Butonu */
        .sound-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            z-index: 100;
            transition: all 0.3s;
        }

        .sound-toggle:hover {
            transform: scale(1.1);
        }
    </style>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        .content-area {
            flex: 1;
            padding: 20px;
            transition: margin-right 0.3s ease;
        }

        .content-area.canvas-active {
            margin-right: 640px;  /* ← DEĞİŞTİ: 320px → 640px */
        }

        /* KALEM MODÜLÜ - SAĞ TARAF */
        .pen-module {
            position: fixed;
            right: -640px;
            top: 0;
            width: 640px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 30px rgba(0,0,0,0.2);
            z-index: 1000;
            transition: right 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            display: flex;
            flex-direction: column;
        }

        .pen-module.open {
            right: 0;
        }

        /* Kalem Toggle Butonu */
        .pen-toggle {
            position: fixed;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
            z-index: 999;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pen-toggle:hover {
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 8px 30px rgba(0,0,0,0.4);
        }

        .pen-toggle.active {
            background: #e53e3e;
            right: 660px;         /* ← DEĞİŞTİ: 340px → 660px (640 + 20px boşluk) */

        }

        .pen-toggle.active i {
            transform: rotate(180deg);
        }

        /* Kalem Modülü Başlık */
        .pen-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .pen-title {
            font-family: 'Fredoka One', cursive;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .close-pen {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.2);
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            font-size: 1.2rem;
            transition: all 0.3s;
        }

        .close-pen:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-50%) rotate(90deg);
        }

        /* Araçlar Paneli */
        .pen-tools {
            padding: 20px;
            background: #f7fafc;
            border-bottom: 2px solid #e2e8f0;
        }

        .tool-section {
            margin-bottom: 20px;
        }

        .tool-label {
            font-size: 0.85rem;
            font-weight: bold;
            color: #4a5568;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Renk Seçici */
        .color-picker {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .color-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 3px solid transparent;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .color-btn:hover {
            transform: scale(1.15);
        }

        .color-btn.active {
            border-color: #2d3748;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
        }

        .color-btn.active::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-weight: bold;
            text-shadow: 0 1px 3px rgba(0,0,0,0.5);
        }

        .color-black { background: #1a202c; }
        .color-white { background: #ffffff; border: 2px solid #cbd5e0; }
        .color-blue { background: #3182ce; }
        .color-red { background: #e53e3e; }

        .color-white.active::after {
            color: #1a202c;
            text-shadow: none;
        }

        /* Kalınlık Seçici */
        .thickness-picker {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        .thickness-btn {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 15px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            min-width: 60px;
        }

        .thickness-btn:hover {
            border-color: #667eea;
            transform: translateY(-2px);
        }

        .thickness-btn.active {
            background: #667eea;
            border-color: #667eea;
            color: white;
        }

        .thickness-line {
            background: currentColor;
            border-radius: 2px;
            transition: all 0.3s;
        }

        .thickness-btn.active .thickness-line {
            background: white;
        }

        /* Canvas Alanı */
        .canvas-container {
            flex: 1;
            position: relative;
            background: #fff;
            overflow: hidden;
        }

        #drawingCanvas {
            position: absolute;
            top: 0;
            left: 0;
            cursor: crosshair;
            touch-action: none;
        }

        /* Canvas Arkaplanı - Kareli Kağıt Efekti */
        .canvas-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(#e2e8f0 1px, transparent 1px),
                linear-gradient(90deg, #e2e8f0 1px, transparent 1px);
            background-size: 20px 20px;
            pointer-events: none;
        }

        /* Canvas Araç Çubuğu */
        .canvas-toolbar {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            padding: 10px 20px;
            border-radius: 50px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .canvas-btn {
            background: none;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            color: #4a5568;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .canvas-btn:hover {
            background: #edf2f7;
            color: #667eea;
            transform: scale(1.1);
        }

        .canvas-btn.clear {
            color: #e53e3e;
        }

        .canvas-btn.clear:hover {
            background: #fed7d7;
        }

        .canvas-btn.undo {
            color: #3182ce;
        }

        .canvas-btn.undo:hover {
            background: #bee3f8;
        }

        .canvas-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        /* Silgi Modu */
        .eraser-mode {
            background: #fed7d7 !important;
            color: #c53030 !important;
        }

        /* Boyut Göstergesi */
        .size-indicator {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255,255,255,0.9);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            color: #4a5568;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* Mobil Uyumluluk */
        @media (max-width: 768px) {
            .pen-module {
                width: 100%;
                right: -100%;
            }
            
            .pen-toggle.active {
                right: 20px;
                top: 20px;
                transform: none;
            }
            
            .content-area.canvas-active {
                margin-right: 0;
            }
        }

        /* Animasyonlar */
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .drawing {
            animation: pulse 0.3s ease;
        }
    </style>
    <!-- Arka Plan Baloncukları -->
    <div class="bubbles" id="bubbles"></div>

    <!-- Ses Butonu -->
    <!--<button class="sound-toggle" id="soundToggle">🔊</button>-->

    <!-- Maskot -->
    <div class="mascot" id="mascot">🦊</div>

    <div class="container">
        <!-- Ana Menü -->
        <div id="mainMenu">
            <h1 class="main-title">🌈 Matematik Macerası</h1>
            <p class="subtitle">3-4. Sınıf için Eğlenceli Matematik Oyunu</p>
            
            <div class="menu-grid">
                <div class="operation-card addition" data-op="addition">
                    <span class="card-icon">➕</span>
                    <div class="card-title">Toplama</div>
                    <div class="card-desc">Sayıları birleştir!</div>
                </div>
                
                <div class="operation-card subtraction" data-op="subtraction">
                    <span class="card-icon">➖</span>
                    <div class="card-title">Çıkarma</div>
                    <div class="card-desc">Sayıları ayır!</div>
                </div>
                
                <div class="operation-card multiplication" data-op="multiplication">
                    <span class="card-icon">✖️</span>
                    <div class="card-title">Çarpma</div>
                    <div class="card-desc">Grup oluştur!</div>
                </div>
                
                <div class="operation-card division" data-op="division">
                    <span class="card-icon">➗</span>
                    <div class="card-title">Bölme</div>
                    <div class="card-desc">Eşit paylaş!</div>
                </div>
            </div>
        </div>

        <!-- Oyun Alanı -->
        <div id="gameArea" class="game-area">
            <div class="game-header">
                <button class="back-btn" id="backBtn">← Menüye Dön</button>
                <div class="score-board">
                    <div class="score-item">⭐ <span id="score">0</span></div>
                    <div class="score-item">🔥 <span id="streak">0</span></div>
                </div>
            </div>

            <div class="progress-container">
                <div class="progress-bar" id="progressBar"></div>
            </div>

            <div class="level-selector">
                <button class="level-btn active" data-level="easy">Kolay <span class="badge badge-easy">🌱</span></button>
                <button class="level-btn" data-level="medium">Orta <span class="badge badge-medium">🌿</span></button>
                <button class="level-btn" data-level="hard">Zor <span class="badge badge-hard">🌳</span></button>
            </div>

            <div class="question-box">
                <div id="questionEmoji" style="font-size: 3rem; margin-bottom: 10px;">🤔</div>
                <div class="question-text" id="questionText">Hazır mısın?</div>
                <div id="visualAid" style="margin-top: 20px; font-size: 2rem;"></div>
            </div>

            <div class="answer-section">
                <input type="number" class="answer-input" id="answerInput" placeholder="?" autocomplete="off">
                <button class="check-btn" id="checkBtn">Kontrol Et! 🚀</button>
                <div class="result-message" id="resultMessage"></div>
            </div>
        </div>


        <button class="pen-toggle" id="penToggle" title="Kalem Modülünü Aç/Kapat">
            <i class="fas fa-pen"></i>
        </button>

        <div class="pen-module" id="penModule">
            <!-- Başlık -->
            <div class="pen-header">
                <div class="pen-title">
                    <i class="fas fa-pencil-alt"></i>
                    Not Defteri
                </div>
                <button class="close-pen" id="closePen" title="Kapat">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Araçlar -->
            <div class="pen-tools">
                <!-- Renk Seçici -->
                <div class="tool-section">
                    <div class="tool-label">
                        <i class="fas fa-palette"></i>
                        Kalem Rengi
                    </div>
                    <div class="color-picker">
                        <button class="color-btn color-black active" data-color="#1a202c" title="Siyah"></button>
                        <button class="color-btn color-blue" data-color="#3182ce" title="Mavi"></button>
                        <button class="color-btn color-red" data-color="#e53e3e" title="Kırmızı"></button>
                        <button class="color-btn color-white" data-color="#ffffff" title="Beyaz/Silgi"></button>
                    </div>
                </div>

                <!-- Kalınlık Seçici -->
                <div class="tool-section">
                    <div class="tool-label">
                        <i class="fas fa-minus"></i>
                        Çizgi Kalınlığı
                    </div>
                    <div class="thickness-picker">
                        <button class="thickness-btn" data-width="3">
                            <div class="thickness-line" style="width: 30px; height: 3px;"></div>
                            <span style="font-size: 0.75rem; margin-top: 5px;">İnce</span>
                        </button>
                        <button class="thickness-btn active" data-width="5">
                            <div class="thickness-line" style="width: 30px; height: 5px;"></div>
                            <span style="font-size: 0.75rem; margin-top: 5px;">Orta</span>
                        </button>
                        <button class="thickness-btn" data-width="10">
                            <div class="thickness-line" style="width: 30px; height: 10px;"></div>
                            <span style="font-size: 0.75rem; margin-top: 5px;">Kalın</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Canvas Alanı -->
            <div class="canvas-container" id="canvasContainer">
                <div class="canvas-bg"></div>
                <canvas id="drawingCanvas"></canvas>
                
                <!-- Boyut Göstergesi -->
                <div class="size-indicator" id="sizeIndicator">
                    800 x 600
                </div>

                <!-- Canvas Toolbar -->
                <div class="canvas-toolbar">
                    <button class="canvas-btn undo" id="undoBtn" title="Geri Al" disabled>
                        <i class="fas fa-undo"></i>
                    </button>
                    <button class="canvas-btn clear" id="clearBtn" title="Temizle">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <button class="canvas-btn" id="downloadBtn" title="İndir">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
            </div>
        
    
        </div>

    </div>

    <script>
        $(document).ready(function() {
            // Oyun Durumu
            let currentOp = '';
            let currentLevel = 'easy';
            let score = 0;
            let streak = 0;
            let currentAnswer = 0;
            let soundEnabled = true;
            let questionCount = 0;
            const questionsPerLevel = 10;

            // Ses Efektleri (Web Audio API)
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            
            function playSound(type) {
                if (!soundEnabled) return;
                
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();
                
                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);
                
                if (type === 'correct') {
                    oscillator.frequency.setValueAtTime(523.25, audioContext.currentTime); // C5
                    oscillator.frequency.setValueAtTime(659.25, audioContext.currentTime + 0.1); // E5
                    oscillator.frequency.setValueAtTime(783.99, audioContext.currentTime + 0.2); // G5
                    gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                    gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);
                    oscillator.start(audioContext.currentTime);
                    oscillator.stop(audioContext.currentTime + 0.5);
                } else if (type === 'wrong') {
                    oscillator.frequency.setValueAtTime(200, audioContext.currentTime);
                    oscillator.frequency.linearRampToValueAtTime(100, audioContext.currentTime + 0.3);
                    gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                    gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.3);
                    oscillator.start(audioContext.currentTime);
                    oscillator.stop(audioContext.currentTime + 0.3);
                }
            }

            // Baloncuk Oluştur
            function createBubbles() {
                const bubblesContainer = $('#bubbles');
                const colors = ['rgba(255,255,255,0.1)', 'rgba(255,255,255,0.05)', 'rgba(255,255,255,0.08)'];
                
                for (let i = 0; i < 15; i++) {
                    const bubble = $('<div class="bubble"></div>');
                    const size = Math.random() * 60 + 20;
                    const left = Math.random() * 100;
                    const delay = Math.random() * 15;
                    const duration = Math.random() * 10 + 10;
                    
                    bubble.css({
                        width: size,
                        height: size,
                        left: left + '%',
                        background: colors[Math.floor(Math.random() * colors.length)],
                        animationDelay: delay + 's',
                        animationDuration: duration + 's'
                    });
                    
                    bubblesContainer.append(bubble);
                }
            }
            createBubbles();

            // Konfeti Efekti
            function createConfetti() {
                const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#ffeaa7', '#dfe6e9', '#fd79a8'];
                for (let i = 0; i < 50; i++) {
                    const confetti = $('<div class="confetti"></div>');
                    confetti.css({
                        left: Math.random() * 100 + '%',
                        background: colors[Math.floor(Math.random() * colors.length)],
                        animationDelay: Math.random() * 2 + 's',
                        transform: `rotate(${Math.random() * 360}deg)`
                    });
                    $('body').append(confetti);
                    setTimeout(() => confetti.remove(), 3000);
                }
            }

            // Yıldız Efekti
            function createStar(x, y) {
                const star = $('<div class="star">⭐</div>');
                star.css({
                    left: x,
                    top: y
                });
                $('body').append(star);
                setTimeout(() => star.remove(), 1000);
            }

            // Maskot Tıklama
            $('#mascot').click(function(e) {
                const messages = ['Harikasın! 🎉', 'Devam et! 💪', 'Sen bir matematik dehasısın! 🧠', 'Süper! ⭐'];
                const msg = messages[Math.floor(Math.random() * messages.length)];
                
                const tooltip = $(`<div style="position:fixed; bottom:100px; right:20px; background:white; padding:15px; border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.2); font-weight:bold; color:#667eea; z-index:1000; animation:slideIn 0.3s ease;">${msg}</div>`);
                $('body').append(tooltip);
                setTimeout(() => tooltip.fadeOut(() => tooltip.remove()), 2000);
                
                createStar(e.pageX, e.pageY);
            });

            // Ses Aç/Kapat
            $('#soundToggle').click(function() {
                soundEnabled = !soundEnabled;
                $(this).text(soundEnabled ? '🔊' : '🔇');
            });

            // İşlem Seçimi
            $('.operation-card').click(function() {
                currentOp = $(this).data('op');
                $('#mainMenu').hide();
                $('#gameArea').show();
                generateQuestion();
            });

            // Geri Dön
            $('#backBtn').click(function() {
                $('#gameArea').hide();
                $('#mainMenu').show();
                resetGame();
            });

            // Seviye Seçimi
            $('.level-btn').click(function() {
                $('.level-btn').removeClass('active');
                $(this).addClass('active');
                currentLevel = $(this).data('level');
                questionCount = 0;
                updateProgress();
                generateQuestion();
            });

            // Oyunu Sıfırla
            function resetGame() {
                score = 0;
                streak = 0;
                questionCount = 0;
                $('#score').text(score);
                $('#streak').text(streak);
                updateProgress();
            }

            // İlerleme Çubuğu
            function updateProgress() {
                const progress = (questionCount / questionsPerLevel) * 100;
                $('#progressBar').css('width', progress + '%');
            }

            // Soru Üret
            function generateQuestion() {
                let num1, num2, operator, symbol;
                const emojis = {
                    addition: ['🍎', '🍌', '🍇', '🍓', '🍊'],
                    subtraction: ['🎈', '🧸', '🎨', '🎮', '🎪'],
                    multiplication: ['🌟', '🌈', '🦋', '🌸', '🍄'],
                    division: ['🍪', '🍩', '🍰', '🧁', '🍭']
                };

                switch(currentOp) {
                    case 'addition':
                        operator = '+';
                        symbol = '➕';
                        if (currentLevel === 'easy') {
                            num1 = Math.floor(Math.random() * 20) + 1;
                            num2 = Math.floor(Math.random() * 20) + 1;
                        } else if (currentLevel === 'medium') {
                            num1 = Math.floor(Math.random() * 50) + 10;
                            num2 = Math.floor(Math.random() * 50) + 10;
                        } else {
                            num1 = Math.floor(Math.random() * 100) + 50;
                            num2 = Math.floor(Math.random() * 100) + 50;
                        }
                        currentAnswer = num1 + num2;
                        break;

                    case 'subtraction':
                        operator = '-';
                        symbol = '➖';
                        if (currentLevel === 'easy') {
                            num1 = Math.floor(Math.random() * 20) + 10;
                            num2 = Math.floor(Math.random() * num1);
                        } else if (currentLevel === 'medium') {
                            num1 = Math.floor(Math.random() * 50) + 20;
                            num2 = Math.floor(Math.random() * num1);
                        } else {
                            num1 = Math.floor(Math.random() * 100) + 50;
                            num2 = Math.floor(Math.random() * num1);
                        }
                        currentAnswer = num1 - num2;
                        break;

                    case 'multiplication':
                        operator = '×';
                        symbol = '✖️';
                        if (currentLevel === 'easy') {
                            num1 = Math.floor(Math.random() * 5) + 1;
                            num2 = Math.floor(Math.random() * 5) + 1;
                        } else if (currentLevel === 'medium') {
                            num1 = Math.floor(Math.random() * 8) + 2;
                            num2 = Math.floor(Math.random() * 8) + 2;
                        } else {
                            num1 = Math.floor(Math.random() * 12) + 3;
                            num2 = Math.floor(Math.random() * 12) + 3;
                        }
                        currentAnswer = num1 * num2;
                        break;

                    case 'division':
                        operator = '÷';
                        symbol = '➗';
                        if (currentLevel === 'easy') {
                            num2 = Math.floor(Math.random() * 5) + 2;
                            currentAnswer = Math.floor(Math.random() * 5) + 1;
                            num1 = num2 * currentAnswer;
                        } else if (currentLevel === 'medium') {
                            num2 = Math.floor(Math.random() * 8) + 2;
                            currentAnswer = Math.floor(Math.random() * 8) + 2;
                            num1 = num2 * currentAnswer;
                        } else {
                            num2 = Math.floor(Math.random() * 12) + 3;
                            currentAnswer = Math.floor(Math.random() * 12) + 3;
                            num1 = num2 * currentAnswer;
                        }
                        break;
                }

                // Görsel Yardım Oluştur
                const emoji = emojis[currentOp][Math.floor(Math.random() * emojis[currentOp].length)];
                let visualAid = '';
                
                if (currentOp === 'addition') {
                    visualAid = emoji.repeat(Math.min(num1, 10)) + ' ' + symbol + ' ' + emoji.repeat(Math.min(num2, 10));
                } else if (currentOp === 'multiplication') {
                    visualAid = `${emoji} × ${num2} = ${emoji.repeat(Math.min(num2, 10))} (x${num1})`;
                }

                $('#questionEmoji').text(emoji);
                $('#questionText').html(`${num1} <span class="emoji-math">${symbol}</span> ${num2} = ?`);
                $('#visualAid').text(visualAid);
                $('#answerInput').val('').focus();
                $('#resultMessage').hide();
            }

            // Cevap Kontrol
            function checkAnswer() {
                const userAnswer = parseInt($('#answerInput').val());
                
                if (isNaN(userAnswer)) {
                    $('#resultMessage').removeClass('correct wrong').addClass('wrong').text('Lütfen bir sayı gir! 🤔').show();
                    return;
                }

                if (userAnswer === currentAnswer) {
                    // Doğru Cevap
                    score += 10 + (streak * 2);
                    streak++;
                    questionCount++;
                    updateProgress();
                    
                    $('#score').text(score);
                    $('#streak').text(streak);
                    
                    $('#resultMessage').removeClass('correct wrong').addClass('correct').text('Harika! Doğru cevap! 🎉').show();
                    playSound('correct');
                    createConfetti();
                    
                    // Maskot animasyonu
                    $('#mascot').css('animation', 'none').animate({ fontSize: '5rem' }, 200).animate({ fontSize: '4rem' }, 200);
                    
                    if (questionCount >= questionsPerLevel) {
                        setTimeout(() => {
                            alert(`Tebrikler! 🏆\nSeviyeyi tamamladın!\nToplam Puan: ${score}\nSeri: ${streak}`);
                            questionCount = 0;
                            updateProgress();
                            generateQuestion();
                        }, 1000);
                    } else {
                        setTimeout(generateQuestion, 1500);
                    }
                } else {
                    // Yanlış Cevap
                    streak = 0;
                    $('#streak').text(streak);
                    
                    $('#resultMessage').removeClass('correct wrong').addClass('wrong').text(`Yanlış! Doğru cevap: ${currentAnswer} 😅`).show();
                    playSound('wrong');
                    
                    $('#questionBox').css('animation', 'shake 0.5s');
                    setTimeout(() => $('#questionBox').css('animation', ''), 500);
                }
            }

            // Enter Tuşu
            $('#answerInput').keypress(function(e) {
                if (e.which === 13) {
                    checkAnswer();
                }
            });

            $('#checkBtn').click(checkAnswer);

            // Sallama Animasyonu CSS
            $('<style>')
                .prop('type', 'text/css')
                .html(`
                    @keyframes shake {
                        0%, 100% { transform: translateX(0); }
                        25% { transform: translateX(-10px); }
                        75% { transform: translateX(10px); }
                    }
                `)
                .appendTo('head');
        });
    </script>

    <!-- Kalem -->
    <script>
        $(document).ready(function() {
            // Canvas Değişkenleri
            const canvas = document.getElementById('drawingCanvas');
            const ctx = canvas.getContext('2d');
            const container = $('#canvasContainer');
            
            let isDrawing = false;
            let currentColor = '#1a202c';
            let currentWidth = 5;
            let isEraser = false;
            let undoStack = [];
            let undoLimit = 20;

            // Canvas Boyutlandırma
            function resizeCanvas() {
                const width = container.width();
                const height = container.height();
                
                // Mevcut içeriği sakla
                const tempCanvas = document.createElement('canvas');
                const tempCtx = tempCanvas.getContext('2d');
                tempCanvas.width = canvas.width;
                tempCanvas.height = canvas.height;
                tempCtx.drawImage(canvas, 0, 0);
                
                // Yeni boyutları ayarla
                canvas.width = width;
                canvas.height = height;
                
                // İçeriği geri yükle (ortalayarak)
                ctx.drawImage(tempCanvas, 0, 0);
                
                // Ayarları geri yükle
                ctx.lineCap = 'round';
                ctx.lineJoin = 'round';
                ctx.strokeStyle = currentColor;
                ctx.lineWidth = currentWidth;
                
                $('#sizeIndicator').text(`${width} x ${height}`);
            }

            // İlk boyutlandırma ve pencere değişikliğinde
            resizeCanvas();
            $(window).resize(resizeCanvas);

            // Canvas Aç/Kapat
            $('#penToggle, #closePen').click(function() {
                $('#penModule').toggleClass('open');
                $('#penToggle').toggleClass('active');
                $('#contentArea').toggleClass('canvas-active');
                
                if ($('#penModule').hasClass('open')) {
                    setTimeout(resizeCanvas, 300); // Animasyon bitince resize
                }
            });

            // Renk Seçimi
            $('.color-btn').click(function() {
                $('.color-btn').removeClass('active');
                $(this).addClass('active');
                
                currentColor = $(this).data('color');
                isEraser = (currentColor === '#ffffff');
                
                ctx.strokeStyle = currentColor;
                
                // Silgi modu görseli
                if (isEraser) {
                    $('#drawingCanvas').css('cursor', 'cell');
                } else {
                    $('#drawingCanvas').css('cursor', 'crosshair');
                }
            });

            // Kalınlık Seçimi
            $('.thickness-btn').click(function() {
                $('.thickness-btn').removeClass('active');
                $(this).addClass('active');
                
                currentWidth = parseInt($(this).data('width'));
                ctx.lineWidth = currentWidth;
            });

            // Çizim Fonksiyonları
            function getPos(e) {
                const rect = canvas.getBoundingClientRect();
                const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                const clientY = e.touches ? e.touches[0].clientY : e.clientY;
                return {
                    x: clientX - rect.left,
                    y: clientY - rect.top
                };
            }

            function startDrawing(e) {
                isDrawing = true;
                const pos = getPos(e);
                
                ctx.beginPath();
                ctx.moveTo(pos.x, pos.y);
                
                // Nokta çizimi (tek tıklama için)
                ctx.lineTo(pos.x, pos.y);
                ctx.stroke();
                
                // Undo için kaydet
                saveState();
            }

            function draw(e) {
                if (!isDrawing) return;
                e.preventDefault();
                
                const pos = getPos(e);
                
                ctx.lineTo(pos.x, pos.y);
                ctx.stroke();
            }

            function stopDrawing() {
                if (isDrawing) {
                    isDrawing = false;
                    ctx.beginPath();
                }
            }

            // Mouse Events
            $(canvas).mousedown(startDrawing);
            $(canvas).mousemove(draw);
            $(canvas).mouseup(stopDrawing);
            $(canvas).mouseleave(stopDrawing);

            // Touch Events (Mobil desteği)
            $(canvas).on('touchstart', function(e) {
                e.preventDefault();
                startDrawing(e.originalEvent);
            });
            $(canvas).on('touchmove', function(e) {
                e.preventDefault();
                draw(e.originalEvent);
            });
            $(canvas).on('touchend', stopDrawing);

            // Undo Sistemi
            function saveState() {
                if (undoStack.length >= undoLimit) {
                    undoStack.shift();
                }
                undoStack.push(canvas.toDataURL());
                $('#undoBtn').prop('disabled', false);
            }

            $('#undoBtn').click(function() {
                if (undoStack.length > 0) {
                    const imgData = undoStack.pop();
                    const img = new Image();
                    img.src = imgData;
                    img.onload = function() {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        ctx.drawImage(img, 0, 0);
                    };
                }
                
                if (undoStack.length === 0) {
                    $('#undoBtn').prop('disabled', true);
                }
            });

            // Temizle
            $('#clearBtn').click(function() {
                if (confirm('Tüm çizimler silinecek. Emin misiniz?')) {
                    saveState();
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                }
            });

            // İndir
            $('#downloadBtn').click(function() {
                const link = document.createElement('a');
                link.download = 'kesir-cozumum-' + new Date().getTime() + '.png';
                link.href = canvas.toDataURL();
                link.click();
            });

            // Klavye Kısayolları
            $(document).keydown(function(e) {
                // Ctrl+Z veya Cmd+Z (Undo)
                if ((e.ctrlKey || e.metaKey) && e.key === 'z') {
                    e.preventDefault();
                    $('#undoBtn').click();
                }
                
                // ESC (Kapat)
                if (e.key === 'Escape' && $('#penModule').hasClass('open')) {
                    $('#closePen').click();
                }
            });

            // Başlangıçta boş state kaydet
            saveState();
        });
    </script>
@endsection