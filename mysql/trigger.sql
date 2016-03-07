DELIMITER //

# # 
#	CLASSES 
# #

# UPDATE
DROP TRIGGER IF EXISTS TypesUpdate // 
CREATE TRIGGER TypesUpdate
AFTER UPDATE ON Classes 
FOR EACH ROW BEGIN 		
UPDATE Types SET type = NEW.class where type = OLD.class and package = OLD.package;
END; //

# INSERT
DROP TRIGGER IF EXISTS TypesInsert // 
CREATE TRIGGER TypesInsert
AFTER INSERT ON Classes
FOR EACH ROW BEGIN 		
INSERT INTO Types VALUES (NEW.class, NEW.package);
END; //

# DELETE
DROP TRIGGER IF EXISTS TypesDelete // 
CREATE TRIGGER TypesDelete
AFTER DELETE ON Classes
FOR EACH ROW BEGIN 		
DELETE FROM Types WHERE type = OLD.class and package = OLD.package;
END; //

# DELETE
DROP TRIGGER IF EXISTS PackageDelete //
CREATE TRIGGER PackageDelete
BEFORE DELETE ON Packages
FOR EACH ROW BEGIN
DELETE FROM Types where type in (SELECT class FROM Classes where package = OLD.package);
END; //

DELIMITER ;