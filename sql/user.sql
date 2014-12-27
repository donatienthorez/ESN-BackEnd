CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `code_section` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`username`, `password`, `code_section`) VALUES
('admin', 'admin', 'FR-LILLE-ESL');

