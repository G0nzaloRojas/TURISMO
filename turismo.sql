-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2025 a las 04:13:57
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `turismo`
--
CREATE DATABASE IF NOT EXISTS `turismo` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `turismo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `ID` int(2) NOT NULL,
  `DESCRIPCION` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`ID`, `DESCRIPCION`) VALUES
(1, 'Cultural'),
(2, 'Entretenimiento'),
(3, 'Naturaleza'),
(4, 'Vida Nocturna'),
(5, 'Shopping'),
(6, 'Monumento'),
(7, 'Centros Religiosos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquiler`
--

CREATE TABLE `alquiler` (
  `ID` int(10) NOT NULL,
  `NOMBRE` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `UBICACION` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `PRECIO_SEMANA` int(8) NOT NULL,
  `CALIFICACION` int(2) NOT NULL,
  `BANIOS` int(2) NOT NULL,
  `DORMITORIOS` int(2) NOT NULL,
  `CAMAS_DOBLES` int(2) NOT NULL,
  `CAMAS_SIMPLES` int(2) NOT NULL,
  `METROS` int(4) NOT NULL,
  `DESCRIPCION` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `id_usuario` int(5) DEFAULT NULL,
  `FOTO_URL` varchar(255) DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alquiler`
--

INSERT INTO `alquiler` (`ID`, `NOMBRE`, `UBICACION`, `PRECIO_SEMANA`, `CALIFICACION`, `BANIOS`, `DORMITORIOS`, `CAMAS_DOBLES`, `CAMAS_SIMPLES`, `METROS`, `DESCRIPCION`, `id_usuario`, `FOTO_URL`, `URL`) VALUES
(33, 'OWN Palermo', '3088 French, Recoleta, Buenos Aires', 559000, 9, 1, 1, 1, 0, 32, 'Departamento', 26, 'alquiler_685d50b6cbab1.png', 'ownpalermo@email.com'),
(34, 'Casa Sur', 'Viamonte 540 1, Buenos Aires', 264826, 7, 1, 1, 1, 1, 40, 'Casa', 26, 'alquiler_685d4f8064137.png', 'casasur.alquileres@email.com'),
(35, 'Centro Porteño', 'Avenida Corrientes 820 7, Buenos Aires', 247820, 7, 1, 1, 1, 1, 25, 'Departamento', 26, 'alquiler_685d4fb2d91e9.png', 'centroporteno@email.com'),
(36, 'Departamento Downtown Buenos Aires', '697 Esmeralda, Buenos Aires', 272977, 10, 1, 1, 1, 0, 39, 'Departamento', 26, 'alquiler_685d4f8f68939.png', 'depto.downtownba@email.com'),
(37, 'Great Apartment in Recoleta', '1626 Junín, Recoleta, Buenos Aires', 642834, 9, 2, 2, 1, 2, 80, 'Departamento', 26, 'alquiler_685d4ff9db182.png', 'greataptrecoleta@email.com'),
(38, 'A & E Buenos Aires', 'Tucumán 425, Buenos Aires', 1589383, 9, 2, 2, 2, 0, 90, 'Departamento', 26, 'alquiler_685d4ed262903.png', 'aande.buenosaires@email.com'),
(39, 'Top Rentals Palermo Hollywood', '6066 Gorriti, Palermo, Buenos Aires', 1179828, 9, 2, 2, 1, 1, 32, 'Departamento', 26, 'alquiler_685d505fae5a7.png', 'toprentals.palermohollywood@email.com'),
(40, 'H5063', 'Soler 5063, Palermo, Buenos Aires', 875672, 8, 1, 1, 1, 0, 36, 'Departamento', 26, 'alquiler_685d50104122f.png', 'h5063.rent@email.com'),
(41, 'Fliphaus Sohoglam - Lux Aparts Palermo Soho', 'Aráoz 1935, Palermo, Buenos Aires', 686793, 8, 2, 2, 0, 6, 90, 'Departamento', 26, 'alquiler_685d4fc647507.png', 'fliphauapalermosoho@email.com'),
(42, 'Departamento Vintage', '3884 Avenida Corrientes, Almagro, Buenos Aires', 674738, 9, 2, 2, 1, 2, 50, 'Departamento', 26, 'alquiler_685d4fa131c5e.png', 'departamentovintage@email.com'),
(43, 'Barrancas de Madero', '1458 Avenida Paseo Colón, San Telmo, Buenos Aires', 1041263, 10, 1, 1, 1, 1, 89, 'Departamento', 26, 'alquiler_685d4f182b6cd.png', 'barrancasdemadero@email.com'),
(45, 'Optimus BA | Arenales', 'Arenales 1242, piso 3, dpto. E, Retiro, Buenos Aires', 533126, 9, 2, 2, 1, 4, 70, 'Casa', 27, 'alquiler_685d50a4d77be.png', 'optimusba.arenales@email.com'),
(46, 'RECOLETA VINTAGE - 5 PAX-', '2437 Juncal, Recoleta, Buenos Aires', 920476, 10, 2, 3, 1, 3, 80, 'Departamento', 27, 'alquiler_685d507e97316.png', 'recoletavintage5pax@email.com'),
(47, 'Stay in Palermo', '1125 Bulnes, Almagro, Buenos Aires', 1638650, 9, 1, 2, 1, 3, 60, 'Departamento', 27, 'alquiler_685d506fc1133.png', 'stayinpalermo@email.com'),
(48, 'Amplio Ideal Familias en Palermo Cerca de Parques', '2760 Avenida Coronel Díaz, Palermo, Buenos Aires', 1426827, 10, 2, 4, 2, 4, 130, 'Casa', 27, 'alquiler_685d4ef9f0ae2.png', 'amplioideal.palermo@email.com'),
(49, 'Casa Alma', 'Costa Rica 4520, Palermo, Buenos Aires', 1870000, 9, 3, 5, 5, 2, 400, 'Casa', 27, 'alquiler_685d4f5271424.png', 'casaalma.ba@email.com'),
(50, 'Casa Palermo Soho. 2 pisos, terraza 360°, piscina y parrilla', '1476 Gascón, Palermo, Buenos Aires', 2109991, 10, 3, 5, 1, 8, 280, 'Casa', 27, 'alquiler_685d4f7082472.png', 'casapalermo.soho@email.com'),
(51, 'Howard Johnson Plaza by Wyndham Buenos Aires Florida Street', 'Florida 944, Buenos Aires', 2213427, 8, 2, 2, 1, 5, 110, 'Casa', 27, 'alquiler_685d504626a64.png', 'howardjohnson.plaza.buenosaires@email.com'),
(52, 'Mansion Mitre \'A\' - 3 Luxury Aparts National Congress', 'Bartolomé Mitre 1829, Balvanera, Buenos Aires', 2034556, 9, 4, 3, 2, 6, 300, 'Departamento', 27, 'alquiler_685d5094ce4f7.png', 'mansionmitre.alquiler@email.com'),
(53, 'Habitaciones Temporarias CABA', 'Salta 637 , Montserrat, Buenos Aires', 327914, 8, 3, 1, 1, 0, 105, 'Departamento', 27, 'alquiler_685d5033bbfb5.png', 'habitaciones.temporarias.caba@email.com'),
(54, 'ARC Callao Studios & Suites', 'Viamonte 1815, Balvanera, Buenos Aires', 964704, 9, 3, 3, 1, 2, 128, 'Departamento', 27, 'alquiler_685d4f07279f7.png', 'arc.callao.studios@email.com'),
(55, 'Art house apartments', 'Charcas 5006, Palermo, Buenos Aires', 2503962, 8, 4, 5, 4, 10, 350, 'Departamento', 27, 'alquiler_685d4f3943e92.png', 'arthouseapartments@email.com'),
(56, 'Art House terraza,parrilla en Palermo con desayuno', 'General Enrique Martínez 1374, Colegiales, Buenos Aires', 680211, 10, 4, 5, 3, 8, 250, 'Departamento', 27, 'alquiler_685d4f29adcb1.png', 'arthouseterracaparrilla@email.com'),
(57, 'Casa Amelia', '341 Paraná 10 B, Buenos Aires', 367107, 9, 4, 4, 4, 6, 150, 'Casa', 27, 'alquiler_685d4f61d634c.png', 'casa.amelia.ba@email.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `ID` int(2) NOT NULL,
  `DESCRIPCION` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`ID`, `DESCRIPCION`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'USUARIO NORMAL'),
(3, 'DUEÑO DE NEGOCIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoteles`
--

CREATE TABLE `hoteles` (
  `ID` int(10) UNSIGNED NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `UBICACION` varchar(100) NOT NULL,
  `PRECIO_MINIMO` int(7) UNSIGNED NOT NULL,
  `PRECIO_MAXIMO` int(7) UNSIGNED NOT NULL,
  `CALIFICACION` float UNSIGNED NOT NULL,
  `HUESPEDES` int(2) UNSIGNED NOT NULL,
  `PILETA` varchar(2) NOT NULL,
  `DESAYUNO` varchar(2) NOT NULL,
  `id_usuario` int(5) DEFAULT NULL,
  `FOTO_URL` varchar(255) DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `hoteles`
--

INSERT INTO `hoteles` (`ID`, `NOMBRE`, `UBICACION`, `PRECIO_MINIMO`, `PRECIO_MAXIMO`, `CALIFICACION`, `HUESPEDES`, `PILETA`, `DESAYUNO`, `id_usuario`, `FOTO_URL`, `URL`) VALUES
(1, 'SLS Buenos Aires Puerto Madero', 'Juana Manso 1725, C1107CHI Cdad. Autónoma de Buenos Aires', 290000, 350000, 4.5, 2, 'si', 'si', 25, 'hoteles_685a118a2e515.png', 'https://es.slshotels.com/puerto-madero/'),
(2, 'Hotel Hilton Buenos Aires', 'Blvd. Macacha Guemes 351, C1106BKG Cdad. Autónoma de Buenos Aires', 240000, 360000, 5, 4, 'si', 'no', 25, 'hoteles_685a124908415.png', 'www.hilton.com/en/hotels/buehihh-hilton-buenos-aires/'),
(3, 'Hotel NH Collection Buenos Aires Jousten', 'Av. Corrientes 280 C1043AAP Cdad. Autónoma de Buenos Aires', 110000, 160000, 4, 2, 'no', 'no', 25, 'hoteles_685a125e06073.png', 'https://www.nh-hotels.com'),
(4, 'Palladio Hotel Buenos Aires MGallery', 'Av. Callao 924, C1023AAP Cdad. Autónoma de Buenos Aires', 283000, 350000, 5, 4, 'si', 'si', 25, 'hoteles_685a12d24ee8a.png', 'https://www.palladiohotelbuenosaires.com/'),
(5, 'Ícaro Suites', 'Montevideo 229, C1019 Cdad. Autónoma de Buenos Aires', 105000, 150000, 4, 4, 'no', 'no', 27, 'hoteles_685a127972566.png', 'https://icarosuites.com/'),
(6, 'Duomi Hotel Buenos Aires', 'Bartolomé Mitre 1480, C1037ACF Cdad. Autónoma de Buenos Aires', 79000, 131000, 4, 6, 'si', 'si', 27, 'hoteles_685a11f1a58d4.png', 'https://duomi.com.ar/'),
(18, 'Monserrat Apart Hotel', 'Salta 560, C1074 AAL, Cdad. Autónoma de Buenos Aires', 42000, 59000, 4, 4, 'no', 'si', NULL, 'hoteles_685a1299d17c8.png', 'https://monserrat-apart.buenosaireshotelsargentina.com/es/'),
(19, 'Sileo Hotel', 'Azcuénaga 1968, C1128AAH Cdad. Autónoma de Buenos Aires', 130000, 160000, 4.4, 4, 'si', 'no', NULL, 'hoteles_685a11a0559c3.png', 'https://www.sileohotel.com/'),
(20, 'ULISES RECOLETA SUITES', 'Ayacucho 2016, C1112AAL Cdad. Autónoma de Buenos Aires', 91000, 128000, 3.8, 4, 'no', 'no', NULL, 'hoteles_685a11766086d.png', 'https://ulisesrecoleta.com.ar/portal/es-es/1217/Inicio'),
(21, 'Wilton Hotel', 'Av. Callao 1162/64, C1021AAR Cdad. Autónoma de Buenos Aires', 78000, 126000, 3.8, 4, 'si', 'no', NULL, 'hoteles_685a114f0ccd8.png', 'https://www.hotelwilton.com.ar/'),
(22, 'Bulnes Eco Suites', 'Bulnes 1905, C1425 Cdad. Autónoma de Buenos Aires', 101000, 183000, 4.3, 2, 'si', 'si', NULL, 'hoteles_685a11da44f0c.png', 'https://www.bulnesecosuites.com/'),
(23, 'Ayacucho Palace Hotel', 'Ayacucho 1408, C1111AAN Cdad. Autónoma de Buenos Aires', 72000, 76000, 3.9, 4, 'si', 'si', NULL, 'hoteles_685a11b1aebe1.png', 'http://ayacuchohotel.com.ar/'),
(24, 'Hotel Impala', 'Libertad 1215, C1012AAY Cdad. Autónoma de Buenos Aires', 60000, 73000, 3, 5, 'no', 'no', NULL, 'hoteles_685a12534eb9d.png', 'https://hotelimpala.com.ar/'),
(25, 'Gardel Flats', 'Carlos Gardel 3119, C1215AAA Cdad. Autónoma de Buenos Aires', 54000, 72000, 3.6, 4, 'no', 'si', NULL, 'hoteles_685a1212b637e.png', 'https://gardel-flats.buenosaireshotelsargentina.com/es/'),
(26, 'Hotel Boutique Racó de Buenos Aires - Yapeyú', 'Yapeyú 271, C1202ACE Buenos Aires', 73000, 131000, 3, 2, 'no', 'no', NULL, 'hoteles_685a123a1868c.png', 'http://www.racodebuenosaires.com.ar/'),
(27, 'Laprida Suites', 'Laprida 1729 37, C1425 C1425EKO, Cdad. Autónoma de Buenos Aires', 72000, 91000, 3, 4, 'si', 'no', NULL, 'hoteles_685a128a8a3bc.png', 'https://laprida-suites.buenosaireshotelsargentina.com/es/'),
(28, 'HTL City Baires', 'Piedras 303, C1070AAG Cdad. Autónoma de Buenos Aires', 40000, 60000, 4, 6, 'si', 'si', NULL, 'hoteles_685a126a7a2fd.png', 'https://htlhoteles.com/htlcitybaires/'),
(29, 'Palacio Duhau - Park Hyatt', 'Av. Alvear 1661, C1014AAD Cdad. Autónoma de Buenos Aires', 109500, 120000, 5, 2, 'si', 'si', NULL, 'hoteles_685a12c1b27c3.png', 'https://www.palacioduhauexperience.com/'),
(30, 'Believe Madero Hotel', 'Chile 80, C1011 Cdad. Autónoma de Buenos Aires', 50000, 61000, 4, 2, 'si', 'si', NULL, 'hoteles_685a11cc9d8c9.png', 'https://believemadero.com/'),
(31, 'Ayres de Recoleta Plaza', 'Guido 1980, C1119AAD Cdad. Autónoma de Buenos Aires', 60000, 80000, 4, 2, 'no', 'si', NULL, 'hoteles_685a11bea5437.png', 'https://plaza.ayresapartments.com/'),
(32, 'Gran Hotel Argentino', 'Carlos Pellegrini 37, C1009ABA Cdad. Autónoma de Buenos Aires', 33000, 54000, 3, 2, 'no', 'no', NULL, 'hoteles_685a12242db83.png', 'https://www.hotel-argentino.com.ar/'),
(33, 'Faena Hotel Buenos Aires', 'Martha Salotti 445, C1107 CMB, Cdad. Autónoma de Buenos Aires', 380000, 711000, 5, 6, 'si', 'si', NULL, 'hoteles_685a120184d15.png', 'https://www.faena.com/buenos-aires');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mail`
--

CREATE TABLE `mail` (
  `ID` int(2) NOT NULL,
  `CORREO` varchar(30) NOT NULL,
  `MENSAJE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos de interes`
--

CREATE TABLE `puntos de interes` (
  `ID` int(10) UNSIGNED NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `UBICACION` varchar(100) NOT NULL,
  `DESCRIPCION` varchar(150) NOT NULL,
  `CALIFICACION` float UNSIGNED DEFAULT NULL,
  `PRECIO` int(7) NOT NULL,
  `ID_ACTIVIDAD` int(2) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `FOTO_URL` varchar(255) DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `puntos de interes`
--

INSERT INTO `puntos de interes` (`ID`, `NOMBRE`, `UBICACION`, `DESCRIPCION`, `CALIFICACION`, `PRECIO`, `ID_ACTIVIDAD`, `id_usuario`, `FOTO_URL`, `URL`) VALUES
(1, 'Plaza de Mayo', 'Av. Hipólito Yrigoyen s/n, C1087 Cdad. Autónoma de Buenos Aires', 'Centro histórico y político del país, rodeado de edificios emblemáticos como la Casa Rosada y la Catedral Metropolitana', 5, 0, 1, NULL, 'puntos_interes_685a160794e90.png', 'https://maps.app.goo.gl/X9zmyvqwV7mC8YxY7'),
(2, 'Teatro Colón', 'Cerrito 628, C1010 Cdad. Autónoma de Buenos Aires', 'Considerado uno de los teatros de ópera más importantes del mundo', 5, 0, 2, NULL, 'puntos_interes_685a15b2d3a07.png', 'https://teatrocolon.org.ar/'),
(3, 'Avenida 9 de Julio', 'Avenida 9 de Julio', 'La avenida más ancha del mundo', 5, 0, 1, NULL, 'puntos_interes_685a14e2c2b67.png', 'https://maps.app.goo.gl/b1AB4ssKiQCjQahb8'),
(4, 'Obelisco', 'Av. Corrientes, C1035 Cdad. Autónoma de Buenos Aires', ' monumento histórico, considerado ícono de Buenos Aires', 5, 0, 6, NULL, 'puntos_interes_685a1584e8835.png', 'https://maps.app.goo.gl/YVDALwaf6xvXijrF7'),
(5, 'Cementerio de la Recoleta', 'Junín 1760, C1113 Cdad. Autónoma de Buenos Aires', 'Famoso por sus mausoleos ornamentados y como lugar de descanso de figuras históricas argentinas', 5, 0, 1, NULL, 'puntos_interes_685a15449712e.png', 'https://www.cementeriorecoleta.com.ar/'),
(6, 'Barrio de La Boca Caminito', 'La boca', 'Famoso por sus casas coloridas, arte callejero y como cuna del tango', 5, 0, 1, NULL, 'puntos_interes_685a1506ef583.png', 'https://maps.app.goo.gl/vJ7YmLK9peEV87qw9'),
(8, 'Casa Rosada', 'Balcarce 78, C1064AAC Cdad. Autónoma de Buenos Aires', ' Centro político e histórico del país', 5, 0, 1, NULL, 'puntos_interes_685a152f060fa.png', 'https://www.argentina.gob.ar/secretariageneral/museo-casa-rosada'),
(39, 'Puerto Madero', 'Cdad. Autónoma de Buenos Aires', 'Una zona moderna junto al río, ideal para paseos y cenas con vista', 5, 0, 4, NULL, 'puntos_interes_685a15df613d2.png', 'https://maps.app.goo.gl/UsZc8YCdCU61eQNE9'),
(40, 'El Ateneo Grand Splendid', 'Av. Sta. Fe 1860, C1123 Cdad. Autónoma de Buenos Aires', 'Una de las librerías más bellas del mundo, ubicada en un antiguo teatro', 5, 0, 2, NULL, 'puntos_interes_685de19705c01.png', 'https://www.yenny-elateneo.com/'),
(41, 'Barrio de San Telmo', 'Cdad. Autónoma de Buenos Aires', 'Conocido por su arquitectura colonial, mercados de antigüedades y ambiente bohemio', 5, 0, 4, NULL, 'puntos_interes_685a150fdc238.png', 'https://maps.app.goo.gl/SQpkEterg76RqNwn6'),
(42, 'Reserva Ecológica Costanera ', 'Av. Sta. Fe 1860, C1123 Cdad. Autónoma de Buenos Aires', 'Un espacio natural ideal para caminatas y observación de aves, ubicado a pocos minutos del centro', 5, 0, 3, NULL, 'puntos_interes_685a15cc6473b.png', 'https://maps.app.goo.gl/GgwD6UfxY7E2hrt26'),
(43, 'Museo de Bellas Artes', 'Av. del Libertador 1473, C1425 Cdad. Autonoma de Buenos Aires', 'Una de las colecciones de arte público más grandes de América Latina, ubicada en una antigua estación de bombeo de drenaje.', 5, 0, 2, NULL, 'puntos_interes_685a1635edd8a.png', 'https://www.bellasartes.gob.ar/'),
(44, 'Jardin Japones', 'Av. Casares 3450, C1425 Cdad. Autonoma de Buenos Aires', 'Jardín con paisajismo japonés, estanques, exhibiciones y un vivero de plantas, además de un restaurante de sushi.', 5, 0, 3, NULL, 'puntos_interes_685a165adf4c5.png', 'https://jardinjapones.org.ar/'),
(45, 'Rosedal', 'Av. Infanta Isabel 110, C1425 Cdad. Autonoma de Buenos Aires', 'Parque pintoresco con extensos jardines de rosas, además de estatuas de poetas famosos y un lago con un pintoresco puente.', 5, 0, 3, NULL, 'puntos_interes_685a15bf5c160.png', 'https://maps.app.goo.gl/vUtk8RLEtoLBveHw5'),
(46, 'Museo de Arte Decorativo', 'Av. del Libertador 1902, C1425 Cdad. Autonoma de Buenos Aires', 'Museo de lujo con jardín que ofrece obras de arte de todo el mundo, visitas guiadas y educación.', 5, 0, 2, NULL, 'puntos_interes_685a164f6d3f1.png', 'https://museoartedecorativo.cultura.gob.ar/'),
(47, 'Museo de Arte Latinoamericano', 'Av. Pres. Figueroa Alcorta 3415, C1425 Cdad. Autonoma de Buenos Aires', 'Museo moderno que exhibe obras de arte latinoamericanas del siglo XX y más recientes, eventos culturales y películas.', 5, 0, 2, NULL, 'puntos_interes_685a1644495e3.png', 'https://www.malba.org.ar/'),
(48, 'Zanjon de Granados', 'Defensa 755, C1065 Cdad. Autonoma de Buenos Aires', 'Laberintos restaurados y arqueología urbana en el sitio del primer asentamiento de Buenos Aires en 1536.', 5, 0, 1, NULL, 'puntos_interes_685a15a221edf.png', 'https://elzanjon.com.ar/'),
(49, 'Galerias Pacifico', 'Av. Cordoba 550, C1054 Cdad. Autonoma de Buenos Aires', 'Centro comercial lleno de murales con compras libres de impuestos para los visitantes y visitas guiadas al gran edificio.', 5, 0, 5, NULL, 'puntos_interes_685a1575820e7.png', 'https://www.galeriaspacifico.com.ar/'),
(50, 'Planetario', 'Av. Sarmiento, C1425 Cdad. Autonoma de Buenos Aires', 'El Planetario, inaugurado en 1967, alberga exhibiciones y muestras astronómicas, además de espectáculos de luces externas.', 5, 0, 2, NULL, 'puntos_interes_685a1592a5642.png', 'https://planetario.buenosaires.gob.ar/'),
(51, 'Paseo la Plaza', 'Av. Corrientes 1660, C1042 Cdad. Autonoma de Buenos Aires', 'Obras de teatro, conciertos y espectáculos de comedia, además de un patio cubierto con restaurantes y un museo de los Beatles.', 5, 0, 2, NULL, 'puntos_interes_685a161756e64.png', 'https://www.paseolaplaza.com.ar/'),
(52, 'Puente de la Mujer', 'GORRITI JUANA MANUELA 900, C1107 Cdad. Autónoma de Buenos Aires', 'Puente peatonal colgante y giratorio de 160 m de largo que fue diseñado por el arquitecto Santiago Calatrava.', 5, 0, 3, NULL, 'puntos_interes_685d4ddeed9e6.jpg', 'https://maps.app.goo.gl/rXq2W7EU6EB8RsqE6'),
(53, 'Palacio Libertad, Centro Cultural Domingo Faustino', 'Sarmiento 151, C1041 Cdad. Autónoma de Buenos Aires', 'Centro cultural en el que se realiza una gran variedad de presentaciones musicales y exhibiciones de arte.', 5, 0, 1, NULL, 'puntos_interes_685d4d37d8fb8.jpg', 'https://palaciolibertad.gob.ar/'),
(54, 'Plaza Dorrego', 'Humberto 1º 400, C1103 Cdad. Autónoma de Buenos Aires', 'Esta plaza histórica con cafés y tiendas es conocida por sus bailarines de tango y tienda de antigüedades.', 5, 0, 1, NULL, 'puntos_interes_685d4d9f280cd.jpg', 'https://maps.app.goo.gl/VmQFKq6JtcnpNZzE9'),
(55, 'Estadio Alberto J.Armando', 'Brandsen 805, C1161AAQ Cdad. Autónoma de Buenos Aires', 'Famoso estadio de fútbol conocido como la Bombonera, hogar del Boca Juniors de Argentina.', 5, 0, 1, NULL, 'puntos_interes_685d4c0208b66.jpg', 'https://maps.app.goo.gl/Hc3Z8oBx1DyVJr9w8'),
(56, 'Estadio Monumental', 'Av. Pres. Figueroa Alcorta 7597, C1424BCL Cdad. Autónoma de Buenos Aires', 'Estadio de fútbol y recinto de conciertos; sede del club River Plate y de la Copa Mundial de la FIFA de 1978.', 5, 0, 1, NULL, 'puntos_interes_685d4c0f2d2d6.jpg', 'https://maps.app.goo.gl/iKh3z5XorWSp2zdR7'),
(57, 'Floralis Generica ', 'Av. Pres. Figueroa Alcorta 2301, C1425 Cdad. Autónoma de Buenos Aires', 'Llamativa escultura de una flor de acero en un espejo de agua que fue regalo de un arquitecto para la ciudad.', 5, 0, 6, NULL, 'puntos_interes_685d4c1cb343e.jpg', 'https://maps.app.goo.gl/cw5FNdTtYwtr2cxdA'),
(58, 'Parque Tres de Febrero', 'Av. Infanta Isabel 110, C1425 Cdad. Autónoma de Buenos Aires', 'Gran espacio verde que rodea un rosedal; hay paseos en bote, patinaje y visitas al planetario.', 5, 0, 3, NULL, 'puntos_interes_685d4d7bc0192.jpg', 'https://maps.app.goo.gl/8i3Y3TcDkxPNLe7R7'),
(59, 'Basilica del Santísimo Sacramento', 'San Martín 1035, C1004AAU Cdad. Autónoma de Buenos Aires', 'Extravagante iglesia católica construida en 1916 con elementos románicos y góticos, además de 5 torres.', 5, 0, 7, NULL, 'puntos_interes_685d4b8aacbcb.jpg', 'https://www.facebook.com/basilica.santisimo.sacramento/'),
(60, 'Museo Histórico Nacional de Cabildo y la Revolució', 'Bolívar 65, C1066 Cdad. Autónoma de Buenos Aires', 'Museo ubicado en un edificio gubernamental colonial donde se muestran artículos patrimoniales argentinos.', 5, 0, 2, NULL, 'puntos_interes_685d4cd4e44c6.jpg', 'https://cabildonacional.cultura.gob.ar/'),
(61, 'Barrio Chino', 'C1428 Cdad. Autónoma de Buenos Aires', 'Es un paseo lleno de color, cultura y sabor. Con arcos tradicionales, supermercados orientales, templos y locales de gastronomía asiática, es un rincó', 5, 0, 1, NULL, 'puntos_interes_685d4b7bd6359.jpg', 'https://maps.app.goo.gl/oWwRUju6QcjkHtBK9'),
(62, 'Jardin Botánico Carlos Thays', 'Av. Sta. Fe 3957, C1425BHO Cdad. Autónoma de Buenos Aires', 'Jardín botánico de 7 hectáreas, con visitas guiadas, invernadero y plantas raras del continente.', 5, 0, 3, NULL, 'puntos_interes_685d4c497532b.jpg', 'https://maps.app.goo.gl/rBPuyGqCCvbCSA4G7'),
(63, 'Palacio Barolo', 'Av. de Mayo 1370, C1085 Cdad. Autónoma de Buenos Aires', 'Edificio notable cuyo diseño y disposición se inspiran en la Divina comedia de Dante.', 5, 0, 1, NULL, 'puntos_interes_685d4d13e7027.jpg', 'https://palaciobarolo.com.ar/,'),
(64, 'Congreso de la Nación Argentina', 'Av. Entre Ríos, C1033 Cdad. Autónoma de Buenos Aires', 'Edificio neoclásico del parlamento argentino; incluye recorridos de su cámara y el salón rosa de Eva Perón.', 5, 0, 1, NULL, 'puntos_interes_685d4bc2a0739.jpg', 'https://maps.app.goo.gl/YXNzQk6bEYrpBwrk8'),
(65, 'Museo Moderno', 'Av. San Juan 350, C1147AAO Cdad. Autónoma de Buenos Aires', 'Museo que exhibe obras modernas de artistas internacionales y argentinos de mediados del siglo XX en adelante.', 5, 0, 2, NULL, 'puntos_interes_685d4ce790c0f.jpg', 'https://museomoderno.org/'),
(66, 'Museo de Ciencias Naturales Bernardino Rivadavia ', 'Av. Patricias Argentinas 480, C1405 Cdad. Autónoma de Buenos Aires', 'Museo de historia natural con exhibiciones educativas sobre peces, fósiles, plantas y vida silvestre.', 5, 0, 2, NULL, 'puntos_interes_685d4c99e019a.jpg', 'https://www.macnconicet.gob.ar/'),
(67, 'Parque Lezama', 'Brasil, C1143 Cdad. Autónoma de Buenos Aires', 'Parque urbano con hermosos jardines, monumentos, estatuas, paseos arbolados y un parque infantil.', 5, 0, 3, NULL, 'puntos_interes_685d4d6e28545.jpg', 'https://maps.app.goo.gl/UU2czmYRsEFdZMRv5'),
(68, 'Catedral Metropolitana de Buenos Aires', 'San Martín 27, C1004 Cdad. Autónoma de Buenos Aires', 'Catedral cuya historia data del siglo XVII, antigua sede del actual Papa Francisco.', 5, 0, 7, NULL, 'puntos_interes_685d4bb2bf101.jpg', 'https://catedralprimadabue.wixsite.com/buenosaires'),
(69, 'Parque de la Memoria- Monumento a las Victimas del', 'Av. Costanera Rafael Obligado 6745, C1428 Cdad. Autónoma de Buenos Aires', 'Monumento en honor a las víctimas del terrorismo de estado, además de un sendero y una pared con nombres grabados.', 5, 0, 6, NULL, 'puntos_interes_685d4d60c1ec7.jpg', 'https://parquedelamemoria.org.ar/'),
(70, 'Fundación Proa', 'Av. Don Pedro de Mendoza 1929, C1169 Cdad. Autónoma de Buenos Aires', 'Museo de arte con exhibiciones contemporáneas, auditorio de actuaciones y cine, cafetería y biblioteca.', 5, 0, 2, NULL, 'puntos_interes_685d4cfe39f56.jpg', 'https://www.proa.org/esp/'),
(71, 'Torre Monumental', 'Av. Dr. José María Ramos Mejía 1315, C1104 Cdad. Autónoma de Buenos Aires', 'Torre del reloj que la comunidad británica le dio a la ciudad en 1916 para conmemorar la independencia.', 5, 0, 6, NULL, 'puntos_interes_685d4dcc7ab81.jpg', 'https://maps.app.goo.gl/5G3wpx4HcszsPerq6'),
(72, 'Ecoparque Buenos Aires', 'Av. Sarmiento 2601, C1425 FGC, Cdad. Autónoma de Buenos Aires', 'Antiguo zoológico convertido en parque ecológico con senderos, plantas nativas y animales en libertad y encerrados.', 5, 0, 3, NULL, 'puntos_interes_685d4bce33fed.jpg', 'https://maps.app.goo.gl/1uMYNphN55oax4Xi9'),
(73, 'Monumento de los Españoles', 'Avenida del Libertador, Av. Sarmiento y, Buenos Aires', 'Majestuoso monumento de 1927, de 25 m en mármol blanco que conmemora los lazos entre España y Argentina.', 5, 0, 6, NULL, 'puntos_interes_685d4c5f34a83.jpg', 'https://maps.app.goo.gl/C9iAgoZBwt6kVMZz7'),
(74, 'Biblioteca Nacional Mariano Moreno', 'Agüero 2502, C1425 Cdad. Autónoma de Buenos Aires', 'Biblioteca más grande de Argentina en una estructura elevada que alberga la colección nacional de libros.', 5, 0, 1, NULL, 'puntos_interes_685d4b942d58e.jpg', 'https://www.bn.gov.ar/'),
(75, 'Museo de Arte Popular José Hernández', 'Av. del Libertador 2373, C1425 Cdad. Autónoma de Buenos Aires', 'Dedicado a la difusión del arte popular argentino, con una colección de artesanías tradicionales como platería, textiles y cerámica.', 5, 0, 2, NULL, 'puntos_interes_685d4c74ed92a.jpg', 'https://buenosaires.gob.ar/cultura/museos/museojosehernandez'),
(76, 'Plaza Italia', 'C1425 Cdad. Autónoma de Buenos Aires', 'Concurrida plaza peatonal de la ciudad que presenta un monumento de Giuseppe Garibaldi y una columna romana.', 5, 0, 3, NULL, 'puntos_interes_685d4db672c7f.jpg', 'https://maps.app.goo.gl/YqJ5Szwvx4S5fXnm6'),
(77, 'Parque Centenario ', 'Av. Díaz Vélez 4859, C1405DCD Cdad. Autónoma de Buenos Aires', 'Escénico espacio verde con un anfiteatro, un lago con patos, murales, esculturas y una fuente.', 5, 0, 3, NULL, 'puntos_interes_685d4d536c708.jpg', 'https://maps.app.goo.gl/XGDHuYWognHm93SA6'),
(78, 'Parque Barrancas de Belgrano', 'Av. Juramento 1792, C1430 Cdad. Autónoma de Buenos Aires', 'Parque público con valles y estatuas históricas cuidados, incluida una réplica de la Estatua de la Libertad.', 5, 0, 3, NULL, 'puntos_interes_685d4d47bde8c.jpg', 'https://maps.app.goo.gl/9gx2UP2jsNGRFJsL9'),
(79, 'Museo del Agua y de la Historia Sanitaria', 'Riobamba 750 Piso 1, C1025 Cdad. Autónoma de Buenos Aires', 'Estación de bombeo de agua con un diseño palaciego que presenta 300,000 azulejos de terracota y un museo.', 5, 0, 2, NULL, 'puntos_interes_685d4cad7ece3.jpg', 'https://aysa.com.ar/culturayeducacion/museo'),
(80, 'Casino Buenos Aires', 'Av. Elvira Rawson de Dellepiane 1, C1107 Cdad. Autónoma de Buenos Aires', 'Casino imponente con mesas de juego y máquinas tragamonedas sobre 2 botes y un restaurante internacional.', 5, 0, 2, NULL, 'puntos_interes_685d4ba4ab6c6.jpg', 'https://casinobuenosaires.com.ar/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `ID` int(10) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `UBICACION` varchar(100) NOT NULL,
  `ID_COMIDA` int(2) NOT NULL,
  `DESCRIPCION` varchar(150) NOT NULL,
  `PRECIO_MINIMO` int(7) DEFAULT NULL,
  `PRECIO_MAXIMO` int(7) DEFAULT NULL,
  `id_usuario` int(5) DEFAULT NULL,
  `CALIFICACION` float NOT NULL,
  `FOTO_URL` varchar(255) DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`ID`, `NOMBRE`, `UBICACION`, `ID_COMIDA`, `DESCRIPCION`, `PRECIO_MINIMO`, `PRECIO_MAXIMO`, `id_usuario`, `CALIFICACION`, `FOTO_URL`, `URL`) VALUES
(3, 'Kansas Grill & Bar', 'Av. del Libertador 4625, C1426 Cdad. Autónoma de Buenos Aires', 1, 'Kansas', 30000, 100000, NULL, 4, 'restaurantes_685a1929784c2.png', 'https://www.kansasgrillandbar.com.ar/'),
(5, 'Happening Costanera', ' Av. Costanera Rafael Obligado 7030, C1428 Cdad. Autónoma de Buenos Aires', 1, 'Happening es un restaurant que combina parrilla y cocina internacional. En Happening, el ambiente del restaurante es cálido e ideal para ir con amigos', 50000, 120000, NULL, 5, 'restaurantes_685a18e6b1682.png', 'https://happening.com.ar/'),
(33, 'Don Julio', 'Guatemala 4699, C1425 Cdad. Autónoma de Buenos Aires', 1, 'Parrilla emblemática que ha sido reconocida como el mejor restaurante de América Latina en 2024 y ocupa el puesto 10 a nivel mundial', 100000, 300000, 26, 4.4, 'restaurantes_685a186d1940d.png', 'https://www.parrilladonjulio.com/'),
(34, 'El Preferido de Palermo', 'Jorge Luis Borges 2108, C1425 FFD, Cdad. Autónoma de Buenos Aires', 1, 'Un bodegón moderno que rescata recetas tradicionales argentinas con un toque contemporáneo', 8000, 20000, 26, 4.4, 'restaurantes_685a18a513b49.png', 'https://elpreferido.meitre.com/'),
(35, 'Aramburu Relais & Châteaux', 'Pasaje del Correo, Vicente López 1661, C1103ACY Cdad. Autónoma de Buenos Aires', 2, 'Con una propuesta de cocina molecular, ofrece menús degustación innovadores en un ambiente íntimo', 130000, 250000, 26, 4.7, 'restaurantes_685a180b2f07b.png', 'https://www.arambururesto.com.ar/'),
(36, 'La Parolaccia', 'Av. Alicia Moreau de Justo 1052, C1107AAV Cdad. Autónoma de Buenos Aires', 4, 'Su menú destaca por las pastas artesanales, antipasto, carnes y postres tradicionales, en un ambiente cálido y familiar.', 6000, 15000, 26, 4.4, 'restaurantes_685a19884e09b.png', 'https://www.laparolaccia.com/'),
(38, 'La Mar', 'Arévalo 2032, C1414CQP Cdad. Autónoma de Buenos Aires', 2, 'En La Mar nuestros chefs combinan sabores tradicionales peruanos con técnicas innovadoras', 12000, 25000, 26, 4.4, 'restaurantes_685a19764f286.png', 'https://www.lamarcebicheria.com/'),
(40, 'Happening puerto madero', 'Av. Alicia Moreau de Justo 310, C1107 Cdad. Autónoma de Buenos Aires', 1, 'Heredero y representante de la tradición de los carritos de costanera. Happening combina parrilla y cocina internacional.', 10000, 25000, 26, 4.4, 'restaurantes_685a18f635de4.png', 'https://happening.com.ar/'),
(41, 'El Querandi', ' Perú 322, Monserrat, Buenos Aires, Argentina.', 4, 'Cenas con espectáculo de tango tradicionales en un elegante entorno revestido de madera oscura con menú a la carta y vino.', 7000, 20000, 26, 4.4, 'restaurantes_685a18b3eeb64.png', 'https://querandi.com.ar/'),
(42, 'El Club de la Milanesa', 'Av. Alicia Moreau de Justo 876, C1107 Cdad. Autónoma de Buenos Aires', 3, 'Si estás con antojo de Milanesas, ¡El Club de la Milanesa es el lugar perfecto para vos! ', 5000, 12000, 26, 4.2, 'restaurantes_685a18926902a.png', 'https://elclubdelamilanesa.com/'),
(43, 'Puerto Cristal', 'Av. Alicia Moreau de Justo 1082, Puerto Maderoo, Cdad. Autonoma de Buenos Aires', 2, 'Un restaurante de cocina internacional con especialidad en mariscos y pescados, que se destaca por su ambiente elegante y su carta de vinos premiada', 10000, 25000, 27, 4.5, 'restaurantes_685a19c56b202.png', 'https://puerto-cristal.com.ar/'),
(44, 'Fuego y Vino Cabernet', 'Jorge Luis Borges 1757, C1414 DGC, Cdad. Autónoma de Buenos Aires', 1, 'Ofrece una propuesta culinaria que fusiona la parrilla argentina con técnicas modernas y una cuidada selección de vinos nacionales.', 8000, 18000, 27, 4.2, 'restaurantes_685a18c444f1c.png', 'https://fuegoyvino.com/'),
(45, 'D\'oro Italian Bar', ' Perú 159, C1067AAC Cdad. Autónoma de Buenos Aires', 4, 'Restaurante clásico de cocina italiana que se destaca por sus pastas frescas hechas a mano y recetas tradicionales italianas', 7000, 15000, 27, 4.7, 'restaurantes_685a187fa64e9.png', 'https://doroitalianbar.com/'),
(46, 'Calden del Soho', 'Honduras 4701, C1414BMK Cdad. Autónoma de Buenos Aires', 1, ' No es solo un lugar para disfrutar de una buena comida; es el testimonio de un lugar familiar que lleva más de seis décadas marcada por el buen comer', 8000, 18000, 27, 4.4, 'restaurantes_685a184997ee7.png', 'https://caldendelsoho.com/'),
(47, 'Gioia Cocina Botánica', 'Posadas 1350, C1011ABH Cdad. Autónoma de Buenos Aires', 6, 'Ofrece una propuesta culinaria argentina con influencias italianas y asiáticas, adaptada para celíacos', 10000, 20000, 27, 4.6, 'restaurantes_685a18d684a94.png', 'https://www.palacioduhauexperience.com/gioia'),
(48, 'Naturaleza Sabia', 'Perú 677, C1064 Cdad. Autónoma de Buenos Aires', 5, 'Ofrece platos caseros, saludables y sabrosos con ingredientes frescos, opciones sin TACC, jugos naturales y postres artesanales.', 9000, 18000, 27, 4.5, 'restaurantes_685a199c4af14.png', 'http://www.naturalezasabia.com/index.php'),
(49, 'Puerta', 'Soler 4501, C1425 Cdad. Autónoma de Buenos Aires', 5, 'Ofrece una propuesta gastronómica innovadora, fusionando sabores latinos, mediterráneos y técnicas de cocina francesa.', 10000, 22000, 27, 4.7, 'restaurantes_685a19b2d5705.png', 'https://puertaresto.com/'),
(50, 'Casa Munay', 'Gorriti 5996, C1414 BKL, Cdad. Autónoma de Buenos Aires', 6, 'Restaurante que ofrece una propuesta gastronómica saludable y creativa, con opciones vegetarianas y veganas', 8000, 18000, 27, 4.5, 'restaurantes_685a18553eefd.png', 'https://casamunay.com/'),
(51, 'La Cabrera Casa de Carnes', 'José A. Cabrera 5099, Palermo.', 1, 'Famosa por sus cortes de carne, porciones abundantes y un buen surtido de vinos.', 30000, 70000, 27, 3.9, 'restaurantes_685a194fa8fd5.png', 'https://www.lacabrera.com.ar/'),
(52, 'La Alacena Trattoria', 'Gascón 1401, C1181ADA Cdad. Autónoma de Buenos Aires', 4, 'Ofrece platos tradicionales con un toque moderno, elaborados con pasta artesanal y productos frescos', 7000, 18000, 27, 4.4, 'restaurantes_685a1960bd1b4.png', 'https://linktr.ee/laalacenacafebazar'),
(115, 'Todo Brasa Devoto', 'Av. Francisco Beiró 5016, C1417 Cdad. Autónoma de Buenos Aires', 1, 'Reconocida por su técnica única de cocción lenta en jaulas de hierro al fuego. Ofrece carnes ahumadas de calidad, guarniciones creativas y un ambiente', 16000, 60000, 26, 4.3, 'restaurantes_685d4ae52f15b.jpg', 'https://linktr.ee/TodoBrasasDevoto'),
(116, 'La Capitana- Bodegon y Vermuteria ', 'Guardia Vieja 4446, C1192 Cdad. Autónoma de Buenos Aires', 1, 'Ofrece platos tradicionales con un toque moderno en un ambiente cálido y sofisticado.', 15000, 86000, 26, 4.9, 'restaurantes_685d49e069de6.jpg', 'https://www.lacapitana.ar/'),
(117, 'Italpast Faena Buenos Aires', 'Juana Manso 1450, C1107 Cdad. Autónoma de Buenos Aires', 4, 'Alta cocina italiana en un entorno sofisticado. Platos refinados con presentación moderna y sabores tradicionales', 15000, 36000, 26, 4.8, 'restaurantes_685d49b3d176e.jpg', 'https://www.faena.com/buenos-aires/dining/bistro-sur'),
(118, 'Cucina D\' Onore', 'Av. Alicia Moreau de Justo 1768, C1107 AFJ, Cdad. Autónoma de Buenos Aires', 4, 'Combina recetas tradicionales con productos de excelente nivel, ofreciendo una experiencia culinaria auténtica y cálida.', 25000, 30000, 26, 4.4, 'restaurantes_685d490fe86e5.jpg', 'https://www.cucinadonore.com/'),
(119, 'La Aguada', 'Billinghurst 1862, C1425DTL Cdad. Autónoma de Buenos Aires', 1, 'Restaurante que ofrece una experiencia gastronómica completa con platos elaborados con productos argentinos de alta calidad', 4000, 12000, 26, 4.4, 'restaurantes_685d49ce5a671.jpg', 'https://www.instagram.com/laaguadaregional/?hl=es'),
(120, 'Bao Kitchen ', 'Av. Pueyrredón 1790, C1119ACN Cdad. Autónoma de Buenos Aires', 2, 'Comida taiwanesa auténtica en un ambiente acogedor', 16000, 25000, 26, 4.7, 'restaurantes_685d48f268dff.jpg', 'https://www.baokitchen.com.ar/'),
(121, 'Miyako', 'Av. Nazca 388 6º Piso, C1406AJP Cdad. Autónoma de Buenos Aires', 2, 'Conocido por su sushi fresco y ramen, ofreciendo una experiencia japonesa tradicional', 4000, 16000, 26, 4.6, 'restaurantes_685d4a316b3e9.jpg', 'https://linktr.ee/MiyakoBsAs'),
(122, 'Nikkai Shokudo', 'Av. Independencia 732, C1099AAU C1099AAU, Cdad. Autónoma de Buenos Aires', 2, 'Popular por su ramen y platos tradicionales, con un ambiente auténtico.', 17000, 24000, 26, 4.6, 'restaurantes_685d4a4c0f046.jpg', 'https://www.nikkaishokudo.com/'),
(123, 'Tao-Tao Restaurant', 'Av. Cabildo 1418, C1426ABO Cdad. Autónoma de Buenos Aires', 2, 'Ofrece una variedad de platos chinos tradicionales en un entorno familiar y acogedor.', 20000, 30000, 26, 4.4, 'restaurantes_685d4abd76aea.jpg', 'https://es.restaurantguru.com/Tao-Tao-Buenos-Aires'),
(124, 'Fujisan ', 'Mendoza 1650, C1428 DJP, Cdad. Autónoma de Buenos Aires', 2, 'Restaurante japonés que destaca por su sushi y platos tradicionales, ofreciendo una experiencia auténtica.', 7000, 15000, 26, 4.4, 'restaurantes_685d49494b5cd.jpg', 'https://www.fujisan.com.ar/'),
(125, 'Bushi', 'Bonpland 1201, C1429 Cdad. Autónoma de Buenos Aires', 2, 'Conocido por su cocina japonesa de autor, fusionando técnicas tradicionales con creatividad moderna.', 25000, 40000, 27, 4.8, 'restaurantes_685a183bafb41.png', 'https://bushiresto.com.ar/?utm_source=web&utm_medium=googlemaps&utm_campaign=organica#home'),
(126, 'Mr. Ho', 'Paraguay 884, C1057 Cdad. Autónoma de Buenos Aires', 2, 'Restaurante de cocina asiática moderna, ofreciendo una variedad de platos con influencias coreanas y japonesas.', 12000, 65000, 27, 4.7, 'restaurantes_685d4a3d35516.jpg', 'https://queresto.com/mrho'),
(127, 'Trattoria Olivetti', 'Av. Cerviño 3800, C1425 Cdad. Autónoma de Buenos Aires', 4, 'Combina recetas tradicionales con productos de excelente nivel, ofreciendo una experiencia culinaria auténtica y cálida.', 4000, 8000, 27, 4.4, 'restaurantes_685d4af44bef5.jpg', 'https://www.trattoriaolivetti.com/'),
(128, 'Casa Paradiso', 'Jerónimo Salguero 3172, C1425DFP Cdad. Autónoma de Buenos Aires', 4, 'Cocina italiana de inspiración clásica con toques contemporáneos. Su carta de vinos italianos acompaña recetas de temporada con ingredientes nobles.', 8000, 10000, 27, 4.2, 'restaurantes_685d49020493c.jpg', 'https://www.instagram.com/casaparadiso.ar/'),
(129, 'Giardino Romagnoli', 'Carlos Pellegrini 1576, C1011 Cdad. Autónoma de Buenos Aires', 4, 'Ofrece cocina de la región de Emilia-Romaña con productos italianos importados y especialidades como trufa, burrata y embutidos artesanales.', 83000, 237000, 27, 4.6, 'restaurantes_685d495b21b07.jpg', 'https://www.instagram.com/ilgiardinoromagnoli/?hl=es-la'),
(130, 'La Madonnina', '11 de Septiembre de 1888 4540, C1429 Cdad. Autónoma de Buenos Aires', 4, 'Ideal para una cena romántica, con platos tradicionales del norte de Italia y ambiente elegante.', 10000, 23000, 27, 4.3, 'restaurantes_685d49ef2e5f4.jpg', 'https://lamadonninaresto.com.ar/'),
(131, 'Parrilla La Familia', ' Av. Gral. Tomás de Iriarte 2101, C1291ABQ Cdad. Autónoma de Buenos Aires', 1, 'Un clásico del barrio con porciones abundantes y el sabor auténtico del asado argentino. Ambiente sencillo y bien porteño.', 15000, 30000, 27, 4, 'restaurantes_685d4a5729e67.jpg', 'https://www.instagram.com/lafamilia.parrilla/?hl=es'),
(132, 'El Viejo Bulcano', 'Bolívar 1779, C1140 Cdad. Autónoma de Buenos Aires', 1, 'Parrilla de culto, reconocida por su atención cálida y carnes jugosas a la leña. Ideal para encuentros familiares.', 8000, 12000, 27, 4.2, 'restaurantes_685d493d34908.jpg', 'https://www.instagram.com/el.viejo.vulcano/?hl=es'),
(133, 'Parrilla Rey de Reyes', ' Brandsen 966, C1161 Cdad. Autónoma de Buenos Aires', 1, 'Especialistas en cortes tradicionales y achuras. Su lema es “cantidad y sabor”, perfecto para los fanáticos del buen asado.', 20000, 25000, 27, 4.8, 'restaurantes_685d4a6c24426.jpg', 'https://www.instagram.com/parrilla.reydereyes/'),
(134, 'El Imperio de la Pizza', 'Av. Corrientes 6891, C1427BPG Cdad. Autónoma de Buenos Aires', 3, 'Ícono de la pizza al molde; masa esponjosa, muzza generosa y ambiente popular que nunca falla.', 24000, 40000, 27, 4.4, 'restaurantes_685d4929c6172.jpg', 'https://www.instagram.com/elimperiodelapizza/?hl=es'),
(135, 'Ti Amo- Pizzeria Napoletana', ' AWA, Cap. Gral. Ramón Freire 1393, C1426 C1426AWA, Cdad. Autónoma de Buenos Aires', 3, 'Inspirada en Nápoles, con horno a leña y masa madre. Pizzas livianas, ingredientes de estación y estética moderna.', 25000, 37000, 27, 4.5, 'restaurantes_685d4ad6e671f.jpg', 'https://tiamopizzeria.meitre.com/?fbclid=PAZXh0bgNhZW0CMTEAAadXgiX8RHoqwj6jbG6jGnFKRpay0NxX0Frp6lVIqhtKmETf-nH5HRWJih_uRg_aem_f3nVJSWzGlYxZ7pQyTeIkg'),
(136, 'La Mezzetta', 'Av. Álvarez Thomas 1321, C1427 Cdad. Autónoma de Buenos Aires', 3, 'Famosa por su fugazzetta rellena. Un lugar pequeño, siempre lleno, donde se sirve una de las mejores pizzas al corte de la ciudad.', 15000, 21000, 27, 4.6, 'restaurantes_685d49fd4f70b.jpg', 'https://www.instagram.com/pizzerialamezzetta'),
(137, 'El Cuartito', 'Talcahuano 937, C1001 Cdad. Autónoma de Buenos Aires', 3, 'Una de las pizzerías más tradicionales de Buenos Aires. Muzzarella de la vieja escuela y fotos del fútbol en las paredes.', 15000, 18000, 27, 4.5, 'restaurantes_685d491f0631c.jpg', 'https://www.instagram.com/cuartito_paginaoficial/?hl=es'),
(138, 'Pizza Cero', 'Av. del Libertador 1800, C1112 ABP, Cdad. Autónoma de Buenos Aires', 3, 'Una opción más moderna con ambientación cuidada. Ofrece pizzas finas, empanadas gourmet y tragos para acompañar.', 8000, 16000, 27, 4.1, 'restaurantes_685d4a794bf52.jpg', 'https://www.pizzacero.com.ar/'),
(139, '212 Pizza', ' Nicaragua 4316, C1414 Cdad. Autónoma de Buenos Aires', 3, 'Estilo neoyorquino con porciones XL, opciones vegetarianas y buena música.', 125000, 315000, 27, 5, 'restaurantes_685cc0ca9c79b.jpg', 'https://212-pizza.com/'),
(140, 'Pizza Data', 'Julián Álvarez 2489, C1425DHK Cdad. Autónoma de Buenos Aires', 3, 'Pizzería artesanal con masa de larga fermentación y toppings originales. Ideal para los que buscan salir de lo clásico.', 40000, 50000, 27, 4.7, 'restaurantes_685d4a88eb544.jpg', 'https://linktr.ee/pizzadata.ar'),
(141, 'ANDIAMO  Pizza y Café', 'Montevideo 1088, C1019 Cdad. Autónoma de Buenos Aires', 3, 'Un café con identidad italiana que combina pizzas al taglio con espresso y pastelería casera. ', 15000, 45000, 27, 4.7, 'restaurantes_685cc16ab3c39.jpg', 'https://www.instagram.com/andiamopizzaycaffe/#'),
(142, 'La Vegana cantina', 'Moreno 1400, C1091 Cdad. Autónoma de Buenos Aires', 6, 'Cocina vegana argentina con platos tradicionales versionados: milanesas, empanadas y guisos, todo 100% plant-based.', 20000, 30000, 27, 4.7, 'restaurantes_685d4a09a9680.jpg', 'https://www.instagram.com/lavegana.cantina'),
(143, 'Los Sabios Restaurante ', 'Av. Corrientes 3733, C1194 Cdad. Autónoma de Buenos Aires', 6, 'Una opción vegetariana con décadas de historia. Buffet libre al mediodía con comida casera y ambiente tranquilo.', 12000, 16000, 27, 4.4, 'restaurantes_685d4a237c351.jpg', 'https://www.facebook.com/restaurante.lossabios/#'),
(144, 'Guille Veggie', 'Humahuaca 4101, C1192 Cdad. Autónoma de Buenos Aires', 6, 'Propuesta accesible y casera. Ofrece menús diarios vegetarianos', 14000, 21000, 27, 4.8, 'restaurantes_685d49933dbbe.jpg', 'https://www.instagram.com/guilleveggie?utm_medium=copy_link'),
(145, 'Veganius', ' Godoy Cruz 2341, C1425 Cdad. Autónoma de Buenos Aires', 6, 'Restaurante moderno con platos veganos gourmet, hamburguesas de autor y postres plant-based que sorprenden.', 25000, 40000, 27, 4.5, 'restaurantes_685d4b0050fc0.jpg', 'https://www.instagram.com/veganius_?igshid=1s77na4gjrxsu'),
(146, 'Let it V', 'Costa Rica 5865, C1414 Cdad. Autónoma de Buenos Aires', 6, 'Estética urbana y joven. Platos creativos, smoothies, brunchs veganos y opciones gluten free ', 20000, 35000, 27, 4.2, 'restaurantes_685d4a1830ad0.jpg', 'https://www.letitv.com.ar/'),
(147, 'Aravegans', 'Av. Forest 1010, C1427 Cdad. Autónoma de Buenos Aires', 6, 'Cocina fusión con toques árabes y latinoamericanos. Todo vegano y con propuestas que se adaptan a dietas sin TACC', 37000, 40000, 27, 4.4, 'restaurantes_685cc23572a6c.jpg', 'https://www.instagram.com/aravegans'),
(148, 'Gordo Vegano', 'Echeverría 3078, C1428DSD Cdad. Autónoma de Buenos Aires', 6, 'Comida rápida plant-based con actitud. Hamburguesas, papas y salsas caseras en un local con mucha personalidad.', 14000, 17000, 27, 4.6, 'restaurantes_685d4971177fe.jpg', 'https://www.instagram.com/gordo.vegano/'),
(149, 'The Bowl', 'Honduras 4186, C1180 Cdad. Autónoma de Buenos Aires', 5, 'Especialistas en bowls nutritivos: vegetales, legumbres, granos y aliños intensos. Ideal para comer rico y liviano.', 89000, 220000, 27, 4.6, 'restaurantes_685d4ac86d860.jpg', 'https://www.instagram.com/the_bowl_sabor_asiatico_/#'),
(150, 'Sampa', 'Av. Raúl Scalabrini Ortiz 769, C1414DNH Cdad. Autónoma de Buenos Aires', 5, 'Barra vegetariana de cocina al fuego. Sabores intensos, menú por pasos y un espacio moderno para disfrutar sin prisa.', 55000, 97000, 27, 4.8, 'restaurantes_685d4a94cff80.jpg', 'https://www.sampa.com.ar/'),
(151, 'Spring vegetariano', 'Báez 260, C1426 Cdad. Autónoma de Buenos Aires', 5, 'Clásico buffet vegetariano con opciones asiáticas. Ideal para quienes buscan variedad, abundancia y buen precio.', 70000, 140000, 27, 4.8, 'restaurantes_685d4ab1130a8.jpg', 'https://www.instagram.com/spring.vegetariano/?locale=ko-KR&hl=en'),
(152, 'Sattva', 'Montevideo 446, C1019ABJ Cdad. Autónoma de Buenos Aires', 5, 'Restaurante vegetariano con filosofía ayurvédica. Platos equilibrados, ambiente sereno y enfoque en la alimentación consciente.', 4000, 39000, 27, 4.3, 'restaurantes_685d4aa2614b4.jpg', 'https://www.instagram.com/sattva_vegetariano/?hl=es'),
(153, 'Green Factory', 'Sanabria 4509, C1419 Cdad. Autónoma de Buenos Aires', 5, 'Comida rápida pero saludable. Wraps, bowls, jugos y snacks naturales con foco en lo sustentable y nutritivo.', 7000, 15000, 27, 4.5, 'restaurantes_685d4984606a5.jpg', 'https://www.greenfactory.com.ar/'),
(154, 'Hierbabuena', 'Av. Caseros 454, C1152AAN Cdad. Autónoma de Buenos Aire', 5, 'Propuesta orgánica, colorida y sabrosa. Cocina de autor con ingredientes locales y carta plant-based variada.', 5000, 10000, 27, 4.3, 'restaurantes_685d49a398a06.jpg', 'https://www.instagram.com/hierbabuenarestaurant?igsh=NDI0anA2ZnZlbzRv');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo de comida`
--

CREATE TABLE `tipo de comida` (
  `ID` int(2) NOT NULL,
  `DESCRIPCION` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo de comida`
--

INSERT INTO `tipo de comida` (`ID`, `DESCRIPCION`) VALUES
(1, 'Parrilla'),
(2, 'Asiatica'),
(3, 'Pizzas y empanadas'),
(4, 'Pastas'),
(5, 'Vegetariana'),
(6, 'Vegana'),
(7, 'Todos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(5) NOT NULL,
  `NOMBRE` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `APELLIDO` varchar(30) NOT NULL,
  `EMAIL` varchar(30) NOT NULL,
  `USERNAME` varchar(12) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `ID_CARGO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `NOMBRE`, `APELLIDO`, `EMAIL`, `USERNAME`, `PASSWORD`, `ID_CARGO`) VALUES
(25, 'admin', 'admin', 'admin@gmail.com', 'admin', '202cb962ac59075b964b07152d234b70', 1),
(26, 'Pepe', 'Perez', 'correo@correo.com', 'Pepito', 'caf1a3dfb505ffed0d024130f58c5cfa', 2),
(27, 'Cosme', 'Fulanito', 'mail@gmail.com', 'Cosme', '202cb962ac59075b964b07152d234b70', 3),
(29, 'Pablo', 'Franco', 'pablo@gmail.com', 'Pablo', 'caf1a3dfb505ffed0d024130f58c5cfa', 2),
(30, 'Cristian', 'Castro', 'criscastro@gmail.com', 'Cristian', 'caf1a3dfb505ffed0d024130f58c5cfa', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `puntos de interes`
--
ALTER TABLE `puntos de interes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ACTIVIDAD` (`ID_ACTIVIDAD`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_COMIDA` (`ID_COMIDA`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tipo de comida`
--
ALTER TABLE `tipo de comida`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_CARGO` (`ID_CARGO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `mail`
--
ALTER TABLE `mail`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puntos de interes`
--
ALTER TABLE `puntos de interes`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT de la tabla `tipo de comida`
--
ALTER TABLE `tipo de comida`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD CONSTRAINT `alquiler_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`ID`);

--
-- Filtros para la tabla `hoteles`
--
ALTER TABLE `hoteles`
  ADD CONSTRAINT `hoteles_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`ID`);

--
-- Filtros para la tabla `puntos de interes`
--
ALTER TABLE `puntos de interes`
  ADD CONSTRAINT `puntos de interes_ibfk_1` FOREIGN KEY (`ID_ACTIVIDAD`) REFERENCES `actividad` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `puntos de interes_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`ID`);

--
-- Filtros para la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD CONSTRAINT `restaurantes_ibfk_1` FOREIGN KEY (`ID_COMIDA`) REFERENCES `tipo de comida` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `restaurantes_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
