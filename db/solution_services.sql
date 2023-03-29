-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2022 at 04:06 PM
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
(26, 1, 10, 1);

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
(1, 'Certificado de No Objeción al Uso de Suelo y Edificaciones.', NULL, 1, 1, 0),
(2, 'Certificado de Renovación de permisos', NULL, 1, 1, 0),
(3, 'Resellados de plano', NULL, 1, 1, 0),
(4, 'Gestión Certificado de Registro de Impacto Mínimo.', NULL, 2, 1, 0),
(5, 'Gestión de Constancia Ambiental, Permiso Ambiental o Licencia Ambiental.', NULL, 2, 1, 0),
(6, 'Gestión Informe de Cumplimiento Ambiental (ICA).', NULL, 2, 1, 0),
(7, 'Gestión del Plan de Manejo Ambiental (PMA).', NULL, 2, 1, 0),
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
(19, 'Additional Document', NULL, 5, 1, 0),
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
(40, 'Supervisión de Cumplimiento Ambiental.', NULL, 2, 1, 0),
(41, 'Asesoría Manejo de residuos líquidos, solidos, oleoso o especificados (hospitalarios o biomédicos).', NULL, 2, 1, 0),
(42, 'Estudio de Impacto Ambiental.', NULL, 2, 1, 0),
(43, 'CONFOTUR.', NULL, 3, 1, 0),
(44, 'Gestión de solicitud de supervisión.', NULL, 4, 1, 0),
(45, 'Carta de aprobación para el abastecimiento.', NULL, 8, 1, 0),
(46, 'Carta de aprobación.', NULL, 9, 1, 0),
(47, 'Licencia de operaciones de Almacenes.', NULL, 10, 1, 0),
(48, 'Licencia de operaciones de Estaciones.', NULL, 10, 1, 0),
(49, 'Certificación para locales Industriales.', NULL, 10, 1, 0),
(75, 'sdfsadfasd', NULL, 1, 1, 0);

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
  `mk_status` int(11) NOT NULL DEFAULT 0,
  `active_bit` tinyint(1) NOT NULL DEFAULT 0,
  `index` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `enable_bit` tinyint(1) DEFAULT 1,
  `delete_bit` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_lists`
--

INSERT INTO `tbl_lists` (`id`, `title`, `mk_status`, `active_bit`, `index`, `created_at`, `enable_bit`, `delete_bit`) VALUES
(1, '0', 0, 0, 2, '2022-09-12 16:03:55', 1, 0),
(2, 'Ministerio de Medio Ambiente', 0, 0, 3, '2022-09-12 16:05:46', 1, 0),
(3, 'Ministerio de Turismo', 0, 0, 4, '2022-09-12 16:05:46', 1, 0),
(4, 'Ministerio de la Vivienda y Edificaciones', 0, 0, 5, '2022-09-12 16:06:30', 1, 0),
(5, 'Jurisdicción Inmobiliaria', 0, 0, 6, '2022-09-12 16:06:30', 1, 0),
(6, 'Compañía Distribuidora de Energía', 1, 0, 7, '2022-09-12 16:07:13', 1, 0),
(7, 'Documentos Generales', 1, 0, 1, '2022-09-12 16:07:13', 1, 0),
(8, 'Compañía Distribuidora de Agua', 1, 0, 8, '2022-09-12 16:07:13', 1, 0),
(9, 'Cuerpo de Bomberos', 1, 0, 9, '2022-09-12 16:07:13', 1, 0),
(10, 'Industria y Comercio', 1, 0, 10, '2022-09-12 16:07:13', 1, 0),
(29, 'sdfasdfdf', 0, 0, 0, '2022-10-24 15:16:25', 1, 0);

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
(4, 'Pending', 'Pending', 'iconsminds-over-time-2', '1', 0, 1, '0000-00-00 00:00:00.0'),
(5, 'Archivado', 'Archived', 'iconsminds-download-1\n', '1', 1, 0, '0000-00-00 00:00:00.0'),
(6, 'Check In', 'Check_In', 'checkin.svg', '1', 0, 1, '0000-00-00 00:00:00.0'),
(7, 'Setting', 'Settings', 'setting.svg', '1', 0, 1, '2022-09-02 00:15:39.0'),
(9, 'Users', 'Users', 'setting.svg', '1', 1, 0, '2022-09-02 00:15:39.0'),
(10, 'Lists', 'Lists', 'setting.svg', '1', 1, 0, '2022-09-02 00:15:39.0');

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
  `phone` int(100) DEFAULT NULL,
  `labels` varchar(255) DEFAULT NULL,
  `status` int(10) DEFAULT 2 COMMENT '1 : completed\r\n2 : pending\r\n3 : archived',
  `const_bit` int(10) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `enable_bit` tinyint(1) DEFAULT 1,
  `delete_bit` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_projects`
--

INSERT INTO `tbl_projects` (`id`, `project_name`, `location`, `project_size_m2`, `description`, `company_name`, `contact_email`, `phone`, `labels`, `status`, `const_bit`, `owner_id`, `created_at`, `updated_at`, `enable_bit`, `delete_bit`) VALUES
(1, 'Project Scape', 'misc Dummy Location', 8000, 'this is project description', 'The Dummy Company', 'Dummy@email.com', 4367289, 'Dummy Labels', 2, 1, 1, '2022-09-12 13:18:20', '2022-09-10 16:05:14', 0, 1),
(2, 'Land to Rove', 'Dummy 2 Location', 1908327, 'this is Dummy 2 Description.', 'Dummy 2 Company Name', 'Dummy2@gmail.com', 2147483647, 'Dummy 2 labels', 2, 1, 1, '2022-09-19 19:26:07', NULL, 0, 1),
(3, 'Dummy 3', 'Dummy Location', 9000, 'this is misc Description', 'Misc company name', 'misc@email.com', 43627493, 'labels', 2, 1, 2, '2022-09-15 14:37:38', NULL, 1, 0),
(4, 'owner Admin', 'localization', 100000, 'this is owner project description', 'owner compnay', 'owner@gmail.com', 2147483647, 'owner tags', 2, 2, 2, '2022-09-28 10:57:42', NULL, 1, 0),
(5, 'owner project 3', 'project 3 area', 100000, 'this is misc description project 3', 'project name compnay', 'company@gmail.com', 2147483647, 'owner tags', 2, 2, 2, '2022-09-28 11:00:03', NULL, 1, 0),
(220, 'safddsfadf', 'sadfasdfa', 124367, 'sdfadfasdf', 'sdfasdfasdf', 'skjdfhakjsdfhaj@gmail.com', 2147483647, 'sdfasdf', 2, NULL, 1, '2022-10-22 10:20:06', NULL, 0, 1),
(221, 'qwererqwer', 'werqwerqwerw', 2147483647, 'rwerweqrqwerqwerwer', 'asfdsdfwerqwerqwerqwerqwer', 'werqwerqw@gmail.com', 2147483647, 'sdfsadfasdfrwqerwqer', 2, 1, 1, '2022-10-25 15:22:54', NULL, 1, 0);

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
(12199, 219, 1, 1, 0, '0000-00-00', 0),
(12200, 219, 1, 2, 0, '0000-00-00', 0),
(12201, 219, 1, 3, 0, '0000-00-00', 0),
(12202, 219, 1, 51, 0, '0000-00-00', 0),
(12203, 219, 2, 4, 0, '0000-00-00', 0),
(12204, 219, 2, 5, 0, '0000-00-00', 0),
(12205, 219, 2, 6, 0, '0000-00-00', 0),
(12206, 219, 2, 7, 0, '0000-00-00', 0),
(12207, 219, 2, 40, 0, '0000-00-00', 0),
(12208, 219, 2, 41, 0, '0000-00-00', 0),
(12209, 219, 2, 42, 0, '0000-00-00', 0),
(12210, 219, 2, 52, 0, '0000-00-00', 0),
(12211, 219, 3, 8, 0, '0000-00-00', 0),
(12212, 219, 3, 9, 0, '0000-00-00', 0),
(12213, 219, 3, 10, 0, '0000-00-00', 0),
(12214, 219, 3, 11, 0, '0000-00-00', 0),
(12215, 219, 3, 43, 0, '0000-00-00', 0),
(12216, 219, 3, 53, 0, '0000-00-00', 0),
(12217, 219, 4, 12, 0, '0000-00-00', 0),
(12218, 219, 4, 13, 0, '0000-00-00', 0),
(12219, 219, 4, 14, 0, '0000-00-00', 0),
(12220, 219, 4, 15, 0, '0000-00-00', 0),
(12221, 219, 4, 44, 0, '0000-00-00', 0),
(12222, 219, 4, 54, 0, '0000-00-00', 0),
(12223, 219, 5, 16, 0, '0000-00-00', 0),
(12224, 219, 5, 17, 0, '0000-00-00', 0),
(12225, 219, 5, 18, 0, '0000-00-00', 0),
(12226, 219, 5, 19, 0, '0000-00-00', 0),
(12227, 219, 6, 20, 0, '0000-00-00', 0),
(12228, 219, 6, 55, 0, '0000-00-00', 0),
(12229, 219, 7, 21, 0, '0000-00-00', 0),
(12230, 219, 7, 22, 0, '0000-00-00', 0),
(12231, 219, 7, 23, 0, '0000-00-00', 0),
(12232, 219, 7, 24, 0, '0000-00-00', 0),
(12233, 219, 7, 25, 0, '0000-00-00', 0),
(12234, 219, 7, 26, 0, '0000-00-00', 0),
(12235, 219, 7, 27, 0, '0000-00-00', 0),
(12236, 219, 7, 28, 0, '0000-00-00', 0),
(12237, 219, 7, 29, 0, '0000-00-00', 0),
(12238, 219, 7, 30, 0, '0000-00-00', 0),
(12239, 219, 7, 31, 0, '0000-00-00', 0),
(12240, 219, 7, 32, 0, '0000-00-00', 0),
(12241, 219, 7, 33, 0, '0000-00-00', 0),
(12242, 219, 7, 34, 0, '0000-00-00', 0),
(12243, 219, 7, 35, 0, '0000-00-00', 0),
(12244, 219, 7, 36, 0, '0000-00-00', 0),
(12245, 219, 7, 37, 0, '0000-00-00', 0),
(12246, 219, 7, 38, 0, '0000-00-00', 0),
(12247, 219, 7, 39, 0, '0000-00-00', 0),
(12248, 219, 8, 45, 0, '0000-00-00', 0),
(12249, 219, 8, 56, 0, '0000-00-00', 0),
(12250, 219, 9, 46, 0, '0000-00-00', 0),
(12251, 219, 9, 57, 0, '0000-00-00', 0),
(12252, 219, 10, 47, 0, '0000-00-00', 0),
(12253, 219, 10, 48, 0, '0000-00-00', 0),
(12254, 219, 10, 49, 0, '0000-00-00', 0),
(12255, 219, 10, 50, 0, '0000-00-00', 0),
(12256, 220, 1, 1, 0, '0000-00-00', 0),
(12257, 220, 1, 2, 0, '0000-00-00', 0),
(12258, 220, 1, 3, 0, '0000-00-00', 0),
(12259, 220, 1, 51, 0, '0000-00-00', 0),
(12260, 220, 2, 4, 0, '0000-00-00', 0),
(12261, 220, 2, 5, 0, '0000-00-00', 0),
(12262, 220, 2, 6, 0, '0000-00-00', 0),
(12263, 220, 2, 7, 0, '0000-00-00', 0),
(12264, 220, 2, 40, 0, '0000-00-00', 0),
(12265, 220, 2, 41, 0, '0000-00-00', 0),
(12266, 220, 2, 42, 0, '0000-00-00', 0),
(12267, 220, 2, 52, 0, '0000-00-00', 0),
(12268, 220, 3, 8, 0, '0000-00-00', 0),
(12269, 220, 3, 9, 0, '0000-00-00', 0),
(12270, 220, 3, 10, 0, '0000-00-00', 0),
(12271, 220, 3, 11, 0, '0000-00-00', 0),
(12272, 220, 3, 43, 0, '0000-00-00', 0),
(12273, 220, 3, 53, 0, '0000-00-00', 0),
(12274, 220, 4, 12, 0, '0000-00-00', 0),
(12275, 220, 4, 13, 0, '0000-00-00', 0),
(12276, 220, 4, 14, 0, '0000-00-00', 0),
(12277, 220, 4, 15, 0, '0000-00-00', 0),
(12278, 220, 4, 44, 0, '0000-00-00', 0),
(12279, 220, 4, 54, 0, '0000-00-00', 0),
(12280, 220, 5, 16, 0, '0000-00-00', 0),
(12281, 220, 5, 17, 0, '0000-00-00', 0),
(12282, 220, 5, 18, 0, '0000-00-00', 0),
(12283, 220, 5, 19, 0, '0000-00-00', 0),
(12284, 220, 6, 20, 0, '0000-00-00', 0),
(12285, 220, 6, 55, 0, '0000-00-00', 0),
(12286, 220, 7, 21, 0, '0000-00-00', 0),
(12287, 220, 7, 22, 0, '0000-00-00', 0),
(12288, 220, 7, 23, 0, '0000-00-00', 0),
(12289, 220, 7, 24, 0, '0000-00-00', 0),
(12290, 220, 7, 25, 0, '0000-00-00', 0),
(12291, 220, 7, 26, 0, '0000-00-00', 0),
(12292, 220, 7, 27, 0, '0000-00-00', 0),
(12293, 220, 7, 28, 0, '0000-00-00', 0),
(12294, 220, 7, 29, 0, '0000-00-00', 0),
(12295, 220, 7, 30, 0, '0000-00-00', 0),
(12296, 220, 7, 31, 0, '0000-00-00', 0),
(12297, 220, 7, 32, 0, '0000-00-00', 0),
(12298, 220, 7, 33, 0, '0000-00-00', 0),
(12299, 220, 7, 34, 0, '0000-00-00', 0),
(12300, 220, 7, 35, 0, '0000-00-00', 0),
(12301, 220, 7, 36, 0, '0000-00-00', 0),
(12302, 220, 7, 37, 0, '0000-00-00', 0),
(12303, 220, 7, 38, 0, '0000-00-00', 0),
(12304, 220, 7, 39, 0, '0000-00-00', 0),
(12305, 220, 8, 45, 0, '0000-00-00', 0),
(12306, 220, 8, 56, 0, '0000-00-00', 0),
(12307, 220, 9, 46, 0, '0000-00-00', 0),
(12308, 220, 9, 57, 0, '0000-00-00', 0),
(12309, 220, 10, 47, 0, '0000-00-00', 0),
(12310, 220, 10, 48, 0, '0000-00-00', 0),
(12311, 220, 10, 49, 0, '0000-00-00', 0),
(12312, 220, 10, 50, 0, '0000-00-00', 0),
(12313, 221, 1, 1, 0, '2022-10-25', 0),
(12314, 221, 1, 2, 0, '2022-10-25', 0),
(12315, 221, 1, 3, 0, '2022-10-25', 0),
(12316, 221, 1, 75, 0, '2022-10-25', 0),
(12317, 221, 2, 4, 0, '2022-10-25', 0),
(12318, 221, 2, 5, 0, '2022-10-25', 0),
(12319, 221, 2, 6, 0, '2022-10-25', 0),
(12320, 221, 2, 7, 0, '2022-10-25', 0),
(12321, 221, 2, 40, 0, '2022-10-25', 0),
(12322, 221, 2, 41, 0, '2022-10-25', 0),
(12323, 221, 2, 42, 0, '2022-10-25', 0),
(12324, 221, 3, 8, 0, '2022-10-25', 0),
(12325, 221, 3, 9, 0, '2022-10-25', 0),
(12326, 221, 3, 10, 0, '2022-10-25', 0),
(12327, 221, 3, 11, 0, '2022-10-25', 0),
(12328, 221, 3, 43, 0, '2022-10-25', 0),
(12329, 221, 4, 12, 0, '2022-10-25', 0),
(12330, 221, 4, 13, 0, '2022-10-25', 0),
(12331, 221, 4, 14, 0, '2022-10-25', 0),
(12332, 221, 4, 15, 0, '2022-10-25', 0),
(12333, 221, 4, 44, 0, '2022-10-25', 0),
(12334, 221, 5, 16, 0, '2022-10-25', 0),
(12335, 221, 5, 17, 0, '2022-10-25', 0),
(12336, 221, 5, 18, 0, '2022-10-25', 0),
(12337, 221, 5, 19, 0, '2022-10-25', 0),
(12338, 221, 6, 20, 0, '2022-10-25', 0),
(12339, 221, 7, 21, 0, '2022-10-25', 0),
(12340, 221, 7, 22, 0, '2022-10-25', 0),
(12341, 221, 7, 23, 0, '2022-10-25', 0),
(12342, 221, 7, 24, 0, '2022-10-25', 0),
(12343, 221, 7, 25, 0, '2022-10-25', 0),
(12344, 221, 7, 26, 0, '2022-10-25', 0),
(12345, 221, 7, 27, 0, '2022-10-25', 0),
(12346, 221, 7, 28, 0, '2022-10-25', 0),
(12347, 221, 7, 29, 0, '2022-10-25', 0),
(12348, 221, 7, 30, 0, '2022-10-25', 0),
(12349, 221, 7, 31, 0, '2022-10-25', 0),
(12350, 221, 7, 32, 0, '2022-10-25', 0),
(12351, 221, 7, 33, 0, '2022-10-25', 0),
(12352, 221, 7, 34, 0, '2022-10-25', 0),
(12353, 221, 7, 35, 0, '2022-10-25', 0),
(12354, 221, 7, 36, 0, '2022-10-25', 0),
(12355, 221, 7, 37, 0, '2022-10-25', 0),
(12356, 221, 7, 38, 0, '2022-10-25', 0),
(12357, 221, 7, 39, 0, '2022-10-25', 0),
(12358, 221, 8, 45, 0, '2022-10-25', 0),
(12359, 221, 9, 46, 0, '2022-10-25', 0),
(12360, 221, 10, 47, 0, '2022-10-25', 0),
(12361, 221, 10, 48, 0, '2022-10-25', 0),
(12362, 221, 10, 49, 0, '2022-10-25', 0);

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
(1, 'info@masonicdues.com', 'smtp', 'mail.masonicdues.com', 'info@masonicdues.com', '28f20b3a926b5743591cadea10aa2818', '465', 'tls', '/usr/sbin/sendmail');

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
(1, 'Nafees Ahmed', 'super', 'hain123', NULL, 'info@solutionservices.com', 'Male', 'profile.jpg', NULL, NULL, 'Spain', 'Administrator', '03059876354', '2018-09-10 00:00:00', NULL, '2018-09-10 00:00:00', '2022-10-24 12:14:54', '2022-10-24 14:14:54', 1, 0, b'1', b'0'),
(2, 'Admin', 'admin', 'asdfghjkl', '1', 'sulaimanehsan@gmail.com', 'Male', 'profile2.jpg', NULL, NULL, 'Sialkotroad , via hamiltonroad, chandnipaanshop wala gala, street no.2', 'Admin', '03138066500', '2022-08-20 00:18:10', 1, '2022-10-24 14:26:40', '2022-10-24 12:26:40', '2022-09-28 10:56:03', 2, 1, b'1', b'0'),
(3, 'Salman Ahmed', 'member', 'hain123', NULL, 'info@solutionservices.com', 'Male', 'profile2.jpg', NULL, NULL, 'Gujranwala', 'Member', '0345000000', NULL, 2, '2022-08-20 00:18:10', '2022-10-24 12:11:40', '2022-09-14 13:04:07', 4, 0, b'1', b'0'),
(42, 'umer mehar', 'umer', 'asdf', '9040301736043', 'umermehar@gmail.com', 'Other', NULL, NULL, NULL, 'Sialkotroad , via hamiltonroad, chandnipaanshop wala gala, street no.2', NULL, '03154887987', NULL, NULL, '2022-10-20 14:16:57', '2022-10-24 11:06:39', NULL, 2, 0, b'1', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_client_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  `reset_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Asia/Kolkata',
  `date_format` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'd-m-Y',
  `date_picker_format` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dd-mm-yyyy',
  `time_format` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'h:i a',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_access`
--
ALTER TABLE `tbl_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_checklists`
--
ALTER TABLE `tbl_checklists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbl_email_logs`
--
ALTER TABLE `tbl_email_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_lists`
--
ALTER TABLE `tbl_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `tbl_project_records`
--
ALTER TABLE `tbl_project_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12363;

--
-- AUTO_INCREMENT for table `tbl_records`
--
ALTER TABLE `tbl_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
