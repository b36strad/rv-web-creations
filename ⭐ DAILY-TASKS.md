# DAILY PROMPT

update changelog, update/replace existing zip file, push to Github

# Daily Housekeeping Tasks

When ending a development session, complete these tasks to keep the project organized and backed up:

## 1. Update Changelog

Create or update the daily changelog file in `docs/`:

```bash
# Create new changelog for today's date
touch docs/CHANGELOG-$(date +%Y-%m-%d).md
```

Document all changes made during the session:
- Files modified
- Features added or updated
- Bugs fixed
- Content changes
- Design/UI improvements

## 2. Update Backup Zip File

Remove old backup and create fresh one:

```bash
cd "/Users/ryanvia/Documents/Projects/RV Web Creations"

# Remove old backup from archives
rm -f archives/rv-web-creations-*.zip

# Create new dated backup (excludes git files, system files, node_modules, temp files)
zip -r "rv-web-creations-$(date +%Y-%m-%d).zip" . \
  -x "*.git*" \
  -x "*.DS_Store" \
  -x "*node_modules*" \
  -x "*.tmp*" \
  -x "rv-web-creations-*.zip"

# Move to archives folder
mv "rv-web-creations-$(date +%Y-%m-%d).zip" archives/
```

## 3. Push to GitHub

Stage all changes, commit, and push:

```bash
# Stage all changes
git add .

# Commit with descriptive message
git commit -m "Your descriptive commit message here"

# Push to GitHub
git push origin main
```

## Quick Copy-Paste Commands

### All Three Steps Combined:

```bash
cd "/Users/ryanvia/Documents/Projects/RV Web Creations" && \
rm -f archives/rv-web-creations-*.zip && \
zip -r "rv-web-creations-$(date +%Y-%m-%d).zip" . -x "*.git*" -x "*.DS_Store" -x "*node_modules*" -x "*.tmp*" -x "rv-web-creations-*.zip" && \
mv "rv-web-creations-$(date +%Y-%m-%d).zip" archives/ && \
git add . && \
git commit -m "Daily update - $(date +%Y-%m-%d)" && \
git push origin main
```

### Individual Commands:

**Backup only:**
```bash
cd "/Users/ryanvia/Documents/Projects/RV Web Creations" && rm -f archives/rv-web-creations-*.zip && zip -r "rv-web-creations-$(date +%Y-%m-%d).zip" . -x "*.git*" -x "*.DS_Store" -x "*node_modules*" -x "*.tmp*" -x "rv-web-creations-*.zip" && mv "rv-web-creations-$(date +%Y-%m-%d).zip" archives/
```

**Git commit and push only:**
```bash
git add . && git commit -m "Your message here" && git push origin main
```

## Notes

- Always review changes before committing (use `git status` and `git diff`)
- Write meaningful commit messages that describe what changed
- Changelog should be created/updated BEFORE committing
- The zip backup includes all docs, source files, templates, and utilities
- Old backups are automatically removed to save space (one backup per day)

## Changelog Template

Use this template structure for daily changelogs:

```markdown
# Project Changes - [DATE]

**Generated:** [DATE]  
**Repository:** rv-web-creations  
**Branch:** main

---

## [DATE] - [Brief Description of Session]

**Time:** [Morning/Afternoon/Evening] session  
**Focus:** [Main focus area of work]

### Changes

#### 1. [Category - e.g., Feature Addition, Bug Fix, Content Update]
**Files Modified:** [list of files]

**Changes Made:**
- [Specific change 1]
- [Specific change 2]
- [Specific change 3]

**Rationale:** [Why these changes were made]

### Summary

**Files Changed:** [total count]
- [file 1]
- [file 2]
- [etc.]

**Benefits:**
- [Benefit 1]
- [Benefit 2]

---

## Previous Changes

See `CHANGELOG-[previous-date].md` for earlier changes.
```
