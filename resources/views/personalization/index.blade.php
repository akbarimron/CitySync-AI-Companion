<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sivi - AI City Companion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
        html, body { margin: 0; padding: 0; height: 100%; }

        /* Custom Scrollbar - matching theme */
        #chat-box::-webkit-scrollbar { width: 4px; }
        #chat-box::-webkit-scrollbar-thumb { background: rgba(20, 184, 166, 0.3); border-radius: 4px; }
        #chat-box::-webkit-scrollbar-track { background: transparent; }

        .typing-dot { animation: blink 1.2s infinite; }
        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }
        @keyframes blink {
            0%, 100% { opacity: 0.2; transform: scale(0.85); }
            50% { opacity: 1; transform: scale(1); }
        }

        .bubble-in { animation: fadeUp 0.25s ease; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Hover effect for quick buttons matching primary button style */
        .qbtn:hover { 
            background: rgba(6, 182, 212, 0.2) !important; 
            border-color: #22d3ee !important;
        }

        #message:focus { outline: none; box-shadow: 0 0 0 2px rgba(6, 182, 212, 0.4); }
    </style>
</head>

<body class="bg-[#021f24] min-h-screen flex items-center justify-center p-4" style="background: radial-gradient(circle at center, #08333b 0%, #021f24 100%);">

<div class="w-full max-w-4xl flex flex-col rounded-3xl border border-white/10 overflow-hidden shadow-2xl bg-[#01161a]/80 backdrop-blur-md" style="height: 92vh; min-height: 520px;">

    <!-- ===== HEADER ===== -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-white/10 bg-white/5 flex-shrink-0">
        <div class="flex items-center gap-3">
            <!-- Icon matching the logo in image -->
            <div class="w-10 h-10 rounded-xl bg-cyan-500/20 flex items-center justify-center text-cyan-400 border border-cyan-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M8 10h.01"/><path d="M16 10h.01"/><path d="M8 14h.01"/><path d="M16 14h.01"/></svg>
            </div>
            <div>
                <h1 class="font-bold text-white text-base leading-tight">Sivi - AI City Companion</h1>
                <p class="text-[10px] text-cyan-400/80 uppercase tracking-widest font-semibold mt-0.5">Smart Tourism OS</p>
            </div>
        </div>
        <button class="px-4 py-1.5 rounded-full bg-cyan-400/10 border border-cyan-400/40 text-cyan-300 text-xs font-medium">
            ● SQL-Backed System
        </button>
    </div>

    <!-- ===== CHAT AREA ===== -->
    <div id="chat-box" class="flex-1 overflow-y-auto px-5 py-5 space-y-4 text-white">
        <!-- messages injected here by JS -->
    </div>

    <!-- ===== INPUT ===== -->
    <div class="px-5 py-4 border-t border-white/10 bg-white/5 flex items-center gap-3 flex-shrink-0">
        <input
            id="message"
            type="text"
            placeholder="Eksplorasi destinasi dari satu alur..."
            class="flex-1 bg-white/5 border border-white/10 rounded-full px-5 py-2.5 text-sm text-white placeholder-white/20 transition"
        >
        <button
            onclick="handleSend()"
            class="bg-cyan-500 hover:bg-cyan-400 transition text-[#021f24] font-bold text-sm px-6 py-2.5 rounded-full flex-shrink-0 shadow-[0_0_15px_rgba(6,182,212,0.4)]"
        >
            Kirim
        </button>
    </div>

</div>

<script>
// Logic and Dummy Data remain the same for prototype functionality
const RESPONSES = [
    {
        triggers: ["ancol","dufan","theme park","taman bermain","wahana"],
        text: "Saya menemukan rute kepadatan rendah untukmu. Dufan sedang ramai sekarang — saya rekomendasikan masuk lebih siang dan singgah di tepi laut dulu.",
        card: {
            label: "SQL-GENERATED ROUTE", match: "92% MATCH",
            title: "Eco Loop ke Ancol · Bebas Macet",
            stops: [
                { time: "09:40", desc: "MRT + shuttle",       crowd: "Lalu lintas rendah" },
                { time: "10:25", desc: "Makan siang tepi laut", crowd: "Kepadatan 31%" },
                { time: "13:10", desc: "Masuk Dufan",           crowd: "Kepadatan 54%" }
            ],
            summary: "Estimasi total perjalanan: 4j 20m · Data ditarik dari MySQL secara real-time."
        }
    },
    {
        triggers: ["monas","monumen nasional","center","pusat kota"],
        text: "Siap! Monas paling sepi di pagi hari. Ini rute terbaik lewat TransJakarta.",
        card: {
            label: "DASHBOARD INSIGHT", match: "87% MATCH",
            title: "TransJakarta ke Monas · Pagi santai",
            stops: [
                { time: "08:00", desc: "TJ Koridor 1",    crowd: "Hampir kosong" },
                { time: "08:35", desc: "Tiba di Monas",   crowd: "Kepadatan 18%" },
                { time: "10:00", desc: "Museum Nasional", crowd: "Kepadatan 22%" }
            ],
            summary: "Estimasi total perjalanan: 2j 15m · Sesuai alur navigasi rapi."
        }
    },
    {
        triggers: ["cuaca","hujan","panas","weather","hari ini"],
        text: "Cuaca Jakarta hari ini cerah berawan, suhu sekitar 31°C. Alur perjalanan tetap aman tanpa gangguan hujan hingga sore hari.",
        card: null
    },
    {
        triggers: ["macet","lalu lintas","traffic","kemacetan"],
        text: "Monitor AI menunjukkan: Tol Dalam Kota padat, Jl. Sudirman normal. Disarankan gunakan MRT agar pengalaman tetap konsisten.",
        card: null
    }
];

const DEFAULT = {
    text: "Maaf, Sivi belum memiliki data spesifik untuk itu. Coba tanya rute ke Ancol, Monas, atau info cuaca terbaru!",
    card: null
};

const QUICK = ["Rute ke Ancol", "Cuaca hari ini", "Info Lalu Lintas", "Rute ke Monas"];

// RENDER HELPERS
const box = document.getElementById('chat-box');

function scrollBottom() { box.scrollTop = box.scrollHeight; }

function appendUser(msg) {
    const d = document.createElement('div');
    d.className = 'flex justify-end bubble-in';
    d.innerHTML = `<div class="bg-cyan-500 text-[#021f24] px-5 py-3 rounded-2xl rounded-br-sm max-w-md text-sm font-semibold">${escHtml(msg)}</div>`;
    box.appendChild(d);
    scrollBottom();
}

function appendBot(text) {
    const d = document.createElement('div');
    d.className = 'flex justify-start bubble-in';
    d.innerHTML = `<div class="bg-white/10 text-white/90 border border-white/5 px-5 py-3 rounded-2xl rounded-bl-sm max-w-md text-sm leading-relaxed">${escHtml(text)}</div>`;
    box.appendChild(d);
    scrollBottom();
}

function buildCard(card) {
    const stops = card.stops.map(s => `
        <div class="bg-[#032a31] p-4 rounded-xl border border-white/5">
            <p class="text-base font-bold text-cyan-400">${s.time}</p>
            <p class="text-[11px] text-gray-300 mt-1 uppercase font-medium tracking-tight">${s.desc}</p>
            <p class="text-[10px] text-emerald-400 mt-1 font-bold">STATUS: ${s.crowd}</p>
        </div>`).join('');

    return `
    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 bubble-in">
        <div class="flex justify-between items-center mb-3">
            <span class="text-[10px] tracking-widest text-cyan-400 font-bold">${card.label}</span>
            <span class="bg-cyan-500 text-[#021f24] text-[9px] font-black px-3 py-0.5 rounded-full">${card.match}</span>
        </div>
        <h2 class="text-base font-semibold text-white mb-4">${card.title}</h2>
        <div class="grid grid-cols-3 gap-3 mb-4">${stops}</div>
        <div class="bg-cyan-500/10 border border-cyan-500/20 text-cyan-200 px-4 py-2.5 rounded-xl text-xs leading-relaxed italic">
            Note: ${card.summary}
        </div>
    </div>`;
}

function appendCardHtml(html) {
    const d = document.createElement('div');
    d.innerHTML = html;
    box.appendChild(d.firstElementChild);
    scrollBottom();
}

function appendTyping() {
    const d = document.createElement('div');
    d.id = 'typing';
    d.className = 'flex justify-start';
    d.innerHTML = `
        <div class="bg-white/10 px-4 py-3 rounded-2xl rounded-bl-sm flex items-center gap-1.5 border border-white/5">
            <span class="typing-dot w-2 h-2 rounded-full bg-cyan-400 block"></span>
            <span class="typing-dot w-2 h-2 rounded-full bg-cyan-400 block"></span>
            <span class="typing-dot w-2 h-2 rounded-full bg-cyan-400 block"></span>
        </div>`;
    box.appendChild(d);
    scrollBottom();
}

function removeTyping() { document.getElementById('typing')?.remove(); }
function removeQuick() { document.getElementById('quick-wrap')?.remove(); }

function appendQuick() {
    removeQuick();
    const wrap = document.createElement('div');
    wrap.id = 'quick-wrap';
    wrap.className = 'flex flex-wrap gap-2 pt-1 bubble-in';
    QUICK.forEach(q => {
        const btn = document.createElement('button');
        btn.className = 'qbtn text-[11px] px-4 py-2 rounded-full border border-cyan-500/30 bg-cyan-500/5 text-cyan-300 transition cursor-pointer font-medium uppercase tracking-wider';
        btn.textContent = q;
        btn.onclick = () => handleSend(q);
        wrap.appendChild(btn);
    });
    box.appendChild(wrap);
    scrollBottom();
}

function escHtml(str) { return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

async function handleSend(preset) {
    const input = document.getElementById('message');
    const msg = preset || input.value.trim();
    if (!msg) return;
    input.value = '';

    removeQuick();
    appendUser(msg);
    appendTyping();

    await new Promise(r => setTimeout(r, 800));
    removeTyping();

    const lower = msg.toLowerCase();
    let reply = DEFAULT;
    for (const r of RESPONSES) {
        if (r.triggers.some(t => lower.includes(t))) { reply = r; break; }
    }

    appendBot(reply.text);
    if (reply.card) appendCardHtml(buildCard(reply.card));
    appendQuick();
}

document.getElementById('message').addEventListener('keypress', e => { if (e.key === 'Enter') handleSend(); });

(function init() {
    appendBot("Selamat datang di Sivi - AI City Companion. Jelajahi destinasi dari satu alur yang rapi. Ada yang bisa saya bantu hari ini?");
    appendQuick();
})();
</script>
</body>
</html>