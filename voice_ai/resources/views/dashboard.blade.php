<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎙️ Dashboard Voice Assistant
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Selamat datang di Voice Assistant 👋</h1>
            <button id="start-btn"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                🎤 Mulai Voice Chat
            </button>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold">📜 Riwayat Percakapan</h2>
            <div id="loading" class="text-gray-500 mt-2">Memuat...</div>
            <div id="history-container" class="space-y-4 text-gray-800 hidden"></div>
        </div>
    </div>

    <script>
 document.getElementById('start-btn').addEventListener('click', function () {
    fetch('/api/esp32/activate', { method: 'POST' })
        .then(res => res.json())
        .then(data => {
            alert("✅ Voice assistant diaktifkan.");
        })
        .catch(err => {
            alert("❌ Gagal mengaktifkan voice assistant.");
            console.error(err);
        });
});


        async function loadHistory() {
            const loading = document.getElementById("loading");
            const container = document.getElementById("history-container");

            loading.classList.remove("hidden");
            container.classList.add("hidden");
            loading.innerText = "📦 Mengambil data...";

            try {
                const response = await fetch("http://192.168.148.119:5001/history");
                const history = await response.json();

                container.innerHTML = "";
                history.reverse().forEach(item => {
                    const div = document.createElement("div");
                    div.className = "border-b border-gray-300 pb-2";
                    div.innerHTML = `
                        <div class="font-semibold">🗣️ <span class="text-blue-700">${item.prompt}</span></div>
                        <div class="text-gray-600">🤖 ${item.reply}</div>
                    `;
                    container.appendChild(div);
                });

                loading.classList.add("hidden");
                container.classList.remove("hidden");
            } catch (err) {
                loading.innerText = "❌ Gagal mengambil data.";
                console.error(err);
            }
        }

        window.onload = loadHistory;
    </script>
</x-app-layout>
