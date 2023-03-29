-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 11:08 AM
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
  `enable_bit` tinyint(1) DEFAULT 1,
  `delete_bit` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_checklists`
--

INSERT INTO `tbl_checklists` (`id`, `title`, `link`, `list_id`, `enable_bit`, `delete_bit`) VALUES
(1, '1.	Gestión de Carta No Objeción al Uso de Suelo y Edificaciones.', NULL, 1, 1, 0),
(2, '- Certificado de Títulos de Propiedad de ambos lados. Certificado de Títulos de Propiedad de ambos lados. ', NULL, 1, 1, 0),
(3, 'Resellados de plano', NULL, 1, 0, 1),
(4, '1.	Gestión Certificado de Registro de Impacto Mínimo, Constancias Ambientales, Permisos Ambientales y Licencia Ambiental.', NULL, 2, 1, 0),
(5, '2.	Gestión Informe de Cumplimiento Ambiental (ICA).', NULL, 2, 1, 0),
(6, '3.	Supervisión de Cumplimiento Ambiental. ', NULL, 2, 1, 0),
(7, '4.	Asesoría Manejo de residuos líquidos, solidos, oleoso o especificados (hospitalarios o biomédicos).', NULL, 2, 1, 0),
(8, 'Carta de No Objeción.', NULL, 3, 1, 0),
(9, 'Carta de Renovación de permisos.', NULL, 3, 1, 0),
(10, 'Resellados de planos.', NULL, 3, 1, 0),
(11, 'Licencias de Operaciones.', NULL, 3, 1, 0),
(12, 'Licencia de Construcción', NULL, 4, 1, 0),
(13, 'Renovación de Licencia.', NULL, 4, 1, 0),
(14, 'Copias de Licencias.', NULL, 4, 1, 0),
(15, 'Solicitud  Inicio de Obra.', NULL, 4, 1, 0),
(16, 'Replanteo de inmuebles', NULL, 5, 1, 0),
(17, 'Deslindes, Subdivisión y Refundición. ', NULL, 5, 1, 0),
(18, 'Régimen de Condominio.', NULL, 5, 1, 0),
(20, 'Carta de aprobación para la conexión.', NULL, 6, 1, 0),
(21, 'Certificado de Títulos de Propiedad de ambos lados.', NULL, 7, 1, 0),
(22, 'Contrato de venta de no tener los títulos a nombre del propietario final.', NULL, 7, 1, 0),
(23, 'Planos de Mensura Catastral con las Coordenadas UTM.', NULL, 7, 1, 0),
(24, 'Acta de RNC y Registro Mercantil de la empresa propietaria.', NULL, 7, 1, 0),
(25, 'Documento de identidad de los socios de la empresa propietaria', NULL, 7, 1, 0),
(26, 'Documento de identidad y carnet del CODIA del Arquitecto', NULL, 7, 1, 0),
(27, 'Carta de acreditación', NULL, 7, 1, 0),
(28, 'Memoria descriptiva del proyecto, según la naturaleza del mismo: tipo de infraestructura, cantidad y fuentes de servicios generales (agua, energía eléctrica, residuos sólidos, etc.).', NULL, 7, 1, 0),
(29, 'Fotos actuales del terreno.', NULL, 7, 1, 0),
(30, 'Análisis del presupuesto del proyecto.', NULL, 7, 1, 0),
(31, 'Juego de planos arquitectónicos de manera digital PDF.', NULL, 7, 1, 0),
(32, 'Planos Estructurales de manera digital (PDF).', NULL, 7, 1, 0),
(33, 'Memoria de Cálculos Estructurales firmada por el responsable del diseño de manera digital (PDF) y Análisis de Cargas en Etabs o Safe.', NULL, 7, 1, 0),
(34, 'Planos Eléctricos de manera digital (PDF).', NULL, 7, 1, 0),
(35, 'Planos Sanitarios de manera digital (PDF).', NULL, 7, 1, 0),
(36, 'Memoria de Cálculos Sanitarios firmada por el responsable del diseño de manera digital (PDF)', NULL, 7, 1, 0),
(37, 'Estudio de suelo firmado de manera digital (PDF).', NULL, 7, 1, 0),
(38, 'Carnet del CODIA del estructuralista, eléctricos y sanitario.', NULL, 7, 1, 0),
(39, 'Juego de planos arquitectónicos de manera física firmados por el arquitecto y propietario en tamaño 24”x36” y 11”x17”', NULL, 7, 1, 0),
(40, '5.	Estudio de Impacto Ambiental', NULL, 2, 1, 0),
(41, '- Certificado de Títulos de Propiedad de ambos lados. ', NULL, 2, 1, 0),
(42, '- Contrato de venta. ', NULL, 2, 1, 0),
(43, 'CONFOTUR.', NULL, 3, 1, 0),
(44, 'Gestión de solicitud de supervisión.', NULL, 4, 1, 0),
(45, 'Carta de aprobación para el abastecimiento.', NULL, 8, 1, 0),
(46, 'Carta de aprobación.', NULL, 9, 1, 0),
(47, 'Licencia de operaciones de Almacenes.', NULL, 10, 1, 0),
(48, 'Licencia de operaciones de Estaciones.', NULL, 10, 1, 0),
(49, 'Certificación para locales Industriales.', NULL, 10, 1, 0),
(52, '- Planos de Mensura Catastral con las Coordenadas UTM.', NULL, 2, 1, 0),
(60, 'let us check that if that works by adding more and more and rhen deleting it all', NULL, 18, 0, 1),
(64, '- Contrato de venta. ', NULL, 1, 1, 0),
(65, '- Planos de Mensura Catastral con las Coordenadas UTM.', NULL, 1, 1, 0),
(66, '- Acta de RNC y Registro Mercantil de la empresa propietaria.', NULL, 1, 1, 0),
(67, '- Documento de identidad de los socios de la empresa propietaria. ', NULL, 1, 1, 0),
(68, '- Memoria descriptiva del proyecto, según la naturaleza del mismo: tipo de infraestructura, cantidad y fuentes de servicios generales (agua, energía eléctrica, residuos sólidos, etc.). ', NULL, 1, 1, 0),
(69, '- Juego de planos arquitectónicos de manera digital PDF', NULL, 1, 1, 0),
(70, '- Juego de planos arquitectónicos de manera física firmados por el arquitecto y propietario en tamaño 24”x36” y 11”x17”.', NULL, 1, 1, 0),
(71, '2.	Renovación de permisos. ', NULL, 1, 1, 0),
(72, '- Carta No Objeción al Uso de Suelo y Edificaciones', NULL, 1, 1, 0),
(73, '- Recibo del pago de los arbitrios.', NULL, 1, 1, 0),
(74, '3.	Resellados de planos.', NULL, 1, 1, 0),
(75, '- Carta No Objeción al Uso de Suelo y Edificaciones', NULL, 1, 1, 0),
(76, '- Recibo del pago de los arbitrios.', NULL, 1, 1, 0),
(77, '- Juego de planos arquitectónicos de manera física firmados por el arquitecto y propietario en tamaño 24”x36” y 11”x17”. ', NULL, 1, 1, 0),
(78, '- Acta de RNC y Registro Mercantil de la empresa propietaria.', NULL, 2, 1, 0),
(79, '- Documento de identidad de los socios de la empresa propietaria. ', NULL, 2, 1, 0),
(80, '- Memoria descriptiva del proyecto, según la naturaleza del mismo: tipo de infraestructura, cantidad y fuentes de servicios generales (agua, energía eléctrica, residuos sólidos, etc.). ', NULL, 2, 1, 0),
(81, '- Juego de planos arquitectónicos de manera digital PDF. ', NULL, 2, 1, 0),
(82, '- Análisis del presupuesto del proyecto. ', NULL, 2, 1, 0),
(83, '1.	Gestión Carta de No Objeción y Renovación de permisos. ', NULL, 20, 1, 0),
(84, '- Certificado de Títulos de Propiedad de ambos lados. ', NULL, 20, 1, 0),
(85, '- Contrato de venta. ', NULL, 20, 1, 0),
(86, '- Planos de Mensura Catastral con las Coordenadas UTM.', NULL, 20, 1, 0),
(87, '- Acta de RNC y Registro Mercantil de la empresa propietaria.', NULL, 20, 1, 0),
(88, '- Documento de identidad de los socios de la empresa propietaria. ', NULL, 20, 1, 0),
(89, '- Documento de identidad y carnet del CODIA del Arquitecto. ', NULL, 20, 1, 0),
(90, '- Carta de acreditación.', NULL, 20, 1, 0),
(91, '- Memoria descriptiva del proyecto, según la naturaleza del mismo: tipo de infraestructura, cantidad y fuentes de servicios generales (agua, energía eléctrica, residuos sólidos, etc.).  Fotos actuales del terreno.', NULL, 20, 1, 0),
(92, '- Juego de planos arquitectónicos de manera digital PDF. ', NULL, 20, 1, 0),
(93, '- Juego de planos arquitectónicos de manera física firmados por el arquitecto y propietario en tamaño 24”x36” y 11”x17”. ', NULL, 20, 1, 0),
(94, '2.	Resellados de planos.', NULL, 20, 1, 0),
(95, '- Carta No Objeción al Uso de Suelo y Edificaciones', NULL, 20, 1, 0),
(96, '- Recibo del pago de los arbitrios.', NULL, 20, 1, 0),
(97, '- Juego de planos arquitectónicos de manera física firmados por el arquitecto y propietario en tamaño 24”x36” y 11”x17”. ', NULL, 20, 1, 0),
(98, '3.	Licencias de Operaciones. ', NULL, 20, 1, 0),
(99, '- Dos cartas de referencias bancarias y tres referencias personales a nombre de la persona física o sociedad solicitante.', NULL, 20, 1, 0),
(100, '- Certificado de Registro Mercantil vigente.', NULL, 20, 1, 0),
(101, '- Documento de identidad del propietario. ', NULL, 20, 1, 0),
(102, '- Certificado de No Antecedentes Judiciales del propietario. ', NULL, 20, 1, 0),
(103, '- Certificado del registro de nombre comercial, expedido por ONAPI. ', NULL, 20, 1, 0),
(104, '- Contrato completo de Póliza de responsabilidad civil, vigente.  ', NULL, 20, 1, 0),
(105, '- Certificación de cumplimiento de obligaciones fiscales expedida por la Dirección General de Impuestos Internos, donde conste que el solicitante está al día en la declaración o pago de impuestos.', NULL, 20, 1, 0),
(106, '- Certificación de balance al día de la Tesorería de la Seguridad Social (TSS).', NULL, 20, 1, 0),
(107, '- Copia del documento que demuestre derecho de uso del inmueble donde va a operar el establecimiento.', NULL, 20, 1, 0),
(108, '4.	CONFOTUR.', NULL, 20, 1, 0),
(109, '- Constitución de una Compañía organizada bajo las leyes de la República Dominicana', NULL, 20, 1, 0),
(110, '- Compañía con un capital suscrito y pagado de por lo menos RD$500,000', NULL, 20, 1, 0),
(111, '- Fotocopia de la Cédula de Identidad y Electoral de los 7 principales accionistas', NULL, 20, 1, 0),
(112, '- En caso de ser extranjeros, fotocopia del pasaporte y residencia', NULL, 20, 1, 0),
(113, '- Certificado de buena conducta de los 3 principales accionistas', NULL, 20, 1, 0),
(114, '- Certificado de No Delincuencia de los tres principales accionistas', NULL, 20, 1, 0),
(115, '- Tres referencias personales del presidente de la compañía', NULL, 20, 1, 0),
(116, '- Fotocopia del Certificado de Registro de Nombre Comercial', NULL, 20, 1, 0),
(117, '- Fotocopia del Registro Mercantil', NULL, 20, 1, 0),
(118, '- Certificaciones de las deudas (incluyen cooperativas, financieras, bancos, entre otras).', NULL, 20, 1, 0),
(119, '- Memoria descriptiva del proyecto, con fotografías o perspectivas', NULL, 20, 1, 0),
(120, '- Proyecto arquitectónico y ubicación del mismo, indicando sus coordenadas expresadas en el sistema de coordenadas Universal Transversal de Mercator (UTM).', NULL, 20, 1, 0),
(121, '- Copias de certificados de títulos.', NULL, 20, 1, 0),
(122, '- Autorización ambiental vigente emitida por el Ministerio de Medio Ambiente y Recursos Naturales.', NULL, 20, 1, 0),
(123, '- Aprobación de los organismos municipales.', NULL, 20, 1, 0),
(124, '- Resolución de No Objeción de Uso de Suelo emitida por el Ministerio de Turismo.', NULL, 20, 1, 0),
(125, '- Análisis de factibilidad económica y financiera del proyecto, con los requerimientos del Ministerio de Hacienda para la elaboración del Análisis Costo Beneficio, debidamente firmado y sellado en cada página.', NULL, 20, 1, 0),
(126, '1.	Gestión de Licencia de Construcción, renovación de Licencia', NULL, 21, 1, 0),
(127, '- Título de propiedad definitivo de ambos lados.', NULL, 21, 1, 0),
(128, '- Plano de Mensura Catastral con las coordenadas UTM.', NULL, 21, 1, 0),
(129, '- Acta de RNC y Registro Mercantil de la empresa propietaria.', NULL, 21, 1, 0),
(130, '- Documento de identidad de los socios de la empresa propietaria.', NULL, 21, 1, 0),
(131, '- Planos arquitectónicos de manera digital (PDF).', NULL, 21, 1, 0),
(132, '- Memoria descriptiva de manera digital (PDF).', NULL, 21, 1, 0),
(133, '- Planos Estructurales de manera digital (PDF). ', NULL, 21, 1, 0),
(134, '- Memoria de Cálculos Estructurales firmada por el responsable del diseño de manera digital (PDF) y Análisis de Cargas en Etabs o Safe.', NULL, 21, 1, 0),
(135, '- Planos Eléctricos de manera digital (PDF).', NULL, 21, 1, 0),
(136, '- Planos Sanitarios de manera digital (PDF).', NULL, 21, 1, 0),
(137, '- Memoria de Cálculos Sanitarios firmada por el responsable del diseño de manera digital (PDF).', NULL, 21, 1, 0),
(138, '- Estudio de suelo firmado de manera digital (PDF). ', NULL, 21, 1, 0),
(139, '- Carnet del CODIA del estructuralista, eléctricos y sanitario.', NULL, 21, 1, 0),
(140, '- Aprobaciones del Ayuntamiento, Medio Ambiente y Turismo. ', NULL, 21, 1, 0),
(141, '2.	Gestión copias de Licencias. ', NULL, 21, 1, 0),
(142, '- Fotocopia de la Licencia emitida. ', NULL, 21, 1, 0),
(143, '3.	Solicitud Inicio de Obra. ', NULL, 21, 1, 0),
(144, '- Aprobación de las áreas de estructura, geotécnica y arquitectura.   ', NULL, 21, 1, 0);

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
(28, 'new', NULL, 0, '2023-03-29 11:08:28', 1, 0);

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
(11, 'Todos los Proyectos', 'AllProjects', 'simple-icon-layers', '1', 1, 0, '2022-09-02 00:15:39.0');

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
(233, 'TEST USER PROJECT', 'TEST LOCATION', 36287, 'this is to check', 'TEST COMPANY NAME', 'nafees1431@gmail.com', NULL, 36484732, 'labels ', 'project_TEST_USER_PROJECT.png', 2, 1, 1, '2022-11-04', NULL, 0, 1),
(235, 'SCRATCH', 'SCRATCH LOCATION', 4367849, 'this is to hceck', 'SCRATCH COMPANY NAME', 'nafees1431@gmail.com', NULL, 463487932, 'labels', 'project_SCRATCH.png', 2, 2, 1, '2022-11-01', NULL, 0, 1),
(237, 'Proyecto 3', 'Puntacaca', 500, '', 'DD', 'em@activatec.do', NULL, 2147483647, 'prueba', NULL, 2, 2, 1, '2022-11-04', NULL, 0, 1),
(238, 'Prueba', 'Puntacana', 1000, 'df', 'DTSS', 'em@activatec.do', NULL, 0, 'dd', 'project_Prueba.png', 2, 2, 1, '2022-11-04', NULL, 0, 1),
(240, 'chek project', 'project locatin', 4637984, 'this is check description', 'project sace', 'salman@gmail.com', 'null', 546837, '453267', 'project_chek_project.png', 2, 1, 1, '2023-03-29', NULL, 1, 0),
(241, 'ICON BAY LUXURY', 'CAP CANA ', 6, '', 'INVERSIONES BONAPARTE SRL ', 'gerencia@dtss.com.do', NULL, 2147483647, 'ICON BAY ', 'project_ICON_BAY_LUXURY.png', 2, 2, 43, '2023-02-09', NULL, 1, 0),
(242, 'Eliezerww', 'Puntacana', 432, '', 'DTSS', 'eliezermartinezsoler@gmail.com', 'null', 0, 'd', 'project_Eliezerww.png', 2, 2, 1, '2023-03-28', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_records`
--

CREATE TABLE `tbl_project_records` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `list_id` int(11) DEFAULT NULL,
  `checklist_id` int(11) DEFAULT NULL,
  `active_bit` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `delete_bit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_project_records`
--

INSERT INTO `tbl_project_records` (`id`, `project_id`, `list_id`, `checklist_id`, `active_bit`, `created_at`, `delete_bit`) VALUES
(12936, 233, 1, 1, 1, '2022-11-01', 0),
(12937, 233, 1, 2, 0, '2022-11-01', 0),
(12938, 233, 1, 3, 0, '2022-11-01', 0),
(12939, 233, 1, 51, 0, '2022-11-01', 0),
(12940, 233, 1, 61, 0, '2022-11-01', 0),
(12941, 233, 1, 62, 1, '2022-11-01', 0),
(12942, 233, 1, 63, 1, '2022-11-01', 0),
(12943, 233, 2, 4, 0, '2022-11-01', 0),
(12944, 233, 2, 5, 0, '2022-11-01', 0),
(12945, 233, 2, 6, 0, '2022-11-01', 0),
(12946, 233, 2, 7, 0, '2022-11-01', 0),
(12947, 233, 2, 40, 1, '2022-11-01', 0),
(12948, 233, 2, 41, 1, '2022-11-01', 0),
(12949, 233, 2, 42, 1, '2022-11-01', 0),
(12950, 233, 2, 52, 0, '2022-11-01', 0),
(12951, 233, 5, 16, 0, '2022-11-01', 0),
(12952, 233, 5, 17, 0, '2022-11-01', 0),
(12953, 233, 5, 18, 0, '2022-11-01', 0),
(12954, 233, 5, 19, 0, '2022-11-01', 0),
(12955, 233, 6, 20, 1, '2022-11-01', 0),
(12956, 233, 6, 55, 0, '2022-11-01', 0),
(12957, 233, 7, 21, 0, '2022-11-01', 0),
(12958, 233, 7, 22, 0, '2022-11-01', 0),
(12959, 233, 7, 23, 0, '2022-11-01', 0),
(12960, 233, 7, 24, 0, '2022-11-01', 0),
(12961, 233, 7, 25, 0, '2022-11-01', 0),
(12962, 233, 7, 26, 0, '2022-11-01', 0),
(12963, 233, 7, 27, 0, '2022-11-01', 0),
(12964, 233, 7, 28, 0, '2022-11-01', 0),
(12965, 233, 7, 29, 0, '2022-11-01', 0),
(12966, 233, 7, 30, 0, '2022-11-01', 0),
(12967, 233, 7, 31, 0, '2022-11-01', 0),
(12968, 233, 7, 32, 0, '2022-11-01', 0),
(12969, 233, 7, 33, 1, '2022-11-01', 0),
(12970, 233, 7, 34, 0, '2022-11-01', 0),
(12971, 233, 7, 35, 0, '2022-11-01', 0),
(12972, 233, 7, 36, 1, '2022-11-01', 0),
(12973, 233, 7, 37, 0, '2022-11-01', 0),
(12974, 233, 7, 38, 0, '2022-11-01', 0),
(12975, 233, 7, 39, 0, '2022-11-01', 0),
(12976, 233, 8, 45, 0, '2022-11-01', 0),
(12977, 233, 8, 56, 0, '2022-11-01', 0),
(12978, 233, 9, 46, 0, '2022-11-01', 0),
(12979, 233, 9, 57, 0, '2022-11-01', 0),
(12980, 233, 10, 47, 0, '2022-11-01', 0),
(12981, 233, 10, 48, 0, '2022-11-01', 0),
(12982, 233, 10, 49, 0, '2022-11-01', 0),
(12983, 233, 10, 50, 0, '2022-11-01', 0),
(12984, 234, 1, 1, 0, '2022-11-01', 0),
(12985, 234, 1, 2, 0, '2022-11-01', 0),
(12986, 234, 1, 3, 0, '2022-11-01', 0),
(12987, 234, 1, 51, 0, '2022-11-01', 0),
(12988, 234, 1, 61, 0, '2022-11-01', 0),
(12989, 234, 1, 62, 0, '2022-11-01', 0),
(12990, 234, 1, 63, 0, '2022-11-01', 0),
(12991, 234, 2, 4, 0, '2022-11-01', 0),
(12992, 234, 2, 5, 0, '2022-11-01', 0),
(12993, 234, 2, 6, 0, '2022-11-01', 0),
(12994, 234, 2, 7, 0, '2022-11-01', 0),
(12995, 234, 2, 40, 0, '2022-11-01', 0),
(12996, 234, 2, 41, 0, '2022-11-01', 0),
(12997, 234, 2, 42, 0, '2022-11-01', 0),
(12998, 234, 2, 52, 0, '2022-11-01', 0),
(12999, 234, 5, 16, 0, '2022-11-01', 0),
(13000, 234, 5, 17, 0, '2022-11-01', 0),
(13001, 234, 5, 18, 0, '2022-11-01', 0),
(13002, 234, 5, 19, 0, '2022-11-01', 0),
(13003, 234, 6, 20, 0, '2022-11-01', 0),
(13004, 234, 6, 55, 0, '2022-11-01', 0),
(13005, 234, 7, 21, 0, '2022-11-01', 0),
(13006, 234, 7, 22, 0, '2022-11-01', 0),
(13007, 234, 7, 23, 0, '2022-11-01', 0),
(13008, 234, 7, 24, 0, '2022-11-01', 0),
(13009, 234, 7, 25, 0, '2022-11-01', 0),
(13010, 234, 7, 26, 0, '2022-11-01', 0),
(13011, 234, 7, 27, 0, '2022-11-01', 0),
(13012, 234, 7, 28, 0, '2022-11-01', 0),
(13013, 234, 7, 29, 0, '2022-11-01', 0),
(13014, 234, 7, 30, 0, '2022-11-01', 0),
(13015, 234, 7, 31, 0, '2022-11-01', 0),
(13016, 234, 7, 32, 0, '2022-11-01', 0),
(13017, 234, 7, 33, 0, '2022-11-01', 0),
(13018, 234, 7, 34, 0, '2022-11-01', 0),
(13019, 234, 7, 35, 0, '2022-11-01', 0),
(13020, 234, 7, 36, 0, '2022-11-01', 0),
(13021, 234, 7, 37, 0, '2022-11-01', 0),
(13022, 234, 7, 38, 0, '2022-11-01', 0),
(13023, 234, 7, 39, 0, '2022-11-01', 0),
(13024, 234, 8, 45, 0, '2022-11-01', 0),
(13025, 234, 8, 56, 0, '2022-11-01', 0),
(13026, 234, 9, 46, 1, '2022-11-01', 0),
(13027, 234, 9, 57, 0, '2022-11-01', 0),
(13028, 234, 10, 47, 0, '2022-11-01', 0),
(13029, 234, 10, 48, 0, '2022-11-01', 0),
(13030, 234, 10, 49, 0, '2022-11-01', 0),
(13031, 234, 10, 50, 0, '2022-11-01', 0),
(13032, 235, 1, 1, 0, '2022-11-01', 0),
(13033, 235, 1, 2, 0, '2022-11-01', 0),
(13034, 235, 1, 3, 0, '2022-11-01', 0),
(13035, 235, 1, 51, 0, '2022-11-01', 0),
(13036, 235, 1, 61, 0, '2022-11-01', 0),
(13037, 235, 1, 62, 0, '2022-11-01', 0),
(13038, 235, 1, 63, 0, '2022-11-01', 0),
(13039, 235, 2, 4, 0, '2022-11-01', 0),
(13040, 235, 2, 5, 0, '2022-11-01', 0),
(13041, 235, 2, 6, 0, '2022-11-01', 0),
(13042, 235, 2, 7, 0, '2022-11-01', 0),
(13043, 235, 2, 40, 0, '2022-11-01', 0),
(13044, 235, 2, 41, 0, '2022-11-01', 0),
(13045, 235, 2, 42, 0, '2022-11-01', 0),
(13046, 235, 2, 52, 0, '2022-11-01', 0),
(13047, 235, 5, 16, 0, '2022-11-01', 0),
(13048, 235, 5, 17, 0, '2022-11-01', 0),
(13049, 235, 5, 18, 0, '2022-11-01', 0),
(13050, 235, 5, 19, 0, '2022-11-01', 0),
(13051, 235, 6, 20, 0, '2022-11-01', 0),
(13052, 235, 6, 55, 0, '2022-11-01', 0),
(13053, 235, 7, 21, 0, '2022-11-01', 0),
(13054, 235, 7, 22, 0, '2022-11-01', 0),
(13055, 235, 7, 23, 0, '2022-11-01', 0),
(13056, 235, 7, 24, 0, '2022-11-01', 0),
(13057, 235, 7, 25, 0, '2022-11-01', 0),
(13058, 235, 7, 26, 0, '2022-11-01', 0),
(13059, 235, 7, 27, 0, '2022-11-01', 0),
(13060, 235, 7, 28, 0, '2022-11-01', 0),
(13061, 235, 7, 29, 0, '2022-11-01', 0),
(13062, 235, 7, 30, 0, '2022-11-01', 0),
(13063, 235, 7, 31, 0, '2022-11-01', 0),
(13064, 235, 7, 32, 0, '2022-11-01', 0),
(13065, 235, 7, 33, 0, '2022-11-01', 0),
(13066, 235, 7, 34, 0, '2022-11-01', 0),
(13067, 235, 7, 35, 0, '2022-11-01', 0),
(13068, 235, 7, 36, 0, '2022-11-01', 0),
(13069, 235, 7, 37, 0, '2022-11-01', 0),
(13070, 235, 7, 38, 0, '2022-11-01', 0),
(13071, 235, 7, 39, 0, '2022-11-01', 0),
(13072, 235, 8, 45, 1, '2022-11-01', 0),
(13073, 235, 8, 56, 0, '2022-11-01', 0),
(13074, 235, 9, 46, 0, '2022-11-01', 0),
(13075, 235, 9, 57, 0, '2022-11-01', 0),
(13076, 235, 10, 47, 0, '2022-11-01', 0),
(13077, 235, 10, 48, 0, '2022-11-01', 0),
(13078, 235, 10, 49, 0, '2022-11-01', 0),
(13079, 235, 10, 50, 0, '2022-11-01', 0),
(13080, 236, 1, 1, 1, '2022-11-02', 0),
(13081, 236, 1, 2, 0, '2022-11-02', 0),
(13082, 236, 1, 3, 0, '2022-11-02', 0),
(13083, 236, 1, 51, 0, '2022-11-02', 0),
(13084, 236, 1, 61, 0, '2022-11-02', 0),
(13085, 236, 1, 62, 0, '2022-11-02', 0),
(13086, 236, 1, 63, 0, '2022-11-02', 0),
(13087, 236, 2, 4, 0, '2022-11-02', 0),
(13088, 236, 2, 5, 0, '2022-11-02', 0),
(13089, 236, 2, 6, 0, '2022-11-02', 0),
(13090, 236, 2, 7, 0, '2022-11-02', 0),
(13091, 236, 2, 40, 0, '2022-11-02', 0),
(13092, 236, 2, 41, 0, '2022-11-02', 0),
(13093, 236, 2, 42, 0, '2022-11-02', 0),
(13094, 236, 2, 52, 1, '2022-11-02', 0),
(13095, 236, 5, 16, 0, '2022-11-02', 0),
(13096, 236, 5, 17, 0, '2022-11-02', 0),
(13097, 236, 5, 18, 0, '2022-11-02', 0),
(13098, 236, 5, 19, 0, '2022-11-02', 0),
(13099, 236, 6, 20, 1, '2022-11-02', 0),
(13100, 236, 6, 55, 0, '2022-11-02', 0),
(13101, 236, 7, 21, 0, '2022-11-02', 0),
(13102, 236, 7, 22, 0, '2022-11-02', 0),
(13103, 236, 7, 23, 0, '2022-11-02', 0),
(13104, 236, 7, 24, 0, '2022-11-02', 0),
(13105, 236, 7, 25, 0, '2022-11-02', 0),
(13106, 236, 7, 26, 0, '2022-11-02', 0),
(13107, 236, 7, 27, 0, '2022-11-02', 0),
(13108, 236, 7, 28, 0, '2022-11-02', 0),
(13109, 236, 7, 29, 0, '2022-11-02', 0),
(13110, 236, 7, 30, 0, '2022-11-02', 0),
(13111, 236, 7, 31, 0, '2022-11-02', 0),
(13112, 236, 7, 32, 0, '2022-11-02', 0),
(13113, 236, 7, 33, 0, '2022-11-02', 0),
(13114, 236, 7, 34, 0, '2022-11-02', 0),
(13115, 236, 7, 35, 0, '2022-11-02', 0),
(13116, 236, 7, 36, 0, '2022-11-02', 0),
(13117, 236, 7, 37, 0, '2022-11-02', 0),
(13118, 236, 7, 38, 0, '2022-11-02', 0),
(13119, 236, 7, 39, 0, '2022-11-02', 0),
(13120, 236, 8, 45, 0, '2022-11-02', 0),
(13121, 236, 8, 56, 0, '2022-11-02', 0),
(13122, 236, 9, 46, 0, '2022-11-02', 0),
(13123, 236, 9, 57, 0, '2022-11-02', 0),
(13124, 236, 10, 47, 0, '2022-11-02', 0),
(13125, 236, 10, 48, 0, '2022-11-02', 0),
(13126, 236, 10, 49, 0, '2022-11-02', 0),
(13127, 236, 10, 50, 0, '2022-11-02', 0),
(13128, 237, 1, 1, 0, '2022-11-04', 0),
(13129, 237, 1, 2, 0, '2022-11-04', 0),
(13130, 237, 1, 3, 0, '2022-11-04', 0),
(13131, 237, 1, 51, 0, '2022-11-04', 0),
(13132, 237, 1, 61, 0, '2022-11-04', 0),
(13133, 237, 1, 62, 0, '2022-11-04', 0),
(13134, 237, 1, 63, 0, '2022-11-04', 0),
(13135, 237, 1, 64, 0, '2022-11-04', 0),
(13136, 237, 1, 65, 0, '2022-11-04', 0),
(13137, 237, 1, 66, 0, '2022-11-04', 0),
(13138, 237, 1, 67, 0, '2022-11-04', 0),
(13139, 237, 1, 68, 0, '2022-11-04', 0),
(13140, 237, 1, 69, 0, '2022-11-04', 0),
(13141, 237, 1, 70, 0, '2022-11-04', 0),
(13142, 237, 1, 71, 0, '2022-11-04', 0),
(13143, 237, 1, 72, 0, '2022-11-04', 0),
(13144, 237, 1, 73, 0, '2022-11-04', 0),
(13145, 237, 1, 74, 0, '2022-11-04', 0),
(13146, 237, 1, 75, 0, '2022-11-04', 0),
(13147, 237, 1, 76, 0, '2022-11-04', 0),
(13148, 237, 1, 77, 0, '2022-11-04', 0),
(13149, 237, 2, 4, 0, '2022-11-04', 0),
(13150, 237, 2, 5, 0, '2022-11-04', 0),
(13151, 237, 2, 6, 0, '2022-11-04', 0),
(13152, 237, 2, 7, 0, '2022-11-04', 0),
(13153, 237, 2, 40, 0, '2022-11-04', 0),
(13154, 237, 2, 41, 0, '2022-11-04', 0),
(13155, 237, 2, 42, 0, '2022-11-04', 0),
(13156, 237, 2, 52, 0, '2022-11-04', 0),
(13157, 237, 2, 78, 0, '2022-11-04', 0),
(13158, 237, 2, 79, 0, '2022-11-04', 0),
(13159, 237, 2, 80, 0, '2022-11-04', 0),
(13160, 237, 2, 81, 0, '2022-11-04', 0),
(13161, 237, 2, 82, 0, '2022-11-04', 0),
(13162, 237, 5, 16, 0, '2022-11-04', 0),
(13163, 237, 5, 17, 0, '2022-11-04', 0),
(13164, 237, 5, 18, 0, '2022-11-04', 0),
(13165, 237, 5, 19, 0, '2022-11-04', 0),
(13166, 237, 6, 20, 0, '2022-11-04', 0),
(13167, 237, 6, 55, 0, '2022-11-04', 0),
(13168, 237, 7, 21, 0, '2022-11-04', 0),
(13169, 237, 7, 22, 0, '2022-11-04', 0),
(13170, 237, 7, 23, 0, '2022-11-04', 0),
(13171, 237, 7, 24, 0, '2022-11-04', 0),
(13172, 237, 7, 25, 0, '2022-11-04', 0),
(13173, 237, 7, 26, 0, '2022-11-04', 0),
(13174, 237, 7, 27, 0, '2022-11-04', 0),
(13175, 237, 7, 28, 0, '2022-11-04', 0),
(13176, 237, 7, 29, 0, '2022-11-04', 0),
(13177, 237, 7, 30, 0, '2022-11-04', 0),
(13178, 237, 7, 31, 0, '2022-11-04', 0),
(13179, 237, 7, 32, 0, '2022-11-04', 0),
(13180, 237, 7, 33, 0, '2022-11-04', 0),
(13181, 237, 7, 34, 0, '2022-11-04', 0),
(13182, 237, 7, 35, 0, '2022-11-04', 0),
(13183, 237, 7, 36, 0, '2022-11-04', 0),
(13184, 237, 7, 37, 0, '2022-11-04', 0),
(13185, 237, 7, 38, 0, '2022-11-04', 0),
(13186, 237, 7, 39, 0, '2022-11-04', 0),
(13187, 237, 8, 45, 0, '2022-11-04', 0),
(13188, 237, 8, 56, 0, '2022-11-04', 0),
(13189, 237, 9, 46, 0, '2022-11-04', 0),
(13190, 237, 9, 57, 0, '2022-11-04', 0),
(13191, 237, 10, 47, 0, '2022-11-04', 0),
(13192, 237, 10, 48, 0, '2022-11-04', 0),
(13193, 237, 10, 49, 0, '2022-11-04', 0),
(13194, 237, 10, 50, 0, '2022-11-04', 0),
(13195, 237, 20, 83, 0, '2022-11-04', 0),
(13196, 237, 20, 84, 0, '2022-11-04', 0),
(13197, 237, 20, 85, 0, '2022-11-04', 0),
(13198, 237, 20, 86, 0, '2022-11-04', 0),
(13199, 237, 20, 87, 0, '2022-11-04', 0),
(13200, 237, 20, 88, 0, '2022-11-04', 0),
(13201, 237, 20, 89, 0, '2022-11-04', 0),
(13202, 237, 20, 90, 0, '2022-11-04', 0),
(13203, 237, 20, 91, 0, '2022-11-04', 0),
(13204, 237, 20, 92, 0, '2022-11-04', 0),
(13205, 237, 20, 93, 0, '2022-11-04', 0),
(13206, 237, 20, 94, 0, '2022-11-04', 0),
(13207, 237, 20, 95, 0, '2022-11-04', 0),
(13208, 237, 20, 96, 0, '2022-11-04', 0),
(13209, 237, 20, 97, 0, '2022-11-04', 0),
(13210, 237, 20, 98, 0, '2022-11-04', 0),
(13211, 237, 20, 99, 0, '2022-11-04', 0),
(13212, 237, 20, 100, 0, '2022-11-04', 0),
(13213, 237, 20, 101, 0, '2022-11-04', 0),
(13214, 237, 20, 102, 0, '2022-11-04', 0),
(13215, 237, 20, 103, 0, '2022-11-04', 0),
(13216, 237, 20, 104, 0, '2022-11-04', 0),
(13217, 237, 20, 105, 0, '2022-11-04', 0),
(13218, 237, 20, 106, 0, '2022-11-04', 0),
(13219, 237, 20, 107, 0, '2022-11-04', 0),
(13220, 237, 20, 108, 0, '2022-11-04', 0),
(13221, 237, 20, 109, 0, '2022-11-04', 0),
(13222, 237, 20, 110, 0, '2022-11-04', 0),
(13223, 237, 20, 111, 0, '2022-11-04', 0),
(13224, 237, 20, 112, 0, '2022-11-04', 0),
(13225, 237, 20, 113, 0, '2022-11-04', 0),
(13226, 237, 20, 114, 0, '2022-11-04', 0),
(13227, 237, 20, 115, 0, '2022-11-04', 0),
(13228, 237, 20, 116, 0, '2022-11-04', 0),
(13229, 237, 20, 117, 0, '2022-11-04', 0),
(13230, 237, 20, 118, 0, '2022-11-04', 0),
(13231, 237, 20, 119, 0, '2022-11-04', 0),
(13232, 237, 20, 120, 0, '2022-11-04', 0),
(13233, 237, 20, 121, 0, '2022-11-04', 0),
(13234, 237, 20, 122, 0, '2022-11-04', 0),
(13235, 237, 20, 123, 0, '2022-11-04', 0),
(13236, 237, 20, 124, 0, '2022-11-04', 0),
(13237, 237, 20, 125, 0, '2022-11-04', 0),
(13238, 237, 21, 126, 0, '2022-11-04', 0),
(13239, 237, 21, 127, 0, '2022-11-04', 0),
(13240, 237, 21, 128, 0, '2022-11-04', 0),
(13241, 237, 21, 129, 0, '2022-11-04', 0),
(13242, 237, 21, 130, 0, '2022-11-04', 0),
(13243, 237, 21, 131, 0, '2022-11-04', 0),
(13244, 237, 21, 132, 0, '2022-11-04', 0),
(13245, 237, 21, 133, 0, '2022-11-04', 0),
(13246, 237, 21, 134, 0, '2022-11-04', 0),
(13247, 237, 21, 135, 0, '2022-11-04', 0),
(13248, 237, 21, 136, 0, '2022-11-04', 0),
(13249, 237, 21, 137, 0, '2022-11-04', 0),
(13250, 237, 21, 138, 0, '2022-11-04', 0),
(13251, 237, 21, 139, 0, '2022-11-04', 0),
(13252, 237, 21, 140, 0, '2022-11-04', 0),
(13253, 237, 21, 141, 0, '2022-11-04', 0),
(13254, 237, 21, 142, 0, '2022-11-04', 0),
(13255, 237, 21, 143, 0, '2022-11-04', 0),
(13256, 237, 21, 144, 0, '2022-11-04', 0),
(13257, 238, 1, 1, 1, '2022-11-04', 0),
(13258, 238, 1, 2, 0, '2022-11-04', 0),
(13259, 238, 1, 3, 0, '2022-11-04', 0),
(13260, 238, 1, 51, 0, '2022-11-04', 0),
(13261, 238, 1, 61, 0, '2022-11-04', 0),
(13262, 238, 1, 62, 0, '2022-11-04', 0),
(13263, 238, 1, 63, 0, '2022-11-04', 0),
(13264, 238, 1, 64, 0, '2022-11-04', 0),
(13265, 238, 1, 65, 0, '2022-11-04', 0),
(13266, 238, 1, 66, 0, '2022-11-04', 0),
(13267, 238, 1, 67, 0, '2022-11-04', 0),
(13268, 238, 1, 68, 0, '2022-11-04', 0),
(13269, 238, 1, 69, 0, '2022-11-04', 0),
(13270, 238, 1, 70, 0, '2022-11-04', 0),
(13271, 238, 1, 71, 0, '2022-11-04', 0),
(13272, 238, 1, 72, 0, '2022-11-04', 0),
(13273, 238, 1, 73, 0, '2022-11-04', 0),
(13274, 238, 1, 74, 0, '2022-11-04', 0),
(13275, 238, 1, 75, 0, '2022-11-04', 0),
(13276, 238, 1, 76, 0, '2022-11-04', 0),
(13277, 238, 1, 77, 0, '2022-11-04', 0),
(13278, 238, 2, 4, 0, '2022-11-04', 0),
(13279, 238, 2, 5, 0, '2022-11-04', 0),
(13280, 238, 2, 6, 0, '2022-11-04', 0),
(13281, 238, 2, 7, 0, '2022-11-04', 0),
(13282, 238, 2, 40, 0, '2022-11-04', 0),
(13283, 238, 2, 41, 0, '2022-11-04', 0),
(13284, 238, 2, 42, 0, '2022-11-04', 0),
(13285, 238, 2, 52, 0, '2022-11-04', 0),
(13286, 238, 2, 78, 1, '2022-11-04', 0),
(13287, 238, 2, 79, 1, '2022-11-04', 0),
(13288, 238, 2, 80, 0, '2022-11-04', 0),
(13289, 238, 2, 81, 0, '2022-11-04', 0),
(13290, 238, 2, 82, 0, '2022-11-04', 0),
(13291, 238, 5, 16, 1, '2022-11-04', 0),
(13292, 238, 5, 17, 1, '2022-11-04', 0),
(13293, 238, 5, 18, 0, '2022-11-04', 0),
(13294, 238, 5, 19, 0, '2022-11-04', 0),
(13295, 238, 6, 20, 0, '2022-11-04', 0),
(13296, 238, 6, 55, 1, '2022-11-04', 0),
(13297, 238, 7, 21, 0, '2022-11-04', 0),
(13298, 238, 7, 22, 0, '2022-11-04', 0),
(13299, 238, 7, 23, 0, '2022-11-04', 0),
(13300, 238, 7, 24, 0, '2022-11-04', 0),
(13301, 238, 7, 25, 0, '2022-11-04', 0),
(13302, 238, 7, 26, 0, '2022-11-04', 0),
(13303, 238, 7, 27, 0, '2022-11-04', 0),
(13304, 238, 7, 28, 0, '2022-11-04', 0),
(13305, 238, 7, 29, 0, '2022-11-04', 0),
(13306, 238, 7, 30, 0, '2022-11-04', 0),
(13307, 238, 7, 31, 0, '2022-11-04', 0),
(13308, 238, 7, 32, 0, '2022-11-04', 0),
(13309, 238, 7, 33, 0, '2022-11-04', 0),
(13310, 238, 7, 34, 0, '2022-11-04', 0),
(13311, 238, 7, 35, 0, '2022-11-04', 0),
(13312, 238, 7, 36, 0, '2022-11-04', 0),
(13313, 238, 7, 37, 0, '2022-11-04', 0),
(13314, 238, 7, 38, 0, '2022-11-04', 0),
(13315, 238, 7, 39, 0, '2022-11-04', 0),
(13316, 238, 8, 45, 0, '2022-11-04', 0),
(13317, 238, 8, 56, 1, '2022-11-04', 0),
(13318, 238, 9, 46, 0, '2022-11-04', 0),
(13319, 238, 9, 57, 0, '2022-11-04', 0),
(13320, 238, 10, 47, 0, '2022-11-04', 0),
(13321, 238, 10, 48, 0, '2022-11-04', 0),
(13322, 238, 10, 49, 0, '2022-11-04', 0),
(13323, 238, 10, 50, 0, '2022-11-04', 0),
(13324, 238, 20, 83, 0, '2022-11-04', 0),
(13325, 238, 20, 84, 0, '2022-11-04', 0),
(13326, 238, 20, 85, 0, '2022-11-04', 0),
(13327, 238, 20, 86, 0, '2022-11-04', 0),
(13328, 238, 20, 87, 0, '2022-11-04', 0),
(13329, 238, 20, 88, 0, '2022-11-04', 0),
(13330, 238, 20, 89, 0, '2022-11-04', 0),
(13331, 238, 20, 90, 0, '2022-11-04', 0),
(13332, 238, 20, 91, 0, '2022-11-04', 0),
(13333, 238, 20, 92, 0, '2022-11-04', 0),
(13334, 238, 20, 93, 0, '2022-11-04', 0),
(13335, 238, 20, 94, 0, '2022-11-04', 0),
(13336, 238, 20, 95, 0, '2022-11-04', 0),
(13337, 238, 20, 96, 0, '2022-11-04', 0),
(13338, 238, 20, 97, 0, '2022-11-04', 0),
(13339, 238, 20, 98, 0, '2022-11-04', 0),
(13340, 238, 20, 99, 0, '2022-11-04', 0),
(13341, 238, 20, 100, 0, '2022-11-04', 0),
(13342, 238, 20, 101, 0, '2022-11-04', 0),
(13343, 238, 20, 102, 0, '2022-11-04', 0),
(13344, 238, 20, 103, 0, '2022-11-04', 0),
(13345, 238, 20, 104, 0, '2022-11-04', 0),
(13346, 238, 20, 105, 0, '2022-11-04', 0),
(13347, 238, 20, 106, 0, '2022-11-04', 0),
(13348, 238, 20, 107, 0, '2022-11-04', 0),
(13349, 238, 20, 108, 0, '2022-11-04', 0),
(13350, 238, 20, 109, 0, '2022-11-04', 0),
(13351, 238, 20, 110, 0, '2022-11-04', 0),
(13352, 238, 20, 111, 0, '2022-11-04', 0),
(13353, 238, 20, 112, 0, '2022-11-04', 0),
(13354, 238, 20, 113, 0, '2022-11-04', 0),
(13355, 238, 20, 114, 1, '2022-11-04', 0),
(13356, 238, 20, 115, 0, '2022-11-04', 0),
(13357, 238, 20, 116, 0, '2022-11-04', 0),
(13358, 238, 20, 117, 0, '2022-11-04', 0),
(13359, 238, 20, 118, 0, '2022-11-04', 0),
(13360, 238, 20, 119, 0, '2022-11-04', 0),
(13361, 238, 20, 120, 0, '2022-11-04', 0),
(13362, 238, 20, 121, 0, '2022-11-04', 0),
(13363, 238, 20, 122, 0, '2022-11-04', 0),
(13364, 238, 20, 123, 0, '2022-11-04', 0),
(13365, 238, 20, 124, 0, '2022-11-04', 0),
(13366, 238, 20, 125, 0, '2022-11-04', 0),
(13367, 238, 21, 126, 0, '2022-11-04', 0),
(13368, 238, 21, 127, 0, '2022-11-04', 0),
(13369, 238, 21, 128, 0, '2022-11-04', 0),
(13370, 238, 21, 129, 0, '2022-11-04', 0),
(13371, 238, 21, 130, 0, '2022-11-04', 0),
(13372, 238, 21, 131, 0, '2022-11-04', 0),
(13373, 238, 21, 132, 0, '2022-11-04', 0),
(13374, 238, 21, 133, 0, '2022-11-04', 0),
(13375, 238, 21, 134, 0, '2022-11-04', 0),
(13376, 238, 21, 135, 0, '2022-11-04', 0),
(13377, 238, 21, 136, 0, '2022-11-04', 0),
(13378, 238, 21, 137, 0, '2022-11-04', 0),
(13379, 238, 21, 138, 0, '2022-11-04', 0),
(13380, 238, 21, 139, 0, '2022-11-04', 0),
(13381, 238, 21, 140, 0, '2022-11-04', 0),
(13382, 238, 21, 141, 0, '2022-11-04', 0),
(13383, 238, 21, 142, 0, '2022-11-04', 0),
(13384, 238, 21, 143, 0, '2022-11-04', 0),
(13385, 238, 21, 144, 0, '2022-11-04', 0),
(13386, 239, 1, 1, 1, '2022-11-08', 0),
(13387, 239, 1, 2, 0, '2022-11-08', 0),
(13388, 239, 1, 3, 0, '2022-11-08', 0),
(13389, 239, 1, 51, 0, '2022-11-08', 0),
(13390, 239, 1, 61, 0, '2022-11-08', 0),
(13391, 239, 1, 62, 0, '2022-11-08', 0),
(13392, 239, 1, 63, 0, '2022-11-08', 0),
(13393, 239, 1, 64, 0, '2022-11-08', 0),
(13394, 239, 1, 65, 0, '2022-11-08', 0),
(13395, 239, 1, 66, 0, '2022-11-08', 0),
(13396, 239, 1, 67, 0, '2022-11-08', 0),
(13397, 239, 1, 68, 0, '2022-11-08', 0),
(13398, 239, 1, 69, 0, '2022-11-08', 0),
(13399, 239, 1, 70, 0, '2022-11-08', 0),
(13400, 239, 1, 71, 0, '2022-11-08', 0),
(13401, 239, 1, 72, 0, '2022-11-08', 0),
(13402, 239, 1, 73, 1, '2022-11-08', 0),
(13403, 239, 1, 74, 0, '2022-11-08', 0),
(13404, 239, 1, 75, 0, '2022-11-08', 0),
(13405, 239, 1, 76, 0, '2022-11-08', 0),
(13406, 239, 1, 77, 0, '2022-11-08', 0),
(13407, 239, 2, 4, 0, '2022-11-08', 0),
(13408, 239, 2, 5, 0, '2022-11-08', 0),
(13409, 239, 2, 6, 0, '2022-11-08', 0),
(13410, 239, 2, 7, 0, '2022-11-08', 0),
(13411, 239, 2, 40, 0, '2022-11-08', 0),
(13412, 239, 2, 41, 0, '2022-11-08', 0),
(13413, 239, 2, 42, 0, '2022-11-08', 0),
(13414, 239, 2, 52, 0, '2022-11-08', 0),
(13415, 239, 2, 78, 0, '2022-11-08', 0),
(13416, 239, 2, 79, 0, '2022-11-08', 0),
(13417, 239, 2, 80, 1, '2022-11-08', 0),
(13418, 239, 2, 81, 0, '2022-11-08', 0),
(13419, 239, 2, 82, 0, '2022-11-08', 0),
(13420, 239, 5, 16, 0, '2022-11-08', 0),
(13421, 239, 5, 17, 0, '2022-11-08', 0),
(13422, 239, 5, 18, 0, '2022-11-08', 0),
(13423, 239, 5, 19, 0, '2022-11-08', 0),
(13424, 239, 6, 20, 0, '2022-11-08', 0),
(13425, 239, 6, 55, 0, '2022-11-08', 0),
(13426, 239, 7, 21, 0, '2022-11-08', 0),
(13427, 239, 7, 22, 0, '2022-11-08', 0),
(13428, 239, 7, 23, 0, '2022-11-08', 0),
(13429, 239, 7, 24, 0, '2022-11-08', 0),
(13430, 239, 7, 25, 0, '2022-11-08', 0),
(13431, 239, 7, 26, 0, '2022-11-08', 0),
(13432, 239, 7, 27, 0, '2022-11-08', 0),
(13433, 239, 7, 28, 0, '2022-11-08', 0),
(13434, 239, 7, 29, 0, '2022-11-08', 0),
(13435, 239, 7, 30, 0, '2022-11-08', 0),
(13436, 239, 7, 31, 0, '2022-11-08', 0),
(13437, 239, 7, 32, 0, '2022-11-08', 0),
(13438, 239, 7, 33, 0, '2022-11-08', 0),
(13439, 239, 7, 34, 0, '2022-11-08', 0),
(13440, 239, 7, 35, 0, '2022-11-08', 0),
(13441, 239, 7, 36, 0, '2022-11-08', 0),
(13442, 239, 7, 37, 0, '2022-11-08', 0),
(13443, 239, 7, 38, 0, '2022-11-08', 0),
(13444, 239, 7, 39, 0, '2022-11-08', 0),
(13445, 239, 8, 45, 0, '2022-11-08', 0),
(13446, 239, 8, 56, 0, '2022-11-08', 0),
(13447, 239, 9, 46, 0, '2022-11-08', 0),
(13448, 239, 9, 57, 0, '2022-11-08', 0),
(13449, 239, 10, 47, 0, '2022-11-08', 0),
(13450, 239, 10, 48, 0, '2022-11-08', 0),
(13451, 239, 10, 49, 0, '2022-11-08', 0),
(13452, 239, 10, 50, 0, '2022-11-08', 0),
(13453, 239, 20, 83, 0, '2022-11-08', 0),
(13454, 239, 20, 84, 0, '2022-11-08', 0),
(13455, 239, 20, 85, 0, '2022-11-08', 0),
(13456, 239, 20, 86, 0, '2022-11-08', 0),
(13457, 239, 20, 87, 0, '2022-11-08', 0),
(13458, 239, 20, 88, 0, '2022-11-08', 0),
(13459, 239, 20, 89, 0, '2022-11-08', 0),
(13460, 239, 20, 90, 0, '2022-11-08', 0),
(13461, 239, 20, 91, 0, '2022-11-08', 0),
(13462, 239, 20, 92, 0, '2022-11-08', 0),
(13463, 239, 20, 93, 0, '2022-11-08', 0),
(13464, 239, 20, 94, 0, '2022-11-08', 0),
(13465, 239, 20, 95, 0, '2022-11-08', 0),
(13466, 239, 20, 96, 0, '2022-11-08', 0),
(13467, 239, 20, 97, 0, '2022-11-08', 0),
(13468, 239, 20, 98, 0, '2022-11-08', 0),
(13469, 239, 20, 99, 0, '2022-11-08', 0),
(13470, 239, 20, 100, 0, '2022-11-08', 0),
(13471, 239, 20, 101, 0, '2022-11-08', 0),
(13472, 239, 20, 102, 0, '2022-11-08', 0),
(13473, 239, 20, 103, 0, '2022-11-08', 0),
(13474, 239, 20, 104, 0, '2022-11-08', 0),
(13475, 239, 20, 105, 0, '2022-11-08', 0),
(13476, 239, 20, 106, 0, '2022-11-08', 0),
(13477, 239, 20, 107, 0, '2022-11-08', 0),
(13478, 239, 20, 108, 0, '2022-11-08', 0),
(13479, 239, 20, 109, 0, '2022-11-08', 0),
(13480, 239, 20, 110, 0, '2022-11-08', 0),
(13481, 239, 20, 111, 0, '2022-11-08', 0),
(13482, 239, 20, 112, 0, '2022-11-08', 0),
(13483, 239, 20, 113, 0, '2022-11-08', 0),
(13484, 239, 20, 114, 0, '2022-11-08', 0),
(13485, 239, 20, 115, 0, '2022-11-08', 0),
(13486, 239, 20, 116, 0, '2022-11-08', 0),
(13487, 239, 20, 117, 0, '2022-11-08', 0),
(13488, 239, 20, 118, 0, '2022-11-08', 0),
(13489, 239, 20, 119, 0, '2022-11-08', 0),
(13490, 239, 20, 120, 0, '2022-11-08', 0),
(13491, 239, 20, 121, 0, '2022-11-08', 0),
(13492, 239, 20, 122, 0, '2022-11-08', 0),
(13493, 239, 20, 123, 0, '2022-11-08', 0),
(13494, 239, 20, 124, 0, '2022-11-08', 0),
(13495, 239, 20, 125, 0, '2022-11-08', 0),
(13496, 239, 21, 126, 0, '2022-11-08', 0),
(13497, 239, 21, 127, 0, '2022-11-08', 0),
(13498, 239, 21, 128, 0, '2022-11-08', 0),
(13499, 239, 21, 129, 0, '2022-11-08', 0),
(13500, 239, 21, 130, 0, '2022-11-08', 0),
(13501, 239, 21, 131, 0, '2022-11-08', 0),
(13502, 239, 21, 132, 0, '2022-11-08', 0),
(13503, 239, 21, 133, 0, '2022-11-08', 0),
(13504, 239, 21, 134, 0, '2022-11-08', 0),
(13505, 239, 21, 135, 0, '2022-11-08', 0),
(13506, 239, 21, 136, 0, '2022-11-08', 0),
(13507, 239, 21, 137, 0, '2022-11-08', 0),
(13508, 239, 21, 138, 0, '2022-11-08', 0),
(13509, 239, 21, 139, 0, '2022-11-08', 0),
(13510, 239, 21, 140, 0, '2022-11-08', 0),
(13511, 239, 21, 141, 0, '2022-11-08', 0),
(13512, 239, 21, 142, 0, '2022-11-08', 0),
(13513, 239, 21, 143, 0, '2022-11-08', 0),
(13514, 239, 21, 144, 0, '2022-11-08', 0),
(13515, 240, 1, 1, 1, '2022-12-05', 0),
(13516, 240, 1, 2, 1, '2022-12-05', 0),
(13517, 240, 1, 3, 1, '2022-12-05', 0),
(13518, 240, 1, 64, 1, '2022-12-05', 0),
(13519, 240, 1, 65, 1, '2022-12-05', 0),
(13520, 240, 1, 66, 1, '2022-12-05', 0),
(13521, 240, 1, 67, 1, '2022-12-05', 0),
(13522, 240, 1, 68, 1, '2022-12-05', 0),
(13523, 240, 1, 69, 1, '2022-12-05', 0),
(13524, 240, 1, 70, 1, '2022-12-05', 0),
(13525, 240, 1, 71, 1, '2022-12-05', 0),
(13526, 240, 1, 72, 1, '2022-12-05', 0),
(13527, 240, 1, 73, 1, '2022-12-05', 0),
(13528, 240, 1, 74, 1, '2022-12-05', 0),
(13529, 240, 1, 75, 1, '2022-12-05', 0),
(13530, 240, 1, 76, 1, '2022-12-05', 0),
(13531, 240, 1, 77, 1, '2022-12-05', 0),
(13532, 240, 2, 4, 0, '2022-12-05', 0),
(13533, 240, 2, 5, 0, '2022-12-05', 0),
(13534, 240, 2, 6, 0, '2022-12-05', 0),
(13535, 240, 2, 7, 0, '2022-12-05', 0),
(13536, 240, 2, 40, 1, '2022-12-05', 0),
(13537, 240, 2, 41, 0, '2022-12-05', 0),
(13538, 240, 2, 42, 0, '2022-12-05', 0),
(13539, 240, 2, 52, 0, '2022-12-05', 0),
(13540, 240, 2, 78, 0, '2022-12-05', 0),
(13541, 240, 2, 79, 0, '2022-12-05', 0),
(13542, 240, 2, 80, 1, '2022-12-05', 0),
(13543, 240, 2, 81, 0, '2022-12-05', 0),
(13544, 240, 2, 82, 0, '2022-12-05', 0),
(13545, 240, 5, 16, 1, '2022-12-05', 0),
(13546, 240, 5, 17, 0, '2022-12-05', 0),
(13547, 240, 5, 18, 0, '2022-12-05', 0),
(13548, 240, 6, 20, 0, '2022-12-05', 0),
(13549, 240, 7, 21, 0, '2022-12-05', 0),
(13550, 240, 7, 22, 0, '2022-12-05', 0),
(13551, 240, 7, 23, 0, '2022-12-05', 0),
(13552, 240, 7, 24, 0, '2022-12-05', 0),
(13553, 240, 7, 25, 0, '2022-12-05', 0),
(13554, 240, 7, 26, 0, '2022-12-05', 0),
(13555, 240, 7, 27, 0, '2022-12-05', 0),
(13556, 240, 7, 28, 0, '2022-12-05', 0),
(13557, 240, 7, 29, 0, '2022-12-05', 0),
(13558, 240, 7, 30, 0, '2022-12-05', 0),
(13559, 240, 7, 31, 0, '2022-12-05', 0),
(13560, 240, 7, 32, 0, '2022-12-05', 0),
(13561, 240, 7, 33, 0, '2022-12-05', 0),
(13562, 240, 7, 34, 0, '2022-12-05', 0),
(13563, 240, 7, 35, 0, '2022-12-05', 0),
(13564, 240, 7, 36, 0, '2022-12-05', 0),
(13565, 240, 7, 37, 0, '2022-12-05', 0),
(13566, 240, 7, 38, 0, '2022-12-05', 0),
(13567, 240, 7, 39, 0, '2022-12-05', 0),
(13568, 240, 8, 45, 0, '2022-12-05', 0),
(13569, 240, 9, 46, 0, '2022-12-05', 0),
(13570, 240, 10, 47, 0, '2022-12-05', 0),
(13571, 240, 10, 48, 0, '2022-12-05', 0),
(13572, 240, 10, 49, 0, '2022-12-05', 0),
(13573, 240, 20, 83, 0, '2022-12-05', 0),
(13574, 240, 20, 84, 0, '2022-12-05', 0),
(13575, 240, 20, 85, 0, '2022-12-05', 0),
(13576, 240, 20, 86, 0, '2022-12-05', 0),
(13577, 240, 20, 87, 0, '2022-12-05', 0),
(13578, 240, 20, 88, 0, '2022-12-05', 0),
(13579, 240, 20, 89, 0, '2022-12-05', 0),
(13580, 240, 20, 90, 0, '2022-12-05', 0),
(13581, 240, 20, 91, 0, '2022-12-05', 0),
(13582, 240, 20, 92, 0, '2022-12-05', 0),
(13583, 240, 20, 93, 0, '2022-12-05', 0),
(13584, 240, 20, 94, 0, '2022-12-05', 0),
(13585, 240, 20, 95, 0, '2022-12-05', 0),
(13586, 240, 20, 96, 0, '2022-12-05', 0),
(13587, 240, 20, 97, 0, '2022-12-05', 0),
(13588, 240, 20, 98, 0, '2022-12-05', 0),
(13589, 240, 20, 99, 0, '2022-12-05', 0),
(13590, 240, 20, 100, 0, '2022-12-05', 0),
(13591, 240, 20, 101, 0, '2022-12-05', 0),
(13592, 240, 20, 102, 0, '2022-12-05', 0),
(13593, 240, 20, 103, 0, '2022-12-05', 0),
(13594, 240, 20, 104, 0, '2022-12-05', 0),
(13595, 240, 20, 105, 0, '2022-12-05', 0),
(13596, 240, 20, 106, 0, '2022-12-05', 0),
(13597, 240, 20, 107, 0, '2022-12-05', 0),
(13598, 240, 20, 108, 0, '2022-12-05', 0),
(13599, 240, 20, 109, 0, '2022-12-05', 0),
(13600, 240, 20, 110, 0, '2022-12-05', 0),
(13601, 240, 20, 111, 0, '2022-12-05', 0),
(13602, 240, 20, 112, 0, '2022-12-05', 0),
(13603, 240, 20, 113, 0, '2022-12-05', 0),
(13604, 240, 20, 114, 1, '2022-12-05', 0),
(13605, 240, 20, 115, 0, '2022-12-05', 0),
(13606, 240, 20, 116, 0, '2022-12-05', 0),
(13607, 240, 20, 117, 0, '2022-12-05', 0),
(13608, 240, 20, 118, 0, '2022-12-05', 0),
(13609, 240, 20, 119, 0, '2022-12-05', 0),
(13610, 240, 20, 120, 0, '2022-12-05', 0),
(13611, 240, 20, 121, 0, '2022-12-05', 0),
(13612, 240, 20, 122, 0, '2022-12-05', 0),
(13613, 240, 20, 123, 0, '2022-12-05', 0),
(13614, 240, 20, 124, 0, '2022-12-05', 0),
(13615, 240, 20, 125, 0, '2022-12-05', 0),
(13616, 240, 21, 126, 0, '2022-12-05', 0),
(13617, 240, 21, 127, 0, '2022-12-05', 0),
(13618, 240, 21, 128, 0, '2022-12-05', 0),
(13619, 240, 21, 129, 0, '2022-12-05', 0),
(13620, 240, 21, 130, 0, '2022-12-05', 0),
(13621, 240, 21, 131, 0, '2022-12-05', 0),
(13622, 240, 21, 132, 0, '2022-12-05', 0),
(13623, 240, 21, 133, 0, '2022-12-05', 0),
(13624, 240, 21, 134, 0, '2022-12-05', 0),
(13625, 240, 21, 135, 0, '2022-12-05', 0),
(13626, 240, 21, 136, 0, '2022-12-05', 0),
(13627, 240, 21, 137, 0, '2022-12-05', 0),
(13628, 240, 21, 138, 0, '2022-12-05', 0),
(13629, 240, 21, 139, 0, '2022-12-05', 0),
(13630, 240, 21, 140, 0, '2022-12-05', 0),
(13631, 240, 21, 141, 0, '2022-12-05', 0),
(13632, 240, 21, 142, 0, '2022-12-05', 0),
(13633, 240, 21, 143, 0, '2022-12-05', 0),
(13634, 240, 21, 144, 0, '2022-12-05', 0),
(13635, 241, 1, 1, 1, '2023-01-17', 0),
(13636, 241, 1, 2, 0, '2023-01-17', 0),
(13637, 241, 1, 3, 0, '2023-01-17', 0),
(13638, 241, 1, 64, 0, '2023-01-17', 0),
(13639, 241, 1, 65, 0, '2023-01-17', 0),
(13640, 241, 1, 66, 0, '2023-01-17', 0),
(13641, 241, 1, 67, 0, '2023-01-17', 0),
(13642, 241, 1, 68, 0, '2023-01-17', 0),
(13643, 241, 1, 69, 0, '2023-01-17', 0),
(13644, 241, 1, 70, 0, '2023-01-17', 0),
(13645, 241, 1, 71, 0, '2023-01-17', 0),
(13646, 241, 1, 72, 0, '2023-01-17', 0),
(13647, 241, 1, 73, 0, '2023-01-17', 0),
(13648, 241, 1, 74, 1, '2023-01-17', 0),
(13649, 241, 1, 75, 1, '2023-01-17', 0),
(13650, 241, 1, 76, 1, '2023-01-17', 0),
(13651, 241, 1, 77, 1, '2023-01-17', 0),
(13652, 241, 2, 4, 0, '2023-01-17', 0),
(13653, 241, 2, 5, 0, '2023-01-17', 0),
(13654, 241, 2, 6, 0, '2023-01-17', 0),
(13655, 241, 2, 7, 0, '2023-01-17', 0),
(13656, 241, 2, 40, 0, '2023-01-17', 0),
(13657, 241, 2, 41, 0, '2023-01-17', 0),
(13658, 241, 2, 42, 0, '2023-01-17', 0),
(13659, 241, 2, 52, 0, '2023-01-17', 0),
(13660, 241, 2, 78, 0, '2023-01-17', 0),
(13661, 241, 2, 79, 0, '2023-01-17', 0),
(13662, 241, 2, 80, 0, '2023-01-17', 0),
(13663, 241, 2, 81, 0, '2023-01-17', 0),
(13664, 241, 2, 82, 0, '2023-01-17', 0),
(13665, 241, 5, 16, 0, '2023-01-17', 0),
(13666, 241, 5, 17, 0, '2023-01-17', 0),
(13667, 241, 5, 18, 0, '2023-01-17', 0),
(13668, 241, 6, 20, 0, '2023-01-17', 0),
(13669, 241, 7, 21, 0, '2023-01-17', 0),
(13670, 241, 7, 22, 0, '2023-01-17', 0),
(13671, 241, 7, 23, 0, '2023-01-17', 0),
(13672, 241, 7, 24, 0, '2023-01-17', 0),
(13673, 241, 7, 25, 0, '2023-01-17', 0),
(13674, 241, 7, 26, 0, '2023-01-17', 0),
(13675, 241, 7, 27, 0, '2023-01-17', 0),
(13676, 241, 7, 28, 0, '2023-01-17', 0),
(13677, 241, 7, 29, 0, '2023-01-17', 0),
(13678, 241, 7, 30, 0, '2023-01-17', 0),
(13679, 241, 7, 31, 0, '2023-01-17', 0),
(13680, 241, 7, 32, 0, '2023-01-17', 0),
(13681, 241, 7, 33, 0, '2023-01-17', 0),
(13682, 241, 7, 34, 0, '2023-01-17', 0),
(13683, 241, 7, 35, 0, '2023-01-17', 0),
(13684, 241, 7, 36, 0, '2023-01-17', 0),
(13685, 241, 7, 37, 0, '2023-01-17', 0),
(13686, 241, 7, 38, 0, '2023-01-17', 0),
(13687, 241, 7, 39, 0, '2023-01-17', 0),
(13688, 241, 8, 45, 0, '2023-01-17', 0),
(13689, 241, 9, 46, 0, '2023-01-17', 0),
(13690, 241, 10, 47, 0, '2023-01-17', 0),
(13691, 241, 10, 48, 0, '2023-01-17', 0),
(13692, 241, 10, 49, 0, '2023-01-17', 0),
(13693, 241, 20, 83, 0, '2023-01-17', 0),
(13694, 241, 20, 84, 0, '2023-01-17', 0),
(13695, 241, 20, 85, 0, '2023-01-17', 0),
(13696, 241, 20, 86, 0, '2023-01-17', 0),
(13697, 241, 20, 87, 0, '2023-01-17', 0),
(13698, 241, 20, 88, 0, '2023-01-17', 0),
(13699, 241, 20, 89, 0, '2023-01-17', 0),
(13700, 241, 20, 90, 0, '2023-01-17', 0),
(13701, 241, 20, 91, 0, '2023-01-17', 0),
(13702, 241, 20, 92, 0, '2023-01-17', 0),
(13703, 241, 20, 93, 0, '2023-01-17', 0),
(13704, 241, 20, 94, 0, '2023-01-17', 0),
(13705, 241, 20, 95, 0, '2023-01-17', 0),
(13706, 241, 20, 96, 0, '2023-01-17', 0),
(13707, 241, 20, 97, 0, '2023-01-17', 0),
(13708, 241, 20, 98, 0, '2023-01-17', 0),
(13709, 241, 20, 99, 0, '2023-01-17', 0),
(13710, 241, 20, 100, 0, '2023-01-17', 0),
(13711, 241, 20, 101, 0, '2023-01-17', 0),
(13712, 241, 20, 102, 0, '2023-01-17', 0),
(13713, 241, 20, 103, 0, '2023-01-17', 0),
(13714, 241, 20, 104, 0, '2023-01-17', 0),
(13715, 241, 20, 105, 0, '2023-01-17', 0),
(13716, 241, 20, 106, 0, '2023-01-17', 0),
(13717, 241, 20, 107, 0, '2023-01-17', 0),
(13718, 241, 20, 108, 0, '2023-01-17', 0),
(13719, 241, 20, 109, 0, '2023-01-17', 0),
(13720, 241, 20, 110, 0, '2023-01-17', 0),
(13721, 241, 20, 111, 0, '2023-01-17', 0),
(13722, 241, 20, 112, 0, '2023-01-17', 0),
(13723, 241, 20, 113, 0, '2023-01-17', 0),
(13724, 241, 20, 114, 0, '2023-01-17', 0),
(13725, 241, 20, 115, 0, '2023-01-17', 0),
(13726, 241, 20, 116, 0, '2023-01-17', 0),
(13727, 241, 20, 117, 0, '2023-01-17', 0),
(13728, 241, 20, 118, 0, '2023-01-17', 0),
(13729, 241, 20, 119, 0, '2023-01-17', 0),
(13730, 241, 20, 120, 0, '2023-01-17', 0),
(13731, 241, 20, 121, 0, '2023-01-17', 0),
(13732, 241, 20, 122, 0, '2023-01-17', 0),
(13733, 241, 20, 123, 0, '2023-01-17', 0),
(13734, 241, 20, 124, 0, '2023-01-17', 0),
(13735, 241, 20, 125, 0, '2023-01-17', 0),
(13736, 241, 21, 126, 0, '2023-01-17', 0),
(13737, 241, 21, 127, 0, '2023-01-17', 0),
(13738, 241, 21, 128, 0, '2023-01-17', 0),
(13739, 241, 21, 129, 0, '2023-01-17', 0),
(13740, 241, 21, 130, 0, '2023-01-17', 0),
(13741, 241, 21, 131, 0, '2023-01-17', 0),
(13742, 241, 21, 132, 0, '2023-01-17', 0),
(13743, 241, 21, 133, 0, '2023-01-17', 0),
(13744, 241, 21, 134, 0, '2023-01-17', 0),
(13745, 241, 21, 135, 0, '2023-01-17', 0),
(13746, 241, 21, 136, 0, '2023-01-17', 0),
(13747, 241, 21, 137, 0, '2023-01-17', 0),
(13748, 241, 21, 138, 0, '2023-01-17', 0),
(13749, 241, 21, 139, 0, '2023-01-17', 0),
(13750, 241, 21, 140, 0, '2023-01-17', 0),
(13751, 241, 21, 141, 0, '2023-01-17', 0),
(13752, 241, 21, 142, 0, '2023-01-17', 0),
(13753, 241, 21, 143, 0, '2023-01-17', 0),
(13754, 241, 21, 144, 0, '2023-01-17', 0),
(13755, 242, 1, 1, 0, '2023-03-10', 0),
(13756, 242, 1, 2, 0, '2023-03-10', 0),
(13757, 242, 1, 3, 0, '2023-03-10', 0),
(13758, 242, 1, 64, 0, '2023-03-10', 0),
(13759, 242, 1, 65, 0, '2023-03-10', 0),
(13760, 242, 1, 66, 0, '2023-03-10', 0),
(13761, 242, 1, 67, 0, '2023-03-10', 0),
(13762, 242, 1, 68, 0, '2023-03-10', 0),
(13763, 242, 1, 69, 0, '2023-03-10', 0),
(13764, 242, 1, 70, 0, '2023-03-10', 0),
(13765, 242, 1, 71, 0, '2023-03-10', 0),
(13766, 242, 1, 72, 0, '2023-03-10', 0),
(13767, 242, 1, 73, 0, '2023-03-10', 0),
(13768, 242, 1, 74, 0, '2023-03-10', 0),
(13769, 242, 1, 75, 0, '2023-03-10', 0),
(13770, 242, 1, 76, 0, '2023-03-10', 0),
(13771, 242, 1, 77, 0, '2023-03-10', 0),
(13772, 242, 2, 4, 0, '2023-03-10', 0),
(13773, 242, 2, 5, 0, '2023-03-10', 0),
(13774, 242, 2, 6, 0, '2023-03-10', 0),
(13775, 242, 2, 7, 0, '2023-03-10', 0),
(13776, 242, 2, 40, 0, '2023-03-10', 0),
(13777, 242, 2, 41, 0, '2023-03-10', 0),
(13778, 242, 2, 42, 0, '2023-03-10', 0),
(13779, 242, 2, 52, 0, '2023-03-10', 0),
(13780, 242, 2, 78, 0, '2023-03-10', 0),
(13781, 242, 2, 79, 0, '2023-03-10', 0),
(13782, 242, 2, 80, 0, '2023-03-10', 0),
(13783, 242, 2, 81, 0, '2023-03-10', 0),
(13784, 242, 2, 82, 0, '2023-03-10', 0),
(13785, 242, 5, 16, 0, '2023-03-10', 0),
(13786, 242, 5, 17, 0, '2023-03-10', 0),
(13787, 242, 5, 18, 0, '2023-03-10', 0),
(13788, 242, 6, 20, 0, '2023-03-10', 0),
(13789, 242, 7, 21, 0, '2023-03-10', 0),
(13790, 242, 7, 22, 0, '2023-03-10', 0),
(13791, 242, 7, 23, 0, '2023-03-10', 0),
(13792, 242, 7, 24, 0, '2023-03-10', 0),
(13793, 242, 7, 25, 0, '2023-03-10', 0),
(13794, 242, 7, 26, 0, '2023-03-10', 0),
(13795, 242, 7, 27, 0, '2023-03-10', 0),
(13796, 242, 7, 28, 0, '2023-03-10', 0),
(13797, 242, 7, 29, 0, '2023-03-10', 0),
(13798, 242, 7, 30, 0, '2023-03-10', 0),
(13799, 242, 7, 31, 0, '2023-03-10', 0),
(13800, 242, 7, 32, 0, '2023-03-10', 0),
(13801, 242, 7, 33, 0, '2023-03-10', 0),
(13802, 242, 7, 34, 0, '2023-03-10', 0),
(13803, 242, 7, 35, 0, '2023-03-10', 0),
(13804, 242, 7, 36, 0, '2023-03-10', 0),
(13805, 242, 7, 37, 0, '2023-03-10', 0),
(13806, 242, 7, 38, 1, '2023-03-10', 0),
(13807, 242, 7, 39, 0, '2023-03-10', 0),
(13808, 242, 8, 45, 1, '2023-03-10', 0),
(13809, 242, 9, 46, 0, '2023-03-10', 0),
(13810, 242, 10, 47, 0, '2023-03-10', 0),
(13811, 242, 10, 48, 0, '2023-03-10', 0),
(13812, 242, 10, 49, 0, '2023-03-10', 0),
(13813, 242, 20, 83, 0, '2023-03-10', 0),
(13814, 242, 20, 84, 0, '2023-03-10', 0),
(13815, 242, 20, 85, 0, '2023-03-10', 0),
(13816, 242, 20, 86, 0, '2023-03-10', 0),
(13817, 242, 20, 87, 0, '2023-03-10', 0),
(13818, 242, 20, 88, 0, '2023-03-10', 0),
(13819, 242, 20, 89, 0, '2023-03-10', 0),
(13820, 242, 20, 90, 0, '2023-03-10', 0),
(13821, 242, 20, 91, 0, '2023-03-10', 0),
(13822, 242, 20, 92, 0, '2023-03-10', 0),
(13823, 242, 20, 93, 0, '2023-03-10', 0),
(13824, 242, 20, 94, 0, '2023-03-10', 0),
(13825, 242, 20, 95, 0, '2023-03-10', 0),
(13826, 242, 20, 96, 0, '2023-03-10', 0),
(13827, 242, 20, 97, 0, '2023-03-10', 0),
(13828, 242, 20, 98, 0, '2023-03-10', 0),
(13829, 242, 20, 99, 0, '2023-03-10', 0),
(13830, 242, 20, 100, 0, '2023-03-10', 0),
(13831, 242, 20, 101, 0, '2023-03-10', 0),
(13832, 242, 20, 102, 0, '2023-03-10', 0),
(13833, 242, 20, 103, 0, '2023-03-10', 0),
(13834, 242, 20, 104, 0, '2023-03-10', 0),
(13835, 242, 20, 105, 0, '2023-03-10', 0),
(13836, 242, 20, 106, 0, '2023-03-10', 0),
(13837, 242, 20, 107, 0, '2023-03-10', 0),
(13838, 242, 20, 108, 0, '2023-03-10', 0),
(13839, 242, 20, 109, 0, '2023-03-10', 0),
(13840, 242, 20, 110, 0, '2023-03-10', 0),
(13841, 242, 20, 111, 0, '2023-03-10', 0),
(13842, 242, 20, 112, 0, '2023-03-10', 0),
(13843, 242, 20, 113, 0, '2023-03-10', 0),
(13844, 242, 20, 114, 0, '2023-03-10', 0),
(13845, 242, 20, 115, 0, '2023-03-10', 0),
(13846, 242, 20, 116, 0, '2023-03-10', 0),
(13847, 242, 20, 117, 0, '2023-03-10', 0),
(13848, 242, 20, 118, 0, '2023-03-10', 0),
(13849, 242, 20, 119, 0, '2023-03-10', 0),
(13850, 242, 20, 120, 0, '2023-03-10', 0),
(13851, 242, 20, 121, 0, '2023-03-10', 0),
(13852, 242, 20, 122, 0, '2023-03-10', 0),
(13853, 242, 20, 123, 0, '2023-03-10', 0),
(13854, 242, 20, 124, 0, '2023-03-10', 0),
(13855, 242, 20, 125, 0, '2023-03-10', 0),
(13856, 242, 21, 126, 0, '2023-03-10', 0),
(13857, 242, 21, 127, 0, '2023-03-10', 0),
(13858, 242, 21, 128, 0, '2023-03-10', 0),
(13859, 242, 21, 129, 0, '2023-03-10', 0),
(13860, 242, 21, 130, 0, '2023-03-10', 0),
(13861, 242, 21, 131, 0, '2023-03-10', 0),
(13862, 242, 21, 132, 0, '2023-03-10', 0),
(13863, 242, 21, 133, 0, '2023-03-10', 0),
(13864, 242, 21, 134, 0, '2023-03-10', 0),
(13865, 242, 21, 135, 0, '2023-03-10', 0),
(13866, 242, 21, 136, 0, '2023-03-10', 0),
(13867, 242, 21, 137, 0, '2023-03-10', 0),
(13868, 242, 21, 138, 0, '2023-03-10', 0),
(13869, 242, 21, 139, 0, '2023-03-10', 0),
(13870, 242, 21, 140, 0, '2023-03-10', 0),
(13871, 242, 21, 141, 0, '2023-03-10', 0),
(13872, 242, 21, 142, 0, '2023-03-10', 0),
(13873, 242, 21, 143, 0, '2023-03-10', 0),
(13874, 242, 21, 144, 0, '2023-03-10', 0);

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
(151, 234, 9, 46, NULL, '1667299977Cocomelon_Birthday_Invitation_Template_-_Made_with_PosterMyWall.jpg'),
(152, 236, 1, 1, NULL, '1667382844letrero.png'),
(153, 233, 1, 63, NULL, '1667470787Cocomelon_Birthday_Invitation_Template_-_Made_with_PosterMyWall.jpg'),
(154, 238, 1, 1, NULL, '1667585509DOCUMENTOS_REQUERIDOS_POR_LOS_SERVICIOS_BRINDADOS.docx'),
(155, 238, 2, 78, NULL, '1667604829DOCUMENTOS_REQUERIDOS_POR_LOS_SERVICIOS_BRINDADOS.docx'),
(156, 239, 1, 1, NULL, '1667991670SOLUTION_SERVICES_WEBAPP_Requirements-1.pdf'),
(157, 239, 1, 73, NULL, '1667991854Image_not_available.png'),
(158, 240, 2, 40, NULL, '1670258167WhatsApp_Image_2022-11-24_at_5_02_38_PM.jpeg'),
(159, 240, 2, 80, NULL, '1678473882Captura_de_pantalla_2023-02-16_a_las_6_32_40_p_m_.png');

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
(1, 'Super Admin', 'super', 'hain123', NULL, 'info@masonicdues.com', 'Male', 'profile.jpg', 'member_awais.png', '1662407635big-buck-bunny-poster.jpg', 'Gujranwala', 'Administrator', '030000000', '2018-09-10 00:00:00', 1, '2018-09-10 00:00:00', '2023-03-29 08:53:03', '2023-03-29 10:53:03', 1, 1, b'1', b'0'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `tbl_email_logs`
--
ALTER TABLE `tbl_email_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_lists`
--
ALTER TABLE `tbl_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `tbl_project_records`
--
ALTER TABLE `tbl_project_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13875;

--
-- AUTO_INCREMENT for table `tbl_records`
--
ALTER TABLE `tbl_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
