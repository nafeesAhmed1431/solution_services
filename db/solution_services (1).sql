-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2023 at 10:52 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solution_services`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_access`
--

CREATE TABLE `tbl_access` (
  `id` int(11) NOT NULL,
  `role_id` int(10) NOT NULL,
  `module_id` int(10) NOT NULL,
  `check_bit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_access`
--

INSERT INTO `tbl_access` (`id`, `role_id`, `module_id`, `check_bit`) VALUES
(1, 2, 3, 1),
(2, 2, 4, 1),
(3, 2, 5, 1),
(4, 2, 6, 1),
(6, 1, 1, 1),
(7, 1, 2, 1),
(8, 1, 3, 1),
(9, 1, 4, 1),
(10, 1, 5, 1),
(11, 1, 6, 1),
(12, 2, 1, 1),
(13, 4, 4, 1),
(14, 4, 1, 1),
(15, 4, 3, 1),
(16, 4, 6, 1),
(17, 2, 7, 1),
(18, 3, 7, 1),
(19, 4, 7, 1),
(20, 3, 1, 1),
(21, 3, 3, 1),
(22, 3, 4, 1),
(23, 3, 5, 1),
(24, 3, 6, 1),
(25, 1, 9, 1),
(26, 1, 10, 1),
(27, 2, 2, 1),
(28, 1, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checklists`
--

CREATE TABLE `tbl_checklists` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `list_id` int(11) DEFAULT NULL,
  `process_id` int(11) DEFAULT NULL,
  `enable_bit` tinyint(1) DEFAULT 1,
  `delete_bit` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_checklists`
--

INSERT INTO `tbl_checklists` (`id`, `title`, `link`, `list_id`, `process_id`, `enable_bit`, `delete_bit`) VALUES
(1, '1.	Gestión de Carta No Objeción al Uso de Suelo y Edificaciones.', NULL, 1, 4, 1, 0),
(2, '- Certificado de Títulos de Propiedad de ambos lados. Certificado de Títulos de Propiedad de ambos lados. ', NULL, 1, 2, 1, 0),
(3, 'Resellados de plano', NULL, 1, NULL, 1, 0),
(4, '1.	Gestión Certificado de Registro de Impacto Mínimo, Constancias Ambientales, Permisos Ambientales y Licencia Ambiental.', NULL, 2, NULL, 1, 0),
(5, '2.	Gestión Informe de Cumplimiento Ambiental (ICA).', NULL, 2, NULL, 1, 0),
(6, '3.	Supervisión de Cumplimiento Ambiental. ', NULL, 2, NULL, 1, 0),
(7, '4.	Asesoría Manejo de residuos líquidos, solidos, oleoso o especificados (hospitalarios o biomédicos).', NULL, 2, NULL, 1, 0),
(8, 'Carta de No Objeción.', NULL, 3, NULL, 1, 0),
(9, 'Carta de Renovación de permisos.', NULL, 3, NULL, 1, 0),
(10, 'Resellados de planos.', NULL, 3, NULL, 1, 0),
(11, 'Licencias de Operaciones.', NULL, 3, NULL, 1, 0),
(12, 'Licencia de Construcción', NULL, 4, NULL, 1, 0),
(13, 'Renovación de Licencia.', NULL, 4, NULL, 1, 0),
(14, 'Copias de Licencias.', NULL, 4, NULL, 1, 0),
(15, 'Solicitud  Inicio de Obra.', NULL, 4, NULL, 1, 0),
(16, 'Replanteo de inmuebles', NULL, 5, NULL, 1, 0),
(17, 'Deslindes, Subdivisión y Refundición. ', NULL, 5, NULL, 1, 0),
(18, 'Régimen de Condominio.', NULL, 5, NULL, 1, 0),
(20, 'Carta de aprobación para la conexión.', NULL, 6, NULL, 1, 0),
(21, 'Certificado de Títulos de Propiedad de ambos lados.', NULL, 7, NULL, 1, 0),
(22, 'Contrato de venta de no tener los títulos a nombre del propietario final.', NULL, 7, NULL, 1, 0),
(23, 'Planos de Mensura Catastral con las Coordenadas UTM.', NULL, 7, NULL, 1, 0),
(24, 'Acta de RNC y Registro Mercantil de la empresa propietaria.', NULL, 7, NULL, 1, 0),
(25, 'Documento de identidad de los socios de la empresa propietaria', NULL, 7, NULL, 1, 0),
(26, 'Documento de identidad y carnet del CODIA del Arquitecto', NULL, 7, NULL, 1, 0),
(27, 'Carta de acreditación', NULL, 7, NULL, 1, 0),
(28, 'Memoria descriptiva del proyecto, según la naturaleza del mismo: tipo de infraestructura, cantidad y fuentes de servicios generales (agua, energía eléctrica, residuos sólidos, etc.).', NULL, 7, NULL, 1, 0),
(29, 'Fotos actuales del terreno.', NULL, 7, NULL, 1, 0),
(30, 'Análisis del presupuesto del proyecto.', NULL, 7, NULL, 1, 0),
(31, 'Juego de planos arquitectónicos de manera digital PDF.', NULL, 7, NULL, 1, 0),
(32, 'Planos Estructurales de manera digital (PDF).', NULL, 7, NULL, 1, 0),
(33, 'Memoria de Cálculos Estructurales firmada por el responsable del diseño de manera digital (PDF) y Análisis de Cargas en Etabs o Safe.', NULL, 7, NULL, 1, 0),
(34, 'Planos Eléctricos de manera digital (PDF).', NULL, 7, NULL, 1, 0),
(35, 'Planos Sanitarios de manera digital (PDF).', NULL, 7, NULL, 1, 0),
(36, 'Memoria de Cálculos Sanitarios firmada por el responsable del diseño de manera digital (PDF)', NULL, 7, NULL, 1, 0),
(37, 'Estudio de suelo firmado de manera digital (PDF).', NULL, 7, NULL, 1, 0),
(38, 'Carnet del CODIA del estructuralista, eléctricos y sanitario.', NULL, 7, NULL, 1, 0),
(39, 'Juego de planos arquitectónicos de manera física firmados por el arquitecto y propietario en tamaño 24”x36” y 11”x17”', NULL, 7, NULL, 1, 0),
(40, '5.	Estudio de Impacto Ambiental', NULL, 2, NULL, 1, 0),
(41, '- Certificado de Títulos de Propiedad de ambos lados. ', NULL, 2, NULL, 1, 0),
(42, '- Contrato de venta. ', NULL, 2, NULL, 1, 0),
(43, 'CONFOTUR.', NULL, 3, NULL, 1, 0),
(44, 'Gestión de solicitud de supervisión.', NULL, 4, NULL, 1, 0),
(45, 'Carta de aprobación para el abastecimiento.', NULL, 8, NULL, 1, 0),
(46, 'Carta de aprobación.', NULL, 9, NULL, 1, 0),
(47, 'Licencia de operaciones de Almacenes.', NULL, 10, NULL, 1, 0),
(48, 'Licencia de operaciones de Estaciones.', NULL, 10, NULL, 1, 0),
(49, 'Certificación para locales Industriales.', NULL, 10, NULL, 1, 0),
(52, '- Planos de Mensura Catastral con las Coordenadas UTM.', NULL, 2, NULL, 1, 0),
(60, 'let us check that if that works by adding more and more and rhen deleting it all', NULL, 18, NULL, 0, 1),
(64, '- Contrato de venta. ', NULL, 1, NULL, 1, 0),
(65, '- Planos de Mensura Catastral con las Coordenadas UTM.', NULL, 1, NULL, 1, 0),
(66, '- Acta de RNC y Registro Mercantil de la empresa propietaria.', NULL, 1, NULL, 1, 0),
(67, '- Documento de identidad de los socios de la empresa propietaria. ', NULL, 1, 3, 1, 0),
(68, '- Memoria descriptiva del proyecto, según la naturaleza del mismo: tipo de infraestructura, cantidad y fuentes de servicios generales (agua, energía eléctrica, residuos sólidos, etc.). ', NULL, 1, NULL, 1, 0),
(69, '- Juego de planos arquitectónicos de manera digital PDF', NULL, 1, NULL, 1, 0),
(70, '- Juego de planos arquitectónicos de manera física firmados por el arquitecto y propietario en tamaño 24”x36” y 11”x17”.', NULL, 1, NULL, 1, 0),
(71, '2.	Renovación de permisos. ', NULL, 1, NULL, 1, 0),
(72, '- Carta No Objeción al Uso de Suelo y Edificaciones', NULL, 1, NULL, 1, 0),
(73, '- Recibo del pago de los arbitrios.', NULL, 1, NULL, 1, 0),
(74, '3.	Resellados de planos.', NULL, 1, NULL, 1, 0),
(75, '- Carta No Objeción al Uso de Suelo y Edificaciones', NULL, 1, NULL, 1, 0),
(76, '- Recibo del pago de los arbitrios.', NULL, 1, NULL, 1, 0),
(77, '- Juego de planos arquitectónicos de manera física firmados por el arquitecto y propietario en tamaño 24”x36” y 11”x17”. ', NULL, 1, NULL, 1, 0),
(78, '- Acta de RNC y Registro Mercantil de la empresa propietaria.', NULL, 2, NULL, 1, 0),
(79, '- Documento de identidad de los socios de la empresa propietaria. ', NULL, 2, NULL, 1, 0),
(80, '- Memoria descriptiva del proyecto, según la naturaleza del mismo: tipo de infraestructura, cantidad y fuentes de servicios generales (agua, energía eléctrica, residuos sólidos, etc.). ', NULL, 2, NULL, 1, 0),
(81, '- Juego de planos arquitectónicos de manera digital PDF. ', NULL, 2, NULL, 1, 0),
(82, '- Análisis del presupuesto del proyecto. ', NULL, 2, NULL, 1, 0),
(83, '1.	Gestión Carta de No Objeción y Renovación de permisos. ', NULL, 20, NULL, 1, 0),
(84, '- Certificado de Títulos de Propiedad de ambos lados. ', NULL, 20, NULL, 1, 0),
(85, '- Contrato de venta. ', NULL, 20, NULL, 1, 0),
(86, '- Planos de Mensura Catastral con las Coordenadas UTM.', NULL, 20, NULL, 1, 0),
(87, '- Acta de RNC y Registro Mercantil de la empresa propietaria.', NULL, 20, NULL, 1, 0),
(88, '- Documento de identidad de los socios de la empresa propietaria. ', NULL, 20, NULL, 1, 0),
(89, '- Documento de identidad y carnet del CODIA del Arquitecto. ', NULL, 20, NULL, 1, 0),
(90, '- Carta de acreditación.', NULL, 20, NULL, 1, 0),
(91, '- Memoria descriptiva del proyecto, según la naturaleza del mismo: tipo de infraestructura, cantidad y fuentes de servicios generales (agua, energía eléctrica, residuos sólidos, etc.).  Fotos actuales del terreno.', NULL, 20, NULL, 1, 0),
(92, '- Juego de planos arquitectónicos de manera digital PDF. ', NULL, 20, NULL, 1, 0),
(93, '- Juego de planos arquitectónicos de manera física firmados por el arquitecto y propietario en tamaño 24”x36” y 11”x17”. ', NULL, 20, NULL, 1, 0),
(94, '2.	Resellados de planos.', NULL, 20, NULL, 1, 0),
(95, '- Carta No Objeción al Uso de Suelo y Edificaciones', NULL, 20, NULL, 1, 0),
(96, '- Recibo del pago de los arbitrios.', NULL, 20, NULL, 1, 0),
(97, '- Juego de planos arquitectónicos de manera física firmados por el arquitecto y propietario en tamaño 24”x36” y 11”x17”. ', NULL, 20, NULL, 1, 0),
(98, '3.	Licencias de Operaciones. ', NULL, 20, NULL, 1, 0),
(99, '- Dos cartas de referencias bancarias y tres referencias personales a nombre de la persona física o sociedad solicitante.', NULL, 20, NULL, 1, 0),
(100, '- Certificado de Registro Mercantil vigente.', NULL, 20, NULL, 1, 0),
(101, '- Documento de identidad del propietario. ', NULL, 20, NULL, 1, 0),
(102, '- Certificado de No Antecedentes Judiciales del propietario. ', NULL, 20, NULL, 1, 0),
(103, '- Certificado del registro de nombre comercial, expedido por ONAPI. ', NULL, 20, NULL, 1, 0),
(104, '- Contrato completo de Póliza de responsabilidad civil, vigente.  ', NULL, 20, NULL, 1, 0),
(105, '- Certificación de cumplimiento de obligaciones fiscales expedida por la Dirección General de Impuestos Internos, donde conste que el solicitante está al día en la declaración o pago de impuestos.', NULL, 20, NULL, 1, 0),
(106, '- Certificación de balance al día de la Tesorería de la Seguridad Social (TSS).', NULL, 20, NULL, 1, 0),
(107, '- Copia del documento que demuestre derecho de uso del inmueble donde va a operar el establecimiento.', NULL, 20, NULL, 1, 0),
(108, '4.	CONFOTUR.', NULL, 20, NULL, 1, 0),
(109, '- Constitución de una Compañía organizada bajo las leyes de la República Dominicana', NULL, 20, NULL, 1, 0),
(110, '- Compañía con un capital suscrito y pagado de por lo menos RD$500,000', NULL, 20, NULL, 1, 0),
(111, '- Fotocopia de la Cédula de Identidad y Electoral de los 7 principales accionistas', NULL, 20, NULL, 1, 0),
(112, '- En caso de ser extranjeros, fotocopia del pasaporte y residencia', NULL, 20, NULL, 1, 0),
(113, '- Certificado de buena conducta de los 3 principales accionistas', NULL, 20, NULL, 1, 0),
(114, '- Certificado de No Delincuencia de los tres principales accionistas', NULL, 20, NULL, 1, 0),
(115, '- Tres referencias personales del presidente de la compañía', NULL, 20, NULL, 1, 0),
(116, '- Fotocopia del Certificado de Registro de Nombre Comercial', NULL, 20, NULL, 1, 0),
(117, '- Fotocopia del Registro Mercantil', NULL, 20, NULL, 1, 0),
(118, '- Certificaciones de las deudas (incluyen cooperativas, financieras, bancos, entre otras).', NULL, 20, NULL, 1, 0),
(119, '- Memoria descriptiva del proyecto, con fotografías o perspectivas', NULL, 20, NULL, 1, 0),
(120, '- Proyecto arquitectónico y ubicación del mismo, indicando sus coordenadas expresadas en el sistema de coordenadas Universal Transversal de Mercator (UTM).', NULL, 20, NULL, 1, 0),
(121, '- Copias de certificados de títulos.', NULL, 20, NULL, 1, 0),
(122, '- Autorización ambiental vigente emitida por el Ministerio de Medio Ambiente y Recursos Naturales.', NULL, 20, NULL, 1, 0),
(123, '- Aprobación de los organismos municipales.', NULL, 20, NULL, 1, 0),
(124, '- Resolución de No Objeción de Uso de Suelo emitida por el Ministerio de Turismo.', NULL, 20, NULL, 1, 0),
(125, '- Análisis de factibilidad económica y financiera del proyecto, con los requerimientos del Ministerio de Hacienda para la elaboración del Análisis Costo Beneficio, debidamente firmado y sellado en cada página.', NULL, 20, NULL, 1, 0),
(126, '1.	Gestión de Licencia de Construcción, renovación de Licencia', NULL, 21, NULL, 1, 0),
(127, '- Título de propiedad definitivo de ambos lados.', NULL, 21, NULL, 1, 0),
(128, '- Plano de Mensura Catastral con las coordenadas UTM.', NULL, 21, NULL, 1, 0),
(129, '- Acta de RNC y Registro Mercantil de la empresa propietaria.', NULL, 21, NULL, 1, 0),
(130, '- Documento de identidad de los socios de la empresa propietaria.', NULL, 21, NULL, 1, 0),
(131, '- Planos arquitectónicos de manera digital (PDF).', NULL, 21, NULL, 1, 0),
(132, '- Memoria descriptiva de manera digital (PDF).', NULL, 21, NULL, 1, 0),
(133, '- Planos Estructurales de manera digital (PDF). ', NULL, 21, NULL, 1, 0),
(134, '- Memoria de Cálculos Estructurales firmada por el responsable del diseño de manera digital (PDF) y Análisis de Cargas en Etabs o Safe.', NULL, 21, NULL, 1, 0),
(135, '- Planos Eléctricos de manera digital (PDF).', NULL, 21, NULL, 1, 0),
(136, '- Planos Sanitarios de manera digital (PDF).', NULL, 21, NULL, 1, 0),
(137, '- Memoria de Cálculos Sanitarios firmada por el responsable del diseño de manera digital (PDF).', NULL, 21, NULL, 1, 0),
(138, '- Estudio de suelo firmado de manera digital (PDF). ', NULL, 21, NULL, 1, 0),
(139, '- Carnet del CODIA del estructuralista, eléctricos y sanitario.', NULL, 21, NULL, 1, 0),
(140, '- Aprobaciones del Ayuntamiento, Medio Ambiente y Turismo. ', NULL, 21, NULL, 1, 0),
(141, '2.	Gestión copias de Licencias. ', NULL, 21, NULL, 1, 0),
(142, '- Fotocopia de la Licencia emitida. ', NULL, 21, NULL, 1, 0),
(143, '3.	Solicitud Inicio de Obra. ', NULL, 21, NULL, 1, 0),
(144, '- Aprobación de las áreas de estructura, geotécnica y arquitectura.   ', NULL, 21, NULL, 1, 0),
(145, 'new check list', NULL, 20, NULL, 1, 0),
(146, 'test checklist 1', NULL, 30, NULL, 1, 1),
(147, 'this is to cehck', NULL, 30, NULL, 1, 1),
(148, 'i can do this', NULL, 30, NULL, 1, 1),
(149, 'chekc', NULL, 30, NULL, 1, 1),
(150, 'THIS CAN BE CHECKED', NULL, 30, NULL, 1, 1),
(151, 'this is new checklist', NULL, 30, NULL, 1, 1),
(152, 'NEW', NULL, 30, NULL, 1, 1),
(153, 'THIS IS EDITTED 23', NULL, 31, NULL, 0, 0),
(154, 'this is second', NULL, 31, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_logs`
--

CREATE TABLE `tbl_email_logs` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `event_title` varchar(255) DEFAULT NULL,
  `event_desc` varchar(255) DEFAULT NULL,
  `event_start` datetime DEFAULT NULL,
  `event_end` datetime DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `event_id` int(10) DEFAULT NULL,
  `email_body` longtext DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_email_logs`
--

INSERT INTO `tbl_email_logs` (`id`, `user_name`, `user_email`, `event_title`, `event_desc`, `event_start`, `event_end`, `user_id`, `event_id`, `email_body`, `status`, `created_at`) VALUES
(35, 'Qais', 'ak1472512@gmail', 'this is check(Progressive Lodge No. 80)', 'hain123', '2022-09-07 14:45:00', '2022-09-08 14:45:00', 4, 79, '', 0, '2022-09-07'),
(36, 'Attaurrehmaan', 'attaurrehmaanbhatti687@gmail.com', 'this is check(Progressive Lodge No. 80)', 'hain123', '2022-09-07 14:45:00', '2022-09-08 14:45:00', 5, 79, '', 0, '2022-09-07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lists`
--

CREATE TABLE `tbl_lists` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `mk_status` int(11) DEFAULT NULL,
  `index` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `enable_bit` tinyint(1) DEFAULT 1,
  `delete_bit` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_lists`
--

INSERT INTO `tbl_lists` (`id`, `title`, `mk_status`, `index`, `created_at`, `enable_bit`, `delete_bit`) VALUES
(1, 'AYUNTAMIENTO', 0, 2, '2022-09-12 16:03:55', 1, 0),
(2, 'MINISTERIO DE MEDIO AMBIENTE', 0, 3, '2022-09-12 16:05:46', 1, 0),
(3, 'Ministerio de Turismo', 0, 4, '2022-09-12 16:05:46', 0, 1),
(4, 'Ministerio de la Vivienda y Edificaciones', 0, 5, '2022-09-12 16:06:30', 0, 1),
(5, 'JURISDICCION INMOBILIARIA', 0, 6, '2022-09-12 16:06:30', 1, 0),
(6, 'COMPÑIA DISTRIBUIDORA DE ENERGIA', 1, 7, '2022-09-12 16:07:13', 1, 0),
(7, 'Documentos Generales', 1, 1, '2022-09-12 16:07:13', 1, 0),
(8, 'COMPÑIA DISTRIBUIDORA DE AGUA', 1, 8, '2022-09-12 16:07:13', 1, 0),
(9, 'CUERPO DE BOMBEROS', 1, 9, '2022-09-12 16:07:13', 1, 0),
(10, 'INDUSTRIA Y COMERCIO', 1, 10, '2022-09-12 16:07:13', 1, 0),
(20, 'MINISTERIO DE TURISMO', NULL, 0, NULL, 1, 0),
(21, 'MINISTERIO DE OBRAS PÚBLICAS Y COMUNICACIONES', NULL, 0, NULL, 1, 0),
(22, 'new list', NULL, 0, '2023-03-29 09:44:58', 0, 1),
(23, 'new checklist', NULL, 0, '2023-03-29 09:45:20', 0, 1),
(24, 'new', NULL, 0, '2023-03-29 09:46:09', 0, 1),
(25, 'check', NULL, 0, '2023-03-29 10:00:01', 0, 1),
(26, 'this is to check list', NULL, 0, '2023-03-29 10:00:22', 0, 1),
(27, 'this is to checklist and this is editted too', NULL, 0, '2023-03-29 10:00:47', 0, 1),
(28, 'new', NULL, 0, '2023-03-29 11:08:28', 0, 1),
(29, 'new', NULL, 0, '2023-03-29 11:19:28', 0, 1),
(30, 'test checklist', NULL, 0, '2023-03-29 12:11:04', 0, 1),
(31, 'NEW', NULL, 0, '2023-03-29 13:05:18', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules`
--

CREATE TABLE `tbl_modules` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `location` varchar(10) NOT NULL,
  `enable_bit` tinyint(1) NOT NULL DEFAULT 1,
  `delete_bit` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_modules`
--

INSERT INTO `tbl_modules` (`id`, `title`, `link`, `icon`, `location`, `enable_bit`, `delete_bit`, `created_at`) VALUES
(1, '\nTablero', 'Dashboard', 'iconsminds-optimization\n', '1', 1, 0, '0000-00-00 00:00:00.0'),
(2, 'Proyectos', 'Projects', 'iconsminds-project', '1', 1, 0, '0000-00-00 00:00:00.0'),
(3, 'Terminado', 'Completed', 'iconsminds-check', '1', 1, 0, '0000-00-00 00:00:00.0'),
(4, 'Pendiente', 'Pending', 'iconsminds-over-time-2', '1', 0, 1, '0000-00-00 00:00:00.0'),
(5, 'Archivado', 'Archived', 'iconsminds-download-1\n', '1', 1, 0, '0000-00-00 00:00:00.0'),
(6, 'Check In', 'Check_In', 'checkin.svg', '1', 0, 1, '0000-00-00 00:00:00.0'),
(7, 'Ajustes', 'Settings', 'setting.svg', '1', 0, 1, '2022-09-02 00:15:39.0'),
(9, 'Usuarios', 'Users', 'simple-icon-user', '1', 1, 0, '2022-09-02 00:15:39.0'),
(10, 'Listas', 'Lists', 'simple-icon-list', '1', 1, 0, '2022-09-02 00:15:39.0'),
(11, 'Todos los Proyectos', 'AllProjects', 'simple-icon-layers', '1', 0, 0, '2022-09-02 00:15:39.0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions`
--

CREATE TABLE `tbl_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(10) NOT NULL,
  `module_id` int(10) NOT NULL,
  `create_` tinyint(1) NOT NULL,
  `edit_` tinyint(1) NOT NULL,
  `delete_` tinyint(1) NOT NULL,
  `view_` tinyint(1) NOT NULL,
  `enable_bit` tinyint(1) NOT NULL DEFAULT 1,
  `delete_bit` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_permissions`
--

INSERT INTO `tbl_permissions` (`id`, `role_id`, `module_id`, `create_`, `edit_`, `delete_`, `view_`, `enable_bit`, `delete_bit`, `created_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 0, '2022-08-26 21:43:37'),
(2, 1, 2, 1, 1, 1, 1, 1, 0, '0000-00-00 00:00:00'),
(3, 1, 3, 1, 1, 1, 1, 1, 0, '0000-00-00 00:00:00'),
(4, 1, 4, 1, 1, 1, 1, 1, 0, '0000-00-00 00:00:00'),
(5, 1, 5, 1, 1, 1, 1, 1, 0, '0000-00-00 00:00:00'),
(6, 1, 6, 1, 1, 1, 1, 1, 0, '0000-00-00 00:00:00'),
(7, 2, 1, 0, 1, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(8, 2, 2, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(9, 2, 3, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(10, 2, 4, 1, 1, 1, 1, 1, 0, '0000-00-00 00:00:00'),
(11, 2, 5, 1, 1, 1, 1, 1, 0, '0000-00-00 00:00:00'),
(12, 2, 6, 1, 1, 1, 1, 1, 0, '0000-00-00 00:00:00'),
(13, 3, 1, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(14, 3, 2, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(15, 3, 3, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(16, 3, 4, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(17, 3, 5, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(18, 3, 6, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(19, 4, 1, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(20, 4, 2, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(21, 4, 3, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(22, 4, 4, 0, 0, 0, 1, 1, 0, '0000-00-00 00:00:00'),
(23, 4, 5, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00'),
(24, 4, 6, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_process`
--

CREATE TABLE `tbl_process` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `enable_bit` tinyint(1) DEFAULT NULL,
  `delete_bit` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_process`
--

INSERT INTO `tbl_process` (`id`, `title`, `enable_bit`, `delete_bit`) VALUES
(1, 'first process ', 1, 0),
(2, 'MANGO PROCESS', 1, 0),
(3, 'new peocess', 1, 0),
(4, 'check', 1, 0),
(5, 'this is new process', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projects`
--

CREATE TABLE `tbl_projects` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `project_size_m2` int(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `additional_emails` varchar(1000) DEFAULT NULL,
  `phone` int(100) DEFAULT NULL,
  `labels` varchar(255) DEFAULT NULL,
  `qr_img` varchar(1024) DEFAULT NULL,
  `status` int(10) DEFAULT 2 COMMENT '1 : completed\r\n2 : pending\r\n3 : archived',
  `const_bit` int(10) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `enable_bit` tinyint(1) DEFAULT 1,
  `delete_bit` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_projects`
--

INSERT INTO `tbl_projects` (`id`, `project_name`, `location`, `project_size_m2`, `description`, `company_name`, `contact_email`, `additional_emails`, `phone`, `labels`, `qr_img`, `status`, `const_bit`, `owner_id`, `created_at`, `updated_at`, `enable_bit`, `delete_bit`) VALUES
(243, 'Termoil Chezk', 'muhafiz town', 21321, 'this is check', 'BitGen', 'nafees1431@gmail.com', '[\"asad9271@gmail.com\"]', 403213728, 'labels', NULL, 2, 1, 1, '2023-04-06', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_records`
--

CREATE TABLE `tbl_project_records` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `list_id` int(11) DEFAULT NULL,
  `checklist_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: pending\r\n1 : uploaded\r\n',
  `date_1` date DEFAULT NULL,
  `date_2` date DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `active_bit` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `delete_bit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_project_records`
--

INSERT INTO `tbl_project_records` (`id`, `project_id`, `list_id`, `checklist_id`, `status`, `date_1`, `date_2`, `comments`, `active_bit`, `created_at`, `delete_bit`) VALUES
(13875, 243, 1, 1, 1, '2023-04-07', '2023-04-08', 'bsamndsa', 1, '2023-04-06', 0),
(13876, 243, 1, 2, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13877, 243, 1, 3, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13878, 243, 1, 64, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13879, 243, 1, 65, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13880, 243, 1, 66, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13881, 243, 1, 67, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13882, 243, 1, 68, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13883, 243, 1, 69, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13884, 243, 1, 70, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13885, 243, 1, 71, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13886, 243, 1, 72, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13887, 243, 1, 73, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13888, 243, 1, 74, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13889, 243, 1, 75, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13890, 243, 1, 76, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13891, 243, 1, 77, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13892, 243, 2, 4, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13893, 243, 2, 5, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13894, 243, 2, 6, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13895, 243, 2, 7, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13896, 243, 2, 40, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13897, 243, 2, 41, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13898, 243, 2, 42, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13899, 243, 2, 52, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13900, 243, 2, 78, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13901, 243, 2, 79, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13902, 243, 2, 80, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13903, 243, 2, 81, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13904, 243, 2, 82, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13905, 243, 5, 16, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13906, 243, 5, 17, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13907, 243, 5, 18, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13908, 243, 6, 20, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13909, 243, 7, 21, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13910, 243, 7, 22, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13911, 243, 7, 23, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13912, 243, 7, 24, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13913, 243, 7, 25, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13914, 243, 7, 26, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13915, 243, 7, 27, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13916, 243, 7, 28, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13917, 243, 7, 29, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13918, 243, 7, 30, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13919, 243, 7, 31, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13920, 243, 7, 32, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13921, 243, 7, 33, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13922, 243, 7, 34, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13923, 243, 7, 35, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13924, 243, 7, 36, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13925, 243, 7, 37, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13926, 243, 7, 38, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13927, 243, 7, 39, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13928, 243, 8, 45, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13929, 243, 9, 46, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13930, 243, 10, 47, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13931, 243, 10, 48, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13932, 243, 10, 49, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13933, 243, 20, 83, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13934, 243, 20, 84, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13935, 243, 20, 85, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13936, 243, 20, 86, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13937, 243, 20, 87, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13938, 243, 20, 88, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13939, 243, 20, 89, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13940, 243, 20, 90, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13941, 243, 20, 91, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13942, 243, 20, 92, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13943, 243, 20, 93, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13944, 243, 20, 94, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13945, 243, 20, 95, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13946, 243, 20, 96, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13947, 243, 20, 97, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13948, 243, 20, 98, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13949, 243, 20, 99, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13950, 243, 20, 100, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13951, 243, 20, 101, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13952, 243, 20, 102, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13953, 243, 20, 103, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13954, 243, 20, 104, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13955, 243, 20, 105, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13956, 243, 20, 106, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13957, 243, 20, 107, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13958, 243, 20, 108, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13959, 243, 20, 109, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13960, 243, 20, 110, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13961, 243, 20, 111, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13962, 243, 20, 112, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13963, 243, 20, 113, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13964, 243, 20, 114, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13965, 243, 20, 115, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13966, 243, 20, 116, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13967, 243, 20, 117, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13968, 243, 20, 118, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13969, 243, 20, 119, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13970, 243, 20, 120, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13971, 243, 20, 121, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13972, 243, 20, 122, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13973, 243, 20, 123, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13974, 243, 20, 124, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13975, 243, 20, 125, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13976, 243, 20, 145, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13977, 243, 21, 126, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13978, 243, 21, 127, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13979, 243, 21, 128, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13980, 243, 21, 129, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13981, 243, 21, 130, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13982, 243, 21, 131, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13983, 243, 21, 132, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13984, 243, 21, 133, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13985, 243, 21, 134, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13986, 243, 21, 135, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13987, 243, 21, 136, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13988, 243, 21, 137, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13989, 243, 21, 138, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13990, 243, 21, 139, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13991, 243, 21, 140, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13992, 243, 21, 141, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13993, 243, 21, 142, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13994, 243, 21, 143, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13995, 243, 21, 144, 0, NULL, NULL, NULL, 0, '2023-04-06', 0),
(13996, 243, 31, 153, 0, NULL, NULL, NULL, 1, '2023-04-06', 0),
(13997, 243, 31, 154, 0, NULL, NULL, NULL, 1, '2023-04-06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_records`
--

CREATE TABLE `tbl_records` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `list_id` int(11) DEFAULT NULL,
  `checklist_id` int(11) DEFAULT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_records`
--

INSERT INTO `tbl_records` (`id`, `project_id`, `list_id`, `checklist_id`, `document_name`, `file_name`) VALUES
(161, 243, 1, 1, NULL, '1680780050Screenshot_(1).png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `diff_bit` varchar(20) DEFAULT NULL,
  `enable_bit` tinyint(1) NOT NULL DEFAULT 1,
  `delete_bit` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `title`, `diff_bit`, `enable_bit`, `delete_bit`, `created_at`) VALUES
(1, 'Super Admin', 'danger', 1, 0, '2022-08-22 18:46:35'),
(2, 'Admin', 'success', 1, 0, '2022-08-22 18:46:56'),
(3, 'Secretary', 'info', 1, 0, '2022-08-22 18:46:56'),
(4, 'Member', 'warning', 1, 0, '2022-08-22 18:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(55) DEFAULT NULL,
  `protocol` enum('mail','sendmail','smtp') DEFAULT 'smtp',
  `smtp_host` varchar(55) DEFAULT NULL,
  `smtp_user` varchar(55) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(55) DEFAULT NULL,
  `smtp_crypto` enum('tls','ssl') DEFAULT 'ssl',
  `mailpath` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `admin_email`, `protocol`, `smtp_host`, `smtp_user`, `smtp_password`, `smtp_port`, `smtp_crypto`, `mailpath`) VALUES
(1, 'info@dtss.miapprd.com', 'smtp', 'mail.dtss.miapprd.com', 'notif@dtss.miapprd.com', 'So7HmRJTEgwskszZ', '465', 'ssl', '/usr/sbin/sendmail');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `full_name` text NOT NULL,
  `user_name` text DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `cnic` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `qr_img` varchar(255) DEFAULT NULL,
  `bg_img` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `job_title` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `joining_date` datetime DEFAULT NULL,
  `badge` int(10) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `role_id` tinyint(1) DEFAULT NULL,
  `user_theme` tinyint(1) DEFAULT 0,
  `enable_bit` bit(1) DEFAULT b'1',
  `delete_bit` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `full_name`, `user_name`, `password`, `cnic`, `email`, `gender`, `img`, `qr_img`, `bg_img`, `address`, `job_title`, `contact`, `joining_date`, `badge`, `created_at`, `modified_at`, `last_login`, `role_id`, `user_theme`, `enable_bit`, `delete_bit`) VALUES
(1, 'Super Admin', 'super', 'hain123', NULL, 'info@masonicdues.com', 'Male', 'profile.jpg', 'member_awais.png', '1662407635big-buck-bunny-poster.jpg', 'Gujranwala', 'Administrator', '030000000', '2018-09-10 00:00:00', 1, '2018-09-10 00:00:00', '2023-04-10 05:49:31', '2023-04-10 07:49:31', 1, 1, b'1', b'0'),
(2, 'Admin', 'admin', NULL, '0000000000', 'nafees1431@gmail.com', 'Male', '1664367585dtss.JPG', 'member_awais.png', '1662229586genoise-thumb.jpg', 'Punta Cana', 'Admin', '47328903243298', '2022-08-20 00:18:10', 1, '2022-11-14 09:51:09', '2022-11-14 09:51:09', '2022-11-01 10:47:36', 2, 1, b'1', b'0'),
(3, 'Salman Ahmed', 'member', 'hain123', NULL, 'salman1431@gmail.com', 'Male', 'profile2.jpg', 'member_awais.png', NULL, 'Gujranwala', 'Member', '0345000000', NULL, 2, '2022-08-20 00:18:10', '2022-11-01 09:51:07', '2022-09-14 13:04:07', 2, 0, b'0', b'1'),
(40, 'CHEKC', 'check', 'hain123', '46328754367', 'check@gmail.com', 'Male', NULL, NULL, NULL, 'misc address', NULL, '436278534', NULL, NULL, '2022-10-27 07:23:09', '2022-10-27 10:26:51', '2022-10-27 10:26:11', 2, 0, b'0', b'0'),
(41, 'Eliezer', 'eliezer', NULL, '473854378', 'e@d.com', 'Male', NULL, NULL, NULL, 'sdf', NULL, '58749654', NULL, NULL, '2022-11-03 10:22:10', '2022-11-03 10:22:20', '2022-11-01 10:43:20', 2, 0, b'1', b'0'),
(43, 'Katherine', 'katherine', 'solutionservices', '0000000000', 'k@dtss.com', 'Female', NULL, NULL, NULL, 'Puntacana', NULL, '00000000', NULL, NULL, '2022-11-11 09:52:54', '2023-02-09 18:35:19', '2023-02-09 18:35:19', 1, 1, b'1', b'0'),
(44, 'Ramon', 'ramonfernandez', 'solutionservices', '0000000000', 'rfernandez@dtss.com.do', 'Male', NULL, NULL, NULL, 'Puntacana', NULL, '0000000000', NULL, NULL, '2022-11-14 09:50:45', '2022-11-14 09:50:45', NULL, 2, 1, b'1', b'0'),
(45, 'check', 'checkMain', 'hain123', '437483627', 'muazkhokhar9271@gmail.com', 'Male', NULL, NULL, NULL, 'checkaddress', NULL, '7384903', NULL, NULL, '2022-12-05 13:04:37', '2023-03-27 11:13:40', '2022-12-05 13:04:53', 2, 0, b'0', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_access`
--
ALTER TABLE `tbl_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_checklists`
--
ALTER TABLE `tbl_checklists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_email_logs`
--
ALTER TABLE `tbl_email_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lists`
--
ALTER TABLE `tbl_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_process`
--
ALTER TABLE `tbl_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_project_records`
--
ALTER TABLE `tbl_project_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_records`
--
ALTER TABLE `tbl_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_access`
--
ALTER TABLE `tbl_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_checklists`
--
ALTER TABLE `tbl_checklists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `tbl_email_logs`
--
ALTER TABLE `tbl_email_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_lists`
--
ALTER TABLE `tbl_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_process`
--
ALTER TABLE `tbl_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `tbl_project_records`
--
ALTER TABLE `tbl_project_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13998;

--
-- AUTO_INCREMENT for table `tbl_records`
--
ALTER TABLE `tbl_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
