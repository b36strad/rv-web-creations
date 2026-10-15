# Homepage Scorecard Evaluation Prompt

Copy the prompt below into an AI coding assistant while the website project is open. Update the three paths first when they differ in the project you are evaluating.

---

## Prompt

Evaluate the homepage at `index.html` using the criteria in `scorecard.html`, then create a polished Markdown report at `index-html-scorecard-evaluation.md` that I can share directly with my web design client.

### Files

- Scorecard: `scorecard.html`
- Homepage to evaluate: `index.html`
- Client-ready report to create: `index-html-scorecard-evaluation.md`

If a path is not present, inspect the project structure for the intended equivalent and state which file you used in the report. Do not treat a thin app/bootstrap `index.html` as the homepage if it only loads a component or application shell. Follow its references to the actual homepage implementation and evaluate the rendered page and its relevant source files. If the intended page still cannot be identified, stop and ask me which page to evaluate rather than scoring the wrong one.

### Evaluation instructions

1. Read the full scorecard and extract every criterion under its six categories. The criterion names and descriptions in `scorecard.html` are the source of truth; do not substitute criteria or scoring rules from another file or tool.
2. Inspect the homepage implementation and, when available, its rendered appearance at desktop and mobile widths. Follow relevant local styles, components, scripts, images, and links needed to assess the page. Do not make changes to the website itself.
3. Score each criterion using this scale:
   - **0 — Missing or ineffective:** absent, unclear, or likely to hinder the stated goal.
   - **1 — Partially effective:** present, but meaningfully incomplete, inconsistent, or difficult to use.
   - **2 — Effective:** clearly and adequately meets the criterion.
4. Give each criterion one score and a concise evidence-based explanation. Cite the visible section, element, or source location where possible. Do not award credit based on assumptions or generic best practices alone.
5. If a criterion cannot be verified from the available page or source, label it **Not verified**, explain why, and exclude it from the numeric denominator. Do not confuse unavailable evidence with a definite failure. If a criterion genuinely does not apply, label it **Not applicable** and explain why. Report the number of scored, not-verified, and not-applicable criteria.
6. The scorecard does not define numeric point weights. For this assessment, calculate each category as `earned points / available points × 100`, using only criteria scored 0–2. Calculate the overall score as the equal-weighted average of category percentages that have at least one scored criterion. If a category has no scored criteria, label it **Not scored** and exclude it from the overall average. Show the formula and disclose this interpretation so the score is transparent; do not present it as an official weighting from the scorecard.
7. The current `scorecard.html` says “36 Criteria,” but contains 40 listed checks. Count the criteria actually present in the file, use all of them, and note any difference between the displayed count and the extracted count in the report. If a different scorecard version is being evaluated, use its actual contents. Do not remove or add criteria to force a match.
8. This is a homepage conversion-readiness and SEO-intent-alignment assessment, not a guarantee of leads, a ranking prediction, or a full technical SEO audit. Do not claim to have measured rankings, analytics, load performance, accessibility conformance, or real-user behavior unless those were actually tested with suitable evidence.
9. Write for a business owner and web design client: candid, constructive, specific, and free of internal implementation chatter. Explain specialist terms briefly. Distinguish observed facts from recommendations, avoid blame, and do not invent business context, customer research, testimonials, or performance data.
10. Prioritize recommendations by likely impact on visitor understanding, trust, and action. Each recommendation must identify where it applies, what to change, why it matters, and a practical next step. Keep copy examples clearly labeled as suggestions, not factual claims.

### Report format

Create `index-html-scorecard-evaluation.md` with this structure:

```markdown
# Homepage Evaluation

**Business:** [business name, if verifiable; otherwise “Not provided”]
**Page reviewed:** [page path and URL if available]
**Assessment date:** [current date]
**Overall score:** [score]/100
**Criteria assessed:** [scored] of [extracted total]

## Executive Summary
[Short client-ready overview of the page's strongest point, main constraint, and overall readiness.]

## Scorecard Results
| Category | Score | Key observation |
| ... | ... | ... |

### [Category name] — [score] / 100
| Criterion | Score | Evidence and assessment |
| ... | ... | ... |

[Repeat the criterion table for all six scorecard categories. Use “Not verified” or “Not applicable” in place of a numeric score when appropriate.]

## What Is Working
- [Specific strengths supported by evidence]

## Recommended Priorities
1. **[Priority]** — [Where it applies, recommended change, and why it matters.]
2. ...

## Assessment Notes
- **Scoring method:** [Explain 0–2 criterion scoring and equal category weighting; include formula.]
- **Coverage:** [Scored, not verified, and not applicable counts; note any scorecard displayed-count discrepancy.]
- **Limitations:** [Only relevant limitations based on what could and could not be inspected.]
```

Use all six category names and every criterion found in `scorecard.html`; do not omit low-scoring or unverified items. Keep the executive summary and recommendations concise enough for a client to scan, while retaining enough criterion-level evidence to make the score understandable. Make the report self-contained and suitable for sharing without editing. After creating it, provide me a brief completion note with the report path and the overall score.

---

## Before sharing

Confirm the generated report contains no unsupported claims, includes all criteria from the scorecard, explains its scoring method, and identifies anything that could not be verified. Review business-specific details and suggested copy for accuracy before sending it to the client.