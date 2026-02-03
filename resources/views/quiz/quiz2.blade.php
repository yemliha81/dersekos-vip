<?php
/* ===============================
   JSON → PHP DİZİSİ (BİREBİR)
   =============================== */

$data = json_decode($quiz->json_data);

$jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>DKAB Dinamik Ders</title>

<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background:#f4f6f8;
  margin:0;
  padding:20px;
  color:#333;
}
header {
  text-align:center;
  margin-bottom:30px;
}
header h1 {
  margin:0;
  font-size:28px;
}
header h2 {
  margin:6px 0;
  font-size:20px;
}
.container {
  max-width:1000px;
  margin:auto;
}
.grid {
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:20px;
}
.card {
  background:#fff;
  padding:20px;
  border-radius:8px;
  box-shadow:0 2px 8px rgba(0,0,0,0.08);
}
.card.red { border-left:6px solid #d9534f; }
.card.green { border-left:6px solid #5cb85c; }
.card h3 {
  margin-top:0;
}
ul {
  padding-left:18px;
}
.example {
  margin-top:30px;
}
.example p {
  margin:6px 0;
}
.question {
  margin-top:20px;
}
.option {
  display:block;
  width:100%;
  padding:10px;
  margin:6px 0;
  border:1px solid #ddd;
  background:#fafafa;
  cursor:pointer;
  text-align:left;
}
.option:hover {
  background:#eee;
}
.answer {
  display:none;
  margin-top:10px;
  padding:10px;
  background:#e6f7e6;
  border-left:4px solid #5cb85c;
}
@media (max-width:768px){
  .grid { grid-template-columns:1fr; }
}
</style>
</head>

<body>

<div class="container">

<header>
  <h1 id="ders"></h1>
  <h2 id="unite"></h2>
  <p id="kazanim"></p>
</header>

<section id="kavramlar" class="grid"></section>

<section id="ornekOlay" class="card example"></section>

<section id="sorular"></section>

</div>

<script>
const DATA = <?php echo $jsonData; ?>;

// HEADER
document.getElementById("ders").innerText =
  DATA.meta_data.ders + " | " + DATA.meta_data.sinif + ". Sınıf";

document.getElementById("unite").innerText =
  DATA.meta_data.unite + " – " + DATA.meta_data.baslik;

document.getElementById("kazanim").innerText =
  "Kazanım " + DATA.meta_data.kazanim.kod + ": " +
  DATA.meta_data.kazanim.aciklama;

// KAVRAMLAR
document.getElementById("kavramlar").innerHTML =
  DATA.icerik.kavramlar.map(k => `
    <div class="card ${k.baslik.includes("Yanlış") ? "red" : "green"}">
      <h3>${k.baslik}</h3>
      <p>${k.tanim}</p>
      ${k.ilke ? `<em>${k.ilke}</em>` : ""}
      <ul>${k.ornek_ifadeler.map(o=>`<li>${o}</li>`).join("")}</ul>
    </div>
  `).join("");

// ÖRNEK OLAY
document.getElementById("ornekOlay").innerHTML = `
  <h3>${DATA.icerik.ornek_olay.konu}</h3>
  <p><strong>Durum:</strong> ${DATA.icerik.ornek_olay.durum}</p>
  <p><strong>Yanlış Yorum:</strong> ${DATA.icerik.ornek_olay.yanlis_yorum}</p>
  <p><strong>Doğru Yorum:</strong> ${DATA.icerik.ornek_olay.dogru_yorum}</p>
`;

// SORULAR
document.getElementById("sorular").innerHTML =
  DATA.soru_bankasi.map(s => `
    <div class="card question">
      <strong>${s.soru_metni}</strong>
      ${Object.entries(s.secenekler).map(([k,v]) => `
        <button class="option" onclick="toggle(${s.id})">${k}) ${v}</button>
      `).join("")}
      <div id="ans${s.id}" class="answer">
        <strong>Doğru Cevap:</strong> ${s.dogru_cevap}<br>
        ${s.cozum.analiz}
      </div>
    </div>
  `).join("");

function toggle(id){
  const el = document.getElementById("ans"+id);
  el.style.display = el.style.display === "block" ? "none" : "block";
}
</script>

</body>
</html>
