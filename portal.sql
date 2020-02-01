-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2018 at 05:32 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_b_as`
--

CREATE TABLE `dokumen_b_as` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `topik` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periode_id` int(10) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumen_b_as`
--

INSERT INTO `dokumen_b_as` (`id`, `created_at`, `updated_at`, `topik`, `periode_id`, `tanggal`, `catatan`) VALUES
(1, '2018-11-09 23:18:45', '2018-11-10 00:37:45', 'Konsultasi Perkuliahan, Persetujuan KRS dan Hal Lainnya', 1, '2018-11-08', '<p>Hal-hal yang dibahas pada pertemuan bimbingan akademik untuk periode ini adalah</p>\r\n<ol>\r\n<li>Konsultasi Nilai Matakuliah</li>\r\n<li>Konsultasi KRS&nbsp;untuk Semester 2</li>\r\n<li>Konsultasi Keuangan</li>\r\n<li>Persetujuan KRS untuk&nbsp;Semester 2</li>\r\n</ol>\r\n<p>Blalalalalalalalalalalalaalalalaalallala</p>\r\n<p>babababababababababababaab</p>\r\n<p>wikwiwiwkwiwkwiwkwiwkwik</p>');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2018_10_11_193916_create_permission_tables', 1),
(16, '2014_10_12_000000_create_users_table', 2),
(17, '2014_10_12_100000_create_password_resets_table', 2),
(18, '2018_10_21_201826_create_postingans_table', 2),
(19, '2018_11_01_175259_create_periodes_table', 2),
(20, '2018_11_01_202136_create_dokumen_b_as_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(3, 'App\\User', 3),
(3, 'App\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periodes`
--

CREATE TABLE `periodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `periode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periodes`
--

INSERT INTO `periodes` (`id`, `created_at`, `updated_at`, `nama`, `semester`, `tahun`, `periode`) VALUES
(1, '2018-11-09 23:14:57', '2018-11-09 23:14:57', 'Awal Semester', 1, 2018, 1),
(2, '2018-11-09 23:15:11', '2018-11-09 23:15:11', 'Sebelum UTS', 1, 2018, 2),
(3, '2018-11-09 23:15:27', '2018-11-09 23:15:27', 'Sebelum UAS', 1, 2018, 3);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage-users', 'web', '2018-10-11 14:16:45', '2018-10-11 14:16:45'),
(2, 'create-dokbimak', 'web', '2018-10-11 14:58:15', '2018-10-11 14:58:15'),
(3, 'edite-dokbimak', 'web', '2018-10-11 14:58:35', '2018-10-11 14:59:05'),
(4, 'delete-dokbimak', 'web', '2018-10-11 14:58:53', '2018-10-11 14:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `postingans`
--

CREATE TABLE `postingans` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `konten` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postingans`
--

INSERT INTO `postingans` (`id`, `created_at`, `updated_at`, `judul`, `waktu`, `konten`, `user_id`) VALUES
(1, '2018-11-09 22:11:34', '2018-11-09 22:11:34', 'Pelatihan Developer Program Grand Bootcamp Arkademy', '2018-11-05', '<p>Kamu mau mendalami software development secara gratis Sahabat TopKarir? Kali ini ada kesempatan untuk kamu di Program Grand Bootcamp Arkademy untuk kamu pemuda pemudi Indonesia, ntuk belajar secara Gratis Bahasa Pemrograman Standar Industri (React Native, Node.js, Mongo DB, dan lain-lain).</p>\r\n<p>&nbsp;</p>\r\n<p>Nantinya kamu akan terpilih untul dilatih selama satu bulan dengan intensif untuk menerapkan berbagai skill yang berkaitan dengan software development di perusahaan-perusahaan teknologi.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Keuntungan:</strong></p>\r\n<ul>\r\n<li>Mendapatkan gratis pelatihan intensif dan bimbingan mentor terkait software development</li>\r\n<li>Mendapatkan pelatihan culture fit terkait software development</li>\r\n<li>Disalurkan bekerja ke beberapa startup dan perusahaan teknologi yang menjadi rekanan Arkademy</li>\r\n<li>Mendapatkan Gratis tempat tinggal selama kegiatan berlangsung.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>Kewajiban:</strong></p>\r\n<ul>\r\n<li>Mengikuti bootcap dengan sungguh-sungguh untuk mengubah hidup dan masa depan</li>\r\n<li>Bersedia bekerja di startup &amp; perusahaan teknologi yang menjadi mitra Arkademy</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>Persyaratan:</strong></p>\r\n<ul>\r\n<li>Pria/ Wanita berusia 18 s/d 25 tahun</li>\r\n<li>Tidak terikat kontrak dengan perusahaan manapun</li>\r\n<li>Bersedia bekerja di perusahaan rekanan Arkademy</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>Cara Mendaftar:</strong></p>\r\n<ul>\r\n<li>Untuk mendaftar beasiswa ini kamu dapat mendaftarkan diri secara online pada tautan berikut ini:&nbsp;<a href=\"https://docs.google.com/forms/d/e/1FAIpQLSfEi_q67-BUYZCgoXGEZZRQpTI0PVaNyTKcVU4E57dfrNd-2Q/viewform\">ly/grandbootcamp</a></li>\r\n<li>Batas waktu pendaftaran Jumat 16 November 2018 pkl 09.00 WIB</li>\r\n<li>Nantinya kamu akan mengerjakan soal tes seleksi yang akan dikirmkan visa emal yang sudah di daftarkan.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Informasi lebih lanut kamu dapat menghubungi berikut ini:</p>\r\n<p>Website:&nbsp;<a href=\"http://www.arkademy.com/\">www.arkademy.com</a></p>\r\n<p>&nbsp;</p>\r\n<p>Dapatkan beasiswa luar dan dalam negeri lainnya di&nbsp;<a href=\"http://www.topkarir.com/\">www.topkarir.com</a>, selamat mencoba!</p>\r\n<p>&nbsp;</p>', 1),
(2, '2018-11-09 22:12:33', '2018-11-09 22:23:06', 'Beasiswa Rotary Yoneyama Pada Periode 2018-2019', '2018-10-25', '<p>Beasiswa di Jepang semakin banyak nih Sahabat TopKarir! Kali ini ada beasiswa untuk pelajar internasional melalui Program Rotary Yoneyama Scholarship yang di danai oleh Yayasan Rotary Yoneyama Memorial, yaitu organisasi swasta penyedia beasiswa terbesar di Jepang. Kamu bisa mendaftar untuk melanjutkan Pendidikan ke jenjang S1, S2, dan juga S3 di Universitas yang ada di Jepang.</p>\r\n<p>&nbsp;</p>\r\n<p>Cakupan beasiswanya cukup besar Sahabat TopKarir, yaitu bantuan dana perbulan, dan penggantian biaya tiket pesawat kelas ekonomi dari Indonesia ke Jepang. Namun sayangnya, beasiswa ini tidak termasuk biaya masuk dan biaya perkuliahan (tuition fee) juga beasiswa ini hanya membiayai 2 tahun pertama saja.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Persyaratan:</strong></p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Bukan warganegara atau berdomisili di Jepang</li>\r\n<li>Sudah mendapatkan atau sedang dalam proses pendaftaran untuk Surat Persetujuan Penerimaan Pra-kedatangan atau surat yang telah diterima di Universitas/ Sekolah Pascasarjana (dibawah yuridiksi MEXT) yang akan dituju di Jepang, dengan pendaftaran bulan April 2019 atau Oktober 2019</li>\r\n<li>Untuk kamu yang pernah studi/ melakukan penelitian di Jepang tidak bisa mengikuti Beasiswa Rotary Yoneyama</li>\r\n<li>Untuk pelamar program S1 wajib menyerahkan Salinan penerimaan masuk sebagai mahasiswa (admission), dan bagi pelamar program S2 atau S3 (Pascasarjana) wajib memberikn surat rekmendasi dari supervisor/ professor di Universitas/ Sekolah Pascasarjana di Jepang.</li>\r\n<li>Punya antusiasme belajar dan tujuan masa depan, punya kesadaran dan rasa hormat terhadap perbedaan budaya, bisa menyampaikan pendapat dan bisa berkomuikasi dengan lancar.</li>\r\n<li>Sehat secara fisik dan juga mental</li>\r\n<li>Terbuka untuk pelajar dari semua jurusan</li>\r\n<li>Usia maksimal 39 tahun</li>\r\n<li>Bisa berbahasa Jepang level dasar 9 (setingkat JPL N4) tetapi tidak wajib punya sertifikat kemampuan bahasa Jepang</li>\r\n<li>Beasiswa ini tidak bisa diikuti jika kamu sudah mendapatkan beasiswa dari organisasi lain</li>\r\n<li>Jika kamu sudah mendapatkan beasiswa Yoneyama sebelumnya, kamu tidak dapat mendaftar beasiswa ini</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>Berkas yang Dibutuhkan:</strong></p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Formulir pendaftaran</li>\r\n<li>Salinan pendaftaran masuk (admission) sebagai mahasiswa di Universitas Jepang yang kamu tuju.</li>\r\n<li>Rencana penilitian untuk pelamar S2 dan S3</li>\r\n<li>Membuat essay dengan judul&nbsp;<em>&ldquo;The Purpose for Studying in Japan&rdquo;</em></li>\r\n<li>Surat rekomendasi:\r\n<ul>\r\n<li>Untuk pelamar Beasiswa S1: Melampirkan Surat Rekomendasi dari SMA/ sekolah asal tempat kerja terakhir atau universitas tujuan di Jepang.</li>\r\n<li>Pelamar Beasiswa S2 dan S3: Melampirkan surat rekomendasI dari supervisor/ profesor pada universitas/ sekolah pascasarjana yang kamu tuju di Jepang atau dari Supervisor/ Profesor di universitas asal atau dari tempat kerja terakhir.</li>\r\n</ul>\r\n</li>\r\n<li>Salinan surat penerimaan (LoA), Surat Persetujuan Penerimaan Pra-kedatangan atau Surat telah diterima pada universitas/ sekolah pascasarjana yang kamu tuju di Jepang</li>\r\n<li>Sainan skor tes kemampuan bahasa Jepang (jika ada)</li>\r\n<li>Dokumen 1, 3, 4, dan 5 dapat diunduh pada tautan berikut ini:&nbsp;<a href=\"https://goo.gl/kS8ZKs\">Unduh</a></li>\r\n<li>Seluruh berkas dokumen di scan dan dibuat format PDF</li>\r\n<li>Dokumen menggunakan bahasa Indonesia, dan juga melampiran hasil terjemahan dalam bahasa Jepang atau bahasa Inggris. Gunakan jasa penerjemah tersumpah untuk menerjemahkan dokumen resmi.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>Pendaftaran:</strong></p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Lampirkan seluruh berkas softcopy dan kirimkan pada alamat email:&nbsp;<a href=\"mailto:apply@rotary-yoneyama.or.jp\">apply@rotary-yoneyama.or.jp</a></li>\r\n<li>Dokumen noemr 5 &amp; 6 langsung dikirimkan pada universitas yang dituju.</li>\r\n<li>Batas waktu pendaftaran sampai dengan 15 Desember 2018</li>\r\n<li>Pengumuman penerima beasiswa dilaksanakan pada pertengahan Februari 2019 melalui email masing-masing</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Untuk informasi lebih lanjut mengenai Beasiswa Rotary Yoneyama, pelamar dapat menghubungi kontak berikut:</p>\r\n<p>&nbsp;</p>\r\n<p>Email:&nbsp;<a href=\"mailto:mail@rotary-yoneyama.or.jp\">mail@rotary-yoneyama.or.jp</a></p>\r\n<p>Website:&nbsp;<a href=\"http://www.rotary-yoneyama.or.jp/\">www.rotary-yoneyama.or.jp</a></p>\r\n<p>&nbsp;</p>\r\n<p>Selamat mencoba Sahabat TopKarir!</p>', 1),
(3, '2018-11-09 22:13:29', '2018-11-09 22:13:29', 'BEASISWA CIMB NIAGA UNTUK MAHASISWA S1', '2018-11-03', '<p>Hai Sobat Beasiswa.ID! Bagi kamu&nbsp;<a href=\"http://beasiswa.id/category/beasiswa-sarjana\">mahasiswa S1</a>&nbsp;di Indonesia, ayo ikuti tawaran Beasiswa&nbsp;<a href=\"http://beasiswa.id/tag/cimb-niaga\">CIMB Niaga</a>&nbsp;2018! Program beasiswa ini diselenggarakan oleh PT CIMB Niaga Tbk dan terbuka untuk seluruh mahasiswa Indonesia tanpa kerjasama eksklusif dengan universitas manapun. Diharapkan dengan adanya program ini dapat mendukung peningkatan pengembangan pendidikan di Indonesia yang berkelanjutan serta mempersiapkan generasi penerus Indonesia yang berkualitas. Berikut informasi selengkapnya.</p>\r\n<p><strong>CAKUPAN BEASISWA:</strong><br />1. Biaya kuliah dan operasional pendidikan selama 4 semester<br />2. Biaya laptop<br />3. Biaya penyusunan skripsi</p>\r\n<p><strong>PERSYARATAN &amp; KETENTUAN:</strong><br />1. Program ini terbuka untuk mahasiswa aktif yang sedang menjalani perkuliahan di semester 5. Terbuka untuk seluruh universitas di Indonesia.</p>\r\n<p>2. Memiliki Indeks Prestasi Kumulatif (IPK) minimal 3.25 dengan masing-masing Indeks Prestasi Semester (IPS) per semester minimal 3.00.</p>\r\n<p>3. Memiliki prestasi akademis dan non-akademis yang dapat dibuktikan dengan dokumen sertifikat penghargaan.</p>\r\n<p>4. Mengikuti kegiatan organisasi kemahasiswaan yang dibuktikan dengan dokumen sertifikat keikutsertaan.</p>\r\n<p>5. Tidak sedang mendapatkan beasiswa lain baik dari Pemerintah, perusahaan swasta, perusahaan milik Pemerintah, BUMN, maupun instansi lain yang dinyatakan dalam surat pernyataan resmi yang ditandatangani oleh mahasiswa dan pihak kemahasiswaan.</p>\r\n<p>6. Peserta wajib mengisi seluruh informasi pendaftaran dengan benar dan valid.</p>\r\n<p>7. Peserta wajib melengkapi dokumen-dokumen yang dibutuhkan untuk pendaftaran Program Beasiswa CIMB Niaga 2018 dengan benar dan valid.</p>\r\n<p>8. Peserta wajib mengikuti seluruh proses seleksi Program Beasiswa CIMB Niaga 2018, meliputi pendaftaran, wawancara hingga inaugurasi.</p>\r\n<p>9. Beasiswa ini tidak dapat berpindahtangan oleh pihak penerima beasiswa.</p>\r\n<p><strong>CARA MENDAFTAR:</strong><br />Untuk mendaftar Beasiswa CIMB Niaga 2018, pelamar dapat mengisi formulir secara online pada link berikut:&nbsp;<a href=\"https://www.kejarmimpi.id/beasiswacimbniaga2018/\">https://www.kejarmimpi.id/beasiswacimbniaga2018/</a>.</p>\r\n<p>Masukkan email dan password yang akan digunakan untuk login nantinya, kemudian klik tulisan<strong>&nbsp;DAFTAR</strong>. Jangan lupa cek email untuk mengaktifkan akunmu. Selanjutnya download dan isi formulir pendaftaran yang harus diisi, serta upload formulir beserta dokumen yang diperlukan.</p>\r\n<p>Batas waktu pendaftaran sampai dengan 8 November 2018. Proses seleksi meliputi Seleksi Dokumen, Interview dan Tes Aptitude. Pengumuman penerima beasiswa akan dipublikasikan pada website Kejar Mimpi. Apabila ada yang ingin ditanyakan, dapat menghubungi kontak berikut:<br />Phone Banking CIMB Niaga 14041<br />Email: community.relations@cimbniaga.co.id<br />Yuk bagikan pada teman-temanmu yang membutuhkan. Selamat mencoba dan semoga bermanfaat!</p>', 1),
(4, '2018-11-09 22:14:29', '2018-11-09 22:14:29', 'BEASISWA S1 EKA TJIPTA FOUNDATION', '2018-10-20', '<p>Hai Sobat Beasiswa.ID! Bagi kamu yang memiliki keterbatasan ekonomi, kamu bisa nih coba beasiswa yang di tawarkan kali ini oleh Eka Tjipta Foundation. Informasi&nbsp;<a href=\"http://beasiswa.id/\"><strong>beasiswa</strong></a>&nbsp;terbaru dari Eka Tjipta Foundation 2018.&nbsp;<a href=\"http://beasiswa.id/tag/eka-tjipta-foundation\">Eka Tjipta Foundation</a>&nbsp;(ETF) merupakan organisasi nirlaba yang didirikan oleh keluarga Widjaja pada tahun 2006 sebagai wadah pelaksanaan kegiatan tanggung jawab sosial perusahaan bagi seluruh unit usaha dibawah bendera Sinar Mas.</p>\r\n<p>Beasiswa ETF ini dikhususkan untuk mahasiswa-mahasiswi berprestasi yang memiliki keterbatasan ekonomi untuk melanjutkan pendidikan ke jenjang&nbsp;<a href=\"http://beasiswa.id/category/beasiswa-sarjana\">Strata 1</a>.</p>\r\n<p><strong>Persyaratan Umum</strong></p>\r\n<ul>\r\n<li>Warga Negara Indonesia (WNI)</li>\r\n<li>Usia maksimum 21 tahun</li>\r\n<li>Lulus seleksi administrasi</li>\r\n<li>Memiliki nilai rata-rata 8.00 selama SMA (Semester 1 &ndash; 6)</li>\r\n<li>Tidak sedang menerima bantuan beasiswa dari pihak atau lembaga lain</li>\r\n<li>Bersedia mengikuti kegiatan pembinaan selama masa periode beasiswa</li>\r\n<li>Bersedia mengikuti ikatan dinas (apabila memenuhi kualifikasi yang dibutuhkan)</li>\r\n</ul>\r\n<p><strong>Cakupan Beasiswa</strong></p>\r\n<ul>\r\n<li>Biaya kuliah (maksimum sampai dengan Semester 8)</li>\r\n<li>Tunjangan hidup per semester (selama mahasiswa aktif mengikuti perkuliahan, maksimal sampai dengan Semester 8)</li>\r\n<li>Tunjangan tugas akhir dan wisuda</li>\r\n</ul>\r\n<p><strong>Prosedur Pendaftaran</strong></p>\r\n<ul>\r\n<li>Mengisi formulir pendaftaran dan dikirim bersama dengan dokumen pendukung:</li>\r\n<li>Pas foto terbaru (maksimal 3 bulan terakhir) ukuran 4&times;6 berwarna dengan latar belakang merah sebanyak 2 lembar</li>\r\n<li>Fotocopy Ijazah dan Transkrip Nilai yang dilegalisir</li>\r\n<li>Fotocopy piagam perhargaan yang pernah diterima</li>\r\n<li>Fotocopy KTP &amp; Kartu Mahasiswa, masing-masing 2 lembar</li>\r\n<li>Fotocopy Kartu Keluarga</li>\r\n<li>Fotocopy rekening listrik 3 bulan terakhir</li>\r\n<li>Fotocopy slip gaji orangtua (bagi yang bekerja)</li>\r\n<li>Surat Keterangan Kurang Mampu dari RT/RW</li>\r\n</ul>\r\n<p><strong>Semua dokumen dikirimkan ke:</strong></p>\r\n<p><strong>Eka Tjipta Foundation</strong><br /><strong>Sinar Mas Plaza, Menara 2, Lantai 33</strong><br /><strong>JL. M.H. Thamrin No. 51</strong><br /><strong>Jakarta 10350</strong><br /><strong>Up. Divisi Beasiswa</strong></p>\r\n<p>Terkait informasi lengkap silakan kunjungi laman&nbsp;<a href=\"http://ekatjipta.org/beasiswa-etf/\" target=\"_blank\" rel=\"noopener noreferrer\">http://ekatjipta.org/beasiswa-etf</a>.</p>', 1),
(5, '2018-11-09 22:15:15', '2018-11-09 22:15:15', 'BEASISWA FULBRIGHT UNTUK DOSEN, PEGAWAI DAN NGO KE AMERIKA', '2018-10-25', '<p>Selain&nbsp;<a href=\"http://beasiswa.id/category/beasiswa-riset\">beasiswa riset</a>&nbsp;khusus peneliti, salah satu&nbsp;<a href=\"http://beasiswa.id/tag/amerika\">beasiswa</a>&nbsp;Fulbright ini juga masih dibuka untuk 2018.<a href=\"http://beasiswa.id/tag/fulbright-us-asean-visiting-scholar-iniative-program\">&nbsp;<em>Fulbright US-ASEAN Visiting Scholar Initiative Program</em></a>. Kedua beasiswa tersebut memiliki durasi yang singkat. Fulbright US-ASEAN Visiting merupakan kegiatan kunjungan ke Amerika Serikat baik untuk penelitian atau kegiatan profesional lainnya.&nbsp;<a href=\"http://beasiswa.id/tag/beasiswa-amerika\">Program</a>&nbsp;ini berlangsung antara 3 &ndash; 4 bulan terkait isu-isu yang relevan dan bermanfaat bagi negara anggota ASEAN.</p>\r\n<div>Sesuai namanya, program beasiswa Fulbright kunjungan ke AS ini ditujukan bagi pelamar dari 10 negara-negara anggota ASEAN, salah satunya Indonesia. Beasiswa yang diberikan di antaranya meliputi uang saku bulanan antara&nbsp; US $2.710 hingga $3.145 per bulan, tiket pesawat kelas ekonomi pulang-pergi, biaya penyisihan $1.250, serta biaya penelitian maupun kualifikasi laboratorium universitas yang diperlukan hingga $3.000.</div>\r\n<div>&nbsp;</div>\r\n<div>Kandidat terpilih dapat melakukan penelitian pada bidang-bidang, seperti Pendidikan, Ilmu Lingkungan, Integrasi Pasar Keuangan, Teknologi Pangan, Ilmu Informasi, Jurnalisme, Hukum, Ilmu Politik, Administrasi Publik, Kesehatan Global/Masyarakat, Pekerjaan Sosial, Sosiologi, Statistik, Perdagangan dan Investasi, Fasilitasi Perdagangan, dan TEFL &amp; Linguistik Terapan, dll.</div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div><strong>Persyaratan:&nbsp;</strong></div>\r\n<div>1. Warganegara dan penduduk Indonesia selama proses nominasi dan seleksi<br />2. Bersedia kembali ke Indonesia setelah menyelesaikan program di Amerika Serikat<br />3. Dosen universitas, pegawai pemerintah dan kementerian luar negeri, atau staf profesional dari lembaga pemikir atau NGO dari negara-negara ASEAN yang fokus pada isu-isu Amerika &ndash; ASEAN.<br />4. Memiliki catatan prestasi akademis atau profesional yang signifikan<br />5. Mahir berbahasa Inggris<br />6. Kondisi kesehatan yang baik, disahkan melalui penyerahan riwayat medis dan pemeriksaan medis sebelum keberangkatan.</div>\r\n<div>&nbsp;</div>\r\n<div><u>Ctt:</u>&nbsp;Tidak memenuhi syarat bagi pelamar yang saat ini sedang mengajar, studi, atau melakukan penelitian di AS, atau telah menerima beasiswa Fulbright dalam lima tahun terakhir. Serta&nbsp;<span id=\"result_box\" class=\"\" lang=\"id\"><span class=\"\">tidak memenuhi syarat jika telah menerima visa J-1 dalam kategori Professor / Research Scholar dalam dua tahun terakhir.</span></span></div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<div><strong>Dokumen aplikasi:&nbsp;</strong></div>\r\n<div>1. Formulir aplikasi online</div>\r\n<div>2. Project statement (tiga hingga lima halaman)</div>\r\n<div>3. Bibliografi (hingga tiga halaman)</div>\r\n<div>4. Curriculum viate (hingga enam halaman)</div>\r\n<div>5. Surat undangan (jika ada)</div>\r\n<div>6. Tiga (3) Surat rekomendasi</div>\r\n<div>&nbsp;</div>\r\n<div><strong>Pendaftaran:&nbsp;</strong></div>\r\n<div>\r\n<p>Pertama lengkapi terlebih dahulu formulir aplikasi online di laman:&nbsp;<a href=\"https://iie.embark.com/auth/register\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">https://iie.embark.com</a></p>\r\n<p>Selanjutnya pilih &ldquo;US-ASEAN Fulbright Initiative&rdquo; pada menu aplikasi online tersebut dan lengkapi informasi yang dibutuhkan.</p>\r\n<p>Setelah melengkapi formulir aplikasi online, jangan lupa print out dan lampirkan bersama dokumen aplikasi lainnya seperti tertera di atas.</p>\r\n<p>Semua dokumen aplikasi yang dibutuhkan dikirim atau diajukan langsung ke:</p>\r\n</div>\r\n<div>&nbsp;</div>\r\n<p><strong>American Indonesian Exchange Program (AMINEF)</strong><br /><strong>Intiland Tower, Lantai 11</strong><br /><strong>Jalan Jenderal Sudirman Kav. 32</strong><br /><strong>Jakarta 10220</strong><br /><strong>Tel: (021) 579 39 085 ~ 9086</strong></p>\r\n<div>Dokumen aplikasi diterima paling lambat 1 November 2018. Project yang diusulkan pelamar harus dimulai September 2019 dan berakhir Desember 2019. Pertanyaan terkait aplikasi bisa disampaikan melalui email: infofulbright_ind@aminef.or.id atau kunjungi laman AMINEF (<a href=\"http://www.aminef.or.id/\"><strong>www.aminef.or.id</strong></a>).</div>\r\n</div>\r\n</div>', 1),
(6, '2018-11-09 22:22:22', '2018-11-09 22:22:22', 'Beasiswa Pendidikan Indonesia Program Reguler LPDP', '2018-11-20', '<p><strong>Ketentuan Umum</strong></p>\r\n<ol>\r\n<li>Beasiswa Pendidikan Indonesia Program Reguler selanjutnya disebut BPI Reguler adalah beasiswa yang dikelola oleh LPDP yang diperuntukkan bagi warga negara Republik Indonesia untuk menempuh jenjang pendidikan magister dan doktoral.</li>\r\n<li>Perguruan Tinggi tujuan adalah perguruan tinggi di dalam dan luar negeri hasil kajian LPDP yang digunakan sebagai rujukan penerima beasiswa LPDP dalam memilih perguruan tinggi dan program studi.</li>\r\n<li><em>Letter of Acceptance Unconditonal&nbsp;</em>selanjutnya disebut<em>&nbsp;LoA Unconditional&nbsp;</em>adalah surat tanda terima perguruan tinggi tanpa syarat.</li>\r\n</ol>\r\n<p><strong>Sasaran Beasiswa</strong></p>\r\n<p>Sasaran program BPI Reguler adalah :</p>\r\n<ol>\r\n<li>Warga Negara Indonesia (WNI) yang telah lulus sarjana atau sarjana terapan (S1/D4) yang memenuhi kualifikasi untuk program magister; dan</li>\r\n<li>Warga Negara Indonesia (WNI) yang telah lulus magister atau magister terapan (S2), atau lulusan sarjana atau sarjana terapan (S1/D4) yang memenuhi kualifikasi untuk program doktoral.</li>\r\n</ol>\r\n<p><strong>Skema Program Beasiswa</strong></p>\r\n<p>Skema program BPI Reguler diberikan dalam bentuk program tunggal&nbsp;<em>(</em><em>single degree)</em><em>.</em></p>\r\n<p><strong>Persyaratan BPI Program Magister</strong></p>\r\n<ol>\r\n<li>Memiliki Surat Keterangan yang dikeluarkan oleh dokter dari Rumah Sakit Pemerintah; Puskesmas; atau Klinik Pemerintah dengan masa berlaku paling lama 6 (enam) bulan sebelum penutupan pendaftaran di setiap periode pendaftaran dengan ketentuan:\r\n<ol type=\"a\">\r\n<li>Surat keterangan berbadan sehat dan bebas dari narkoba, berlaku untuk semua pendaftar BPI Reguler.</li>\r\n<li>Surat keterangan bebas TBC, hanyauntuk pendaftar BPI Reguler tujuan luar negeri.</li>\r\n</ol>\r\n</li>\r\n<li>Mendapatkan rekomendasi dari tokoh masyarakat bagi yang belum/tidak sedang bekerja, atau rekomendasi dari atasan bagi yang sedang bekerja;</li>\r\n<li>Khusus pendaftar dari PNS, TNI, dan POLRI harus mendapatkan surat izin dari unit yang menangani SDM atau Kepegawaian untuk mengikuti seleksi beasiswa LPDP.</li>\r\n<li>Memiliki dan memilih bidang keilmuan, program studi, dan perguruan tinggi tujuan yang sesuai dengan ketentuan LPDP;</li>\r\n<li>Bersedia menandatangani surat pernyataan yang menyatakan bahwa pendaftar:\r\n<ol type=\"a\">\r\n<li>Bersedia kembali ke Indonesia setelah selesai studi;</li>\r\n<li>Tidak sedang menerima atau akan menerima beasiswa dari sumber lain;</li>\r\n<li>Tidak terlibat dalam aktivitas atau tindakan yang melanggar hukum, atau mengikuti organisasi yang bertentangan dengan ideologi Pancasila;</li>\r\n<li>Tidak pernah atau akan terlibat dalam aktivitas atau tindakan yang melanggar kode etik Akademik;</li>\r\n<li>Selalu mengabdi untuk kepentingan Bangsa Indonesia;</li>\r\n<li>Selalu setia kepada Negara Kesatuan Republik Indonesia;</li>\r\n<li>Sanggup memenuhi ketentuan beasiswa yang ditetapkan LPDP;</li>\r\n<li>Tidak mengajukan perpindahan dari Perguruan Tinggi dalam negeri ke Perguruan Tinggi luar Negeri jika mendaftar program beasiswa magister atau doktoral di dalam negeri;</li>\r\n<li>Menyampaikan data dan dokumen yang benar, sesuai aslinya, apabila ternyata tidak sah, bersedia menerima sanksi hukum yang berlaku dan dimasukkan ke dalam&nbsp;<strong>daftar hitam</strong>&nbsp;(<em>blacklist</em>) sebagai pendaftar LPDP.</li>\r\n</ol>\r\n</li>\r\n<li>Memenuhi ketentuan batas usia pendaftar pada 31 Desember di tahun pendaftaran yaitu paling tinggi berusia 35 (tiga puluh lima) tahun.</li>\r\n<li>Telah menyelesaikan studi pada program sarjana atau sarjana terapan dibuktikan dengan ijazah atau surat keterangan lulus.</li>\r\n<li>Tidak sedang atau telah menempuh studi&nbsp;<em>degree/non degree</em>&nbsp;(<em>on going</em>) program magister baik di Perguruan Tinggi dalam negeri atau Perguruan Tinggi di luar negeri.</li>\r\n<li>Memiliki Indeks Prestasi Kumulatif (IPK) dari jenjang studi sebelumnya sekurang-kurangnya 3,0 pada skala 4 yang dibuktikan dengan melampirkan transkrip nilai.</li>\r\n<li>Pendaftar Magister Dalam Negeri harus memiliki dokumen resmi bukti penguasaan bahasa Inggris yang masih berlaku dan diterbitkan oleh ETS (www.ets.org) atau IELTS (www.ielts.org) dengan skor sekurang-kurangnya TOEFL ITP&reg; 500; TOEFL iBT&reg; 61; IELTS&trade; 6,0; TOEIC&reg; 650;atau TOAFL 500 bagi program studi dan/atau Perguruan Tinggi Islam yang mensyaratkan TOAFL sebagai syarat masuk.</li>\r\n<li>Pendaftar Magister Luar Negeri harus memiliki dokumen resmi bukti penguasaan bahasa Inggris yang masih berlaku dan diterbitkan oleh ETS (www.ets.org) atau IELTS (www.ielts.org) dengan skor sekurang-kurangnya TOEFL iBT&reg; 80; IELTS&trade; 6,5; TOEIC&reg; 800;atau TOAFL 550 bagi program studi dan/atau Perguruan Tinggi Islam yang mensyaratkan TOAFL sebagai syarat masuk.</li>\r\n<li>Pendaftar BPI Program Magister yang menyelesaikan studi dari Perguruan Tinggi Luar Negeri dengan menggunakan bahasa pengantar yang diakui oleh Perserikatan Bangsa-Bangsa (PBB) dikecualikan dari persyaratan sebagaimana dimaksud pada angka 10 dan angka 11, serta dibuktikan dengan salinan ijazah dengan masa berlaku 2 (dua) tahun sejak ijazah diterbitkan.</li>\r\n<li>Ketentuan pada angka 12, diperuntukkan bagi pendaftar yang menyelesaikan studi dari Perguruan Tinggi Luar Negeri dengan bahasa resmi Perserikatan Bangsa-Bangsa (PBB) dengan kriteria sebagai berikut:\r\n<ol type=\"a\">\r\n<li>Bahasa Inggris untuk semua perguruan tinggi tujuan LPDP di negara-negara dengan Bahasa Inggris sebagai bahasa resmi negara tersebut;</li>\r\n<li>Bahasa Arab untuk semua perguruan tinggi tujuan LPDP di negara-negara dengan Bahasa Arab sebagai bahasa resmi negara tersebut;</li>\r\n<li>Bahasa Perancis hanya untuk perguruan tinggi tujuan LPDP di negara Perancis;</li>\r\n<li>Bahasa Rusia hanya untuk perguruan tinggi tujuan LPDP di negara Rusia;</li>\r\n<li>Bahasa Spanyol hanya untuk perguruan tinggi tujuan LPDP di negara Spanyol;</li>\r\n<li>Bahasa Cina/Mandarin untuk semua perguruan tinggi tujuan LPDP di negara-negara dengan Bahasa Cina/Mandarin sebagai bahasa resmi negara tersebut;</li>\r\n</ol>\r\n</li>\r\n<li>Pendaftar BPI Magister dari Perguruan Tinggi Luar Negeri yang tidak menggunakan bahasa pengantar sebagaimana dimaksud pada angka 12 dan angka 13 harus mengikuti persyaratan kemampuan bahasa yang berlaku di negara Perguruan Tinggi Tujuan dan daftar persyaratan kompetensi bahasa asing sebagaimana terlampir.</li>\r\n<li>Pendaftar yang telah ditetapkan menjadi Penerima Beasiswa wajib menyelesaikan masa studi sesuai yang tertuang dalam&nbsp;<em>LoA Unconditional</em>&nbsp;dengan ketentuan paling lama 24 (dua puluh empat) bulan.</li>\r\n<li>Apabila Penerima Beasiswa menyelesaikan studi lebih dari 24 (dua puluh empat) bulan harus mendapatkan izin tertulis dari LPDP dan pendanaan beasiswa ditanggung oleh Penerima Beasiswa</li>\r\n<li>Pendaftar BPI Program Magister hanya diperbolehkan untuk jenis kelas reguler dan tidak diperuntukkan untuk kelas-kelas berikut:\r\n<ol type=\"a\">\r\n<li>Kelas Eksekutif;</li>\r\n<li>Kelas Karyawan;</li>\r\n<li>Kelas Jarak Jauh;</li>\r\n<li>Kelas yang diselenggarakan bukan di perguruan tinggi induk;</li>\r\n<li>Kelas internasional khusus untuk Magister Dalam Negeri; atau</li>\r\n<li>Kelas yang diselenggarakan di lebih dari 1 negara.</li>\r\n</ol>\r\n</li>\r\n<li>Menulis rencana studi sesuai program studi magister pada perguruan tinggi tujuan.</li>\r\n<li>Menulis&nbsp;<em>State</em><em>ment of Purpose</em>&nbsp;paling banyak 1.000 kata yang menjelaskan rencana kontribusi yang telah, sedang dan akan dilakukan untuk masyarakat, lembaga, instansi, profesi, atau komunitas.</li>\r\n</ol>\r\n<p><strong>Persyaratan BPI Program Doktoral</strong></p>\r\n<ol>\r\n<li>Memiliki Surat Keterangan yang dikeluarkan oleh dokter dari Rumah Sakit Pemerintah; Puskesmas; atau Klinik Pemerintah dengan masa berlaku paling lama 6 (enam) bulan sebelum penutupan pendaftaran di setiap periode pendaftaran dengan ketentuan:\r\n<ol type=\"a\">\r\n<li>Surat keterangan berbadan sehat dan bebas dari narkoba, berlaku untuk semua pendaftar BPI Reguler; dan</li>\r\n<li>Surat keterangan bebas TBC khusus untuk pendaftar BPI Reguler tujuan luar negeri.</li>\r\n</ol>\r\n</li>\r\n<li>Mendapatkan rekomendasi dari tokoh masyarakat bagi yang belum/tidak sedang bekerja, atau rekomendasi dari atasan bagi yang sedang bekerja.</li>\r\n<li>Khusus pendaftar dari PNS, TNI, dan POLRI harus mendapatkan surat izin dari unit yang menangani SDM atau Kepegawaian untuk mengikuti seleksi beasiswa LPDP.</li>\r\n<li>Memiliki dan memilih bidang keilmuan yang sesuai dengan bidang keilmuan, program studi, dan perguruan tinggi sesuai dengan ketentuan LPDP.</li>\r\n<li>Bersedia menandatangani surat pernyataan yang menyatakan bahwa pendaftar:\r\n<ol type=\"a\">\r\n<li>Bersedia kembali ke Indonesia setelah selesai studi;</li>\r\n<li>Tidak sedang menerima atau akan menerima beasiswa dari sumber lain;</li>\r\n<li>Tidak terlibat dalam aktivitas atau tindakan yang melanggar hukum, atau mengikuti organisasi yang bertentangan dengan ideologi Pancasila;</li>\r\n<li>Tidak pernah atau akan terlibat dalam aktivitas atau tindakan yang melanggar kode etik Akademik;</li>\r\n<li>Selalu mengabdi untuk kepentingan Bangsa Indonesia;</li>\r\n<li>Selalu setia kepada Negara Kesatuan Republik Indonesia;</li>\r\n<li>Sanggup memenuhi ketentuan beasiswa yang ditetapkan LPDP;</li>\r\n<li>Tidak mengajukan perpindahan dari Perguruan Tinggi dalam negeri ke Perguruan Tinggi luar Negeri jika mendaftar program beasiswa magister atau doktoral di dalam negeri;</li>\r\n<li>Menyampaikan data dan dokumen yang benar, sesuai aslinya, apabila ternyata tidak sah, bersedia menerima sanksi hukum yang berlaku dan dimasukkan ke dalam&nbsp;<strong>daftar hitam</strong>&nbsp;(<em>blacklist</em>) sebagai pendaftar LPDP.</li>\r\n</ol>\r\n</li>\r\n<li>Memenuhi ketentuan batas usia pendaftar pada 31 Desember di tahun pendaftaran yaitupaling tinggi 40 (empat puluh) tahun.</li>\r\n<li>Telah menyelesaikan studi pada program magister atau magister terapan atau telah menyelesaikan sarjana atau sarjana terapan yang memenuhi kualifikasi untuk langsung program doktoral.</li>\r\n<li>Tidak sedang atau telah menempuh studi&nbsp;<em>degree</em>&nbsp;<em>atau&nbsp;</em><em>non degree</em>&nbsp;(<em>on going</em>) program magister ataupun doktoral baik di Perguruaan Tinggi dalam negeri atau Perguruan Tinggi di luar negeri.</li>\r\n<li>Memiliki Indeks Prestasi Kumulatif (IPK) dari jenjang studi sebelumnya sekurang-kurangnya 3,25 pada skala 4 dan dibuktikan dengan melampirkan transkrip nilai.</li>\r\n<li>Pendaftar Doktoral Dalam Negeri harus memiliki dokumen resmi bukti penguasaan bahasa Inggris yang masih berlaku dan diterbitkan oleh ETS (www.ets.org) atau IELTS (www.ielts.org) dengan skor sekurang-kurangnya TOEFL ITP&reg; 530; TOEFL iBT&reg; 70; IELTS&trade; 6,0; TOEIC&reg; 700;atau TOAFL 530 bagi program studi dan/atau Perguruan Tinggi Islam yang mensyaratkan TOAFL sebagai syarat masuk.</li>\r\n<li>Pendaftar Doktoral Luar Negeri harus memiliki dokumen resmi bukti penguasaan bahasa Inggris yang masih berlaku dan diterbitkan oleh ETS (www.ets.org) atau IELTS (www.ielts.org) dengan skor sekurang-kurangnya TOEFL iBT&reg; 94; IELTS&trade; 7,0; TOEIC&reg; 850;atau TOAFL 550 bagi program studi dan/atau Perguruan Tinggi Islam yang mensyaratkan TOAFL sebagai syarat masuk.</li>\r\n<li>Pendaftar BPI Program Doktoral yang menyelesaikan studi dari Perguruan Tinggi Luar Negeri dengan menggunakan bahasa pengantar yang diakui oleh Perserikatan Bangsa-Bangsa (PBB) dikecualikan dari persyaratan sebagaimana dimaksud pada angka 10 dan angka 11, serta dibuktikan dengan salinan ijazah dengan masa berlaku 2 (dua) tahun sejak ijazah diterbitkan.</li>\r\n<li>Ketentuan pada angka 12, diperuntukkan bagi pendaftar yang menyelesaikan studi dari Perguruan Tinggi Luar Negeri dengan bahasa resmi Perserikatan Bangsa-Bangsa (PBB) dengan kriteria sebagai berikut:\r\n<ol type=\"a\">\r\n<li>Bahasa Inggris untuk semua perguruan tinggi tujuan LPDP di negara-negara dengan Bahasa Inggris sebagai bahasa resmi negara tersebut.</li>\r\n<li>Bahasa Arab untuk semua perguruan tinggi tujuan LPDP di negara-negara dengan Bahasa Arab sebagai bahasa resmi negara tersebut.</li>\r\n<li>Bahasa Perancis hanya untuk perguruan tinggi tujuan LPDP di negara Perancis.</li>\r\n<li>Bahasa Rusia hanya untuk perguruan tinggi tujuan LPDP di negara Rusia.</li>\r\n<li>Bahasa Spanyol hanya untuk perguruan tinggi tujuan LPDP di negara Spanyol.</li>\r\n<li>Bahasa Cina/Mandarin untuk semua perguruan tinggi tujuan LPDP di negara-negara dengan Bahasa Cina/Mandarin sebagai bahasa resmi negara tersebut.</li>\r\n</ol>\r\n</li>\r\n<li>Pendaftar BPI Doktoral dari Perguruan Tinggi Luar Negeri yang tidak menggunakan bahasa pengantar sebagaimana dimaksud pada angka 12 dan angka 13 harus mengikuti persyaratan kemampuan bahasa yang berlaku di negara Perguruan Tinggi Tujuan dan daftar persyaratan kompetensi bahasa asing sebagaimana terlampir.</li>\r\n<li>Masa studi paling lama 48 (empat puluh delapan) bulan yang tertuang dalam&nbsp;<em>LoA Unconditional</em>.</li>\r\n<li>Apabila Penerima Beasiswa menyelesaikan studi lebih dari 48 (empat puluh delapan) bulan harus mendapatkan izin tertulis dari LPDP dan pendanaan beasiswa ditanggung oleh Penerima Beasiswa.</li>\r\n<li>Pendaftar BPI Program Doktoral hanya diperbolehkan untuk jenis kelas reguler dan tidak diperuntukkan untuk kelas-kelas berikut:\r\n<ol type=\"a\">\r\n<li>Kelas Eksekutif;</li>\r\n<li>Kelas Karyawan;</li>\r\n<li>Kelas Jarak Jauh;</li>\r\n<li>Kelas yang diselenggarakan bukan di perguruan tinggi induk;</li>\r\n<li>Kelas Internasional khusus Doktoral Dalam Negeri; atau</li>\r\n<li>Kelas yang diselenggarakan di lebih dari 1 negara.</li>\r\n</ol>\r\n</li>\r\n<li>Menulis ringkasan proposal penelitian sesuai program studi Doktoral pada perguruan tinggi tujuan dan melampirkan proposal penelitian.</li>\r\n<li>Menulis&nbsp;<em>Statement of Purpose</em>&nbsp;paling banyak 1.000 kata yang menjelaskan rencana kontribusi yang telah, sedang dan akan dlakukan untuk masyarakat, lembaga, instansi, profesi, atau komunitas.</li>\r\n</ol>\r\n<p><strong>LoA&nbsp;<em>Unconditional</em></strong></p>\r\n<ol>\r\n<li>Pendaftar tidak harus memiliki&nbsp;<em>LoA Unconditional</em>&nbsp;saat mendaftar beasiswa LPDP.</li>\r\n<li>Pendaftar yang telah memiliki&nbsp;<em>LoA Unconditional</em>&nbsp;wajib melampirkan sertifikat kemampuan bahasa asing sesuai yang dipersyaratkan.</li>\r\n<li>Jikapendaftar telah memiliki&nbsp;<em>LoA Uncondi</em><em>tional</em>&nbsp;yang tidak memenuhi ketentuan sebagaimana dimaksud pada poin 2 (dua) wajib melampirkan surat penundaan perkuliahan dari Perguruan Tinggi Tujuan atau menandatangani surat pernyataan kesediaan menunda perkuliahan.</li>\r\n<li>Pendaftar yang ditetapkan sebagai calon penerima beasiswa, namun belum memiliki&nbsp;<em>Loa Unconditional</em>&nbsp;maka harus mendapatkan&nbsp;<em>LoA Unconditional</em>&nbsp;selambat-lambatnya 1 (satu) tahun setelah dikeluarkannya Keputusan Direktur Utama LPDP tentang penetapan hasil seleksi substansi calon penerima beasiswa.</li>\r\n<li>Bagi Calon Penerima beasiswa yang belum memiliki&nbsp;<em>LoA Unconditional</em>&nbsp;sesuai dengan batas waktu yang diberikan oleh LPDP dapat diberikan perpanjangan maksimal 6 (enam) bulan.</li>\r\n<li>Jika sampai pada batas waktu perpanjangan belum mendapatkan&nbsp;<em>LoA Unconditional</em>&nbsp;maka diberhentikan sebagai Calon Penerima Beasiswa.</li>\r\n<li>Calon Penerima Beasiswa yang diberhentikan sebagaimana poin 6 (enam) memiliki kesempatan mendaftar ulang sebanyak 1 (satu) kali dengan syarat wajib memiliki&nbsp;<em>LoA Unconditional</em>&nbsp;dari Perguruan Tinggi yang terdaftar di dalam daftar LPDP.</li>\r\n</ol>\r\n<p><strong>Pendaftaran</strong></p>\r\n<ol>\r\n<li>Pendaftaran beasiswa dan proses seleksi dilaksanakan sesuai jadwal yang telah ditetapkan oleh LPDP.</li>\r\n<li>Jadwal pelaksanaan seleksi ditetapkan melalui Keputusan Direktur Utama mengenai jadwal pelaksanaan seleksi.</li>\r\n<li>Pendaftar mengisi formulir pendaftaran secara&nbsp;<em>online</em>&nbsp;pada laman resmi LPDP.</li>\r\n<li>Pendaftar melengkapi dan mengunggah semua dokumen persyaratan dan/atau dokumen pendukung yang relevan pada laman resmi LPDP.</li>\r\n</ol>\r\n<p><strong>Seleksi</strong></p>\r\n<p>Proses seleksi Beasiswa Pendidikan Indonesia Program Reguler terdiri dari:</p>\r\n<ol>\r\n<li>Seleksi Administrasi;</li>\r\n<li>Seleksi Berbasis Komputer;</li>\r\n<li>Seleksi Substansi; dan</li>\r\n<li>Penetapan Kelulusan.</li>\r\n</ol>\r\n<p><strong>Seleksi Administrasi</strong></p>\r\n<ol>\r\n<li>Seleksi Administrasi dilakukan dengan memeriksa kelengkapan dokumen dan persyaratan lainnya.</li>\r\n<li>Pemeriksaan kelengkapan dokumen dan persyaratan lainnya dilakukan dengan tahapan sebagai berikut:\r\n<ol type=\"a\">\r\n<li>Tim penyeleksi administrasi melakukan verifikasi dan validasi terhadap kelengkapan dan kecocokan berkas pendaftaran berdasarkan persyaratan yang ditetapkan.</li>\r\n<li>Pendaftar yang dokumennya tidak memenuhi persyaratan dinyatakan tidak lulus seleksi administrasi.</li>\r\n<li>Pendaftar yang dokumennya telah memenuhi persyaratan dinyatakan lulus administrasi dan berhak mengikuti proses Seleksi Berbasis Komputer;</li>\r\n</ol>\r\n</li>\r\n<li>Pendaftar yang lulus seleksi administrasi akan ditetapkan melalui Keputusan Direktur Utama LPDP.</li>\r\n<li>Informasi pendaftar yang lulus atau tidak lulus seleksi administrasi disampaikan melalui akun pendaftaran&nbsp;<em>online</em>&nbsp;masing-masing pendaftar.</li>\r\n<li>Pendaftar yang belum memenuhi syarat administrasi pada pendaftaran&nbsp;<em>online</em>&nbsp;diperbolehkan mendaftar kembali.</li>\r\n<li>Pendaftar yang telah lulus seleksi administrasi ditetapkan sebagai peserta Seleksi Berbasis Komputer.</li>\r\n</ol>\r\n<p><strong>Seleksi&nbsp;</strong><em><strong>Berbasis Komputer</strong></em></p>\r\n<ol>\r\n<li>Pendaftar yang lulus seleksi administrasi mengikuti seleksi Berbasis Komputer.</li>\r\n<li>Seleksi Berbasis Komputer meliputi :\r\n<ol type=\"a\">\r\n<li>Tes Potensi Akademik;</li>\r\n<li><em>Soft</em>&nbsp;Kompetensi; dan</li>\r\n<li><em>O</em><em>n the spot writing</em>.</li>\r\n</ol>\r\n</li>\r\n<li>Pengambilan keputusan peserta yang dinyatakan lulus pada Seleksi Berbasis Komputer berdasarkan hasil nilai Tes Potensi Akademik.</li>\r\n<li>Peserta seleksi Berbasis Komputer yang tidak lulus dapat mendaftar kembali seleksi BPI Reguler di periode berikutnya.</li>\r\n<li>Peserta yang dinyatakan lulus seleksi Berbasis Komputerberhak mengikuti Seleksi Substansi.</li>\r\n</ol>\r\n<p><strong>Seleksi Substansi</strong></p>\r\n<ol>\r\n<li>Seleksi Substansi terdiri atas:\r\n<ol type=\"a\">\r\n<li>Verifikasi dokumen asli pendaftaran;</li>\r\n<li><em>Leaderless Grup Discussion</em>&nbsp;(LGD); dan</li>\r\n<li>Wawancara.</li>\r\n</ol>\r\n</li>\r\n<li>Peserta wajib menyiapkan dokumen asli pendaftaran untuk dilakukan verifikasi oleh oleh tim verifikator.</li>\r\n<li>Peserta wajib mengikuti verifikasi dokumen sebelum mengikuti wawancara.</li>\r\n<li>Peserta dapat mengikuti&nbsp;<em>LGD</em>&nbsp;sesuai jadwal yang telah ditentukan oleh LPDP.</li>\r\n<li>Peserta tidak dapat mengikuti seleksi wawancara,apabila dokumen yangdiserahkan:\r\n<ol type=\"a\">\r\n<li>tidak sesuai dengan persyaratan LPDP;</li>\r\n<li>tidak lengkap dengan persyaratan LPDP; dan/atau</li>\r\n<li>terdapat unsur pemalsuan dokumen.</li>\r\n</ol>\r\n</li>\r\n<li>Peserta yang melalukan pemalsuan data atau dokumen akan diberhentikan sebagai peserta atau penerima beasiswa dan dimasukan dalam daftar hitam (<em>bla</em><em>cklist</em>) pendaftar LPDP.</li>\r\n<li>Peserta mengikuti seleksi substansi berdasarkan lokasi yang dipilih saat pendaftaran.</li>\r\n<li>Seleksi substansi dilaksanakan oleh Tim Penyeleksi Beasiswa yang telah ditetapkan oleh LPDP.</li>\r\n<li>Hasil seleksi substansi dilaporkan kepada tim LPDP melalui rapat pleno Tim Penyeleksi Beasiswa.</li>\r\n<li>Hasil rapat pleno berupa daftar peserta yang direkomendasikan dan yang tidak direkomendasikan digunakan sebagai bahan pertimbangan pada rapat pleno penentuan kelulusan seleksi.</li>\r\n</ol>\r\n<p><strong>Penetapan Kelulusan</strong></p>\r\n<ol>\r\n<li>Penetapan kelulusan bersifat final, mutlak, rahasia dan tidak dapat diganggu gugat.</li>\r\n<li>Hasil penetapan kelulusan seleksi BPI Program Reguler disampaikan kepada calon penerima beasiswa melalui akun pendaftaran daring (<em>online</em>) masing-masing, email dan/atau media elektronik lainnya.</li>\r\n<li>Peserta yang tidak lulus seleksi substansi dapat mendaftar kembali seleksi Beasiswa Pendidikan Indonesia pada periode selanjutnya.</li>\r\n<li>Ketentuan lebih lanjut mengenai calon penerima beasiswa diatur melalui Peraturan Direktur Utama mengenai pedoman pelaksanaan studi.</li>\r\n<li>LPDP berwenang menetapkan kebijakan tentang waktu mulai studi yang diumumkan melalui website resmi LPDP.</li>\r\n</ol>', 1),
(7, '2018-11-10 02:26:42', '2018-11-10 02:26:42', 'Tokopedia scholarship', '2018-11-15', '<p>Tokopedia scholarship dikhususkan bagi mahasiswa S-1 semester 7 pada jurusan Ilmu Komputer, Sistem Informasi, Matematika, Statistika, Teknik Industri, dan Teknik Komputer, yang berprestasi di bidang akademik maupun non-akademik. Periode pendaftaran beasiswa tersebut antara 1 Oktober- 2 November 2018.</p>\r\n<p>Manfaat yang akan diberikan diantaranya biaya pendidikan selama 2 semester, biaya penunjang pendidikan (uang saku) selama 1 tahun, biaya wisuda, tunjangan buku perkuliahan, serta kesempatan magang di Tokopedia. Info Selengkapnya dapat di cek Tokopedia Scholarship.</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', '2018-10-11 14:26:06', '2018-10-11 14:26:06'),
(2, 'dosen', 'web', '2018-10-11 15:04:05', '2018-10-11 15:04:05'),
(3, 'mahasiswa', 'web', '2018-10-11 15:09:41', '2018-10-11 15:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(2, 3),
(3, 2),
(3, 3),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'profile.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$KaL3na2Fyu..fwlZW8CVJufGIARKUueHouZjVcMNIEdCFrLtfP91C', 'profile.jpg', 'XVYeAA2p41ugejLZR5jQyfctqibANOQWniNb3XPF1oC5eVIshoO3W4OZ4j0G', '2018-11-08 19:52:23', '2018-11-08 19:52:23'),
(2, 'Pak zaki', 'nawazaki@dosen.com', '$2y$10$QfubuNh8AmYKWN4vCIZuCuQ5vG9xfwNSYJujJAUmYEIuCIJ1blj/6', 'profile.jpg', 'doNpmaK6gd8mLBaE4nB6AYByvudnhvefEuwxZEwMt0HK30B9hcVAITWGhYOt', '2018-11-08 19:53:39', '2018-11-08 19:54:16'),
(3, 'Iqbal Nawazaki', 'iqbal@mahasiswa.com', '$2y$10$oliAKSpfJgtIUPI7cl/moOqq.ZyoSEUQcUuDpzjrdikbGsyVm5VTe', '3_avatar1541836598.png', 'gxjeMQNKGWzYCmYIUEZWIuQsNgClC9EEJUS8WQgclp70MT5nw0iC7TU3VLG3', '2018-11-08 19:54:38', '2018-11-10 00:56:38'),
(4, 'pareman kampus', 'pareman@portal.com', '$2y$10$0DtXsDJL7Uc1Q0AY5qQjc.AqICXTFdrWhu1f4u9QO.qD/vsvj5eOG', '4_avatar1541826310.png', 'NheHQ8e43W6m68BGRiASFk5OiF0aAI8sij5zoo1sJ02y0DKBLMDH6ChkU6NQ', '2018-11-08 19:56:05', '2018-11-09 22:05:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen_b_as`
--
ALTER TABLE `dokumen_b_as`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumen_b_as_periode_id_foreign` (`periode_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `periodes`
--
ALTER TABLE `periodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postingans`
--
ALTER TABLE `postingans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen_b_as`
--
ALTER TABLE `dokumen_b_as`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `periodes`
--
ALTER TABLE `periodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `postingans`
--
ALTER TABLE `postingans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen_b_as`
--
ALTER TABLE `dokumen_b_as`
  ADD CONSTRAINT `dokumen_b_as_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periodes` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
