/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - toko_minuman
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`) values 
(1,'admin','$2y$10$uDhVVoAqtd2wxZWMa8dM3OxvkbomfhWY8SmP8YvlJrpBWpephceh6');

/*Table structure for table `custom_rasa` */

DROP TABLE IF EXISTS `custom_rasa`;

CREATE TABLE `custom_rasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_keranjang` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `varian_rasa_produk_id` int(11) NOT NULL,
  `kode_produk` varchar(20) NOT NULL,
  `kode_customer` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `custom_rasa` */

insert  into `custom_rasa`(`id`,`id_keranjang`,`id_order`,`varian_rasa_produk_id`,`kode_produk`,`kode_customer`,`qty`) values 
(3,2,0,5,'P0002','C0006',1),
(4,2,0,6,'P0002','C0006',1);

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `kode_customer` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telp` varchar(200) NOT NULL,
  PRIMARY KEY (`kode_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `customer` */

insert  into `customer`(`kode_customer`,`nama`,`email`,`username`,`password`,`telp`) values 
('C0002','Rafi Akbar','a.rafy@gmail.com','rafi','$2y$10$/UjGYbisTPJhr8MgmT37qOXo1o/HJn3dhafPoSYbOlSN1E7olHIb.','0856748564'),
('C0003','Nagita Silvana','bambang@gmail.com','Nagita','$2y$10$47./qEeA/y3rNx3UkoKmkuxoAtmz4ebHSR0t0Bc.cFEEg7cK34M3C','087804616097'),
('C0004','Nadiya','nadiya@gmail.com','nadiya','$2y$10$6wHH.7rF1q3JtzKgAhNFy.4URchgJC8R.POT1osTAWmasDXTTO7ZG','0898765432'),
('C0005','Dhimas','Dhimas','dhimas','$2y$10$vRZ5mo17YRx68gGHZWfYf.mXHKr43HHcnbixUdyUwGEd2dXUrg7Vm','082311563036'),
('C0006','User','user@gmail.com','user','$2y$10$eTwChDV8999WD1EUzUUCROkVdIlXBsr3HTNUp4hzK7cmcr1EDp6Si','082311563036'),
('C0007','aditya','aditya@gmail.com','adit','$2y$10$/tC8XTB.bAwxFrLlbm3iPOdVyyZWi6WhQosbpEmqWmc1DHDGDyv4W','08221321963'),
('C0008','fitri','framadani804@gmail.com','fitri','$2y$10$EY8eIpBbcSymcAsijsEBcO3AqsOwgIV7e1swyqgCVlOTYgEr3O/gm','082289014344'),
('C0009','Indri S','indristeanalawati@gmail.com','indri','$2y$10$fBYdf8CUPzzZs5ZwCqVRbu7EApdkju9wwSg187rypIy4mivhzhWya','082233612458');

/*Table structure for table `detail_varian_rasa` */

DROP TABLE IF EXISTS `detail_varian_rasa`;

CREATE TABLE `detail_varian_rasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `id_varian_rasa_produk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `detail_varian_rasa` */

/*Table structure for table `keranjang` */

DROP TABLE IF EXISTS `keranjang`;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `keranjang` */

insert  into `keranjang`(`id_keranjang`,`id_varian_rasa_produk`,`id_varian_ukuran_produk`,`kode_customer`,`kode_produk`,`nama_produk`,`qty`,`harga`) values 
(2,10,0,'C0006','P0002','Es Krim (Termos)',2,375000);

/*Table structure for table `kota` */

DROP TABLE IF EXISTS `kota`;

CREATE TABLE `kota` (
  `id` char(4) NOT NULL,
  `province_id` char(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_province` (`province_id`),
  CONSTRAINT `fk_province` FOREIGN KEY (`province_id`) REFERENCES `provinsi` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `kota` */

insert  into `kota`(`id`,`province_id`,`name`) values 
('1101','11','KAB. ACEH SELATAN'),
('1102','11','KAB. ACEH TENGGARA'),
('1103','11','KAB. ACEH TIMUR'),
('1104','11','KAB. ACEH TENGAH'),
('1105','11','KAB. ACEH BARAT'),
('1106','11','KAB. ACEH BESAR'),
('1107','11','KAB. PIDIE'),
('1108','11','KAB. ACEH UTARA'),
('1109','11','KAB. SIMEULUE'),
('1110','11','KAB. ACEH SINGKIL'),
('1111','11','KAB. BIREUEN'),
('1112','11','KAB. ACEH BARAT DAYA'),
('1113','11','KAB. GAYO LUES'),
('1114','11','KAB. ACEH JAYA'),
('1115','11','KAB. NAGAN RAYA'),
('1116','11','KAB. ACEH TAMIANG'),
('1117','11','KAB. BENER MERIAH'),
('1118','11','KAB. PIDIE JAYA'),
('1171','11','KOTA BANDA ACEH'),
('1172','11','KOTA SABANG'),
('1173','11','KOTA LHOKSEUMAWE'),
('1174','11','KOTA LANGSA'),
('1175','11','KOTA SUBULUSSALAM'),
('1201','12','KAB. TAPANULI TENGAH'),
('1202','12','KAB. TAPANULI UTARA'),
('1203','12','KAB. TAPANULI SELATAN'),
('1204','12','KAB. NIAS'),
('1205','12','KAB. LANGKAT'),
('1206','12','KAB. KARO'),
('1207','12','KAB. DELI SERDANG'),
('1208','12','KAB. SIMALUNGUN'),
('1209','12','KAB. ASAHAN'),
('1210','12','KAB. LABUHANBATU'),
('1211','12','KAB. DAIRI'),
('1212','12','KAB. TOBA'),
('1213','12','KAB. MANDAILING NATAL'),
('1214','12','KAB. NIAS SELATAN'),
('1215','12','KAB. PAKPAK BHARAT'),
('1216','12','KAB. HUMBANG HASUNDUTAN'),
('1217','12','KAB. SAMOSIR'),
('1218','12','KAB. SERDANG BEDAGAI'),
('1219','12','KAB. BATU BARA'),
('1220','12','KAB. PADANG LAWAS UTARA'),
('1221','12','KAB. PADANG LAWAS'),
('1222','12','KAB. LABUHANBATU SELATAN'),
('1223','12','KAB. LABUHANBATU UTARA'),
('1224','12','KAB. NIAS UTARA'),
('1225','12','KAB. NIAS BARAT'),
('1271','12','KOTA MEDAN'),
('1272','12','KOTA PEMATANGSIANTAR'),
('1273','12','KOTA SIBOLGA'),
('1274','12','KOTA TANJUNG BALAI'),
('1275','12','KOTA BINJAI'),
('1276','12','KOTA TEBING TINGGI'),
('1277','12','KOTA PADANGSIDIMPUAN'),
('1278','12','KOTA GUNUNGSITOLI'),
('1301','13','KAB. PESISIR SELATAN'),
('1302','13','KAB. SOLOK'),
('1303','13','KAB. SIJUNJUNG'),
('1304','13','KAB. TANAH DATAR'),
('1305','13','KAB. PADANG PARIAMAN'),
('1306','13','KAB. AGAM'),
('1307','13','KAB. LIMA PULUH KOTA'),
('1308','13','KAB. PASAMAN'),
('1309','13','KAB. KEPULAUAN MENTAWAI'),
('1310','13','KAB. DHARMASRAYA'),
('1311','13','KAB. SOLOK SELATAN'),
('1312','13','KAB. PASAMAN BARAT'),
('1371','13','KOTA PADANG'),
('1372','13','KOTA SOLOK'),
('1373','13','KOTA SAWAHLUNTO'),
('1374','13','KOTA PADANG PANJANG'),
('1375','13','KOTA BUKITTINGGI'),
('1376','13','KOTA PAYAKUMBUH'),
('1377','13','KOTA PARIAMAN'),
('1401','14','KAB. KAMPAR'),
('1402','14','KAB. INDRAGIRI HULU'),
('1403','14','KAB. BENGKALIS'),
('1404','14','KAB. INDRAGIRI HILIR'),
('1405','14','KAB. PELALAWAN'),
('1406','14','KAB. ROKAN HULU'),
('1407','14','KAB. ROKAN HILIR'),
('1408','14','KAB. SIAK'),
('1409','14','KAB. KUANTAN SINGINGI'),
('1410','14','KAB. KEPULAUAN MERANTI'),
('1471','14','KOTA PEKANBARU'),
('1472','14','KOTA DUMAI'),
('1501','15','KAB. KERINCI'),
('1502','15','KAB. MERANGIN'),
('1503','15','KAB. SAROLANGUN'),
('1504','15','KAB. BATANGHARI'),
('1505','15','KAB. MUARO JAMBI'),
('1506','15','KAB. TANJUNG JABUNG BARAT'),
('1507','15','KAB. TANJUNG JABUNG TIMUR'),
('1508','15','KAB. BUNGO'),
('1509','15','KAB. TEBO'),
('1571','15','KOTA JAMBI'),
('1572','15','KOTA SUNGAI PENUH'),
('1601','16','KAB. OGAN KOMERING ULU'),
('1602','16','KAB. OGAN KOMERING ILIR'),
('1603','16','KAB. MUARA ENIM'),
('1604','16','KAB. LAHAT'),
('1605','16','KAB. MUSI RAWAS'),
('1606','16','KAB. MUSI BANYUASIN'),
('1607','16','KAB. BANYUASIN'),
('1608','16','KAB. OGAN KOMERING ULU TIMUR'),
('1609','16','KAB. OGAN KOMERING ULU SELATAN'),
('1610','16','KAB. OGAN ILIR'),
('1611','16','KAB. EMPAT LAWANG'),
('1612','16','KAB. PENUKAL ABAB LEMATANG ILIR'),
('1613','16','KAB. MUSI RAWAS UTARA'),
('1671','16','KOTA PALEMBANG'),
('1672','16','KOTA PAGAR ALAM'),
('1673','16','KOTA LUBUK LINGGAU'),
('1674','16','KOTA PRABUMULIH'),
('1701','17','KAB. BENGKULU SELATAN'),
('1702','17','KAB. REJANG LEBONG'),
('1703','17','KAB. BENGKULU UTARA'),
('1704','17','KAB. KAUR'),
('1705','17','KAB. SELUMA'),
('1706','17','KAB. MUKO MUKO'),
('1707','17','KAB. LEBONG'),
('1708','17','KAB. KEPAHIANG'),
('1709','17','KAB. BENGKULU TENGAH'),
('1771','17','KOTA BENGKULU'),
('1801','18','KAB. LAMPUNG SELATAN'),
('1802','18','KAB. LAMPUNG TENGAH'),
('1803','18','KAB. LAMPUNG UTARA'),
('1804','18','KAB. LAMPUNG BARAT'),
('1805','18','KAB. TULANG BAWANG'),
('1806','18','KAB. TANGGAMUS'),
('1807','18','KAB. LAMPUNG TIMUR'),
('1808','18','KAB. WAY KANAN'),
('1809','18','KAB. PESAWARAN'),
('1810','18','KAB. PRINGSEWU'),
('1811','18','KAB. MESUJI'),
('1812','18','KAB. TULANG BAWANG BARAT'),
('1813','18','KAB. PESISIR BARAT'),
('1871','18','KOTA BANDAR LAMPUNG'),
('1872','18','KOTA METRO'),
('1901','19','KAB. BANGKA'),
('1902','19','KAB. BELITUNG'),
('1903','19','KAB. BANGKA SELATAN'),
('1904','19','KAB. BANGKA TENGAH'),
('1905','19','KAB. BANGKA BARAT'),
('1906','19','KAB. BELITUNG TIMUR'),
('1971','19','KOTA PANGKAL PINANG'),
('2101','21','KAB. BINTAN'),
('2102','21','KAB. KARIMUN'),
('2103','21','KAB. NATUNA'),
('2104','21','KAB. LINGGA'),
('2105','21','KAB. KEPULAUAN ANAMBAS'),
('2171','21','KOTA BATAM'),
('2172','21','KOTA TANJUNG PINANG'),
('3101','31','KAB. ADM. KEP. SERIBU'),
('3171','31','KOTA ADM. JAKARTA PUSAT'),
('3172','31','KOTA ADM. JAKARTA UTARA'),
('3173','31','KOTA ADM. JAKARTA BARAT'),
('3174','31','KOTA ADM. JAKARTA SELATAN'),
('3175','31','KOTA ADM. JAKARTA TIMUR'),
('3201','32','KAB. BOGOR'),
('3202','32','KAB. SUKABUMI'),
('3203','32','KAB. CIANJUR'),
('3204','32','KAB. BANDUNG'),
('3205','32','KAB. GARUT'),
('3206','32','KAB. TASIKMALAYA'),
('3207','32','KAB. CIAMIS'),
('3208','32','KAB. KUNINGAN'),
('3209','32','KAB. CIREBON'),
('3210','32','KAB. MAJALENGKA'),
('3211','32','KAB. SUMEDANG'),
('3212','32','KAB. INDRAMAYU'),
('3213','32','KAB. SUBANG'),
('3214','32','KAB. PURWAKARTA'),
('3215','32','KAB. KARAWANG'),
('3216','32','KAB. BEKASI'),
('3217','32','KAB. BANDUNG BARAT'),
('3218','32','KAB. PANGANDARAN'),
('3271','32','KOTA BOGOR'),
('3272','32','KOTA SUKABUMI'),
('3273','32','KOTA BANDUNG'),
('3274','32','KOTA CIREBON'),
('3275','32','KOTA BEKASI'),
('3276','32','KOTA DEPOK'),
('3277','32','KOTA CIMAHI'),
('3278','32','KOTA TASIKMALAYA'),
('3279','32','KOTA BANJAR'),
('3301','33','KAB. CILACAP'),
('3302','33','KAB. BANYUMAS'),
('3303','33','KAB. PURBALINGGA'),
('3304','33','KAB. BANJARNEGARA'),
('3305','33','KAB. KEBUMEN'),
('3306','33','KAB. PURWOREJO'),
('3307','33','KAB. WONOSOBO'),
('3308','33','KAB. MAGELANG'),
('3309','33','KAB. BOYOLALI'),
('3310','33','KAB. KLATEN'),
('3311','33','KAB. SUKOHARJO'),
('3312','33','KAB. WONOGIRI'),
('3313','33','KAB. KARANGANYAR'),
('3314','33','KAB. SRAGEN'),
('3315','33','KAB. GROBOGAN'),
('3316','33','KAB. BLORA'),
('3317','33','KAB. REMBANG'),
('3318','33','KAB. PATI'),
('3319','33','KAB. KUDUS'),
('3320','33','KAB. JEPARA'),
('3321','33','KAB. DEMAK'),
('3322','33','KAB. SEMARANG'),
('3323','33','KAB. TEMANGGUNG'),
('3324','33','KAB. KENDAL'),
('3325','33','KAB. BATANG'),
('3326','33','KAB. PEKALONGAN'),
('3327','33','KAB. PEMALANG'),
('3328','33','KAB. TEGAL'),
('3329','33','KAB. BREBES'),
('3371','33','KOTA MAGELANG'),
('3372','33','KOTA SURAKARTA'),
('3373','33','KOTA SALATIGA'),
('3374','33','KOTA SEMARANG'),
('3375','33','KOTA PEKALONGAN'),
('3376','33','KOTA TEGAL'),
('3401','34','KAB. KULON PROGO'),
('3402','34','KAB. BANTUL'),
('3403','34','KAB. GUNUNGKIDUL'),
('3404','34','KAB. SLEMAN'),
('3471','34','KOTA YOGYAKARTA'),
('3501','35','KAB. PACITAN'),
('3502','35','KAB. PONOROGO'),
('3503','35','KAB. TRENGGALEK'),
('3504','35','KAB. TULUNGAGUNG'),
('3505','35','KAB. BLITAR'),
('3506','35','KAB. KEDIRI'),
('3507','35','KAB. MALANG'),
('3508','35','KAB. LUMAJANG'),
('3509','35','KAB. JEMBER'),
('3510','35','KAB. BANYUWANGI'),
('3511','35','KAB. BONDOWOSO'),
('3512','35','KAB. SITUBONDO'),
('3513','35','KAB. PROBOLINGGO'),
('3514','35','KAB. PASURUAN'),
('3515','35','KAB. SIDOARJO'),
('3516','35','KAB. MOJOKERTO'),
('3517','35','KAB. JOMBANG'),
('3518','35','KAB. NGANJUK'),
('3519','35','KAB. MADIUN'),
('3520','35','KAB. MAGETAN'),
('3521','35','KAB. NGAWI'),
('3522','35','KAB. BOJONEGORO'),
('3523','35','KAB. TUBAN'),
('3524','35','KAB. LAMONGAN'),
('3525','35','KAB. GRESIK'),
('3526','35','KAB. BANGKALAN'),
('3527','35','KAB. SAMPANG'),
('3528','35','KAB. PAMEKASAN'),
('3529','35','KAB. SUMENEP'),
('3571','35','KOTA KEDIRI'),
('3572','35','KOTA BLITAR'),
('3573','35','KOTA MALANG'),
('3574','35','KOTA PROBOLINGGO'),
('3575','35','KOTA PASURUAN'),
('3576','35','KOTA MOJOKERTO'),
('3577','35','KOTA MADIUN'),
('3578','35','KOTA SURABAYA'),
('3579','35','KOTA BATU'),
('3601','36','KAB. PANDEGLANG'),
('3602','36','KAB. LEBAK'),
('3603','36','KAB. TANGERANG'),
('3604','36','KAB. SERANG'),
('3671','36','KOTA TANGERANG'),
('3672','36','KOTA CILEGON'),
('3673','36','KOTA SERANG'),
('3674','36','KOTA TANGERANG SELATAN'),
('5101','51','KAB. JEMBRANA'),
('5102','51','KAB. TABANAN'),
('5103','51','KAB. BADUNG'),
('5104','51','KAB. GIANYAR'),
('5105','51','KAB. KLUNGKUNG'),
('5106','51','KAB. BANGLI'),
('5107','51','KAB. KARANGASEM'),
('5108','51','KAB. BULELENG'),
('5171','51','KOTA DENPASAR'),
('5201','52','KAB. LOMBOK BARAT'),
('5202','52','KAB. LOMBOK TENGAH'),
('5203','52','KAB. LOMBOK TIMUR'),
('5204','52','KAB. SUMBAWA'),
('5205','52','KAB. DOMPU'),
('5206','52','KAB. BIMA'),
('5207','52','KAB. SUMBAWA BARAT'),
('5208','52','KAB. LOMBOK UTARA'),
('5271','52','KOTA MATARAM'),
('5272','52','KOTA BIMA'),
('5301','53','KAB. KUPANG'),
('5302','53','KAB TIMOR TENGAH SELATAN'),
('5303','53','KAB. TIMOR TENGAH UTARA'),
('5304','53','KAB. BELU'),
('5305','53','KAB. ALOR'),
('5306','53','KAB. FLORES TIMUR'),
('5307','53','KAB. SIKKA'),
('5308','53','KAB. ENDE'),
('5309','53','KAB. NGADA'),
('5310','53','KAB. MANGGARAI'),
('5311','53','KAB. SUMBA TIMUR'),
('5312','53','KAB. SUMBA BARAT'),
('5313','53','KAB. LEMBATA'),
('5314','53','KAB. ROTE NDAO'),
('5315','53','KAB. MANGGARAI BARAT'),
('5316','53','KAB. NAGEKEO'),
('5317','53','KAB. SUMBA TENGAH'),
('5318','53','KAB. SUMBA BARAT DAYA'),
('5319','53','KAB. MANGGARAI TIMUR'),
('5320','53','KAB. SABU RAIJUA'),
('5321','53','KAB. MALAKA'),
('5371','53','KOTA KUPANG'),
('6101','61','KAB. SAMBAS'),
('6102','61','KAB. MEMPAWAH'),
('6103','61','KAB. SANGGAU'),
('6104','61','KAB. KETAPANG'),
('6105','61','KAB. SINTANG'),
('6106','61','KAB. KAPUAS HULU'),
('6107','61','KAB. BENGKAYANG'),
('6108','61','KAB. LANDAK'),
('6109','61','KAB. SEKADAU'),
('6110','61','KAB. MELAWI'),
('6111','61','KAB. KAYONG UTARA'),
('6112','61','KAB. KUBU RAYA'),
('6171','61','KOTA PONTIANAK'),
('6172','61','KOTA SINGKAWANG'),
('6201','62','KAB. KOTAWARINGIN BARAT'),
('6202','62','KAB. KOTAWARINGIN TIMUR'),
('6203','62','KAB. KAPUAS'),
('6204','62','KAB. BARITO SELATAN'),
('6205','62','KAB. BARITO UTARA'),
('6206','62','KAB. KATINGAN'),
('6207','62','KAB. SERUYAN'),
('6208','62','KAB. SUKAMARA'),
('6209','62','KAB. LAMANDAU'),
('6210','62','KAB. GUNUNG MAS'),
('6211','62','KAB. PULANG PISAU'),
('6212','62','KAB. MURUNG RAYA'),
('6213','62','KAB. BARITO TIMUR'),
('6271','62','KOTA PALANGKARAYA'),
('6301','63','KAB. TANAH LAUT'),
('6302','63','KAB. KOTABARU'),
('6303','63','KAB. BANJAR'),
('6304','63','KAB. BARITO KUALA'),
('6305','63','KAB. TAPIN'),
('6306','63','KAB. HULU SUNGAI SELATAN'),
('6307','63','KAB. HULU SUNGAI TENGAH'),
('6308','63','KAB. HULU SUNGAI UTARA'),
('6309','63','KAB. TABALONG'),
('6310','63','KAB. TANAH BUMBU'),
('6311','63','KAB. BALANGAN'),
('6371','63','KOTA BANJARMASIN'),
('6372','63','KOTA BANJARBARU'),
('6401','64','KAB. PASER'),
('6402','64','KAB. KUTAI KARTANEGARA'),
('6403','64','KAB. BERAU'),
('6407','64','KAB. KUTAI BARAT'),
('6408','64','KAB. KUTAI TIMUR'),
('6409','64','KAB. PENAJAM PASER UTARA'),
('6411','64','KAB. MAHAKAM ULU'),
('6471','64','KOTA BALIKPAPAN'),
('6472','64','KOTA SAMARINDA'),
('6474','64','KOTA BONTANG'),
('6501','65','KAB. BULUNGAN'),
('6502','65','KAB. MALINAU'),
('6503','65','KAB. NUNUKAN'),
('6504','65','KAB. TANA TIDUNG'),
('6571','65','KOTA TARAKAN'),
('7101','71','KAB. BOLAANG MONGONDOW'),
('7102','71','KAB. MINAHASA'),
('7103','71','KAB. KEPULAUAN SANGIHE'),
('7104','71','KAB. KEPULAUAN TALAUD'),
('7105','71','KAB. MINAHASA SELATAN'),
('7106','71','KAB. MINAHASA UTARA'),
('7107','71','KAB. MINAHASA TENGGARA'),
('7108','71','KAB. BOLAANG MONGONDOW UTARA'),
('7109','71','KAB. KEP. SIAU TAGULANDANG BIARO'),
('7110','71','KAB. BOLAANG MONGONDOW TIMUR'),
('7111','71','KAB. BOLAANG MONGONDOW SELATAN'),
('7171','71','KOTA MANADO'),
('7172','71','KOTA BITUNG'),
('7173','71','KOTA TOMOHON'),
('7174','71','KOTA KOTAMOBAGU'),
('7201','72','KAB. BANGGAI'),
('7202','72','KAB. POSO'),
('7203','72','KAB. DONGGALA'),
('7204','72','KAB. TOLI TOLI'),
('7205','72','KAB. BUOL'),
('7206','72','KAB. MOROWALI'),
('7207','72','KAB. BANGGAI KEPULAUAN'),
('7208','72','KAB. PARIGI MOUTONG'),
('7209','72','KAB. TOJO UNA UNA'),
('7210','72','KAB. SIGI'),
('7211','72','KAB. BANGGAI LAUT'),
('7212','72','KAB. MOROWALI UTARA'),
('7271','72','KOTA PALU'),
('7301','73','KAB. KEPULAUAN SELAYAR'),
('7302','73','KAB. BULUKUMBA'),
('7303','73','KAB. BANTAENG'),
('7304','73','KAB. JENEPONTO'),
('7305','73','KAB. TAKALAR'),
('7306','73','KAB. GOWA'),
('7307','73','KAB. SINJAI'),
('7308','73','KAB. BONE'),
('7309','73','KAB. MAROS'),
('7310','73','KAB. PANGKAJENE KEPULAUAN'),
('7311','73','KAB. BARRU'),
('7312','73','KAB. SOPPENG'),
('7313','73','KAB. WAJO'),
('7314','73','KAB. SIDENRENG RAPPANG'),
('7315','73','KAB. PINRANG'),
('7316','73','KAB. ENREKANG'),
('7317','73','KAB. LUWU'),
('7318','73','KAB. TANA TORAJA'),
('7322','73','KAB. LUWU UTARA'),
('7324','73','KAB. LUWU TIMUR'),
('7326','73','KAB. TORAJA UTARA'),
('7371','73','KOTA MAKASSAR'),
('7372','73','KOTA PARE PARE'),
('7373','73','KOTA PALOPO'),
('7401','74','KAB. KOLAKA'),
('7402','74','KAB. KONAWE'),
('7403','74','KAB. MUNA'),
('7404','74','KAB. BUTON'),
('7405','74','KAB. KONAWE SELATAN'),
('7406','74','KAB. BOMBANA'),
('7407','74','KAB. WAKATOBI'),
('7408','74','KAB. KOLAKA UTARA'),
('7409','74','KAB. KONAWE UTARA'),
('7410','74','KAB. BUTON UTARA'),
('7411','74','KAB. KOLAKA TIMUR'),
('7412','74','KAB. KONAWE KEPULAUAN'),
('7413','74','KAB. MUNA BARAT'),
('7414','74','KAB. BUTON TENGAH'),
('7415','74','KAB. BUTON SELATAN'),
('7471','74','KOTA KENDARI'),
('7472','74','KOTA BAU BAU'),
('7501','75','KAB. GORONTALO'),
('7502','75','KAB. BOALEMO'),
('7503','75','KAB. BONE BOLANGO'),
('7504','75','KAB. POHUWATO'),
('7505','75','KAB. GORONTALO UTARA'),
('7571','75','KOTA GORONTALO'),
('7601','76','KAB. PASANGKAYU'),
('7602','76','KAB. MAMUJU'),
('7603','76','KAB. MAMASA'),
('7604','76','KAB. POLEWALI MANDAR'),
('7605','76','KAB. MAJENE'),
('7606','76','KAB. MAMUJU TENGAH'),
('8101','81','KAB. MALUKU TENGAH'),
('8102','81','KAB. MALUKU TENGGARA'),
('8103','81','KAB. KEPULAUAN TANIMBAR'),
('8104','81','KAB. BURU'),
('8105','81','KAB. SERAM BAGIAN TIMUR'),
('8106','81','KAB. SERAM BAGIAN BARAT'),
('8107','81','KAB. KEPULAUAN ARU'),
('8108','81','KAB. MALUKU BARAT DAYA'),
('8109','81','KAB. BURU SELATAN'),
('8171','81','KOTA AMBON'),
('8172','81','KOTA TUAL'),
('8201','82','KAB. HALMAHERA BARAT'),
('8202','82','KAB. HALMAHERA TENGAH'),
('8203','82','KAB. HALMAHERA UTARA'),
('8204','82','KAB. HALMAHERA SELATAN'),
('8205','82','KAB. KEPULAUAN SULA'),
('8206','82','KAB. HALMAHERA TIMUR'),
('8207','82','KAB. PULAU MOROTAI'),
('8208','82','KAB. PULAU TALIABU'),
('8271','82','KOTA TERNATE'),
('8272','82','KOTA TIDORE KEPULAUAN'),
('9103','91','KAB. JAYAPURA'),
('9105','91','KAB. KEPULAUAN YAPEN'),
('9106','91','KAB. BIAK NUMFOR'),
('9110','91','KAB. SARMI'),
('9111','91','KAB. KEEROM'),
('9115','91','KAB. WAROPEN'),
('9119','91','KAB. SUPIORI'),
('9120','91','KAB. MAMBERAMO RAYA'),
('9171','91','KOTA JAYAPURA'),
('9201','92','KAB. SORONG'),
('9202','92','KAB. MANOKWARI'),
('9203','92','KAB. FAK FAK'),
('9204','92','KAB. SORONG SELATAN'),
('9205','92','KAB. RAJA AMPAT'),
('9206','92','KAB. TELUK BINTUNI'),
('9207','92','KAB. TELUK WONDAMA'),
('9208','92','KAB. KAIMANA'),
('9209','92','KAB. TAMBRAUW'),
('9210','92','KAB. MAYBRAT'),
('9211','92','KAB. MANOKWARI SELATAN'),
('9212','92','KAB. PEGUNUNGAN ARFAK'),
('9271','92','KOTA SORONG'),
('9301','93','KAB. MERAUKE'),
('9302','93','KAB. BOVEN DIGOEL'),
('9303','93','KAB. MAPPI'),
('9304','93','KAB. ASMAT'),
('9401','94','KAB. NABIRE'),
('9402','94','KAB. PUNCAK JAYA'),
('9403','94','KAB. PANIAI'),
('9404','94','KAB. MIMIKA'),
('9405','94','KAB. PUNCAK'),
('9406','94','KAB. DOGIYAI'),
('9407','94','KAB. INTAN JAYA'),
('9408','94','KAB. DEIYAI'),
('9501','95','KAB. JAYAWIJAYA'),
('9502','95','KAB. PEGUNUNGAN BINTANG'),
('9503','95','KAB. YAHUKIMO'),
('9504','95','KAB. TOLIKARA'),
('9505','95','KAB. MAMBERAMO TENGAH'),
('9506','95','KAB. YALIMO'),
('9507','95','KAB. LANNY JAYA'),
('9508','95','KAB. NDUGA');

/*Table structure for table `maksimal_pemesanan` */

DROP TABLE IF EXISTS `maksimal_pemesanan`;

CREATE TABLE `maksimal_pemesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maksimal_pemesanan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `maksimal_pemesanan` */

insert  into `maksimal_pemesanan`(`id`,`maksimal_pemesanan`) values 
(1,10);

/*Table structure for table `metode_pembayaran` */

DROP TABLE IF EXISTS `metode_pembayaran`;

CREATE TABLE `metode_pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `layanan` varchar(100) NOT NULL,
  `nomor` varchar(100) NOT NULL,
  `atas_nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `metode_pembayaran` */

insert  into `metode_pembayaran`(`id`,`layanan`,`nomor`,`atas_nama`) values 
(2,'BRI','0838-01-046709-53-2','Suparjo'),
(3,'BCA','123456789','DHIMAS YUDHATAMA');

/*Table structure for table `opsi_produk` */

DROP TABLE IF EXISTS `opsi_produk`;

CREATE TABLE `opsi_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(25) NOT NULL,
  `rasa` varchar(25) NOT NULL,
  `ukuran` varchar(25) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `opsi_produk` */

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_varian_rasa_produk` int(11) NOT NULL,
  `id_varian_ukuran_produk` int(11) NOT NULL,
  `invoice` varchar(200) NOT NULL,
  `kode_customer` varchar(200) NOT NULL,
  `kode_produk` varchar(200) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `metode_pembayaran` varchar(20) NOT NULL,
  `bukti_pembayaran` varchar(225) NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_pengambilan` date NOT NULL,
  `provinsi` varchar(200) NOT NULL,
  `kota` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kode_pos` varchar(200) NOT NULL,
  `terima` varchar(200) NOT NULL,
  `tolak` varchar(200) NOT NULL,
  `alasan_penolakan` varchar(50) NOT NULL,
  `alasan_dll` text NOT NULL,
  `cek` int(11) NOT NULL,
  `catatan_khusus` text DEFAULT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `order` */

insert  into `order`(`id_order`,`id_varian_rasa_produk`,`id_varian_ukuran_produk`,`invoice`,`kode_customer`,`kode_produk`,`nama_produk`,`qty`,`harga`,`status`,`metode_pembayaran`,`bukti_pembayaran`,`tanggal`,`tanggal_pengambilan`,`provinsi`,`kota`,`alamat`,`kode_pos`,`terima`,`tolak`,`alasan_penolakan`,`alasan_dll`,`cek`,`catatan_khusus`) values 
(3,0,0,'INV0003','C0006','P0001','Es Dawet (Termos)',2,375000,'0','tunai','66bcbec5598fb.','2024-08-14','2024-08-16','','KAB. TANGERANG','test','123','2','0','','',0,'test'),
(4,0,0,'INV0004','C0006','P0001','Es Dawet (Termos)',2,375000,'0','tunai','66bcc0e5c5c73.','2024-08-14','2024-08-16','','KOTA YOGYAKARTA','Kp. Pengkolan Desa Pasir Jaya RT 002 RW 001','15710','2','0','','',0,''),
(5,0,0,'INV0005','C0006','P0001','Es Dawet (Termos)',2,375000,'0','tunai','66bcc2b4986cf.','2024-08-14','2024-08-16','','KAB. TANGERANG','test1','15710','2','0','','',0,'test1'),
(6,0,0,'INV0006','C0006','P0001','Es Dawet (Termos)',2,375000,'0','non_tunai','66bcc2dfaf65b.png','2024-08-14','2024-08-16','','KAB. TANGERANG','test2','15710','2','0','','',0,'test2'),
(7,0,0,'INV0007','C0006','P0001','Es Dawet (Termos)',2,375000,'Pesanan Baru','non_tunai','66bd56d79b4c9.png','2024-08-15','2024-08-16','','KAB. TANGERANG','TEST3','15710','0','1','ya ditolak aja','',0,'TEST3'),
(8,0,0,'INV0008','C0006','P0002','Es Krim (Termos)',2,375000,'Pesanan Baru','tunai','66bef8bd21c91.','2024-08-16','2024-08-19','','KAB. BLITAR','Kp. Pengkolan Desa Pasir Jaya RT 002 RW 001','15710','0','1','reschedule','',0,''),
(9,0,0,'INV0009','C0006','P0005','ES DOGER (TERMOS)',2,375000,'Pesanan Baru','non_tunai','66bef9359035c.png','2024-08-16','2024-08-19','','KAB. BENGKULU TENGAH','flsfeqikjsngm,vd','1222','0','1','dll','sudah booking ditempat lain',0,''),
(10,0,0,'INV0010','C0006','P0005','ES DOGER (TERMOS)',2,375000,'Pesanan Baru','non_tunai','66befabe618fb.png','2024-08-16','2024-08-24','','KAB. REJANG LEBONG','tanggamus','54475','0','1','menolak_pesanan','',0,''),
(11,0,0,'INV0011','C0007','P0002','Es Krim (Termos)',15,375000,'0','tunai','66c19f61d6d0e.','2024-08-18','2024-08-20','','KAB. TANGERANG','Kp. Kadu ','15710','2','0','','',0,''),
(12,0,0,'INV0012','C0007','P0003','Es Podeng (Termos)',2,600000,'Pesanan Baru','non_tunai','66c19fe4ec68b.png','2024-08-18','2024-08-20','','KAB. TANGERANG','KP. Kadu','15810','0','0','','',0,''),
(13,0,0,'INV0013','C0008','P0002','Es Krim (Termos)',5,375000,'0','tunai','66c2cc7e060f8.','2024-08-19','2024-08-26','','KAB. KLUNGKUNG','blablabla','12456','2','0','','',0,''),
(14,0,0,'INV0014','C0007','P0002','Es Krim (Termos)',6,375000,'Pesanan Baru','non_tunai','66c2ce8814575.png','2024-08-19','2024-08-26','','KOTA ADM. JAKARTA BARAT','daanmogot','55555','0','0','','',0,''),
(15,0,0,'INV0014','C0007','P0003','Es Podeng (Termos)',2,600000,'Pesanan Baru','non_tunai','66c2ce8814575.png','2024-08-19','2024-08-26','','KOTA ADM. JAKARTA BARAT','daanmogot','55555','0','0','','',0,''),
(16,0,0,'INV0015','C0007','P0004','Es Sarang Burung',2,375000,'Pesanan Baru','tunai','66c2cfbab50ec.','2024-08-19','2024-08-26','','KAB. JEMBRANA','blabla','5555','0','1','','',0,''),
(17,0,0,'INV0015','C0007','P0001','Es Dawet (Termos)',2,375000,'Pesanan Baru','tunai','66c2cfbab50ec.','2024-08-19','2024-08-26','','KAB. JEMBRANA','blabla','5555','0','1','','',0,''),
(18,0,0,'INV0016','C0009','P0002','Es Krim (Termos)',4,375000,'0','tunai','66c58ba008a74.','2024-08-21','2024-08-23','','KOTA ADM. JAKARTA PUSAT','desa mana aja ','15555','0','1','reschedule','',0,''),
(19,5,2,'INV0017','C0009','P0002','Es Krim (Termos)',2,400000,'Pesanan Baru','tunai','66c58c019a951.','2024-08-21','2024-08-23','','KAB. BANTUL','dimana aja boleh','55555','0','1','','',0,''),
(20,0,0,'INV0018','C0009','P0001','Es Dawet (Termos)',2,375000,'Pesanan Baru','tunai','66c58df53f632.','2024-08-21','2024-08-23','','KAB. ACEH SELATAN','dddddd','44444','0','1','penjual_pembeli_tidak_merespon_chat','',0,''),
(21,10,0,'INV0019','C0006','P0002','Es Krim (Termos)',2,375000,'0','non_tunai','66ce96c2dc756.png','2024-08-28','2024-08-29','','KAB. TANGERANG','test','123','1','0','','',0,'test');

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `kode_produk` varchar(100) NOT NULL,
  `katalog` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `deskripsi` text NOT NULL,
  `minimal_pemesanan` int(11) NOT NULL DEFAULT 1,
  `harga` int(11) NOT NULL,
  `custom_rasa` int(1) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`kode_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `produk` */

insert  into `produk`(`kode_produk`,`katalog`,`nama`,`image`,`deskripsi`,`minimal_pemesanan`,`harga`,`custom_rasa`,`created_at`,`updated_at`) values 
('P0001','minuman_tradisional','Es Dawet (Termos)','66953297253fc.png','Minuman tradisional es dawet dibuat dengan perpaduan sempurna antara manisnya gula jawa asli dan kenyalnya cendol.<br/><br/>\r\n<table>\r\n  <tr>\r\n    <td>Kondisi</td>\r\n    <td>  :  </td>\r\n    <td>Baru</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Minimal Pemesanan</td>\r\n    <td>  :  </td>\r\n    <td>2 Termos</td>\r\n  </tr>\r\n</table>\r\n<br/><b>Bahan - bahan :</b>\r\n<br/>- Tepung Beras\r\n<br/>- Air Matang\r\n<br/>- Air Daun Pandan dan Daun Suji\r\n<br/>- Gula Jawa\r\n<br/>- Santen Kelapa\r\n<br/>- Daun Pandan\r\n<br/>- Sedikit Garam\r\n<br /><br />\r\n<table>\r\n  <tr>\r\n    <td>Ukuran Medium</td>\r\n    <td>  :  </td>\r\n    <td>1 termos sama dengan 110 cup</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Ukuran Large</td>\r\n    <td>  :  </td>\r\n    <td>1 termos sama dengan 135 cup</td>\r\n  </tr>\r\n</table>\r\n',2,375000,0,'2024-07-10 10:00:39','2024-07-21 22:17:27'),
('P0002','es_krim','Es Krim (Termos)','66953162a6474.png','Es krim ini terdapat beberapa varian Rasa diantaranya: Coklat, Strowberry, Vanila, Anggur, Mangga, lainya. Dengan tekstur yang lembut dan creamy. <br /><br />\r\n<table>\r\n			<tr>\r\n				<td>Kondisi</td>\r\n				<td>  :  </td>\r\n				<td>Baru</td>\r\n			</tr>\r\n			<tr>\r\n				<td>Minimal Pemesanan</td>\r\n				<td>  :  </td>\r\n				<td>2 Termos</td>\r\n			</tr>\r\n		</table><br />\r\n<table>\r\n  <tr>\r\n    <td>Ukuran Medium</td>\r\n    <td>  :  </td>\r\n    <td>1 termos sama dengan 110 cup</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Ukuran Large</td>\r\n    <td>  :  </td>\r\n    <td>1 termos sama dengan 135 cup</td>\r\n  </tr>\r\n</table>',2,375000,1,'2024-07-15 21:25:38','2024-08-26 08:36:55'),
('P0003','minuman_tradisional','Es Podeng (Termos)','66953468bac0f.png','Es podeng dibuat dengan bahan dasar santan kelapa segar dan dipadukan dengan isian alpukat, roti tawar, mutiara, ketan hitam, agar-agar, kacang, susu kental manis. Dibuat secara tradisional memiliki citarasa sendiri di banding ice cream pada umumnya. Memiliki sensasi rasa yang unik serta khas Indonesia.\r\n<br />\r\n<br />\r\n<table>\r\n			<tr>\r\n				<td>Kondisi</td>\r\n				<td>  :  </td>\r\n				<td>Baru</td>\r\n			</tr>\r\n			<tr>\r\n				<td>Minimal Pemesanan</td>\r\n				<td>  :  </td>\r\n				<td>2</td>\r\n			</tr>\r\n			<tr>\r\n				<td>Prosedur Pemesanan</td>\r\n				<td>  :  </td>\r\n				<td>Minimal booking pesanan 1 hari sebelum hari-H</td>\r\n			</tr>\r\n			<tr>\r\n				<td>Pengiriman</td>\r\n				<td>  :  </td>\r\n				<td>Diantar langsung di hari-H</td>\r\n			</tr>\r\n		</table>\r\n<br/><b>Bahan - bahan :</b>\r\n<br/>- Santan kelapa segar\r\n<br/>- Tepung\r\n<br/>- Gula\r\n<br/>- Garam\r\n<br/>- Buah alpukat \r\n<br/>- Kacang\r\n<br/>- Ketan hitam \r\n<br/>- Roti  \r\n<br />\r\n<br />\r\n<table>\r\n  <tr>\r\n    <td>Ukuran Medium</td>\r\n    <td>  :  </td>\r\n    <td>1 termos sama dengan 110 cup</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Ukuran Large</td>\r\n    <td>  :  </td>\r\n    <td>1 termos sama dengan 135 cup</td>\r\n  </tr>\r\n</table>\r\n',2,600000,0,'2024-07-15 21:38:32','2024-07-21 22:20:52'),
('P0004','minuman_tradisional','Es Sarang Burung','66953a094806c.png','Es Sarang Burung adalah minuman tradisional yang tetbuat dari bahan alami dengan daging kelapa muda yang lembut, sarang burung walet yang kenyal (atau agar-agar/jeli yang dipotong kecil), serta buah-buahan segar.\r\n<br />\r\n<br />\r\n<b>Bahan - Bahan:</b>\r\n<br/>- Sarang burung walet (bisa diganti dengan agar-agar atau jeli yang dipotong kecil-kecil)\r\n<br/>- Air kelapa muda\r\n<br/>- Daging kelapa muda\r\n<br/>- Sirup cocopandan atau sirup sesuai selera\r\n<br/>- Nata de coco\r\n<br/>- Biji selasih (direndam hingga mengembang)\r\n<br/>- Buah-buahan segar\r\n<br /><br />\r\n<table>\r\n  <tr>\r\n    <td>Ukuran Medium</td>\r\n    <td>  :  </td>\r\n    <td>1 termos sama dengan 110 cup</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Ukuran Large</td>\r\n    <td>  :  </td>\r\n    <td>1 termos sama dengan 135 cup</td>\r\n  </tr>\r\n</table>',2,375000,0,'2024-07-15 22:02:33','2024-07-21 22:21:14'),
('P0005','minuman_tradisional','ES DOGER (TERMOS)','669d22b1272f3.jpg','Es doger dibuat dengan rasa tradisional yang dibuat dengan potongan kelapa muda dan tape singkong yang menajadi ciri khas, minuman tradisional ini tanpa pengawet dan pemanis buatan.<br/><br/>\r\n<table>\r\n    <tr>\r\n        <td>Kondisi</td>\r\n        <td>  :  </td>\r\n        <td>Baru</td>\r\n    </tr>\r\n    <tr>\r\n        <td>Min. Pemesanan</td>\r\n        <td>  :  </td>\r\n        <td>2 Termos</td>\r\n    </tr>\r\n</table>\r\n<br />\r\n<table>\r\n  <tr>\r\n    <td>Ukuran Medium</td>\r\n    <td>  :  </td>\r\n    <td>1 termos sama dengan 110 cup</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Ukuran Large</td>\r\n    <td>  :  </td>\r\n    <td>1 termos sama dengan 135 cup</td>\r\n  </tr>\r\n</table>',2,375000,0,'2024-07-21 22:01:05','2024-07-21 22:21:51');

/*Table structure for table `provinsi` */

DROP TABLE IF EXISTS `provinsi`;

CREATE TABLE `provinsi` (
  `id` char(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `provinsi` */

insert  into `provinsi`(`id`,`name`) values 
('11','ACEH'),
('12','SUMATERA UTARA'),
('13','SUMATERA BARAT'),
('14','RIAU'),
('15','JAMBI'),
('16','SUMATERA SELATAN'),
('17','BENGKULU'),
('18','LAMPUNG'),
('19','KEPULAUAN BANGKA BELITUNG'),
('21','KEPULAUAN RIAU'),
('31','DKI JAKARTA'),
('32','JAWA BARAT'),
('33','JAWA TENGAH'),
('34','DAERAH ISTIMEWA YOGYAKARTA'),
('35','JAWA TIMUR'),
('36','BANTEN'),
('51','BALI'),
('52','NUSA TENGGARA BARAT'),
('53','NUSA TENGGARA TIMUR'),
('61','KALIMANTAN BARAT'),
('62','KALIMANTAN TENGAH'),
('63','KALIMANTAN SELATAN'),
('64','KALIMANTAN TIMUR'),
('65','KALIMANTAN UTARA'),
('71','SULAWESI UTARA'),
('72','SULAWESI TENGAH'),
('73','SULAWESI SELATAN'),
('74','SULAWESI TENGGARA'),
('75','GORONTALO'),
('76','SULAWESI BARAT'),
('81','MALUKU'),
('82','MALUKU UTARA'),
('91','PAPUA'),
('92','PAPUA BARAT'),
('93','PAPUA SELATAN'),
('94','PAPUA TENGAH'),
('95','PAPUA PEGUNUNGAN');

/*Table structure for table `varian_rasa_produk` */

DROP TABLE IF EXISTS `varian_rasa_produk`;

CREATE TABLE `varian_rasa_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(25) NOT NULL,
  `rasa` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `varian_rasa_produk` */

insert  into `varian_rasa_produk`(`id`,`kode_produk`,`rasa`) values 
(5,'P0002','Coklat'),
(6,'P0002','Strawberry'),
(7,'P0002','Vanila'),
(8,'P0002','Anggur'),
(9,'P0002','Mangga'),
(10,'P0002','Custom');

/*Table structure for table `varian_ukuran_produk` */

DROP TABLE IF EXISTS `varian_ukuran_produk`;

CREATE TABLE `varian_ukuran_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(20) NOT NULL,
  `ukuran` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `varian_ukuran_produk` */

insert  into `varian_ukuran_produk`(`id`,`kode_produk`,`ukuran`,`harga`) values 
(2,'P0002','Large',400000),
(4,'P0004','Large',400000),
(5,'P0001','Large',400000),
(6,'P0005','Large',400000),
(7,'P0003','Large',700000);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
