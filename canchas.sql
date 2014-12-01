-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2014 at 12:18 AM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `canchas`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrador`
--

CREATE TABLE `administrador` (
`id` int(11) unsigned NOT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `deporte` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `attempts` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrador`
--

INSERT INTO `administrador` (`id`, `nombres`, `apellidos`, `correo`, `deporte`, `password`, `attempts`) VALUES
(1, 'juan', 'perez', 'admin@admin.com', 0, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(2, 'jose', 'lopez', '', 0, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(3, 'ana', 'Sanchez', '', 0, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(4, 'mario', 'Martinez', '', 0, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(5, 'miguel', 'Juarez', '', 0, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0);

-- --------------------------------------------------------

--
-- Table structure for table `arbitro`
--

CREATE TABLE `arbitro` (
`id` int(11) unsigned NOT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `arbitro`
--

INSERT INTO `arbitro` (`id`, `nombres`, `apellidos`, `telefono`, `correo`) VALUES
(1, 'daniel', 'perez', '8110291833', 'juanperez@gmail.com'),
(2, 'martin', 'garcia', '8183764233', 'martingarcia@gmail.com'),
(3, 'ana', 'garza', '8183252345', 'anagarza@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `asueto`
--

CREATE TABLE `asueto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cancha`
--

CREATE TABLE `cancha` (
`id` int(11) unsigned NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `tipo` int(11) unsigned DEFAULT NULL,
  `capacidad` int(11) unsigned DEFAULT NULL,
  `pasto` int(11) unsigned DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cancha`
--

INSERT INTO `cancha` (`id`, `nombre`, `tipo`, `capacidad`, `pasto`, `descripcion`, `ubicacion`) VALUES
(1, 'A', 1, 12, 1, 'futrapido', 'cdt'),
(2, 'B', 1, 12, 1, 'futrapido', 'cdt'),
(3, 'A', 2, 22, 2, 'fut11', 'cdt'),
(4, 'B', 2, 22, 2, 'fut11', 'cdt'),
(5, 'A', 3, 4, 2, 'besibol', 'cdt'),
(6, 'B', 3, 4, 2, 'beisbol', 'cdt'),
(7, 'A', 4, 10, 2, 'basket', 'cdt'),
(8, 'B', 4, 10, 2, 'basket', 'cdt');

-- --------------------------------------------------------

--
-- Table structure for table `cancha_deporte`
--

CREATE TABLE `cancha_deporte` (
`id` int(11) unsigned NOT NULL,
  `cancha` int(11) DEFAULT NULL,
  `deporte` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cancha_deporte`
--

INSERT INTO `cancha_deporte` (`id`, `cancha`, `deporte`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 2),
(5, 5, 3),
(6, 6, 3),
(7, 7, 4),
(8, 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `deporte`
--

CREATE TABLE `deporte` (
`id` int(11) unsigned NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deporte`
--

INSERT INTO `deporte` (`id`, `nombre`, `descripcion`) VALUES
(1, 'futrapido', 'futrapido'),
(2, 'fut11', 'fut11'),
(3, 'beisbol', 'beisbol'),
(4, 'basket', 'basket');

-- --------------------------------------------------------

--
-- Table structure for table `equipo`
--

CREATE TABLE `equipo` (
`id` int(11) unsigned NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `capitan` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipo`
--

INSERT INTO `equipo` (`id`, `nombre`, `capitan`) VALUES
(1, 'losrayos', 1),
(2, 'lostigres', 2),
(3, 'cruzazul', 3),
(4, 'america', 4),
(5, 'rioazul', 5),
(6, 'loschompiras', 6),
(7, 'malacopas', 7),
(8, 'traileros', 8),
(9, 'ingenieros', 9),
(10, 'mecatronicos', 10),
(11, 'laschivas', 11);

-- --------------------------------------------------------

--
-- Table structure for table `equipo_usuario`
--

CREATE TABLE `equipo_usuario` (
`id` int(11) unsigned NOT NULL,
  `equipo` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipo_usuario`
--

INSERT INTO `equipo_usuario` (`id`, `equipo`, `usuario`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10),
(11, 11, 11);

-- --------------------------------------------------------

--
-- Table structure for table `partido`
--

CREATE TABLE `partido` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hora_fin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cancha` int(11) NOT NULL,
  `local` int(11) NOT NULL,
  `visitante` int(11) NOT NULL,
  `arbitro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pasto`
--

CREATE TABLE `pasto` (
`id` int(11) unsigned NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pasto`
--

INSERT INTO `pasto` (`id`, `nombre`) VALUES
(1, 'Sintetico'),
(2, 'Natural');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_cancha`
--

CREATE TABLE `tipo_cancha` (
`id` int(11) unsigned NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_cancha`
--

INSERT INTO `tipo_cancha` (`id`, `nombre`) VALUES
(1, 'Fútbol rápido'),
(2, 'Fútbol 11'),
(3, 'Beisból'),
(4, 'Basquetbol');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
`id` int(11) unsigned NOT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `emergencia` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `attempts` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombres`, `apellidos`, `correo`, `telefono`, `emergencia`, `password`, `attempts`) VALUES
(1, 'mario', 'garcia', 'mariogarcia@gmail.com', '8110291834', '8110291834', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(2, 'pedro', 'garcia', 'pedrogarcia@gmail.com', '8110291835', '8110291835', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(3, 'juan', 'garcia', 'juangarcia@gmail.com', '8110291836', '8110291836', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(4, 'jose', 'garcia', 'ramirogarcia@gmail.com', '8110291837', '8110291837', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(5, 'ramiro', 'garcia', 'josegarcia@gmail.com', '8110291838', '8110291838', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(6, 'hector', 'garcia', 'hectorgarcia@gmail.com', '8110291839', '8110291839', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(7, 'javier', 'garcia', 'javiergarcia@gmail.com', '8110291840', '8110291840', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(8, 'jesus', 'garcia', 'jesusgarcia@gmail.com', '8110291841', '8110291841', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(9, 'luis', 'garcia', 'luisgarcia@gmail.com', '8110291842', '8110291842', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(10, 'edgar', 'garcia', 'edgargarcia@gmail.com', '8110291843', '8110291843', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(11, 'sergio', 'garcia', 'sergiogarcia@gmail.com', '8110291844', '8110291844', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(12, 'Héctor Alfonso', 'Gómez REyes', 'hector.agr@gmail.com', '7134770807', '7134770807', '6ffa714fc22f2a6fe491f0ff209713a661e0eba1', NULL),
(13, 'Héctor Alfonso', 'Gómez REyes', 'hector.agr@gmail.com', '7134770807', '7134770807', '6ffa714fc22f2a6fe491f0ff209713a661e0eba1', NULL),
(14, 'Héctor Alfonso', 'Gómez Reyes', 'hector.agr@gmail.com', '7134770807', '7134770807', '356a192b7913b04c54574d18c28d46e6395428ab', NULL),
(15, 'test', 'test', 'test@test.com', '1234', '1234', '356a192b7913b04c54574d18c28d46e6395428ab', NULL),
(16, 'test', 'test', 'test@test.com', '1212', '1212', '356a192b7913b04c54574d18c28d46e6395428ab', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arbitro`
--
ALTER TABLE `arbitro`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asueto`
--
ALTER TABLE `asueto`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancha`
--
ALTER TABLE `cancha`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancha_deporte`
--
ALTER TABLE `cancha_deporte`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deporte`
--
ALTER TABLE `deporte`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipo`
--
ALTER TABLE `equipo`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipo_usuario`
--
ALTER TABLE `equipo_usuario`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partido`
--
ALTER TABLE `partido`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasto`
--
ALTER TABLE `pasto`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_cancha`
--
ALTER TABLE `tipo_cancha`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrador`
--
ALTER TABLE `administrador`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `arbitro`
--
ALTER TABLE `arbitro`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cancha`
--
ALTER TABLE `cancha`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `cancha_deporte`
--
ALTER TABLE `cancha_deporte`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `deporte`
--
ALTER TABLE `deporte`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `equipo`
--
ALTER TABLE `equipo`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `equipo_usuario`
--
ALTER TABLE `equipo_usuario`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pasto`
--
ALTER TABLE `pasto`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipo_cancha`
--
ALTER TABLE `tipo_cancha`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;