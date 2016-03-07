DROP DATABASE IF EXISTS `Trender`;
CREATE DATABASE `Trender`;
USE Trender;

# ADMINISTRATORS

DROP TABLE IF EXISTS `Admin`;
CREATE TABLE `Admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


# ACTORS

DROP TABLE IF EXISTS `Actors`;
CREATE TABLE `Actors` (
  `actor` varchar(50) NOT NULL,
  `note` varchar(3000),
  PRIMARY KEY (`actor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# RELATION: ACTORS - ACTORS

DROP TABLE IF EXISTS `ActorsInheritance`;
CREATE TABLE `ActorsInheritance` (
  `base` varchar(50) NOT NULL,
  `derivative` varchar(50) NOT NULL,
  PRIMARY KEY (`base`,`derivative`),
  FOREIGN KEY (`base`) REFERENCES `Actors` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`derivative`) REFERENCES `Actors` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# USECASES

DROP TABLE IF EXISTS `Usecases`;
CREATE TABLE `Usecases` (
  `usecase` varchar(100) NOT NULL,
  `dad` varchar(100),
  `title` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `type` varchar(10),
  `precondition` varchar(2000) NOT NULL,
  `postcondition` varchar(2000) NOT  NULL,
  `imagePath` varchar(500),
  `didascalia` varchar(255),
  `scene` varchar(2000),
  `alternativeScene` varchar(2000),
  PRIMARY KEY (`usecase`),
  FOREIGN KEY (`dad`) REFERENCES `Usecases` (`usecase`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# RELATION: ACTORS - USECASES

DROP TABLE IF EXISTS `ActorUsecases`;
CREATE TABLE `ActorUsecases` (
  `actor` varchar(50) NOT NULL,
  `usecase` varchar(100) NOT NULL,
  PRIMARY KEY (`actor`,`usecase`),
  FOREIGN KEY (`actor`) REFERENCES `Actors` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`usecase`) REFERENCES `Usecases` (`usecase`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# VERBALS

DROP TABLE IF EXISTS `Verbals`;
CREATE TABLE `Verbals` (
  `date` date NOT NULL,
  `text` longtext,
  PRIMARY KEY (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# RELATION USECASES - VERBALS

DROP TABLE IF EXISTS `UsecasesVerbals`;
CREATE TABLE `UsecasesVerbals` (
  `usecase` varchar(100) NOT NULL,
  `verbal` date NOT NULL,
  PRIMARY KEY (`usecase`,`verbal`),
  FOREIGN KEY (`usecase`) REFERENCES `Usecases` (`usecase`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`verbal`) REFERENCES `Verbals` (`date`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# PACKAGES

DROP TABLE IF EXISTS `Packages`;
CREATE TABLE `Packages` (
  `package` varchar(100) NOT NULL,
  `dad` varchar(100),
  `description` varchar(2000) NOT NULL,
  `imagePath` varchar(500),
  `didascalia` varchar(255),
  PRIMARY KEY (`package`),
  FOREIGN KEY (`dad`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# CLASSES

DROP TABLE IF EXISTS `Classes`;
CREATE TABLE `Classes` (
  `class` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `applications` longtext NOT NULL,
  `package` varchar(100) NOT NULL,
  PRIMARY KEY (`class`,`package`),
  FOREIGN KEY (`package`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# TYPES (default types and user's type)
# Note: There is a trigger associated with Classes table
# to obviate the relation problem. Type are composed by
# default and users's type so we can't do a foreign key 
# on Classes.

DROP TABLE IF EXISTS `Types`;
CREATE TABLE `Types` (
  `type` varchar(100) NOT NULL,
  `package` varchar(100) NOT NULL,
  PRIMARY KEY (`type`),
  FOREIGN KEY (`package`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# CLASS ATTRIBUTES

DROP TABLE IF EXISTS `ClassAttributes`;
CREATE TABLE `ClassAttributes` (
  `class` varchar(100) NOT NULL,
  `attribute` varchar(50) NOT NULL,
  `type` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `package` varchar(100) NOT NULL,
  PRIMARY KEY (`class`,`package`,`attribute`),
  FOREIGN KEY (`class`,`package`) REFERENCES `Classes` (`class`,`package`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`type`) REFERENCES `Types` (`type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# CLASS METHODS

DROP TABLE IF EXISTS `ClassMethods`;
CREATE TABLE `ClassMethods` (
  `class` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `returnType` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `package` varchar(100) NOT NULL,
  PRIMARY KEY (`class`,`signature`,`returnType`, `package`),
  FOREIGN KEY (`class`,`package`) REFERENCES `Classes` (`class`,`package`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`returnType`) REFERENCES `Types` (`type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# CLASS METHODS PARAM

DROP TABLE IF EXISTS `ClassMethodsParams`;
CREATE TABLE `ClassMethodsParams` (
`class` varchar(100) NOT NULL,
`package` varchar(100) NOT NULL,
`signature` varchar(100) NOT NULL,
`returnType` varchar(100) NOT NULL,
`param` varchar(50) NOT NULL,
`paramType` varchar(100) NOT NULL,
`description` longtext NOT NULL,
PRIMARY KEY (`class`,`signature`,`returnType`, `package`, `param`),
FOREIGN KEY (`class`,`package`, `signature`, `returnType`) REFERENCES `ClassMethods` (`class`, `package`, `signature`, `returnType`) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`paramType`) REFERENCES `Types` (`type`) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (`returnType`) REFERENCES `Types` (`type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


# CLASS RELACTIONS

DROP TABLE IF EXISTS `ClassRelations`;
CREATE TABLE `ClassRelations` (
  `classStart` varchar(100) NOT NULL,
  `packageStart` varchar(100) NOT NULL,
  `classEnd` varchar(100) NOT NULL,
  `packageEnd` varchar(100) NOT NULL,
  `relation` varchar(15) NOT NULL,
  PRIMARY KEY (`classStart`,`packageStart`,`classEnd`,`packageEnd`,`relation`),
  FOREIGN KEY (`classStart`) REFERENCES `Classes` (`class`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`packageStart`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`classEnd`) REFERENCES `Classes` (`class`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`packageEnd`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# CLASS TESTS (unit test)

DROP TABLE IF EXISTS `UnitTests`;
CREATE TABLE `UnitTests` (
  `test` tinyint(255) NOT NULL,
  `description` longtext NOT NULL,
  `implemented` varchar(15) NOT NULL,
  `satisfied` varchar(15) NOT NULL,
  PRIMARY KEY (`test`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# CLASS TESTS COMBINED

DROP TABLE IF EXISTS `UnitTestClassesMethods`;
CREATE TABLE `UnitTestClassesMethods` (
  `test` tinyint(255) NOT NULL,
  `class` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `returnType` varchar(100) NOT NULL,
  `package` varchar(100) NOT NULL,
  PRIMARY KEY (`test`, `class`,`signature`,`returnType`, `package`),
  FOREIGN KEY (`test`) REFERENCES `UnitTests` (`test`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`class`) REFERENCES `Classes` (`class`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`package`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`returnType`) REFERENCES `Types` (`type`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`class`, `signature`, `returnType`, `package`) REFERENCES `ClassMethods` (`class`, `signature`, `returnType`, `package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# GLOSSARY

DROP TABLE IF EXISTS `Glossario`;
CREATE TABLE `Glossario` (
  `voice` varchar(100) NOT NULL,
  `definition` longtext NOT NULL,
  PRIMARY KEY (`voice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# RELATION: CLASS INHERITANCE

DROP TABLE IF EXISTS `ClassInheritance`;
CREATE TABLE `ClassInheritance` (
  `base` varchar(100) NOT NULL,
  `derivative` varchar(100) NOT NULL,
  `basePackage` varchar(100) NOT NULL,
  `derivativePackage` varchar(100) NOT NULL,
  PRIMARY KEY (`base`,`derivative`,`basePackage`,`derivativePackage`),
  FOREIGN KEY (`base`) REFERENCES `Classes` (`class`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`derivative`) REFERENCES `Classes` (`class`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`basePackage`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`derivativePackage`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# RELATION: PACKAGE INTERACTIONS

DROP TABLE IF EXISTS `PackagesInteractions`;
CREATE TABLE `PackageInteractions` (
  `packageA` varchar(100) NOT NULL,
  `packageB` varchar(100) NOT NULL,
  `interaction` longtext NOT NULL,
  PRIMARY KEY (`packageA`,`packageB`),
  FOREIGN KEY (`packageA`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`packageB`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# REQUIREMENTS SOURCES

DROP TABLE IF EXISTS `RequirementSources`;
CREATE TABLE `RequirementSources` (
  `source` varchar(50) NOT NULL,
  PRIMARY KEY (`source`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# REQUIREMENTS

DROP TABLE IF EXISTS `Requirements`;
CREATE TABLE `Requirements` (
  `requirement` varchar(100) NOT NULL,
  `dad` varchar(100),
  `description` longtext NOT NULL,
  `source` varchar(50) NOT NULL,
  `satisfied` varchar(15),
  PRIMARY KEY (`requirement`),
  FOREIGN KEY (`dad`) REFERENCES `Requirements` (`requirement`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`source`) REFERENCES `RequirementSources` (`source`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# RELATION: PACKAGE - REQUIREMENTS

DROP TABLE IF EXISTS `PackagesRequirements`;
CREATE TABLE `PackagesRequirements` (
  `package` varchar(100) NOT NULL,
  `requirement` varchar(100) NOT NULL,
  PRIMARY KEY (`package`,`requirement`),
  FOREIGN KEY (`package`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`requirement`) REFERENCES `Requirements` (`requirement`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# PACKAGE TESTS (integration test)

DROP TABLE IF EXISTS `IntegrationTest`;
CREATE TABLE `IntegrationTest` (
  `idTest` tinyint(255) AUTO_INCREMENT,
  `package` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `implemented` varchar(15) NOT NULL,
  `satisfied` varchar(15) NOT NULL,
  PRIMARY KEY (`IdTest`,`package`),
  FOREIGN KEY (`package`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# RELATION: REQUIREMENTS - CLASSES

DROP TABLE IF EXISTS `RequirementsClasses`;
CREATE TABLE `RequirementsClasses` (
  `requirement` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  `package` varchar(100) NOT NULL,
  PRIMARY KEY (`requirement`,`class`,`package`),
  FOREIGN KEY (`requirement`) REFERENCES `Requirements` (`requirement`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`class`, `package`) REFERENCES `Classes` (`class`, `package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# REQUIREMENT TEST (system test)

DROP TABLE IF EXISTS `SystemTests`;
CREATE TABLE `SystemTests` (
  `requirement` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `implemented` varchar(15) NOT NULL,
  `satisfied` varchar(15) NOT NULL,
  PRIMARY KEY (`requirement`),
  FOREIGN KEY (`requirement`) REFERENCES `Requirements` (`requirement`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# VALIDATION TEST

DROP TABLE IF EXISTS `ValidationTest`;
CREATE TABLE `ValidationTest` (
  `requirement` varchar(100) NOT NULL,
  `test` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `implemented` varchar(15) NOT NULL,
  `satisfied` varchar(15) NOT NULL,
  PRIMARY KEY (`test`),
  FOREIGN KEY (`requirement`) REFERENCES `Requirements` (`requirement`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# VALIDATION TEST STEP

DROP TABLE IF EXISTS `ValidationTestStep`;
CREATE TABLE `ValidationTestStep` (
  `test` varchar(100) NOT NULL,
  `stepNumber` varchar(100) NOT NULL,
  `stepDescription` longtext NOT NULL,
  PRIMARY KEY (`test`, `stepNumber`),
  FOREIGN KEY (`test`) REFERENCES `ValidationTest` (`test`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# RELATION: REQUIREMENT - USECASE

DROP TABLE IF EXISTS `RequirementsUsecases`;
CREATE TABLE `RequirementsUsecases` (
  `requirement` varchar(100) NOT NULL,
  `usecase` varchar(100) NOT NULL,
  PRIMARY KEY (`requirement`,`usecase`),
  FOREIGN KEY (`requirement`) REFERENCES `Requirements` (`requirement`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`usecase`) REFERENCES `Usecases` (`usecase`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# RELATION: REQUIREMENTS - VERBALS

DROP TABLE IF EXISTS `RequirementsVerbal`;
CREATE TABLE `RequirementsVerbal` (
  `requirement` varchar(100) NOT NULL DEFAULT '',
  `verbal` date NOT NULL,
  PRIMARY KEY (`requirement`,`verbal`),
  FOREIGN KEY (`requirement`) REFERENCES `Requirements` (`requirement`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`verbal`) REFERENCES `Verbals` (`date`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# PRINT SETTINGS

DROP TABLE IF EXISTS `Settings_prints`;
CREATE TABLE `Settings_Prints` (
  `voice` VARCHAR(100) NOT NULL,
  `active` BOOLEAN DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# GLOSSARY TERMS

DROP TABLE IF EXISTS `Glossary`;
CREATE TABLE `Glossary` (
  `term` varchar(100) NOT NULL,
  `explanation` varchar(5000) NOT NULL,
  PRIMARY KEY (`term`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;