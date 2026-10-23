# Laws of UX Project Evaluation Prompt

Use this prompt to review a website, page, or user flow using relevant ideas from [Laws of UX](https://lawsofux.com/). Treat the laws as practical questions to investigate—not universal rules, a scorecard, or proof of how real users behave.

## Prompt

```text
Evaluate the following project using relevant principles from Laws of UX:

- Project/page/flow: [path, URL, or description]
- Intended audience and primary goal: [describe, or mark unknown]
- Specific concerns or decisions to review: [optional]
- Review scope: [whole project / named pages or flow]

Inspect the actual implementation and, when available, the rendered experience at desktop and mobile widths. Follow relevant components, styles, scripts, and assets needed to understand the experience. Do not change project files.

Use https://lawsofux.com/ as a reference for the principles. Select only principles that meaningfully apply. Possible lenses include:
- Cognitive load, Hick's Law, and Choice Overload: Is it easy to understand the content and choose a next step?
- Fitts's Law: Are important controls easy to find and operate, including on touch screens?
- Jakob's Law and Mental Models: Does the interface behave and label things in ways the intended audience is likely to understand?
- Proximity, Similarity, Common Region, and Uniform Connectedness: Are related content and controls grouped clearly?
- Chunking and Miller's Law: Is information organized into manageable, meaningful groups?
- Aesthetic-Usability Effect: Does visual polish support clarity and trust, or mask friction?
- Serial Position Effect and Von Restorff Effect: Are the most important items prominent without competing distractions?
- Goal-Gradient Effect and Peak-End Rule: Are progress, completion, and the final step clear and reassuring?

For each finding:
1. Identify the page, section, or interaction and describe what is actually observable.
2. Name the applicable principle only if it helps explain the issue or strength.
3. Explain the likely effect on the stated audience and goal. Separate evidence from inference.
4. Recommend a practical change and state its trade-offs or dependencies where relevant.
5. Rate priority as High, Medium, or Low based on likely impact and scope—not on the name of a UX law.

Do not force every principle into the review. A principle is not evidence by itself, and different principles can point toward different design choices. Explain which project goal should guide the trade-off. Do not invent customer research, business context, analytics, conversion outcomes, or usability-test results. If the audience, goal, or behavior cannot be established from available evidence, say so and identify what should be validated with the owner or real users.

Consider accessibility and responsive behavior as essential evaluation lenses, but do not claim conformance or successful assistive-technology testing unless those were actually tested. Laws of UX does not replace accessibility standards, usability testing, analytics, or domain expertise.

Write a concise, constructive report for [audience: project owner / client / internal team]. Use the following structure:

# UX Review

**Project reviewed:** [path or URL]
**Review date:** [date]
**Audience and goal:** [provided details or “Not specified”]
**Coverage:** [pages, flow, and viewports inspected]

## Summary
[Most important strength, main usability concern, and overall assessment.]

## Findings
For each finding, include:
- **Priority:** High / Medium / Low
- **Location:** [page, section, or interaction]
- **Observation:** [what was seen]
- **UX principle:** [relevant principle, or “No specific law needed”]
- **Why it matters:** [likely effect; identify inference]
- **Recommendation:** [specific practical next step]

## Strengths
[Specific positive observations and why they support the goal.]

## Validation Questions
[Unknowns that require stakeholder input, analytics, or user testing. Omit if none.]

## Limitations
[What was not inspected or could not be verified. State that this is a heuristic review, not a substitute for user research or a formal accessibility audit.]
```

## Before using the review

- Confirm the intended audience and goal; ask for them rather than guessing if they materially affect the evaluation.
- Check that every finding cites an observable location and offers a specific next step.
- Remove any principle that was included only to fill space.
- Keep claims about user behavior provisional unless supported by research or project data.
- Review recommendations against accessibility, business constraints, and the actual content—not just the UX principle.
