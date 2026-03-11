@extends('layouts.games_layout')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .main-header {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .main-title {
            font-family: 'Fredoka One', cursive;
            font-size: 3rem;
            text-shadow: 3px 3px 0 rgba(0,0,0,0.2);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-top: 10px;
        }

        .grade-selector {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .grade-btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-family: 'Fredoka One', cursive;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .grade-5 { background: #FF6B6B; color: white; }
        .grade-6 { background: #4ECDC4; color: white; }
        .grade-7 { background: #45B7D1; color: white; }

        .grade-btn:hover, .grade-btn.active {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .game-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
        }

        .game-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .game-icon {
            font-size: 3.5rem;
            margin-bottom: 15px;
            display: block;
        }

        .game-title {
            font-family: 'Fredoka One', cursive;
            font-size: 1.3rem;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .game-desc {
            font-size: 0.9rem;
            color: #718096;
            line-height: 1.4;
        }

        .difficulty-tag {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: bold;
            margin-top: 10px;
        }

        .tag-easy { background: #C6F6D5; color: #22543D; }
        .tag-medium { background: #FEEBC8; color: #744210; }
        .tag-hard { background: #FED7D7; color: #742A2A; }

        .game-area {
            display: none;
            background: white;
            border-radius: 30px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .game-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .back-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
        }

        .back-btn:hover {
            background: #764ba2;
            transform: scale(1.05);
        }

        .stats {
            display: flex;
            gap: 15px;
        }

        .stat-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
        }

        .progress-container {
            background: #E2E8F0;
            height: 12px;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 25px;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #48BB78 0%, #38A169 100%);
            width: 0%;
            transition: width 0.5s ease;
            border-radius: 10px;
        }

        .question-container {
            background: linear-gradient(135deg, #F7FAFC 0%, #EDF2F7 100%);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            text-align: center;
            border: 3px solid #E2E8F0;
        }

        .question-type {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .fraction-display {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            font-size: 2.5rem;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        .fraction {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            vertical-align: middle;
            margin: 0 10px;
        }

        .fraction-top {
            border-bottom: 3px solid #2d3748;
            padding: 5px 15px;
            font-weight: bold;
            color: #2d3748;
        }

        .fraction-bottom {
            padding: 5px 15px;
            font-weight: bold;
            color: #2d3748;
        }

        .operator {
            font-size: 2rem;
            color: #667eea;
            font-weight: bold;
        }

        .equals {
            font-size: 2rem;
            color: #48BB78;
            font-weight: bold;
        }

        .answer-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            border: 2px dashed #CBD5E0;
        }

        .answer-title {
            text-align: center;
            color: #4A5568;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .fraction-inputs {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .input-fraction {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .fraction-input {
            width: 80px;
            height: 60px;
            font-size: 1.5rem;
            text-align: center;
            border: 3px solid #CBD5E0;
            border-radius: 10px;
            font-family: 'Nunito', sans-serif;
            font-weight: bold;
            color: #2d3748;
            transition: all 0.3s;
        }

        .fraction-input:focus {
            outline: none;
            border-color: #667eea;
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(102, 126, 234, 0.3);
        }

        .input-line {
            width: 60px;
            height: 3px;
            background: #CBD5E0;
            border-radius: 2px;
        }

        .whole-number-input {
            width: 80px;
            height: 60px;
            font-size: 1.5rem;
            text-align: center;
            border: 3px solid #CBD5E0;
            border-radius: 10px;
            font-family: 'Nunito', sans-serif;
            font-weight: bold;
        }

        .check-btn {
            background: linear-gradient(135deg, #48BB78 0%, #38A169 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.2rem;
            font-family: 'Fredoka One', cursive;
            border-radius: 50px;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(72, 187, 120, 0.4);
        }

        .check-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(72, 187, 120, 0.6);
        }

        .result-message {
            margin-top: 20px;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            font-weight: bold;
            display: none;
            animation: popIn 0.5s ease;
        }

        @keyframes popIn {
            0% { transform: scale(0); }
            80% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .success {
            background: #C6F6D5;
            color: #22543D;
            border: 2px solid #9AE6B4;
        }

        .error {
            background: #FED7D7;
            color: #742A2A;
            border: 2px solid #FEB2B2;
        }

        .hints-panel {
            background: #FFFAF0;
            border-left: 5px solid #ED8936;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            display: none;
        }

        .hints-title {
            color: #C05621;
            font-weight: bold;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .hint-item {
            color: #744210;
            margin: 5px 0;
            padding-left: 20px;
            position: relative;
        }

        .hint-item:before {
            content: "💡";
            position: absolute;
            left: 0;
        }

        .visual-fraction {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .fraction-bar {
            width: 40px;
            height: 100px;
            border: 2px solid #4A5568;
            border-radius: 5px;
            position: relative;
            background: white;
            overflow: hidden;
        }

        .filled-part {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, #667eea, #764ba2);
            transition: height 0.5s ease;
        }

        .step-by-step {
            background: #E6FFFA;
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
            display: none;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 10px 0;
            padding: 10px;
            background: white;
            border-radius: 10px;
            animation: slideRight 0.5s ease forwards;
            opacity: 0;
        }

        @keyframes slideRight {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .step-number {
            background: #38B2AC;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .confetti {
            position: fixed;
            width: 12px;
            height: 12px;
            background: #f0f;
            position: absolute;
            animation: confetti-fall 3s linear forwards;
            z-index: 1000;
        }

        @keyframes confetti-fall {
            0% { transform: translateY(-100px) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
        }

        @media (max-width: 768px) {
            .main-title { font-size: 2rem; }
            .fraction-display { font-size: 1.8rem; }
            .fraction-input, .whole-number-input { 
                width: 60px; 
                height: 50px; 
                font-size: 1.2rem; 
            }
            .game-area { padding: 20px; }
        }

        .help-btn {
            background: #ED8936;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 15px;
            transition: all 0.3s;
        }

        .help-btn:hover {
            background: #DD6B20;
            transform: scale(1.05);
        }

        .badge-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .badge {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #744210;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            animation: badge-pop 0.5s ease;
        }

        @keyframes badge-pop {
            0% { transform: scale(0) rotate(-180deg); }
            100% { transform: scale(1) rotate(0deg); }
        }

        .mixed-display {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .whole-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2d3748;
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

    <div class="container">
        <div id="mainMenu">
            <div class="main-header">
                <h1 class="main-title">🎯 Kesir Ustası</h1>
                <p class="subtitle">5-6-7. Sınıf Kesir İşlemleri Oyunu</p>
            </div>

            <div class="grade-selector">
                <button class="grade-btn grade-5 active" data-grade="5">5. Sınıf 🎒</button>
                <button class="grade-btn grade-6" data-grade="6">6. Sınıf 📚</button>
                <button class="grade-btn grade-7" data-grade="7">7. Sınıf 🎓</button>
            </div>

            <div class="menu-grid" id="menuGrid"></div>
        </div>

        <div id="gameArea" class="game-area">
            <div class="game-header">
                <button class="back-btn" id="backBtn">← Menüye Dön</button>
                <h2 id="gameTitle" style="color: #2d3748; font-family: 'Fredoka One', cursive;"></h2>
                <div class="stats">
                    <div class="stat-box">⭐ <span id="score">0</span></div>
                    <div class="stat-box">🔥 <span id="streak">0</span></div>
                    <div class="stat-box">🎯 <span id="level">1</span></div>
                </div>
            </div>

            <div class="progress-container">
                <div class="progress-bar" id="progressBar"></div>
            </div>

            <div class="question-container">
                <span class="question-type" id="questionType">İşlem</span>
                <div class="fraction-display" id="fractionDisplay"></div>
                <div class="visual-fraction" id="visualFraction"></div>
            </div>

            <div class="answer-section">
                <div class="answer-title">Cevabınızı Girin:</div>
                
                <div class="fraction-inputs" id="answerInputs">
                    <div class="input-fraction">
                        <input type="number" class="whole-number-input" id="wholePart" placeholder="T" min="0">
                        <span style="font-size: 0.8rem; color: #718096;">Tam</span>
                    </div>
                    
                    <div class="input-fraction">
                        <input type="number" class="fraction-input" id="numerator" placeholder="Pay" min="0">
                        <div class="input-line"></div>
                        <input type="number" class="fraction-input" id="denominator" placeholder="Payda" min="1">
                    </div>
                </div>

                <div style="text-align: center;">
                    <button class="check-btn" id="checkBtn">Kontrol Et ✅</button>
                    <button class="help-btn" id="helpBtn">🤔 İpucu Al</button>
                </div>

                <div class="result-message" id="resultMessage"></div>
                
                <div class="hints-panel" id="hintsPanel">
                    <div class="hints-title">💡 İpuçları:</div>
                    <div id="hintsContent"></div>
                </div>

                <div class="step-by-step" id="stepByStep">
                    <div class="hints-title">📋 Adım Adım Çözüm:</div>
                    <div id="stepsContent"></div>
                </div>
            </div>

            <div class="badge-container" id="badgeContainer"></div>
        </div>



        <!-- KALEM MODÜLÜ -->
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
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/kesirler.js') }}"></script>
@endsection