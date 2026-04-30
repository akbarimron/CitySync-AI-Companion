<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Companion AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
        html, body { margin: 0; padding: 0; height: 100%; }

        #chat-box::-webkit-scrollbar { width: 4px; }
        #chat-box::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 4px; }
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

        .qbtn:hover { background: rgba(34,211,238,0.2) !important; }

        #message:focus { outline: none; box-shadow: 0 0 0 2px rgba(34,211,238,0.5); }
    </style>
</head>

<body class="bg-gradient-to-br from-[#031b34] via-[#041c3a] to-[#021024] min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-4xl flex flex-col rounded-3xl border border-white/10 overflow-hidden shadow-2xl" style="height: 92vh; min-height: 520px;">

    <!-- ===== HEADER ===== -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-white/10 bg-white/5 flex-shrink-0">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-cyan-500/20 flex items-center justify-center text-xl">🤖</div>
            <div>
                <h1 class="font-bold text-white text-base leading-tight">City Companion AI</h1>
                <p class="text-xs text-cyan-300 mt-0.5">Live operations aware</p>
            </div>
        </div>
        <button class="px-4 py-1.5 rounded-full bg-emerald-400/10 border border-emerald-300/60 text-emerald-300 text-xs font-medium">
            ● Secure demo
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
            placeholder="Tanya rute, tiket, cuaca, atau akses..."
            class="flex-1 bg-white/5 border border-white/10 rounded-full px-5 py-2.5 text-sm text-white placeholder-white/30 transition"
        >
        <button
            onclick="handleSend()"
            class="bg-cyan-400 hover:bg-cyan-300 transition text-black font-semibold text-sm px-5 py-2.5 rounded-full flex-shrink-0"
        >
            Kirim
        </button>
    </div>

</div>

<script>
// ─── DUMMY DATA ──────────────────────────────────────────────
const RESPONSES = [
    {
        triggers: ["ancol","dufan","theme park","taman bermain","wahana"],
        text: "Saya menemukan rute kepadatan rendah untukmu. Dufan sedang ramai sekarang — saya rekomendasikan masuk lebih siang dan singgah di tepi laut dulu.",
        card: {
            label: "RUTE TERGENERASI", match: "92% cocok",
            title: "Eco Loop ke Ancol · Aman dari kepadatan",
            stops: [
                { time: "09:40", desc: "MRT + shuttle",       crowd: "Lalu lintas rendah" },
                { time: "10:25", desc: "Makan siang tepi laut", crowd: "Kepadatan 31%" },
                { time: "13:10", desc: "Masuk Dufan",          crowd: "Kepadatan 54%" }
            ],
            summary: "Estimasi total perjalanan: 4j 20m · Hemat 27 menit dari rute langsung."
        }
    },
    {
        triggers: ["monas","monumen nasional","center","pusat kota"],
        text: "Siap! Monas paling sepi di pagi hari. Ini rute terbaik lewat TransJakarta.",
        card: {
            label: "RUTE TERGENERASI", match: "87% cocok",
            title: "TransJakarta ke Monas · Pagi santai",
            stops: [
                { time: "08:00", desc: "TJ Koridor 1",    crowd: "Hampir kosong" },
                { time: "08:35", desc: "Tiba di Monas",   crowd: "Kepadatan 18%" },
                { time: "10:00", desc: "Museum Nasional", crowd: "Kepadatan 22%" }
            ],
            summary: "Estimasi total perjalanan: 2j 15m · Hemat 15 menit dari rute biasa."
        }
    },
    {
        triggers: ["kota tua","fatahillah","museum","sejarah","colonial"],
        text: "Kota Tua sangat pas di hari kerja! Pengunjung sedang sepi sekarang. Ini rutenya.",
        card: {
            label: "RUTE TERGENERASI", match: "89% cocok",
            title: "MRT + KRL ke Kota Tua · Wisata sejarah",
            stops: [
                { time: "09:00", desc: "MRT → Stasiun Kota", crowd: "Hampir kosong" },
                { time: "09:50", desc: "Tiba Kota Tua",       crowd: "Kepadatan 25%" },
                { time: "11:00", desc: "Museum Fatahillah",   crowd: "Kepadatan 35%" }
            ],
            summary: "Estimasi total perjalanan: 3j 30m · Hemat 20 menit dari rute langsung."
        }
    },
    {
        triggers: ["cuaca","hujan","panas","weather","hari ini"],
        text: "Cuaca Jakarta hari ini cerah berawan, suhu sekitar 31°C. Ada potensi hujan ringan sore pukul 15:00–17:00. Disarankan bawa payung!",
        card: null
    },
    {
        triggers: ["tiket","harga","bayar","booking","pesan","biaya"],
        text: "Berikut estimasi biaya perjalanan hari ini di Jakarta:",
        card: {
            label: "INFO TIKET", match: "Real-time",
            title: "Estimasi biaya hari ini",
            stops: [
                { time: "MRT",   desc: "Rp 3.000 – 14.000", crowd: "Tergantung jarak" },
                { time: "TJ",    desc: "Rp 3.500 flat",      crowd: "Semua koridor" },
                { time: "Dufan", desc: "Rp 250.000",         crowd: "Tiket reguler" }
            ],
            summary: "Total estimasi termasuk tiket masuk: Rp 270.000–280.000 / orang."
        }
    },
    {
        triggers: ["macet","lalu lintas","traffic","kemacetan"],
        text: "Kondisi lalu lintas Jakarta saat ini: Tol Dalam Kota padat, Jl. Sudirman normal, kawasan Senen & Kemayoran ramai. Disarankan gunakan MRT atau TransJakarta.",
        card: null
    }
];

const DEFAULT = {
    text: "Maaf, saya belum punya data untuk itu. Coba tanya rute ke Ancol, Monas, Kota Tua, cuaca, tiket, atau info lalu lintas!",
    card: null
};

const QUICK = ["Rute ke Ancol & Dufan", "Cuaca hari ini", "Harga tiket", "Wisata Kota Tua", "Rute ke Monas", "Info lalu lintas"];

// ─── HELPERS ─────────────────────────────────────────────────
function getReply(msg) {
    const lower = msg.toLowerCase();
    for (const r of RESPONSES) {
        if (r.triggers.some(t => lower.includes(t))) return r;
    }
    return DEFAULT;
}

function buildCard(card) {
    const stops = card.stops.map(s => `
        <div class="bg-[#0a1f3a] p-4 rounded-xl">
            <p class="text-base font-bold text-white">${s.time}</p>
            <p class="text-xs text-gray-300 mt-1">${s.desc}</p>
            <p class="text-xs text-cyan-400 mt-0.5">${s.crowd}</p>
        </div>`).join('');

    return `
    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 bubble-in">
        <div class="flex justify-between items-center mb-3">
            <span class="text-[10px] tracking-widest text-cyan-300">${card.label}</span>
            <span class="bg-emerald-400 text-black text-[10px] font-bold px-3 py-0.5 rounded-full">${card.match}</span>
        </div>
        <h2 class="text-base font-semibold text-white mb-4">${card.title}</h2>
        <div class="grid grid-cols-3 gap-3 mb-4">${stops}</div>
        <div class="bg-cyan-400/10 text-cyan-200 px-4 py-2.5 rounded-xl text-xs leading-relaxed">
            ✈ ${card.summary}
        </div>
    </div>`;
}

// ─── RENDER FUNCTIONS ─────────────────────────────────────────
const box = document.getElementById('chat-box');

function scrollBottom() {
    box.scrollTop = box.scrollHeight;
}

function appendUser(msg) {
    const d = document.createElement('div');
    d.className = 'flex justify-end bubble-in';
    d.innerHTML = `<div class="bg-cyan-400 text-black px-5 py-3 rounded-2xl rounded-br-sm max-w-md text-sm font-medium">${escHtml(msg)}</div>`;
    box.appendChild(d);
    scrollBottom();
}

function appendBot(text) {
    const d = document.createElement('div');
    d.className = 'flex justify-start bubble-in';
    d.innerHTML = `<div class="bg-white/10 text-white px-5 py-3 rounded-2xl rounded-bl-sm max-w-md text-sm leading-relaxed">${escHtml(text)}</div>`;
    box.appendChild(d);
    scrollBottom();
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
        <div class="bg-white/10 px-4 py-3 rounded-2xl rounded-bl-sm flex items-center gap-1.5">
            <span class="typing-dot w-2 h-2 rounded-full bg-cyan-400 block"></span>
            <span class="typing-dot w-2 h-2 rounded-full bg-cyan-400 block"></span>
            <span class="typing-dot w-2 h-2 rounded-full bg-cyan-400 block"></span>
        </div>`;
    box.appendChild(d);
    scrollBottom();
}

function removeTyping() {
    document.getElementById('typing')?.remove();
}

function removeQuick() {
    document.getElementById('quick-wrap')?.remove();
}

function appendQuick() {
    removeQuick();
    const wrap = document.createElement('div');
    wrap.id = 'quick-wrap';
    wrap.className = 'flex flex-wrap gap-2 pt-1 bubble-in';
    QUICK.forEach(q => {
        const btn = document.createElement('button');
        btn.className = 'qbtn text-xs px-3 py-1.5 rounded-full border border-cyan-400/30 bg-cyan-400/10 text-cyan-300 transition cursor-pointer';
        btn.textContent = q;
        btn.onclick = () => handleSend(q);
        wrap.appendChild(btn);
    });
    box.appendChild(wrap);
    scrollBottom();
}

function escHtml(str) {
    return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

// ─── SEND LOGIC ───────────────────────────────────────────────
async function handleSend(preset) {
    const input = document.getElementById('message');
    const msg = preset || input.value.trim();
    if (!msg) return;
    input.value = '';

    removeQuick();
    appendUser(msg);
    appendTyping();

    await new Promise(r => setTimeout(r, 700 + Math.random() * 600));
    removeTyping();

    const reply = getReply(msg);
    appendBot(reply.text);
    if (reply.card) appendCardHtml(buildCard(reply.card));

    appendQuick();
}

document.getElementById('message').addEventListener('keypress', e => {
    if (e.key === 'Enter') handleSend();
});

// ─── INITIAL GREETING ─────────────────────────────────────────
(function init() {
    appendBot("Halo! Saya City Companion AI 👋 Saya bisa bantu kamu menemukan rute terbaik, info cuaca, dan tiket wisata Jakarta. Mau ke mana hari ini?");
    appendQuick();
})();
</script>

</body>
</html>