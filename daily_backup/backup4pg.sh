#!/bin/sh

# �o�b�N�A�b�v�t�@�C�����������c���Ă�����
period=7

# �o�b�N�A�b�v�t�@�C����ۑ�����f�B���N�g��
dirpath='/home/cs/www/cs.com.dev/daily_backup'

# �t�@�C�������`(���t�@�C�����œ��t���킩��悤�ɂ��Ă����܂�)
# PG�o�b�N�A�b�v
filename1=htdocs_backup_`date +%y%m%d`
tar cfz $dirpath/$filename1.tar.gz /home/cs/www/cs.com.dev/htdocs/

filename2=application_backup_`date +%y%m%d`
tar cfz $dirpath/$filename2.tar.gz /home/cs/www/cs.com.dev/application/

filename3=modules_backup_`date +%y%m%d`
tar cfz $dirpath/$filename3.tar.gz /home/cs/www/cs.com.dev/modules/


# �p�[�~�b�V�����ύX
chmod 700 $dirpath/$filename1.tar.gz
chmod 700 $dirpath/$filename2.tar.gz
chmod 700 $dirpath/$filename3.tar.gz

# �Â��o�b�N�A�b�v�t�@�C�����폜
oldfile=`date --date "$period days ago" +%y%m%d`
rm -f $dirpath/$oldfile.tar.gz
