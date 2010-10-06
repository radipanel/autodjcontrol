--
-- Table structure for table `autodj_options`
--

CREATE TABLE IF NOT EXISTS `autodj_options` (
  `id` int(255) NOT NULL auto_increment,
  `centovaurl` varchar(255) collate latin1_general_ci NOT NULL,
  `centovauser` varchar(255) collate latin1_general_ci NOT NULL,
  `centovapass` varchar(255) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Menu items for AutoDJ
--

INSERT INTO `menu` (id, text, url, resource, usergroup, protected, weight) VALUES (NULL, 'Advert manager', 'mgmt.autoDJ', '_res/mgmt/autoDJSettings.php', '5', '0', '0');

INSERT INTO `menu` (id, text, url, resource, usergroup, protected, weight) VALUES (NULL, 'AutoDJ Control', 'radio.autoDJ', '_res/radio/autoDJControl.php', '2', '0', '0');
