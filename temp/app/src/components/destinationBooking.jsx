import { useMemo, useState } from "react";
import {
  CalendarDays,
  CheckCircle2,
  Clock3,
  CreditCard,
  ExternalLink,
  MapPinned,
  Minus,
  Navigation,
  Plus,
  Route,
  ShieldCheck,
  Star,
  Ticket,
  TrainFront,
  Users,
  WalletCards,
} from "lucide-react";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Input } from "@/components/ui/input";

const destinations = [
  {
    id: "dufan",
    name: "Dufan Ancol",
    area: "Jakarta Utara",
    category: "Theme Park",
    image: "https://images.unsplash.com/photo-1566205780052-9657b0ed76e7?crop=entropy&cs=srgb&fm=jpg&ixlib=rb-4.1.0&q=85",
    crowd: 85,
    eta: "38 min",
    rating: 4.8,
    priceFrom: 120000,
    mapQuery: "Dufan Ancol Jakarta",
    position: { left: "68%", top: "24%" },
    description: "Taman hiburan populer dengan rekomendasi jam masuk dinamis untuk menghindari antrean padat.",
    highlights: ["Fast Track", "Family friendly", "AR gate access"],
  },
  {
    id: "kota-tua",
    name: "Kota Tua",
    area: "Jakarta Barat",
    category: "Heritage Walk",
    image: "https://images.unsplash.com/photo-1613286791675-6b6de0495f56?crop=entropy&cs=srgb&fm=jpg&ixlib=rb-4.1.0&q=85",
    crowd: 52,
    eta: "24 min",
    rating: 4.7,
    priceFrom: 45000,
    mapQuery: "Kota Tua Jakarta",
    position: { left: "36%", top: "32%" },
    description: "Koridor sejarah, museum, dan kafe heritage dengan rute jalan kaki yang ramah wisatawan.",
    highlights: ["Museum pass", "Photo route", "Walking guide"],
  },
  {
    id: "monas",
    name: "Monas",
    area: "Jakarta Pusat",
    category: "Landmark",
    image: "https://images.unsplash.com/photo-1609589673734-224e4253f89c?crop=entropy&cs=srgb&fm=jpg&ixlib=rb-4.1.0&q=85",
    crowd: 61,
    eta: "18 min",
    rating: 4.6,
    priceFrom: 65000,
    mapQuery: "Monas Jakarta",
    position: { left: "52%", top: "48%" },
    description: "Ikon nasional dengan preview antrean, estimasi lift, dan jalur transport publik terdekat.",
    highlights: ["Observation deck", "Transit nearby", "Low emission route"],
  },
  {
    id: "ancol",
    name: "Ancol Beach City",
    area: "Jakarta Utara",
    category: "Waterfront",
    image: "https://images.unsplash.com/photo-1566205780052-9657b0ed76e7?crop=entropy&cs=srgb&fm=jpg&ixlib=rb-4.1.0&q=85",
    crowd: 44,
    eta: "32 min",
    rating: 4.5,
    priceFrom: 85000,
    mapQuery: "Ancol Beach City Jakarta",
    position: { left: "74%", top: "38%" },
    description: "Area waterfront untuk keluarga, sunset walk, dan bundling transport menuju destinasi sekitar Ancol.",
    highlights: ["Sunset route", "Transport bundle", "Family zone"],
  },
  {
    id: "ragunan",
    name: "Ragunan Zoo",
    area: "Jakarta Selatan",
    category: "Eco Tourism",
    image: "https://images.unsplash.com/photo-1581852017103-68ac65514cf7?crop=entropy&cs=srgb&fm=jpg&ixlib=rb-4.1.0&q=85",
    crowd: 39,
    eta: "42 min",
    rating: 4.7,
    priceFrom: 50000,
    mapQuery: "Ragunan Zoo Jakarta",
    position: { left: "48%", top: "78%" },
    description: "Destinasi hijau dengan rute teduh, pengaturan kepadatan area satwa, dan rekomendasi jam keluarga.",
    highlights: ["Eco route", "Kids pass", "Shaded path"],
  },
];

const ticketTypes = [
  { id: "adult", label: "Dewasa", price: 120000, note: "Usia 13+" },
  { id: "child", label: "Anak", price: 80000, note: "Usia 3–12" },
  { id: "family", label: "Keluarga", price: 340000, note: "2 dewasa + 2 anak" },
];

const packages = [
  { id: "regular", label: "Reguler", add: 0, icon: Ticket, note: "Masuk sesuai jadwal rekomendasi" },
  { id: "fast-track", label: "Fast Track", add: 65000, icon: Navigation, note: "Akses antrean prioritas" },
  { id: "transport", label: "Bundling Transport", add: 45000, icon: TrainFront, note: "Tiket + rute transit cerdas" },
];

const formatRupiah = (amount) =>
  new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", maximumFractionDigits: 0 }).format(amount);

export function DestinationBooking() {
  const [selectedId, setSelectedId] = useState("dufan");
  const [selectedPackage, setSelectedPackage] = useState("regular");
  const [tickets, setTickets] = useState({ adult: 1, child: 0, family: 0 });
  const [bookingDate, setBookingDate] = useState("2026-05-08");
  const [customer, setCustomer] = useState({ name: "", email: "" });
  const [confirmation, setConfirmation] = useState(null);

  const selectedDestination = destinations.find((destination) => destination.id === selectedId) || destinations[0];
  const selectedTicketPackage = packages.find((item) => item.id === selectedPackage) || packages[0];
  const totalTickets = Object.values(tickets).reduce((sum, count) => sum + count, 0);

  const ticketSubtotal = useMemo(
    () =>
      ticketTypes.reduce((sum, type) => sum + tickets[type.id] * (type.price + selectedTicketPackage.add), 0),
    [tickets, selectedTicketPackage.add]
  );

  const serviceFee = totalTickets > 0 ? 15000 : 0;
  const totalPrice = ticketSubtotal + serviceFee;
  const canConfirm = totalTickets > 0 && customer.name.trim() && customer.email.trim() && bookingDate;

  const updateTicket = (id, direction) => {
    setTickets((current) => ({
      ...current,
      [id]: Math.max(0, current[id] + direction),
    }));
    setConfirmation(null);
  };

  const handleConfirm = (event) => {
    event.preventDefault();
    if (!canConfirm) return;
    setConfirmation({
      code: `AICC-${selectedDestination.id.toUpperCase().slice(0, 3)}-${Math.floor(1000 + Math.random() * 9000)}`,
      destination: selectedDestination.name,
      packageName: selectedTicketPackage.label,
      total: totalPrice,
    });
  };

  return (
    <section id="destinations" className="px-4 py-20 sm:px-6" data-testid="destination-booking-section">
      <div className="mx-auto max-w-7xl" data-testid="destination-booking-container">
        <div className="mb-10 flex flex-col justify-between gap-6 lg:flex-row lg:items-end" data-testid="destination-heading-row">
          <div className="max-w-3xl" data-testid="destination-heading-block">
            <p className="section-kicker" data-testid="destination-kicker">Destination intelligence + ticketing</p>
            <h2 className="section-title" data-testid="destination-headline">Lihat lokasi, cek kepadatan, lalu pesan tiket dalam satu alur.</h2>
            <p className="section-copy" data-testid="destination-description">
              Wisatawan bisa memilih destinasi Jakarta, melihat peta interaktif, membuka Google Maps, memilih paket tiket, lalu mendapatkan konfirmasi booking demo tanpa pembayaran asli.
            </p>
          </div>
          <div className="rounded-2xl border border-emerald-100 bg-white/75 p-4 shadow-xl shadow-emerald-950/5 backdrop-blur-xl" data-testid="booking-flow-status-card">
            <div className="flex items-center gap-3" data-testid="booking-flow-status-row">
              <span className="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700" data-testid="booking-flow-status-icon">
                <ShieldCheck className="h-5 w-5" aria-hidden="true" />
              </span>
              <div>
                <p className="text-sm font-black text-slate-950" data-testid="booking-flow-status-title">Demo booking aktif</p>
                <p className="text-xs font-bold text-slate-500" data-testid="booking-flow-status-note">Tanpa pembayaran asli</p>
              </div>
            </div>
          </div>
        </div>

        <div className="grid gap-6 xl:grid-cols-[0.82fr_1.18fr]" data-testid="destination-booking-grid">
          <div className="space-y-4" data-testid="destination-card-list">
            {destinations.map((destination) => {
              const isSelected = destination.id === selectedId;
              return (
                <button
                  key={destination.id}
                  type="button"
                  onClick={() => {
                    setSelectedId(destination.id);
                    setConfirmation(null);
                  }}
                  className={`group w-full overflow-hidden rounded-3xl border p-3 text-left shadow-xl backdrop-blur-xl transition-transform duration-300 hover:-translate-y-1 ${
                    isSelected
                      ? "border-cyan-300 bg-cyan-50/90 shadow-cyan-950/12"
                      : "border-white/80 bg-white/75 shadow-slate-200/60 hover:border-cyan-200"
                  }`}
                  data-testid={`destination-select-${destination.id}-button`}
                >
                  <div className="grid gap-4 sm:grid-cols-[9rem_1fr]" data-testid={`destination-${destination.id}-content`}>
                    <div className="aspect-[4/3] overflow-hidden rounded-2xl bg-slate-200" data-testid={`destination-${destination.id}-image-wrapper`}>
                      <img src={destination.image} alt={destination.name} className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" data-testid={`destination-${destination.id}-image`} />
                    </div>
                    <div className="min-w-0" data-testid={`destination-${destination.id}-info`}>
                      <div className="flex flex-wrap items-center gap-2" data-testid={`destination-${destination.id}-meta-row`}>
                        <span className="rounded-full bg-white px-3 py-1 text-xs font-black text-cyan-700" data-testid={`destination-${destination.id}-category`}>{destination.category}</span>
                        <span className="inline-flex items-center gap-1 text-xs font-black text-amber-500" data-testid={`destination-${destination.id}-rating`}><Star className="h-3.5 w-3.5 fill-amber-400" aria-hidden="true" /> {destination.rating}</span>
                      </div>
                      <h3 className="mt-3 text-xl font-black text-slate-950" data-testid={`destination-${destination.id}-name`}>{destination.name}</h3>
                      <p className="mt-1 text-sm font-bold text-slate-500" data-testid={`destination-${destination.id}-area`}><MapPinned className="mr-1 inline h-4 w-4 text-cyan-600" aria-hidden="true" />{destination.area}</p>
                      <div className="mt-4 grid grid-cols-3 gap-2" data-testid={`destination-${destination.id}-stats`}>
                        <div className="rounded-2xl bg-white/80 p-3" data-testid={`destination-${destination.id}-crowd-stat`}>
                          <p className="text-xs font-bold text-slate-500">Crowd</p>
                          <p className="text-sm font-black text-slate-950">{destination.crowd}%</p>
                        </div>
                        <div className="rounded-2xl bg-white/80 p-3" data-testid={`destination-${destination.id}-eta-stat`}>
                          <p className="text-xs font-bold text-slate-500">ETA</p>
                          <p className="text-sm font-black text-slate-950">{destination.eta}</p>
                        </div>
                        <div className="rounded-2xl bg-white/80 p-3" data-testid={`destination-${destination.id}-price-stat`}>
                          <p className="text-xs font-bold text-slate-500">From</p>
                          <p className="text-sm font-black text-slate-950">{formatRupiah(destination.priceFrom)}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </button>
              );
            })}
          </div>

          <div className="space-y-6" data-testid="booking-detail-column">
            <Card className="overflow-hidden rounded-[2rem] border-white/80 bg-white/80 shadow-2xl shadow-cyan-950/8 backdrop-blur-2xl" data-testid="destination-map-card">
              <CardContent className="p-4 sm:p-6" data-testid="destination-map-content">
                <div className="mb-5 flex flex-col justify-between gap-4 md:flex-row md:items-center" data-testid="map-card-header">
                  <div data-testid="selected-destination-summary">
                    <p className="text-xs font-black uppercase tracking-[0.18em] text-cyan-700" data-testid="selected-destination-label">Selected destination</p>
                    <h3 className="mt-1 text-2xl font-black tracking-tight text-slate-950" data-testid="selected-destination-name">{selectedDestination.name}</h3>
                    <p className="mt-2 max-w-2xl text-sm font-semibold leading-6 text-slate-600" data-testid="selected-destination-description">{selectedDestination.description}</p>
                  </div>
                  <a
                    href={`https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(selectedDestination.mapQuery)}`}
                    target="_blank"
                    rel="noreferrer"
                    className="inline-flex items-center justify-center gap-2 rounded-full bg-slate-950 px-5 py-3 text-sm font-black text-white shadow-lg transition-transform duration-300 hover:-translate-y-0.5"
                    data-testid="open-google-maps-link"
                  >
                    Buka Google Maps <ExternalLink className="h-4 w-4" aria-hidden="true" />
                  </a>
                </div>

                <div className="grid gap-4 lg:grid-cols-[1fr_0.95fr]" data-testid="map-preview-grid">
                  <div className="relative min-h-[22rem] overflow-hidden rounded-3xl border border-cyan-100 bg-[radial-gradient(circle_at_24%_18%,rgba(14,165,233,0.24),transparent_18rem),linear-gradient(135deg,#e0f7ff,#f0fdf4)]" data-testid="interactive-smart-map">
                    <div className="absolute left-8 right-8 top-1/2 h-4 -rotate-12 rounded-full bg-white/70 shadow-inner" data-testid="mock-map-road-main" />
                    <div className="absolute bottom-12 left-12 top-8 w-4 rotate-12 rounded-full bg-white/70 shadow-inner" data-testid="mock-map-road-vertical" />
                    <div className="absolute inset-0 bg-[linear-gradient(rgba(14,165,233,0.08)_1px,transparent_1px),linear-gradient(90deg,rgba(14,165,233,0.08)_1px,transparent_1px)] bg-[size:34px_34px]" data-testid="mock-map-grid-overlay" />
                    {destinations.map((destination) => {
                      const active = destination.id === selectedId;
                      return (
                        <button
                          key={destination.id}
                          type="button"
                          onClick={() => {
                            setSelectedId(destination.id);
                            setConfirmation(null);
                          }}
                          className={`absolute -translate-x-1/2 -translate-y-1/2 rounded-full border-4 border-white shadow-xl transition-transform duration-300 hover:scale-110 ${active ? "h-14 w-14 bg-cyan-500 text-white" : "h-10 w-10 bg-emerald-400 text-slate-950"}`}
                          style={destination.position}
                          aria-label={`Pilih ${destination.name}`}
                          data-testid={`map-marker-${destination.id}-button`}
                        >
                          <MapPinned className="mx-auto h-5 w-5" aria-hidden="true" />
                        </button>
                      );
                    })}
                    <div className="absolute bottom-4 left-4 right-4 rounded-3xl border border-white/70 bg-white/80 p-4 shadow-xl backdrop-blur-2xl" data-testid="map-live-info-panel">
                      <div className="flex flex-wrap items-center justify-between gap-3" data-testid="map-live-info-row">
                        <div>
                          <p className="text-sm font-black text-slate-950" data-testid="map-live-info-title">{selectedDestination.name}</p>
                          <p className="text-xs font-bold text-slate-500" data-testid="map-live-info-subtitle">Crowd {selectedDestination.crowd}% · ETA {selectedDestination.eta}</p>
                        </div>
                        <span className="rounded-full bg-emerald-100 px-3 py-1 text-xs font-black text-emerald-700" data-testid="map-live-route-status">Smart route ready</span>
                      </div>
                    </div>
                  </div>

                  <div className="overflow-hidden rounded-3xl border border-cyan-100 bg-slate-100" data-testid="google-maps-embed-wrapper">
                    <iframe
                      title={`Google Maps preview ${selectedDestination.name}`}
                      src={`https://www.google.com/maps?q=${encodeURIComponent(selectedDestination.mapQuery)}&output=embed`}
                      className="h-full min-h-[22rem] w-full border-0"
                      loading="lazy"
                      referrerPolicy="no-referrer-when-downgrade"
                      data-testid="google-maps-embed-frame"
                    />
                  </div>
                </div>

                <div className="mt-5 flex flex-wrap gap-2" data-testid="destination-highlight-list">
                  {selectedDestination.highlights.map((highlight) => (
                    <span key={highlight} className="rounded-full border border-cyan-100 bg-cyan-50 px-3 py-2 text-xs font-black text-cyan-800" data-testid={`destination-highlight-${highlight.toLowerCase().replaceAll(" ", "-")}`}>
                      {highlight}
                    </span>
                  ))}
                </div>
              </CardContent>
            </Card>

            <form onSubmit={handleConfirm} className="grid gap-6 lg:grid-cols-[1fr_0.82fr]" data-testid="ticket-booking-form">
              <Card className="rounded-[2rem] border-white/80 bg-white/80 shadow-2xl shadow-emerald-950/8 backdrop-blur-2xl" data-testid="ticket-selection-card">
                <CardContent className="p-5 sm:p-6" data-testid="ticket-selection-content">
                  <div className="flex items-center gap-3" data-testid="ticket-selection-header">
                    <span className="flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-700" data-testid="ticket-selection-icon"><Ticket className="h-5 w-5" aria-hidden="true" /></span>
                    <div>
                      <h3 className="text-xl font-black text-slate-950" data-testid="ticket-selection-title">Pilih tiket & paket</h3>
                      <p className="text-sm font-bold text-slate-500" data-testid="ticket-selection-subtitle">Dewasa, anak, keluarga, reguler, fast track, atau transport.</p>
                    </div>
                  </div>

                  <div className="mt-6 grid gap-3 sm:grid-cols-3" data-testid="package-selection-grid">
                    {packages.map((item) => {
                      const Icon = item.icon;
                      const active = item.id === selectedPackage;
                      return (
                        <button
                          key={item.id}
                          type="button"
                          onClick={() => {
                            setSelectedPackage(item.id);
                            setConfirmation(null);
                          }}
                          className={`rounded-2xl border p-4 text-left transition-transform duration-300 hover:-translate-y-1 ${active ? "border-cyan-300 bg-cyan-50 shadow-lg shadow-cyan-950/10" : "border-slate-100 bg-white"}`}
                          data-testid={`package-select-${item.id}-button`}
                        >
                          <Icon className="h-5 w-5 text-cyan-700" aria-hidden="true" />
                          <p className="mt-3 text-sm font-black text-slate-950" data-testid={`package-${item.id}-label`}>{item.label}</p>
                          <p className="mt-1 text-xs font-bold leading-5 text-slate-500" data-testid={`package-${item.id}-note`}>{item.note}</p>
                          <p className="mt-3 text-xs font-black text-emerald-700" data-testid={`package-${item.id}-price`}>{item.add ? `+ ${formatRupiah(item.add)}/tiket` : "Termasuk"}</p>
                        </button>
                      );
                    })}
                  </div>

                  <div className="mt-6 space-y-3" data-testid="ticket-type-list">
                    {ticketTypes.map((type) => (
                      <div key={type.id} className="flex flex-col gap-4 rounded-2xl border border-slate-100 bg-white p-4 sm:flex-row sm:items-center sm:justify-between" data-testid={`ticket-type-${type.id}-row`}>
                        <div data-testid={`ticket-type-${type.id}-info`}>
                          <p className="font-black text-slate-950" data-testid={`ticket-type-${type.id}-label`}>{type.label}</p>
                          <p className="text-xs font-bold text-slate-500" data-testid={`ticket-type-${type.id}-note`}>{type.note} · {formatRupiah(type.price + selectedTicketPackage.add)}</p>
                        </div>
                        <div className="flex items-center gap-3" data-testid={`ticket-type-${type.id}-counter`}>
                          <button type="button" onClick={() => updateTicket(type.id, -1)} className="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-700 transition-transform hover:scale-105" data-testid={`ticket-${type.id}-decrement-button`} aria-label={`Kurangi tiket ${type.label}`}>
                            <Minus className="h-4 w-4" aria-hidden="true" />
                          </button>
                          <span className="w-8 text-center text-lg font-black text-slate-950" data-testid={`ticket-${type.id}-count`}>{tickets[type.id]}</span>
                          <button type="button" onClick={() => updateTicket(type.id, 1)} className="flex h-10 w-10 items-center justify-center rounded-full bg-cyan-500 text-white shadow-lg shadow-cyan-500/20 transition-transform hover:scale-105" data-testid={`ticket-${type.id}-increment-button`} aria-label={`Tambah tiket ${type.label}`}>
                            <Plus className="h-4 w-4" aria-hidden="true" />
                          </button>
                        </div>
                      </div>
                    ))}
                  </div>
                </CardContent>
              </Card>

              <Card className="rounded-[2rem] border-slate-900/10 bg-slate-950 text-white shadow-2xl shadow-slate-950/20" data-testid="booking-summary-card">
                <CardContent className="p-5 sm:p-6" data-testid="booking-summary-content">
                  <div className="flex items-center gap-3" data-testid="booking-summary-header">
                    <span className="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-300/15 text-emerald-200" data-testid="booking-summary-icon"><WalletCards className="h-5 w-5" aria-hidden="true" /></span>
                    <div>
                      <h3 className="text-xl font-black" data-testid="booking-summary-title">Ringkasan booking</h3>
                      <p className="text-sm font-bold text-slate-400" data-testid="booking-summary-subtitle">Konfirmasi demo, tanpa charge.</p>
                    </div>
                  </div>

                  <div className="mt-6 grid gap-3" data-testid="customer-form-grid">
                    <label className="block" data-testid="booking-date-label">
                      <span className="mb-2 flex items-center gap-2 text-sm font-black text-cyan-100"><CalendarDays className="h-4 w-4" aria-hidden="true" />Tanggal kunjungan</span>
                      <Input type="date" value={bookingDate} onChange={(event) => { setBookingDate(event.target.value); setConfirmation(null); }} className="h-12 rounded-2xl border-white/10 bg-white/10 text-white" data-testid="booking-date-input" />
                    </label>
                    <label className="block" data-testid="customer-name-label">
                      <span className="mb-2 flex items-center gap-2 text-sm font-black text-cyan-100"><Users className="h-4 w-4" aria-hidden="true" />Nama pelanggan</span>
                      <Input value={customer.name} onChange={(event) => { setCustomer((current) => ({ ...current, name: event.target.value })); setConfirmation(null); }} placeholder="Nama lengkap" className="h-12 rounded-2xl border-white/10 bg-white/10 text-white placeholder:text-slate-500" data-testid="customer-name-input" />
                    </label>
                    <label className="block" data-testid="customer-email-label">
                      <span className="mb-2 flex items-center gap-2 text-sm font-black text-cyan-100"><CreditCard className="h-4 w-4" aria-hidden="true" />Email e-ticket</span>
                      <Input type="email" value={customer.email} onChange={(event) => { setCustomer((current) => ({ ...current, email: event.target.value })); setConfirmation(null); }} placeholder="email@example.com" className="h-12 rounded-2xl border-white/10 bg-white/10 text-white placeholder:text-slate-500" data-testid="customer-email-input" />
                    </label>
                  </div>

                  <div className="mt-6 space-y-3 rounded-3xl border border-white/10 bg-white/[0.06] p-4" data-testid="booking-price-breakdown">
                    <div className="flex justify-between gap-4 text-sm font-bold text-slate-300" data-testid="booking-destination-line"><span>Destinasi</span><span>{selectedDestination.name}</span></div>
                    <div className="flex justify-between gap-4 text-sm font-bold text-slate-300" data-testid="booking-package-line"><span>Paket</span><span>{selectedTicketPackage.label}</span></div>
                    <div className="flex justify-between gap-4 text-sm font-bold text-slate-300" data-testid="booking-ticket-line"><span>Total tiket</span><span>{totalTickets}</span></div>
                    <div className="flex justify-between gap-4 text-sm font-bold text-slate-300" data-testid="booking-service-fee-line"><span>Service fee demo</span><span>{formatRupiah(serviceFee)}</span></div>
                    <div className="border-t border-white/10 pt-3" data-testid="booking-total-row">
                      <div className="flex justify-between gap-4 text-lg font-black" data-testid="booking-total-line"><span>Total</span><span>{formatRupiah(totalPrice)}</span></div>
                    </div>
                  </div>

                  <Button type="submit" disabled={!canConfirm} className="mt-5 h-13 w-full rounded-full bg-gradient-to-r from-cyan-400 to-emerald-300 py-6 text-base font-black text-slate-950 shadow-xl shadow-cyan-500/20 disabled:opacity-45" data-testid="confirm-booking-button">
                    Konfirmasi Booking Demo
                  </Button>

                  {confirmation && (
                    <div className="mt-5 rounded-3xl border border-emerald-300/30 bg-emerald-300/10 p-4" data-testid="booking-confirmation-panel">
                      <div className="flex items-start gap-3" data-testid="booking-confirmation-row">
                        <CheckCircle2 className="mt-0.5 h-5 w-5 text-emerald-200" aria-hidden="true" />
                        <div>
                          <p className="font-black text-emerald-100" data-testid="booking-confirmation-title">Booking berhasil dibuat</p>
                          <p className="mt-1 text-sm font-bold text-slate-300" data-testid="booking-confirmation-code">Kode: {confirmation.code}</p>
                          <p className="mt-1 text-xs font-bold text-slate-400" data-testid="booking-confirmation-note">E-ticket demo untuk {confirmation.destination} · {confirmation.packageName} · {formatRupiah(confirmation.total)}</p>
                        </div>
                      </div>
                    </div>
                  )}

                  <div className="mt-5 flex items-center gap-2 text-xs font-bold text-slate-400" data-testid="booking-smart-note">
                    <Clock3 className="h-4 w-4 text-cyan-200" aria-hidden="true" />
                    Sistem merekomendasikan jam masuk lebih sepi berdasarkan crowd forecast.
                  </div>
                </CardContent>
              </Card>
            </form>
          </div>
        </div>
      </div>
    </section>
  );
}