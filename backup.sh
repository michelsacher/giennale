#!/bin/bash

# TYPO3 razor backup
# Version 2.0 (07.07.2016)

# Autor: Raphael Zschorsch / www.rafu1987.de

if [ $# -lt 1 ]; then
  echo ":: Error! No arguments supplied"
  echo ":: Usage: ./backup.sh <revision number> [ backupdir name ]"
  echo ":: Example: ./backup.sh 1 backups"
  exit 1
fi

if [ -z $2 ]; then
  BACKUP_DIR="backups"
else
  BACKUP_DIR="${2}"
fi

# Variables
REVISION="${1}"
PROJECT_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

cd $PROJECT_PATH

PROJECT_NAME=${PWD##*/}

BACKUP_PATH=$( cd $PROJECT_PATH && cd .. && pwd )
BACKUP_DEST=$BACKUP_PATH/$BACKUP_DIR
BACKUP_NAME=$PROJECT_NAME\_r$REVISION\_`date +"%Y-%m-%d"`

echo ":: Backup destination $BACKUP_DEST"
echo ":: Revision $REVISION"

CONFIG_FILE=

if [ -f $PROJECT_PATH/typo3conf/LocalConfiguration.php ]; then
  echo ":: Getting DB configuration from LocalConfiguration.php"
  CONFIG_FILE=$PROJECT_PATH/typo3conf/LocalConfiguration.php
  RAZOR_CONF=`cat $CONFIG_FILE | grep \'razor\'\ =\> | cut -d "'" -f 4`

  DB_NAME=`php -q $PROJECT_PATH/typo3conf/ext/razor/Resources/Private/Php/Backup.php db`
  DB_USER=`php -q $PROJECT_PATH/typo3conf/ext/razor/Resources/Private/Php/Backup.php user`
  DB_PASSWORD=`php -q $PROJECT_PATH/typo3conf/ext/razor/Resources/Private/Php/Backup.php pass`
  DB_HOST=`php -q $PROJECT_PATH/typo3conf/ext/razor/Resources/Private/Php/Backup.php host`
fi

if [ -z $DB_NAME ] || [ -z $DB_USER ] || [ -z $DB_PASSWORD ] || [ -z $DB_HOST ]; then
  echo ":: Error! Database credentials incomplete"
  exit 1
fi

if [ -z $CONFIG_FILE ]; then
  echo ":: Error! TYPO3 configuration not found"
  exit 1
fi

echo ":: Backup $PROJECT_PATH"
echo ":: Database: $DB_NAME"

echo ":: Creating backup folder"
mkdir -p $BACKUP_DEST

echo ":: Creating backup of database..."
mysqldump -u $DB_USER -p$DB_PASSWORD -h $DB_HOST --default-character-set=utf8 $DB_NAME > $BACKUP_DEST/$BACKUP_NAME.sql
gzip $BACKUP_DEST/$BACKUP_NAME.sql

echo ":: Creating backup of files..."
cd $PROJECT_PATH
tar czf $BACKUP_DEST/$BACKUP_NAME.tar.gz ../$PROJECT_NAME --exclude="node_modules" --exclude="bower_components" --exclude="typo3temp/Cache"
