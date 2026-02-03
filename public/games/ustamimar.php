<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Usta Mimar</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    background: #dbeafe;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

#game {
    width: 1000px;
    background: white;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 0 20px rgba(0,0,0,0.2);
}

/* HEADER */
#header {
    display: flex;
    justify-content: space-between;
    border-bottom: 4px solid #38bdf8;
    padding-bottom: 10px;
}
#score {
    font-size: 32px;
    font-weight: bold;
    color: orange;
}

/* SCENE */
#scene {
    margin-top: 15px;
    height: 320px;
    background: linear-gradient(#bae6fd,#e0f2fe);
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    display: flex;
    align-items: flex-end;
}

.cliff {
    width: 25%;
    height: 200px;
    background: #444;
    position: relative;
}
.grass {
    height: 15px;
    background: #22c55e;
}
#rightCliff {
    flex: 1;
}

#gap {
    height: 100%;
    position: relative;
}

#bridge {
    position: absolute;
    bottom: 120px;
    height: 15px;
    background: #a16207;
    border: 2px solid #713f12;
    width: 0;
    transform-origin: left;
}

/* CHARACTER */
#worker {
    position: absolute;
    top: -35px;
    font-size: 40px;
    left: 5%;
}

/* MEASURE LINE */
#measure {
    position: absolute;
    top: 50%;
    width: 100%;
    text-align: center;
    display: none;
}
#measure span {
    background: #fee2e2;
    padding: 5px 10px;
    border-radius: 6px;
    font-weight: bold;
    color: #b91c1c;
}

/* CONTROL */
#panel {
    margin-top: 15px;
    background: #f9fafb;
    padding: 15px;
    border-radius: 10px;
}

button {
    background: #22c55e;
    border: none;
    padding: 12px 20px;
    color: white;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
}
button:disabled {
    background: #9ca3af;
}

input {
    padding: 10px;
    font-size: 22px;
    width: 150px;
}

#message {
    margin-top: 10px;
    font-weight: bold;
}
</style>
</head>

<body>

<div id="game">

<div id="header">
    <div>
        <h2>🏗️ Usta Mimar</h2>
        <div>Seviye: <span id="level">1</span></div>
    </div>
    <div>
        PUAN
        <div id="score">0</div>
    </div>
</div>

<div id="scene">
    <div class="cliff">
        <div class="grass"></div>
        <div id="worker">👷</div>
    </div>

    <div id="gap">
        <div id="measure"><span id="meterText"></span></div>
        <div id="bridge"></div>
    </div>

    <div class="cliff" id="rightCliff">
        <div class="grass"></div>
        <div style="position:absolute;top:-35px;right:20px;font-size:40px;">🏁</div>
    </div>
</div>

<div id="panel">
    <p>
        Boşluk: <b><span id="meterVal"></span> metre</b>  
        Birim: <b><span id="unit"></span></b>
    </p>

    <input id="userInput" type="number" placeholder="0">
    <button id="buildBtn">İNŞA ET</button>

    <div id="message"></div>
</div>

</div>

<script>
let level = 1;
let score = 0;
let gapWidth = 300;
let meterValue = 0;
let unit = "cm";
let PIXELS_TO_METERS = 0.01;

function startLevel() {
    gapWidth = Math.floor(Math.random()*300)+200;
    meterValue = (gapWidth * PIXELS_TO_METERS).toFixed(2);

    if(level>5) unit = ["cm","mm","dm"][Math.floor(Math.random()*3)];
    else if(level>2) unit = Math.random()>0.5 ? "cm":"mm";
    else unit = "cm";

    $("#gap").css("width",gapWidth+"px");
    $("#bridge").width(0).css("transform","none");
    $("#worker").css("left","5%");
    $("#meterVal").text(meterValue);
    $("#meterText").text(meterValue+" m");
    $("#unit").text(unit);
    $("#measure").show();
    $("#message").text("");
}

$("#buildBtn").click(function(){
    let input = parseFloat($("#userInput").val());
    if(!input) return;

    let meters = input;
    if(unit=="cm") meters/=100;
    if(unit=="mm") meters/=1000;
    if(unit=="dm") meters/=10;

    let target = meters / PIXELS_TO_METERS;
    let w = 0;

    let grow = setInterval(function(){
        w+=10;
        $("#bridge").width(w);
        if(w>=target){
            clearInterval(grow);
            evaluate(meters);
        }
    },20);
});

function evaluate(inputMeters){
    let diff = inputMeters - meterValue;
    if(Math.abs(diff)<=0.1){
        $("#message").css("color","green").text("Mükemmel!");
        score+=100;
        level++;
        $("#score").text(score);
        $("#level").text(level);
        move(true);
    } else {
        $("#message").css("color","red").text("Başarısız!");
        move(false);
    }
}

function move(success){
    let pos=5;
    let walk=setInterval(function(){
        pos+=1;
        $("#worker").css("left",pos+"%");
        if(success && pos>85){
            clearInterval(walk);
            setTimeout(startLevel,1000);
        }
        if(!success && pos>45){
            clearInterval(walk);
            $("#bridge").css("transform","rotate(15deg) translateY(20px)");
        }
    },20);
}

startLevel();
</script>

</body>
</html>
