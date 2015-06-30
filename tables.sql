CREATE TABLE `user` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `username` varchar(255) NOT NULL default '',
  `real_name` varchar(255) NOT NULL default '',
  `password` tinyblob NOT NULL,
  `email` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

