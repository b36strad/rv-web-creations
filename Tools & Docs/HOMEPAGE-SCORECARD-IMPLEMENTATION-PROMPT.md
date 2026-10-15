# Homepage Scorecard Implementation Prompt

Use this prompt in an AI coding assistant with the Leading Edge Finishings project open. It uses the evaluation report as the implementation brief while protecting factual accuracy and the existing site design.

---

## Prompt

Improve the Leading Edge Finishings homepage using the findings and priorities in `index-html-scorecard-evaluation.md`. Implement the appropriate changes in the actual homepage source, then verify the result.

### Files and page selection

- Evaluation report: `index-html-scorecard-evaluation.md`
- Intended homepage: `src/pages/index.astro`
- Related components, styles, and data: inspect only as needed to implement and verify homepage changes.

There is no root-level `index.html` in this project. `Tools & Docs/Website-Scorecard/index.html` launches a separate scorecard tool; do not edit it or mistake it for the business homepage. If the project structure has changed, trace the homepage route and confirm the actual page before editing.

### Instructions

1. Read the full evaluation report first. Treat its evidence and recommendations as the brief, but verify current code and rendered behavior before making a change. Do not edit the evaluation report or scorecard.
2. Inspect the homepage source and relevant components/styles. Follow the project’s established Astro and Tailwind conventions. Keep the work focused on the homepage and the smallest supporting code surface needed.
3. Implement the highest-priority, evidence-backed improvements, especially:
   - Make the Facebook holiday-lighting embed fit its container on narrow screens and eliminate horizontal page overflow. Preserve a usable video or external-link fallback if the embed cannot load.
   - Make the hero communicate the verified service and Woodbury-area relevance more directly. Keep the business name visible, and use only claims supported by the project’s existing business data and content.
   - Clarify the primary offer and section hierarchy without removing legitimate services or creating unsupported claims.
4. Do not invent a response-time commitment, project process, service specialization, guarantee, customer result, or testimonial. Do not publish paraphrased or fabricated review text. If a recommendation depends on these facts, leave it unchanged and list the specific information or approval needed from the business.
5. Preserve established branding, responsive layouts, accessibility semantics, existing links, project imagery, contact routes, and interactive behavior. Do not redesign unrelated pages, refactor unrelated components, or change business data just to improve a score.
6. Avoid adding content that is only SEO keyword repetition. Write for homeowners in clear, natural language. Keep calls to action consistent with the existing `/contact` flow.
7. After editing, inspect the rendered homepage at mobile widths including 390px and at desktop width. Confirm the page does not scroll horizontally, the video section remains usable, and the menu and primary contact actions still work. Use the project’s available browser tools if possible.
8. Run the most relevant checks available in `package.json` (such as `pnpm run check` and `pnpm run build`). Fix issues introduced by your changes; do not modify unrelated files to silence existing failures.
9. Do not commit, push, or change Git branches.

### Completion response

Summarize:

- Which homepage changes were made and which report priorities they address.
- Which recommendations were intentionally left for business confirmation, and exactly what information is needed.
- The validation commands and responsive checks completed, including any that could not be run.
- The files changed.

---
