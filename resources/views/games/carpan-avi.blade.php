@extends('layouts.main')

@section('content')
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Comic Sans MS', 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            position: relative;
        }
        
        .game-container {
            position: relative;
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .game-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            border-radius: 25px;
            padding: 30px 40px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
            margin-bottom: 20px;
            border: 5px solid white;
            position: relative;
            overflow: hidden;
        }
        
        .game-banner::before {
            content: '🎯';
            position: absolute;
            font-size: 10em;
            opacity: 0.1;
            left: -50px;
            top: -30px;
            animation: rotateSlow 20s linear infinite;
        }
        
        .game-banner::after {
            content: '🎯';
            position: absolute;
            font-size: 10em;
            opacity: 0.1;
            right: -50px;
            bottom: -30px;
            animation: rotateSlow 20s linear infinite reverse;
        }
        
        @keyframes rotateSlow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .banner-title {
            font-size: 4em;
            font-weight: bold;
            color: white;
            text-shadow: 4px 4px 8px rgba(0,0,0,0.3);
            margin-bottom: 10px;
            letter-spacing: 3px;
            position: relative;
            z-index: 1;
        }
        
        .banner-subtitle {
            font-size: 1.5em;
            color: white;
            opacity: 0.9;
            font-weight: bold;
            position: relative;
            z-index: 1;
        }
        
        .header {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .stats {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .stat-box {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            padding: 15px 25px;
            border-radius: 15px;
            text-align: center;
            border: 3px solid #ff6b6b;
            min-width: 120px;
        }
        
        .stat-label {
            font-size: 0.9em;
            color: #666;
            font-weight: bold;
        }
        
        .stat-value {
            font-size: 2em;
            font-weight: bold;
            color: #ff6b6b;
        }
        
        .target-box {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            margin-bottom: 20px;
            border: 5px solid #667eea;
        }
        
        .target-label {
            font-size: 1.5em;
            color: #666;
            margin-bottom: 10px;
            font-weight: bold;
        }
        
        .target-number {
            font-size: 4em;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: targetPulse 2s infinite;
        }
        
        @keyframes targetPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .game-area {
            flex: 1;
            background: rgba(255,255,255,0.1);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            border: 3px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(10px);
        }
        
        .flying-number {
            position: absolute;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            animation: float 3s ease-in-out infinite;
            border: 4px solid;
        }
        
        .flying-number:hover {
            transform: scale(1.2) rotate(10deg);
        }
        
        .flying-number {
            color: white;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        .flying-number.clicked-correct {
            animation: explodeCorrect 0.5s forwards;
        }
        
        @keyframes explodeCorrect {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5) rotate(180deg); }
            100% { transform: scale(0) rotate(360deg); opacity: 0; }
        }
        
        .flying-number.clicked-wrong {
            animation: shakeWrong 0.5s forwards;
        }
        
        @keyframes shakeWrong {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-10px); }
            20%, 40%, 60%, 80% { transform: translateX(10px); }
        }
        
        .feedback {
            position: absolute;
            font-size: 3em;
            font-weight: bold;
            pointer-events: none;
            animation: feedbackFade 1s forwards;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.5);
        }
        
        .feedback.correct {
            color: #1dd1a1;
        }
        
        .feedback.wrong {
            color: #ff6b6b;
        }
        
        @keyframes feedbackFade {
            0% { transform: scale(0) translateY(0); opacity: 1; }
            50% { transform: scale(1.5) translateY(-30px); opacity: 1; }
            100% { transform: scale(1) translateY(-80px); opacity: 0; }
        }
        
        .combo-badge {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 4em;
            font-weight: bold;
            color: #feca57;
            text-shadow: 4px 4px 8px rgba(0,0,0,0.5);
            animation: comboBurst 1s forwards;
            pointer-events: none;
            z-index: 1000;
        }
        
        @keyframes comboBurst {
            0% { transform: translate(-50%, -50%) scale(0) rotate(0deg); opacity: 1; }
            50% { transform: translate(-50%, -50%) scale(1.5) rotate(180deg); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(1) rotate(360deg); opacity: 0; }
        }
        
        .start-screen, .game-over-screen {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }
        
        .modal-content {
            background: white;
            border-radius: 30px;
            padding: 50px;
            text-align: center;
            max-width: 600px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }
        
        .modal-title {
            font-size: 3em;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
        }
        
        .modal-text {
            font-size: 1.3em;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .btn {
            padding: 20px 50px;
            font-size: 1.5em;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-success {
            background: linear-gradient(135deg, #1dd1a1 0%, #10ac84 100%);
            color: white;
            margin: 10px;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.4);
        }
        
        .level-badge {
            display: inline-block;
            background: linear-gradient(135deg, #feca57 0%, #ff6b6b 100%);
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        
        .instruction-list {
            text-align: left;
            margin: 20px auto;
            max-width: 400px;
        }
        
        .instruction-item {
            padding: 10px;
            margin: 10px 0;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            border-radius: 10px;
            font-weight: bold;
        }
        
        .final-score {
            font-size: 4em;
            font-weight: bold;
            color: #ff6b6b;
            margin: 20px 0;
        }
        
        .timer-bar {
            position: absolute;
            top: 0;
            left: 0;
            height: 8px;
            background: linear-gradient(90deg, #1dd1a1 0%, #feca57 50%, #ff6b6b 100%);
            transition: width 0.1s linear;
            border-radius: 0 0 8px 0;
        }
        
        @media (max-width: 768px) {
            .banner-title { font-size: 2.5em; }
            .banner-subtitle { font-size: 1em; }
            .target-number { font-size: 3em; }
            .flying-number { width: 60px; height: 60px; font-size: 1.5em; }
            .modal-content { padding: 30px; }
        }
    </style>
<div class="game-container">
        <div class="game-banner">
            <div class="banner-title">🎯 ÇARPAN AVI 🎯</div>
            <div class="banner-subtitle">Doğru Çarpanları Yakala - Yanlışlardan Kaç!</div>
        </div>
        
        <div class="header">
            <div class="stats">
                <div class="stat-box">
                    <div class="stat-label">Skor</div>
                    <div class="stat-value" id="score">0</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Seviye</div>
                    <div class="stat-value" id="level">1</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Combo</div>
                    <div class="stat-value" id="combo">0</div>
                </div>
            </div>
        </div>
        
        <div class="target-box">
            <div class="target-label">🎯 Hedef Sayı</div>
            <div class="target-number" id="targetNumber">--</div>
            <div class="timer-bar" id="timerBar"></div>
        </div>
        
        <div class="game-area" id="gameArea"></div>
        
        <div class="start-screen" id="startScreen">
            <div class="modal-content">
                <div class="modal-title">🎯 Çarpan Avı Oyunu</div>
                <div class="modal-text">
                    Hedef sayının çarpanlarını yakala!<br>
                    Yanlış sayılara dokunma!
                </div>
                <div class="instruction-list">
                    <div class="instruction-item">✅ Doğru çarpan: +10 puan</div>
                    <div class="instruction-item">❌ Yanlış sayı: -5 puan</div>
                    <div class="instruction-item">🔥 Combo: Ekstra puan!</div>
                    <div class="instruction-item">⏱️ 60 saniye süren var!</div>
                </div>
                <button class="btn btn-primary" onclick="startGame()">🚀 Oyuna Başla!</button>
            </div>
        </div>
        
        <div class="game-over-screen" id="gameOverScreen" style="display: none;">
            <div class="modal-content">
                <div class="modal-title">🎊 Oyun Bitti!</div>
                <div class="level-badge">Seviye <span id="finalLevel">1</span></div>
                <div class="final-score" id="finalScore">0</div>
                <div class="modal-text" id="performanceText">Harika oynadın!</div>
                <button class="btn btn-success" onclick="startGame()">🔄 Tekrar Oyna</button>
                <button class="btn btn-primary" onclick="location.reload()">🏠 Ana Sayfa</button>
            </div>
        </div>
    </div>

    <script>
        let score = 0;
        let level = 1;
        let combo = 0;
        let targetNumber = 0;
        let gameActive = false;
        let spawnInterval = null;
        let gameTimer = null;
        let timeLeft = 60;
        let numberSpeed = 3000;
        let spawnRate = 1500;
        let activeNumbers = [];
        
        // Rastgele renkler - ipucu vermeyen
        const randomColors = [
            {bg: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)', border: '#5a67d8'},
            {bg: 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)', border: '#e74c3c'},
            {bg: 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)', border: '#0abde3'},
            {bg: 'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)', border: '#10ac84'},
            {bg: 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)', border: '#ff6b6b'},
            {bg: 'linear-gradient(135deg, #feca57 0%, #ff9ff3 100%)', border: '#f368e0'},
            {bg: 'linear-gradient(135deg, #a8edea 0%, #fed6e3 100%)', border: '#48dbfb'},
            {bg: 'linear-gradient(135deg, #ff6b6b 0%, #feca57 100%)', border: '#ee5a6f'}
        ];
        
        function isPrime(n) {
            if (n < 2) return false;
            if (n === 2) return true;
            if (n % 2 === 0) return false;
            for (let i = 3; i <= Math.sqrt(n); i += 2) {
                if (n % i === 0) return false;
            }
            return true;
        }
        
        function getFactors(num) {
            const factors = [];
            for (let i = 1; i <= num; i++) {
                if (num % i === 0) {
                    factors.push(i);
                }
            }
            return factors;
        }
        
        function startGame() {
            score = 0;
            level = 1;
            combo = 0;
            timeLeft = 60;
            gameActive = true;
            
            document.getElementById('startScreen').style.display = 'none';
            document.getElementById('gameOverScreen').style.display = 'none';
            
            updateDisplay();
            generateNewTarget();
            startTimer();
            startSpawning();
        }
        
        function generateNewTarget() {
            const numbers = [12, 15, 18, 20, 24, 28, 30, 36, 40, 42, 45, 48, 54, 56, 60, 72];
            targetNumber = numbers[Math.floor(Math.random() * numbers.length)];
            document.getElementById('targetNumber').textContent = targetNumber;
        }
        
        function startTimer() {
            const timerBar = document.getElementById('timerBar');
            timerBar.style.width = '100%';
            
            gameTimer = setInterval(() => {
                timeLeft--;
                const percentage = (timeLeft / 60) * 100;
                timerBar.style.width = percentage + '%';
                
                if (timeLeft <= 0) {
                    endGame();
                }
            }, 1000);
        }
        
        function startSpawning() {
            spawnInterval = setInterval(() => {
                if (gameActive) {
                    spawnNumber();
                }
            }, spawnRate);
        }
        
        function spawnNumber() {
            const gameArea = document.getElementById('gameArea');
            const factors = getFactors(targetNumber);
            
            let number;
            const isCorrect = Math.random() > 0.4;
            
            if (isCorrect) {
                number = factors[Math.floor(Math.random() * factors.length)];
            } else {
                do {
                    number = Math.floor(Math.random() * (targetNumber + 20)) + 1;
                } while (factors.includes(number));
            }
            
            const flyingNumber = document.createElement('div');
            flyingNumber.className = 'flying-number';
            flyingNumber.textContent = number;
            flyingNumber.dataset.correct = isCorrect;
            
            // Rastgele renk seç - ipucu verme!
            const randomColor = randomColors[Math.floor(Math.random() * randomColors.length)];
            flyingNumber.style.background = randomColor.bg;
            flyingNumber.style.borderColor = randomColor.border;
            
            const maxX = gameArea.offsetWidth - 80;
            const maxY = gameArea.offsetHeight - 80;
            
            flyingNumber.style.left = Math.random() * maxX + 'px';
            flyingNumber.style.top = Math.random() * maxY + 'px';
            flyingNumber.style.animationDelay = Math.random() * 2 + 's';
            
            flyingNumber.onclick = () => handleClick(flyingNumber, isCorrect, number);
            
            gameArea.appendChild(flyingNumber);
            activeNumbers.push(flyingNumber);
            
            setTimeout(() => {
                if (flyingNumber.parentNode === gameArea) {
                    gameArea.removeChild(flyingNumber);
                    const index = activeNumbers.indexOf(flyingNumber);
                    if (index > -1) activeNumbers.splice(index, 1);
                }
            }, numberSpeed);
        }
        
        function handleClick(element, isCorrect, number) {
            if (!gameActive) return;
            
            const rect = element.getBoundingClientRect();
            const x = rect.left + rect.width / 2;
            const y = rect.top + rect.height / 2;
            
            if (isCorrect) {
                score += 10 + (combo * 2);
                combo++;
                element.classList.add('clicked-correct');
                showFeedback('✓ Doğru!', x, y, true);
                
                if (combo >= 5) {
                    showCombo();
                }
                
                if (score >= level * 100) {
                    levelUp();
                }
            } else {
                score -= 5;
                combo = 0;
                element.classList.add('clicked-wrong');
                showFeedback('✗ Yanlış!', x, y, false);
            }
            
            updateDisplay();
            
            setTimeout(() => {
                if (element.parentNode) {
                    element.parentNode.removeChild(element);
                }
            }, 500);
        }
        
        function showFeedback(text, x, y, isCorrect) {
            const feedback = document.createElement('div');
            feedback.className = `feedback ${isCorrect ? 'correct' : 'wrong'}`;
            feedback.textContent = text;
            feedback.style.left = x + 'px';
            feedback.style.top = y + 'px';
            
            document.body.appendChild(feedback);
            
            setTimeout(() => {
                document.body.removeChild(feedback);
            }, 1000);
        }
        
        function showCombo() {
            const comboBadge = document.createElement('div');
            comboBadge.className = 'combo-badge';
            comboBadge.textContent = `🔥 ${combo}x COMBO!`;
            
            document.getElementById('gameArea').appendChild(comboBadge);
            
            setTimeout(() => {
                if (comboBadge.parentNode) {
                    comboBadge.parentNode.removeChild(comboBadge);
                }
            }, 1000);
        }
        
        function levelUp() {
            level++;
            combo = 0;
            numberSpeed = Math.max(1500, numberSpeed - 200);
            spawnRate = Math.max(800, spawnRate - 100);
            
            clearInterval(spawnInterval);
            startSpawning();
            
            generateNewTarget();
            updateDisplay();
            
            const levelBadge = document.createElement('div');
            levelBadge.className = 'combo-badge';
            levelBadge.textContent = `⬆️ SEVİYE ${level}!`;
            document.getElementById('gameArea').appendChild(levelBadge);
            
            setTimeout(() => {
                if (levelBadge.parentNode) {
                    levelBadge.parentNode.removeChild(levelBadge);
                }
            }, 1500);
        }
        
        function updateDisplay() {
            document.getElementById('score').textContent = score;
            document.getElementById('level').textContent = level;
            document.getElementById('combo').textContent = combo;
        }
        
        function endGame() {
            gameActive = false;
            clearInterval(gameTimer);
            clearInterval(spawnInterval);
            
            activeNumbers.forEach(num => {
                if (num.parentNode) {
                    num.parentNode.removeChild(num);
                }
            });
            activeNumbers = [];
            
            document.getElementById('finalScore').textContent = score + ' PUAN';
            document.getElementById('finalLevel').textContent = level;
            
            let performanceText = '';
            if (score >= 500) {
                performanceText = '🏆 EFSANE! Matematikte çok iyisin!';
            } else if (score >= 300) {
                performanceText = '⭐ Harika! Çarpanları çok iyi biliyorsun!';
            } else if (score >= 150) {
                performanceText = '👍 İyi! Pratik yapmaya devam et!';
            } else {
                performanceText = '💪 Güzel deneme! Bir daha dene!';
            }
            
            document.getElementById('performanceText').textContent = performanceText;
            document.getElementById('gameOverScreen').style.display = 'flex';
        }
    </script>

@endsection