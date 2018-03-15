-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2017 at 02:36 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b2b`
--

-- --------------------------------------------------------

--
-- Table structure for table `ApplicationOwner`
--

CREATE TABLE `ApplicationOwner` (
  `OwnerId` int(11) NOT NULL,
  `NameOfOrganization` varchar(200) NOT NULL,
  `AddressFirstLine` varchar(300) NOT NULL,
  `AddressSecondLine` varchar(300) NOT NULL,
  `City` varchar(100) NOT NULL,
  `State` varchar(100) NOT NULL,
  `PostalCode` varchar(10) NOT NULL,
  `CountryId` int(11) NOT NULL,
  `ContactPersonFirstName` varchar(200) NOT NULL,
  `ContactPersonLastName` varchar(200) NOT NULL,
  `ContactPersonEmailAddress` varchar(255) NOT NULL,
  `ContactPersonDesignation` varchar(100) NOT NULL,
  `ContactPersonTelNumber` varchar(25) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ApplicationOwner`
--

INSERT INTO `ApplicationOwner` (`OwnerId`, `NameOfOrganization`, `AddressFirstLine`, `AddressSecondLine`, `City`, `State`, `PostalCode`, `CountryId`, `ContactPersonFirstName`, `ContactPersonLastName`, `ContactPersonEmailAddress`, `ContactPersonDesignation`, `ContactPersonTelNumber`, `CreatedAt`, `ModifyAt`, `IsDelete`) VALUES
(1, 'test', 'test', 'test', 'test', 'test', '123456', 1, 'test', 'test', 'test', 'test', 'test', '2017-12-08 05:00:00', '2017-12-08 06:38:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `B2BCustomer`
--

CREATE TABLE `B2BCustomer` (
  `CustomerId` int(11) NOT NULL,
  `ApplicationOwnerOwnerId` int(11) NOT NULL,
  `NameOfOrganization` varchar(200) NOT NULL,
  `AddressFirstLine` varchar(300) NOT NULL,
  `AddressSecondLine` varchar(300) NOT NULL,
  `City` varchar(100) NOT NULL,
  `State` varchar(100) NOT NULL,
  `PostalCode` varchar(10) NOT NULL,
  `CountryId` int(11) NOT NULL,
  `ContactPersonFirstName` varchar(200) NOT NULL,
  `ContactPersonLastName` varchar(200) NOT NULL,
  `ContactPersonEmailAddress` varchar(255) NOT NULL,
  `ContactPersonDesignation` varchar(100) NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT '1',
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `B2BCustomer`
--

INSERT INTO `B2BCustomer` (`CustomerId`, `ApplicationOwnerOwnerId`, `NameOfOrganization`, `AddressFirstLine`, `AddressSecondLine`, `City`, `State`, `PostalCode`, `CountryId`, `ContactPersonFirstName`, `ContactPersonLastName`, `ContactPersonEmailAddress`, `ContactPersonDesignation`, `ActiveStatus`, `CreatedAt`, `ModifyAt`, `IsDelete`) VALUES
(1, 1, 'Cust Test 1', 'Test', 'Test', 'Test', 'Test', 'Test', 1, 'Test', 'Test', 'Test@gmail.com', 'Test', 1, '2017-12-08 07:19:08', '2017-12-08 02:06:38', 0),
(2, 1, 'dfdffdggffffdfeeeee', 'df', 'df', 'df', 'df', '45', 1, 'fg', 'dgf', 'fg@df.df', 'fg', 1, '2017-12-08 07:37:03', '2017-12-08 02:07:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `B2BCustomerCampaign`
--

CREATE TABLE `B2BCustomerCampaign` (
  `CampaignId` int(11) NOT NULL,
  `B2BCustomerId` int(11) NOT NULL,
  `CampaignName` varchar(255) NOT NULL,
  `CampaignObjective` text,
  `CampaignStartDate` date DEFAULT NULL,
  `CampaignEndDate` date DEFAULT NULL,
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT '1',
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `B2BCustomerCampaign`
--

INSERT INTO `B2BCustomerCampaign` (`CampaignId`, `B2BCustomerId`, `CampaignName`, `CampaignObjective`, `CampaignStartDate`, `CampaignEndDate`, `ActiveStatus`, `CreatedAt`, `ModifyAt`, `IsDelete`) VALUES
(1, 1, 'Camp Test 1', 'Test', '2017-12-07', '2017-12-23', 1, '2017-12-08 07:19:31', '2017-12-08 01:49:31', 0),
(2, 1, 'fdfdf', 'df', '2017-12-08', '2017-12-14', 0, '2017-12-08 07:38:27', '2017-12-08 02:08:35', 0),
(3, 1, 'fgffg', 'fg', '2017-12-11', '2017-12-13', 1, '2017-12-11 11:08:40', '2017-12-11 05:38:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `B2BCustomerCategory`
--

CREATE TABLE `B2BCustomerCategory` (
  `CategoryId` int(11) NOT NULL,
  `B2BCustomerId` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT '1',
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `B2BCustomerCategory`
--

INSERT INTO `B2BCustomerCategory` (`CategoryId`, `B2BCustomerId`, `CategoryName`, `ActiveStatus`, `CreatedAt`, `ModifyAt`, `IsDelete`) VALUES
(1, 1, 'test', 1, '2017-12-11 13:12:25', '2017-12-11 07:42:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `B2BCustomerProduct`
--

CREATE TABLE `B2BCustomerProduct` (
  `ProductId` int(11) NOT NULL,
  `B2BCustomerId` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `ProductImage` varchar(255) DEFAULT NULL,
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT '1',
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CampaignLevel1Territory`
--

CREATE TABLE `CampaignLevel1Territory` (
  `CampaignLevel1TerritoryId` int(11) NOT NULL,
  `CampaignId` int(11) NOT NULL,
  `Level1TerritoryId` int(11) NOT NULL,
  `TargetURL` varchar(255) DEFAULT NULL,
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT '1',
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CampaignLevel2Territory`
--

CREATE TABLE `CampaignLevel2Territory` (
  `CampaignLevel2TerritoryId` int(11) NOT NULL,
  `Level2TerritoryId` int(11) NOT NULL,
  `CampaignLevel1TerritoryId` int(11) NOT NULL,
  `TargetURL` varchar(255) DEFAULT NULL,
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT '1',
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CampaignProducts`
--

CREATE TABLE `CampaignProducts` (
  `CampaignProductId` int(11) NOT NULL,
  `CampaignId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CampaignTagBundle`
--

CREATE TABLE `CampaignTagBundle` (
  `CampaignTagBundleId` int(11) NOT NULL,
  `CampaignId` int(11) NOT NULL,
  `NFCTagBundleId` int(11) NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT '1',
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CampaignTagBundle`
--

INSERT INTO `CampaignTagBundle` (`CampaignTagBundleId`, `CampaignId`, `NFCTagBundleId`, `ActiveStatus`, `CreatedAt`, `ModifyAt`) VALUES
(6, 2, 3, 1, '2017-12-11 10:32:23', '2017-12-11 05:02:23'),
(8, 2, 4, 1, '2017-12-11 10:57:45', '2017-12-11 05:27:45'),
(9, 1, 4, 1, '2017-12-11 11:00:51', '2017-12-11 05:30:51'),
(10, 1, 1, 1, '2017-12-11 11:00:52', '2017-12-11 05:30:52'),
(12, 3, 1, 1, '2017-12-11 11:09:23', '2017-12-11 05:39:23'),
(14, 3, 4, 1, '2017-12-11 11:27:47', '2017-12-11 05:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `CategoryProducts`
--

CREATE TABLE `CategoryProducts` (
  `CategoryProductId` int(11) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` datetime NOT NULL,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Country`
--

CREATE TABLE `Country` (
  `id` int(11) NOT NULL,
  `CountryName` varchar(100) NOT NULL,
  `CountryCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Country`
--

INSERT INTO `Country` (`id`, `CountryName`, `CountryCode`) VALUES
(1, 'India', 'IN'),
(2, 'United States', 'US');

-- --------------------------------------------------------

--
-- Table structure for table `CustomerSolutionFeatures`
--

CREATE TABLE `CustomerSolutionFeatures` (
  `CustomerSolutionFeatureId` int(11) NOT NULL,
  `B2BCustomerId` int(11) NOT NULL,
  `SolutionFeatureId` int(11) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CustomerTagManufacturers`
--

CREATE TABLE `CustomerTagManufacturers` (
  `CustomerTagManufacturerId` int(11) NOT NULL,
  `B2BCustomerId` int(11) NOT NULL,
  `TagManufacturerId` int(11) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` datetime NOT NULL,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Level1Territory`
--

CREATE TABLE `Level1Territory` (
  `Level1TerritoryId` int(11) NOT NULL,
  `B2BCustomerId` int(11) NOT NULL,
  `Level1TerritoryName` varchar(255) NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT '1',
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Level1TerritoryLevel2Territories`
--

CREATE TABLE `Level1TerritoryLevel2Territories` (
  `Level1TerritoryLevel2TerritoryId` int(11) NOT NULL,
  `Level1TerritoryId` int(11) NOT NULL,
  `Level2TerritoryId` int(11) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Level2Territory`
--

CREATE TABLE `Level2Territory` (
  `Level2TerritoryId` int(11) NOT NULL,
  `Level2TerritoryName` varchar(255) NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT '1',
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_09_06_071236_create_members_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `NFCTag`
--

CREATE TABLE `NFCTag` (
  `NFCTagId` int(11) NOT NULL,
  `TagURL` varchar(255) NOT NULL,
  `RedirectURL` varchar(255) NOT NULL,
  `NFCTagBundleId` int(11) NOT NULL,
  `TagManufacturerId` int(11) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `NFCTagBundle`
--

CREATE TABLE `NFCTagBundle` (
  `NFCTagBundleId` int(11) NOT NULL,
  `TagBundleName` varchar(100) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0',
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `NFCTagBundle`
--

INSERT INTO `NFCTagBundle` (`NFCTagBundleId`, `TagBundleName`, `CreatedAt`, `ModifyAt`, `IsDelete`, `ActiveStatus`) VALUES
(1, 'sdsd', '2017-12-06 00:00:00', '2017-12-11 07:22:11', 0, 1),
(2, 'tttdfddfsdfgfvcv', '2017-12-11 07:40:05', '2017-12-11 05:30:28', 0, 1),
(3, 'tttdfddffyyyyyyyyffdf', '2017-12-11 07:40:48', '2017-12-11 05:31:08', 0, 0),
(4, 'cvcvcvff', '2017-12-11 10:49:29', '2017-12-11 05:31:14', 0, 1),
(5, 'dfdfdf', '2017-12-11 11:27:43', '2017-12-11 05:57:43', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `SolutionFeature`
--

CREATE TABLE `SolutionFeature` (
  `SolutionFeatureId` int(11) NOT NULL,
  `SolutionFeatureName` varchar(255) NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT '1',
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TagManufacturer`
--

CREATE TABLE `TagManufacturer` (
  `TagManufacturerId` int(11) NOT NULL,
  `OwnerId` int(11) NOT NULL,
  `ManufacturerName` varchar(200) NOT NULL,
  `AddressFirstLine` varchar(255) NOT NULL,
  `AddressSecondLine` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `State` varchar(255) NOT NULL,
  `PostalCode` varchar(10) NOT NULL,
  `CountryId` int(11) NOT NULL,
  `ContactPersonFirstName` varchar(200) NOT NULL,
  `ContactPersonLastName` varchar(200) NOT NULL,
  `ContactPersonEmailAddress` varchar(255) NOT NULL,
  `ContactPersonDesignation` varchar(100) NOT NULL,
  `ContactPersonTelNumber` varchar(50) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `ModifyAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT '1',
  `IsDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ApplicationOwner`
--
ALTER TABLE `ApplicationOwner`
  ADD PRIMARY KEY (`OwnerId`),
  ADD KEY `ApplicationOwner_ibfk_1` (`CountryId`);

--
-- Indexes for table `B2BCustomer`
--
ALTER TABLE `B2BCustomer`
  ADD PRIMARY KEY (`CustomerId`),
  ADD KEY `B2BCustomer_ibfk_1` (`ApplicationOwnerOwnerId`),
  ADD KEY `B2BCustomer_ibfk_2` (`CountryId`);

--
-- Indexes for table `B2BCustomerCampaign`
--
ALTER TABLE `B2BCustomerCampaign`
  ADD PRIMARY KEY (`CampaignId`),
  ADD KEY `B2BCustomerCampaign_ibfk_1` (`B2BCustomerId`);

--
-- Indexes for table `B2BCustomerCategory`
--
ALTER TABLE `B2BCustomerCategory`
  ADD PRIMARY KEY (`CategoryId`),
  ADD KEY `B2BCustomerCategory_ibfk_1` (`B2BCustomerId`);

--
-- Indexes for table `B2BCustomerProduct`
--
ALTER TABLE `B2BCustomerProduct`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `B2BCustomerProduct_ibfk_1` (`B2BCustomerId`);

--
-- Indexes for table `CampaignLevel1Territory`
--
ALTER TABLE `CampaignLevel1Territory`
  ADD PRIMARY KEY (`CampaignLevel1TerritoryId`),
  ADD KEY `CampaignLevel1Territory_ibfk_1` (`CampaignId`),
  ADD KEY `CampaignLevel1Territory_ibfk_2` (`Level1TerritoryId`);

--
-- Indexes for table `CampaignLevel2Territory`
--
ALTER TABLE `CampaignLevel2Territory`
  ADD PRIMARY KEY (`CampaignLevel2TerritoryId`),
  ADD KEY `CampaignLevel2Territory_ibfk_1` (`Level2TerritoryId`),
  ADD KEY `CampaignLevel2Territory_ibfk_2` (`CampaignLevel1TerritoryId`);

--
-- Indexes for table `CampaignProducts`
--
ALTER TABLE `CampaignProducts`
  ADD PRIMARY KEY (`CampaignProductId`),
  ADD KEY `CampaignProducts_ibfk_1` (`CampaignId`),
  ADD KEY `CampaignProducts_ibfk_2` (`ProductId`);

--
-- Indexes for table `CampaignTagBundle`
--
ALTER TABLE `CampaignTagBundle`
  ADD PRIMARY KEY (`CampaignTagBundleId`),
  ADD KEY `NFCTagBundleId` (`NFCTagBundleId`),
  ADD KEY `CampaignId` (`CampaignId`);

--
-- Indexes for table `CategoryProducts`
--
ALTER TABLE `CategoryProducts`
  ADD PRIMARY KEY (`CategoryProductId`),
  ADD KEY `CategoryProducts_ibfk_1` (`CategoryId`),
  ADD KEY `CategoryProducts_ibfk_2` (`ProductId`);

--
-- Indexes for table `Country`
--
ALTER TABLE `Country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CustomerSolutionFeatures`
--
ALTER TABLE `CustomerSolutionFeatures`
  ADD PRIMARY KEY (`CustomerSolutionFeatureId`),
  ADD KEY `CustomerSolutionFeatures_ibfk_1` (`B2BCustomerId`),
  ADD KEY `CustomerSolutionFeatures_ibfk_2` (`SolutionFeatureId`);

--
-- Indexes for table `CustomerTagManufacturers`
--
ALTER TABLE `CustomerTagManufacturers`
  ADD PRIMARY KEY (`CustomerTagManufacturerId`),
  ADD KEY `CustomerTagManufacturers_ibfk_1` (`B2BCustomerId`),
  ADD KEY `CustomerTagManufacturers_ibfk_2` (`TagManufacturerId`);

--
-- Indexes for table `Level1Territory`
--
ALTER TABLE `Level1Territory`
  ADD PRIMARY KEY (`Level1TerritoryId`),
  ADD KEY `Level1Territory_ibfk_1` (`B2BCustomerId`);

--
-- Indexes for table `Level1TerritoryLevel2Territories`
--
ALTER TABLE `Level1TerritoryLevel2Territories`
  ADD PRIMARY KEY (`Level1TerritoryLevel2TerritoryId`),
  ADD KEY `Level1TerritoryLevel2Territories_ibfk_1` (`Level1TerritoryId`),
  ADD KEY `Level1TerritoryLevel2Territories_ibfk_2` (`Level2TerritoryId`);

--
-- Indexes for table `Level2Territory`
--
ALTER TABLE `Level2Territory`
  ADD PRIMARY KEY (`Level2TerritoryId`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `NFCTag`
--
ALTER TABLE `NFCTag`
  ADD PRIMARY KEY (`NFCTagId`);

--
-- Indexes for table `NFCTagBundle`
--
ALTER TABLE `NFCTagBundle`
  ADD PRIMARY KEY (`NFCTagBundleId`);

--
-- Indexes for table `SolutionFeature`
--
ALTER TABLE `SolutionFeature`
  ADD PRIMARY KEY (`SolutionFeatureId`);

--
-- Indexes for table `TagManufacturer`
--
ALTER TABLE `TagManufacturer`
  ADD PRIMARY KEY (`TagManufacturerId`),
  ADD KEY `TagManufacturer_ibfk_1` (`CountryId`),
  ADD KEY `TagManufacturer_ibfk_2` (`OwnerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ApplicationOwner`
--
ALTER TABLE `ApplicationOwner`
  MODIFY `OwnerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `B2BCustomer`
--
ALTER TABLE `B2BCustomer`
  MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `B2BCustomerCampaign`
--
ALTER TABLE `B2BCustomerCampaign`
  MODIFY `CampaignId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `B2BCustomerCategory`
--
ALTER TABLE `B2BCustomerCategory`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `B2BCustomerProduct`
--
ALTER TABLE `B2BCustomerProduct`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `CampaignLevel1Territory`
--
ALTER TABLE `CampaignLevel1Territory`
  MODIFY `CampaignLevel1TerritoryId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `CampaignLevel2Territory`
--
ALTER TABLE `CampaignLevel2Territory`
  MODIFY `CampaignLevel2TerritoryId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `CampaignProducts`
--
ALTER TABLE `CampaignProducts`
  MODIFY `CampaignProductId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `CampaignTagBundle`
--
ALTER TABLE `CampaignTagBundle`
  MODIFY `CampaignTagBundleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `CategoryProducts`
--
ALTER TABLE `CategoryProducts`
  MODIFY `CategoryProductId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Country`
--
ALTER TABLE `Country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `CustomerSolutionFeatures`
--
ALTER TABLE `CustomerSolutionFeatures`
  MODIFY `CustomerSolutionFeatureId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `CustomerTagManufacturers`
--
ALTER TABLE `CustomerTagManufacturers`
  MODIFY `CustomerTagManufacturerId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Level1Territory`
--
ALTER TABLE `Level1Territory`
  MODIFY `Level1TerritoryId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Level1TerritoryLevel2Territories`
--
ALTER TABLE `Level1TerritoryLevel2Territories`
  MODIFY `Level1TerritoryLevel2TerritoryId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Level2Territory`
--
ALTER TABLE `Level2Territory`
  MODIFY `Level2TerritoryId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `NFCTag`
--
ALTER TABLE `NFCTag`
  MODIFY `NFCTagId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `NFCTagBundle`
--
ALTER TABLE `NFCTagBundle`
  MODIFY `NFCTagBundleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `SolutionFeature`
--
ALTER TABLE `SolutionFeature`
  MODIFY `SolutionFeatureId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `TagManufacturer`
--
ALTER TABLE `TagManufacturer`
  MODIFY `TagManufacturerId` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ApplicationOwner`
--
ALTER TABLE `ApplicationOwner`
  ADD CONSTRAINT `ApplicationOwner_ibfk_1` FOREIGN KEY (`CountryId`) REFERENCES `Country` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `B2BCustomer`
--
ALTER TABLE `B2BCustomer`
  ADD CONSTRAINT `B2BCustomer_ibfk_1` FOREIGN KEY (`ApplicationOwnerOwnerId`) REFERENCES `ApplicationOwner` (`OwnerId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `B2BCustomer_ibfk_2` FOREIGN KEY (`CountryId`) REFERENCES `Country` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `B2BCustomerCampaign`
--
ALTER TABLE `B2BCustomerCampaign`
  ADD CONSTRAINT `B2BCustomerCampaign_ibfk_1` FOREIGN KEY (`B2BCustomerId`) REFERENCES `B2BCustomer` (`CustomerId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `B2BCustomerCategory`
--
ALTER TABLE `B2BCustomerCategory`
  ADD CONSTRAINT `B2BCustomerCategory_ibfk_1` FOREIGN KEY (`B2BCustomerId`) REFERENCES `B2BCustomer` (`CustomerId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `B2BCustomerProduct`
--
ALTER TABLE `B2BCustomerProduct`
  ADD CONSTRAINT `B2BCustomerProduct_ibfk_1` FOREIGN KEY (`B2BCustomerId`) REFERENCES `B2BCustomer` (`CustomerId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `CampaignLevel1Territory`
--
ALTER TABLE `CampaignLevel1Territory`
  ADD CONSTRAINT `CampaignLevel1Territory_ibfk_1` FOREIGN KEY (`CampaignId`) REFERENCES `B2BCustomerCampaign` (`CampaignId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `CampaignLevel1Territory_ibfk_2` FOREIGN KEY (`Level1TerritoryId`) REFERENCES `Level1Territory` (`Level1TerritoryId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `CampaignLevel2Territory`
--
ALTER TABLE `CampaignLevel2Territory`
  ADD CONSTRAINT `CampaignLevel2Territory_ibfk_1` FOREIGN KEY (`Level2TerritoryId`) REFERENCES `Level2Territory` (`Level2TerritoryId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `CampaignLevel2Territory_ibfk_2` FOREIGN KEY (`CampaignLevel1TerritoryId`) REFERENCES `CampaignLevel1Territory` (`CampaignLevel1TerritoryId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `CampaignProducts`
--
ALTER TABLE `CampaignProducts`
  ADD CONSTRAINT `CampaignProducts_ibfk_1` FOREIGN KEY (`CampaignId`) REFERENCES `B2BCustomerCampaign` (`CampaignId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `CampaignProducts_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `B2BCustomerProduct` (`ProductId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `CampaignTagBundle`
--
ALTER TABLE `CampaignTagBundle`
  ADD CONSTRAINT `CampaignTagBundle_ibfk_1` FOREIGN KEY (`NFCTagBundleId`) REFERENCES `NFCTagBundle` (`NFCTagBundleId`),
  ADD CONSTRAINT `CampaignTagBundle_ibfk_2` FOREIGN KEY (`CampaignId`) REFERENCES `B2BCustomerCampaign` (`CampaignId`);

--
-- Constraints for table `CategoryProducts`
--
ALTER TABLE `CategoryProducts`
  ADD CONSTRAINT `CategoryProducts_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `B2BCustomerCategory` (`CategoryId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `CategoryProducts_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `B2BCustomerProduct` (`ProductId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `CustomerSolutionFeatures`
--
ALTER TABLE `CustomerSolutionFeatures`
  ADD CONSTRAINT `CustomerSolutionFeatures_ibfk_1` FOREIGN KEY (`B2BCustomerId`) REFERENCES `B2BCustomer` (`CustomerId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `CustomerSolutionFeatures_ibfk_2` FOREIGN KEY (`SolutionFeatureId`) REFERENCES `SolutionFeature` (`SolutionFeatureId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `CustomerTagManufacturers`
--
ALTER TABLE `CustomerTagManufacturers`
  ADD CONSTRAINT `CustomerTagManufacturers_ibfk_1` FOREIGN KEY (`B2BCustomerId`) REFERENCES `B2BCustomer` (`CustomerId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `CustomerTagManufacturers_ibfk_2` FOREIGN KEY (`TagManufacturerId`) REFERENCES `TagManufacturer` (`TagManufacturerId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Level1Territory`
--
ALTER TABLE `Level1Territory`
  ADD CONSTRAINT `Level1Territory_ibfk_1` FOREIGN KEY (`B2BCustomerId`) REFERENCES `B2BCustomer` (`CustomerId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Level1TerritoryLevel2Territories`
--
ALTER TABLE `Level1TerritoryLevel2Territories`
  ADD CONSTRAINT `Level1TerritoryLevel2Territories_ibfk_1` FOREIGN KEY (`Level1TerritoryId`) REFERENCES `Level1Territory` (`Level1TerritoryId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `Level1TerritoryLevel2Territories_ibfk_2` FOREIGN KEY (`Level2TerritoryId`) REFERENCES `Level2Territory` (`Level2TerritoryId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `TagManufacturer`
--
ALTER TABLE `TagManufacturer`
  ADD CONSTRAINT `TagManufacturer_ibfk_1` FOREIGN KEY (`CountryId`) REFERENCES `Country` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `TagManufacturer_ibfk_2` FOREIGN KEY (`OwnerId`) REFERENCES `ApplicationOwner` (`OwnerId`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
