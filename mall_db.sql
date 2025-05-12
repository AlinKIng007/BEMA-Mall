/*
 Navicat Premium Dump SQL

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : mall_db

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 12/05/2025 11:05:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `product_id` int NULL DEFAULT NULL,
  `amount` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cart_product_id_foreign`(`product_id` ASC) USING BTREE,
  INDEX `cart_user_id_foreign`(`user_id` ASC) USING BTREE,
  CONSTRAINT `cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 168 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cart
-- ----------------------------
INSERT INTO `cart` VALUES (167, 3, 2, 1);

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `category_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `categories_category_id_foreign`(`category_id` ASC) USING BTREE,
  CONSTRAINT `categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'clothing', '', NULL);
INSERT INTO `categories` VALUES (2, 'tshirt', NULL, 1);
INSERT INTO `categories` VALUES (3, 'canned food', NULL, NULL);
INSERT INTO `categories` VALUES (4, 'pineapple', NULL, 3);
INSERT INTO `categories` VALUES (5, 'shirt', NULL, 1);
INSERT INTO `categories` VALUES (6, 'short', NULL, 1);
INSERT INTO `categories` VALUES (7, 'long shirt', NULL, 1);
INSERT INTO `categories` VALUES (8, 'suit', NULL, 1);
INSERT INTO `categories` VALUES (9, 'tomato', NULL, 3);
INSERT INTO `categories` VALUES (10, 'tuna', NULL, 3);
INSERT INTO `categories` VALUES (11, 'corn', NULL, 3);
INSERT INTO `categories` VALUES (12, 'frozen food', NULL, NULL);
INSERT INTO `categories` VALUES (13, 'frozen meat', NULL, 13);
INSERT INTO `categories` VALUES (14, 'frozen chiecken', NULL, 13);
INSERT INTO `categories` VALUES (15, 'electronics', NULL, NULL);
INSERT INTO `categories` VALUES (16, 'washing_machine', NULL, 15);
INSERT INTO `categories` VALUES (17, 'tv', NULL, 15);
INSERT INTO `categories` VALUES (18, 'mouse', NULL, 15);
INSERT INTO `categories` VALUES (19, 'hand watch', NULL, 15);
INSERT INTO `categories` VALUES (20, 'smart phone', NULL, 15);
INSERT INTO `categories` VALUES (21, 'mixer', NULL, 15);
INSERT INTO `categories` VALUES (22, 'laptop', NULL, 15);
INSERT INTO `categories` VALUES (23, 'fridge', NULL, 15);
INSERT INTO `categories` VALUES (24, 'camera', NULL, 15);

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `abv` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'ISO 3166-1 alpha-2',
  `abv3` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'ISO 3166-1 alpha-3',
  `abv3_alt` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'ISO 3166-1 numeric',
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 239 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES (1, 'Afghanistan', 'AF', 'AFG', NULL, '4', 'afghanistan');
INSERT INTO `countries` VALUES (2, 'Aland Islands', 'AX', 'ALA', NULL, '248', 'aland-islands');
INSERT INTO `countries` VALUES (3, 'Albania', 'AL', 'ALB', NULL, '8', 'albania');
INSERT INTO `countries` VALUES (4, 'Algeria', 'DZ', 'DZA', NULL, '12', 'algeria');
INSERT INTO `countries` VALUES (5, 'American Samoa', 'AS', 'ASM', NULL, '16', 'american-samoa');
INSERT INTO `countries` VALUES (6, 'Andorra', 'AD', 'AND', NULL, '20', 'andorra');
INSERT INTO `countries` VALUES (7, 'Angola', 'AO', 'AGO', NULL, '24', 'angola');
INSERT INTO `countries` VALUES (8, 'Anguilla', 'AI', 'AIA', NULL, '660', 'anguilla');
INSERT INTO `countries` VALUES (9, 'Antigua and Barbuda', 'AG', 'ATG', NULL, '28', 'antigua-and-barbuda');
INSERT INTO `countries` VALUES (10, 'Argentina', 'AR', 'ARG', NULL, '32', 'argentina');
INSERT INTO `countries` VALUES (11, 'Armenia', 'AM', 'ARM', NULL, '51', 'armenia');
INSERT INTO `countries` VALUES (12, 'Aruba', 'AW', 'ABW', NULL, '533', 'aruba');
INSERT INTO `countries` VALUES (13, 'Australia', 'AU', 'AUS', NULL, '36', 'australia');
INSERT INTO `countries` VALUES (14, 'Austria', 'AT', 'AUT', NULL, '40', 'austria');
INSERT INTO `countries` VALUES (15, 'Azerbaijan', 'AZ', 'AZE', NULL, '31', 'azerbaijan');
INSERT INTO `countries` VALUES (16, 'Bahamas', 'BS', 'BHS', NULL, '44', 'bahamas');
INSERT INTO `countries` VALUES (17, 'Bahrain', 'BH', 'BHR', NULL, '48', 'bahrain');
INSERT INTO `countries` VALUES (18, 'Bangladesh', 'BD', 'BGD', NULL, '50', 'bangladesh');
INSERT INTO `countries` VALUES (19, 'Barbados', 'BB', 'BRB', NULL, '52', 'barbados');
INSERT INTO `countries` VALUES (20, 'Belarus', 'BY', 'BLR', NULL, '112', 'belarus');
INSERT INTO `countries` VALUES (21, 'Belgium', 'BE', 'BEL', NULL, '56', 'belgium');
INSERT INTO `countries` VALUES (22, 'Belize', 'BZ', 'BLZ', NULL, '84', 'belize');
INSERT INTO `countries` VALUES (23, 'Benin', 'BJ', 'BEN', NULL, '204', 'benin');
INSERT INTO `countries` VALUES (24, 'Bermuda', 'BM', 'BMU', NULL, '60', 'bermuda');
INSERT INTO `countries` VALUES (25, 'Bhutan', 'BT', 'BTN', NULL, '64', 'bhutan');
INSERT INTO `countries` VALUES (26, 'Bolivia', 'BO', 'BOL', NULL, '68', 'bolivia');
INSERT INTO `countries` VALUES (27, 'Bosnia and Herzegovina', 'BA', 'BIH', NULL, '70', 'bosnia-and-herzegovina');
INSERT INTO `countries` VALUES (28, 'Botswana', 'BW', 'BWA', NULL, '72', 'botswana');
INSERT INTO `countries` VALUES (29, 'Brazil', 'BR', 'BRA', NULL, '76', 'brazil');
INSERT INTO `countries` VALUES (30, 'British Virgin Islands', 'VG', 'VGB', NULL, '92', 'british-virgin-islands');
INSERT INTO `countries` VALUES (31, 'Brunei Darussalam', 'BN', 'BRN', NULL, '96', 'brunei-darussalam');
INSERT INTO `countries` VALUES (32, 'Bulgaria', 'BG', 'BGR', NULL, '100', 'bulgaria');
INSERT INTO `countries` VALUES (33, 'Burkina Faso', 'BF', 'BFA', NULL, '854', 'burkina-faso');
INSERT INTO `countries` VALUES (34, 'Burundi', 'BI', 'BDI', NULL, '108', 'burundi');
INSERT INTO `countries` VALUES (35, 'Cambodia', 'KH', 'KHM', NULL, '116', 'cambodia');
INSERT INTO `countries` VALUES (36, 'Cameroon', 'CM', 'CMR', NULL, '120', 'cameroon');
INSERT INTO `countries` VALUES (37, 'Canada', 'CA', 'CAN', NULL, '124', 'canada');
INSERT INTO `countries` VALUES (38, 'Cape Verde', 'CV', 'CPV', NULL, '132', 'cape-verde');
INSERT INTO `countries` VALUES (39, 'Cayman Islands', 'KY', 'CYM', NULL, '136', 'cayman-islands');
INSERT INTO `countries` VALUES (40, 'Central African Republic', 'CF', 'CAF', NULL, '140', 'central-african-republic');
INSERT INTO `countries` VALUES (41, 'Chad', 'TD', 'TCD', NULL, '148', 'chad');
INSERT INTO `countries` VALUES (42, 'Chile', 'CL', 'CHL', 'CHI', '152', 'chile');
INSERT INTO `countries` VALUES (43, 'China', 'CN', 'CHN', NULL, '156', 'china');
INSERT INTO `countries` VALUES (44, 'Colombia', 'CO', 'COL', NULL, '170', 'colombia');
INSERT INTO `countries` VALUES (45, 'Comoros', 'KM', 'COM', NULL, '174', 'comoros');
INSERT INTO `countries` VALUES (46, 'Congo', 'CG', 'COG', NULL, '178', 'congo');
INSERT INTO `countries` VALUES (47, 'Cook Islands', 'CK', 'COK', NULL, '184', 'cook-islands');
INSERT INTO `countries` VALUES (48, 'Costa Rica', 'CR', 'CRI', NULL, '188', 'costa-rica');
INSERT INTO `countries` VALUES (49, 'Cote d\'Ivoire', 'CI', 'CIV', NULL, '384', 'cote-divoire');
INSERT INTO `countries` VALUES (50, 'Croatia', 'HR', 'HRV', NULL, '191', 'croatia');
INSERT INTO `countries` VALUES (51, 'Cuba', 'CU', 'CUB', NULL, '192', 'cuba');
INSERT INTO `countries` VALUES (52, 'Cyprus', 'CY', 'CYP', NULL, '196', 'cyprus');
INSERT INTO `countries` VALUES (53, 'Czech Republic', 'CZ', 'CZE', NULL, '203', 'czech-republic');
INSERT INTO `countries` VALUES (54, 'Democratic Republic of the Congo', 'CD', 'COD', NULL, '180', 'democratic-republic-of-congo');
INSERT INTO `countries` VALUES (55, 'Denmark', 'DK', 'DNK', NULL, '208', 'denmark');
INSERT INTO `countries` VALUES (56, 'Djibouti', 'DJ', 'DJI', NULL, '262', 'djibouti');
INSERT INTO `countries` VALUES (57, 'Dominica', 'DM', 'DMA', NULL, '212', 'dominica');
INSERT INTO `countries` VALUES (58, 'Dominican Republic', 'DO', 'DOM', NULL, '214', 'dominican-republic');
INSERT INTO `countries` VALUES (59, 'Ecuador', 'EC', 'ECU', NULL, '218', 'ecuador');
INSERT INTO `countries` VALUES (60, 'Egypt', 'EG', 'EGY', NULL, '818', 'egypt');
INSERT INTO `countries` VALUES (61, 'El Salvador', 'SV', 'SLV', NULL, '222', 'el-salvador');
INSERT INTO `countries` VALUES (62, 'Equatorial Guinea', 'GQ', 'GNQ', NULL, '226', 'equatorial-guinea');
INSERT INTO `countries` VALUES (63, 'Eritrea', 'ER', 'ERI', NULL, '232', 'eritrea');
INSERT INTO `countries` VALUES (64, 'Estonia', 'EE', 'EST', NULL, '233', 'estonia');
INSERT INTO `countries` VALUES (65, 'Ethiopia', 'ET', 'ETH', NULL, '231', 'ethiopia');
INSERT INTO `countries` VALUES (66, 'Faeroe Islands', 'FO', 'FRO', NULL, '234', 'faeroe-islands');
INSERT INTO `countries` VALUES (67, 'Falkland Islands', 'FK', 'FLK', NULL, '238', 'falkland-islands');
INSERT INTO `countries` VALUES (68, 'Fiji', 'FJ', 'FJI', NULL, '242', 'fiji');
INSERT INTO `countries` VALUES (69, 'Finland', 'FI', 'FIN', NULL, '246', 'finland');
INSERT INTO `countries` VALUES (70, 'France', 'FR', 'FRA', NULL, '250', 'france');
INSERT INTO `countries` VALUES (71, 'French Guiana', 'GF', 'GUF', NULL, '254', 'french-guiana');
INSERT INTO `countries` VALUES (72, 'French Polynesia', 'PF', 'PYF', NULL, '258', 'french-polynesia');
INSERT INTO `countries` VALUES (73, 'Gabon', 'GA', 'GAB', NULL, '266', 'gabon');
INSERT INTO `countries` VALUES (74, 'Gambia', 'GM', 'GMB', NULL, '270', 'gambia');
INSERT INTO `countries` VALUES (75, 'Georgia', 'GE', 'GEO', NULL, '268', 'georgia');
INSERT INTO `countries` VALUES (76, 'Germany', 'DE', 'DEU', NULL, '276', 'germany');
INSERT INTO `countries` VALUES (77, 'Ghana', 'GH', 'GHA', NULL, '288', 'ghana');
INSERT INTO `countries` VALUES (78, 'Gibraltar', 'GI', 'GIB', NULL, '292', 'gibraltar');
INSERT INTO `countries` VALUES (79, 'Greece', 'GR', 'GRC', NULL, '300', 'greece');
INSERT INTO `countries` VALUES (80, 'Greenland', 'GL', 'GRL', NULL, '304', 'greenland');
INSERT INTO `countries` VALUES (81, 'Grenada', 'GD', 'GRD', NULL, '308', 'grenada');
INSERT INTO `countries` VALUES (82, 'Guadeloupe', 'GP', 'GLP', NULL, '312', 'guadeloupe');
INSERT INTO `countries` VALUES (83, 'Guam', 'GU', 'GUM', NULL, '316', 'guam');
INSERT INTO `countries` VALUES (84, 'Guatemala', 'GT', 'GTM', NULL, '320', 'guatemala');
INSERT INTO `countries` VALUES (85, 'Guernsey', 'GG', 'GGY', NULL, '831', 'guernsey');
INSERT INTO `countries` VALUES (86, 'Guinea', 'GN', 'GIN', NULL, '324', 'guinea');
INSERT INTO `countries` VALUES (87, 'Guinea-Bissau', 'GW', 'GNB', NULL, '624', 'guinea-bissau');
INSERT INTO `countries` VALUES (88, 'Guyana', 'GY', 'GUY', NULL, '328', 'guyana');
INSERT INTO `countries` VALUES (89, 'Haiti', 'HT', 'HTI', NULL, '332', 'haiti');
INSERT INTO `countries` VALUES (90, 'Holy See', 'VA', 'VAT', NULL, '336', 'holy-see');
INSERT INTO `countries` VALUES (91, 'Honduras', 'HN', 'HND', NULL, '340', 'honduras');
INSERT INTO `countries` VALUES (92, 'Hong Kong', 'HK', 'HKG', NULL, '344', 'hong-kong');
INSERT INTO `countries` VALUES (93, 'Hungary', 'HU', 'HUN', NULL, '348', 'hungary');
INSERT INTO `countries` VALUES (94, 'Iceland', 'IS', 'ISL', NULL, '352', 'iceland');
INSERT INTO `countries` VALUES (95, 'India', 'IN', 'IND', NULL, '356', 'india');
INSERT INTO `countries` VALUES (96, 'Indonesia', 'ID', 'IDN', NULL, '360', 'indonesia');
INSERT INTO `countries` VALUES (97, 'Iran', 'IR', 'IRN', NULL, '364', 'iran');
INSERT INTO `countries` VALUES (98, 'Iraq', 'IQ', 'IRQ', NULL, '368', 'iraq');
INSERT INTO `countries` VALUES (99, 'Ireland', 'IE', 'IRL', NULL, '372', 'ireland');
INSERT INTO `countries` VALUES (100, 'Isle of Man', 'IM', 'IMN', NULL, '833', 'isle-of-man');
INSERT INTO `countries` VALUES (101, 'Israel', 'IL', 'ISR', NULL, '376', 'israel');
INSERT INTO `countries` VALUES (102, 'Italy', 'IT', 'ITA', NULL, '380', 'italy');
INSERT INTO `countries` VALUES (103, 'Jamaica', 'JM', 'JAM', NULL, '388', 'jamaica');
INSERT INTO `countries` VALUES (104, 'Japan', 'JP', 'JPN', NULL, '392', 'japan');
INSERT INTO `countries` VALUES (105, 'Jersey', 'JE', 'JEY', NULL, '832', 'jersey');
INSERT INTO `countries` VALUES (106, 'Jordan', 'JO', 'JOR', NULL, '400', 'jordan');
INSERT INTO `countries` VALUES (107, 'Kazakhstan', 'KZ', 'KAZ', NULL, '398', 'kazakhstan');
INSERT INTO `countries` VALUES (108, 'Kenya', 'KE', 'KEN', NULL, '404', 'kenya');
INSERT INTO `countries` VALUES (109, 'Kiribati', 'KI', 'KIR', NULL, '296', 'kiribati');
INSERT INTO `countries` VALUES (110, 'Kuwait', 'KW', 'KWT', NULL, '414', 'kuwait');
INSERT INTO `countries` VALUES (111, 'Kyrgyzstan', 'KG', 'KGZ', NULL, '417', 'kyrgyzstan');
INSERT INTO `countries` VALUES (112, 'Laos', 'LA', 'LAO', NULL, '418', 'laos');
INSERT INTO `countries` VALUES (113, 'Latvia', 'LV', 'LVA', NULL, '428', 'latvia');
INSERT INTO `countries` VALUES (114, 'Lebanon', 'LB', 'LBN', NULL, '422', 'lebanon');
INSERT INTO `countries` VALUES (115, 'Lesotho', 'LS', 'LSO', NULL, '426', 'lesotho');
INSERT INTO `countries` VALUES (116, 'Liberia', 'LR', 'LBR', NULL, '430', 'liberia');
INSERT INTO `countries` VALUES (117, 'Libyan Arab Jamahiriya', 'LY', 'LBY', NULL, '434', 'libyan-arab-jamahiriya');
INSERT INTO `countries` VALUES (118, 'Liechtenstein', 'LI', 'LIE', NULL, '438', 'liechtenstein');
INSERT INTO `countries` VALUES (119, 'Lithuania', 'LT', 'LTU', NULL, '440', 'lithuania');
INSERT INTO `countries` VALUES (120, 'Luxembourg', 'LU', 'LUX', NULL, '442', 'luxembourg');
INSERT INTO `countries` VALUES (121, 'Macao', 'MO', 'MAC', NULL, '446', 'macao');
INSERT INTO `countries` VALUES (122, 'Macedonia', 'MK', 'MKD', NULL, '807', 'macedonia');
INSERT INTO `countries` VALUES (123, 'Madagascar', 'MG', 'MDG', NULL, '450', 'madagascar');
INSERT INTO `countries` VALUES (124, 'Malawi', 'MW', 'MWI', NULL, '454', 'malawi');
INSERT INTO `countries` VALUES (125, 'Malaysia', 'MY', 'MYS', NULL, '458', 'malaysia');
INSERT INTO `countries` VALUES (126, 'Maldives', 'MV', 'MDV', NULL, '462', 'maldives');
INSERT INTO `countries` VALUES (127, 'Mali', 'ML', 'MLI', NULL, '466', 'mali');
INSERT INTO `countries` VALUES (128, 'Malta', 'MT', 'MLT', NULL, '470', 'malta');
INSERT INTO `countries` VALUES (129, 'Marshall Islands', 'MH', 'MHL', NULL, '584', 'marshall-islands');
INSERT INTO `countries` VALUES (130, 'Martinique', 'MQ', 'MTQ', NULL, '474', 'martinique');
INSERT INTO `countries` VALUES (131, 'Mauritania', 'MR', 'MRT', NULL, '478', 'mauritania');
INSERT INTO `countries` VALUES (132, 'Mauritius', 'MU', 'MUS', NULL, '480', 'mauritius');
INSERT INTO `countries` VALUES (133, 'Mayotte', 'YT', 'MYT', NULL, '175', 'mayotte');
INSERT INTO `countries` VALUES (134, 'Mexico', 'MX', 'MEX', NULL, '484', 'mexico');
INSERT INTO `countries` VALUES (135, 'Micronesia', 'FM', 'FSM', NULL, '583', 'micronesia');
INSERT INTO `countries` VALUES (136, 'Moldova', 'MD', 'MDA', NULL, '498', 'moldova');
INSERT INTO `countries` VALUES (137, 'Monaco', 'MC', 'MCO', NULL, '492', 'monaco');
INSERT INTO `countries` VALUES (138, 'Mongolia', 'MN', 'MNG', NULL, '496', 'mongolia');
INSERT INTO `countries` VALUES (139, 'Montenegro', 'ME', 'MNE', NULL, '499', 'montenegro');
INSERT INTO `countries` VALUES (140, 'Montserrat', 'MS', 'MSR', NULL, '500', 'montserrat');
INSERT INTO `countries` VALUES (141, 'Morocco', 'MA', 'MAR', NULL, '504', 'morocco');
INSERT INTO `countries` VALUES (142, 'Mozambique', 'MZ', 'MOZ', NULL, '508', 'mozambique');
INSERT INTO `countries` VALUES (143, 'Myanmar', 'MM', 'MMR', 'BUR', '104', 'myanmar');
INSERT INTO `countries` VALUES (144, 'Namibia', 'NA', 'NAM', NULL, '516', 'namibia');
INSERT INTO `countries` VALUES (145, 'Nauru', 'NR', 'NRU', NULL, '520', 'nauru');
INSERT INTO `countries` VALUES (146, 'Nepal', 'NP', 'NPL', NULL, '524', 'nepal');
INSERT INTO `countries` VALUES (147, 'Netherlands', 'NL', 'NLD', NULL, '528', 'netherlands');
INSERT INTO `countries` VALUES (148, 'Netherlands Antilles', 'AN', 'ANT', NULL, '530', 'netherlands-antilles');
INSERT INTO `countries` VALUES (149, 'New Caledonia', 'NC', 'NCL', NULL, '540', 'new-caledonia');
INSERT INTO `countries` VALUES (150, 'New Zealand', 'NZ', 'NZL', NULL, '554', 'new-zealand');
INSERT INTO `countries` VALUES (151, 'Nicaragua', 'NI', 'NIC', NULL, '558', 'nicaragua');
INSERT INTO `countries` VALUES (152, 'Niger', 'NE', 'NER', NULL, '562', 'niger');
INSERT INTO `countries` VALUES (153, 'Nigeria', 'NG', 'NGA', NULL, '566', 'nigeria');
INSERT INTO `countries` VALUES (154, 'Niue', 'NU', 'NIU', NULL, '570', 'niue');
INSERT INTO `countries` VALUES (155, 'Norfolk Island', 'NF', 'NFK', NULL, '574', 'norfolk-island');
INSERT INTO `countries` VALUES (156, 'North Korea', 'KP', 'PRK', NULL, '408', 'north-korea');
INSERT INTO `countries` VALUES (157, 'Northern Mariana Islands', 'MP', 'MNP', NULL, '580', 'northern-mariana-islands');
INSERT INTO `countries` VALUES (158, 'Norway', 'NO', 'NOR', NULL, '578', 'norway');
INSERT INTO `countries` VALUES (159, 'Oman', 'OM', 'OMN', NULL, '512', 'oman');
INSERT INTO `countries` VALUES (160, 'Pakistan', 'PK', 'PAK', NULL, '586', 'pakistan');
INSERT INTO `countries` VALUES (161, 'Palau', 'PW', 'PLW', NULL, '585', 'palau');
INSERT INTO `countries` VALUES (162, 'Palestine', 'PS', 'PSE', NULL, '275', 'palestine');
INSERT INTO `countries` VALUES (163, 'Panama', 'PA', 'PAN', NULL, '591', 'panama');
INSERT INTO `countries` VALUES (164, 'Papua New Guinea', 'PG', 'PNG', NULL, '598', 'papua-new-guinea');
INSERT INTO `countries` VALUES (165, 'Paraguay', 'PY', 'PRY', NULL, '600', 'paraguay');
INSERT INTO `countries` VALUES (166, 'Peru', 'PE', 'PER', NULL, '604', 'peru');
INSERT INTO `countries` VALUES (167, 'Philippines', 'PH', 'PHL', NULL, '608', 'philippines');
INSERT INTO `countries` VALUES (168, 'Pitcairn', 'PN', 'PCN', NULL, '612', 'pitcairn');
INSERT INTO `countries` VALUES (169, 'Poland', 'PL', 'POL', NULL, '616', 'poland');
INSERT INTO `countries` VALUES (170, 'Portugal', 'PT', 'PRT', NULL, '620', 'portugal');
INSERT INTO `countries` VALUES (171, 'Puerto Rico', 'PR', 'PRI', NULL, '630', 'puerto-rico');
INSERT INTO `countries` VALUES (172, 'Qatar', 'QA', 'QAT', NULL, '634', 'qatar');
INSERT INTO `countries` VALUES (173, 'Reunion', 'RE', 'REU', NULL, '638', 'reunion');
INSERT INTO `countries` VALUES (174, 'Romania', 'RO', 'ROU', 'ROM', '642', 'romania');
INSERT INTO `countries` VALUES (175, 'Russian Federation', 'RU', 'RUS', NULL, '643', 'russian-federation');
INSERT INTO `countries` VALUES (176, 'Rwanda', 'RW', 'RWA', NULL, '646', 'rwanda');
INSERT INTO `countries` VALUES (177, 'Saint Helena', 'SH', 'SHN', NULL, '654', 'saint-helena');
INSERT INTO `countries` VALUES (178, 'Saint Kitts and Nevis', 'KN', 'KNA', NULL, '659', 'saint-kitts-and-nevis');
INSERT INTO `countries` VALUES (179, 'Saint Lucia', 'LC', 'LCA', NULL, '662', 'saint-lucia');
INSERT INTO `countries` VALUES (180, 'Saint Pierre and Miquelon', 'PM', 'SPM', NULL, '666', 'saint-pierre-and-miquelon');
INSERT INTO `countries` VALUES (181, 'Saint Vincent and the Grenadines', 'VC', 'VCT', NULL, '670', 'saint-vincent-and-grenadines');
INSERT INTO `countries` VALUES (182, 'Saint-Barthelemy', 'BL', 'BLM', NULL, '652', 'saint-barthelemy');
INSERT INTO `countries` VALUES (183, 'Saint-Martin', 'MF', 'MAF', NULL, '663', 'saint-martin');
INSERT INTO `countries` VALUES (184, 'Samoa', 'WS', 'WSM', NULL, '882', 'samoa');
INSERT INTO `countries` VALUES (185, 'San Marino', 'SM', 'SMR', NULL, '674', 'san-marino');
INSERT INTO `countries` VALUES (186, 'Sao Tome and Principe', 'ST', 'STP', NULL, '678', 'sao-tome-and-principe');
INSERT INTO `countries` VALUES (187, 'Saudi Arabia', 'SA', 'SAU', NULL, '682', 'saudi-arabia');
INSERT INTO `countries` VALUES (188, 'Senegal', 'SN', 'SEN', NULL, '686', 'senegal');
INSERT INTO `countries` VALUES (189, 'Serbia', 'RS', 'SRB', NULL, '688', 'serbia');
INSERT INTO `countries` VALUES (190, 'Seychelles', 'SC', 'SYC', NULL, '690', 'seychelles');
INSERT INTO `countries` VALUES (191, 'Sierra Leone', 'SL', 'SLE', NULL, '694', 'sierra-leone');
INSERT INTO `countries` VALUES (192, 'Singapore', 'SG', 'SGP', NULL, '702', 'singapore');
INSERT INTO `countries` VALUES (193, 'Slovakia', 'SK', 'SVK', NULL, '703', 'slovakia');
INSERT INTO `countries` VALUES (194, 'Slovenia', 'SI', 'SVN', NULL, '705', 'slovenia');
INSERT INTO `countries` VALUES (195, 'Solomon Islands', 'SB', 'SLB', NULL, '90', 'solomon-islands');
INSERT INTO `countries` VALUES (196, 'Somalia', 'SO', 'SOM', NULL, '706', 'somalia');
INSERT INTO `countries` VALUES (197, 'South Africa', 'ZA', 'ZAF', NULL, '710', 'south-africa');
INSERT INTO `countries` VALUES (198, 'South Korea', 'KR', 'KOR', NULL, '410', 'south-korea');
INSERT INTO `countries` VALUES (199, 'South Sudan', 'SS', 'SSD', NULL, '728', 'south-sudan');
INSERT INTO `countries` VALUES (200, 'Spain', 'ES', 'ESP', NULL, '724', 'spain');
INSERT INTO `countries` VALUES (201, 'Sri Lanka', 'LK', 'LKA', NULL, '144', 'sri-lanka');
INSERT INTO `countries` VALUES (202, 'Sudan', 'SD', 'SDN', NULL, '729', 'sudan');
INSERT INTO `countries` VALUES (203, 'Suriname', 'SR', 'SUR', NULL, '740', 'suriname');
INSERT INTO `countries` VALUES (204, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', NULL, '744', 'svalbard-and-jan-mayen-islands');
INSERT INTO `countries` VALUES (205, 'Swaziland', 'SZ', 'SWZ', NULL, '748', 'swaziland');
INSERT INTO `countries` VALUES (206, 'Sweden', 'SE', 'SWE', NULL, '752', 'sweden');
INSERT INTO `countries` VALUES (207, 'Switzerland', 'CH', 'CHE', NULL, '756', 'switzerland');
INSERT INTO `countries` VALUES (208, 'Syrian Arab Republic', 'SY', 'SYR', NULL, '760', 'syrian-arab-republic');
INSERT INTO `countries` VALUES (209, 'Tajikistan', 'TJ', 'TJK', NULL, '762', 'tajikistan');
INSERT INTO `countries` VALUES (210, 'Tanzania', 'TZ', 'TZA', NULL, '834', 'tanzania');
INSERT INTO `countries` VALUES (211, 'Thailand', 'TH', 'THA', NULL, '764', 'thailand');
INSERT INTO `countries` VALUES (212, 'Timor-Leste', 'TP', 'TLS', NULL, '626', 'timor-leste');
INSERT INTO `countries` VALUES (213, 'Togo', 'TG', 'TGO', NULL, '768', 'togo');
INSERT INTO `countries` VALUES (214, 'Tokelau', 'TK', 'TKL', NULL, '772', 'tokelau');
INSERT INTO `countries` VALUES (215, 'Tonga', 'TO', 'TON', NULL, '776', 'tonga');
INSERT INTO `countries` VALUES (216, 'Trinidad and Tobago', 'TT', 'TTO', NULL, '780', 'trinidad-and-tobago');
INSERT INTO `countries` VALUES (217, 'Tunisia', 'TN', 'TUN', NULL, '788', 'tunisia');
INSERT INTO `countries` VALUES (218, 'Turkey', 'TR', 'TUR', NULL, '792', 'turkey');
INSERT INTO `countries` VALUES (219, 'Turkmenistan', 'TM', 'TKM', NULL, '795', 'turkmenistan');
INSERT INTO `countries` VALUES (220, 'Turks and Caicos Islands', 'TC', 'TCA', NULL, '796', 'turks-and-caicos-islands');
INSERT INTO `countries` VALUES (221, 'Tuvalu', 'TV', 'TUV', NULL, '798', 'tuvalu');
INSERT INTO `countries` VALUES (222, 'U.S. Virgin Islands', 'VI', 'VIR', NULL, '850', 'us-virgin-islands');
INSERT INTO `countries` VALUES (223, 'Uganda', 'UG', 'UGA', NULL, '800', 'uganda');
INSERT INTO `countries` VALUES (224, 'Ukraine', 'UA', 'UKR', NULL, '804', 'ukraine');
INSERT INTO `countries` VALUES (225, 'United Arab Emirates', 'AE', 'ARE', NULL, '784', 'united-arab-emirates');
INSERT INTO `countries` VALUES (226, 'United Kingdom', 'UK', 'GBR', NULL, '826', 'united-kingdom');
INSERT INTO `countries` VALUES (227, 'United States', 'US', 'USA', NULL, '840', 'united-states');
INSERT INTO `countries` VALUES (228, 'Uruguay', 'UY', 'URY', NULL, '858', 'uruguay');
INSERT INTO `countries` VALUES (229, 'Uzbekistan', 'UZ', 'UZB', NULL, '860', 'uzbekistan');
INSERT INTO `countries` VALUES (230, 'Vanuatu', 'VU', 'VUT', NULL, '548', 'vanuatu');
INSERT INTO `countries` VALUES (231, 'Venezuela', 'VE', 'VEN', NULL, '862', 'venezuela');
INSERT INTO `countries` VALUES (232, 'Viet Nam', 'VN', 'VNM', NULL, '704', 'viet-nam');
INSERT INTO `countries` VALUES (233, 'Wallis and Futuna Islands', 'WF', 'WLF', NULL, '876', 'wallis-and-futuna-islands');
INSERT INTO `countries` VALUES (234, 'Western Sahara', 'EH', 'ESH', NULL, '732', 'western-sahara');
INSERT INTO `countries` VALUES (235, 'Yemen', 'YE', 'YEM', NULL, '887', 'yemen');
INSERT INTO `countries` VALUES (236, 'Zambia', 'ZM', 'ZMB', NULL, '894', 'zambia');
INSERT INTO `countries` VALUES (237, 'Zimbabwe', 'ZW', 'ZWE', NULL, '716', 'zimbabwe');

-- ----------------------------
-- Table structure for coupons
-- ----------------------------
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `discount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_active` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of coupons
-- ----------------------------
INSERT INTO `coupons` VALUES (1, '10', '1234001912348', 1);
INSERT INTO `coupons` VALUES (3, '20', '1234001212349', 1);

-- ----------------------------
-- Table structure for department_employee
-- ----------------------------
DROP TABLE IF EXISTS `department_employee`;
CREATE TABLE `department_employee`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `department_id` int NULL DEFAULT NULL,
  `employee_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `department_id_fk`(`department_id` ASC) USING BTREE,
  INDEX `employes_id_fk`(`employee_id` ASC) USING BTREE,
  CONSTRAINT `department_id_fk` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `employes_id_fk` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of department_employee
-- ----------------------------
INSERT INTO `department_employee` VALUES (1, 1, 1);

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `mall_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `mall_id_fk`(`mall_id` ASC) USING BTREE,
  CONSTRAINT `mall_id_fk` FOREIGN KEY (`mall_id`) REFERENCES `malls` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES (1, 'HR', 1);
INSERT INTO `departments` VALUES (2, 'sale', 2);

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hire_date` date NULL DEFAULT NULL,
  `salary` decimal(20, 2) NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id_fk`(`user_id` ASC) USING BTREE,
  CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES (1, 'male', '2024-03-25', 120.00, 3);
INSERT INTO `employees` VALUES (4, 'female', '2024-03-25', 123.00, 2);
INSERT INTO `employees` VALUES (5, 'male', '2024-05-14', 1000.00, 20);

-- ----------------------------
-- Table structure for event_type
-- ----------------------------
DROP TABLE IF EXISTS `event_type`;
CREATE TABLE `event_type`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of event_type
-- ----------------------------

-- ----------------------------
-- Table structure for events
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `start_time` datetime NULL DEFAULT NULL,
  `mall_id` int NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `end_time` datetime NULL DEFAULT NULL,
  `event_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `events_mall_id_foreign`(`mall_id` ASC) USING BTREE,
  INDEX `events_type_if_fk`(`event_id` ASC) USING BTREE,
  CONSTRAINT `events_mall_id_foreign` FOREIGN KEY (`mall_id`) REFERENCES `malls` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `events_type_if_fk` FOREIGN KEY (`event_id`) REFERENCES `event_type` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of events
-- ----------------------------

-- ----------------------------
-- Table structure for floors
-- ----------------------------
DROP TABLE IF EXISTS `floors`;
CREATE TABLE `floors`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `mall_id` int NULL DEFAULT NULL,
  `test` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `floors_mall_id_foreign`(`mall_id` ASC) USING BTREE,
  CONSTRAINT `floors_mall_id_foreign` FOREIGN KEY (`mall_id`) REFERENCES `malls` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of floors
-- ----------------------------
INSERT INTO `floors` VALUES (1, 'floor one', '', 1, '2');
INSERT INTO `floors` VALUES (2, 'floor one', NULL, 2, '1');
INSERT INTO `floors` VALUES (6, 'floor one', NULL, 3, 'd');
INSERT INTO `floors` VALUES (7, 'floor two', NULL, 1, NULL);
INSERT INTO `floors` VALUES (8, 'floor three', '', 1, 'dsadsdasda');
INSERT INTO `floors` VALUES (9, 'floor two', NULL, 2, NULL);
INSERT INTO `floors` VALUES (10, 'floor three', NULL, 2, NULL);
INSERT INTO `floors` VALUES (11, 'floor two', NULL, 3, NULL);
INSERT INTO `floors` VALUES (12, 'floor three', NULL, 3, NULL);

-- ----------------------------
-- Table structure for main_products
-- ----------------------------
DROP TABLE IF EXISTS `main_products`;
CREATE TABLE `main_products`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_weight_in_grams` double NULL DEFAULT NULL COMMENT 'weight in grams example (product_weight = 2300 grams)',
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `category_id` int NULL DEFAULT NULL,
  `image_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `image_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `image_3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `production_date` date NULL DEFAULT NULL,
  `expiration_date` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `product_name`(`product_name` ASC) USING BTREE,
  INDEX `main_products_category_id_foreign`(`category_id` ASC) USING BTREE,
  CONSTRAINT `main_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 330 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of main_products
-- ----------------------------
INSERT INTO `main_products` VALUES (1, '111', 150, 'hand watch', 'nice hand watch', 19, 'watch-1.webp', 'watch-2.webp', 'watch-3.webp', '2023-07-26', '0000-00-00');
INSERT INTO `main_products` VALUES (2, '222', 40000, 'washing machine', 'cheap nice washing machine', 16, 'washing machine-1.webp', 'washing machine-2.webp', 'washing machine-3.webp', '2023-07-26', NULL);
INSERT INTO `main_products` VALUES (3, '333', 10000, 'tv', 'good quality tv', 17, 'tv-01.webp', 'tv-02.webp', 'tv-03.webp', '2023-07-26', NULL);
INSERT INTO `main_products` VALUES (4, '444', 500, 'realme type 25', 'realme new smart phone', 20, 'smartphone-1.webp', 'smartphone-2.webp', 'smartphone-3.webp', '2020-10-26', NULL);
INSERT INTO `main_products` VALUES (5, '555', 100, 'mouse', 'good quality mouse', 18, 'mouse-1.webp', 'mouse-2.webp', 'mouse-3.webp', '2023-07-26', NULL);
INSERT INTO `main_products` VALUES (6, '666', 2000, 'food mixer', 'good food mixer', 21, 'mixer-1.webp', 'mixer-2.webp', 'mixer-3.webp', '2023-07-26', NULL);
INSERT INTO `main_products` VALUES (7, '777', 1600, 'lenovo laptop', 'good lenovo laptop', 22, 'laptop-1.webp', 'laptop-2.webp', 'laptop-3.webp', '2023-07-26', NULL);
INSERT INTO `main_products` VALUES (8, '888', 45000, 'fridge', 'good quality fride', 23, 'fridge-1.webp', 'fridge-2.webp', 'fridge-3.webp', '2023-08-01', NULL);
INSERT INTO `main_products` VALUES (9, '999', 2000, 'camera', 'good camera', 24, 'camera-1.webp', 'camera-2.webp', 'camera-3.webp', '2021-11-16', '2025-03-15');

-- ----------------------------
-- Table structure for malls
-- ----------------------------
DROP TABLE IF EXISTS `malls`;
CREATE TABLE `malls`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `mall_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `mall_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `has_3d` tinyint NULL DEFAULT NULL,
  `has_2d` tinyint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 54 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of malls
-- ----------------------------
INSERT INTO `malls` VALUES (1, 'erbil mall', 'erbil', 1, 1);
INSERT INTO `malls` VALUES (2, 'baghdad mall', 'baghdad', 0, 1);
INSERT INTO `malls` VALUES (3, 'basra mall', 'basra', 1, 0);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 70 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2025_04_24_172842_create_cart_table', 0);
INSERT INTO `migrations` VALUES (2, '2025_04_24_172842_create_categories_table', 0);
INSERT INTO `migrations` VALUES (3, '2025_04_24_172842_create_countries_table', 0);
INSERT INTO `migrations` VALUES (4, '2025_04_24_172842_create_coupons_table', 0);
INSERT INTO `migrations` VALUES (5, '2025_04_24_172842_create_department_employee_table', 0);
INSERT INTO `migrations` VALUES (6, '2025_04_24_172842_create_departments_table', 0);
INSERT INTO `migrations` VALUES (7, '2025_04_24_172842_create_employees_table', 0);
INSERT INTO `migrations` VALUES (8, '2025_04_24_172842_create_event_type_table', 0);
INSERT INTO `migrations` VALUES (9, '2025_04_24_172842_create_events_table', 0);
INSERT INTO `migrations` VALUES (10, '2025_04_24_172842_create_floors_table', 0);
INSERT INTO `migrations` VALUES (11, '2025_04_24_172842_create_main_products_table', 0);
INSERT INTO `migrations` VALUES (12, '2025_04_24_172842_create_malls_table', 0);
INSERT INTO `migrations` VALUES (13, '2025_04_24_172842_create_offer_configurations_table', 0);
INSERT INTO `migrations` VALUES (14, '2025_04_24_172842_create_offers_table', 0);
INSERT INTO `migrations` VALUES (15, '2025_04_24_172842_create_orders_table', 0);
INSERT INTO `migrations` VALUES (16, '2025_04_24_172842_create_payment_method_table', 0);
INSERT INTO `migrations` VALUES (17, '2025_04_24_172842_create_positions_table', 0);
INSERT INTO `migrations` VALUES (18, '2025_04_24_172842_create_product_config_table', 0);
INSERT INTO `migrations` VALUES (19, '2025_04_24_172842_create_products_table', 0);
INSERT INTO `migrations` VALUES (20, '2025_04_24_172842_create_roles_table', 0);
INSERT INTO `migrations` VALUES (21, '2025_04_24_172842_create_shelf_types_table', 0);
INSERT INTO `migrations` VALUES (22, '2025_04_24_172842_create_shelves_table', 0);
INSERT INTO `migrations` VALUES (23, '2025_04_24_172842_create_shipments_table', 0);
INSERT INTO `migrations` VALUES (24, '2025_04_24_172842_create_shop_coupon_table', 0);
INSERT INTO `migrations` VALUES (25, '2025_04_24_172842_create_shops_table', 0);
INSERT INTO `migrations` VALUES (26, '2025_04_24_172842_create_status_table', 0);
INSERT INTO `migrations` VALUES (27, '2025_04_24_172842_create_suppliers_table', 0);
INSERT INTO `migrations` VALUES (28, '2025_04_24_172842_create_table_title_table', 0);
INSERT INTO `migrations` VALUES (29, '2025_04_24_172842_create_tables_table', 0);
INSERT INTO `migrations` VALUES (30, '2025_04_24_172842_create_tickets_table', 0);
INSERT INTO `migrations` VALUES (31, '2025_04_24_172842_create_titles_table', 0);
INSERT INTO `migrations` VALUES (32, '2025_04_24_172842_create_user_shop_table', 0);
INSERT INTO `migrations` VALUES (33, '2025_04_24_172842_create_users_table', 0);
INSERT INTO `migrations` VALUES (34, '2025_04_24_172842_create_variation_table', 0);
INSERT INTO `migrations` VALUES (35, '2025_04_24_172842_create_variation_option_table', 0);
INSERT INTO `migrations` VALUES (36, '2025_04_24_172842_create_wishlist_table', 0);
INSERT INTO `migrations` VALUES (37, '2025_04_24_172844_create_dynamic_left_join_proc', 0);
INSERT INTO `migrations` VALUES (38, '2025_04_24_172844_create_dynamic_table_join_proc', 0);
INSERT INTO `migrations` VALUES (39, '2025_04_24_172844_create_GetTableColumns_proc', 0);
INSERT INTO `migrations` VALUES (40, '2025_04_24_172844_create_GetTableColumnsDataWhere_proc', 0);
INSERT INTO `migrations` VALUES (41, '2025_04_24_172844_create_GetTableColumnsWhere_proc', 0);
INSERT INTO `migrations` VALUES (42, '2025_04_24_172844_create_GetTables_proc', 0);
INSERT INTO `migrations` VALUES (43, '2025_04_24_172844_create_search_products_proc', 0);
INSERT INTO `migrations` VALUES (44, '2025_04_24_172844_create_sp_dynamic_data_fetch_proc', 0);
INSERT INTO `migrations` VALUES (45, '2025_04_24_172845_add_foreign_keys_to_cart_table', 0);
INSERT INTO `migrations` VALUES (46, '2025_04_24_172845_add_foreign_keys_to_categories_table', 0);
INSERT INTO `migrations` VALUES (47, '2025_04_24_172845_add_foreign_keys_to_department_employee_table', 0);
INSERT INTO `migrations` VALUES (48, '2025_04_24_172845_add_foreign_keys_to_departments_table', 0);
INSERT INTO `migrations` VALUES (49, '2025_04_24_172845_add_foreign_keys_to_employees_table', 0);
INSERT INTO `migrations` VALUES (50, '2025_04_24_172845_add_foreign_keys_to_events_table', 0);
INSERT INTO `migrations` VALUES (51, '2025_04_24_172845_add_foreign_keys_to_floors_table', 0);
INSERT INTO `migrations` VALUES (52, '2025_04_24_172845_add_foreign_keys_to_main_products_table', 0);
INSERT INTO `migrations` VALUES (53, '2025_04_24_172845_add_foreign_keys_to_offer_configurations_table', 0);
INSERT INTO `migrations` VALUES (54, '2025_04_24_172845_add_foreign_keys_to_orders_table', 0);
INSERT INTO `migrations` VALUES (55, '2025_04_24_172845_add_foreign_keys_to_positions_table', 0);
INSERT INTO `migrations` VALUES (56, '2025_04_24_172845_add_foreign_keys_to_product_config_table', 0);
INSERT INTO `migrations` VALUES (57, '2025_04_24_172845_add_foreign_keys_to_products_table', 0);
INSERT INTO `migrations` VALUES (58, '2025_04_24_172845_add_foreign_keys_to_roles_table', 0);
INSERT INTO `migrations` VALUES (59, '2025_04_24_172845_add_foreign_keys_to_shelves_table', 0);
INSERT INTO `migrations` VALUES (60, '2025_04_24_172845_add_foreign_keys_to_shipments_table', 0);
INSERT INTO `migrations` VALUES (61, '2025_04_24_172845_add_foreign_keys_to_shop_coupon_table', 0);
INSERT INTO `migrations` VALUES (62, '2025_04_24_172845_add_foreign_keys_to_shops_table', 0);
INSERT INTO `migrations` VALUES (63, '2025_04_24_172845_add_foreign_keys_to_table_title_table', 0);
INSERT INTO `migrations` VALUES (64, '2025_04_24_172845_add_foreign_keys_to_tickets_table', 0);
INSERT INTO `migrations` VALUES (65, '2025_04_24_172845_add_foreign_keys_to_user_shop_table', 0);
INSERT INTO `migrations` VALUES (66, '2025_04_24_172845_add_foreign_keys_to_users_table', 0);
INSERT INTO `migrations` VALUES (67, '2025_04_24_172845_add_foreign_keys_to_variation_table', 0);
INSERT INTO `migrations` VALUES (68, '2025_04_24_172845_add_foreign_keys_to_variation_option_table', 0);
INSERT INTO `migrations` VALUES (69, '2025_04_24_172845_add_foreign_keys_to_wishlist_table', 0);

-- ----------------------------
-- Table structure for offer_configurations
-- ----------------------------
DROP TABLE IF EXISTS `offer_configurations`;
CREATE TABLE `offer_configurations`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `offer_id` int NULL DEFAULT NULL,
  `category_id` int NULL DEFAULT NULL,
  `product_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `offer_configurations_category_id_foreign`(`category_id` ASC) USING BTREE,
  INDEX `offer_configurations_offer_id_foreign`(`offer_id` ASC) USING BTREE,
  INDEX `offer_configurations_product_id_foreign`(`product_id` ASC) USING BTREE,
  CONSTRAINT `offer_configurations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `offer_configurations_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `offer_configurations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of offer_configurations
-- ----------------------------

-- ----------------------------
-- Table structure for offers
-- ----------------------------
DROP TABLE IF EXISTS `offers`;
CREATE TABLE `offers`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `discount_rate` int NULL DEFAULT NULL,
  `start_date` date NULL DEFAULT NULL,
  `end_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of offers
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `amount` int NULL DEFAULT NULL,
  `time_of_purchase` datetime NULL DEFAULT NULL,
  `status_id` int NULL DEFAULT NULL,
  `payment_method_id` int NULL DEFAULT NULL,
  `product_id` int NULL DEFAULT NULL,
  `employee_id` int NULL DEFAULT NULL,
  `coupon_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `orders_payment_method_id_foreign`(`payment_method_id` ASC) USING BTREE,
  INDEX `orders_product_id_foreign`(`product_id` ASC) USING BTREE,
  INDEX `orders_status_id_foreign`(`status_id` ASC) USING BTREE,
  INDEX `orders_user_id_foreign`(`user_id` ASC) USING BTREE,
  INDEX `orders_employee_id_fk`(`employee_id` ASC) USING BTREE,
  INDEX `orders_coupons_id_fk`(`coupon_id` ASC) USING BTREE,
  CONSTRAINT `orders_coupons_id_fk` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `orders_employee_id_fk` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `orders_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 380 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (361, 3, 1, '2024-04-26 03:23:26', 1, 1, 7, NULL, NULL);
INSERT INTO `orders` VALUES (362, 3, 1, '2024-04-26 03:28:04', 6, 1, 9, NULL, NULL);
INSERT INTO `orders` VALUES (363, 3, 1, '2024-04-26 03:28:04', 6, 1, 9, NULL, NULL);
INSERT INTO `orders` VALUES (364, NULL, 1, '2024-04-27 00:20:01', 3, 4, 9, 1, 1);
INSERT INTO `orders` VALUES (365, NULL, 1, '2024-04-27 00:20:01', 3, 4, 7, 1, 1);
INSERT INTO `orders` VALUES (366, NULL, 1, '2024-04-27 00:20:01', 3, 4, 4, 1, 1);
INSERT INTO `orders` VALUES (367, NULL, 1, '2024-04-27 00:20:01', 3, 4, 8, 1, 1);
INSERT INTO `orders` VALUES (368, 3, 1, '2024-05-02 06:57:18', 1, 1, 9, NULL, NULL);
INSERT INTO `orders` VALUES (369, 3, 11, '2024-05-02 06:57:18', 1, 1, 1, NULL, NULL);
INSERT INTO `orders` VALUES (370, 3, 1, '2024-05-02 06:57:18', 1, 1, 7, NULL, NULL);
INSERT INTO `orders` VALUES (371, 29, 4, '2024-11-19 20:01:29', 1, 1, 1, NULL, NULL);
INSERT INTO `orders` VALUES (372, 29, 4, '2024-11-19 20:01:29', 1, 1, 7, NULL, NULL);
INSERT INTO `orders` VALUES (373, 3, 1, '2024-12-07 20:43:44', 1, 1, 9, NULL, NULL);
INSERT INTO `orders` VALUES (374, 3, 2, '2025-04-23 22:38:05', 1, 1, 8, NULL, NULL);
INSERT INTO `orders` VALUES (375, 3, 1, '2025-04-23 22:38:05', 1, 1, 9, NULL, NULL);

-- ----------------------------
-- Table structure for payment_method
-- ----------------------------
DROP TABLE IF EXISTS `payment_method`;
CREATE TABLE `payment_method`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `method_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `face_to_face` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of payment_method
-- ----------------------------
INSERT INTO `payment_method` VALUES (1, NULL, 'Pay on Delivery', 0);
INSERT INTO `payment_method` VALUES (2, NULL, 'Credit Card', 0);
INSERT INTO `payment_method` VALUES (3, NULL, 'PayPal', 0);
INSERT INTO `payment_method` VALUES (4, NULL, 'Cash', 1);

-- ----------------------------
-- Table structure for positions
-- ----------------------------
DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `shelf_id` int NULL DEFAULT NULL,
  `x` int NULL DEFAULT NULL COMMENT 'north',
  `z` int NULL DEFAULT NULL COMMENT 'east',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `positions_shelf_id_foreign`(`shelf_id` ASC) USING BTREE,
  CONSTRAINT `positions_shelf_id_foreign` FOREIGN KEY (`shelf_id`) REFERENCES `shelves` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of positions
-- ----------------------------
INSERT INTO `positions` VALUES (1, 5, 1, 3);
INSERT INTO `positions` VALUES (2, 2, 2, 3);
INSERT INTO `positions` VALUES (3, 3, 3, 4);
INSERT INTO `positions` VALUES (4, 5, 1, 2);
INSERT INTO `positions` VALUES (5, 5, 2, 1);
INSERT INTO `positions` VALUES (6, 1, 2, 2);
INSERT INTO `positions` VALUES (7, 4, 2, 3);
INSERT INTO `positions` VALUES (8, 1, 3, 2);
INSERT INTO `positions` VALUES (9, 1, 3, 3);
INSERT INTO `positions` VALUES (10, 2, 2, 3);
INSERT INTO `positions` VALUES (11, 2, 3, 3);

-- ----------------------------
-- Table structure for product_config
-- ----------------------------
DROP TABLE IF EXISTS `product_config`;
CREATE TABLE `product_config`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NULL DEFAULT NULL,
  `variation_option_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_config_variation_option_id_foreign`(`variation_option_id` ASC) USING BTREE,
  INDEX `product_config_product_id_foreign`(`product_id` ASC) USING BTREE,
  CONSTRAINT `product_config_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `product_config_variation_option_id_foreign_pc` FOREIGN KEY (`variation_option_id`) REFERENCES `variation_option` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product_config
-- ----------------------------
INSERT INTO `product_config` VALUES (4, 1, 8);
INSERT INTO `product_config` VALUES (5, 1, 9);
INSERT INTO `product_config` VALUES (7, 1, 10);
INSERT INTO `product_config` VALUES (8, 2, 11);
INSERT INTO `product_config` VALUES (9, 3, 10);
INSERT INTO `product_config` VALUES (10, 3, 11);
INSERT INTO `product_config` VALUES (11, 3, 12);
INSERT INTO `product_config` VALUES (12, 1, 11);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `main_product_id` int NULL DEFAULT NULL,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `amount` int NULL DEFAULT NULL,
  `price` int NULL DEFAULT NULL,
  `offer_id` int NULL DEFAULT NULL,
  `position_id` int NULL DEFAULT NULL,
  `is_published` bit(1) NULL DEFAULT NULL,
  `shipment_id` int NULL DEFAULT NULL,
  `date_added` datetime NULL DEFAULT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `products_main_product_id_foreign`(`main_product_id` ASC) USING BTREE,
  INDEX `products_position_id_foreign`(`position_id` ASC) USING BTREE,
  INDEX `products_shipment_id_foreign`(`shipment_id` ASC) USING BTREE,
  CONSTRAINT `products_main_product_id_foreign` FOREIGN KEY (`main_product_id`) REFERENCES `main_products` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `products_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `products_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 259 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 1, NULL, 8, 100, NULL, 9, NULL, NULL, NULL, '1234001012345');
INSERT INTO `products` VALUES (2, 2, NULL, 5, 500, NULL, 2, NULL, NULL, NULL, '1234001712344');
INSERT INTO `products` VALUES (3, 3, NULL, 15, 200, NULL, 3, NULL, NULL, NULL, '1234000212340');
INSERT INTO `products` VALUES (4, 4, NULL, 11, 300, NULL, 4, NULL, NULL, NULL, '1234002012344');
INSERT INTO `products` VALUES (5, 5, NULL, 50, 20, NULL, 2, NULL, NULL, NULL, '1234000612348');
INSERT INTO `products` VALUES (6, 6, NULL, 11, 70, NULL, 3, NULL, NULL, NULL, '1234000312347');
INSERT INTO `products` VALUES (7, 7, NULL, 0, 600, NULL, 4, NULL, NULL, '0000-00-00 00:00:00', '1234001812341');
INSERT INTO `products` VALUES (8, 8, NULL, 0, 1000, NULL, 5, NULL, NULL, NULL, '1234000412344');
INSERT INTO `products` VALUES (9, 9, NULL, 7, 300, NULL, 7, NULL, NULL, NULL, '1234000912349');
INSERT INTO `products` VALUES (10, 9, NULL, 13, 400, NULL, 10, NULL, NULL, '2024-04-18 08:48:11', '1234001312346');
INSERT INTO `products` VALUES (11, 6, NULL, 11, 70, NULL, 11, NULL, NULL, '2024-04-18 08:48:50', '1234000712345');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_id` int NULL DEFAULT NULL,
  `employee_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `employee_id_fk`(`employee_id` ASC) USING BTREE,
  INDEX `title_id_fk`(`title_id` ASC) USING BTREE,
  CONSTRAINT `employee_id_fk` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `title_id_fk` FOREIGN KEY (`title_id`) REFERENCES `titles` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 5, 1);
INSERT INTO `roles` VALUES (2, 1, 5);

-- ----------------------------
-- Table structure for shelf_types
-- ----------------------------
DROP TABLE IF EXISTS `shelf_types`;
CREATE TABLE `shelf_types`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `compartments` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of shelf_types
-- ----------------------------
INSERT INTO `shelf_types` VALUES (1, 'normal_shelf', 9);

-- ----------------------------
-- Table structure for shelves
-- ----------------------------
DROP TABLE IF EXISTS `shelves`;
CREATE TABLE `shelves`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `shop_id` int NULL DEFAULT NULL,
  `shelf_type_id` int NULL DEFAULT NULL,
  `from_north` float NULL DEFAULT NULL,
  `to_north` float NULL DEFAULT NULL,
  `from_east` float NULL DEFAULT NULL,
  `to_east` float NULL DEFAULT NULL,
  `height` int NULL DEFAULT NULL,
  `width` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `shelves_shelf_type_id_foreign`(`shelf_type_id` ASC) USING BTREE,
  INDEX `shelves_shop_id_foreign`(`shop_id` ASC) USING BTREE,
  CONSTRAINT `shelves_shelf_type_id_foreign` FOREIGN KEY (`shelf_type_id`) REFERENCES `shelf_types` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `shelves_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of shelves
-- ----------------------------
INSERT INTO `shelves` VALUES (1, 1, 1, 1, 12, 5, 5, 4, 4);
INSERT INTO `shelves` VALUES (2, 2, 1, 1, 1, 2, 2, 3, 3);
INSERT INTO `shelves` VALUES (3, 3, 1, NULL, NULL, NULL, NULL, 3, 3);
INSERT INTO `shelves` VALUES (4, 1, 1, 1, 1, 2, 3, 3, 3);
INSERT INTO `shelves` VALUES (5, 4, 1, 7, 10, 2, 2, 4, 4);
INSERT INTO `shelves` VALUES (6, 1, 1, 15, 18, 7, 7, 5, 5);
INSERT INTO `shelves` VALUES (7, 1, 1, 20, 24, 7, 7, 5, 5);

-- ----------------------------
-- Table structure for shipments
-- ----------------------------
DROP TABLE IF EXISTS `shipments`;
CREATE TABLE `shipments`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int NULL DEFAULT NULL,
  `requested_on_time` datetime NULL DEFAULT NULL,
  `expected_arrival_time` datetime NULL DEFAULT NULL,
  `each_price` int NULL DEFAULT NULL,
  `amount` int NULL DEFAULT NULL,
  `pending` tinyint(1) NULL DEFAULT NULL,
  `processing` tinyint(1) NULL DEFAULT NULL,
  `cancelled` tinyint(1) NULL DEFAULT NULL,
  `delivered` tinyint(1) NULL DEFAULT NULL,
  `actual_arrival_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `shipments_supplier_id_foreign`(`supplier_id` ASC) USING BTREE,
  CONSTRAINT `shipments_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of shipments
-- ----------------------------

-- ----------------------------
-- Table structure for shop_coupon
-- ----------------------------
DROP TABLE IF EXISTS `shop_coupon`;
CREATE TABLE `shop_coupon`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `shop_id` int NULL DEFAULT NULL,
  `coupon_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `coupon_id_fk`(`coupon_id` ASC) USING BTREE,
  INDEX `shop_id_fk`(`shop_id` ASC) USING BTREE,
  CONSTRAINT `coupon_id_fk` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `shop_id_fk` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of shop_coupon
-- ----------------------------
INSERT INTO `shop_coupon` VALUES (1, 1, 1);
INSERT INTO `shop_coupon` VALUES (2, 2, 3);

-- ----------------------------
-- Table structure for shops
-- ----------------------------
DROP TABLE IF EXISTS `shops`;
CREATE TABLE `shops`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `monthly_rent` int NULL DEFAULT NULL,
  `monthly_ad` int NULL DEFAULT NULL,
  `floor_id` int NULL DEFAULT NULL,
  `north_in_meters` int NULL DEFAULT NULL,
  `east_in_meters` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `shops_floor_id_foreign`(`floor_id` ASC) USING BTREE,
  CONSTRAINT `shops_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of shops
-- ----------------------------
INSERT INTO `shops` VALUES (1, 'iraqi market', 0, 0, 1, 40, 20);
INSERT INTO `shops` VALUES (2, 'small market', 0, 0, 2, 33, 20);
INSERT INTO `shops` VALUES (3, 'modren market', 0, 0, 6, 12, 20);
INSERT INTO `shops` VALUES (4, 'poeple\'s market', 0, 0, 7, 40, 23);

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES (1, 'Processing', 'still in mall', 1);
INSERT INTO `status` VALUES (2, 'Delivering', 'on the way', 1);
INSERT INTO `status` VALUES (3, 'Completed', 'everything is done', 2);
INSERT INTO `status` VALUES (4, 'Refused', 'refused by mall', 3);
INSERT INTO `status` VALUES (5, 'Failed', 'an issue failed the process', 3);
INSERT INTO `status` VALUES (6, 'Canceled by User', 'the user canceled the order', 3);

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of suppliers
-- ----------------------------

-- ----------------------------
-- Table structure for table_title
-- ----------------------------
DROP TABLE IF EXISTS `table_title`;
CREATE TABLE `table_title`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `table_id` int NULL DEFAULT NULL,
  `title_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `title_id_table_title_fk`(`title_id` ASC) USING BTREE,
  INDEX `table_id_table_title_fk`(`table_id` ASC) USING BTREE,
  CONSTRAINT `table_id_table_title_fk` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `title_id_table_title_fk` FOREIGN KEY (`title_id`) REFERENCES `titles` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 64 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of table_title
-- ----------------------------
INSERT INTO `table_title` VALUES (1, 7, 4);
INSERT INTO `table_title` VALUES (4, 10, 4);
INSERT INTO `table_title` VALUES (5, 14, 4);
INSERT INTO `table_title` VALUES (6, 18, 4);
INSERT INTO `table_title` VALUES (7, 20, 4);
INSERT INTO `table_title` VALUES (8, 21, 4);
INSERT INTO `table_title` VALUES (9, 24, 4);
INSERT INTO `table_title` VALUES (10, 25, 4);
INSERT INTO `table_title` VALUES (26, 4, 5);
INSERT INTO `table_title` VALUES (27, 37, 5);
INSERT INTO `table_title` VALUES (28, 28, 5);
INSERT INTO `table_title` VALUES (29, 22, 5);
INSERT INTO `table_title` VALUES (30, 24, 5);
INSERT INTO `table_title` VALUES (31, 6, 5);
INSERT INTO `table_title` VALUES (32, 32, 5);
INSERT INTO `table_title` VALUES (33, 11, 5);
INSERT INTO `table_title` VALUES (34, 39, 5);
INSERT INTO `table_title` VALUES (35, 20, 5);
INSERT INTO `table_title` VALUES (36, 8, 5);
INSERT INTO `table_title` VALUES (37, 33, 5);
INSERT INTO `table_title` VALUES (38, 34, 5);
INSERT INTO `table_title` VALUES (39, 26, 5);
INSERT INTO `table_title` VALUES (40, 30, 5);
INSERT INTO `table_title` VALUES (41, 17, 5);
INSERT INTO `table_title` VALUES (42, 38, 5);
INSERT INTO `table_title` VALUES (43, 10, 5);
INSERT INTO `table_title` VALUES (44, 5, 5);
INSERT INTO `table_title` VALUES (45, 29, 5);
INSERT INTO `table_title` VALUES (46, 18, 5);
INSERT INTO `table_title` VALUES (47, 23, 5);
INSERT INTO `table_title` VALUES (48, 2, 5);
INSERT INTO `table_title` VALUES (49, 35, 5);
INSERT INTO `table_title` VALUES (50, 3, 5);
INSERT INTO `table_title` VALUES (51, 27, 5);
INSERT INTO `table_title` VALUES (52, 7, 5);
INSERT INTO `table_title` VALUES (53, 14, 5);
INSERT INTO `table_title` VALUES (54, 12, 5);
INSERT INTO `table_title` VALUES (55, 9, 5);
INSERT INTO `table_title` VALUES (56, 13, 5);
INSERT INTO `table_title` VALUES (57, 19, 5);
INSERT INTO `table_title` VALUES (58, 15, 5);
INSERT INTO `table_title` VALUES (59, 16, 5);
INSERT INTO `table_title` VALUES (60, 21, 5);
INSERT INTO `table_title` VALUES (61, 31, 5);
INSERT INTO `table_title` VALUES (62, 36, 5);
INSERT INTO `table_title` VALUES (63, 25, 5);

-- ----------------------------
-- Table structure for tables
-- ----------------------------
DROP TABLE IF EXISTS `tables`;
CREATE TABLE `tables`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tables
-- ----------------------------
INSERT INTO `tables` VALUES (2, 'cart');
INSERT INTO `tables` VALUES (3, 'categories');
INSERT INTO `tables` VALUES (4, 'chats');
INSERT INTO `tables` VALUES (5, 'conversations');
INSERT INTO `tables` VALUES (6, 'countries');
INSERT INTO `tables` VALUES (7, 'coupons');
INSERT INTO `tables` VALUES (8, 'departments');
INSERT INTO `tables` VALUES (9, 'department_employee');
INSERT INTO `tables` VALUES (10, 'employees');
INSERT INTO `tables` VALUES (11, 'events');
INSERT INTO `tables` VALUES (12, 'event_type');
INSERT INTO `tables` VALUES (13, 'floors');
INSERT INTO `tables` VALUES (14, 'main_products');
INSERT INTO `tables` VALUES (15, 'malls');
INSERT INTO `tables` VALUES (16, 'offers');
INSERT INTO `tables` VALUES (17, 'offer_configurations');
INSERT INTO `tables` VALUES (18, 'orders');
INSERT INTO `tables` VALUES (19, 'payment_method');
INSERT INTO `tables` VALUES (20, 'positions');
INSERT INTO `tables` VALUES (21, 'products');
INSERT INTO `tables` VALUES (22, 'product_config');
INSERT INTO `tables` VALUES (23, 'roles');
INSERT INTO `tables` VALUES (24, 'shelf_types');
INSERT INTO `tables` VALUES (25, 'shelves');
INSERT INTO `tables` VALUES (26, 'shipments');
INSERT INTO `tables` VALUES (27, 'shops');
INSERT INTO `tables` VALUES (28, 'shop_coupon');
INSERT INTO `tables` VALUES (29, 'status');
INSERT INTO `tables` VALUES (30, 'suppliers');
INSERT INTO `tables` VALUES (31, 'tables');
INSERT INTO `tables` VALUES (32, 'table_title');
INSERT INTO `tables` VALUES (33, 'tickets');
INSERT INTO `tables` VALUES (34, 'titles');
INSERT INTO `tables` VALUES (35, 'users');
INSERT INTO `tables` VALUES (36, 'user_shop');
INSERT INTO `tables` VALUES (37, 'variation');
INSERT INTO `tables` VALUES (38, 'variation_option');
INSERT INTO `tables` VALUES (39, 'wishlist');

-- ----------------------------
-- Table structure for tickets
-- ----------------------------
DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `subject` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `time_of_submission` datetime NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id_tickets_fk`(`user_id` ASC) USING BTREE,
  CONSTRAINT `user_id_tickets_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tickets
-- ----------------------------
INSERT INTO `tickets` VALUES (1, 'issue', 'idk what to eat today', '2024-04-21 22:12:17', 3);

-- ----------------------------
-- Table structure for titles
-- ----------------------------
DROP TABLE IF EXISTS `titles`;
CREATE TABLE `titles`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `allowance` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of titles
-- ----------------------------
INSERT INTO `titles` VALUES (1, 'cashier', 'only sees what relates to there job', 1);
INSERT INTO `titles` VALUES (2, 'shop_manager', 'only sees everything in there shop', 2);
INSERT INTO `titles` VALUES (3, 'mall_manager', 'only sees everything in there mall', 3);
INSERT INTO `titles` VALUES (4, 'janitor', 'has no allowance', 0);
INSERT INTO `titles` VALUES (5, 'ceo', 'controls everything', 5);
INSERT INTO `titles` VALUES (6, 'test', NULL, 4);

-- ----------------------------
-- Table structure for user_shop
-- ----------------------------
DROP TABLE IF EXISTS `user_shop`;
CREATE TABLE `user_shop`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `shop_id` int NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  `time_of_acquisition` datetime NULL DEFAULT NULL,
  `start_date` date NULL DEFAULT NULL,
  `end_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_shop_shop_id_foreign`(`shop_id` ASC) USING BTREE,
  INDEX `user_shop_user_id_foreign`(`user_id` ASC) USING BTREE,
  CONSTRAINT `user_shop_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `user_shop_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_shop
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `salt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `p_p` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `zip_code` int NULL DEFAULT NULL,
  `country_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `country_id_fk`(`country_id` ASC) USING BTREE,
  CONSTRAINT `country_id_fk` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (2, 'alin', '$2y$10$LaQFPrssyY3KgZ/8JKQhTO4CU8RmCoZJbAwguAD.dEkmppPwGj6uG', '674b991780545a28af67', '1', '', '', '', '', '2024-03-27 06:13:50', 'alin@alin', '', '', 0, 1);
INSERT INTO `users` VALUES (3, 'gorge', '$2a$12$IBqJ824cKfYFWnx8EQWkTOdkR0ci2ydERKw/HiHg1kx0Er5pz4l.O', 'ed567ffd8a2e589d1798', 'dsad1', 'gorge', 'mark', 'erbil', '', '2024-03-27 06:13:50', 'gorge@gorge', '07857673', '', 0, 2);
INSERT INTO `users` VALUES (4, 'mark', '$2a$12$3sGFnkGiRItF33u/k0qnfe5og./uR5RXSTDleUqXX6df.hBKt8Qbm', '6e16d3324d588ca47da5', NULL, NULL, NULL, NULL, NULL, '2024-03-27 06:13:51', NULL, NULL, NULL, NULL, 3);
INSERT INTO `users` VALUES (12, 'rode', '$2y$12$gXTUyGYcqMGzfTR9NohCr.r9hD6YRxZNdf3gVB95TO9H2Dz6Y9vu6', '65398eb5b39e63251e19', NULL, 'rode', 'rode', '108', NULL, '2024-03-27 06:13:51', 'rode@rode', 'rode', 'erbil', 17835, 4);
INSERT INTO `users` VALUES (13, 'ds', '$2y$12$Jcl1Z.61gzv6uNp2XOb/POiK5wZc8Uz13z5MddEoJIOQ6FCvF6RSS', 'bd0106c10b7619651842', NULL, '15 or 1=1', 'ds', 'ds', NULL, '2024-03-27 06:13:51', 'ds', 'ds', 'ds', 0, 5);
INSERT INTO `users` VALUES (14, 'test', '$2y$12$.slOjZ4PCgxECosetP7bue2pQth0evvjGUekSXNmunYDZM3eayjxK', '6c5454ae08145f7bb361', NULL, 'test', 'test', 'test', NULL, '2024-03-27 06:13:51', 'test', 'test', 'test', 0, 6);
INSERT INTO `users` VALUES (15, 's', '$2y$12$EEYNifkJrioEO0ic6YfL8.Qq.fBGrkb.XzW0YMn9Bqhtdz2HR1OOa', '32f19b90e842323cc084', NULL, 's', 's', 's', NULL, '2024-03-27 06:13:51', 's', 's', 's', 0, 7);
INSERT INTO `users` VALUES (18, '13123', '$2y$12$g0UxyQ2VRCAyvOrwYkLhie5m1UHohVsTrZyQB27ul0yPxns6pPdcu', 'cc3448ed8dcd57e7b4ec', NULL, '13123', '13123', '13123', NULL, NULL, '13123', '13123', '13123', 13123, 1);
INSERT INTO `users` VALUES (19, '1', '$2y$12$T7g7r1CZJlPxVCSrLKLG/O6EBPN8Ef4XGZ/iuccczTYtUjPgCsNqW', '4577dab3241452a9f2e1', NULL, '1', '1', '1', NULL, NULL, '1', '1', '1', 1, 18);
INSERT INTO `users` VALUES (20, 'cashier', '$2y$12$G7fyaEN/W.JoN7rH3EgTLursVL.fmcJYebCHNz/NLxCyN0A.zTBIC', '0fcba47e5d0e846ed20a', NULL, 'alin', 'amaar', '1000', NULL, NULL, 'alin@cashier.com', '077777777', 'erbil', 44001, 98);
INSERT INTO `users` VALUES (21, 'sdff', '$2y$12$NTIXhT.5tPLatnlpCFs17upEtWICiLxPiLgjuIFTbARw7PSir.CtK', '758b3f9b05695dd0e301', NULL, 'rfedf', 'aerga', 'wer', NULL, NULL, '34643fdag@gmail.com', '4534722723', 'wer', 54645, 8);
INSERT INTO `users` VALUES (22, 'tester123', '$2y$12$Yq.tnxsOJasLCFfXLAPXuOHkcf8xBBqNttnoQSe3gm4tfcnV4Aksq', 'e513d7c963f2471ef493', NULL, '1', '1', '1', NULL, NULL, '123321', '1', '1', 1, 1);
INSERT INTO `users` VALUES (23, 'Hedb', '$2y$12$8i5vSPOw3RgA1vEw84rCM./TqFP7zVad.hvLIbDzewTZR8HUJ6A.u', '6085302ba9da15932a6b', NULL, 'Dx', 'Dd', 'Hd', NULL, NULL, 'hdb', '282726226', 'The 6363', 0, 1);
INSERT INTO `users` VALUES (24, 'SEF', '$2y$12$DiC5VXUZVNcMvG7EUi.Qs.3heA36UfG5R.mAESGjerJ/isflvy25q', 'd8586a2ca37ad58568ae', NULL, 'SDF', 'SDFSD', 'SDF', NULL, NULL, 'SDF', 'SDF', 'SDF', 0, 1);
INSERT INTO `users` VALUES (25, 'NicoVFX', '$2y$12$39er4ODAIpznZCVjBKf43e6fY8gftpOYbAgtRIjBzbhrvATkqgf22', '9413f22f475888088d72', NULL, 'ALL', 'Nico', '101 Yishun Avenue 5', NULL, NULL, 'notnicotine@gmail.com', '7003179831', 'Singapore', 760101, 104);
INSERT INTO `users` VALUES (26, 'Struppi10423', '$2y$12$bcQ/Ln6V.ffyy0DootK9ZemaK/1jtrJcyqwFWY4xV60yMP0yzX7KK', '24b458e745b50e17bc96', NULL, 'Marvin', 'Hüppi', 'Schweipelstrasse 9', NULL, NULL, 'marvinhueppi@bluewin.ch', '0767997648', 'Hinwil', 9, 207);
INSERT INTO `users` VALUES (27, 'dsadsad', '$2y$12$bNYz9c1p4fYBa.voCVMGIu4YF8Z3B2XnJurNT.JrI8fKiRlDSHfWS', 'b99378a5319b16e5c3fb', NULL, 'dsadsad', 'sadsa', 'dsadsa', NULL, NULL, 'dsadsadsaa', '051143131', '5252', 0, 18);
INSERT INTO `users` VALUES (28, 'Hdh', '$2y$12$6uHWi8x8RckmedPLN0.MeeLS2yx2ImfSNodN9dnjvCpAP267K5Q5m', 'e75cafcf75b9652939fc', NULL, 'Fu', 'Gug', 'Fj', NULL, NULL, 'teehodohe', 'Ru', 'Gu', 0, 1);
INSERT INTO `users` VALUES (29, 'b7r', '$2y$12$RWqW37lgHcGO2cDRwyQdHeIQBis3MyhvUVuoiRsS6jeg/AaIx2bMW', '5dcd26f8148bd9cbf839', NULL, 'b7r', 'b7r', '12345', NULL, NULL, 'b7r@b7r.com', 'b7r', 'b7r', 12345, 7);
INSERT INTO `users` VALUES (30, 'Al Joury', '$2y$12$Ft3N4fHLl/vfGweNGrp3VewURpxLI13XJVHVGH6j5FuBUZ4m.TAcC', 'c7f8a94374d014ff1fb4', NULL, 'Raha', 'Mohamed', 'Sharq', NULL, NULL, 'leslilas_buf@yahoo.com', '0096597300945', 'kuwait', 695, 110);

-- ----------------------------
-- Table structure for variation
-- ----------------------------
DROP TABLE IF EXISTS `variation`;
CREATE TABLE `variation`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `variation_category_id_foreign`(`category_id` ASC) USING BTREE,
  CONSTRAINT `variation_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of variation
-- ----------------------------
INSERT INTO `variation` VALUES (1, 2, 'color');
INSERT INTO `variation` VALUES (2, 2, 'size');

-- ----------------------------
-- Table structure for variation_option
-- ----------------------------
DROP TABLE IF EXISTS `variation_option`;
CREATE TABLE `variation_option`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `variation_id` int NULL DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `variation_option_variation_id_foreign`(`variation_id` ASC) USING BTREE,
  CONSTRAINT `variation_option_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of variation_option
-- ----------------------------
INSERT INTO `variation_option` VALUES (8, 1, 'black');
INSERT INTO `variation_option` VALUES (9, 1, 'white');
INSERT INTO `variation_option` VALUES (10, 2, 's');
INSERT INTO `variation_option` VALUES (11, 2, 'm');
INSERT INTO `variation_option` VALUES (12, 2, 'xl');

-- ----------------------------
-- Table structure for wishlist
-- ----------------------------
DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `product_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `wishlist_product_id_foreign`(`product_id` ASC) USING BTREE,
  INDEX `wishlist_user_id_foreign`(`user_id` ASC) USING BTREE,
  CONSTRAINT `wishlist_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `wishlist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of wishlist
-- ----------------------------
INSERT INTO `wishlist` VALUES (23, NULL, 2);

-- ----------------------------
-- Procedure structure for dynamic_left_join
-- ----------------------------
DROP PROCEDURE IF EXISTS `dynamic_left_join`;
delimiter ;;
CREATE PROCEDURE `dynamic_left_join`(IN `main_table` VARCHAR(255))
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE related_table VARCHAR(255);
    DECLARE join_query TEXT DEFAULT '';
    DECLARE select_query TEXT DEFAULT '';

    -- Cursor to iterate over related tables
    DECLARE cur CURSOR FOR
        SELECT tc.TABLE_NAME
        FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS tc
        JOIN INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS rc ON tc.CONSTRAINT_NAME = rc.CONSTRAINT_NAME
        JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE cu ON cu.CONSTRAINT_NAME = rc.UNIQUE_CONSTRAINT_NAME
        JOIN (
            SELECT i1.TABLE_NAME, i2.TABLE_NAME AS foreign_table_name
            FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS i1
            JOIN INFORMATION_SCHEMA.TABLE_CONSTRAINTS i2 ON i1.CONSTRAINT_NAME = i2.CONSTRAINT_NAME
            WHERE i1.CONSTRAINT_TYPE = 'PRIMARY KEY'
            AND i2.CONSTRAINT_TYPE = 'FOREIGN KEY'
        ) r ON r.TABLE_NAME = cu.TABLE_NAME
        WHERE cu.TABLE_NAME = main_table;

    -- Handle conditions
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    -- Build the dynamic left join query
    OPEN cur;
    loop_tables: LOOP
        FETCH cur INTO related_table;
        IF done THEN
            LEAVE loop_tables;
        END IF;

        SET join_query = CONCAT(join_query, 'LEFT JOIN ', related_table, ' ON ', related_table, '.ForeignKeyColumn = ', main_table, '.PrimaryKeyColumn ');
        SET select_query = CONCAT(select_query, related_table, '.*, ');
    END LOOP loop_tables;
    CLOSE cur; -- Close the cursor

    -- Remove the last comma
    SET select_query = LEFT(select_query, LENGTH(select_query) - 1);

    -- Final select query with left join
    SET @final_query = CONCAT('SELECT ', select_query, ' FROM ', main_table, ' ', join_query);

    -- Execute the final query
    PREPARE stmt FROM @final_query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for dynamic_table_join
-- ----------------------------
DROP PROCEDURE IF EXISTS `dynamic_table_join`;
delimiter ;;
CREATE PROCEDURE `dynamic_table_join`(IN `table_name` VARCHAR(255))
BEGIN
    DECLARE query VARCHAR(10000);
    
    -- Construct the SQL query based on the input table name
    SET query = 
        CONCAT('SELECT ', table_name, '.*, malls.id AS mall_id 
                FROM ', table_name, ' 
                INNER JOIN malls 
                ON ', table_name, '.mall_id = malls.id');
    
    -- Execute the constructed query
    PREPARE stmt FROM query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for GetTableColumns
-- ----------------------------
DROP PROCEDURE IF EXISTS `GetTableColumns`;
delimiter ;;
CREATE PROCEDURE `GetTableColumns`(IN `db_name` VARCHAR(255))
BEGIN
    SELECT table_name, column_name
    FROM information_schema.columns
    WHERE table_schema = db_name
--     AND table_name NOT IN ('cart', 'chats', 'group_members', 'payment_method', 'positions', 'shelf_types', 'status', 'wishlist', 'conversations', 'offer_configurations', 'user_shop')
    ORDER BY table_name;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for GetTableColumnsDataWhere
-- ----------------------------
DROP PROCEDURE IF EXISTS `GetTableColumnsDataWhere`;
delimiter ;;
CREATE PROCEDURE `GetTableColumnsDataWhere`(IN `db_name` VARCHAR(255), IN `table_name` VARCHAR(255))
BEGIN
    -- Declare variables to hold SQL query strings and store results
    DECLARE column_query VARCHAR(1000);
    DECLARE data_query VARCHAR(1000);
    DECLARE column_names VARCHAR(1000);

    -- Construct SQL query to get column names for the given table
    SET column_query = CONCAT('
        SELECT COLUMN_NAME
        FROM information_schema.columns
        WHERE table_schema = \'', db_name, '\'
        AND table_name = \'', table_name, '\'
    ');

    -- Execute the column query
    PREPARE stmt FROM column_query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;

    -- Construct SQL query to get data for the given table
SET data_query = CONCAT('SELECT * FROM ', table_name, ' AS table_data');

    -- Execute the data query
    PREPARE stmt FROM data_query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for GetTableColumnsWhere
-- ----------------------------
DROP PROCEDURE IF EXISTS `GetTableColumnsWhere`;
delimiter ;;
CREATE PROCEDURE `GetTableColumnsWhere`(IN `db_name` VARCHAR(255), IN `name_for_table` VARCHAR(255))
BEGIN
    SELECT column_name
    FROM information_schema.columns
    WHERE table_schema = db_name
    AND table_name = name_for_table
    ORDER BY table_name;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for GetTables
-- ----------------------------
DROP PROCEDURE IF EXISTS `GetTables`;
delimiter ;;
CREATE PROCEDURE `GetTables`(IN `db_name` VARCHAR(255))
BEGIN
    SELECT table_name
    FROM information_schema.tables
    WHERE table_schema = db_name
    ORDER BY table_name;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for search_products
-- ----------------------------
DROP PROCEDURE IF EXISTS `search_products`;
delimiter ;;
CREATE PROCEDURE `search_products`(IN `product` VARCHAR(255), IN `mall` INT(10))
BEGIN
    SELECT 
        mp.id AS id,
        mp.product_name AS product_name,
        p.price AS price,
        p.amount AS amount,
        mp.image_1 AS image_1
    FROM 
        main_products mp
    JOIN 
        products p ON mp.id = p.main_product_id
    JOIN 
        positions pos ON p.position_id = pos.id
    JOIN 
        shelves sh ON pos.shelf_id = sh.id
    JOIN 
        shops s ON sh.shop_id = s.id
    JOIN 
        floors f ON s.floor_id = f.id
    JOIN 
        malls m ON f.mall_id = m.id
    WHERE 
        m.id = mall
        AND mp.product_name LIKE CONCAT('%', product, '%');
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for sp_dynamic_data_fetch
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_dynamic_data_fetch`;
delimiter ;;
CREATE PROCEDURE `sp_dynamic_data_fetch`(IN `tableName` VARCHAR(100), IN `columnNames` VARCHAR(255), IN `conditions` VARCHAR(255))
BEGIN
    SET @sql = CONCAT('SELECT ', columnNames, ' FROM ', tableName);
    
    IF conditions IS NOT NULL THEN
        SET @sql = CONCAT(@sql, ' WHERE ', conditions);
    END IF;
    
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table orders
-- ----------------------------
DROP TRIGGER IF EXISTS `date_added_after_insert_orders`;
delimiter ;;
CREATE TRIGGER `date_added_after_insert_orders` BEFORE INSERT ON `orders` FOR EACH ROW BEGIN
    SET NEW.time_of_purchase = NOW();
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table orders
-- ----------------------------
DROP TRIGGER IF EXISTS `update_product_amount`;
delimiter ;;
CREATE TRIGGER `update_product_amount` AFTER INSERT ON `orders` FOR EACH ROW BEGIN
    -- Decrease the amount of the product in the products table
    UPDATE products
    SET amount = amount - NEW.amount  -- Corrected to use NEW.amount
    WHERE id = NEW.product_id;  -- Assuming product_id is the foreign key linking orders to products
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table products
-- ----------------------------
DROP TRIGGER IF EXISTS `date_added_after_insert`;
delimiter ;;
CREATE TRIGGER `date_added_after_insert` BEFORE INSERT ON `products` FOR EACH ROW SET NEW.date_added = NOW()
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tickets
-- ----------------------------
DROP TRIGGER IF EXISTS `date_added_after_insert_tickets`;
delimiter ;;
CREATE TRIGGER `date_added_after_insert_tickets` BEFORE INSERT ON `tickets` FOR EACH ROW BEGIN
    SET NEW.time_of_submission = NOW();
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
