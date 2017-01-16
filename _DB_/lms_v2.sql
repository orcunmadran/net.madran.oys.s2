-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 26 Ocak 2010 saat 14:09:03
-- Sunucu sürümü: 5.0.67
-- PHP Sürümü: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `lms_v2`
--

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_cevrimici`
--

CREATE TABLE IF NOT EXISTS `lms_cevrimici` (
  `no` int(11) NOT NULL auto_increment,
  `dersno` int(11) NOT NULL,
  `baslik` varchar(255) collate utf8_turkish_ci NOT NULL,
  `adres` varchar(255) collate utf8_turkish_ci NOT NULL,
  `eklenti` varchar(20) collate utf8_turkish_ci NOT NULL,
  `kontrol` varchar(255) collate utf8_turkish_ci NOT NULL,
  PRIMARY KEY  (`no`),
  UNIQUE KEY `kontrol` (`kontrol`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `lms_cevrimici`
--

INSERT INTO `lms_cevrimici` (`no`, `dersno`, `baslik`, `adres`, `eklenti`, `kontrol`) VALUES
(1, 1, 'Veritabanı Yönetim Sistemi - MySQL', 'http://www.mysql.com', '09.01.2008 - 14:36', '1_http://www.mysql.com'),
(2, 1, 'Programlama Dili - PHP', 'http://www.php.net', '09.01.2008 - 14:36', '1_http://www.php.net');

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_ders`
--

CREATE TABLE IF NOT EXISTS `lms_ders` (
  `no` int(11) NOT NULL auto_increment,
  `kod` varchar(20) collate utf8_turkish_ci NOT NULL,
  `ad` varchar(255) collate utf8_turkish_ci NOT NULL,
  `tanim` text collate utf8_turkish_ci NOT NULL,
  `izlence` text collate utf8_turkish_ci,
  `aktif` varchar(5) collate utf8_turkish_ci NOT NULL,
  `kimlik` varchar(20) collate utf8_turkish_ci NOT NULL,
  `etkilesim` varchar(5) collate utf8_turkish_ci NOT NULL,
  PRIMARY KEY  (`no`),
  UNIQUE KEY `kod` (`kod`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `lms_ders`
--

INSERT INTO `lms_ders` (`no`, `kod`, `ad`, `tanim`, `izlence`, `aktif`, `kimlik`, `etkilesim`) VALUES
(1, 'ÖTÖ 401', 'Eğitimde İnternet Uygulamaları', 'Bu ders, okul (ve her türlü eğitim kurumu) yönetiminde bilgisayar uygulamalarının en etkin şekilde kullanılabilmesini sağlamak için gerekli uygulama yazılımının oluşturulmasını amaçlamaktadır. Bu amaca ulaşabilmek için, web teknolojilerinden oluşan esnek bir platform üzerinde gerekli uygulamaların geliştirilmesi planlanmıştır.', '\r\n<p><span class="baslik">Genel Bilgiler</span></p>\r\n<p><span class="arabaslik">Dersin Tanımı ve Amacı</span></p><span class="icyazi">\r\n  <p>Günümüzde hemen hemen her ölçekteki kurum ve kuruluşta bilgisayar teknolojilerinin yaygın kullanımı rahatlıkla gözlemlenebilmektedir. Kullanımdaki bu artış ile birlikte ön plana çıkan; hızlı ve doğru karar verme, zamanında sorunlara müdahale edebilme ve problemleri çözme kavram ve yaklaşımları, özellikle yönetim kademeleri için bilgisayar teknolojilerini vazgeçilmez kılmaktadır.</p>\r\n  <p>Her seviyede eğitim kurumunda da yönetim kademelerinde bilgisayar teknolojilerinden faydalanılması sayısız faydayı da beraberinde getirmektedir, getirecektir.</p>\r\n  <p>Bu ders, okul (ve her türlü eğitim kurumu) yönetiminde bilgisayar uygulamalarının en etkin şekilde kullanılabilmesini sağlamak için gerekli uygulama yazılımının oluşturulmasını amaçlamaktadır. Bu amaca ulaşabilmek için, web teknolojilerinden oluşan esnek bir platform üzerinde gerekli uygulamaların geliştirilmesi planlanmıştır.</p>\r\n  <p>Dersin genel yapısı 3 ana bölümden oluşmaktadır. Bu bölümler;</p>\r\n  <ul>\r\n    <li>Uygulamanın temelini oluşturacak veri tabanı mimarisinin geliştirilmesi. </li>\r\n    <li>Uygulama ile ilgili kullanıcı ve yönetim arayüzlerinin tasarlanması. </li>\r\n    <li>Veri tabanı ve arayüzlerin web tabanlı bir yapı içerisinde kullanılmasını sağlayacak kod yapısının oluşturulması.</li>\r\n  </ul></span>\r\n<p><span class="arabaslik">Değerlendirme Koşulları</span></p>\r\n<ul><span class="icyazi">\r\n    <li>Ara Sınav: %40</li>\r\n    <li>Final Sınavı: %60</li></ul>\r\n    <p><span class="arabaslik">Basılı Kaynaklar</span></p>\r\n    <ul>\r\n      <li>Çaycı, Özgür. 2003. PHP ve MYSQL. Seçkin Yayıncılık: Ankara. </li>\r\n      <li>Gilmore, W. Jason. 2004. Beginning PHP 5 and MySQL : from novice to professional. Apress; Distributed to the Boo: Berkeley, CA :N&nbsp;&nbsp;&nbsp;&nbsp; </li>\r\n      <li>Harris, Andy. 2004. PHP/MySQL programming for the absolute beginner [electronic resource] Premier Press Inc., a division:&nbsp; Boston, Mass.&nbsp;&nbsp;&nbsp; </li>\r\n      <li>Meloni, Julie C. 2004. PHP 5 [electronic resource] : fast &amp; easy web development. Thomson Course Technology: Boston, MA&nbsp;&nbsp;&nbsp;&nbsp; </li>\r\n      <li>Vaswani, Vikram.&nbsp; 2005. How to do everything with PHP &amp; MySQL [electronic resource] McGraw-Hill/Osborne: Emeryville, Cal </li>\r\n      <li>Welling, Luke. 2002. Uzmanlar için PHP ve MySQL web uygulama geliştirme kılavuz Alfa/Aktüel Kitabevi: Bursa</li>\r\n    </ul></span>\r\n</ul>', 'EVET', 'omadran', 'EVET'),
(2, 'TEST Kanal B', 'Test Dersi', 'Kısa Tanım', NULL, 'EVET', 'omadran', 'HAYIR');

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_dokuman`
--

CREATE TABLE IF NOT EXISTS `lms_dokuman` (
  `no` int(11) NOT NULL auto_increment,
  `dersno` int(11) NOT NULL,
  `dosyaadi` varchar(255) collate utf8_turkish_ci NOT NULL,
  `orjinalad` varchar(255) collate utf8_turkish_ci NOT NULL,
  `guncelleme` varchar(20) collate utf8_turkish_ci NOT NULL default '',
  `kontrol` varchar(255) collate utf8_turkish_ci NOT NULL,
  PRIMARY KEY  (`no`),
  UNIQUE KEY `kontrol` (`kontrol`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `lms_dokuman`
--

INSERT INTO `lms_dokuman` (`no`, `dersno`, `dosyaadi`, `orjinalad`, `guncelleme`, `kontrol`) VALUES
(1, 1, 'bilimsel_yayin.pdf', 'Bilimsel Yayın.pdf', '09.01.2008 - 14:35', '1_Bilimsel Yayın.pdf'),
(2, 1, 'veritabani_sistemleri.txt', 'Veritabanı Sistemleri.txt', '09.01.2008 - 14:36', '1_Veritabanı Sistemleri.txt');

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_duyuru`
--

CREATE TABLE IF NOT EXISTS `lms_duyuru` (
  `no` int(11) NOT NULL auto_increment,
  `kimlik` varchar(20) collate utf8_turkish_ci NOT NULL,
  `kod` varchar(11) collate utf8_turkish_ci NOT NULL,
  `hedef` varchar(255) collate utf8_turkish_ci NOT NULL,
  `baslik` varchar(255) collate utf8_turkish_ci NOT NULL,
  `icerik` text collate utf8_turkish_ci,
  `baslama` date NOT NULL,
  `bitis` date NOT NULL,
  PRIMARY KEY  (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `lms_duyuru`
--

INSERT INTO `lms_duyuru` (`no`, `kimlik`, `kod`, `hedef`, `baslik`, `icerik`, `baslama`, `bitis`) VALUES
(1, 'omadran', '0', 'Genel Duyuru', 'Test', 'Test', '2008-02-05', '2008-02-05');

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_forum_baslik`
--

CREATE TABLE IF NOT EXISTS `lms_forum_baslik` (
  `no` int(11) NOT NULL auto_increment,
  `dersno` int(11) NOT NULL,
  `subeno` int(11) NOT NULL,
  `kimlik` varchar(20) collate utf8_turkish_ci NOT NULL,
  `baslik` varchar(255) collate utf8_turkish_ci NOT NULL,
  `aciklama` text collate utf8_turkish_ci NOT NULL,
  `kilit` varchar(5) collate utf8_turkish_ci NOT NULL default 'HAYIR',
  `tarih` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `lms_forum_baslik`
--

INSERT INTO `lms_forum_baslik` (`no`, `dersno`, `subeno`, `kimlik`, `baslik`, `aciklama`, `kilit`, `tarih`) VALUES
(1, 1, 1, 'omadran', 'Eğitim ve İnternet', 'Eğitim uygulamalarında İnternet''in önemi.', 'HAYIR', '2008-01-09 14:40:14');

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_forum_yorum`
--

CREATE TABLE IF NOT EXISTS `lms_forum_yorum` (
  `no` int(11) NOT NULL auto_increment,
  `baslikno` int(11) NOT NULL,
  `kimlik` varchar(20) collate utf8_turkish_ci NOT NULL,
  `yorum` text collate utf8_turkish_ci NOT NULL,
  `zaman` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `engelle` binary(1) NOT NULL default '0',
  PRIMARY KEY  (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

--
-- Tablo döküm verisi `lms_forum_yorum`
--


-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_giriscikis`
--

CREATE TABLE IF NOT EXISTS `lms_giriscikis` (
  `sirano` int(11) NOT NULL auto_increment,
  `kimlik` varchar(15) collate utf8_turkish_ci NOT NULL,
  `eylem` int(1) NOT NULL,
  `tarihsaat` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `ipnum` varchar(20) collate utf8_turkish_ci NOT NULL,
  PRIMARY KEY  (`sirano`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=21 ;

--
-- Tablo döküm verisi `lms_giriscikis`
--

INSERT INTO `lms_giriscikis` (`sirano`, `kimlik`, `eylem`, `tarihsaat`, `ipnum`) VALUES
(1, 'omadran', 1, '2008-01-09 14:23:51', '127.0.0.1'),
(2, 'omadran', 0, '2008-01-09 14:26:10', '127.0.0.1'),
(3, 'omadran', 1, '2008-01-09 14:26:28', '127.0.0.1'),
(4, 'omadran', 0, '2008-01-09 14:34:17', '127.0.0.1'),
(5, 'omadran', 1, '2008-01-09 14:34:32', '127.0.0.1'),
(6, 'omadran', 0, '2008-01-09 14:40:46', '127.0.0.1'),
(7, 'omadran', 1, '2008-01-09 14:41:51', '127.0.0.1'),
(8, 'omadran', 1, '2008-01-11 13:22:49', '127.0.0.1'),
(9, 'omadran', 1, '2008-01-13 12:45:19', '127.0.0.1'),
(10, 'omadran', 0, '2008-01-13 12:45:50', '127.0.0.1'),
(11, 'omadran', 1, '2008-01-13 14:46:28', '127.0.0.1'),
(12, 'ornekogrenci', 1, '2008-01-13 14:59:18', '127.0.0.1'),
(13, 'ornekogrenci', 0, '2008-01-13 15:00:35', '127.0.0.1'),
(14, 'admin', 1, '2008-01-13 15:13:54', '127.0.0.1'),
(15, 'admin', 0, '2008-01-13 15:16:58', '127.0.0.1'),
(16, 'omadran', 1, '2008-01-13 15:18:38', '127.0.0.1'),
(17, 'ornekogrenci', 1, '2008-01-13 15:24:43', '127.0.0.1'),
(18, 'omadran', 1, '2008-01-26 02:52:26', '127.0.0.1'),
(19, 'omadran', 1, '2008-02-05 13:53:48', '127.0.0.1'),
(20, 'ornekogrenci', 1, '2008-06-17 21:57:52', '127.0.0.1');

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_gunler`
--

CREATE TABLE IF NOT EXISTS `lms_gunler` (
  `no` int(1) NOT NULL auto_increment,
  `gun` varchar(10) collate utf8_turkish_ci NOT NULL,
  `deger` int(1) NOT NULL,
  PRIMARY KEY  (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=8 ;

--
-- Tablo döküm verisi `lms_gunler`
--

INSERT INTO `lms_gunler` (`no`, `gun`, `deger`) VALUES
(1, 'Pazartesi', 1),
(2, 'Salı', 2),
(3, 'Çarşamba', 3),
(4, 'Perşembe', 4),
(5, 'Cuma', 5),
(6, 'Cumartesi', 6),
(7, 'Pazar', 0);

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_kullanici`
--

CREATE TABLE IF NOT EXISTS `lms_kullanici` (
  `kimlik` varchar(20) collate utf8_turkish_ci NOT NULL,
  `sifre` varchar(20) collate utf8_turkish_ci NOT NULL,
  `yetki` int(1) NOT NULL default '0',
  `ad` varchar(40) collate utf8_turkish_ci NOT NULL,
  `soyad` varchar(40) collate utf8_turkish_ci NOT NULL,
  `eposta` varchar(50) collate utf8_turkish_ci NOT NULL,
  `web` varchar(50) collate utf8_turkish_ci default 'http://',
  PRIMARY KEY  (`kimlik`),
  UNIQUE KEY `eposta` (`eposta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci COMMENT='Kullanici Bilgileri';

--
-- Tablo döküm verisi `lms_kullanici`
--

INSERT INTO `lms_kullanici` (`kimlik`, `sifre`, `yetki`, `ad`, `soyad`, `eposta`, `web`) VALUES
('admin', '9360673', 1, 'Sistem', 'Yöneticisi', 'orcunmadran@gmail.com', 'http://lms.midas.baskent.edu.tr'),
('ornekogrenci', '9360673', 5, 'Örnek', 'Öğrenci', 'orcun@madran.net', 'http://'),
('madran', '9360673', 2, 'Orçun', 'Madran', 'omadran@baskent.edu.tr', 'http://');

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_mesaj`
--

CREATE TABLE IF NOT EXISTS `lms_mesaj` (
  `no` int(11) NOT NULL auto_increment,
  `zaman` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `gonderen` varchar(20) collate utf8_turkish_ci NOT NULL,
  `alici` text collate utf8_turkish_ci NOT NULL,
  `konu` varchar(100) collate utf8_turkish_ci NOT NULL,
  `icerik` text collate utf8_turkish_ci NOT NULL,
  `okundu` text collate utf8_turkish_ci NOT NULL,
  `silindi` text collate utf8_turkish_ci NOT NULL,
  PRIMARY KEY  (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `lms_mesaj`
--

INSERT INTO `lms_mesaj` (`no`, `zaman`, `gonderen`, `alici`, `konu`, `icerik`, `okundu`, `silindi`) VALUES
(1, '2008-01-09 14:43:44', 'omadran', 'ornekogrenci ', 'Ödev Teslimi ile ilgili', 'Ödev teslimini lütfen belirlenen kriterlere göre yapınız.', ' ornekogrenci', '');

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_not_defteri`
--

CREATE TABLE IF NOT EXISTS `lms_not_defteri` (
  `no` int(11) NOT NULL auto_increment,
  `kimlik` varchar(20) collate utf8_turkish_ci NOT NULL,
  `konu` varchar(255) collate utf8_turkish_ci NOT NULL,
  `icerik` text collate utf8_turkish_ci NOT NULL,
  `hatirlat` varchar(5) collate utf8_turkish_ci default NULL,
  `nezaman` date NOT NULL,
  `tarih` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

--
-- Tablo döküm verisi `lms_not_defteri`
--


-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_odev`
--

CREATE TABLE IF NOT EXISTS `lms_odev` (
  `no` int(11) NOT NULL auto_increment,
  `projeno` int(11) NOT NULL,
  `dosyaadi` varchar(255) collate utf8_turkish_ci NOT NULL,
  `orjinalad` varchar(255) collate utf8_turkish_ci NOT NULL,
  `guncelleme` varchar(20) collate utf8_turkish_ci NOT NULL,
  `kimlik` varchar(20) collate utf8_turkish_ci NOT NULL,
  `notu` int(3) default NULL,
  `donut` varchar(255) collate utf8_turkish_ci NOT NULL default 'Henüz değerlendirme yapılmadı.',
  PRIMARY KEY  (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `lms_odev`
--

INSERT INTO `lms_odev` (`no`, `projeno`, `dosyaadi`, `orjinalad`, `guncelleme`, `kimlik`, `notu`, `donut`) VALUES
(1, 1, '1_ornekogrenci_84912.doc', 'odev.doc', '13.01.2008 - 15:26', 'ornekogrenci', 78, 'Burada da dönüt bulunmakta.');

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_proje`
--

CREATE TABLE IF NOT EXISTS `lms_proje` (
  `no` int(11) NOT NULL auto_increment,
  `dersno` int(11) NOT NULL,
  `dosyaadi` varchar(255) collate utf8_turkish_ci NOT NULL,
  `orjinalad` varchar(255) collate utf8_turkish_ci NOT NULL,
  `guncelleme` varchar(20) collate utf8_turkish_ci NOT NULL default '',
  `kontrol` varchar(255) collate utf8_turkish_ci NOT NULL,
  `teslim` date NOT NULL,
  PRIMARY KEY  (`no`),
  UNIQUE KEY `kontrol` (`kontrol`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `lms_proje`
--

INSERT INTO `lms_proje` (`no`, `dersno`, `dosyaadi`, `orjinalad`, `guncelleme`, `kontrol`, `teslim`) VALUES
(1, 1, 'proje_1.txt', 'Proje 1.txt', '09.01.2008 - 14:38', '1_Proje 1.txt', '2008-01-31');

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_seviye`
--

CREATE TABLE IF NOT EXISTS `lms_seviye` (
  `yetki` int(1) NOT NULL,
  `aciklama` varchar(25) collate utf8_turkish_ci NOT NULL,
  PRIMARY KEY  (`yetki`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci COMMENT='Yetki Seviyeleri';

--
-- Tablo döküm verisi `lms_seviye`
--

INSERT INTO `lms_seviye` (`yetki`, `aciklama`) VALUES
(1, 'İdari Yönetici'),
(2, 'Akademik Yönetici'),
(3, 'Öğretim Elemanı'),
(4, 'Sekreterya'),
(5, 'Öğrenci');

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_sinif`
--

CREATE TABLE IF NOT EXISTS `lms_sinif` (
  `no` int(11) NOT NULL auto_increment,
  `subeno` int(11) NOT NULL,
  `kimlik` varchar(20) collate utf8_turkish_ci NOT NULL,
  `kontrol` varchar(30) collate utf8_turkish_ci NOT NULL,
  PRIMARY KEY  (`no`),
  UNIQUE KEY `kontrol` (`kontrol`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `lms_sinif`
--

INSERT INTO `lms_sinif` (`no`, `subeno`, `kimlik`, `kontrol`) VALUES
(1, 1, 'ornekogrenci', 'ornekogrenci.1.1'),
(2, 2, 'ornekogrenci', 'ornekogrenci.2.1');

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_sohbet_bans`
--

CREATE TABLE IF NOT EXISTS `lms_sohbet_bans` (
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `userid` int(11) default NULL,
  `banneduserid` int(11) default NULL,
  `roomid` int(11) default NULL,
  `ip` varchar(16) collate utf8_turkish_ci default NULL,
  KEY `userid` (`userid`),
  KEY `created` (`created`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `lms_sohbet_bans`
--


-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_sohbet_config`
--

CREATE TABLE IF NOT EXISTS `lms_sohbet_config` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `level_0` varchar(255) collate utf8_turkish_ci NOT NULL default '',
  `level_1` varchar(255) collate utf8_turkish_ci default NULL,
  `level_2` varchar(255) collate utf8_turkish_ci default NULL,
  `level_3` varchar(255) collate utf8_turkish_ci default NULL,
  `level_4` varchar(255) collate utf8_turkish_ci default NULL,
  `type` varchar(10) collate utf8_turkish_ci default NULL,
  `title` varchar(255) collate utf8_turkish_ci NOT NULL default '',
  `comment` varchar(255) collate utf8_turkish_ci NOT NULL default '',
  `info` varchar(255) collate utf8_turkish_ci NOT NULL default '',
  `parent_page` varchar(255) collate utf8_turkish_ci NOT NULL default '',
  `_order` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

--
-- Tablo döküm verisi `lms_sohbet_config`
--


-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_sohbet_config_chats`
--

CREATE TABLE IF NOT EXISTS `lms_sohbet_config_chats` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` char(100) collate utf8_turkish_ci NOT NULL default '',
  `instances` char(255) collate utf8_turkish_ci NOT NULL default '1',
  `is_default` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

--
-- Tablo döküm verisi `lms_sohbet_config_chats`
--


-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_sohbet_config_instances`
--

CREATE TABLE IF NOT EXISTS `lms_sohbet_config_instances` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `is_active` tinyint(1) unsigned NOT NULL default '1',
  `is_default` tinyint(1) unsigned NOT NULL default '0',
  `name` varchar(100) collate utf8_turkish_ci NOT NULL default '',
  `created_date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

--
-- Tablo döküm verisi `lms_sohbet_config_instances`
--


-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_sohbet_config_values`
--

CREATE TABLE IF NOT EXISTS `lms_sohbet_config_values` (
  `id` int(3) unsigned NOT NULL auto_increment,
  `instance_id` int(10) unsigned NOT NULL default '0',
  `config_id` int(10) unsigned NOT NULL default '0',
  `value` text collate utf8_turkish_ci NOT NULL,
  `disabled` int(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

--
-- Tablo döküm verisi `lms_sohbet_config_values`
--


-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_sohbet_connections`
--

CREATE TABLE IF NOT EXISTS `lms_sohbet_connections` (
  `id` varchar(32) collate utf8_turkish_ci NOT NULL default '',
  `updated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `userid` int(11) default NULL,
  `roomid` int(11) default NULL,
  `state` tinyint(4) NOT NULL default '1',
  `color` int(11) default NULL,
  `start` int(11) default NULL,
  `lang` char(2) collate utf8_turkish_ci default NULL,
  `ip` varchar(16) collate utf8_turkish_ci default NULL,
  `tzoffset` int(11) default '0',
  `chatid` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`),
  KEY `roomid` (`roomid`),
  KEY `updated` (`updated`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `lms_sohbet_connections`
--


-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_sohbet_ignors`
--

CREATE TABLE IF NOT EXISTS `lms_sohbet_ignors` (
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `userid` int(11) default NULL,
  `ignoreduserid` int(11) default NULL,
  KEY `userid` (`userid`),
  KEY `ignoreduserid` (`ignoreduserid`),
  KEY `created` (`created`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `lms_sohbet_ignors`
--


-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_sohbet_messages`
--

CREATE TABLE IF NOT EXISTS `lms_sohbet_messages` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `toconnid` varchar(32) collate utf8_turkish_ci default NULL,
  `touserid` int(11) default NULL,
  `toroomid` int(11) default NULL,
  `command` varchar(255) collate utf8_turkish_ci NOT NULL default '',
  `userid` int(11) default NULL,
  `roomid` int(11) default NULL,
  `txt` text collate utf8_turkish_ci,
  `chatid` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `touserid` (`touserid`),
  KEY `toroomid` (`toroomid`),
  KEY `toconnid` (`toconnid`),
  KEY `created` (`created`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=83 ;

--
-- Tablo döküm verisi `lms_sohbet_messages`
--

INSERT INTO `lms_sohbet_messages` (`id`, `created`, `toconnid`, `touserid`, `toroomid`, `command`, `userid`, `roomid`, `txt`, `chatid`) VALUES
(65, '2008-01-13 14:47:48', NULL, NULL, NULL, 'rmu', 1, NULL, NULL, 1),
(66, '2008-01-13 15:29:03', '5149936ceb37befea2dc8028d7ae6c15', NULL, NULL, 'lout', NULL, NULL, 'login', 1),
(67, '2008-01-13 15:29:03', '5149936ceb37befea2dc8028d7ae6c15', NULL, NULL, 'lng', NULL, NULL, '<language loaded="1" id="tr" name="TÃ¼rkÃ§e"><messages  ignored="KullanÄ±cÄ± ''USER_LABEL'' mesajlarÄ±nÄ±zÄ± red ediyor" banned="YasaklandÄ±nÄ±z" login="Sohbete girmek iÃ§in &lt;a href=&quot;../index.php&quot;&gt;&lt;b&gt;tÄ±klayÄ±nÄ±z&lt;/b&gt;&lt;/a&gt;" required="gerekli" wrongPass="YanlÄ±ÅŸ kullanÄ±cÄ± ismi veya ÅŸifresi. LÃ¼tfen tekrar deneyin" anotherlogin="Bu kullanÄ±cÄ± ismi ile baÅŸka kullanÄ±cÄ± girmiÅŸ. LÃ¼tfen tekrar deneyin." expiredlogin="BaÄŸlantÄ±nÄ±z zaman aÅŸÄ±mÄ±na uÄŸradÄ±. LÃ¼tfen yeniden giriÅŸ yapÄ±n." enterroom="[ROOM_LABEL]: USER_LABEL odaya saat TIMESTAMP da girdi" leaveroom="[ROOM_LABEL]: USER_LABEL, odadan saat TIMESTAMP da Ã§Ä±ktÄ±" selfenterroom="HoÅŸgeldiniz! [ROOM_LABEL] odasÄ±na TIMESTAMP da giriÅŸ yaptÄ±nÄ±z" bellrang="USER_LABEL kullanÄ±cÄ±sÄ± zil Ã§aldÄ±" chatfull="Sohbet dolu. LÃ¼tfen daha sonra tekrar deneyiniz." iplimit="Zaten sohbettesiniz." roomlock="Bu oda ÅŸifre korumalÄ±dÄ±r.&lt;br&gt;LÃ¼tfen oda ÅŸifresini giriniz:" locked="HatalÄ± ÅŸifre. LÃ¼tfen yeniden deneyiniz." botfeat="Bot fonksiyonu devrede deÄŸil." securityrisk="YÃ¼klemek istediÄŸiniz dosya riskli bir iÃ§eriÄŸe sahip. LÃ¼tfen baÅŸka bir dosya seÃ§iniz."/><desktop  invalidsettings="GeÃ§ersiz ayarlar" selectsmile="GÃ¼lenyÃ¼zler" sendBtn="Yolla" saveBtn="Kaydet" soundBtn="Ses" skinBtn="GÃ¶rÃ¼nÃ¼m" addRoomBtn="Ekle" myStatus="Durumum" room="Oda" welcome="HoÅŸgeldin USER_LABEL" ringTheBell="Cevap Yok? Zili Ã§al:" logOffBtn="X" helpBtn="?" adminSign="(M)"/><dialog id="misc"  roomnotfound="''ROOM_LABEL'' odasÄ± bulunamadÄ±" usernotfound="KullanÄ±cÄ± ''USER_LABEL'' bulunamadÄ±" unbanned="KullanÄ±cÄ± ''USER_LABEL'' tarafÄ±ndan yasaÄŸÄ±nÄ±z kaldÄ±rÄ±ldÄ±" banned="KullanÄ±cÄ± ''USER_LABEL'' tarafÄ±ndan yasaklandÄ±nÄ±z" unignored="KullanÄ±cÄ± ''USER_LABEL'' tarafÄ±ndan red listesinden Ã§Ä±kartÄ±ldÄ±nÄ±z" ignored="KullanÄ±cÄ± ''USER_LABEL'' tarafÄ±ndan red edildiniz" invitationdeclined="KullanÄ±cÄ± ''USER_LABEL'',''ROOM_LABEL'' odasÄ±na davetinizi kabul etmedi" invitationaccepted="KullanÄ±cÄ± ''USER_LABEL'',''ROOM_LABEL'' odasÄ±na davetinizi kabul etti" roomnotcreated="Oda yaratÄ±lmadÄ±" roomisfull="[ROOM_LABEL] odasÄ± dolu. LÃ¼tfen baÅŸka bir oda seÃ§iniz." alert="&lt;b&gt;UYARI!&lt;/b&gt;&lt;br&gt;&lt;br&gt;" chatalert="&lt;b&gt;UYARI!&lt;/b&gt;&lt;br&gt;&lt;br&gt;" gag="&lt;b&gt;DURATION dakika boyunca susturuldunuz!&lt;/b&gt;&lt;br&gt;&lt;br&gt;Bu odadaki mesajlarÄ± gÃ¶rebilirsiniz, ancak susturulma sÃ¼reniz sona erene kadar yeni mesaj gÃ¶nderemezsiniz." ungagged="''USER_LABEL'' tarafÄ±ndan susturulma cezanÄ±z iptal edildi." gagconfirm="USER_LABEL MINUTES dakika iÃ§in susturuldu." alertconfirm="USER_LABEL uyarÄ±yÄ± okudu." file_declined="DosyanÄ±z USER_LABEL tarafÄ±ndan reddedildi." file_accepted="DosyanÄ±z USER_LABEL tarafÄ±ndan kabul edildi."/><dialog id="unignore"  unignoreBtn="Red iptal" unignoretext="Red iptal metnini giriniz"/><dialog id="unban"  unbanBtn="Yasak iptal" unbantext="Yasak iptal metnini giriniz"/><dialog id="tablabels"  themes="Temalar" sounds="Sesler" text="Metin" effects="Efektler" admin="YÃ¶netici" about="HakkÄ±nda"/><dialog id="text"  itemChange="DeÄŸiÅŸtirilecek madde" fontSize="YazÄ± karakter bÃ¼yÃ¼klÃ¼ÄŸÃ¼" fontFamily="YazÄ± tipi" language="Dil" mainChat="Ana Sohbet" interfaceElements="Arabirim ElemanlarÄ±" title="BaÅŸlÄ±k" mytextcolor="AlÄ±nan mesajlarÄ±n hepsi iÃ§in benim metin rengimi kullan."/><dialog id="effects"  avatars="Avatarlar" mainchat="Ana sohbet" roomlist="Oda listesi" background="Arka plan" custom="DiÄŸer" showBackgroundImages="Arka planÄ± gÃ¶rÃ¼ntÃ¼le" splashWindow="Yeni mesaj geldiÄŸinde pencereyi gÃ¶ster" uiAlpha="ÅžeffaflÄ±k"/><dialog id="sound"  sampleBtn="Ã–rnek" testBtn="Test" muteall="Sessiz" submitmessage="Mesaj yolla" reveivemessage="Mesaj al" enterroom="Odaya gir" leaveroom="Odadan Ã§Ä±k" pan="Denge" volume="Ses" initiallogin="Ä°lk giriÅŸ" logout="Ã‡Ä±kÄ±ÅŸ" privatemessagereceived="Ã–zel mesaj al" invitationreceived="Davet al" combolistopenclose="SeÃ§enek listesini aÃ§/kapa" userbannedbooted="KullanÄ±cÄ± yasaklandÄ± veya Ã§Ä±kartÄ±ldÄ±" usermenumouseover="Fare kullanÄ±cÄ± menÃ¼sÃ¼ Ã¼zerinde" roomopenclose="Oda bÃ¶lÃ¼mÃ¼nÃ¼ aÃ§/kapa" popupwindowopen="Yeni pencere aÃ§Ä±lÄ±ÅŸÄ±" popupwindowclosemin="Yeni pencere kapanÄ±ÅŸÄ±" pressbutton="Buton basÄ±lmasÄ±" otheruserenters="DiÄŸer kullanÄ±cÄ± odaya girdi"/><dialog id="skin"  inputBoxBackground="GiriÅŸ kutusu arkaplan" privateLogBackground="Ã–zel log arkaplan" publicLogBackground="Genel log arkaplan" enterRoomNotify="Odaya giriÅŸ uyarÄ±sÄ±nÄ± girin" roomText="Oda metni" room="Oda arkaplan" userListBackground="KullanÄ±cÄ± listesi arkaplan" dialogTitle="Diyalog baÅŸlÄ±ÄŸÄ±" dialog="Diyalog arkaplan" buttonText="Buton yazÄ±sÄ±" button="Buton arkaplan" bodyText="GÃ¶vde metni" background="Ana arkaplan" borderColor="Buton rengi" selectskin="Renk tasarÄ±mÄ±nÄ± seÃ§in..." buttonBorder="Buton sÄ±nÄ±r rengi" selectBigSkin="GÃ¶rÃ¼ntÃ¼ tÃ¼rÃ¼ ÅŸeÃ§in..." titleText="BaÅŸlÄ±k metni"/><dialog id="privateBox"  sendBtn="GÃ¶nder" toUser="USER_LABEL ile konuÅŸuluyor:"/><dialog id="login"  loginBtn="GiriÅŸ" language="Dil:" moderator="(moderator ise)" password="Åžifre:" username="KullanÄ±cÄ± ismi:"/><dialog id="invitenotify"  declineBtn="Reddet" acceptBtn="Kabul et" userinvited="KullanÄ±cÄ± ''USER_LABEL'', sizi ''ROOM_LABEL'' odasÄ±na davet etti"/><dialog id="invite"  sendBtn="GÃ¶nder" includemessage="Bu mesajÄ± davetinize ekleyin:" inviteto="KullanÄ±cÄ±yÄ± davet ettiÄŸiniz oda:"/><dialog id="ignore"  ignoreBtn="Red" ignoretext="Red metnini giriniz"/><dialog id="createroom"  createBtn="Yarat" private="Ã–zel" public="Genel" entername="Oda ismini girin" enterpass="Oda iÃ§in bir ÅŸifre belirleyiniz. Åžifresiz giriÅŸ iÃ§in boÅŸ bÄ±rakÄ±nÄ±z"/><dialog id="ban"  banBtn="Yasakla" byIP="IP ile" fromChat="sohbetten" fromRoom="odadan" banText="Yasaklama metnini giriniz"/><dialog id="common"  cancelBtn="Ä°ptal" okBtn="Tamam" win_choose="GÃ¶nderilecek dosyayÄ± seÃ§iniz:" win_upl_btn="  GÃ¶nder  " upl_error="Dosya gÃ¶nderme hatasÄ±" pls_select_file="LÃ¼tfen gÃ¶nderilecek dosyayÄ± seÃ§iniz" ext_not_allowed="FILE_EXT uzantÄ±lÄ± dosyalara izin verilmemektedir. LÃ¼tfen bu uzantÄ±lardan birine sahip bir dosya seÃ§iniz: ALLOWED_EXT" size_too_big="PaylaÅŸmak istediÄŸiniz dosyanÄ±n boyutu izin verilen azami dosya boyutundan bÃ¼yÃ¼ktÃ¼r. LÃ¼tfen tekrar deneyiniz."/><dialog id="sharefile"  chat_users="[ Sohbet ile PaylaÅŸ ]" all_users="[ Oda ile PaylaÅŸ ]" file_info_size="&lt;br&gt;Bu dosya iÃ§in izin verilen azami boyut MAX_SIZE." file_info_ext=" Ä°zin Verilen Dosya TÃ¼rleri: ALLOWED_EXT" win_share_only="ile PaylaÅŸ" usr_message="&lt;b&gt;USER_LABEL sizinle bir dosya paylaÅŸmak istiyor&lt;/b&gt;&lt;br&gt;&lt;br&gt;Dosya adÄ±: F_NAME&lt;br&gt;Dosya boyutu: F_SIZE"/><dialog id="loadavatarbg"  win_title="Ã–zel Arka plan" file_info="DosyanÄ±z progresif olmayan bir JPG resmi veya bir Flash SWF dosyasÄ± olmalÄ±dÄ±r." use_label="Bu dosyayÄ± ÅŸunun iÃ§in kullan:" rb_mainchat_avatar="Sadece ana sohbet avatarÄ±" rb_roomlist_avatar="Sadece oda listesi avatarÄ±" rb_mc_rl_avatar="Hem ana sohbet hem de oda listesi avatarÄ±" rb_this_theme="Sadece bu tema iÃ§in arka plan" rb_all_themes="TÃ¼m temalar iÃ§in arka plan"/><status  away="MÃ¼sait DeÄŸilim" busy="YazÄ±yorum" here="BuradayÄ±m" brb="SÃ¶z Ä°stiyorum"/><usermenu  profile="Profil" unban="Yasak iptali" ban="YasaklÄ±" unignore="Red iptali" fileshare="Dosya PaylaÅŸ" ignore="Red" invite="Davet" privatemessage="Ã–zel mesaj"/></language>', 1),
(64, '2008-01-13 14:47:48', 'ac5ec99a1b75b3606e8ca376ce0aa2f9', NULL, NULL, 'lout', NULL, NULL, 'login', 1),
(63, '2008-01-13 14:47:45', NULL, NULL, NULL, 'spht', 1, NULL, '', 1),
(62, '2008-01-13 14:47:45', NULL, NULL, NULL, 'uclc', 1, NULL, '16777215', 1),
(61, '2008-01-13 14:47:45', NULL, NULL, NULL, 'spht', 1, NULL, '', 1),
(59, '2008-01-13 14:47:44', NULL, NULL, NULL, 'ustc', 1, NULL, '1', 1),
(60, '2008-01-13 14:47:45', NULL, NULL, NULL, 'ravt', 1, NULL, ':admin:', 1),
(58, '2008-01-13 14:47:44', NULL, NULL, NULL, 'uclc', 1, NULL, '16777215', 1),
(57, '2008-01-13 14:47:44', NULL, NULL, NULL, 'adu', 1, 1, 'OrÃ§un Madran', 1),
(56, '2008-01-13 14:47:43', 'ac5ec99a1b75b3606e8ca376ce0aa2f9', NULL, NULL, 'adr', NULL, 4, 'Konferans Salonu', 1),
(55, '2008-01-13 14:47:43', 'ac5ec99a1b75b3606e8ca376ce0aa2f9', NULL, NULL, 'adr', NULL, 3, 'Toplanti Salonu', 1),
(52, '2008-01-13 14:47:43', 'ac5ec99a1b75b3606e8ca376ce0aa2f9', NULL, NULL, 'lin', 1, 2, 'tr', 1),
(53, '2008-01-13 14:47:43', 'ac5ec99a1b75b3606e8ca376ce0aa2f9', NULL, NULL, 'adr', NULL, 1, 'Kafeterya', 1),
(54, '2008-01-13 14:47:43', 'ac5ec99a1b75b3606e8ca376ce0aa2f9', NULL, NULL, 'adr', NULL, 2, 'Teknik Destek', 1),
(51, '2008-01-13 14:47:43', 'ac5ec99a1b75b3606e8ca376ce0aa2f9', NULL, NULL, 'lng', NULL, NULL, '<language loaded="1" id="tr" name="TÃ¼rkÃ§e"><messages  ignored="KullanÄ±cÄ± ''USER_LABEL'' mesajlarÄ±nÄ±zÄ± red ediyor" banned="YasaklandÄ±nÄ±z" login="Sohbete girmek iÃ§in &lt;a href=&quot;../index.php&quot;&gt;&lt;b&gt;tÄ±klayÄ±nÄ±z&lt;/b&gt;&lt;/a&gt;" required="gerekli" wrongPass="YanlÄ±ÅŸ kullanÄ±cÄ± ismi veya ÅŸifresi. LÃ¼tfen tekrar deneyin" anotherlogin="Bu kullanÄ±cÄ± ismi ile baÅŸka kullanÄ±cÄ± girmiÅŸ. LÃ¼tfen tekrar deneyin." expiredlogin="BaÄŸlantÄ±nÄ±z zaman aÅŸÄ±mÄ±na uÄŸradÄ±. LÃ¼tfen yeniden giriÅŸ yapÄ±n." enterroom="[ROOM_LABEL]: USER_LABEL odaya saat TIMESTAMP da girdi" leaveroom="[ROOM_LABEL]: USER_LABEL, odadan saat TIMESTAMP da Ã§Ä±ktÄ±" selfenterroom="HoÅŸgeldiniz! [ROOM_LABEL] odasÄ±na TIMESTAMP da giriÅŸ yaptÄ±nÄ±z" bellrang="USER_LABEL kullanÄ±cÄ±sÄ± zil Ã§aldÄ±" chatfull="Sohbet dolu. LÃ¼tfen daha sonra tekrar deneyiniz." iplimit="Zaten sohbettesiniz." roomlock="Bu oda ÅŸifre korumalÄ±dÄ±r.&lt;br&gt;LÃ¼tfen oda ÅŸifresini giriniz:" locked="HatalÄ± ÅŸifre. LÃ¼tfen yeniden deneyiniz." botfeat="Bot fonksiyonu devrede deÄŸil." securityrisk="YÃ¼klemek istediÄŸiniz dosya riskli bir iÃ§eriÄŸe sahip. LÃ¼tfen baÅŸka bir dosya seÃ§iniz."/><desktop  invalidsettings="GeÃ§ersiz ayarlar" selectsmile="GÃ¼lenyÃ¼zler" sendBtn="Yolla" saveBtn="Kaydet" soundBtn="Ses" skinBtn="GÃ¶rÃ¼nÃ¼m" addRoomBtn="Ekle" myStatus="Durumum" room="Oda" welcome="HoÅŸgeldin USER_LABEL" ringTheBell="Cevap Yok? Zili Ã§al:" logOffBtn="X" helpBtn="?" adminSign="(M)"/><dialog id="misc"  roomnotfound="''ROOM_LABEL'' odasÄ± bulunamadÄ±" usernotfound="KullanÄ±cÄ± ''USER_LABEL'' bulunamadÄ±" unbanned="KullanÄ±cÄ± ''USER_LABEL'' tarafÄ±ndan yasaÄŸÄ±nÄ±z kaldÄ±rÄ±ldÄ±" banned="KullanÄ±cÄ± ''USER_LABEL'' tarafÄ±ndan yasaklandÄ±nÄ±z" unignored="KullanÄ±cÄ± ''USER_LABEL'' tarafÄ±ndan red listesinden Ã§Ä±kartÄ±ldÄ±nÄ±z" ignored="KullanÄ±cÄ± ''USER_LABEL'' tarafÄ±ndan red edildiniz" invitationdeclined="KullanÄ±cÄ± ''USER_LABEL'',''ROOM_LABEL'' odasÄ±na davetinizi kabul etmedi" invitationaccepted="KullanÄ±cÄ± ''USER_LABEL'',''ROOM_LABEL'' odasÄ±na davetinizi kabul etti" roomnotcreated="Oda yaratÄ±lmadÄ±" roomisfull="[ROOM_LABEL] odasÄ± dolu. LÃ¼tfen baÅŸka bir oda seÃ§iniz." alert="&lt;b&gt;UYARI!&lt;/b&gt;&lt;br&gt;&lt;br&gt;" chatalert="&lt;b&gt;UYARI!&lt;/b&gt;&lt;br&gt;&lt;br&gt;" gag="&lt;b&gt;DURATION dakika boyunca susturuldunuz!&lt;/b&gt;&lt;br&gt;&lt;br&gt;Bu odadaki mesajlarÄ± gÃ¶rebilirsiniz, ancak susturulma sÃ¼reniz sona erene kadar yeni mesaj gÃ¶nderemezsiniz." ungagged="''USER_LABEL'' tarafÄ±ndan susturulma cezanÄ±z iptal edildi." gagconfirm="USER_LABEL MINUTES dakika iÃ§in susturuldu." alertconfirm="USER_LABEL uyarÄ±yÄ± okudu." file_declined="DosyanÄ±z USER_LABEL tarafÄ±ndan reddedildi." file_accepted="DosyanÄ±z USER_LABEL tarafÄ±ndan kabul edildi."/><dialog id="unignore"  unignoreBtn="Red iptal" unignoretext="Red iptal metnini giriniz"/><dialog id="unban"  unbanBtn="Yasak iptal" unbantext="Yasak iptal metnini giriniz"/><dialog id="tablabels"  themes="Temalar" sounds="Sesler" text="Metin" effects="Efektler" admin="YÃ¶netici" about="HakkÄ±nda"/><dialog id="text"  itemChange="DeÄŸiÅŸtirilecek madde" fontSize="YazÄ± karakter bÃ¼yÃ¼klÃ¼ÄŸÃ¼" fontFamily="YazÄ± tipi" language="Dil" mainChat="Ana Sohbet" interfaceElements="Arabirim ElemanlarÄ±" title="BaÅŸlÄ±k" mytextcolor="AlÄ±nan mesajlarÄ±n hepsi iÃ§in benim metin rengimi kullan."/><dialog id="effects"  avatars="Avatarlar" mainchat="Ana sohbet" roomlist="Oda listesi" background="Arka plan" custom="DiÄŸer" showBackgroundImages="Arka planÄ± gÃ¶rÃ¼ntÃ¼le" splashWindow="Yeni mesaj geldiÄŸinde pencereyi gÃ¶ster" uiAlpha="ÅžeffaflÄ±k"/><dialog id="sound"  sampleBtn="Ã–rnek" testBtn="Test" muteall="Sessiz" submitmessage="Mesaj yolla" reveivemessage="Mesaj al" enterroom="Odaya gir" leaveroom="Odadan Ã§Ä±k" pan="Denge" volume="Ses" initiallogin="Ä°lk giriÅŸ" logout="Ã‡Ä±kÄ±ÅŸ" privatemessagereceived="Ã–zel mesaj al" invitationreceived="Davet al" combolistopenclose="SeÃ§enek listesini aÃ§/kapa" userbannedbooted="KullanÄ±cÄ± yasaklandÄ± veya Ã§Ä±kartÄ±ldÄ±" usermenumouseover="Fare kullanÄ±cÄ± menÃ¼sÃ¼ Ã¼zerinde" roomopenclose="Oda bÃ¶lÃ¼mÃ¼nÃ¼ aÃ§/kapa" popupwindowopen="Yeni pencere aÃ§Ä±lÄ±ÅŸÄ±" popupwindowclosemin="Yeni pencere kapanÄ±ÅŸÄ±" pressbutton="Buton basÄ±lmasÄ±" otheruserenters="DiÄŸer kullanÄ±cÄ± odaya girdi"/><dialog id="skin"  inputBoxBackground="GiriÅŸ kutusu arkaplan" privateLogBackground="Ã–zel log arkaplan" publicLogBackground="Genel log arkaplan" enterRoomNotify="Odaya giriÅŸ uyarÄ±sÄ±nÄ± girin" roomText="Oda metni" room="Oda arkaplan" userListBackground="KullanÄ±cÄ± listesi arkaplan" dialogTitle="Diyalog baÅŸlÄ±ÄŸÄ±" dialog="Diyalog arkaplan" buttonText="Buton yazÄ±sÄ±" button="Buton arkaplan" bodyText="GÃ¶vde metni" background="Ana arkaplan" borderColor="Buton rengi" selectskin="Renk tasarÄ±mÄ±nÄ± seÃ§in..." buttonBorder="Buton sÄ±nÄ±r rengi" selectBigSkin="GÃ¶rÃ¼ntÃ¼ tÃ¼rÃ¼ ÅŸeÃ§in..." titleText="BaÅŸlÄ±k metni"/><dialog id="privateBox"  sendBtn="GÃ¶nder" toUser="USER_LABEL ile konuÅŸuluyor:"/><dialog id="login"  loginBtn="GiriÅŸ" language="Dil:" moderator="(moderator ise)" password="Åžifre:" username="KullanÄ±cÄ± ismi:"/><dialog id="invitenotify"  declineBtn="Reddet" acceptBtn="Kabul et" userinvited="KullanÄ±cÄ± ''USER_LABEL'', sizi ''ROOM_LABEL'' odasÄ±na davet etti"/><dialog id="invite"  sendBtn="GÃ¶nder" includemessage="Bu mesajÄ± davetinize ekleyin:" inviteto="KullanÄ±cÄ±yÄ± davet ettiÄŸiniz oda:"/><dialog id="ignore"  ignoreBtn="Red" ignoretext="Red metnini giriniz"/><dialog id="createroom"  createBtn="Yarat" private="Ã–zel" public="Genel" entername="Oda ismini girin" enterpass="Oda iÃ§in bir ÅŸifre belirleyiniz. Åžifresiz giriÅŸ iÃ§in boÅŸ bÄ±rakÄ±nÄ±z"/><dialog id="ban"  banBtn="Yasakla" byIP="IP ile" fromChat="sohbetten" fromRoom="odadan" banText="Yasaklama metnini giriniz"/><dialog id="common"  cancelBtn="Ä°ptal" okBtn="Tamam" win_choose="GÃ¶nderilecek dosyayÄ± seÃ§iniz:" win_upl_btn="  GÃ¶nder  " upl_error="Dosya gÃ¶nderme hatasÄ±" pls_select_file="LÃ¼tfen gÃ¶nderilecek dosyayÄ± seÃ§iniz" ext_not_allowed="FILE_EXT uzantÄ±lÄ± dosyalara izin verilmemektedir. LÃ¼tfen bu uzantÄ±lardan birine sahip bir dosya seÃ§iniz: ALLOWED_EXT" size_too_big="PaylaÅŸmak istediÄŸiniz dosyanÄ±n boyutu izin verilen azami dosya boyutundan bÃ¼yÃ¼ktÃ¼r. LÃ¼tfen tekrar deneyiniz."/><dialog id="sharefile"  chat_users="[ Sohbet ile PaylaÅŸ ]" all_users="[ Oda ile PaylaÅŸ ]" file_info_size="&lt;br&gt;Bu dosya iÃ§in izin verilen azami boyut MAX_SIZE." file_info_ext=" Ä°zin Verilen Dosya TÃ¼rleri: ALLOWED_EXT" win_share_only="ile PaylaÅŸ" usr_message="&lt;b&gt;USER_LABEL sizinle bir dosya paylaÅŸmak istiyor&lt;/b&gt;&lt;br&gt;&lt;br&gt;Dosya adÄ±: F_NAME&lt;br&gt;Dosya boyutu: F_SIZE"/><dialog id="loadavatarbg"  win_title="Ã–zel Arka plan" file_info="DosyanÄ±z progresif olmayan bir JPG resmi veya bir Flash SWF dosyasÄ± olmalÄ±dÄ±r." use_label="Bu dosyayÄ± ÅŸunun iÃ§in kullan:" rb_mainchat_avatar="Sadece ana sohbet avatarÄ±" rb_roomlist_avatar="Sadece oda listesi avatarÄ±" rb_mc_rl_avatar="Hem ana sohbet hem de oda listesi avatarÄ±" rb_this_theme="Sadece bu tema iÃ§in arka plan" rb_all_themes="TÃ¼m temalar iÃ§in arka plan"/><status  away="MÃ¼sait DeÄŸilim" busy="YazÄ±yorum" here="BuradayÄ±m" brb="SÃ¶z Ä°stiyorum"/><usermenu  profile="Profil" unban="Yasak iptali" ban="YasaklÄ±" unignore="Red iptali" fileshare="Dosya PaylaÅŸ" ignore="Red" invite="Davet" privatemessage="Ã–zel mesaj"/></language>', 1),
(50, '2008-01-13 14:47:43', 'ac5ec99a1b75b3606e8ca376ce0aa2f9', NULL, NULL, 'lout', NULL, NULL, 'login', 1),
(49, '2008-01-13 14:47:37', NULL, NULL, NULL, 'rmu', 1, NULL, NULL, 1),
(48, '2008-01-13 14:47:37', '3342b2681d6c85a0e91975a22df8fe34', NULL, NULL, 'lout', NULL, NULL, 'login', 1),
(47, '2008-01-13 14:47:28', NULL, NULL, NULL, 'spht', 1, NULL, '', 1),
(46, '2008-01-13 14:47:28', NULL, NULL, NULL, 'uclc', 1, NULL, '16777215', 1),
(45, '2008-01-13 14:47:28', NULL, NULL, NULL, 'spht', 1, NULL, '', 1),
(44, '2008-01-13 14:47:28', NULL, NULL, NULL, 'ravt', 1, NULL, ':admin:', 1),
(34, '2008-01-13 14:47:25', '3342b2681d6c85a0e91975a22df8fe34', NULL, NULL, 'lout', NULL, NULL, 'login', 1),
(35, '2008-01-13 14:47:26', '3342b2681d6c85a0e91975a22df8fe34', NULL, NULL, 'lng', NULL, NULL, '<language loaded="1" id="tr" name="TÃ¼rkÃ§e"><messages  ignored="KullanÄ±cÄ± ''USER_LABEL'' mesajlarÄ±nÄ±zÄ± red ediyor" banned="YasaklandÄ±nÄ±z" login="Sohbete girmek iÃ§in &lt;a href=&quot;../index.php&quot;&gt;&lt;b&gt;tÄ±klayÄ±nÄ±z&lt;/b&gt;&lt;/a&gt;" required="gerekli" wrongPass="YanlÄ±ÅŸ kullanÄ±cÄ± ismi veya ÅŸifresi. LÃ¼tfen tekrar deneyin" anotherlogin="Bu kullanÄ±cÄ± ismi ile baÅŸka kullanÄ±cÄ± girmiÅŸ. LÃ¼tfen tekrar deneyin." expiredlogin="BaÄŸlantÄ±nÄ±z zaman aÅŸÄ±mÄ±na uÄŸradÄ±. LÃ¼tfen yeniden giriÅŸ yapÄ±n." enterroom="[ROOM_LABEL]: USER_LABEL odaya saat TIMESTAMP da girdi" leaveroom="[ROOM_LABEL]: USER_LABEL, odadan saat TIMESTAMP da Ã§Ä±ktÄ±" selfenterroom="HoÅŸgeldiniz! [ROOM_LABEL] odasÄ±na TIMESTAMP da giriÅŸ yaptÄ±nÄ±z" bellrang="USER_LABEL kullanÄ±cÄ±sÄ± zil Ã§aldÄ±" chatfull="Sohbet dolu. LÃ¼tfen daha sonra tekrar deneyiniz." iplimit="Zaten sohbettesiniz." roomlock="Bu oda ÅŸifre korumalÄ±dÄ±r.&lt;br&gt;LÃ¼tfen oda ÅŸifresini giriniz:" locked="HatalÄ± ÅŸifre. LÃ¼tfen yeniden deneyiniz." botfeat="Bot fonksiyonu devrede deÄŸil." securityrisk="YÃ¼klemek istediÄŸiniz dosya riskli bir iÃ§eriÄŸe sahip. LÃ¼tfen baÅŸka bir dosya seÃ§iniz."/><desktop  invalidsettings="GeÃ§ersiz ayarlar" selectsmile="GÃ¼lenyÃ¼zler" sendBtn="Yolla" saveBtn="Kaydet" soundBtn="Ses" skinBtn="GÃ¶rÃ¼nÃ¼m" addRoomBtn="Ekle" myStatus="Durumum" room="Oda" welcome="HoÅŸgeldin USER_LABEL" ringTheBell="Cevap Yok? Zili Ã§al:" logOffBtn="X" helpBtn="?" adminSign="(M)"/><dialog id="misc"  roomnotfound="''ROOM_LABEL'' odasÄ± bulunamadÄ±" usernotfound="KullanÄ±cÄ± ''USER_LABEL'' bulunamadÄ±" unbanned="KullanÄ±cÄ± ''USER_LABEL'' tarafÄ±ndan yasaÄŸÄ±nÄ±z kaldÄ±rÄ±ldÄ±" banned="KullanÄ±cÄ± ''USER_LABEL'' tarafÄ±ndan yasaklandÄ±nÄ±z" unignored="KullanÄ±cÄ± ''USER_LABEL'' tarafÄ±ndan red listesinden Ã§Ä±kartÄ±ldÄ±nÄ±z" ignored="KullanÄ±cÄ± ''USER_LABEL'' tarafÄ±ndan red edildiniz" invitationdeclined="KullanÄ±cÄ± ''USER_LABEL'',''ROOM_LABEL'' odasÄ±na davetinizi kabul etmedi" invitationaccepted="KullanÄ±cÄ± ''USER_LABEL'',''ROOM_LABEL'' odasÄ±na davetinizi kabul etti" roomnotcreated="Oda yaratÄ±lmadÄ±" roomisfull="[ROOM_LABEL] odasÄ± dolu. LÃ¼tfen baÅŸka bir oda seÃ§iniz." alert="&lt;b&gt;UYARI!&lt;/b&gt;&lt;br&gt;&lt;br&gt;" chatalert="&lt;b&gt;UYARI!&lt;/b&gt;&lt;br&gt;&lt;br&gt;" gag="&lt;b&gt;DURATION dakika boyunca susturuldunuz!&lt;/b&gt;&lt;br&gt;&lt;br&gt;Bu odadaki mesajlarÄ± gÃ¶rebilirsiniz, ancak susturulma sÃ¼reniz sona erene kadar yeni mesaj gÃ¶nderemezsiniz." ungagged="''USER_LABEL'' tarafÄ±ndan susturulma cezanÄ±z iptal edildi." gagconfirm="USER_LABEL MINUTES dakika iÃ§in susturuldu." alertconfirm="USER_LABEL uyarÄ±yÄ± okudu." file_declined="DosyanÄ±z USER_LABEL tarafÄ±ndan reddedildi." file_accepted="DosyanÄ±z USER_LABEL tarafÄ±ndan kabul edildi."/><dialog id="unignore"  unignoreBtn="Red iptal" unignoretext="Red iptal metnini giriniz"/><dialog id="unban"  unbanBtn="Yasak iptal" unbantext="Yasak iptal metnini giriniz"/><dialog id="tablabels"  themes="Temalar" sounds="Sesler" text="Metin" effects="Efektler" admin="YÃ¶netici" about="HakkÄ±nda"/><dialog id="text"  itemChange="DeÄŸiÅŸtirilecek madde" fontSize="YazÄ± karakter bÃ¼yÃ¼klÃ¼ÄŸÃ¼" fontFamily="YazÄ± tipi" language="Dil" mainChat="Ana Sohbet" interfaceElements="Arabirim ElemanlarÄ±" title="BaÅŸlÄ±k" mytextcolor="AlÄ±nan mesajlarÄ±n hepsi iÃ§in benim metin rengimi kullan."/><dialog id="effects"  avatars="Avatarlar" mainchat="Ana sohbet" roomlist="Oda listesi" background="Arka plan" custom="DiÄŸer" showBackgroundImages="Arka planÄ± gÃ¶rÃ¼ntÃ¼le" splashWindow="Yeni mesaj geldiÄŸinde pencereyi gÃ¶ster" uiAlpha="ÅžeffaflÄ±k"/><dialog id="sound"  sampleBtn="Ã–rnek" testBtn="Test" muteall="Sessiz" submitmessage="Mesaj yolla" reveivemessage="Mesaj al" enterroom="Odaya gir" leaveroom="Odadan Ã§Ä±k" pan="Denge" volume="Ses" initiallogin="Ä°lk giriÅŸ" logout="Ã‡Ä±kÄ±ÅŸ" privatemessagereceived="Ã–zel mesaj al" invitationreceived="Davet al" combolistopenclose="SeÃ§enek listesini aÃ§/kapa" userbannedbooted="KullanÄ±cÄ± yasaklandÄ± veya Ã§Ä±kartÄ±ldÄ±" usermenumouseover="Fare kullanÄ±cÄ± menÃ¼sÃ¼ Ã¼zerinde" roomopenclose="Oda bÃ¶lÃ¼mÃ¼nÃ¼ aÃ§/kapa" popupwindowopen="Yeni pencere aÃ§Ä±lÄ±ÅŸÄ±" popupwindowclosemin="Yeni pencere kapanÄ±ÅŸÄ±" pressbutton="Buton basÄ±lmasÄ±" otheruserenters="DiÄŸer kullanÄ±cÄ± odaya girdi"/><dialog id="skin"  inputBoxBackground="GiriÅŸ kutusu arkaplan" privateLogBackground="Ã–zel log arkaplan" publicLogBackground="Genel log arkaplan" enterRoomNotify="Odaya giriÅŸ uyarÄ±sÄ±nÄ± girin" roomText="Oda metni" room="Oda arkaplan" userListBackground="KullanÄ±cÄ± listesi arkaplan" dialogTitle="Diyalog baÅŸlÄ±ÄŸÄ±" dialog="Diyalog arkaplan" buttonText="Buton yazÄ±sÄ±" button="Buton arkaplan" bodyText="GÃ¶vde metni" background="Ana arkaplan" borderColor="Buton rengi" selectskin="Renk tasarÄ±mÄ±nÄ± seÃ§in..." buttonBorder="Buton sÄ±nÄ±r rengi" selectBigSkin="GÃ¶rÃ¼ntÃ¼ tÃ¼rÃ¼ ÅŸeÃ§in..." titleText="BaÅŸlÄ±k metni"/><dialog id="privateBox"  sendBtn="GÃ¶nder" toUser="USER_LABEL ile konuÅŸuluyor:"/><dialog id="login"  loginBtn="GiriÅŸ" language="Dil:" moderator="(moderator ise)" password="Åžifre:" username="KullanÄ±cÄ± ismi:"/><dialog id="invitenotify"  declineBtn="Reddet" acceptBtn="Kabul et" userinvited="KullanÄ±cÄ± ''USER_LABEL'', sizi ''ROOM_LABEL'' odasÄ±na davet etti"/><dialog id="invite"  sendBtn="GÃ¶nder" includemessage="Bu mesajÄ± davetinize ekleyin:" inviteto="KullanÄ±cÄ±yÄ± davet ettiÄŸiniz oda:"/><dialog id="ignore"  ignoreBtn="Red" ignoretext="Red metnini giriniz"/><dialog id="createroom"  createBtn="Yarat" private="Ã–zel" public="Genel" entername="Oda ismini girin" enterpass="Oda iÃ§in bir ÅŸifre belirleyiniz. Åžifresiz giriÅŸ iÃ§in boÅŸ bÄ±rakÄ±nÄ±z"/><dialog id="ban"  banBtn="Yasakla" byIP="IP ile" fromChat="sohbetten" fromRoom="odadan" banText="Yasaklama metnini giriniz"/><dialog id="common"  cancelBtn="Ä°ptal" okBtn="Tamam" win_choose="GÃ¶nderilecek dosyayÄ± seÃ§iniz:" win_upl_btn="  GÃ¶nder  " upl_error="Dosya gÃ¶nderme hatasÄ±" pls_select_file="LÃ¼tfen gÃ¶nderilecek dosyayÄ± seÃ§iniz" ext_not_allowed="FILE_EXT uzantÄ±lÄ± dosyalara izin verilmemektedir. LÃ¼tfen bu uzantÄ±lardan birine sahip bir dosya seÃ§iniz: ALLOWED_EXT" size_too_big="PaylaÅŸmak istediÄŸiniz dosyanÄ±n boyutu izin verilen azami dosya boyutundan bÃ¼yÃ¼ktÃ¼r. LÃ¼tfen tekrar deneyiniz."/><dialog id="sharefile"  chat_users="[ Sohbet ile PaylaÅŸ ]" all_users="[ Oda ile PaylaÅŸ ]" file_info_size="&lt;br&gt;Bu dosya iÃ§in izin verilen azami boyut MAX_SIZE." file_info_ext=" Ä°zin Verilen Dosya TÃ¼rleri: ALLOWED_EXT" win_share_only="ile PaylaÅŸ" usr_message="&lt;b&gt;USER_LABEL sizinle bir dosya paylaÅŸmak istiyor&lt;/b&gt;&lt;br&gt;&lt;br&gt;Dosya adÄ±: F_NAME&lt;br&gt;Dosya boyutu: F_SIZE"/><dialog id="loadavatarbg"  win_title="Ã–zel Arka plan" file_info="DosyanÄ±z progresif olmayan bir JPG resmi veya bir Flash SWF dosyasÄ± olmalÄ±dÄ±r." use_label="Bu dosyayÄ± ÅŸunun iÃ§in kullan:" rb_mainchat_avatar="Sadece ana sohbet avatarÄ±" rb_roomlist_avatar="Sadece oda listesi avatarÄ±" rb_mc_rl_avatar="Hem ana sohbet hem de oda listesi avatarÄ±" rb_this_theme="Sadece bu tema iÃ§in arka plan" rb_all_themes="TÃ¼m temalar iÃ§in arka plan"/><status  away="MÃ¼sait DeÄŸilim" busy="YazÄ±yorum" here="BuradayÄ±m" brb="SÃ¶z Ä°stiyorum"/><usermenu  profile="Profil" unban="Yasak iptali" ban="YasaklÄ±" unignore="Red iptali" fileshare="Dosya PaylaÅŸ" ignore="Red" invite="Davet" privatemessage="Ã–zel mesaj"/></language>', 1),
(36, '2008-01-13 14:47:26', '3342b2681d6c85a0e91975a22df8fe34', NULL, NULL, 'lin', 1, 2, 'tr', 1),
(37, '2008-01-13 14:47:26', '3342b2681d6c85a0e91975a22df8fe34', NULL, NULL, 'adr', NULL, 1, 'Kafeterya', 1),
(38, '2008-01-13 14:47:26', '3342b2681d6c85a0e91975a22df8fe34', NULL, NULL, 'adr', NULL, 2, 'Teknik Destek', 1),
(39, '2008-01-13 14:47:26', '3342b2681d6c85a0e91975a22df8fe34', NULL, NULL, 'adr', NULL, 3, 'Toplanti Salonu', 1),
(40, '2008-01-13 14:47:26', '3342b2681d6c85a0e91975a22df8fe34', NULL, NULL, 'adr', NULL, 4, 'Konferans Salonu', 1),
(41, '2008-01-13 14:47:26', NULL, NULL, NULL, 'adu', 1, 1, 'OrÃ§un Madran', 1),
(42, '2008-01-13 14:47:26', NULL, NULL, NULL, 'uclc', 1, NULL, '16777215', 1),
(43, '2008-01-13 14:47:26', NULL, NULL, NULL, 'ustc', 1, NULL, '1', 1),
(68, '2008-01-13 15:29:03', '5149936ceb37befea2dc8028d7ae6c15', NULL, NULL, 'lin', 2, 1, 'tr', 1),
(69, '2008-01-13 15:29:03', '5149936ceb37befea2dc8028d7ae6c15', NULL, NULL, 'adr', NULL, 1, 'Kafeterya', 1),
(70, '2008-01-13 15:29:03', '5149936ceb37befea2dc8028d7ae6c15', NULL, NULL, 'adr', NULL, 2, 'Teknik Destek', 1),
(71, '2008-01-13 15:29:03', '5149936ceb37befea2dc8028d7ae6c15', NULL, NULL, 'adr', NULL, 3, 'Toplanti Salonu', 1),
(72, '2008-01-13 15:29:03', '5149936ceb37befea2dc8028d7ae6c15', NULL, NULL, 'adr', NULL, 4, 'Konferans Salonu', 1),
(73, '2008-01-13 15:29:03', NULL, NULL, NULL, 'adu', 2, 1, 'Ã–rnek Ã–ÄŸrenci', 1),
(74, '2008-01-13 15:29:03', NULL, NULL, NULL, 'uclc', 2, NULL, '16777215', 1),
(75, '2008-01-13 15:29:03', NULL, NULL, NULL, 'ustc', 2, NULL, '1', 1),
(76, '2008-01-13 15:29:04', NULL, NULL, NULL, 'spht', 2, NULL, '', 1),
(77, '2008-01-13 15:29:04', NULL, NULL, NULL, 'uclc', 2, NULL, '16777215', 1),
(78, '2008-01-13 15:29:04', NULL, NULL, NULL, 'spht', 2, NULL, '', 1),
(79, '2008-01-13 15:30:47', NULL, NULL, 1, 'msg', 2, 1, 'Merhaba :)', 1),
(80, '2008-01-13 15:30:54', NULL, NULL, NULL, 'ustc', 2, NULL, '4', 1),
(81, '2008-01-13 15:31:06', '5149936ceb37befea2dc8028d7ae6c15', NULL, NULL, 'lout', NULL, NULL, 'login', 1),
(82, '2008-01-13 15:31:06', NULL, NULL, NULL, 'rmu', 2, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_sohbet_rooms`
--

CREATE TABLE IF NOT EXISTS `lms_sohbet_rooms` (
  `id` int(11) NOT NULL auto_increment,
  `updated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `name` varchar(64) collate utf8_turkish_ci NOT NULL default '',
  `password` varchar(32) collate utf8_turkish_ci NOT NULL default '',
  `ispublic` char(1) collate utf8_turkish_ci default NULL,
  `ispermanent` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `ispublic` (`ispublic`),
  KEY `ispermanent` (`ispermanent`),
  KEY `updated` (`updated`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=8 ;

--
-- Tablo döküm verisi `lms_sohbet_rooms`
--

INSERT INTO `lms_sohbet_rooms` (`id`, `updated`, `created`, `name`, `password`, `ispublic`, `ispermanent`) VALUES
(1, '2008-01-13 15:31:06', '2007-08-08 02:45:19', 'Kafeterya', '', 'y', 1),
(2, '2007-08-08 02:45:19', '2007-08-08 02:45:19', 'Teknik Destek', '', 'y', 2),
(3, '2007-08-08 02:45:19', '2007-08-08 02:45:19', 'Toplanti Salonu', '', 'y', 3),
(4, '2007-08-08 02:45:19', '2007-08-08 02:45:19', 'Konferans Salonu', '', 'y', 4);

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_sohbet_users`
--

CREATE TABLE IF NOT EXISTS `lms_sohbet_users` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(200) collate utf8_turkish_ci NOT NULL,
  `password` varchar(32) collate utf8_turkish_ci NOT NULL,
  `roles` int(11) NOT NULL default '0',
  `profile` text collate utf8_turkish_ci,
  PRIMARY KEY  (`id`),
  KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `lms_sohbet_users`
--

INSERT INTO `lms_sohbet_users` (`id`, `login`, `password`, `roles`, `profile`) VALUES
(1, 'OrÃ§un Madran', '', 2, NULL),
(2, 'Ã–rnek Ã–ÄŸrenci', '', 1, NULL);

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_sube`
--

CREATE TABLE IF NOT EXISTS `lms_sube` (
  `no` int(11) NOT NULL auto_increment,
  `kod` int(3) NOT NULL,
  `dersno` int(11) NOT NULL,
  `subeadi` varchar(30) collate utf8_turkish_ci NOT NULL,
  `kimlik` varchar(20) collate utf8_turkish_ci NOT NULL,
  PRIMARY KEY  (`no`),
  UNIQUE KEY `sube` (`subeadi`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `lms_sube`
--

INSERT INTO `lms_sube` (`no`, `kod`, `dersno`, `subeadi`, `kimlik`) VALUES
(1, 1, 1, '1.1', 'omadran'),
(2, 1, 2, '2.1', 'omadran');

-- --------------------------------------------------------

--
-- Tablo yapısı: `lms_sube_sohbet`
--

CREATE TABLE IF NOT EXISTS `lms_sube_sohbet` (
  `no` int(11) NOT NULL auto_increment,
  `subeno` int(11) NOT NULL,
  `gun` int(1) NOT NULL,
  `saat` varchar(5) collate utf8_turkish_ci NOT NULL,
  `ad` varchar(20) collate utf8_turkish_ci NOT NULL,
  `sifre` varchar(20) collate utf8_turkish_ci NOT NULL,
  PRIMARY KEY  (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

--
-- Tablo döküm verisi `lms_sube_sohbet`
--

