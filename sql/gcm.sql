
CREATE TABLE IF NOT EXISTS `survival_guide_pushes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regids` text NOT NULL,
  `sujet` varchar(200) NOT NULL,
  `message` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

-- --------------------------------------------------------

--
-- Structure de la table `regids`
--

CREATE TABLE IF NOT EXISTS `survival_guide_regids` (
  `regid` varchar(255) NOT NULL,
  `code_section` varchar(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`regid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
