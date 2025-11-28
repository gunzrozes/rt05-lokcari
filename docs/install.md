INSTALL:
1) Upload ke hosting
2) Buat DB rt05_lokcari dan import database.sql
3) Edit config.php
4) Login admin_rt05 / rt05admin
5) Composer install bila ingin PDF dompdf aktif

## Advanced feature setup\n- To enable WhatsApp Cloud API: set WA_PHONE_NUMBER_ID and WA_TOKEN in hosting environment or config.php.\n- For OCR e-KTP: install tesseract-ocr on server and ensure PHP can exec().\n- For PDF generation: run `composer install` to get dompdf.\n- For email notifications: configure SMTP variables and run composer for PHPMailer.\n- Backup: configure cron to run `backup.sh` weekly/daily as needed.\n- GitHub: push repository and connect to Cloudflare Pages or your hosting; ensure /public is webroot.\n