-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 03, 2025 at 06:13 AM
-- Server version: 8.0.41
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chemlab`
--
CREATE DATABASE IF NOT EXISTS `chemlab` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `chemlab`;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
                         `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
                         `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
                               `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chemicals`
--

CREATE TABLE `chemicals` (
                             `id` bigint UNSIGNED NOT NULL,
                             `chemical_formula` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `chemical_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `chemical_name_sk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `disposal_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `disposal_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `access_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `access_sk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `supplies_id` bigint UNSIGNED NOT NULL,
                             `measure_unit_id` bigint UNSIGNED NOT NULL,
                             `description_en` text COLLATE utf8mb4_unicode_ci,
                             `description_sk` text COLLATE utf8mb4_unicode_ci,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chemicals`
--

INSERT INTO `chemicals` (`id`, `chemical_formula`, `chemical_name_en`, `chemical_name_sk`, `disposal_en`, `disposal_sk`, `access_en`, `access_sk`, `supplies_id`, `measure_unit_id`, `description_en`, `description_sk`, `created_at`, `updated_at`) VALUES
                                                                                                                                                                                                                                                         (1, '(CH3)2CO', 'Aceton', 'Acetón', 'dilution with water sewage system', 'riedenie vodou kanalizačný systém', 'teacher/student', 'učiteľ/žiak', 1, 2, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (2, 'NH3', 'Ammonia', 'Amoniak', 'neutralization, dilution with water sewage system', 'neutralizácia, riedenie vodou kanalizačný systém', 'teacher/student only with solution < 5%', 'učiteľ/žiak iba s roztokom < 5%', 1, 2, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (3, 'C4H6O3', 'Acetic Anhydride(Acetanhydrid)', 'anhydrid kyseliny octovej', 'can be recycled at the workplace', 'je možné recyklovať na pracovisku', 'teacher', 'učiteľ', 1, 2, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (4, 'KNO3', 'Potassium nitrate', 'dusičnan draselný', 'dilution with water sewage system', 'riedenie vodou kanalizačný systém', 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (5, 'AgNO3', 'Silver nitrate', 'dusičnan strieborný', 'can be recycled at the workplace', 'je možné recyklovať na pracovisku', 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (6, 'CH3COOCH2CH3', 'Ethyl acetate', 'etylacetát', '', '', 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (7, 'C20H14O4', 'phenolphthalein', 'fenolftaleín 1%', NULL, NULL, 'teacher/student', 'učiteľ/žiak iba s roztokom < 1%', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (8, 'C6H12O6', 'fructose ', 'fruktóza', NULL, NULL, 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (9, 'C6H12O6', 'glucose ', 'fruktóza', NULL, NULL, 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (10, 'C6N6FeK3', 'Potassium ferricyanide', 'hexakyanoželezitan draselný', NULL, NULL, 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (11, 'K4[Fe(CN)6]', 'Potassium ferrocyanide', 'hexakyanoželeznatan draselný', NULL, NULL, 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (12, 'MgO', 'Magnesium', 'horčík', '', '', 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (13, 'MgO', 'Bicarbonate of Soda', 'hydrogenuhličitan sodný', '', '', 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (14, 'NaOH', 'Sodium hydroxide', 'hydroxid sodný', 'neutralization sewage system', 'neutralizácia kanalizačný systém', 'teacher/student only with solution < 0.5%)', 'učitel/žiak iba s roztokom < 0,5%', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (15, 'CuCl2', 'Copper(II) chloride', 'chlorid meďnatý', 'must be handed over', 'musí byť odovzdaný', 'teacher/student)', 'učitel/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (16, 'I', 'Iodine', 'jód', 'must be handed over', 'musí byť odovzdaný', 'teacher/student)', 'učitel/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (17, 'KI', 'Potassium iodide', 'jodid draselný', '', '', 'teacher/student)', 'učitel/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (18, 'C₆H₈O₇', 'Citric Acid', 'kyselina citrónová', 'dilution with water sewage system', 'riedenie vodou kanalizačný systém', 'teacher/student)', 'učitel/žiak', 1, 2, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (19, 'HNO₃', 'Nitric acid', 'kyselina dusičná', 'neutralization dilution with water sewage system', 'neutralizácia riedenie vodou kanalizačný systém', 'teacher/student only with solution < 5%', 'učiteľ/žiak iba s roztokom < 5%', 1, 2, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (20, 'HCl', 'Hydrochloric acid', 'kyselina chlorovodíková', 'neutralization dilution with water sewage system', 'neutralizácia riedenie vodou kanalizačný systém', 'teacher/student only with solution < 10%', 'učitel/žiak iba s roztokom < 10%', 1, 2, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (21, 'CH₃COOH', 'Acetic Acid', 'kyselina octová', 'neutralization dilution with water sewage system', 'neutralizácia riedenie vodou kanalizačný systém', 'teacher/student only with solution < 10%', 'učitel/žiak iba s roztokom < 10%', 1, 2, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (22, 'H₂SO₄', 'Sulfuric acid', 'kyselina sírová', 'neutralization dilution with water sewage system', 'neutralizácia riedenie vodou kanalizačný systém', 'teacher/student only with solution < 5%', 'učiteľ/žiak iba s roztokom < 5% ', 1, 2, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (23, 'chemical composition C9H10O5N and C13H22O6, for blue and red litmus papers respectively', 'Litmus', 'lakmus', 'neutralization dilution with water sewage system', 'neutralizácia riedenie vodou kanalizačný systém', 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (24, 'KMnO₄', 'Potassium Permanganate', 'manganistan draselný', 'dilution with water sewage system', 'riedenie vodou kanalizačný systém', 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (25, 'C14H14N3NaO3S', 'Methyl Orange', 'metyloranž', 'dilution with water sewage system', 'riedenie vodou kanalizačný systém', 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (26, 'MnO₂', 'Manganese(IV) oxide', 'oxid manganičitý', 'raw material for further work', 'surovina pre ďalšie práce', 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (27, 'H2O2', 'Hydrogen peroxide', 'peroxid vodíka', 'dilution with water sewage system', 'riedenie vodou kanalizačný systém', 'teacher/student only with solution < 5%', 'učiteľ/žiak iba s roztokom < 5% ', 1, 2, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (28, 'S8', 'Sulfur', 'síra', 'dilution with water sewage system', 'riedenie vodou kanalizačný systém', 'teacher/student', 'učiteľ/žiak', 1, 2, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (29, 'Na2SO4', 'Sodium sulfate', 'síran meďnatý', 'can be recycled at the workplace', 'je možné recyklovať na pracovisku', 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (30, '(C6H10O5)n)', 'Starch', 'škrob', NULL, NULL, 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                                                                                                                                         (31, '(CaCO3)', 'Calcium carbonate', 'uhličitan vápenatý', NULL, NULL, 'teacher/student', 'učiteľ/žiak', 1, 1, NULL, NULL, '2025-03-31 22:03:32', '2025-03-31 22:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `chemical_dangerous_property`
--

CREATE TABLE `chemical_dangerous_property` (
                                               `id` bigint UNSIGNED NOT NULL,
                                               `chemical_id` bigint UNSIGNED NOT NULL,
                                               `dangerous_property_id` bigint UNSIGNED NOT NULL,
                                               `created_at` timestamp NULL DEFAULT NULL,
                                               `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chemical_dangerous_property`
--

INSERT INTO `chemical_dangerous_property` (`id`, `chemical_id`, `dangerous_property_id`, `created_at`, `updated_at`) VALUES
                                                                                                                         (1, 1, 1, NULL, NULL),
                                                                                                                         (2, 1, 5, NULL, NULL),
                                                                                                                         (3, 2, 2, NULL, NULL),
                                                                                                                         (4, 2, 3, NULL, NULL),
                                                                                                                         (5, 3, 2, NULL, NULL),
                                                                                                                         (6, 4, 4, NULL, NULL),
                                                                                                                         (7, 5, 2, NULL, NULL),
                                                                                                                         (8, 5, 3, NULL, NULL),
                                                                                                                         (9, 6, 1, NULL, NULL),
                                                                                                                         (10, 6, 5, NULL, NULL),
                                                                                                                         (11, 7, 1, NULL, NULL),
                                                                                                                         (12, 7, 5, NULL, NULL),
                                                                                                                         (13, 12, 1, NULL, NULL),
                                                                                                                         (14, 13, 1, NULL, NULL),
                                                                                                                         (15, 14, 2, NULL, NULL),
                                                                                                                         (16, 15, 3, NULL, NULL),
                                                                                                                         (17, 15, 6, NULL, NULL),
                                                                                                                         (18, 16, 3, NULL, NULL),
                                                                                                                         (19, 16, 6, NULL, NULL),
                                                                                                                         (20, 18, 5, NULL, NULL),
                                                                                                                         (21, 18, 2, NULL, NULL),
                                                                                                                         (22, 19, 5, NULL, NULL),
                                                                                                                         (23, 19, 2, NULL, NULL),
                                                                                                                         (24, 20, 5, NULL, NULL),
                                                                                                                         (25, 20, 2, NULL, NULL),
                                                                                                                         (26, 21, 5, NULL, NULL),
                                                                                                                         (27, 21, 2, NULL, NULL),
                                                                                                                         (28, 22, 2, NULL, NULL),
                                                                                                                         (29, 24, 4, NULL, NULL),
                                                                                                                         (30, 24, 3, NULL, NULL),
                                                                                                                         (31, 24, 2, NULL, NULL),
                                                                                                                         (32, 25, 7, NULL, NULL),
                                                                                                                         (33, 26, 6, NULL, NULL),
                                                                                                                         (34, 27, 6, NULL, NULL),
                                                                                                                         (35, 27, 2, NULL, NULL),
                                                                                                                         (36, 29, 6, NULL, NULL),
                                                                                                                         (37, 29, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chemical_experiment`
--

CREATE TABLE `chemical_experiment` (
                                       `id` bigint UNSIGNED NOT NULL,
                                       `chemical_id` bigint UNSIGNED NOT NULL,
                                       `experiment_id` bigint UNSIGNED NOT NULL,
                                       `created_at` timestamp NULL DEFAULT NULL,
                                       `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chemical_safety_item`
--

CREATE TABLE `chemical_safety_item` (
                                        `id` bigint UNSIGNED NOT NULL,
                                        `chemical_id` bigint UNSIGNED NOT NULL,
                                        `safety_item_id` bigint UNSIGNED NOT NULL,
                                        `created_at` timestamp NULL DEFAULT NULL,
                                        `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chemical_safety_item`
--

INSERT INTO `chemical_safety_item` (`id`, `chemical_id`, `safety_item_id`, `created_at`, `updated_at`) VALUES
                                                                                                           (1, 1, 1, NULL, NULL),
                                                                                                           (2, 1, 2, NULL, NULL),
                                                                                                           (3, 1, 5, NULL, NULL),
                                                                                                           (4, 2, 1, NULL, NULL),
                                                                                                           (5, 2, 2, NULL, NULL),
                                                                                                           (6, 2, 3, NULL, NULL),
                                                                                                           (7, 2, 5, NULL, NULL),
                                                                                                           (8, 3, 1, NULL, NULL),
                                                                                                           (9, 3, 2, NULL, NULL),
                                                                                                           (10, 3, 3, NULL, NULL),
                                                                                                           (11, 3, 5, NULL, NULL),
                                                                                                           (12, 4, 2, NULL, NULL),
                                                                                                           (13, 5, 1, NULL, NULL),
                                                                                                           (14, 5, 2, NULL, NULL),
                                                                                                           (15, 6, 5, NULL, NULL),
                                                                                                           (16, 6, 2, NULL, NULL),
                                                                                                           (17, 6, 2, NULL, NULL),
                                                                                                           (18, 7, 5, NULL, NULL),
                                                                                                           (19, 7, 2, NULL, NULL),
                                                                                                           (20, 7, 2, NULL, NULL),
                                                                                                           (21, 12, 2, NULL, NULL),
                                                                                                           (22, 13, 2, NULL, NULL),
                                                                                                           (23, 14, 1, NULL, NULL),
                                                                                                           (24, 14, 2, NULL, NULL),
                                                                                                           (25, 14, 5, NULL, NULL),
                                                                                                           (26, 14, 3, NULL, NULL),
                                                                                                           (27, 15, 2, NULL, NULL),
                                                                                                           (28, 15, 1, NULL, NULL),
                                                                                                           (29, 16, 2, NULL, NULL),
                                                                                                           (30, 16, 1, NULL, NULL),
                                                                                                           (31, 16, 5, NULL, NULL),
                                                                                                           (32, 18, 2, NULL, NULL),
                                                                                                           (33, 18, 1, NULL, NULL),
                                                                                                           (34, 18, 5, NULL, NULL),
                                                                                                           (35, 18, 3, NULL, NULL),
                                                                                                           (36, 19, 2, NULL, NULL),
                                                                                                           (37, 19, 1, NULL, NULL),
                                                                                                           (38, 19, 5, NULL, NULL),
                                                                                                           (39, 19, 3, NULL, NULL),
                                                                                                           (40, 20, 2, NULL, NULL),
                                                                                                           (41, 20, 1, NULL, NULL),
                                                                                                           (42, 20, 5, NULL, NULL),
                                                                                                           (43, 20, 3, NULL, NULL),
                                                                                                           (44, 21, 2, NULL, NULL),
                                                                                                           (45, 21, 1, NULL, NULL),
                                                                                                           (46, 21, 5, NULL, NULL),
                                                                                                           (47, 21, 3, NULL, NULL),
                                                                                                           (48, 22, 2, NULL, NULL),
                                                                                                           (49, 22, 1, NULL, NULL),
                                                                                                           (50, 22, 5, NULL, NULL),
                                                                                                           (51, 22, 3, NULL, NULL),
                                                                                                           (52, 24, 2, NULL, NULL),
                                                                                                           (53, 24, 1, NULL, NULL),
                                                                                                           (54, 25, 2, NULL, NULL),
                                                                                                           (55, 25, 1, NULL, NULL),
                                                                                                           (56, 25, 5, NULL, NULL),
                                                                                                           (57, 26, 2, NULL, NULL),
                                                                                                           (58, 26, 1, NULL, NULL),
                                                                                                           (59, 26, 4, NULL, NULL),
                                                                                                           (60, 27, 2, NULL, NULL),
                                                                                                           (61, 27, 1, NULL, NULL),
                                                                                                           (62, 27, 4, NULL, NULL),
                                                                                                           (63, 29, 2, NULL, NULL),
                                                                                                           (64, 29, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dangerous_properties`
--

CREATE TABLE `dangerous_properties` (
                                        `id` bigint UNSIGNED NOT NULL,
                                        `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                        `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                        `name_sk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                        `description_en` text COLLATE utf8mb4_unicode_ci,
                                        `description_sk` text COLLATE utf8mb4_unicode_ci,
                                        `created_at` timestamp NULL DEFAULT NULL,
                                        `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dangerous_properties`
--

INSERT INTO `dangerous_properties` (`id`, `code`, `name_en`, `name_sk`, `description_en`, `description_sk`, `created_at`, `updated_at`) VALUES
                                                                                                                                            (1, 'F', 'Highly flammable', 'Ľahko horľavá', 'Easily ignite and catch fire in the presence of heat, sparks, or flames. They pose significant fire hazards', 'Tieto látky môžu ľahko vzplanúť pri kontakte s ohňom alebo zdrojmi tepla', '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                            (2, 'C', 'Corrosive', 'Korozívna', 'Can cause severe damage to living tissue (such as skin and eyes) and materials (like metals). These chemicals can lead to burns or permanent tissue damage', 'Látky označené touto skratkou spôsobujú vážne poškodenie kože a/alebo očí. Môžu tiež poškodiť kovové materiály', '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                            (3, 'N', 'Dangerous for the environment', 'Nebezpečná pre životné prostredie', 'Hazardous to aquatic life and ecosystems. It can cause long-lasting effects to the environment, particularly in water bodies, and may accumulate in aquatic organisms', 'Tieto látky predstavujú nebezpečenstvo pre vodné organizmy a životné prostredie. Môžu spôsobiť dlhodobé poškodenie vodného prostredia', '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                            (4, 'O', 'Oxidizing', 'Oxidant', 'Can cause or enhance the combustion of other materials by releasing oxygen, making them more reactive and potentially increasing fire hazards', 'Látky označené touto skratkou sú oxidačné, čo znamená, že môžu podporovať horenie iných materiálov tým, že uvoľňujú kyslík', '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                            (5, 'Xi', 'Irritant', 'Dráždivá', 'Can cause reversible damage to eyes, skin, or respiratory tract. Prolonged or repeated exposure can cause skin dryness, irritation, or inflammation', 'Látky, ktoré môžu spôsobiť dráždenie pokožky, očí alebo dýchacích ciest, ale nezpôsobujú trvalé poškodenie', '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                            (6, 'Xn', 'Harmful', 'Škodlivá', 'Harmful to health when inhaled, ingested, or absorbed through the skin. These substances may cause health effects such as irritation, organ damage, or long-term harm, but they are not classified as highly toxic', 'Škodlivá látka (harmful), tieto látky môžu spôsobiť škody na zdraví pri ich vdýchnutí, požití alebo kontakte s pokožkou, ale nie sú také nebezpečné, aby spadali pod kategóriu toxických látok', '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                                                                            (7, 'T', 'Toxic', 'Toxická', 'Toxic and can cause severe health effects, even in small amounts. They may cause organ damage, or even death, if ingested, inhaled, or absorbed through the skin', 'Látky označené touto skratkou môžu byť nebezpečné pri vdýchnutí, požití alebo kontakte so pokožkou. Môžu spôsobovať vážne alebo smrteľné poškodenie zdravia', '2025-03-31 22:03:32', '2025-03-31 22:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `experiments`
--

CREATE TABLE `experiments` (
                               `id` bigint UNSIGNED NOT NULL,
                               `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `name_sk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `description_en` text COLLATE utf8mb4_unicode_ci,
                               `description_sk` text COLLATE utf8mb4_unicode_ci,
                               `created_at` timestamp NULL DEFAULT NULL,
                               `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
                               `id` bigint UNSIGNED NOT NULL,
                               `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
                        `id` bigint UNSIGNED NOT NULL,
                        `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                        `attempts` tinyint UNSIGNED NOT NULL,
                        `reserved_at` int UNSIGNED DEFAULT NULL,
                        `available_at` int UNSIGNED NOT NULL,
                        `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
                               `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `total_jobs` int NOT NULL,
                               `pending_jobs` int NOT NULL,
                               `failed_jobs` int NOT NULL,
                               `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `options` mediumtext COLLATE utf8mb4_unicode_ci,
                               `cancelled_at` int DEFAULT NULL,
                               `created_at` int NOT NULL,
                               `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `measure_units`
--

CREATE TABLE `measure_units` (
                                 `id` bigint UNSIGNED NOT NULL,
                                 `isoName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `measure_units`
--

INSERT INTO `measure_units` (`id`, `isoName`, `name`, `created_at`, `updated_at`) VALUES
                                                                                      (1, 'g', 'gram', '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                      (2, 'ml', 'milliliter', '2025-03-31 22:03:32', '2025-03-31 22:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
                              `id` int UNSIGNED NOT NULL,
                              `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
                                                          (1, '0001_01_01_000000_create_users_table', 1),
                                                          (2, '0001_01_01_000001_create_cache_table', 1),
                                                          (3, '0001_01_01_000002_create_jobs_table', 1),
                                                          (4, '2025_02_02_163841_create_supplies_table', 1),
                                                          (5, '2025_02_02_163842_create_measure_units_table', 1),
                                                          (6, '2025_02_03_201811_create_safety_items_table', 1),
                                                          (7, '2025_02_03_201812_create_dangerous_properties_table', 1),
                                                          (8, '2025_02_03_203843_create_chemicals_table', 1),
                                                          (9, '2025_02_03_203955_create_chemical_dangerous_property_table', 1),
                                                          (10, '2025_02_03_203955_create_chemical_safety_item_table', 1),
                                                          (11, '2025_02_05_195109_create_experiments_table', 1),
                                                          (12, '2025_02_08_133354_create_chemical_experiment_table', 1),
                                                          (13, '2025_02_10_201812_create_status_table', 1),
                                                          (14, '2025_02_11_133354_create_request_table', 1),
                                                          (15, '2025_02_11_133355_create_request_chemical_table', 1),
                                                          (16, '2025_02_23_161703_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
                                         `permission_id` bigint UNSIGNED NOT NULL,
                                         `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                         `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
                                   `role_id` bigint UNSIGNED NOT NULL,
                                   `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
                               `id` bigint UNSIGNED NOT NULL,
                               `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `created_at` timestamp NULL DEFAULT NULL,
                               `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
                                                                                       (1, 'manage_chemicals', 'web', '2025-03-31 22:03:31', '2025-03-31 22:03:31'),
                                                                                       (2, 'manage_experiments', 'web', '2025-03-31 22:03:31', '2025-03-31 22:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `request_chemical`
--

CREATE TABLE `request_chemical` (
                                    `id` bigint UNSIGNED NOT NULL,
                                    `chemical_id` bigint UNSIGNED NOT NULL,
                                    `student_request_id` bigint UNSIGNED NOT NULL,
                                    `quantity` decimal(8,2) NOT NULL,
                                    `measure_unit_id` bigint UNSIGNED NOT NULL,
                                    `created_at` timestamp NULL DEFAULT NULL,
                                    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
                         `id` bigint UNSIGNED NOT NULL,
                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
                                                                                 (1, 'admin', 'web', '2025-03-31 22:03:31', '2025-03-31 22:03:31'),
                                                                                 (2, 'student', 'web', '2025-03-31 22:03:31', '2025-03-31 22:03:31'),
                                                                                 (3, 'teacher', 'web', '2025-03-31 22:03:32', '2025-03-31 22:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
                                        `permission_id` bigint UNSIGNED NOT NULL,
                                        `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
                                                                    (1, 1),
                                                                    (2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `safety_items`
--

CREATE TABLE `safety_items` (
                                `id` bigint UNSIGNED NOT NULL,
                                `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                `name_sk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                `created_at` timestamp NULL DEFAULT NULL,
                                `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `safety_items`
--

INSERT INTO `safety_items` (`id`, `name_en`, `name_sk`, `created_at`, `updated_at`) VALUES
                                                                                        (1, 'Apron', 'Plášť', '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                        (2, 'Gloves', 'Rukavice', '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                        (3, 'Goggles', 'Okuliare', '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                        (4, 'Respirator', 'Respirátor', '2025-03-31 22:03:32', '2025-03-31 22:03:32'),
                                                                                        (5, 'Fume hood', 'Laboratórny digestor', '2025-03-31 22:03:32', '2025-03-31 22:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
                            `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `user_agent` text COLLATE utf8mb4_unicode_ci,
                            `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                            `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
                          `id` bigint UNSIGNED NOT NULL,
                          `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `name_sk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `created_at` timestamp NULL DEFAULT NULL,
                          `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name_en`, `name_sk`, `created_at`, `updated_at`) VALUES
                                                                                  (1, 'Initial', 'Zadaná', NULL, NULL),
                                                                                  (2, 'Cancelled', 'Zrušená', NULL, NULL),
                                                                                  (3, 'Approved', 'Potvrdená', NULL, NULL),
                                                                                  (4, 'Processed', 'Vydaná', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_requests`
--

CREATE TABLE `student_requests` (
                                    `id` bigint UNSIGNED NOT NULL,
                                    `experiment_id` bigint UNSIGNED NOT NULL,
                                    `state_id` bigint UNSIGNED NOT NULL,
                                    `requested_by` bigint UNSIGNED NOT NULL,
                                    `resolved_by` bigint UNSIGNED DEFAULT NULL,
                                    `experiment_date` date NOT NULL,
                                    `resolved_date` date DEFAULT NULL,
                                    `note` text COLLATE utf8mb4_unicode_ci,
                                    `teacher_note` text COLLATE utf8mb4_unicode_ci,
                                    `created_at` timestamp NULL DEFAULT NULL,
                                    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
                            `id` bigint UNSIGNED NOT NULL,
                            `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `name_sk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `description_en` text COLLATE utf8mb4_unicode_ci,
                            `description_sk` text COLLATE utf8mb4_unicode_ci,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`id`, `name_en`, `name_sk`, `description_en`, `description_sk`, `created_at`, `updated_at`) VALUES
                                                                                                                        (1, 'High', 'Dostatočné', NULL, NULL, NULL, NULL),
                                                                                                                        (2, 'Low', 'Nízke', NULL, NULL, NULL, NULL),
                                                                                                                        (3, 'Empty', 'Prázdne', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `id` bigint UNSIGNED NOT NULL,
                         `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `is_admin` tinyint(1) NOT NULL DEFAULT '0',
                         `is_teacher` tinyint(1) NOT NULL DEFAULT '0',
                         `is_student` tinyint(1) NOT NULL DEFAULT '0',
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `is_admin`, `is_teacher`, `is_student`, `created_at`, `updated_at`) VALUES
    (1, 'teacher', 'teacher@gjh.sk', 1, 1, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
    ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
    ADD PRIMARY KEY (`key`);

--
-- Indexes for table `chemicals`
--
ALTER TABLE `chemicals`
    ADD PRIMARY KEY (`id`),
  ADD KEY `chemicals_supplies_id_foreign` (`supplies_id`),
  ADD KEY `chemicals_measure_unit_id_foreign` (`measure_unit_id`);

--
-- Indexes for table `chemical_dangerous_property`
--
ALTER TABLE `chemical_dangerous_property`
    ADD PRIMARY KEY (`id`),
  ADD KEY `chemical_dangerous_property_chemical_id_foreign` (`chemical_id`),
  ADD KEY `chemical_dangerous_property_dangerous_property_id_foreign` (`dangerous_property_id`);

--
-- Indexes for table `chemical_experiment`
--
ALTER TABLE `chemical_experiment`
    ADD PRIMARY KEY (`id`),
  ADD KEY `chemical_experiment_chemical_id_foreign` (`chemical_id`),
  ADD KEY `chemical_experiment_experiment_id_foreign` (`experiment_id`);

--
-- Indexes for table `chemical_safety_item`
--
ALTER TABLE `chemical_safety_item`
    ADD PRIMARY KEY (`id`),
  ADD KEY `chemical_safety_item_chemical_id_foreign` (`chemical_id`),
  ADD KEY `chemical_safety_item_safety_item_id_foreign` (`safety_item_id`);

--
-- Indexes for table `dangerous_properties`
--
ALTER TABLE `dangerous_properties`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiments`
--
ALTER TABLE `experiments`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
    ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `measure_units`
--
ALTER TABLE `measure_units`
    ADD PRIMARY KEY (`id`);

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `request_chemical`
--
ALTER TABLE `request_chemical`
    ADD PRIMARY KEY (`id`),
  ADD KEY `request_chemical_chemical_id_foreign` (`chemical_id`),
  ADD KEY `request_chemical_student_request_id_foreign` (`student_request_id`),
  ADD KEY `request_chemical_measure_unit_id_foreign` (`measure_unit_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
    ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `safety_items`
--
ALTER TABLE `safety_items`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
    ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_requests`
--
ALTER TABLE `student_requests`
    ADD PRIMARY KEY (`id`),
  ADD KEY `student_requests_experiment_id_foreign` (`experiment_id`),
  ADD KEY `student_requests_state_id_foreign` (`state_id`),
  ADD KEY `student_requests_requested_by_foreign` (`requested_by`),
  ADD KEY `student_requests_resolved_by_foreign` (`resolved_by`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chemicals`
--
ALTER TABLE `chemicals`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `chemical_dangerous_property`
--
ALTER TABLE `chemical_dangerous_property`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `chemical_experiment`
--
ALTER TABLE `chemical_experiment`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chemical_safety_item`
--
ALTER TABLE `chemical_safety_item`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `dangerous_properties`
--
ALTER TABLE `dangerous_properties`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `experiments`
--
ALTER TABLE `experiments`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `measure_units`
--
ALTER TABLE `measure_units`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
    MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request_chemical`
--
ALTER TABLE `request_chemical`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `safety_items`
--
ALTER TABLE `safety_items`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_requests`
--
ALTER TABLE `student_requests`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chemicals`
--
ALTER TABLE `chemicals`
    ADD CONSTRAINT `chemicals_measure_unit_id_foreign` FOREIGN KEY (`measure_unit_id`) REFERENCES `measure_units` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `chemicals_supplies_id_foreign` FOREIGN KEY (`supplies_id`) REFERENCES `supplies` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `chemical_dangerous_property`
--
ALTER TABLE `chemical_dangerous_property`
    ADD CONSTRAINT `chemical_dangerous_property_chemical_id_foreign` FOREIGN KEY (`chemical_id`) REFERENCES `chemicals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chemical_dangerous_property_dangerous_property_id_foreign` FOREIGN KEY (`dangerous_property_id`) REFERENCES `dangerous_properties` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `chemical_experiment`
--
ALTER TABLE `chemical_experiment`
    ADD CONSTRAINT `chemical_experiment_chemical_id_foreign` FOREIGN KEY (`chemical_id`) REFERENCES `chemicals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chemical_experiment_experiment_id_foreign` FOREIGN KEY (`experiment_id`) REFERENCES `experiments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chemical_safety_item`
--
ALTER TABLE `chemical_safety_item`
    ADD CONSTRAINT `chemical_safety_item_chemical_id_foreign` FOREIGN KEY (`chemical_id`) REFERENCES `chemicals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chemical_safety_item_safety_item_id_foreign` FOREIGN KEY (`safety_item_id`) REFERENCES `safety_items` (`id`) ON DELETE RESTRICT;

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
-- Constraints for table `request_chemical`
--
ALTER TABLE `request_chemical`
    ADD CONSTRAINT `request_chemical_chemical_id_foreign` FOREIGN KEY (`chemical_id`) REFERENCES `chemicals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `request_chemical_measure_unit_id_foreign` FOREIGN KEY (`measure_unit_id`) REFERENCES `measure_units` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `request_chemical_student_request_id_foreign` FOREIGN KEY (`student_request_id`) REFERENCES `student_requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
    ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_requests`
--
ALTER TABLE `student_requests`
    ADD CONSTRAINT `student_requests_experiment_id_foreign` FOREIGN KEY (`experiment_id`) REFERENCES `experiments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_requests_requested_by_foreign` FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `student_requests_resolved_by_foreign` FOREIGN KEY (`resolved_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `student_requests_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
