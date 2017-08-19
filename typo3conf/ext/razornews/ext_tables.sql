#
# Table structure for table 'tx_razornews_domain_model_newscontent'
#
CREATE TABLE tx_razornews_domain_model_newscontent (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	news int(11) unsigned DEFAULT '0' NOT NULL,

	title text,
  type text,
  video_type int(11) DEFAULT '0' NOT NULL,
  ratio int(11) DEFAULT '0' NOT NULL,
	text text NOT NULL,
	image int(11) unsigned NOT NULL default '0',
  poster int(11) unsigned NOT NULL default '0',
  width text,
  video_id text,
  video_file int(11) unsigned DEFAULT '0' NOT NULL,
  height text,
  content text,
  crop tinyint(4) unsigned DEFAULT '0' NOT NULL,
  click_enlarge tinyint(4) unsigned DEFAULT '0' NOT NULL,
	gallery int(11) unsigned DEFAULT '0' NOT NULL,
  mp3 int(11) unsigned NOT NULL default '0',
  ogg int(11) unsigned NOT NULL default '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)
);

#
# Table structure for table 'tx_news_domain_model_news'
#
CREATE TABLE tx_news_domain_model_news (
	newscontent int(11) unsigned DEFAULT '0' NOT NULL,
  ogimage int(11) unsigned NOT NULL default '0',
  city varchar(255) DEFAULT '' NOT NULL,
  datetimeend int(11) DEFAULT '0' NOT NULL,
);

#
# Table structure for table 'sys_file_reference'
#
CREATE TABLE sys_file_reference (
	newscontent  int(11) unsigned DEFAULT '0' NOT NULL,
  ogimage int(11) unsigned NOT NULL default '0',
  hideindetail tinyint(4) DEFAULT '0' NOT NULL
);
