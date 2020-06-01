-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2020 at 03:51 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_ins_grado_has_asignatura_after_Ano_has_Periodo` (IN `periodo` INT)  BEGIN
	declare resta INT;
	declare consulta INT;
	SET consulta= (SELECT COUNT(ano_per_id) FROM Grado_has_Asignatura WHERE ano_per_id = (SELECT ano_per_id FROM Grado_has_Asignatura ORDER BY ano_per_id DESC LIMIT 1));
	SET resta = 0;
	WHILE consulta-resta>=0 DO
		INSERT INTO Grado_has_Asignatura (gra_id,asi_id,ano_per_id) SELECT gra_id,asi_id,periodo FROM Grado_has_Asignatura WHERE gra_asi_id =(SELECT gra_asi_id-resta FROM Grado_has_Asignatura ORDER BY ano_per_id DESC LIMIT 1);
		SET resta = resta+1;
	END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ano`
--

CREATE TABLE `ano` (
  `ano_id` int(11) NOT NULL,
  `ano_nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ano`
--

INSERT INTO `ano` (`ano_id`, `ano_nombre`) VALUES
(1, '2020'),
(2, '2021'),
(3, '2022'),
(4, '2023');

-- --------------------------------------------------------

--
-- Table structure for table `ano_has_periodo`
--

CREATE TABLE `ano_has_periodo` (
  `ano_per_id` int(11) NOT NULL,
  `per_id` int(11) NOT NULL,
  `ano_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ano_has_periodo`
--

INSERT INTO `ano_has_periodo` (`ano_per_id`, `per_id`, `ano_id`) VALUES
(1, 2, 2),
(2, 3, 2),
(3, 4, 2),
(7, 8, 2),
(10, 11, 3),
(11, 12, 3),
(13, 14, 3),
(14, 15, 3),
(15, 16, 4),
(16, 17, 4),
(17, 18, 4);

--
-- Triggers `ano_has_periodo`
--
DELIMITER $$
CREATE TRIGGER `trig_ano_has_periodo_insert_asignatura` AFTER INSERT ON `ano_has_periodo` FOR EACH ROW BEGIN
	CALL proc_ins_grado_has_asignatura_after_Ano_has_Periodo(NEW.ano_per_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `asignatura`
--

CREATE TABLE `asignatura` (
  `asi_id` int(10) NOT NULL,
  `mat_id` int(10) NOT NULL,
  `asi_nombre` varchar(100) NOT NULL,
  `asi_rotativo` tinyint(1) NOT NULL,
  `asi_estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asignatura`
--

INSERT INTO `asignatura` (`asi_id`, `mat_id`, `asi_nombre`, `asi_rotativo`, `asi_estado`) VALUES
(1, 1, 'Religion', 0, 1),
(2, 1, 'Etica', 0, 1),
(3, 3, 'Sociales', 0, 1),
(4, 3, 'Democracia', 0, 1),
(5, 3, 'Economia', 0, 1),
(6, 4, 'Castellano y Literatura', 0, 1),
(7, 5, 'Ingles', 0, 1),
(8, 6, 'Matematicas', 0, 1),
(9, 6, 'Algebra', 0, 1),
(10, 6, 'Geometria', 0, 1),
(11, 6, 'Trigonometria', 0, 1),
(12, 6, 'Calculo', 0, 1),
(13, 2, 'Fisica', 0, 1),
(14, 2, 'Quimica', 0, 1),
(15, 2, 'Biologia', 0, 1),
(16, 2, 'Ciencias Naturales', 0, 1),
(17, 7, 'Educacion Fisica', 0, 1),
(18, 8, 'Arte', 0, 1),
(19, 8, 'Musica', 0, 1),
(20, 8, 'Programacion', 0, 1),
(21, 8, 'Teatro', 0, 1),
(22, 8, 'Cine', 0, 1),
(23, 8, 'Robotica', 0, 1),
(24, 8, 'Medios Digitales', 0, 1),
(25, 8, 'Taller de Escritura', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cargo`
--

CREATE TABLE `cargo` (
  `car_id` int(11) NOT NULL,
  `car_nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cargo`
--

INSERT INTO `cargo` (`car_id`, `car_nombre`) VALUES
(1, 'Estudiante'),
(2, 'Profesor');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `cur_id` int(11) NOT NULL,
  `cur_nombre` varchar(45) NOT NULL,
  `cur_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`cur_id`, `cur_nombre`, `cur_estado`) VALUES
(1, 'A', 1),
(2, 'B', 1),
(3, 'C', 1);

-- --------------------------------------------------------

--
-- Table structure for table `curso_has_grado`
--

CREATE TABLE `curso_has_grado` (
  `cur_gra_id` int(11) NOT NULL,
  `cur_id` int(11) NOT NULL,
  `gra_id` int(11) NOT NULL,
  `cur_gra_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `curso_has_grado`
--

INSERT INTO `curso_has_grado` (`cur_gra_id`, `cur_id`, `gra_id`, `cur_gra_estado`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 1, 2, 1),
(5, 2, 2, 1),
(6, 3, 2, 1),
(7, 1, 3, 1),
(8, 2, 3, 1),
(9, 3, 3, 1),
(10, 1, 4, 1),
(11, 2, 4, 1),
(12, 3, 4, 1),
(13, 1, 5, 1),
(14, 2, 5, 1),
(15, 3, 5, 1),
(16, 1, 6, 1),
(17, 2, 6, 1),
(18, 3, 6, 1),
(19, 1, 7, 1),
(20, 2, 7, 1),
(21, 3, 7, 1),
(22, 1, 8, 1),
(23, 2, 8, 1),
(24, 3, 8, 1),
(25, 1, 9, 1),
(26, 2, 9, 1),
(27, 3, 9, 1),
(28, 1, 10, 1),
(29, 2, 10, 1),
(30, 3, 10, 1),
(31, 1, 11, 1),
(32, 2, 11, 1),
(33, 3, 11, 1),
(34, 1, 12, 1),
(35, 2, 12, 1),
(36, 3, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `grado`
--

CREATE TABLE `grado` (
  `gra_id` int(11) NOT NULL,
  `gra_nombre` varchar(45) NOT NULL,
  `niv_id` int(11) NOT NULL,
  `gra_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grado`
--

INSERT INTO `grado` (`gra_id`, `gra_nombre`, `niv_id`, `gra_estado`) VALUES
(1, 'Transicion', 3, 1),
(2, 'Once', 1, 1),
(3, 'Decimo', 1, 1),
(4, 'Noveno', 1, 1),
(5, 'Octavo', 2, 1),
(6, 'Septimo', 2, 1),
(7, 'Sexto', 2, 1),
(8, 'Quinto', 3, 1),
(9, 'Cuarto', 3, 1),
(10, 'Tercero', 3, 1),
(11, 'Segundo', 3, 1),
(12, 'Primero', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `grado_has_asignatura`
--

CREATE TABLE `grado_has_asignatura` (
  `gra_asi_id` int(11) NOT NULL,
  `gra_id` int(11) NOT NULL,
  `asi_id` int(11) NOT NULL,
  `ano_per_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grado_has_asignatura`
--

INSERT INTO `grado_has_asignatura` (`gra_asi_id`, `gra_id`, `asi_id`, `ano_per_id`) VALUES
(173, 1, 1, 1),
(174, 1, 6, 1),
(175, 1, 3, 1),
(176, 1, 7, 1),
(177, 1, 8, 1),
(178, 1, 16, 1),
(179, 1, 17, 1),
(180, 1, 18, 1),
(181, 1, 19, 1),
(182, 12, 1, 1),
(183, 12, 6, 1),
(184, 12, 7, 1),
(185, 12, 8, 1),
(186, 12, 16, 1),
(187, 12, 17, 1),
(188, 12, 18, 1),
(189, 12, 19, 1),
(190, 11, 1, 1),
(191, 11, 6, 1),
(192, 11, 3, 1),
(193, 12, 3, 1),
(194, 11, 7, 1),
(195, 11, 8, 1),
(196, 11, 16, 1),
(197, 11, 17, 1),
(198, 11, 18, 1),
(199, 11, 19, 1),
(200, 10, 1, 1),
(201, 10, 6, 1),
(202, 10, 3, 1),
(203, 10, 7, 1),
(204, 10, 8, 1),
(205, 10, 16, 1),
(206, 10, 17, 1),
(207, 10, 18, 1),
(208, 10, 19, 1),
(209, 9, 1, 1),
(210, 9, 6, 1),
(211, 9, 3, 1),
(212, 9, 7, 1),
(213, 9, 8, 1),
(214, 9, 16, 1),
(215, 9, 17, 1),
(216, 9, 18, 1),
(217, 9, 19, 1),
(218, 8, 1, 1),
(219, 8, 6, 1),
(220, 8, 3, 1),
(221, 8, 7, 1),
(222, 8, 8, 1),
(223, 8, 16, 1),
(224, 8, 17, 1),
(225, 8, 18, 1),
(226, 8, 19, 1),
(227, 7, 1, 1),
(228, 7, 3, 1),
(229, 7, 6, 1),
(230, 7, 7, 1),
(231, 7, 8, 1),
(232, 7, 16, 1),
(233, 7, 17, 1),
(234, 7, 18, 1),
(235, 7, 19, 1),
(236, 7, 20, 1),
(237, 7, 21, 1),
(238, 7, 22, 1),
(239, 7, 23, 1),
(240, 7, 24, 1),
(241, 7, 25, 1),
(242, 6, 1, 1),
(243, 6, 3, 1),
(244, 6, 6, 1),
(245, 6, 7, 1),
(246, 6, 8, 1),
(247, 6, 16, 1),
(248, 6, 17, 1),
(249, 6, 18, 1),
(250, 6, 19, 1),
(251, 6, 20, 1),
(252, 6, 21, 1),
(253, 6, 22, 1),
(254, 6, 23, 1),
(255, 6, 24, 1),
(256, 6, 25, 1),
(257, 5, 1, 1),
(258, 5, 3, 1),
(259, 5, 6, 1),
(260, 5, 7, 1),
(261, 5, 17, 1),
(262, 5, 18, 1),
(263, 5, 19, 1),
(264, 5, 20, 1),
(265, 5, 21, 1),
(266, 5, 22, 1),
(267, 5, 23, 1),
(268, 5, 24, 1),
(269, 5, 25, 1),
(270, 4, 1, 1),
(271, 4, 3, 1),
(272, 4, 6, 1),
(273, 4, 7, 1),
(274, 4, 17, 1),
(275, 4, 18, 1),
(276, 4, 19, 1),
(277, 4, 20, 1),
(278, 4, 21, 1),
(279, 4, 22, 1),
(280, 4, 23, 1),
(281, 4, 24, 1),
(282, 4, 25, 1),
(283, 3, 1, 1),
(284, 3, 3, 1),
(285, 3, 6, 1),
(286, 3, 7, 1),
(287, 3, 17, 1),
(288, 3, 18, 1),
(289, 3, 19, 1),
(290, 3, 20, 1),
(291, 3, 21, 1),
(292, 3, 22, 1),
(293, 3, 23, 1),
(294, 3, 24, 1),
(295, 3, 25, 1),
(296, 2, 1, 1),
(297, 2, 3, 1),
(298, 2, 6, 1),
(299, 2, 7, 1),
(300, 2, 17, 1),
(301, 2, 18, 1),
(302, 2, 19, 1),
(303, 2, 20, 1),
(304, 2, 21, 1),
(305, 2, 22, 1),
(306, 2, 23, 1),
(307, 2, 24, 1),
(308, 2, 25, 1),
(309, 5, 9, 1),
(310, 5, 10, 1),
(311, 5, 16, 1),
(312, 4, 9, 1),
(313, 4, 10, 1),
(314, 4, 13, 1),
(315, 4, 14, 1),
(316, 4, 15, 1),
(317, 3, 2, 1),
(318, 3, 4, 1),
(319, 3, 5, 1),
(320, 3, 11, 1),
(321, 3, 13, 1),
(322, 3, 14, 1),
(323, 3, 15, 1),
(324, 2, 2, 1),
(325, 2, 4, 1),
(326, 2, 12, 1),
(327, 2, 13, 1),
(328, 2, 14, 1),
(329, 1, 2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `materia`
--

CREATE TABLE `materia` (
  `mat_id` int(11) NOT NULL,
  `mat_nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materia`
--

INSERT INTO `materia` (`mat_id`, `mat_nombre`) VALUES
(1, 'Educacion Religiosa'),
(2, 'Ciencias Naturales'),
(3, 'Ciencias Sociales'),
(4, 'Castellano y Literatura'),
(5, 'Ingles'),
(6, 'Matematicas'),
(7, 'Educacion Fisica'),
(8, 'Educacion Estetica');

-- --------------------------------------------------------

--
-- Table structure for table `nivel`
--

CREATE TABLE `nivel` (
  `niv_id` int(11) NOT NULL,
  `niv_nombre` varchar(100) NOT NULL,
  `niv_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nivel`
--

INSERT INTO `nivel` (`niv_id`, `niv_nombre`, `niv_estado`) VALUES
(1, 'Educacion Superior', 1),
(2, 'Educacion Media', 1),
(3, 'Educacion Baja', 1);

-- --------------------------------------------------------

--
-- Table structure for table `periodo`
--

CREATE TABLE `periodo` (
  `per_id` int(11) NOT NULL,
  `per_nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periodo`
--

INSERT INTO `periodo` (`per_id`, `per_nombre`) VALUES
(1, 'Primer Bimestre'),
(2, 'Segundo Bimestre'),
(3, 'Tercer Bimestre'),
(4, 'Cuarto Bimestre'),
(8, 'Primer Bimestre'),
(11, 'Primer Bimestre'),
(12, 'Segundo Bimestre'),
(14, 'Tercer Bimestre'),
(15, 'Cuarto Bimestre'),
(16, 'Primer Bimestre'),
(17, 'Segundo Bimestre'),
(18, 'Tercer Bimestre');

--
-- Triggers `periodo`
--
DELIMITER $$
CREATE TRIGGER `trig_ano_has_periodo_insert` AFTER INSERT ON `periodo` FOR EACH ROW BEGIN
	declare id INT;
	SET id = (SELECT ano_id FROM ano ORDER BY ano_id DESC LIMIT 1);
	INSERT INTO Ano_has_Periodo(`per_id`,`ano_id`) VALUES(NEW.per_id,id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `permiso`
--

CREATE TABLE `permiso` (
  `perm_id` int(11) NOT NULL,
  `perm_nom` varchar(45) NOT NULL,
  `perm_descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permiso`
--

INSERT INTO `permiso` (`perm_id`, `perm_nom`, `perm_descripcion`) VALUES
(1, 'Ingreso Pagina Inicio', NULL),
(2, 'Ingreso Pagina Año', NULL),
(3, 'Ingreso Pagina Asignacion Materia', NULL),
(4, 'Ingreso Pagina Cargos', NULL),
(5, 'Ingreso Pagina Distribucion', NULL),
(6, 'Ingreso Pagina Persona', NULL),
(7, 'Ingreso Pagina Perfil', NULL),
(8, 'Ingreso Pagina Ver Materias', NULL),
(9, 'Ingreso Pagina Cambiar Contrasena', NULL),
(10, 'Ingreso Pagina Cambiar Informacion Personal', NULL),
(11, 'Pagina Perfil Cambiar informacion', 'Campo Nombre'),
(12, 'Pagina Perfil Cambiar informacion', 'Campo Apellido'),
(13, 'Pagina Perfil Cambiar informacion', 'Campo Imagen'),
(14, 'Pagina Perfil Cambiar informacion', 'Campo Identificacion'),
(15, 'Pagina Perfil Cambiar informacion', 'Campo Telefono'),
(16, 'Pagina Perfil Cambiar informacion', 'Campo Celular'),
(17, 'Pagina Perfil Cambiar informacion', 'Campo Correo'),
(18, 'Pagina Perfil Cambiar informacion', 'Campo Direccion'),
(19, 'Pagina Perfil Cambiar informacion', 'Campo Pais'),
(20, 'Pagina Perfil Cambiar informacion', 'Campo Ciudad'),
(21, 'Pagina Perfil Cambiar informacion', 'Campo Nacimiento '),
(22, 'Pagina Perfil Cambiar informacion', 'Campo Tipo Documento'),
(23, 'Pagina Perfil Cambiar informacion', 'Campo Actualizar');

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `per_id` int(11) NOT NULL,
  `per_nombre` varchar(45) NOT NULL,
  `per_apellido` varchar(45) NOT NULL,
  `per_identificacion` varchar(45) NOT NULL,
  `per_telefono` int(11) NOT NULL,
  `per_celular` int(110) DEFAULT NULL,
  `per_correo` varchar(45) NOT NULL,
  `per_codigo` int(11) NOT NULL,
  `per_direccion` varchar(45) NOT NULL,
  `per_pais` varchar(45) NOT NULL,
  `per_ciudad` varchar(45) NOT NULL,
  `per_nacimiento` date NOT NULL,
  `per_ingreso` date NOT NULL,
  `per_grado` int(11) DEFAULT NULL,
  `per_contrasena` varchar(45) NOT NULL,
  `per_tipo_documento` varchar(100) NOT NULL,
  `per_imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`per_id`, `per_nombre`, `per_apellido`, `per_identificacion`, `per_telefono`, `per_celular`, `per_correo`, `per_codigo`, `per_direccion`, `per_pais`, `per_ciudad`, `per_nacimiento`, `per_ingreso`, `per_grado`, `per_contrasena`, `per_tipo_documento`, `per_imagen`) VALUES
(1, 'Hamed', 'Mohseni', '1020847034', 8851848, 21474835, 'hamedmohseni@hotmail.com', 111, 'Hacienda Fontanar', 'Iran', 'Tehran', '1999-03-27', '2020-05-25', NULL, '739b7af086e8c8873d6c8c7378f224c8', 'Cedula Ciudadania', 'Jellyfish.jpg'),
(2, 'Nilson', 'Gomez', '12345', 0, 1422, 'njgomez@unal.edu.co', 1, 'Bosa', 'Colombia', 'Bogota', '2113-04-23', '0000-00-00', 2032, '9c405163c4de5cf5d7f0deb741a7e27e', '', ''),
(49, 'felipe', 'riaño', '198', 1, 1, 'hamedmohseni@hotmail.com', 1, '1', '1', '1', '1111-11-11', '2020-05-30', NULL, 'c4ca4238a0b923820dcc509a6f75849b', 'Pasaporte', 'Koala.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `persona_has_cargo`
--

CREATE TABLE `persona_has_cargo` (
  `per_car_id` int(11) NOT NULL,
  `per_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persona_has_cargo`
--

INSERT INTO `persona_has_cargo` (`per_car_id`, `per_id`, `car_id`) VALUES
(1, 1, 2),
(2, 2, 1),
(13, 49, 1);

-- --------------------------------------------------------

--
-- Table structure for table `persona_has_permiso`
--

CREATE TABLE `persona_has_permiso` (
  `per_perm_id` int(11) NOT NULL,
  `per_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL,
  `per_perm_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persona_has_permiso`
--

INSERT INTO `persona_has_permiso` (`per_perm_id`, `per_id`, `perm_id`, `per_perm_estado`) VALUES
(1, 1, 6, 1),
(2, 2, 6, 0),
(3, 1, 7, 1),
(6, 1, 1, 1),
(7, 1, 2, 1),
(8, 1, 3, 1),
(9, 1, 4, 1),
(10, 1, 5, 1),
(11, 1, 8, 1),
(12, 2, 1, 0),
(13, 2, 2, 0),
(14, 2, 3, 0),
(15, 2, 4, 0),
(16, 2, 5, 0),
(17, 2, 7, 0),
(18, 2, 8, 0),
(21, 49, 7, 1),
(22, 1, 9, 1),
(23, 1, 10, 1),
(24, 2, 9, 0),
(25, 2, 10, 0),
(26, 1, 11, 1),
(27, 1, 12, 1),
(28, 1, 13, 1),
(29, 1, 14, 1),
(30, 1, 15, 1),
(31, 1, 16, 1),
(32, 1, 17, 1),
(33, 1, 18, 1),
(34, 1, 19, 1),
(35, 1, 20, 1),
(36, 1, 21, 1),
(37, 1, 22, 1),
(38, 1, 23, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ano`
--
ALTER TABLE `ano`
  ADD PRIMARY KEY (`ano_id`);

--
-- Indexes for table `ano_has_periodo`
--
ALTER TABLE `ano_has_periodo`
  ADD PRIMARY KEY (`ano_per_id`,`per_id`,`ano_id`),
  ADD KEY `fk_Ano_has_Periodo_Periodo1_idx` (`per_id`),
  ADD KEY `fk_Ano_has_Periodo_Ano1_idx` (`ano_id`);

--
-- Indexes for table `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`asi_id`),
  ADD KEY `mat_id` (`mat_id`);

--
-- Indexes for table `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cur_id`);

--
-- Indexes for table `curso_has_grado`
--
ALTER TABLE `curso_has_grado`
  ADD PRIMARY KEY (`cur_gra_id`,`cur_id`,`gra_id`),
  ADD KEY `fk_Curso_has_Grado_Curso1` (`cur_id`),
  ADD KEY `fk_Curso_has_Grado_Grado1` (`gra_id`);

--
-- Indexes for table `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`gra_id`,`niv_id`),
  ADD KEY `fk_Grado_Nivel` (`niv_id`);

--
-- Indexes for table `grado_has_asignatura`
--
ALTER TABLE `grado_has_asignatura`
  ADD PRIMARY KEY (`gra_asi_id`,`gra_id`,`asi_id`,`ano_per_id`),
  ADD KEY `fk_Grado_has_Asignatura_Grado1` (`gra_id`),
  ADD KEY `fk_Grado_has_Asignatura_Asignatura1` (`asi_id`),
  ADD KEY `fk_Grado_has_Asignatura_Ano_has_Periodo1_idx` (`ano_per_id`);

--
-- Indexes for table `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`mat_id`);

--
-- Indexes for table `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`niv_id`);

--
-- Indexes for table `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`per_id`);

--
-- Indexes for table `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`perm_id`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`per_id`);

--
-- Indexes for table `persona_has_cargo`
--
ALTER TABLE `persona_has_cargo`
  ADD PRIMARY KEY (`per_car_id`,`per_id`,`car_id`),
  ADD KEY `fk_Persona_has_Cargo_Cargo1_idx` (`car_id`),
  ADD KEY `fk_Persona_has_Cargo_Persona1_idx` (`per_id`);

--
-- Indexes for table `persona_has_permiso`
--
ALTER TABLE `persona_has_permiso`
  ADD PRIMARY KEY (`per_perm_id`,`per_id`,`perm_id`),
  ADD KEY `fk_Persona_has_Permiso_Permiso1_idx` (`perm_id`),
  ADD KEY `fk_Persona_has_Permiso_Persona1_idx` (`per_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ano`
--
ALTER TABLE `ano`
  MODIFY `ano_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ano_has_periodo`
--
ALTER TABLE `ano_has_periodo`
  MODIFY `ano_per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `asi_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `cur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `curso_has_grado`
--
ALTER TABLE `curso_has_grado`
  MODIFY `cur_gra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `grado`
--
ALTER TABLE `grado`
  MODIFY `gra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `grado_has_asignatura`
--
ALTER TABLE `grado_has_asignatura`
  MODIFY `gra_asi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=330;
--
-- AUTO_INCREMENT for table `materia`
--
ALTER TABLE `materia`
  MODIFY `mat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `nivel`
--
ALTER TABLE `nivel`
  MODIFY `niv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `periodo`
--
ALTER TABLE `periodo`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `permiso`
--
ALTER TABLE `permiso`
  MODIFY `perm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `persona_has_cargo`
--
ALTER TABLE `persona_has_cargo`
  MODIFY `per_car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `persona_has_permiso`
--
ALTER TABLE `persona_has_permiso`
  MODIFY `per_perm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ano_has_periodo`
--
ALTER TABLE `ano_has_periodo`
  ADD CONSTRAINT `fk_Ano_has_Periodo_Ano1` FOREIGN KEY (`ano_id`) REFERENCES `ano` (`ano_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ano_has_Periodo_Periodo1` FOREIGN KEY (`per_id`) REFERENCES `periodo` (`per_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `fk_Asignatura_Materia` FOREIGN KEY (`mat_id`) REFERENCES `materia` (`mat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `curso_has_grado`
--
ALTER TABLE `curso_has_grado`
  ADD CONSTRAINT `fk_Curso_has_Grado_Curso1` FOREIGN KEY (`cur_id`) REFERENCES `curso` (`cur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Curso_has_Grado_Grado1` FOREIGN KEY (`gra_id`) REFERENCES `grado` (`gra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grado`
--
ALTER TABLE `grado`
  ADD CONSTRAINT `fk_Grado_Nivel` FOREIGN KEY (`niv_id`) REFERENCES `nivel` (`niv_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grado_has_asignatura`
--
ALTER TABLE `grado_has_asignatura`
  ADD CONSTRAINT `fk_Grado_has_Asignatura_Ano_has_Periodo1` FOREIGN KEY (`ano_per_id`) REFERENCES `ano_has_periodo` (`ano_per_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Grado_has_Asignatura_Asignatura1` FOREIGN KEY (`asi_id`) REFERENCES `asignatura` (`asi_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Grado_has_Asignatura_Grado1` FOREIGN KEY (`gra_id`) REFERENCES `grado` (`gra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `persona_has_cargo`
--
ALTER TABLE `persona_has_cargo`
  ADD CONSTRAINT `fk_Persona_has_Cargo_Cargo1` FOREIGN KEY (`car_id`) REFERENCES `cargo` (`car_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Persona_has_Cargo_Persona1` FOREIGN KEY (`per_id`) REFERENCES `persona` (`per_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `persona_has_permiso`
--
ALTER TABLE `persona_has_permiso`
  ADD CONSTRAINT `fk_Persona_has_Permiso_Permiso1` FOREIGN KEY (`perm_id`) REFERENCES `permiso` (`perm_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Persona_has_Permiso_Persona1` FOREIGN KEY (`per_id`) REFERENCES `persona` (`per_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
