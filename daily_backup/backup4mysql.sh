#!/bin/sh

# バックアップファイルを何日分残しておくか
period=7

# バックアップファイルを保存するディレクトリ
dirpath='/home/cs/www/cs.com.dev/daily_backup'

# ファイル名を定義(※ファイル名で日付がわかるようにしておきます)
filename=mybackup_`date +%y%m%d`

# mysqldump実行（ファイルサイズ圧縮の為gzで圧縮しておきます。）
mysqldump --opt --all-databases --events --default-character-set=binary --u root --password=db!mp | gzip > $dirpath/$filename.sql.gz

# パーミッション変更
chmod 700 $dirpath/$filename.sql.gz

# 古いバックアップファイルを削除
oldfile=`date --date "$period days ago" +%y%m%d`
rm -f $dirpath/$oldfile.sql.gz
