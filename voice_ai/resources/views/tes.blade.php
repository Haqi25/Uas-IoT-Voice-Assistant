{{-- Coba file ini sebagai 'resources/views/tes.blade.php' --}}
<!DOCTYPE html>
<html>
<head>
    <title>Voice Assistant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .box { margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Dashboard Voice Assistant</h1>
    <button id="start-btn">Mulai Voice Chat</button>

    <h2>📜 Riwayat Percakapan</h2>
    <div id="history-container">Memuat...</div>

    <script>
        document.getElementById('start-btn').addEventListener('click', function () {
            fetch('http://192.168.100.38:5001/listen')
                .then(res => res.json())
                .then(data => {
                    loadHistory();
                });
        });

       async function loadHistory() {
    try {
        const response = await fetch("http://192.168.100.38:5001/latest");
        const item = await response.json();

        const container = document.getElementById("history-container");
        container.innerHTML = "";

        const div = document.createElement("div");
        div.className = "box";
        div.innerHTML = `<div>🗣️ ${item.prompt}</div><div>🤖 ${item.reply}</div>`;
        container.appendChild(div);
    } catch (err) {
        document.getElementById("history-container").innerText = "Gagal mengambil data.";
        console.error(err);
    }
}

        window.onload = loadHistory;
    </script>
</body>
</html>
