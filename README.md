# Authority Multi-Page Website (v2 – objection-handling)

## Goal
Improve conversion by proactively answering the questions that prevent visitors from requesting an estimate.

## What changed (vs v1)
- Added trust bars (fast confidence points) on key pages
- Added FAQ/objection sections on Services, Pricing, Process, and Contact
- Stronger “what happens next” explanations and microcopy near the form
- Privacy reassurance in footer and on the contact page

## Run locally (required for header/footer injection)
Because `fetch()` won’t work reliably via `file://`, run a local server:

### Python
```bash
python -m http.server 5500
```
Then open:
http://localhost:5500

### Node
```bash
npx serve
```

## Deploy
Upload contents to Netlify / Vercel / any static host.

## Next step (recommended)
Wire the form to:
- Netlify Forms
- Formspree
- Or a backend endpoint
