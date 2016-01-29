#!/bin/sh

# バックアップファイルを何日分残しておくか
period=7

# バックアップファイルを保存するディレクトリ
dirpath='/home/cs/www/cs.com.dev/daily_backup'

# ファイル名を定義(※ファイル名で日付がわかるようにしておきます)
# PGバックアップ
filename1=htdocs_backup_`date +%y%m%d`
tar cfz $dirpath/$filename1.tar.gz /home/cs/www/cs.com.dev/htdocs/

filename2=application_backup_`date +%y%m%d`
tar cfz $dirpath/$filename2.tar.gz /home/cs/www/cs.com.dev/application/

filename3=modules_backup_`date +%y%m%d`
tar cfz $dirpath/$filename3.tar.gz /home/cs/www/cs.com.dev/modules/


# パーミッション変更
chmod 700 $dirpath/$filename1.tar.gz
chmod 700 $dirpath/$filename2.tar.gz
chmod 700 $dirpath/$filename3.tar.gz

# 古いバックアップファイルを削除
oldfile=`date --date "$period days ago" +%y%m%d`
rm -f $dirpath/$oldfile.tar.gz
