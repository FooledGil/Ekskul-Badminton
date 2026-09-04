---
name: Agile Court
colors:
  surface: '#fcf9f8'
  surface-dim: '#dcd9d9'
  surface-bright: '#fcf9f8'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f6f3f2'
  surface-container: '#f0eded'
  surface-container-high: '#eae7e7'
  surface-container-highest: '#e5e2e1'
  on-surface: '#1c1b1b'
  on-surface-variant: '#3f4a3f'
  inverse-surface: '#313030'
  inverse-on-surface: '#f3f0ef'
  outline: '#6f7a6e'
  outline-variant: '#becabc'
  surface-tint: '#006d34'
  primary: '#006932'
  on-primary: '#ffffff'
  primary-container: '#158443'
  on-primary-container: '#ecffea'
  inverse-primary: '#77db90'
  secondary: '#765a00'
  on-secondary: '#ffffff'
  secondary-container: '#fcc400'
  on-secondary-container: '#6c5300'
  tertiary: '#b70022'
  on-tertiary: '#ffffff'
  tertiary-container: '#e5052f'
  on-tertiary-container: '#fff8f7'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#93f8aa'
  primary-fixed-dim: '#77db90'
  on-primary-fixed: '#00210b'
  on-primary-fixed-variant: '#005226'
  secondary-fixed: '#ffdf95'
  secondary-fixed-dim: '#f5bf00'
  on-secondary-fixed: '#251a00'
  on-secondary-fixed-variant: '#594400'
  tertiary-fixed: '#ffdad8'
  tertiary-fixed-dim: '#ffb3b0'
  on-tertiary-fixed: '#410006'
  on-tertiary-fixed-variant: '#930019'
  background: '#fcf9f8'
  on-background: '#1c1b1b'
  surface-variant: '#e5e2e1'
typography:
  headline-xl:
    fontFamily: Montserrat
    fontSize: 48px
    fontWeight: '800'
    lineHeight: '1.1'
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Montserrat
    fontSize: 32px
    fontWeight: '700'
    lineHeight: '1.2'
    letterSpacing: -0.01em
  headline-lg-mobile:
    fontFamily: Montserrat
    fontSize: 28px
    fontWeight: '700'
    lineHeight: '1.2'
  headline-md:
    fontFamily: Montserrat
    fontSize: 24px
    fontWeight: '700'
    lineHeight: '1.3'
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.5'
  label-bold:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '600'
    lineHeight: '1.2'
  caption:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '400'
    lineHeight: '1.4'
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  xs: 4px
  sm: 12px
  md: 24px
  lg: 48px
  xl: 80px
  container-max: 1280px
  gutter: 24px
---

## Brand & Style

The design system is engineered to capture the high-velocity energy of badminton while maintaining the disciplined structure of a premier school athletic organization. The aesthetic is **Sporty Modernism**, characterized by high-contrast color pairings, geometric precision, and a sense of forward motion.

Targeting student-athletes and faculty, the UI must evoke a feeling of "Professionalism with Passion." It utilizes a "Dynamic Grid" approach, incorporating subtle diagonal accents (8-degree tilts) in background decorative elements to mimic the trajectory of a shuttlecock and the movement of a player on the court. The atmosphere is clean, competitive, and distinctly athletic.

## Colors

The palette is rooted in the club's identity, using green to represent growth and court surfaces.

- **Primary (#158443):** Used for navigation bars, primary button backgrounds, and active state indicators.
- **Secondary (#FDC500):** Reserved for "Golden Moments"—achievements, trophy icons, and badges. It should always be paired with dark text to ensure contrast.
- **Accent (#E4032E):** Use sparingly for high-urgency notifications, "Register Now" CTAs, or critical match alerts.
- **Neutrals:** The background is predominantly `#FFFFFF` for maximum legibility, with `#F8F9FA` used as a "track" to separate long-form content sections.

## Typography

This design system uses a dual-type strategy to balance impact with utility.

**Headlines (Montserrat):** Set in bold or extra-bold weights. The tight letter-spacing and heavy weight provide a "jersey-style" impact suitable for a sports club.
**Body & Labels (Inter):** A systematic sans-serif that ensures clarity for match schedules, rules, and member rosters. 

Large display headings should use `headline-xl` sparingly for hero sections, often paired with a subtle text shadow or a secondary-colored underline to emphasize key verbs.

## Layout & Spacing

The design system utilizes a **12-column fluid grid** for desktop and a **4-column grid** for mobile. 

- **The Power Gap:** Use generous `xl` (80px) vertical spacing between major landing page sections to maintain a premium, uncluttered feel.
- **Court Margins:** Mobile side margins are fixed at `md` (24px) to ensure content doesn't feel cramped against the screen edges.
- **Alignment:** While text is generally flush-left for readability, decorative elements and image "cut-outs" may break the grid at 8-degree angles to suggest movement and speed.

## Elevation & Depth

Hierarchy is established through **Tonal Layering** and **Soft Physics**.

1.  **Level 0 (Surface):** The base background (`#FFFFFF`).
2.  **Level 1 (Cards/Containers):** Uses a very soft, diffused shadow: `0px 4px 20px rgba(0, 0, 0, 0.05)`. This creates a subtle lift without feeling heavy.
3.  **Level 2 (Active/Hover):** When a user interacts with a card, the shadow deepens to `0px 12px 30px rgba(0, 0, 0, 0.1)` and the element scales slightly (1.02x).
4.  **Overlays:** High-priority modals use a 40% opacity blur on the primary neutral color to keep the focus entirely on the action.

## Shapes

The shape language is "Medium Rounded," providing a friendly but structured appearance.

- **Standard Elements:** Buttons, input fields, and small tags use a `0.5rem` (8px) radius.
- **Large Containers:** Content cards and hero images use `rounded-lg` (1rem / 16px).
- **Decorative:** Occasional 100% circular "shuttlecock" motifs or avatars are used to contrast against the predominantly rectangular grid.

## Components

### Buttons
- **Primary:** Solid Primary Green background, white text, bold weight. On hover, background shifts 10% darker.
- **Secondary:** Outlined in Primary Green with 2px stroke.
- **Action (CTA):** Solid Accent Red, reserved only for "Join Now" or "Emergency" alerts.

### Cards
Cards are the primary vehicle for "Player Profiles" and "Match Results." They should feature a white background, Level 1 elevation, and a 4px top-border in the secondary color (Gold) for "Featured" items or achievements.

### Input Fields
Inputs should have a subtle `#F8F9FA` fill and a 1px border. On focus, the border transitions to Primary Green with a 3px soft outer glow.

### Chips & Badges
Small status indicators (e.g., "Winner," "Upcoming," "Practice") use the `label-bold` type spec. Badges for winners must use the Secondary Gold color to denote prestige.

### Specialized Component: Match Scoreboard
A high-contrast component using the Primary Neutral background with large white typography for scores. Use the Primary Green to highlight the set winner’s score.