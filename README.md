# Respina Online Printing System

A starter project for the Respina Online Printing System.

## Quick start

1. From the project root, run:

   ```bash
   composer dump-autoload
   php -S localhost:8000 -t public
   ```

2. Open `http://localhost:8000` in your browser.

## Features

- Landing page for Respina
- Simple print order form
- File upload storage under `public/uploads`
- Basic PHP service class for print cost estimation
- PSR-4 autoloading configured for `Respina\` namespace

## Notes

- No database is configured yet.
- Uploaded files are saved to `public/uploads`.
- The starter entrypoint is `public/index.php`.
