# Web Creations Site 2 (Bootstrap 5)

This is a Bootstrap 5 conversion of the original Web Creations website. The site has been rebuilt using Bootstrap 5's components, grid system, and utility classes while maintaining the original design and brand identity.

## Features

- **Bootstrap 5.3.2**: Latest version of Bootstrap for modern, responsive design
- **Mobile-First**: Fully responsive layout that works on all devices
- **Custom Brand Colors**: Original color scheme maintained with CSS custom properties
- **Accessible**: Includes skip links, proper ARIA labels, and semantic HTML
- **Modern UI**: Utilizes Bootstrap's card components, badges, alerts, and forms
- **Smooth Interactions**: Custom JavaScript for enhanced user experience

## Project Structure

```
web-creations-site 2/
├── src/
│   ├── index.html          # Homepage (Bootstrap 5)
│   ├── contact.html        # Contact page with Bootstrap form
│   ├── about.html          # About page (to be created)
│   ├── services.html       # Services page (to be created)
│   ├── portfolio.html      # Portfolio page (to be created)
│   ├── process.html        # Process page (to be created)
│   ├── pricing.html        # Pricing page (to be created)
│   ├── faq.html            # FAQ page (to be created)
│   ├── legal.html          # Legal/Privacy page (to be created)
│   ├── css/
│   │   └── styles.css      # Custom styles and Bootstrap overrides
│   ├── js/
│   │   └── main.js         # Custom JavaScript
│   ├── images/             # Image assets (copied from original)
│   └── scss/
│       └── styles.scss     # SCSS source (optional)
├── package.json            # Dependencies
└── README.md              # This file
```

## Getting Started

### Prerequisites

- Node.js and npm installed
- A modern web browser

### Installation

1. Navigate to the project directory:
```bash
cd "web-creations-site 2"
```

2. Install dependencies:
```bash
npm install
```

3. Start the development server:
```bash
npm start
```

This will launch a live server and open the site in your default browser.

## Key Differences from Original Site

### Bootstrap 5 Components Used

- **Navbar**: Responsive navigation with mobile hamburger menu
- **Grid System**: Bootstrap's 12-column grid for layouts
- **Cards**: For content sections, metrics, and feature displays
- **Badges**: For labels and tags
- **Alerts**: For highlighted information boxes
- **Forms**: Bootstrap form controls for the contact page
- **Utilities**: Spacing, typography, colors, and more

### Custom Styling

The `styles.css` file includes:
- Brand color variables matching the original site
- Custom hover effects for cards
- Enhanced navigation styling
- Responsive adjustments
- Typography improvements

### Original vs Bootstrap 5

| Original | Bootstrap 5 |
|----------|-------------|
| Custom CSS grid | Bootstrap grid system |
| Custom nav toggle | Bootstrap navbar component |
| Custom cards | Bootstrap card component |
| Custom forms | Bootstrap form controls |
| Manual breakpoints | Bootstrap responsive utilities |

## Brand Colors

```css
--bs-primary: #1f4f7b          /* Primary blue */
--color-primary-light: #2f6aa3  /* Light blue */
--color-accent: #f8b400         /* Accent yellow */
--color-bg: #f5f7fb             /* Background */
```

## Browser Support

This site supports all modern browsers:
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Comparison with Original

You now have two versions of the Web Creations site to compare:

1. **Original**: `../web-creations-site/` - Custom CSS, vanilla JS
2. **Bootstrap 5**: This version - Built with Bootstrap 5

## Completed Pages

All pages have been completed with Bootstrap 5:

- ✅ **index.html** - Full homepage with all sections, hero, cards, and CTAs
- ✅ **about.html** - About page with image, values, and fit assessment
- ✅ **services.html** - Service packages with card layouts and badges
- ✅ **portfolio.html** - Portfolio/projects with case study cards
- ✅ **process.html** - 4-step process with organized card grid
- ✅ **pricing.html** - Pricing table and care plans with Bootstrap table component
- ✅ **faq.html** - FAQ with Bootstrap accordion component
- ✅ **contact.html** - Contact form with Bootstrap form components
- ✅ **legal.html** - Privacy & Terms placeholder page
- ✅ **Custom CSS** - Brand colors and Bootstrap overrides
- ✅ **JavaScript** - Bootstrap interactions and smooth scrolling

## Site is Complete! 🎉

The entire Bootstrap 5 conversion is finished. You can now:
1. Open any page in your browser to view
2. Run `npm start` to launch with live-server
3. Compare with the original site side-by-side

## Resources

- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.3/)
- [Bootstrap Icons](https://icons.getbootstrap.com/)
- [Original Web Creations Site](../web-creations-site/)

## License

MIT

## Author

Web Creations - 2025
