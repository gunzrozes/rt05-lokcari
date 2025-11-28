#!/bin/bash
# backup.sh - simple MySQL dump backup
DB_NAME='rt05_lokcari'
DB_USER='root'
DB_PASS=''
OUT_DIR='/home/username/backups' # change this to a writable backup folder (outside webroot)
mkdir -p "$OUT_DIR"
FNAME="$OUT_DIR/${DB_NAME}_$(date +%Y%m%d_%H%M%S).sql"
mysqldump -u$DB_USER -p$DB_PASS $DB_NAME > "$FNAME"
# Optional: gzip the dump
gzip "$FNAME"
# Keep last 30 backups
ls -1t $OUT_DIR | tail -n +31 | xargs -r -I {} rm -- "$OUT_DIR/{}"