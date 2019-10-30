
CREATE TABLE `m_item` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(32) NOT NULL,
  `jenis_barang` varchar(32) NOT NULL,
  `satuan` varchar(12) NOT NULL,
  `stock` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `m_item`
--
DELIMITER $$
CREATE TRIGGER `trg_check_value` BEFORE UPDATE ON `m_item` FOR EACH ROW if (new.stock < 0)THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Stock is not enough';
end if
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `userid` int(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `f_active` tinyint(1) DEFAULT NULL,
  `f_delete` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`userid`, `username`, `fullname`, `email`, `password`, `f_active`, `f_delete`) VALUES
(21, 'admin', 'Administrator 2', 'jerryerlangga82@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_inbound`
--

CREATE TABLE `t_inbound` (
  `id_inbound` int(11) NOT NULL,
  `tgl_inbound` date NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty_barang` bigint(12) NOT NULL,
  `creator` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `t_inbound`
--
DELIMITER $$
CREATE TRIGGER `trg_delete_stock_in` BEFORE DELETE ON `t_inbound` FOR EACH ROW UPDATE m_item
SET stock = stock - old.qty_barang
WHERE id_barang = old.id_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_tambah_stock_in` AFTER INSERT ON `t_inbound` FOR EACH ROW UPDATE m_item
SET stock = stock + new.qty_barang
WHERE id_barang = new.id_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_update_stock_in` BEFORE UPDATE ON `t_inbound` FOR EACH ROW UPDATE m_item
SET stock = stock + (new.qty_barang - old.qty_barang)
WHERE id_barang = new.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_outbound`
--

CREATE TABLE `t_outbound` (
  `id_outbound` int(11) NOT NULL,
  `tgl_outbound` date NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty_barang` bigint(12) NOT NULL,
  `creator` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `t_outbound`
--
DELIMITER $$
CREATE TRIGGER `trg_delete_stock_out` AFTER DELETE ON `t_outbound` FOR EACH ROW UPDATE m_item
SET stock = stock + old.qty_barang
WHERE id_barang = old.id_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_kurang_stock_out` BEFORE INSERT ON `t_outbound` FOR EACH ROW UPDATE m_item
SET stock = stock - new.qty_barang
WHERE id_barang = new.id_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_update_stock_out` BEFORE UPDATE ON `t_outbound` FOR EACH ROW UPDATE m_item
SET stock = stock - (new.qty_barang - old.qty_barang)
WHERE id_barang = new.id_barang
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_item`
--
ALTER TABLE `m_item`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `t_inbound`
--
ALTER TABLE `t_inbound`
  ADD PRIMARY KEY (`id_inbound`);

--
-- Indexes for table `t_outbound`
--
ALTER TABLE `t_outbound`
  ADD PRIMARY KEY (`id_outbound`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_item`
--
ALTER TABLE `m_item`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_inbound`
--
ALTER TABLE `t_inbound`
  MODIFY `id_inbound` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_outbound`
--
ALTER TABLE `t_outbound`
  MODIFY `id_outbound` int(11) NOT NULL AUTO_INCREMENT;
