# Base Template Components

This folder contains shared resources used across all template tiers (Starter, Growth, and Custom).

## Directory Structure

```
_base/
├── css/
│   ├── variables.css    # CSS custom properties for theming
│   └── utilities.css    # Common utility classes
├── js/
│   └── common.js        # Shared JavaScript functionality
├── images/
│   └── (placeholder images for demos)
└── README.md           # This file
```

## Usage

### CSS Variables (`variables.css`)

Contains all design tokens as CSS custom properties:
- **Colors**: Primary, secondary, accent, semantic colors
- **Typography**: Font families, sizes, weights, line heights
- **Spacing**: Consistent spacing scale
- **Border Radius**: Border radius values
- **Shadows**: Box shadow presets
- **Transitions**: Animation durations
- **Z-Index**: Layer management

**Quick Customization:**
```css
:root {
  --color-primary: #007bff;      /* Change to client's brand color */
  --color-accent: #28a745;       /* Change to client's accent color */
  --font-primary: 'Custom Font', sans-serif;
}
```

### Utility Classes (`utilities.css`)

Common utility classes that supplement Bootstrap 5:
- Typography utilities (text-gradient, font-display)
- Background patterns and gradients
- Hover effects (hover-lift, card-hover)
- Animation classes (animate-fade-in-up)
- Icon helpers (icon-circle)
- Layout utilities (min-h-screen, section-padding)

### JavaScript (`common.js`)

Shared functionality across all templates:
- Smooth scrolling for anchor links
- Navbar scroll effects
- Active navigation highlighting
- Animate on scroll (intersection observer)
- Form validation enhancement
- Back to top button
- Helper functions: `showToast()`, `showModal()`, `setLoading()`
- Utility functions: `debounce()`, `throttle()`, `copyToClipboard()`

**Example Usage:**
```javascript
// Show a toast notification
rvUtils.showToast('Success!', 'success');

// Show a modal
rvUtils.showModal('Title', 'Body content', '<button class="btn btn-primary">OK</button>');

// Set button loading state
rvUtils.setLoading(document.querySelector('#submitBtn'), true);
```

## How to Use in Templates

### 1. In HTML Files

Include these files in the `<head>` section after Bootstrap:

```html
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Base Template CSS -->
<link rel="stylesheet" href="../_base/css/variables.css">
<link rel="stylesheet" href="../_base/css/utilities.css">

<!-- Your custom CSS -->
<link rel="stylesheet" href="css/styles.css">
```

Include JavaScript before closing `</body>`:

```html
<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Base Template JS -->
<script src="../_base/js/common.js"></script>

<!-- Your custom JS -->
<script src="js/main.js"></script>
```

### 2. Customizing for Clients

**Method 1: Override in custom CSS**
```css
/* In your template's styles.css */
:root {
  --color-primary: #ff6b6b;  /* Override primary color */
  --color-accent: #4ecdc4;   /* Override accent color */
}
```

**Method 2: Inline in HTML**
```html
<style>
  :root {
    --color-primary: #9b59b6;
    --font-primary: 'Poppins', sans-serif;
  }
</style>
```

## Best Practices

1. **Don't Modify Base Files**: These are shared across all templates. Create overrides in your template-specific CSS.

2. **Use CSS Variables**: Always reference `var(--color-primary)` instead of hardcoding colors.

3. **Leverage Utilities**: Use utility classes before writing custom CSS:
   ```html
   <div class="section-padding bg-gradient-primary">
     <div class="container">
       <h2 class="text-gradient">Title</h2>
     </div>
   </div>
   ```

4. **Animate Elements**: Add `data-animate` attribute for scroll animations:
   ```html
   <div class="card" data-animate>Content</div>
   ```

5. **Use Helper Functions**: Leverage the JavaScript utilities:
   ```javascript
   // Instead of manual loading states
   rvUtils.setLoading(button, true);
   
   // Instead of alert()
   rvUtils.showToast('Form submitted!', 'success');
   ```

## Bootstrap 5 Integration

These base files are designed to work seamlessly with Bootstrap 5:
- Variables follow Bootstrap naming conventions
- Utilities complement (not replace) Bootstrap utilities
- JavaScript uses Bootstrap components (Toast, Modal)
- Responsive breakpoints match Bootstrap's

## Browser Support

- Modern browsers (Chrome, Firefox, Safari, Edge)
- CSS Variables support required (IE11 not supported)
- Intersection Observer API for scroll animations
- Falls back gracefully for older browsers

## Updating Base Files

If you need to update base files for all templates:
1. Make changes in `templates/_base/`
2. Test across all template tiers
3. Document changes in this README
4. Update version date below

**Last Updated**: November 30, 2025  
**Version**: 1.0.0
