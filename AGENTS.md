# AGENTS.md

## Project Overview
- This is a small PHP storefront for a fragrance/perfume e-shop.
- Pages are plain PHP files in the repository root.
- Shared layout lives in `partials/header.php` and `partials/footer.php`.
- Main styling lives in `styles/style.css`.
- Site behavior lives in `templatemo-maison-doree.js`.
- Images are stored in `images/`.

## Dev Environment Tips
- The project is intended to run from XAMPP under `C:\xampp\htdocs\Fragrance-Perfumes-E-Shop`.
- With XAMPP, visit `http://localhost/Fragrance-Perfumes-E-Shop/`.
- If XAMPP is not running, PHP's built-in server can be used from the repo root:
  `php -S localhost:8000`
- There is no package manager setup in this repo right now. Do not add npm, pnpm, Composer, or build tooling unless the task genuinely requires it.
- Keep shared navigation and footer edits in `partials/` so all pages stay consistent.

## Coding Guidelines
- Match the existing simple PHP/HTML/CSS/JS structure.
- Keep edits focused and avoid unrelated refactors.
- Use relative links and asset paths that work from root-level PHP pages.
- Preserve the visual style already established in `styles/style.css`.
- When changing repeated content across pages, check whether it belongs in a shared partial first.
- Prefer accessible markup: useful `alt` text, semantic headings, labelled form controls, and keyboard-friendly buttons/links.

## Testing Instructions
- There is no automated test suite configured.
- For PHP syntax checks, run:
  `php -l <file.php>`
- After PHP edits, lint every changed PHP file.
- For browser verification, open the affected page through XAMPP or the PHP built-in server and check:
  - desktop and mobile layout
  - header and mobile navigation
  - image loading
  - form display and interaction
  - console errors
- After CSS or JS changes, manually verify all pages that share the affected selectors or script.

## PR Instructions
- Summarize user-facing changes clearly.
- List the manual checks or lint commands that were run.
- Call out any checks that could not be run and why.
