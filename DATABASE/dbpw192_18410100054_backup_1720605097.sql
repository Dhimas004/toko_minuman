

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO admin VALUES("1","admin","$2y$10$pmiJYYvSbmeq.BVfCSZz2O3o/OiMg0a6GLF94Srns2awSmEuTqgRe");



CREATE TABLE `bom_produk` (
  `kode_bom` varchar(100) NOT NULL,
  `kode_bk` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `kebutuhan` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;




CREATE TABLE `customer` (
  `kode_customer` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telp` varchar(200) NOT NULL,
  PRIMARY KEY (`kode_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO customer VALUES("C0002","Rafi Akbar","a.rafy@gmail.com","rafi","$2y$10$/UjGYbisTPJhr8MgmT37qOXo1o/HJn3dhafPoSYbOlSN1E7olHIb.","0856748564");
INSERT INTO customer VALUES("C0003","Nagita Silvana","bambang@gmail.com","Nagita","$2y$10$47./qEeA/y3rNx3UkoKmkuxoAtmz4ebHSR0t0Bc.cFEEg7cK34M3C","087804616097");
INSERT INTO customer VALUES("C0004","Nadiya","nadiya@gmail.com","nadiya","$2y$10$6wHH.7rF1q3JtzKgAhNFy.4URchgJC8R.POT1osTAWmasDXTTO7ZG","0898765432");
INSERT INTO customer VALUES("C0005","Dhimas","Dhimas","dhimas","$2y$10$vRZ5mo17YRx68gGHZWfYf.mXHKr43HHcnbixUdyUwGEd2dXUrg7Vm","082311563036");



CREATE TABLE `inventory` (
  `kode_bk` varchar(100) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `qty` varchar(200) NOT NULL,
  `satuan` varchar(200) NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`kode_bk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO inventory VALUES("M0001","Tepung","76","Kg","1000","2020-07-26");
INSERT INTO inventory VALUES("M0002","Pengembang","0","Kg","1000","2020-07-27");
INSERT INTO inventory VALUES("M0003","Cream","17","Kg","3000","2020-07-26");
INSERT INTO inventory VALUES("M0004","Keju","82","Kg","4000","2020-07-26");
INSERT INTO inventory VALUES("M0005","Coklat","0","Kg","5000","2020-07-27");



CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL AUTO_INCREMENT,
  `id_varian_rasa_produk` int(11) NOT NULL,
  `id_varian_ukuran_produk` int(11) NOT NULL,
  `kode_customer` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id_keranjang`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

INSERT INTO keranjang VALUES("26","4","0","C0005","P0001","Es Dawet","1","10000");



CREATE TABLE `opsi_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(25) NOT NULL,
  `rasa` varchar(25) NOT NULL,
  `ukuran` varchar(25) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




;




CREATE TABLE `produk` (
  `kode_produk` varchar(100) NOT NULL,
  `katalog` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO produk VALUES("P0001","minuman_tradisional","Es Dawet","668df957718ae.jpg","test","10000","2024-07-10 10:00:39","");



CREATE TABLE `produksi` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(200) NOT NULL,
  `kode_customer` varchar(200) NOT NULL,
  `kode_produk` varchar(200) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `provinsi` varchar(200) NOT NULL,
  `kota` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kode_pos` varchar(200) NOT NULL,
  `terima` varchar(200) NOT NULL,
  `tolak` varchar(200) NOT NULL,
  `cek` int(11) NOT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

INSERT INTO produksi VALUES("8","INV0001","C0002","P0003","Kue tart coklat","1","100000","Pesanan Baru","2020-07-27","Jawa Timur","Surabaya","Jl.Tanah Merah Indah 1","60129","2","1","0");
INSERT INTO produksi VALUES("9","INV0002","C0002","P0001","Roti Sobek","3","10000","Pesanan Baru","2020-07-27","Jawa Barat","Bandung","Jl.Jati Nangor Blok C, 10","30712","0","0","1");
INSERT INTO produksi VALUES("10","INV0003","C0003","P0002","Maryam","2","15000","0","2020-07-27","Jawa Tengah","Yogyakarta","Jl.Malioboro, Blok A 10D","30123","1","0","0");
INSERT INTO produksi VALUES("11","INV0003","C0003","P0003","Kue tart coklat","1","100000","0","2020-07-27","Jawa Tengah","Yogyakarta","Jl.Malioboro, Blok A 10D","30123","1","0","0");
INSERT INTO produksi VALUES("12","INV0003","C0003","P0001","Roti Sobek","1","10000","0","2020-07-27","Jawa Tengah","Yogyakarta","Jl.Malioboro, Blok A 10D","30123","1","0","0");
INSERT INTO produksi VALUES("13","INV0004","C0004","P0002","Maryam","1","15000","Pesanan Baru","2020-07-26","Jawa Timur","Sidoarjo","Jl.KH Syukur Blok C 18 A","50987","0","0","0");
INSERT INTO produksi VALUES("14","INV0005","C0005","P0001","Es Dawet","4","10000","Pesanan Baru","2024-07-10","123","456","789","101112","0","0","0");
INSERT INTO produksi VALUES("15","INV0005","C0005","P0001","Es Dawet","4","15000","Pesanan Baru","2024-07-10","123","456","789","101112","0","0","0");
INSERT INTO produksi VALUES("16","INV0006","C0005","P0001","Es Dawet","1","15000","Pesanan Baru","2024-07-10","345","456","45","465","0","0","0");
INSERT INTO produksi VALUES("17","INV0007","C0005","P0001","Es Dawet","1","15000","Pesanan Baru","2024-07-10","345","456","45","465","0","0","0");
INSERT INTO produksi VALUES("18","INV0008","C0005","P0001","Es Dawet","2","10000","Pesanan Baru","2024-07-10","Banten","Tangerang","Mekar Asri 2","15710","0","0","0");
INSERT INTO produksi VALUES("19","INV0009","C0005","P0001","Es Dawet","2","10000","Pesanan Baru","2024-07-10","Banten","Tangerang","Mekar Asri 2","15710","0","0","0");
INSERT INTO produksi VALUES("20","INV0009","C0005","P0001","Es Dawet","2","15000","Pesanan Baru","2024-07-10","Banten","Tangerang","Mekar Asri 2","15710","0","0","0");



;




CREATE TABLE `report_cancel` (
  `id_report_cancel` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_report_cancel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `report_inventory` (
  `id_report_inv` int(11) NOT NULL AUTO_INCREMENT,
  `kode_bk` varchar(100) NOT NULL,
  `nama_bahanbaku` varchar(100) NOT NULL,
  `jml_stok_bk` int(11) NOT NULL,
  `tanggal` varchar(11) NOT NULL,
  PRIMARY KEY (`id_report_inv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `report_omset` (
  `id_report_omset` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_omset` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_report_omset`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `report_produksi` (
  `id_report_prd` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_report_prd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `report_profit` (
  `id_report_profit` int(11) NOT NULL AUTO_INCREMENT,
  `kode_bom` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `jumlah` varchar(11) NOT NULL,
  `total_profit` varchar(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_report_profit`),
  UNIQUE KEY `kode_bom` (`kode_bom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `varian_rasa_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(25) NOT NULL,
  `rasa` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO varian_rasa_produk VALUES("4","P0001","Vanilla");



CREATE TABLE `varian_ukuran_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(20) NOT NULL,
  `ukuran` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO varian_ukuran_produk VALUES("1","P0001","Medium","15000");

