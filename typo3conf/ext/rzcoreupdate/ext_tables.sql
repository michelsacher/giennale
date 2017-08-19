#
# TABLE STRUCTURE FOR TABLE 'cf_rzcoreupdate_versionStore'
#
CREATE TABLE cf_rzcoreupdate_versionStore (
    id int(11) unsigned NOT NULL auto_increment,
    identifier varchar(250) DEFAULT '' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    content mediumblob,
    lifetime int(11) unsigned DEFAULT '0' NOT NULL,
    expires int(11) unsigned NOT NULL default '0',
    PRIMARY KEY (id),
    KEY cache_id (identifier,expires)
) ENGINE=InnoDB;

#
# TABLE STRUCTURE FOR TABLE 'cf_rzcoreupdate_versionStore_tags'
#
CREATE TABLE cf_rzcoreupdate_versionStore_tags (
    id int(11) unsigned NOT NULL auto_increment,
    identifier varchar(250) DEFAULT '' NOT NULL,
    tag varchar(250) DEFAULT '' NOT NULL,
    PRIMARY KEY (id),
    KEY cache_id (identifier),
    KEY cache_tag (tag)
) ENGINE=InnoDB;