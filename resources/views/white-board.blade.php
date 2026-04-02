<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Whiteboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        h1 {
            color: white;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .toolbar {
            background: white;
            padding: 15px 25px;
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            display: flex;
            gap: 15px;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .tool-btn {
            width: 45px;
            height: 45px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            background: #f0f0f0;
        }

        .tool-btn:hover {
            transform: scale(1.1);
            background: #e0e0e0;
        }

        .tool-btn.active {
            background: #667eea;
            color: white;
        }

        .color-picker {
            width: 45px;
            height: 45px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            overflow: hidden;
        }

        .color-picker::-webkit-color-swatch-wrapper {
            padding: 0;
        }

        .color-picker::-webkit-color-swatch {
            border: none;
            border-radius: 50%;
        }

        .size-slider {
            width: 100px;
        }

        .canvas-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 20px;
        }

        #whiteboard {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            cursor: crosshair;
            display: block;
            background: white;
        }

        .clear-btn {
            background: #ff6b6b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .clear-btn:hover {
            background: #ff5252;
            transform: scale(1.05);
        }

        .save-btn {
            background: #4ecdc4;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .save-btn:hover {
            background: #26d0ce;
            transform: scale(1.05);
        }
    </style>
<base target="_blank">
</head>
<body>

    <div class="toolbar">
        <button class="tool-btn active" id="pencil" title="Pencil">✏️</button>
        <button class="tool-btn" id="eraser" title="Eraser">🧼</button>
        <input type="color" class="color-picker" id="colorPicker" value="#000000" title="Color">
        <input type="range" class="size-slider" id="brushSize" min="1" max="50" value="3" title="Brush Size">
        <span id="sizeValue">3px</span>
        <button class="clear-btn" id="clearBtn">🗑️ Clear</button>
        <button class="save-btn" id="saveBtn">💾 Save</button>
    </div>

    <div class="canvas-container">
        <canvas id="whiteboard" width="1400" height="1000"></canvas>
    </div>

    <script>
        const canvas = document.getElementById('whiteboard');
        const ctx = canvas.getContext('2d');
        const pencilBtn = document.getElementById('pencil');
        const eraserBtn = document.getElementById('eraser');
        const colorPicker = document.getElementById('colorPicker');
        const brushSize = document.getElementById('brushSize');
        const sizeValue = document.getElementById('sizeValue');
        const clearBtn = document.getElementById('clearBtn');
        const saveBtn = document.getElementById('saveBtn');

        let isDrawing = false;
        let currentTool = 'pencil';
        let currentColor = '#000000';
        let currentSize = 3;

        // Set canvas background to white
        ctx.fillStyle = 'white';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Tool selection
        pencilBtn.addEventListener('click', () => {
            currentTool = 'pencil';
            pencilBtn.classList.add('active');
            eraserBtn.classList.remove('active');
        });

        eraserBtn.addEventListener('click', () => {
            currentTool = 'eraser';
            eraserBtn.classList.add('active');
            pencilBtn.classList.remove('active');
        });

        // Color picker
        colorPicker.addEventListener('change', (e) => {
            currentColor = e.target.value;
            if (currentTool === 'pencil') {
                ctx.strokeStyle = currentColor;
            }
        });

        // Brush size
        brushSize.addEventListener('input', (e) => {
            currentSize = e.target.value;
            sizeValue.textContent = currentSize + 'px';
            ctx.lineWidth = currentSize;
        });

        // Drawing functions
        function startDrawing(e) {
            isDrawing = true;
            const rect = canvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            ctx.beginPath();
            ctx.moveTo(x, y);

            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            ctx.lineWidth = currentSize;

            if (currentTool === 'eraser') {
                ctx.strokeStyle = 'white';
            } else {
                ctx.strokeStyle = currentColor;
            }
        }

        function draw(e) {
            if (!isDrawing) return;

            const rect = canvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            ctx.lineTo(x, y);
            ctx.stroke();
        }

        function stopDrawing() {
            isDrawing = false;
            ctx.closePath();
        }

        // Mouse events
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        // Touch events for mobile
        canvas.addEventListener('touchstart', (e) => {
            e.preventDefault();
            const touch = e.touches[0];
            const mouseEvent = new MouseEvent('mousedown', {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        });

        canvas.addEventListener('touchmove', (e) => {
            e.preventDefault();
            const touch = e.touches[0];
            const mouseEvent = new MouseEvent('mousemove', {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        });

        canvas.addEventListener('touchend', (e) => {
            e.preventDefault();
            const mouseEvent = new MouseEvent('mouseup', {});
            canvas.dispatchEvent(mouseEvent);
        });

        // Clear canvas
        clearBtn.addEventListener('click', () => {
            ctx.fillStyle = 'white';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
        });

        // Save canvas
        saveBtn.addEventListener('click', () => {
            const link = document.createElement('a');
            link.download = 'whiteboard-drawing.png';
            link.href = canvas.toDataURL();
            link.click();
        });

        // Initialize
        ctx.strokeStyle = currentColor;
        ctx.lineWidth = currentSize;
    </script>
</body>
</html>