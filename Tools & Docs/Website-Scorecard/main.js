(() => {
  const VERSION = "2.0.0";
  const DATA = {
  "version": "2.0.0",
  "title": "Homepage Conversion + SEO Readiness Scorecard",
  "subtitle": "A unified 0–100 diagnostic for conversion readiness and SEO-intent alignment (not a ranking audit).",
  "disclaimer": "This assessment does not measure rankings, backlinks, or keyword competition. It measures whether your homepage is ready to convert intent-driven visitors once they arrive.",
  "sections": [
    {
      "id": "intent_relevance",
      "title": "Intent & Relevance (SEO Foundation)",
      "desc": "If the right person lands here from search, do they immediately feel this page is for them?",
      "max": 18,
      "criteria": [
        {
          "id": "intent_audience",
          "name": "Clear audience & problem in first screen",
          "desc": "Within ~5 seconds, it’s obvious who it’s for and what problem you solve.",
          "max": 5,
          "source": "seo_html"
        },
        {
          "id": "intent_headline",
          "name": "Headline matches likely search intent",
          "desc": "Headline aligns with what people searched (not just brand language).",
          "max": 5,
          "source": "seo_html"
        },
        {
          "id": "intent_relevance",
          "name": "Immediate confirmation of relevance",
          "desc": "Subhead/supporting copy quickly reinforces “I’m in the right place.”",
          "max": 5,
          "source": "seo_html"
        },
        {
          "id": "messaging_chk1",
          "name": "Pain points are explicitly named",
          "desc": "The page clearly names the visitor’s problem(s) in plain language.",
          "max": 1,
          "source": "homepage_component"
        },
        {
          "id": "messaging_chk2",
          "name": "Outcome is described as a transformation",
          "desc": "It describes the before/after outcome so visitors can picture success.",
          "max": 1,
          "source": "homepage_component"
        },
        {
          "id": "messaging_chk3",
          "name": "Language matches the buyer",
          "desc": "Copy uses customer language (not internal jargon or overly technical wording).",
          "max": 1,
          "source": "homepage_component"
        }
      ]
    },
    {
      "id": "value_clarity",
      "title": "Value Proposition Clarity",
      "desc": "Can a first-time visitor understand what you do, who it’s for, and the outcome within 5 seconds?",
      "max": 18,
      "criteria": [
        {
          "id": "clarity_primary",
          "name": "One clear primary service or outcome",
          "desc": "A single main offer or outcome is emphasized (no competing priorities).",
          "max": 5,
          "source": "seo_html"
        },
        {
          "id": "clarity_support",
          "name": "Supporting sections reinforce the main idea",
          "desc": "Sections consistently support the main promise instead of branching into unrelated claims.",
          "max": 6,
          "source": "seo_html"
        },
        {
          "id": "clarity_headings",
          "name": "Headings communicate meaning (not fluff)",
          "desc": "Headings convey benefits and clarity—not vague slogans.",
          "max": 5,
          "source": "seo_html"
        },
        {
          "id": "value_chk3",
          "name": "Problem + result are clear (before/after)",
          "desc": "The problem and result are concrete, not abstract.",
          "max": 1,
          "source": "homepage_component"
        },
        {
          "id": "value_chk4",
          "name": "Differentiation is stated (why you vs alternatives)",
          "desc": "The page explains why this option is different/better than alternatives.",
          "max": 1,
          "source": "homepage_component"
        }
      ]
    },
    {
      "id": "trust_proof",
      "title": "Trust & Credibility",
      "desc": "Do you provide enough proof and legitimacy signals for skeptical visitors to believe you?",
      "max": 18,
      "criteria": [
        {
          "id": "trust_proof",
          "name": "Proof placed near decision points",
          "desc": "Testimonials/reviews/case proof appear where visitors decide.",
          "max": 2,
          "source": "seo_html"
        },
        {
          "id": "trust_outcomes",
          "name": "Real outcomes or examples shown",
          "desc": "Specific results, examples, or process proof (not generic claims).",
          "max": 4,
          "source": "seo_html"
        },
        {
          "id": "trust_legitimacy",
          "name": "Business legitimacy is obvious",
          "desc": "Clear business info, credentials, and risk reducers are easy to find.",
          "max": 3,
          "source": "seo_html"
        },
        {
          "id": "signals_primary",
          "name": "Primary service emphasized clearly",
          "desc": "The main service/outcome is reinforced multiple times in plain language.",
          "max": 3,
          "source": "seo_html"
        },
        {
          "id": "signals_connected",
          "name": "Supporting pages logically connected",
          "desc": "Navigation and internal links reinforce the main focus.",
          "max": 2,
          "source": "seo_html"
        },
        {
          "id": "signals_buried",
          "name": "No buried or de-emphasized priorities",
          "desc": "Key pages/offers aren’t hidden behind vague labels or extra steps.",
          "max": 2,
          "source": "seo_html"
        },
        {
          "id": "trust_chk1",
          "name": "Testimonials are present and specific",
          "desc": "Testimonials include specifics (context + outcome), not just praise.",
          "max": 1,
          "source": "homepage_component"
        },
        {
          "id": "trust_chk3",
          "name": "Clear process or steps are explained",
          "desc": "A simple process/steps section reduces uncertainty and builds trust.",
          "max": 1,
          "source": "homepage_component"
        }
      ]
    },
    {
      "id": "conversion_path",
      "title": "Conversion Path Clarity",
      "desc": "Is the next step obvious, specific, and low-friction?",
      "max": 18,
      "criteria": [
        {
          "id": "cta_primary",
          "name": "One dominant primary CTA",
          "desc": "A single main CTA stands out throughout key sections.",
          "max": 4,
          "source": "seo_html"
        },
        {
          "id": "cta_readiness",
          "name": "CTA matches visitor readiness",
          "desc": "CTA fits first-time visitors (e.g., ‘Get a quote’ vs ‘Book now’ depending on context).",
          "max": 6,
          "source": "seo_html"
        },
        {
          "id": "cta_conflict",
          "name": "No competing or confusing actions",
          "desc": "Secondary CTAs don’t distract from the main action.",
          "max": 5,
          "source": "seo_html"
        },
        {
          "id": "cta_chk2",
          "name": "CTA wording is benefit-driven",
          "desc": "CTA text is specific and benefit-driven (not generic “Contact”).",
          "max": 1,
          "source": "homepage_component"
        },
        {
          "id": "cta_chk3",
          "name": "CTA repeats throughout the page",
          "desc": "The primary CTA is repeated at logical points so scanners can act.",
          "max": 1,
          "source": "homepage_component"
        },
        {
          "id": "cta_chk4",
          "name": "Next-step expectations are clear",
          "desc": "The page explains what happens after clicking (timing, steps, what you get).",
          "max": 1,
          "source": "homepage_component"
        }
      ]
    },
    {
      "id": "structure_scan",
      "title": "Structure & Scannability",
      "desc": "Can visitors scan the page and still understand it quickly?",
      "max": 14,
      "criteria": [
        {
          "id": "structure_order",
          "name": "Logical, scannable section order",
          "desc": "The page follows a natural sequence: promise → proof → details → next step.",
          "max": 3,
          "source": "seo_html"
        },
        {
          "id": "structure_separation",
          "name": "Clear separation of ideas",
          "desc": "Each section has a purpose; content is not visually or conceptually jumbled.",
          "max": 5,
          "source": "seo_html"
        },
        {
          "id": "structure_priority",
          "name": "Important info prioritized",
          "desc": "Key benefits and proof appear before less important content.",
          "max": 4,
          "source": "seo_html"
        },
        {
          "id": "path_chk1",
          "name": "Above-the-fold is clear and persuasive",
          "desc": "Above the fold confirms relevance + offers a clear next step.",
          "max": 1,
          "source": "homepage_component"
        },
        {
          "id": "path_chk3",
          "name": "Key info is easy to find",
          "desc": "Key info (offer, proof, next step) is easy to find without excessive scrolling.",
          "max": 1,
          "source": "homepage_component"
        }
      ]
    },
    {
      "id": "friction_objections",
      "title": "Friction, Objections & UX",
      "desc": "Do you reduce anxiety, answer objections, and keep the mobile experience frictionless?",
      "max": 14,
      "criteria": [
        {
          "id": "mobile_clarity",
          "name": "Message clarity without zooming",
          "desc": "Headline, subhead, and offer are readable and clear immediately.",
          "max": 1,
          "source": "seo_html"
        },
        {
          "id": "mobile_tap",
          "name": "Buttons and links easy to tap",
          "desc": "Tap targets are comfortable; no accidental clicks.",
          "max": 2,
          "source": "seo_html"
        },
        {
          "id": "mobile_hidden",
          "name": "No critical content hidden",
          "desc": "Key content isn’t buried in accordions or missing on mobile.",
          "max": 4,
          "source": "seo_html"
        },
        {
          "id": "risk_chk1",
          "name": "Objections are acknowledged",
          "desc": "Common objections (cost, fit, timing, risk) are addressed proactively.",
          "max": 1,
          "source": "homepage_component"
        },
        {
          "id": "risk_chk2",
          "name": "Clear expectations are set",
          "desc": "Expectations are set (timeline, steps, what you need from the client).",
          "max": 1,
          "source": "homepage_component"
        },
        {
          "id": "risk_chk3",
          "name": "Risk reversal exists",
          "desc": "Risk is reduced (no-pressure language, transparency, guarantees where appropriate).",
          "max": 1,
          "source": "homepage_component"
        },
        {
          "id": "risk_chk4",
          "name": "FAQs or reassurance section exists",
          "desc": "An FAQ/reassurance section answers common questions quickly.",
          "max": 1,
          "source": "homepage_component"
        },
        {
          "id": "ux_chk1",
          "name": "Readable typography (mobile)",
          "desc": "Typography is readable on mobile (size, contrast, line-height).",
          "max": 1,
          "source": "homepage_component"
        },
        {
          "id": "ux_chk3",
          "name": "Layout is clean and not overwhelming",
          "desc": "Layout feels calm and uncluttered; sections are easy to parse.",
          "max": 1,
          "source": "homepage_component"
        },
        {
          "id": "ux_chk4",
          "name": "Contact options are easy to find",
          "desc": "Contact options are easy to find (footer/header, consistent placement).",
          "max": 1,
          "source": "homepage_component"
        }
      ]
    }
  ]
};
  const clamp = (n, min, max) => Math.max(min, Math.min(max, n));
  const round = (n, d = 0) => { const m = Math.pow(10, d); return Math.round(n * m) / m; };

  class HomepageScorecard extends HTMLElement {
    constructor() {
      super();
      this.attachShadow({ mode: "open" });
      this.state = { scores: {} };
    }

    connectedCallback() {
      this.render();
      this.bind();
      this.updateAll();
    }

    resetAll() {
      this.state.scores = {};
      this.shadowRoot.querySelectorAll('input[type="range"]').forEach(r => r.value = "0");
      this.shadowRoot.querySelectorAll('[data-out]').forEach(o => {
        const parts = o.textContent.split('/');
        if (parts.length === 2) o.textContent = `0/${parts[1]}`;
      });
      this.updateAll();
    }

    compute() {
      let totalMax = 0;
      let total = 0;

      const sectionResults = DATA.sections.map(sec => {
        totalMax += sec.max;
        let earned = 0;
        const crit = sec.criteria.map(c => {
          const v = Number(this.state.scores[c.id] ?? 0);
          earned += v;
          return { ...c, value: v };
        });
        total += earned;
        const pct = sec.max ? (earned / sec.max) * 100 : 0;
        return { id: sec.id, title: sec.title, earned, max: sec.max, pct, criteria: crit };
      });

      const score100 = totalMax ? round((total / totalMax) * 100, 0) : 0;

      // Dual scores (0–100 each)
      const seoIds = new Set(["intent_relevance","structure_scan","friction_objections"]);
      const convIds = new Set(["value_clarity","trust_proof","conversion_path"]);
      let seoEarned = 0, seoMax = 0, convEarned = 0, convMax = 0;
      sectionResults.forEach(sec => {
        if (seoIds.has(sec.id)) { seoEarned += sec.earned; seoMax += sec.max; }
        if (convIds.has(sec.id)) { convEarned += sec.earned; convMax += sec.max; }
      });
      const seoScore = seoMax ? round((seoEarned / seoMax) * 100, 0) : 0;
      const convScore = convMax ? round((convEarned / convMax) * 100, 0) : 0;


      let band = "Needs work";
      let bandDesc = "Your homepage is likely leaking value from traffic, especially intent-driven search visitors.";
      if (score100 >= 75) {
        band = "Strong & scalable";
        bandDesc = "Your homepage is well-positioned to convert intent-driven visitors. Keep refining proof and reducing friction.";
      } else if (score100 >= 50) {
        band = "Decent foundations";
        bandDesc = "You have solid elements, but a few gaps may prevent consistent conversion from search and ads.";
      }

      const recTemplate = {
  "intent_relevance": "Search visitors arrive with no context. Improve: {{name}} so the page immediately confirms relevance and reduces bounces.",
  "value_clarity": "Clarify your offer. Improve: {{name}} so visitors understand the outcome quickly.",
  "trust_proof": "Skeptical visitors need proof. Improve: {{name}} to increase confidence before the CTA.",
  "conversion_path": "High-intent traffic needs direction. Improve: {{name}} so the next step is obvious and low-friction.",
  "structure_scan": "Visitors skim. Improve: {{name}} so key info is easy to find and understand fast.",
  "friction_objections": "Reduce hesitation. Improve: {{name}} to remove friction and address objections (especially on mobile)."
};
      const recs = [];
      sectionResults
        .slice()
        .sort((a,b) => a.pct - b.pct)
        .forEach(sec => {
          sec.criteria
            .slice()
            .map(c => ({ ...c, pct: c.max ? (c.value / c.max) * 100 : 0 }))
            .sort((a,b) => a.pct - b.pct)
            .slice(0, 3)
            .forEach(c => {
              if (c.pct >= 100) return;
              const t = recTemplate[sec.id] || "Improve: {name}.";
              recs.push({
                section: sec.title,
                text: t.replace("{name}", c.name)
              });
            });
        });

      return { score100, seoScore, convScore, band, bandDesc, sectionResults, recs: recs.slice(0, 10) };
    }

    updateAll() {
      const res = this.compute();

      this.shadowRoot.getElementById("score").textContent = String(res.score100);
      this.shadowRoot.getElementById("band").textContent = res.band;
      this.shadowRoot.getElementById("bandDesc").textContent = res.bandDesc;

      this.shadowRoot.getElementById("bar").style.width = `${res.score100}%`;

      // Dual score badges
      const seoEl = this.shadowRoot.getElementById("seoScore");
      const convEl = this.shadowRoot.getElementById("convScore");
      if (seoEl) seoEl.textContent = String(res.seoScore);
      if (convEl) convEl.textContent = String(res.convScore);
      const seoBar = this.shadowRoot.getElementById("seoBar");
      const convBar = this.shadowRoot.getElementById("convBar");
      if (seoBar) seoBar.style.width = `${res.seoScore}%`;
      if (convBar) convBar.style.width = `${res.convScore}%`;

      this.shadowRoot.getElementById("progress").setAttribute("aria-valuenow", String(res.score100));

      const breakdown = this.shadowRoot.getElementById("breakdown");
      breakdown.innerHTML = "";
      res.sectionResults.forEach(sec => {
        const row = document.createElement("div");
        row.className = "brow";
        row.innerHTML = `
          <div class="btitle">
            <div class="bname">${sec.title}</div>
            <div class="bmeta">${Math.round(sec.pct)}% · ${sec.earned}/${sec.max}</div>
          </div>
          <div class="bbar"><div class="bfill" style="width:${Math.round(sec.pct)}%"></div></div>
        `;
        breakdown.appendChild(row);
      });

      const recList = this.shadowRoot.getElementById("recs");
      recList.innerHTML = "";
      res.recs.forEach(r => {
        const li = document.createElement("li");
        li.innerHTML = `<div class="rsec">${r.section}</div><div class="rtext">${r.text}</div>`;
        recList.appendChild(li);
      });
    }

    bind() {
      this.shadowRoot.getElementById("btnReset").addEventListener("click", () => this.resetAll());
      this.shadowRoot.getElementById("btnPrint").addEventListener("click", () => window.print());

      this.shadowRoot.querySelectorAll('input[type="range"]').forEach(input => {
        input.addEventListener("input", (e) => {
          const id = e.target.getAttribute("data-id");
          const max = Number(e.target.getAttribute("max") || "0");
          const v = clamp(Number(e.target.value || "0"), 0, max);
          this.state.scores[id] = v;

          const out = this.shadowRoot.querySelector(`[data-out="${id}"]`);
          if (out) out.textContent = `${v}/${max}`;

          this.updateAll();
        });
      });
    }

    render() {
      const styles = `
        :host{display:block}
        *{box-sizing:border-box}
        .wrap{max-width:1100px;margin:0 auto;padding:28px 16px 64px;color:#e8eef8;
          font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;}
        header{display:flex;gap:14px;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;margin-bottom:18px}
        .title{display:flex;flex-direction:column;gap:6px;max-width:760px}
        h1{margin:0;font-size:24px;letter-spacing:-.02em}
        .sub{margin:0;color:#93a4bd;line-height:1.4}
        .actions{display:flex;gap:10px;flex-wrap:wrap}
        button{appearance:none;border:1px solid rgba(255,255,255,.10);background:rgba(255,255,255,.04);color:#e8eef8;
          padding:10px 12px;border-radius:12px;cursor:pointer}
        button:hover{background:rgba(255,255,255,.07)}
        .grid{display:grid;grid-template-columns:1fr;gap:14px}
        @media(min-width:900px){ .grid{grid-template-columns:1.35fr .65fr} }
        .card{background:linear-gradient(180deg, rgba(255,255,255,.04), rgba(255,255,255,.02));
          border:1px solid rgba(255,255,255,.10);border-radius:16px;box-shadow:0 10px 24px rgba(0,0,0,.35);}
        .pad{padding:16px}
        .scorebox{display:flex;align-items:baseline;gap:10px;padding:12px 14px;border-radius:14px;
          border:1px solid rgba(106,169,255,.25);background:rgba(106,169,255,.10);}
        .scorebox .n{font-size:40px;font-weight:800;line-height:1}
        .scorebox .lab{color:#93a4bd}
        .progress{height:10px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);border-radius:999px;
          overflow:hidden;margin-top:10px}
        .bar{height:100%;width:0%;background:linear-gradient(90deg, rgba(106,169,255,.95), rgba(56,211,159,.85));}
        .note{margin-top:8px;padding:10px 12px;border-radius:12px;border:1px dashed rgba(56,211,159,.30);
          background:rgba(56,211,159,.08);color:#93a4bd}
        .section{margin-top:14px}
        .secHead{display:flex;align-items:flex-start;justify-content:space-between;gap:10px;flex-wrap:wrap}
        .secTitle{font-weight:700}
        .secDesc{color:#93a4bd;margin-top:6px;line-height:1.4}
        .criteria{margin-top:12px;display:flex;flex-direction:column;gap:10px}
        .crit{padding:12px;border:1px solid rgba(255,255,255,.10);border-radius:14px;background:rgba(18,26,39,.65);}
        .critTop{display:flex;align-items:flex-start;justify-content:space-between;gap:10px;flex-wrap:wrap}
        .critName{font-weight:600}
        .critDesc{color:#93a4bd;margin-top:6px;font-size:14px;line-height:1.35}
        input[type=range]{width:min(420px, 100%)}
        .pts{color:#93a4bd;font-size:13px;min-width:64px;text-align:right}
        .aside h3{margin:0 0 10px;font-size:16px}
        .brow{margin-bottom:12px}
        .btitle{display:flex;align-items:baseline;justify-content:space-between;gap:10px}
        .bname{font-size:13px;font-weight:600}
        .bmeta{font-size:12px;color:#93a4bd}
        .bbar{height:8px;border-radius:999px;border:1px solid rgba(255,255,255,.10);background:rgba(255,255,255,.06);
          overflow:hidden;margin-top:6px}
        .bfill{height:100%;width:0%;background:linear-gradient(90deg, rgba(106,169,255,.95), rgba(56,211,159,.85));}
        ol{margin:10px 0 0 18px}
        li{margin:10px 0}
        .rsec{font-size:12px;color:#93a4bd;margin-bottom:4px}
        .rtext{line-height:1.35}
        .small{font-size:12px;color:#93a4bd}

        .dual{display:grid;grid-template-columns:1fr;gap:10px;margin-top:12px}
        @media(min-width:600px){.dual{grid-template-columns:1fr 1fr}}
        .dualBox{padding:10px;border:1px solid rgba(255,255,255,.10);border-radius:14px;background:rgba(255,255,255,.03)}
        .dualVal{font-size:22px;font-weight:800;margin-top:4px;display:flex;align-items:baseline;gap:6px}
        .miniBar{height:8px;border-radius:999px;border:1px solid rgba(255,255,255,.10);background:rgba(255,255,255,.06);overflow:hidden;margin-top:8px}
        .miniFill{height:100%;width:0%;background:linear-gradient(90deg, rgba(56,211,159,.85), rgba(106,169,255,.95));}
        .muted{color:#93a4bd}

        @media print{ button{display:none !important} .wrap{padding:0;color:#000} }
      `;

      const sectionsHtml = DATA.sections.map(sec => {
        const crit = sec.criteria.map(c => `
          <div class="crit">
            <div class="critTop">
              <div>
                <div class="critName">${c.name}</div>
                ${c.desc ? `<div class="critDesc">${c.desc}</div>` : ""}
              </div>
              <div class="pts" data-out="${c.id}">0/${c.max}</div>
            </div>
            <div class="sliderRow">
              <input type="range" min="0" max="${c.max}" value="0" step="1" data-id="${c.id}" aria-label="${c.name} score slider">
            </div>
          </div>
        `).join("");

        return `
          <div class="card section">
            <div class="pad">
              <div class="secHead">
                <div>
                  <div class="secTitle">${sec.title}</div>
                  <div class="secDesc">${sec.desc}</div>
                </div>
                <div class="small">Max ${sec.max} pts</div>
              </div>
              <div class="criteria">${crit}</div>
            </div>
          </div>
        `;
      }).join("");

      this.shadowRoot.innerHTML = `
        <style>${styles}</style>
        <div class="wrap">
          <header>
            <div class="title">
              <h1>${DATA.title} <span class="small">(v${VERSION})</span></h1>
              <p class="sub">${DATA.subtitle}</p>
              <p class="sub"><strong>Note:</strong> ${DATA.disclaimer}</p>
            </div>
            <div class="actions">
              <button id="btnReset" type="button">Reset</button>
              <button id="btnPrint" type="button">Print / Save PDF</button>
            </div>
          </header>

          <div class="grid">
            <div>
              <div class="card">
                <div class="pad">
                  <div class="small">Overall score</div>
                  <div class="scorebox">
                    <div class="n" id="score">0</div>
                    <div class="lab">/ 100 · <span id="band">Needs work</span></div>
                  </div>
                  <div class="note" id="bandDesc"></div>
                  <div id="progress" class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div id="bar" class="bar"></div>
                  </div>

                  <div class="dual">
                    <div class="dualBox">
                      <div class="small">SEO-Readiness</div>
                      <div class="dualVal"><span id="seoScore">0</span><span class="small">/100</span></div>
                      <div class="miniBar"><div id="seoBar" class="miniFill" style="width:0%"></div></div>
                      <div class="small muted">Intent + structure + mobile UX</div>
                    </div>
                    <div class="dualBox">
                      <div class="small">Conversion-Readiness</div>
                      <div class="dualVal"><span id="convScore">0</span><span class="small">/100</span></div>
                      <div class="miniBar"><div id="convBar" class="miniFill" style="width:0%"></div></div>
                      <div class="small muted">Clarity + trust + CTA path</div>
                    </div>
                  </div>

                </div>
              </div>

              ${sectionsHtml}

              <div class="card section">
                <div class="pad">
                  <div class="secTitle">Prioritized recommendations</div>
                  <div class="secDesc">Generated from your lowest-scoring areas. Start with the top 3–5 for the fastest gains.</div>
                  <ol id="recs"></ol>
                </div>
              </div>
            </div>

            <aside class="aside">
              <div class="card">
                <div class="pad">
                  <h3>Category breakdown</h3>
                  <div id="breakdown"></div>
                  <div class="small">Fixing the lowest category usually improves results fastest.</div>
                </div>
              </div>
            </aside>
          </div>
        </div>
      `;
    }
  }

  customElements.define("homepage-scorecard", HomepageScorecard);
})();
