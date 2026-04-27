import { useEffect, useState } from "react";
import "@/App.css";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import {
  Activity,
  ArrowRight,
  BarChart3,
  Bot,
  BrainCircuit,
  Building2,
  Camera,
  Car,
  CloudSun,
  Gauge,
  Leaf,
  LockKeyhole,
  Mail,
  MapPin,
  Menu,
  Navigation,
  PlayCircle,
  RadioTower,
  Route as RouteIcon,
  ScanFace,
  ShieldCheck,
  Sparkles,
  Ticket,
  Trash2,
  UserRound,
  WalletCards,
  Waves,
  X,
} from "lucide-react";
import {
  Area,
  AreaChart,
  CartesianGrid,
  Line,
  LineChart,
  ResponsiveContainer,
  Tooltip,
  XAxis,
  YAxis,
} from "recharts";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { DestinationBooking } from "@/components/DestinationBooking";

const heroImage =
  "https://images.pexels.com/photos/14381373/pexels-photo-14381373.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=900&w=1300";

const navItems = [
  { label: "Home", href: "#home", testId: "nav-home-link" },
  { label: "Features", href: "#features", testId: "nav-features-link" },
  { label: "Destinations", href: "#destinations", testId: "nav-destinations-link" },
  { label: "AR Live Cam", href: "#ar-live-cam", testId: "nav-ar-live-cam-link" },
  { label: "City Dashboard", href: "#city-dashboard", testId: "nav-city-dashboard-link" },
];

const featureCards = [
  {
    icon: BrainCircuit,
    title: "Contextual AI Assistant",
    text: "GPT-4 Powered Travel Guide for hyper-personalized routing.",
    testId: "feature-contextual-ai-card",
  },
  {
    icon: RouteIcon,
    title: "Proactive Crowd Optimizer",
    text: "LSTM & Ant Colony algorithm to avoid peak hours and traffic.",
    testId: "feature-crowd-optimizer-card",
  },
  {
    icon: Camera,
    title: "Immersive Real-Time Preview",
    text: "Live IoT 360° Cams & AR/VR destination previews.",
    testId: "feature-realtime-preview-card",
  },
  {
    icon: Ticket,
    title: "Smart Booking & Dynamic Pricing",
    text: "Automated booking with AI-driven dynamic pricing.",
    testId: "feature-smart-booking-card",
  },
  {
    icon: ScanFace,
    title: "Unified Payment & Access",
    text: "Ticketless entry via Biometric Facial Recognition.",
    testId: "feature-unified-payment-card",
  },
];

const predictionData = [
  { time: "08:00", crowd: 28, transit: 62 },
  { time: "10:00", crowd: 46, transit: 70 },
  { time: "12:00", crowd: 73, transit: 58 },
  { time: "14:00", crowd: 85, transit: 65 },
  { time: "16:00", crowd: 61, transit: 78 },
  { time: "18:00", crowd: 42, transit: 83 },
];

const operationsData = [
  { zone: "North", value: 42 },
  { zone: "East", value: 66 },
  { zone: "Central", value: 88 },
  { zone: "South", value: 50 },
  { zone: "West", value: 72 },
];

function Navbar() {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <header className="fixed inset-x-0 top-0 z-50 px-4 pt-4 sm:px-6" data-testid="navbar-wrapper">
      <nav
        className="mx-auto flex max-w-7xl items-center justify-between rounded-2xl border border-white/70 bg-white/75 px-4 py-3 shadow-[0_18px_70px_rgba(14,116,144,0.16)] backdrop-blur-2xl"
        data-testid="navbar"
      >
        <a href="#home" className="group flex items-center gap-3" data-testid="brand-home-link">
          <span className="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-[#0ea5e9] to-[#10b981] text-white shadow-lg shadow-cyan-500/25 transition-transform duration-300 group-hover:-rotate-6 group-hover:scale-105" data-testid="brand-logo-icon">
            <Building2 className="h-5 w-5" aria-hidden="true" />
          </span>
          <span className="leading-tight" data-testid="brand-name-block">
            <span className="block text-sm font-black tracking-tight text-slate-950" data-testid="brand-name-text">
              AI City Companion
            </span>
            <span className="block text-xs font-semibold text-slate-500" data-testid="brand-tagline-text">
              Smart tourism OS
            </span>
          </span>
        </a>

        <div className="hidden items-center gap-1 lg:flex" data-testid="desktop-navigation-links">
          {navItems.map((item) => (
            <a
              key={item.href}
              href={item.href}
              className="rounded-full px-4 py-2 text-sm font-bold text-slate-600 transition-colors duration-200 hover:bg-cyan-50 hover:text-cyan-700"
              data-testid={item.testId}
            >
              {item.label}
            </a>
          ))}
        </div>

        <div className="hidden items-center gap-3 sm:flex" data-testid="navbar-actions">
          <Button
            className="rounded-full bg-slate-950 px-5 py-5 text-white shadow-xl shadow-cyan-950/15 transition-transform duration-300 hover:-translate-y-0.5 hover:bg-slate-800"
            data-testid="navbar-face-id-login-button"
          >
            <ScanFace className="h-4 w-4" aria-hidden="true" />
            Login with Face ID
          </Button>
        </div>

        <button
          type="button"
          className="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-950 text-white transition-transform duration-300 hover:scale-105 lg:hidden"
          onClick={() => setIsOpen((value) => !value)}
          aria-label="Toggle navigation menu"
          aria-expanded={isOpen}
          data-testid="mobile-menu-toggle-button"
        >
          {isOpen ? <X className="h-5 w-5" aria-hidden="true" /> : <Menu className="h-5 w-5" aria-hidden="true" />}
        </button>
      </nav>

      {isOpen && (
        <div
          className="mx-auto mt-3 max-w-7xl rounded-2xl border border-white/80 bg-white/90 p-3 shadow-2xl backdrop-blur-2xl lg:hidden"
          data-testid="mobile-navigation-menu"
        >
          {navItems.map((item) => (
            <a
              key={item.href}
              href={item.href}
              className="block rounded-xl px-4 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-cyan-50"
              onClick={() => setIsOpen(false)}
              data-testid={`mobile-${item.testId}`}
            >
              {item.label}
            </a>
          ))}
          <Button className="mt-2 w-full rounded-full bg-slate-950 py-6 text-white" data-testid="mobile-face-id-login-button">
            <ScanFace className="h-4 w-4" aria-hidden="true" />
            Login with Face ID
          </Button>
        </div>
      )}
    </header>
  );
}

function HeroSection() {
  return (
    <section id="home" className="relative overflow-hidden pt-32 sm:pt-36" data-testid="hero-section">
      <div className="absolute inset-0 -z-10" data-testid="hero-background-layer">
        <div className="absolute left-[-12rem] top-24 h-80 w-80 rounded-full bg-cyan-300/30 blur-3xl" />
        <div className="absolute right-[-10rem] top-60 h-96 w-96 rounded-full bg-emerald-300/30 blur-3xl" />
        <div className="absolute inset-x-0 top-0 h-[34rem] bg-[radial-gradient(circle_at_50%_0%,rgba(14,165,233,0.22),transparent_56%)]" />
      </div>

      <div className="mx-auto grid max-w-7xl items-center gap-12 px-4 pb-20 sm:px-6 lg:grid-cols-[0.94fr_1.06fr] lg:pb-28" data-testid="hero-content-grid">
        <div className="max-w-3xl" data-testid="hero-copy-block">
          <div className="inline-flex items-center gap-2 rounded-full border border-cyan-200 bg-white/80 px-4 py-2 text-sm font-extrabold text-cyan-800 shadow-lg shadow-cyan-500/10 backdrop-blur-xl" data-testid="hero-trust-badge">
            <Sparkles className="h-4 w-4 text-emerald-500" aria-hidden="true" />
            AI-ready tourism and city operations
          </div>
          <h1 className="mt-8 text-4xl font-black tracking-[-0.055em] text-slate-950 sm:text-5xl lg:text-6xl" data-testid="hero-headline">
            Seamless Travel. Smart City. Powered by AI.
          </h1>
          <p className="mt-6 max-w-2xl text-base font-medium leading-8 text-slate-600 md:text-lg" data-testid="hero-subheadline">
            Experience dynamic itineraries, real-time crowd avoidance, and immersive VR previews seamlessly integrated with public services.
          </p>
          <div className="mt-8 flex flex-col gap-3 sm:flex-row" data-testid="hero-button-group">
            <Button onClick={() => document.getElementById("destinations")?.scrollIntoView({ behavior: "smooth" })} className="group rounded-full bg-gradient-to-r from-[#0284c7] to-[#10b981] px-7 py-6 text-base font-extrabold text-white shadow-2xl shadow-cyan-500/25 transition-transform duration-300 hover:-translate-y-1" data-testid="generate-smart-itinerary-button">
              Generate Smart Itinerary
              <ArrowRight className="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true" />
            </Button>
            <Button onClick={() => document.getElementById("ar-live-cam")?.scrollIntoView({ behavior: "smooth" })} variant="outline" className="rounded-full border-cyan-200 bg-white/80 px-7 py-6 text-base font-extrabold text-slate-800 shadow-lg backdrop-blur-xl transition-transform duration-300 hover:-translate-y-1 hover:bg-cyan-50" data-testid="try-ar-preview-button">
              <PlayCircle className="h-4 w-4 text-cyan-600" aria-hidden="true" />
              Try AR Preview
            </Button>
          </div>

          <div className="mt-10 grid grid-cols-3 gap-3 sm:max-w-xl" data-testid="hero-metric-strip">
            {[
              ["34%", "less queue time", "hero-queue-metric"],
              ["12k", "daily travelers", "hero-travelers-metric"],
              ["98.2%", "access uptime", "hero-uptime-metric"],
            ].map(([value, label, testId]) => (
              <div key={label} className="rounded-2xl border border-white bg-white/70 p-4 shadow-xl shadow-slate-200/60 backdrop-blur-xl" data-testid={testId}>
                <div className="text-xl font-black text-slate-950" data-testid={`${testId}-value`}>{value}</div>
                <div className="mt-1 text-xs font-bold text-slate-500" data-testid={`${testId}-label`}>{label}</div>
              </div>
            ))}
          </div>
        </div>

        <div className="relative" data-testid="hero-visual-block">
          <div className="absolute -left-4 -top-5 z-10 rounded-2xl border border-white/70 bg-white/75 p-4 shadow-2xl shadow-cyan-950/10 backdrop-blur-2xl sm:left-4" data-testid="hero-floating-crowd-badge">
            <div className="flex items-center gap-3">
              <span className="flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-red-500" data-testid="crowd-badge-icon"><MapPin className="h-5 w-5" aria-hidden="true" /></span>
              <div>
                <p className="text-sm font-black text-slate-950" data-testid="crowd-badge-title">📍 Dufan: Crowd Intensity 85%</p>
                <p className="text-xs font-bold text-red-500" data-testid="crowd-badge-status">Heavy · reroute suggested</p>
              </div>
            </div>
          </div>
          <div className="absolute -right-2 top-24 z-10 rounded-2xl border border-white/70 bg-white/75 p-4 shadow-2xl shadow-emerald-950/10 backdrop-blur-2xl" data-testid="hero-floating-weather-badge">
            <div className="flex items-center gap-3">
              <span className="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-500" data-testid="weather-badge-icon"><CloudSun className="h-5 w-5" aria-hidden="true" /></span>
              <div>
                <p className="text-sm font-black text-slate-950" data-testid="weather-badge-title">⛅ Weather: Sunny</p>
                <p className="text-xs font-bold text-emerald-600" data-testid="weather-badge-status">Outdoor route optimized</p>
              </div>
            </div>
          </div>
          <div className="absolute bottom-8 left-2 z-10 rounded-2xl border border-white/70 bg-white/75 p-4 shadow-2xl shadow-cyan-950/10 backdrop-blur-2xl sm:left-10" data-testid="hero-floating-traffic-badge">
            <div className="flex items-center gap-3">
              <span className="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600" data-testid="traffic-badge-icon"><Car className="h-5 w-5" aria-hidden="true" /></span>
              <div>
                <p className="text-sm font-black text-slate-950" data-testid="traffic-badge-title">🚦 Traffic: Smooth</p>
                <p className="text-xs font-bold text-cyan-600" data-testid="traffic-badge-status">ETA stable across zones</p>
              </div>
            </div>
          </div>

          <div className="hero-device relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-3 shadow-[0_30px_100px_rgba(15,23,42,0.18)] backdrop-blur-2xl" data-testid="hero-city-device-frame">
            <div className="relative aspect-[4/3] overflow-hidden rounded-[1.55rem] bg-slate-900" data-testid="hero-city-image-wrapper">
              <img src={heroImage} alt="Modern Jakarta skyline for smart city tourism" className="h-full w-full object-cover object-center opacity-90" data-testid="hero-city-image" />
              <div className="absolute inset-0 bg-gradient-to-br from-cyan-950/20 via-transparent to-emerald-400/20" data-testid="hero-image-gradient-overlay" />
              <div className="city-grid-overlay" data-testid="hero-ar-grid-overlay" />
              <div className="absolute bottom-5 right-5 rounded-2xl border border-white/30 bg-slate-950/55 p-4 text-white backdrop-blur-xl" data-testid="hero-ar-live-cam-panel">
                <div className="flex items-center gap-2 text-xs font-black uppercase tracking-[0.22em] text-emerald-300" data-testid="live-cam-status">
                  <span className="h-2 w-2 rounded-full bg-emerald-300 shadow-[0_0_16px_rgba(110,231,183,0.9)]" />
                  AR Live Cam
                </div>
                <p className="mt-2 text-sm font-bold" data-testid="live-cam-description">360° preview · Kota Tua corridor</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

function FeaturesSection() {
  return (
    <section id="features" className="px-4 py-20 sm:px-6" data-testid="features-section">
      <div className="mx-auto max-w-7xl" data-testid="features-container">
        <div className="max-w-3xl" data-testid="features-heading-block">
          <p className="section-kicker" data-testid="features-kicker">Five platform pillars</p>
          <h2 className="section-title" data-testid="features-headline">A tourism assistant that thinks like a city command center.</h2>
          <p className="section-copy" data-testid="features-description">Each interaction blends personal travel planning, live operations, predictive analytics, and secure access into one calm, trustworthy experience.</p>
        </div>
        <div className="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-5" data-testid="features-card-grid">
          {featureCards.map((feature, index) => {
            const Icon = feature.icon;
            return (
              <Card key={feature.title} className="feature-card group rounded-2xl border-cyan-100/80 bg-white/78 shadow-xl shadow-cyan-950/5 backdrop-blur-xl" data-testid={feature.testId}>
                <CardContent className="p-6" data-testid={`${feature.testId}-content`}>
                  <div className="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-100 to-emerald-100 text-cyan-700 transition-transform duration-300 group-hover:-rotate-6 group-hover:scale-110" data-testid={`${feature.testId}-icon-wrapper`}>
                    <Icon className="h-7 w-7" aria-hidden="true" />
                  </div>
                  <p className="text-lg font-black tracking-tight text-slate-950" data-testid={`${feature.testId}-title`}>{feature.title}</p>
                  <p className="mt-4 text-sm font-medium leading-6 text-slate-600" data-testid={`${feature.testId}-text`}>{feature.text}</p>
                  <div className="mt-6 flex items-center gap-2 text-xs font-black uppercase tracking-[0.18em] text-emerald-600" data-testid={`${feature.testId}-status`}>
                    Layer {String(index + 1).padStart(2, "0")} · Online
                  </div>
                </CardContent>
              </Card>
            );
          })}
        </div>
      </div>
    </section>
  );
}

function ChatbotSection() {
  return (
    <section id="ar-live-cam" className="px-4 py-20 sm:px-6" data-testid="chatbot-demo-section">
      <div className="mx-auto grid max-w-7xl items-center gap-8 lg:grid-cols-[0.9fr_1.1fr]" data-testid="chatbot-demo-grid">
        <div className="rounded-[2rem] border border-white/80 bg-white/70 p-8 shadow-2xl shadow-cyan-950/8 backdrop-blur-2xl" data-testid="distilbert-explanation-card">
          <p className="section-kicker" data-testid="distilbert-kicker">DistilBERT NLP Engine</p>
          <h2 className="section-title" data-testid="distilbert-headline">Understands intent, urgency, and traveler emotion.</h2>
          <p className="section-copy" data-testid="distilbert-description">The companion detects whether a traveler is excited, stressed, time-limited, or crowd-sensitive, then adjusts recommendations using live public service signals.</p>
          <div className="mt-8 grid gap-4 sm:grid-cols-2" data-testid="nlp-capability-grid">
            {[
              [BrainCircuit, "Emotion-aware planning", "Reads soft preferences and mood cues.", "nlp-emotion-card"],
              [RadioTower, "IoT signal fusion", "Blends crowd, traffic, and weather data.", "nlp-iot-card"],
              [ShieldCheck, "Trusted access", "Keeps identity and payment flows secure.", "nlp-trust-card"],
              [Leaf, "Eco-priority routing", "Prioritizes transit and low-emission paths.", "nlp-eco-card"],
            ].map(([Icon, title, text, testId]) => (
              <div key={title} className="rounded-2xl border border-cyan-100 bg-cyan-50/50 p-4" data-testid={testId}>
                <Icon className="h-5 w-5 text-cyan-700" aria-hidden="true" />
                <p className="mt-3 text-sm font-black text-slate-950" data-testid={`${testId}-title`}>{title}</p>
                <p className="mt-1 text-xs font-bold leading-5 text-slate-500" data-testid={`${testId}-text`}>{text}</p>
              </div>
            ))}
          </div>
        </div>

        <div className="chat-shell rounded-[2rem] border border-slate-900/10 bg-slate-950 p-4 shadow-[0_30px_100px_rgba(2,132,199,0.28)]" data-testid="chatbot-mockup-shell">
          <div className="rounded-[1.5rem] border border-white/10 bg-[radial-gradient(circle_at_top_left,rgba(14,165,233,0.22),transparent_38%),#020617] p-4 sm:p-6" data-testid="chatbot-mockup-panel">
            <div className="flex items-center justify-between border-b border-white/10 pb-4" data-testid="chatbot-header">
              <div className="flex items-center gap-3" data-testid="chatbot-agent-block">
                <span className="flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-400/15 text-cyan-200" data-testid="chatbot-agent-icon"><Bot className="h-5 w-5" aria-hidden="true" /></span>
                <div>
                  <p className="text-sm font-black text-white" data-testid="chatbot-agent-name">City Companion AI</p>
                  <p className="text-xs font-bold text-emerald-300" data-testid="chatbot-agent-status">Live operations aware</p>
                </div>
              </div>
              <span className="rounded-full border border-emerald-300/30 bg-emerald-300/10 px-3 py-1 text-xs font-black text-emerald-200" data-testid="chatbot-safety-badge">Secure demo</span>
            </div>

            <div className="mt-6 space-y-4" data-testid="chatbot-message-list">
              <div className="ml-auto max-w-[86%] rounded-2xl rounded-tr-md bg-cyan-400 px-4 py-3 text-sm font-bold leading-6 text-slate-950" data-testid="chatbot-user-message">
                I want to visit a theme park but avoid the crowds today.
              </div>
              <div className="max-w-[92%] rounded-2xl rounded-tl-md border border-white/10 bg-white/10 px-4 py-3 text-sm font-medium leading-6 text-cyan-50 backdrop-blur-xl" data-testid="chatbot-ai-message">
                I found a lower-crowd route. Dufan is heavy now, so I recommend a delayed entry window with a waterfront stop first.
              </div>
            </div>

            <div className="mt-5 rounded-3xl border border-cyan-300/20 bg-white/[0.08] p-5 backdrop-blur-2xl" data-testid="dynamic-route-card">
              <div className="flex flex-wrap items-start justify-between gap-4" data-testid="route-card-header">
                <div>
                  <p className="text-xs font-black uppercase tracking-[0.2em] text-cyan-200" data-testid="route-card-label">Generated route</p>
                  <h3 className="mt-2 text-xl font-black text-white" data-testid="route-card-title">Eco Loop to Ancol · Crowd-safe</h3>
                </div>
                <span className="rounded-full bg-emerald-300 px-3 py-1 text-xs font-black text-slate-950" data-testid="route-card-confidence">92% match</span>
              </div>
              <div className="mt-5 grid gap-3 sm:grid-cols-3" data-testid="route-card-step-grid">
                {[
                  ["09:40", "MRT + shuttle", "Low traffic", "route-step-transit"],
                  ["10:25", "Seaside lunch", "Crowd 31%", "route-step-lunch"],
                  ["13:10", "Dufan entry", "Crowd 54%", "route-step-entry"],
                ].map(([time, title, status, testId]) => (
                  <div key={title} className="rounded-2xl border border-white/10 bg-slate-950/45 p-4" data-testid={testId}>
                    <p className="text-lg font-black text-white" data-testid={`${testId}-time`}>{time}</p>
                    <p className="mt-1 text-sm font-bold text-cyan-100" data-testid={`${testId}-title`}>{title}</p>
                    <p className="mt-2 text-xs font-black text-emerald-300" data-testid={`${testId}-status`}>{status}</p>
                  </div>
                ))}
              </div>
              <div className="mt-5 flex items-center gap-3 rounded-2xl bg-cyan-400/10 p-4 text-cyan-50" data-testid="route-card-alert">
                <Navigation className="h-5 w-5 text-cyan-200" aria-hidden="true" />
                <p className="text-sm font-bold" data-testid="route-card-alert-text">Estimated total journey: 4h 20m · 27 minutes saved versus direct route.</p>
              </div>
            </div>

            <div className="mt-5 flex items-center gap-3 rounded-full border border-white/10 bg-white/5 px-4 py-3" data-testid="chatbot-input-preview">
              <span className="flex-1 text-sm font-bold text-slate-400" data-testid="chatbot-input-placeholder">Ask about routes, tickets, weather, or access...</span>
              <button className="rounded-full bg-cyan-400 px-4 py-2 text-xs font-black text-slate-950" data-testid="chatbot-send-preview-button">Send</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

function DashboardSection() {
  return (
    <section id="city-dashboard" className="px-4 py-20 sm:px-6" data-testid="city-dashboard-section">
      <div className="mx-auto max-w-7xl" data-testid="city-dashboard-container">
        <div className="mb-10 flex flex-col justify-between gap-6 lg:flex-row lg:items-end" data-testid="city-dashboard-heading-row">
          <div className="max-w-3xl" data-testid="city-dashboard-heading-block">
            <p className="section-kicker" data-testid="city-dashboard-kicker">B2B operations sneak peek</p>
            <h2 className="section-title" data-testid="city-dashboard-headline">For City Managers: Real-Time Command Center.</h2>
            <p className="section-copy" data-testid="city-dashboard-description">A dark-mode cockpit for predicting crowd pressure, monitoring infrastructure, and coordinating safer, greener travel flows.</p>
          </div>
          <div className="rounded-2xl border border-cyan-100 bg-white/75 p-4 shadow-lg backdrop-blur-xl" data-testid="dashboard-uptime-card">
            <p className="text-xs font-black uppercase tracking-[0.18em] text-slate-500" data-testid="dashboard-uptime-label">Network status</p>
            <p className="mt-1 text-2xl font-black text-emerald-600" data-testid="dashboard-uptime-value">All 42 nodes online</p>
          </div>
        </div>

        <div className="dashboard-frame rounded-[2rem] border border-slate-800 bg-slate-950 p-4 shadow-[0_35px_120px_rgba(15,23,42,0.35)] sm:p-6" data-testid="dashboard-mockup-frame">
          <div className="mb-5 flex flex-col justify-between gap-4 border-b border-white/10 pb-5 md:flex-row md:items-center" data-testid="dashboard-topbar">
            <div className="flex items-center gap-3" data-testid="dashboard-title-block">
              <span className="flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-400/15 text-cyan-200" data-testid="dashboard-title-icon"><BarChart3 className="h-6 w-6" aria-hidden="true" /></span>
              <div>
                <p className="text-lg font-black text-white" data-testid="dashboard-title">Jakarta Smart Tourism Command</p>
                <p className="text-sm font-bold text-slate-400" data-testid="dashboard-subtitle">Crowd, mobility, waste, flood, and access intelligence</p>
              </div>
            </div>
            <div className="flex flex-wrap gap-2" data-testid="dashboard-status-pills">
              {[
                ["Flood sensors", "Stable", "dashboard-pill-flood"],
                ["Waste mgmt", "86% clear", "dashboard-pill-waste"],
                ["Transit load", "Balanced", "dashboard-pill-transit"],
              ].map(([label, value, testId]) => (
                <div key={label} className="rounded-full border border-white/10 bg-white/5 px-3 py-2" data-testid={testId}>
                  <span className="text-xs font-bold text-slate-400" data-testid={`${testId}-label`}>{label}: </span>
                  <span className="text-xs font-black text-emerald-300" data-testid={`${testId}-value`}>{value}</span>
                </div>
              ))}
            </div>
          </div>

          <div className="grid gap-5 lg:grid-cols-[1.35fr_0.65fr]" data-testid="dashboard-content-grid">
            <div className="rounded-3xl border border-white/10 bg-white/[0.04] p-5" data-testid="dashboard-crowd-chart-card">
              <div className="mb-5 flex items-start justify-between gap-4" data-testid="crowd-chart-heading-row">
                <div>
                  <p className="text-sm font-black text-white" data-testid="crowd-chart-title">Crowd prediction vs transit readiness</p>
                  <p className="text-xs font-bold text-slate-400" data-testid="crowd-chart-subtitle">Six-hour predictive window</p>
                </div>
                <span className="rounded-full bg-red-400/10 px-3 py-1 text-xs font-black text-red-200" data-testid="crowd-chart-alert">Peak at 14:00</span>
              </div>
              <div className="h-72" data-testid="crowd-chart-visual">
                <ResponsiveContainer width="100%" height="100%">
                  <LineChart data={predictionData} margin={{ left: -24, right: 10, top: 10, bottom: 0 }}>
                    <CartesianGrid stroke="rgba(255,255,255,0.08)" vertical={false} />
                    <XAxis dataKey="time" stroke="#94a3b8" tickLine={false} axisLine={false} fontSize={12} />
                    <YAxis stroke="#94a3b8" tickLine={false} axisLine={false} fontSize={12} />
                    <Tooltip contentStyle={{ background: "#020617", border: "1px solid rgba(255,255,255,0.12)", borderRadius: 16, color: "#fff" }} />
                    <Line type="monotone" dataKey="crowd" stroke="#38bdf8" strokeWidth={4} dot={false} />
                    <Line type="monotone" dataKey="transit" stroke="#34d399" strokeWidth={4} dot={false} />
                  </LineChart>
                </ResponsiveContainer>
              </div>
            </div>

            <div className="grid gap-5" data-testid="dashboard-side-column">
              <div className="rounded-3xl border border-white/10 bg-white/[0.04] p-5" data-testid="dashboard-heatmap-card">
                <p className="text-sm font-black text-white" data-testid="traffic-heatmap-title">City traffic heatmap</p>
                <div className="mt-4 grid grid-cols-5 gap-2" data-testid="traffic-heatmap-grid">
                  {Array.from({ length: 25 }).map((_, index) => {
                    const isHot = [7, 8, 12, 13, 17].includes(index);
                    const isMedium = [3, 6, 11, 16, 18, 21].includes(index);
                    const heatClass = isHot
                      ? "bg-red-400 opacity-90"
                      : isMedium
                        ? "bg-cyan-400 opacity-70"
                        : "bg-emerald-400 opacity-50";
                    return <span key={index} className={`aspect-square rounded-xl ${heatClass}`} data-testid={`traffic-heatmap-cell-${index + 1}`} />;
                  })}
                </div>
              </div>

              <div className="rounded-3xl border border-white/10 bg-white/[0.04] p-5" data-testid="dashboard-operations-card">
                <p className="text-sm font-black text-white" data-testid="operations-chart-title">Zone service pressure</p>
                <div className="mt-4 h-40" data-testid="operations-chart-visual">
                  <ResponsiveContainer width="100%" height="100%">
                    <AreaChart data={operationsData} margin={{ left: -28, right: 0, top: 6, bottom: 0 }}>
                      <XAxis dataKey="zone" stroke="#94a3b8" tickLine={false} axisLine={false} fontSize={10} />
                      <YAxis hide />
                      <Area type="monotone" dataKey="value" stroke="#34d399" fill="#34d399" fillOpacity={0.22} strokeWidth={3} />
                    </AreaChart>
                  </ResponsiveContainer>
                </div>
              </div>
            </div>
          </div>

          <div className="mt-5 grid gap-4 md:grid-cols-3" data-testid="dashboard-sensor-grid">
            {[
              [Waves, "Flood Sensors", "River gates normal", "dashboard-flood-sensor-card"],
              [Trash2, "Waste Management", "7 smart bins need pickup", "dashboard-waste-card"],
              [Gauge, "Mobility Index", "Smooth in 9 of 12 zones", "dashboard-mobility-card"],
            ].map(([Icon, title, status, testId]) => (
              <div key={title} className="rounded-3xl border border-white/10 bg-white/[0.04] p-5" data-testid={testId}>
                <Icon className="h-5 w-5 text-cyan-200" aria-hidden="true" />
                <p className="mt-4 text-sm font-black text-white" data-testid={`${testId}-title`}>{title}</p>
                <p className="mt-1 text-xs font-bold text-slate-400" data-testid={`${testId}-status`}>{status}</p>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}

function Footer() {
  return (
    <footer className="px-4 pb-8 pt-16 sm:px-6" data-testid="footer-section">
      <div className="mx-auto max-w-7xl rounded-[2rem] border border-cyan-100 bg-white/75 p-6 shadow-xl shadow-cyan-950/5 backdrop-blur-xl" data-testid="footer-card">
        <div className="grid gap-8 lg:grid-cols-[1fr_1.2fr] lg:items-center" data-testid="footer-grid">
          <div data-testid="footer-brand-block">
            <div className="flex items-center gap-3" data-testid="footer-brand-row">
              <span className="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-[#0ea5e9] to-[#10b981] text-white" data-testid="footer-brand-logo"><Building2 className="h-5 w-5" aria-hidden="true" /></span>
              <p className="text-lg font-black text-slate-950" data-testid="footer-brand-name">AI City Companion</p>
            </div>
            <p className="mt-4 max-w-md text-sm font-semibold leading-6 text-slate-500" data-testid="footer-description">Enterprise-grade AI travel assistance for visitors, operators, and sustainable smart-city growth.</p>
          </div>
          <div className="grid gap-5 md:grid-cols-[0.8fr_1.2fr]" data-testid="footer-actions-grid">
            <div className="flex flex-col gap-3" data-testid="footer-link-list">
              <a href="#home" className="footer-link" data-testid="footer-privacy-policy-link"><LockKeyhole className="h-4 w-4" aria-hidden="true" /> Privacy Policy</a>
              <a href="#features" className="footer-link" data-testid="footer-sso-info-link"><ShieldCheck className="h-4 w-4" aria-hidden="true" /> SSO Integration info</a>
            </div>
            <form className="rounded-2xl border border-cyan-100 bg-cyan-50/60 p-3" data-testid="newsletter-form">
              <label htmlFor="newsletter-email" className="mb-2 block text-sm font-black text-slate-950" data-testid="newsletter-label">Get smart tourism updates</label>
              <div className="flex flex-col gap-2 sm:flex-row" data-testid="newsletter-input-row">
                <Input id="newsletter-email" type="email" placeholder="city.team@example.com" className="h-12 rounded-full bg-white" data-testid="newsletter-email-input" />
                <Button type="button" className="h-12 rounded-full bg-slate-950 px-5 text-white" data-testid="newsletter-submit-button">
                  <Mail className="h-4 w-4" aria-hidden="true" /> Subscribe
                </Button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </footer>
  );
}

function ExternalWidgetTestIdBridge() {
  useEffect(() => {
    const tagExternalBadge = () => {
      const anchors = Array.from(document.querySelectorAll("a"));
      const badge = anchors.find((anchor) => anchor.textContent?.includes("Made with Emergent"));
      if (badge && !badge.getAttribute("data-testid")) {
        badge.setAttribute("data-testid", "external-made-with-emergent-link");
      }
    };

    tagExternalBadge();
    const observer = new MutationObserver(tagExternalBadge);
    observer.observe(document.body, { childList: true, subtree: true });
    return () => observer.disconnect();
  }, []);

  return null;
}

function Home() {
  return (
    <main className="min-h-screen overflow-hidden bg-[#f7fbff] text-slate-950" data-testid="ai-city-companion-landing-page">
      <ExternalWidgetTestIdBridge />
      <Navbar />
      <HeroSection />
      <FeaturesSection />
      <DestinationBooking />
      <ChatbotSection />
      <DashboardSection />
      <Footer />
    </main>
  );
}

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
