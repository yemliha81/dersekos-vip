<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İTA.8.1.3 LGS Hazırlık Testi (Askerlik Hayatı ve Kişilik Özellikleri)</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef2f3;
            color: #333;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        header {
            background-color: #2980b9; /* Askeri/Güven veren mavi tonu */
            color: #fff;
            padding: 25px;
            text-align: center;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(41, 128, 185, 0.4);
            border-bottom: 5px solid #1a5276;
        }
        h1 {
            margin: 0;
            font-size: 26px;
        }
        .description {
            font-size: 15px;
            margin-top: 10px;
            opacity: 0.95;
            font-weight: 500;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            padding: 30px;
            border-left: 6px solid #3498db;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.12);
        }
        .question-meta {
            font-size: 12px;
            color: #7f8c8d;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
        }
        .question-content {
            margin-bottom: 20px;
        }
        .question-image-container {
            text-align: center;
            margin: 15px 0;
        }
        .question-image {
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            border: 4px solid #fff;
            outline: 1px solid #ddd;
        }
        .question-text {
            font-size: 17px;
            font-weight: 600;
            color: #2c3e50;
        }
        .options {
            list-style-type: none;
            padding: 0;
        }
        .options li {
            margin-bottom: 12px;
            padding: 14px 18px;
            background-color: #fff;
            border: 2px solid #ecf0f1;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 15px;
            position: relative;
        }
        .options li:hover {
            background-color: #d6eaf8;
            border-color: #2980b9;
            transform: translateX(5px);
        }
        .options li:before {
            content: attr(data-option) ") ";
            font-weight: bold;
            color: #2980b9;
            margin-right: 8px;
        }
        .answer-section {
            margin-top: 20px;
            padding: 20px;
            background-color: #eaf2f8;
            border-radius: 8px;
            font-size: 15px;
            display: none;
            border-left: 5px solid #2980b9;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.02);
        }
        .toggle-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 700;
            margin-top: 5px;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background 0.3s;
        }
        .toggle-btn:hover {
            background-color: #2980b9;
        }
        .json-container {
            margin-top: 50px;
            background: #2c3e50;
            color: #ecf0f1;
            padding: 25px;
            border-radius: 12px;
            overflow-x: auto;
            border: 4px solid #34495e;
        }
        pre {
            margin: 0;
            font-family: 'Consolas', 'Monaco', monospace;
            font-size: 13px;
        }
        .copy-btn {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-bottom: 15px;
            display: inline-block;
        }
        .tip-title {
            font-weight: bold;
            color: #2980b9;
            display: block;
            margin-bottom: 8px;
            font-size: 1.1em;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>İTA.8.1.3 Kazanım Testi</h1>
        <div class="description">Atatürk'ün Askerlik Hayatı ve Kişilik Özellikleri (Görselli & LGS Uyumlu)</div>
    </header>

    <!-- Sorular Burada Listelenecek -->
    <div id="questions-wrapper"></div>

   
</div>

<script>
    // 10 Adet İTA.8.1.3 Kazanımına Uygun Soru
    const questionsObj = <?= json_encode($quiz->json_data, JSON_UNESCAPED_UNICODE); ?>;
    const questions = JSON.parse(questionsObj);

    //const questions = {{json_encode($quiz->json_data)}};

    // HTML'e soruları basma fonksiyonu
    function renderQuestions() {
        const wrapper = document.getElementById('questions-wrapper');
        questions.forEach((q, index) => {
            const card = document.createElement('div');
            card.className = 'card';
            
            // Zorluk seviyesini metne dökme (Görsel olarak)
            let zorlukMetni = "";
            let zorlukRenk = "";
            if(q.zorluk_derecesi <= 0.20) { zorlukMetni = "Çok Kolay"; zorlukRenk = "#27ae60"; }
            else if(q.zorluk_derecesi <= 0.25) { zorlukMetni = "Kolay"; zorlukRenk = "#f39c12"; }
            else { zorlukMetni = "Orta"; zorlukRenk = "#e67e22"; }

            // Görsel HTML'i (Varsa ekle)
            let imgHTML = '';
            if(q.gorsel) {
                imgHTML = `
                <div class="question-image-container">
                    <img src="${q.gorsel}" alt="Soru Görseli" class="question-image">
                </div>`;
            }

            card.innerHTML = `
                <div class="question-meta">
                    <span><strong>Kazanım:</strong> ${q.kazanim_no}</span>
                    <span style="background-color:${zorlukRenk}; padding:2px 10px; border-radius:15px; color:#fff; font-weight:bold; font-size:11px;">${zorlukMetni} (${q.zorluk_derecesi})</span>
                </div>
                <div class="question-content">
                    <div class="question-text"><strong>Soru ${index + 1}:</strong></div>
                    ${imgHTML}
                    <div style="margin-top:10px;">${q.soru_metni.replace(/\n/g, '<br>')}</div>
                </div>
                <ul class="options">
                    <li data-option="A" onclick="checkAnswer(this, '${q.dogru_cevap}')">${q.secenekler.A}</li>
                    <li data-option="B" onclick="checkAnswer(this, '${q.dogru_cevap}')">${q.secenekler.B}</li>
                    <li data-option="C" onclick="checkAnswer(this, '${q.dogru_cevap}')">${q.secenekler.C}</li>
                    <li data-option="D" onclick="checkAnswer(this, '${q.dogru_cevap}')">${q.secenekler.D}</li>
                </ul>
                <button class="toggle-btn" onclick="toggleAnswer(this)">Eğlenceli İpucunu Göster</button>
                <div class="answer-section">
                    <strong>Doğru Cevap:</strong> ${q.dogru_cevap}<br><br>
                    ${q.cozum}
                </div>
            `;
            wrapper.appendChild(card);
        });

        // JSON alanını doldur
        document.getElementById('json-output').textContent = JSON.stringify(questions, null, 4);
    }

    // Cevabı kontrol etme
    function checkAnswer(li, correct) {
        const parent = li.parentElement;
        // Önceki seçimleri temizle
        Array.from(parent.children).forEach(child => {
            child.style.backgroundColor = '#fff';
            child.style.color = '#333';
            child.style.borderColor = '#ecf0f1';
        });

        const selected = li.getAttribute('data-option');
        if (selected === correct) {
            li.style.backgroundColor = '#d5f5e3'; // Yeşil
            li.style.borderColor = '#2ecc71';
            li.style.color = '#145a32';
        } else {
            li.style.backgroundColor = '#fadbd8'; // Kırmızı
            li.style.borderColor = '#e74c3c';
            li.style.color = '#78281f';
        }
    }

    function toggleAnswer(btn) {
        const answerDiv = btn.nextElementSibling;
        if (answerDiv.style.display === 'block') {
            answerDiv.style.display = 'none';
            btn.textContent = 'Eğlenceli İpucunu Göster';
        } else {
            answerDiv.style.display = 'block';
            btn.textContent = 'İpucunu Gizle';
        }
    }

    function copyJson() {
        const jsonText = document.getElementById('json-output').textContent;
        navigator.clipboard.writeText(jsonText).then(() => {
            alert('JSON panoya kopyalandı! Doğruca kullanabilirsin.');
        });
    }

    // Sayfa yüklendiğinde çalıştır
    renderQuestions();
</script>

</body>
</html>