-- ----------------------------
-- Table structure for `al_config`
-- ----------------------------
DROP TABLE IF EXISTS `al_config`;
CREATE TABLE `al_config` (
  `CID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `funktion` varchar(100) DEFAULT NULL,
  `aktiv` int(1) unsigned NOT NULL,
  PRIMARY KEY (`CID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of al_config
-- ----------------------------
INSERT INTO `al_config` VALUES ('1', 'Title from the page', 'AL-CMS Small', '1');
INSERT INTO `al_config` VALUES ('2', 'Standart URL Path', '127.0.0.1/partysuche/', '1');
INSERT INTO `al_config` VALUES ('3', 'Stndart Site ID', '1', '1');
INSERT INTO `al_config` VALUES ('4', 'Security ID', '2', '1');
INSERT INTO `al_config` VALUES ('5', 'Security Password Rounds', '8', '1');

-- ----------------------------
-- Table structure for `al_version`
-- ----------------------------
DROP TABLE IF EXISTS `al_version`;
CREATE TABLE `al_version` (
  `name` varchar(45) NOT NULL,
  `definition` text,
  `version` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of al_version
-- ----------------------------
INSERT INTO `al_version` VALUES ('AL-CMS Alpha v0.0.4', 'This is a Alpha Version.', '0.0.4');

-- ----------------------------
-- Table structure for `design`
-- ----------------------------
DROP TABLE IF EXISTS `design`;
CREATE TABLE `design` (
  `DID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `data` varchar(100) DEFAULT NULL,
  `mobile` int(1) DEFAULT NULL,
  `standart` int(1) DEFAULT NULL,
  `no_main_design` int(1) DEFAULT NULL,
  `aktiv` int(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`DID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of design
-- ----------------------------
INSERT INTO `design` VALUES ('1', 'default', 'default/', '0', '1', '0', '1');
INSERT INTO `design` VALUES ('2', 'default_login', 'default_login/', '0', '0', '1', '1');
INSERT INTO `design` VALUES ('3', 'login', 'login/', '0', '0', '1', '1');

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `GID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`GID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'anonym', 'Anonymer User der noch uneingeloggt ist.');
INSERT INTO `groups` VALUES ('2', 'user', 'Normaler user.');
INSERT INTO `groups` VALUES ('3', 'mod', 'Moderator');
INSERT INTO `groups` VALUES ('4', 'admin', 'Administrator');

-- ----------------------------
-- Table structure for `sites`
-- ----------------------------
DROP TABLE IF EXISTS `sites`;
CREATE TABLE `sites` (
  `SID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `html_file` varchar(100) DEFAULT NULL,
  `data` varchar(100) DEFAULT NULL,
  `aktiv` int(1) NOT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sites
-- ----------------------------
INSERT INTO `sites` VALUES ('1', 'startseite', 'startseite/index.html', 'startseite/startseite.php', '1');
INSERT INTO `sites` VALUES ('2', 'login', 'index.html', '', '1');
INSERT INTO `sites` VALUES ('3', 'regestrieren', 'register/index.html', 'register/register.php', '1');
INSERT INTO `sites` VALUES ('4', 'login_check', 'login/indext.html', 'login/login.php', '1');

-- ----------------------------
-- Table structure for `sites_group`
-- ----------------------------
DROP TABLE IF EXISTS `sites_group`;
CREATE TABLE `sites_group` (
  `SID` int(11) unsigned NOT NULL,
  `GID` int(11) unsigned NOT NULL,
  `Y_N` int(1) NOT NULL,
  KEY `GID` (`GID`),
  KEY `SID` (`SID`),
  CONSTRAINT `sites_group_ibfk_1` FOREIGN KEY (`GID`) REFERENCES `groups` (`GID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sites_group_ibfk_2` FOREIGN KEY (`SID`) REFERENCES `sites` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sites_group
-- ----------------------------
INSERT INTO `sites_group` VALUES ('1', '1', '1');
INSERT INTO `sites_group` VALUES ('2', '1', '1');
INSERT INTO `sites_group` VALUES ('3', '1', '1');
INSERT INTO `sites_group` VALUES ('4', '1', '1');

-- ----------------------------
-- Table structure for `site_design`
-- ----------------------------
DROP TABLE IF EXISTS `site_design`;
CREATE TABLE `site_design` (
  `MDID` int(11) unsigned DEFAULT NULL,
  `SID` int(11) DEFAULT NULL,
  `use_design` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of site_design
-- ----------------------------
INSERT INTO `site_design` VALUES ('1', '1', '1');
INSERT INTO `site_design` VALUES ('1', '2', '3');
INSERT INTO `site_design` VALUES ('1', '3', '1');
INSERT INTO `site_design` VALUES ('1', '4', '2');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `UID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `GID` int(11) unsigned NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `passwort` varchar(80) DEFAULT NULL,
  `passwort_salt` varchar(80) DEFAULT NULL,
  `rounds` int(2) unsigned DEFAULT NULL,
  `session_id` varchar(50) DEFAULT NULL,
  `ip_adresse` varchar(50) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `time_reg` varchar(45) DEFAULT NULL,
  `time_login` varchar(45) DEFAULT NULL,
  `aktive` int(1) DEFAULT NULL,
  `activated` int(1) DEFAULT NULL,
  `aktive_key` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`UID`),
  KEY `GID` (`GID`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`GID`) REFERENCES `groups` (`GID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
