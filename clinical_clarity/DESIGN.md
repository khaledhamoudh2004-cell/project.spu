---
name: Clinical Clarity
colors:
  surface: '#f9f9ff'
  surface-dim: '#cfdaf1'
  surface-bright: '#f9f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f0f3ff'
  surface-container: '#e7eeff'
  surface-container-high: '#dee8ff'
  surface-container-highest: '#d8e3fa'
  on-surface: '#111c2c'
  on-surface-variant: '#434653'
  inverse-surface: '#263142'
  inverse-on-surface: '#ebf1ff'
  outline: '#737784'
  outline-variant: '#c3c6d5'
  surface-tint: '#1d59c1'
  primary: '#003c90'
  on-primary: '#ffffff'
  primary-container: '#0f52ba'
  on-primary-container: '#bcceff'
  inverse-primary: '#b0c6ff'
  secondary: '#006d43'
  on-secondary: '#ffffff'
  secondary-container: '#75f8b3'
  on-secondary-container: '#007147'
  tertiary: '#334343'
  on-tertiary: '#ffffff'
  tertiary-container: '#4a5b5a'
  on-tertiary-container: '#c0d2d1'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d9e2ff'
  primary-fixed-dim: '#b0c6ff'
  on-primary-fixed: '#001945'
  on-primary-fixed-variant: '#00419c'
  secondary-fixed: '#78fbb6'
  secondary-fixed-dim: '#59de9b'
  on-secondary-fixed: '#002111'
  on-secondary-fixed-variant: '#005232'
  tertiary-fixed: '#d4e6e5'
  tertiary-fixed-dim: '#b8cac9'
  on-tertiary-fixed: '#0e1e1e'
  on-tertiary-fixed-variant: '#3a4a49'
  background: '#f9f9ff'
  on-background: '#111c2c'
  surface-variant: '#d8e3fa'
typography:
  display-lg:
    fontFamily: Manrope
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-md:
    fontFamily: Manrope
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  headline-sm:
    fontFamily: Manrope
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Public Sans
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Public Sans
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: Public Sans
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-caps:
    fontFamily: Public Sans
    fontSize: 12px
    fontWeight: '700'
    lineHeight: 16px
    letterSpacing: 0.05em
  code-data:
    fontFamily: Public Sans
    fontSize: 13px
    fontWeight: '500'
    lineHeight: 18px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 4px
  xs: 8px
  sm: 16px
  md: 24px
  lg: 40px
  xl: 64px
  gutter: 20px
  margin: 32px
---

## Brand & Style

The brand personality is authoritative yet accessible, emphasizing precision and reliability. The target audience includes pharmacists managing complex inventories and patients seeking life-critical medication information. The emotional response is one of calm, professional reassurance.

This design system utilizes a **Corporate / Modern** aesthetic with a lean toward **Minimalism**. It prioritizes high-density information architecture without sacrificing clarity. Whitespace is used strategically to group related medical data, while the interface remains functional and unobtrusive to support rapid decision-making in clinical environments.

## Colors

The palette is rooted in the psychology of healthcare. The primary **Sapphire Blue** conveys institutional trust and stability, used for primary actions and navigation. The secondary **Jade Green** represents health and safety, utilized for "in-stock" indicators, success states, and pharmaceutical validation. 

A tertiary **Mint Tint** serves as a soft background for large containers to reduce eye strain during long administrative sessions. The neutral scale is cool-toned, avoiding pure black to maintain a softer, more modern professional feel. High-contrast ratios are strictly maintained for accessibility in drug search results.

## Typography

This design system uses **Manrope** for headlines to provide a modern, balanced, and refined appearance that feels sophisticated. For body copy and data-heavy interfaces, **Public Sans** is utilized due to its institutional clarity and neutral tone, which is optimized for readability in government and health sectors.

Emphasis is placed on a clear hierarchy: use `label-caps` for table headers and metadata categories, and `code-data` for drug serial numbers or SKU codes to ensure they are easily distinguishable from standard descriptive text.

## Layout & Spacing

The design system employs a **Fluid Grid** model to accommodate the varied screen sizes of pharmacy tablets and desktop administrative dashboards. A 12-column system is standard for desktop, collapsing to 4 columns for mobile drug search.

Spacing follows a strict 4px baseline grid to ensure vertical rhythm. Inventory tables should utilize the `sm` (16px) padding for high-density views, while patient-facing search results should use `md` (24px) spacing to feel more approachable and less cluttered.

## Elevation & Depth

Visual hierarchy is achieved through **Tonal Layers** and **Ambient Shadows**. Surfaces do not rely on heavy borders; instead, depth is created by stacking elements on slightly darker background canvases (Neutral 50 to White).

Shadows are used sparingly to indicate interactivity or temporary overlays. Use a soft, ultra-diffused shadow with a slight Blue-Neutral tint (`rgba(15, 82, 186, 0.08)`) for cards and modals. This ensures the interface feels "lifted" and modern without looking heavy or dated. Administrative sidebars should remain flat, distinguished only by a 1px soft border to maintain a structured, focused workspace.

## Shapes

The shape language is **Rounded**, utilizing a 0.5rem base radius for standard components like buttons and input fields. This softens the clinical nature of the platform, making it feel more modern and user-friendly.

`rounded-lg` (1rem) is reserved for pharmacy listing cards and dashboard containers, creating a distinct visual container for grouped information. `rounded-xl` (1.5rem) is used for search bars to give them a prominent, friendly appearance that invites user interaction.

## Components

### Search & Inputs
Search bars should be prominent, featuring a leading search icon and a trailing "Filter" button. Input fields use a 1px border that thickens and changes to Primary Blue on focus. Labels always sit above the input in `body-sm` bold.

### Pharmacy Listing Cards
These cards feature a `headline-sm` title, a Jade Green "In Stock" badge, and a Primary Blue "View Map" or "Order" button. Use `rounded-lg` corners and an ambient shadow to elevate them from the search results background.

### Inventory Management Tables
Tables use a flat design with `label-caps` for headers. Row hover states should use a Tertiary Mint tint to help users track data horizontally. Quantitative data (stock levels) should be right-aligned for easier comparison.

### Administrative Dashboards
Use a fixed left-hand navigation rail. Dashboard widgets should be modular cards with consistent `md` padding. Use progress bars in Jade Green to show stock thresholds and Sapphire Blue for general statistics.

### Chips & Badges
Use Jade Green for "Available," Warning Orange for "Low Stock," and Neutral Grey for "Discontinued." Chips are always pill-shaped to contrast against the more rectangular card structures.