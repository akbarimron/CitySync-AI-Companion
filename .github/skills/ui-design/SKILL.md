---
name: ui-design
description: 'Use when: designing UI components, improving visual design, creating responsive layouts, ensuring accessibility standards, building consistent design systems for CitySync-AI-Companion project.'
---

# UI Design Best Practices untuk CitySync-AI-Companion

## 1. Design System & Consistency

### Color Palette
- **Primary**: Sesuaikan dengan brand CitySync
- **Secondary**: Untuk aksen dan interaksi
- **Neutral**: Gray scale untuk backgrounds dan borders
- **Semantic**: Green (success), Red (error), Yellow (warning), Blue (info)

### Typography
- **Heading**: Gunakan font yang bold dan readable
- **Body**: 14-16px untuk readability
- **Spacing**: Gunakan margin/padding yang konsisten (8, 16, 24, 32px)

## 2. Component Architecture

### Struktur File
```
resources/
  views/
    components/
      ui/
        button.blade.php
        card.blade.php
        modal.blade.php
        form-input.blade.php
      layouts/
        app.blade.php
        sidebar.blade.php
```

### Reusable Components (Blade)
```blade
<!-- components/ui/button.blade.php -->
<button class="btn btn-{{ $variant ?? 'primary' }}" {{ $attributes }}>
    {{ $slot }}
</button>
```

## 3. Responsive Design (Tailwind CSS)

### Breakpoints
- `sm`: 640px (mobile)
- `md`: 768px (tablet)
- `lg`: 1024px (desktop)
- `xl`: 1280px (large desktop)

### Mobile-First Approach
```html
<div class="w-full md:w-1/2 lg:w-1/3">
    <!-- Responsive grid -->
</div>
```

## 4. Accessibility Standards (WCAG 2.1)

- [ ] Semantic HTML (use `<button>`, `<nav>`, `<main>`, etc)
- [ ] Color contrast ratio ≥ 4.5:1 untuk text
- [ ] ARIA labels untuk interactive elements
- [ ] Keyboard navigation support
- [ ] Alt text untuk images

```html
<button aria-label="Close menu" onclick="closeMenu()">
    ✕
</button>
```

## 5. Performance

### Image Optimization
- Gunakan `webp` format untuk modern browsers
- Lazy loading untuk below-the-fold images
- Responsive images dengan `srcset`

```html
<img 
    src="image.webp" 
    srcset="image-small.webp 640w, image-large.webp 1280w"
    loading="lazy"
    alt="Description"
/>
```

### CSS & JS
- Minify CSS dan JavaScript
- Gunakan Tailwind CSS utility classes (pre-configured in `tailwind.config.js`)
- Load critical CSS inline, defer non-critical

## 6. State Management & Interactions

### Loading States
```html
<button :disabled="loading" class="btn" @click="submit">
    <span v-if="loading" class="spinner"></span>
    {{ loading ? 'Loading...' : 'Submit' }}
</button>
```

### Error Handling
```html
<div v-if="error" class="alert alert-error">
    {{ error.message }}
</div>
```

## 7. Layout Patterns

### Main Layout
```
┌─────────────────────────┐
│       Navigation        │
├──────────┬──────────────┤
│          │              │
│ Sidebar  │   Content    │
│          │              │
├──────────┴──────────────┤
│       Footer            │
└─────────────────────────┘
```

### Card Layout
```html
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold mb-4">Title</h2>
    <p class="text-gray-600">Content</p>
</div>
```

## 8. Dark Mode Support

Gunakan Tailwind CSS dark mode:
```html
<div class="bg-white dark:bg-gray-900 text-black dark:text-white">
    Content
</div>
```

## 9. Form Design

### Best Practices
- Label di atas input field
- Clear placeholder text
- Visible focus states
- Error messages di bawah input
- Success/validation feedback

```html
<div class="form-group">
    <label for="name" class="block text-sm font-medium mb-2">
        Name *
    </label>
    <input 
        id="name" 
        type="text" 
        placeholder="Enter name"
        class="w-full px-4 py-2 border rounded-lg focus:ring-2"
        required
    />
</div>
```

## 10. Animation & Transitions

### Subtle Animations
- Hover effects: 200-300ms
- Page transitions: 300-500ms
- Loading animations: smooth and non-distracting

```css
/* tailwind.config.js */
{
    extend: {
        animation: {
            'fade-in': 'fadeIn 0.3s ease-in',
        }
    }
}
```

## Checklist untuk Code Review

- [ ] Component reusable dan well-documented
- [ ] Responsive pada semua breakpoints
- [ ] Accessible (semantic HTML, ARIA labels, keyboard nav)
- [ ] Consistent dengan design system
- [ ] Performance optimized (images, CSS, JS)
- [ ] Cross-browser compatible
- [ ] Dark mode supported (jika applicable)
- [ ] Loading & error states handled
