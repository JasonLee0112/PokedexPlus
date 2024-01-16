
CREATE TABLE `comment` (`Body` TEXT NOT NULL , `commentID` INT NOT NULL AUTO_INCREMENT , `Dislikes` INT NOT NULL , `Likes` INT NOT NULL , `Title` TEXT NOT NULL , PRIMARY KEY (`commentID`)) ENGINE = InnoDB;

CREATE TABLE `comment-belongs-to-forum` (`comment_ID` INT NOT NULL , `forum_post_ID` INT NOT NULL ) ENGINE = InnoDB;

CREATE TABLE `ForumPost` (`Body` TEXT NOT NULL , `forumPostID` INT NOT NULL AUTO_INCREMENT , `Dislikes` INT NOT NULL , `Likes` INT NOT NULL , `Title` TEXT NOT NULL , PRIMARY KEY (`forumPostID`)) ENGINE = InnoDB;

CREATE TABLE `Item` (`Category` TEXT NOT NULL , `Effect` TEXT NOT NULL , `ItemName` TEXT NOT NULL , PRIMARY KEY (`ItemName`(50))) ENGINE = InnoDB;

CREATE TABLE `Moves` (`Accuracy` TEXT NOT NULL ,`Category` TEXT NOT NULL , `Effect` TEXT NOT NULL , `Hit Chance` TEXT NOT NULL ,`MoveID` INT NOT NULL , `Name` TEXT NOT NULL , `Power` TEXT NOT NULL , `PP` TEXT NOT NULL , `Type` TEXT NOT NULL ,PRIMARY KEY (`MoveID`)) ENGINE = InnoDB;

CREATE TABLE `Pokemon` (`Abilities` TEXT NOT NULL ,`Attack` TEXT NOT NULL , `Defense` TEXT NOT NULL , `HP` INT NOT NULL ,`Moves` TEXT NOT NULL , `PokeName` TEXT NOT NULL , `SpecialAttack` TEXT NOT NULL , `SpecialDefense` TEXT NOT NULL , `Speed` TEXT NOT NULL , `Types` TEXT NOT NULL , PRIMARY KEY (`PokeName`(50))) ENGINE = InnoDB;

CREATE TABLE `Pokemon Abilities` (`AbilityName` VARCHAR(500) NOT NULL , `Description` Text        NOT NULL ) ENGINE = InnoDB; 

CREATE TABLE `PokemonTeam` (`Pokemon1` TEXT NOT NULL , `Pokemon2` Text        NOT NULL,`Pokemon3` TEXT NOT NULL ,`Pokemon4` TEXT NOT NULL , `Pokemon5` TEXT NOT NULL `Pokemon6` TEXT NOT NULL ,`TeamID` INT NOT NULL, `TeamName` TEXT NOT NULL ,PRIMARY KEY (`TeamID`)) ENGINE = InnoDB;        


CREATE TABLE `pokemonTeam_belongsTo_Account` (`email` TEXT NOT NULL , `TeamID` INT NOT NULL ) ENGINE = InnoDB; 
CREATE TABLE `Pokemon Type` (`Name` VARCHAR NOT NULL , `Type1` VARCHAR NOT NULL,`Type1` VARCHAR NOT NULL, PRIMARY KEY (`Name`)) ENGINE = InnoDB; 

CREATE TABLE `pokemonTeam_belongsTo_team` (`pokemon_name` TEXT NOT NULL , `teamID` INT NOT NULL ) ENGINE = InnoDB; 

CREATE TABLE `admin_regulates_user` (`admin_email` TEXT NOT NULL , `user_email` TEXT NOT NULL ) ENGINE = InnoDB; 

CREATE TABLE `admin_regulates_forums` (`email` TEXT NOT NULL , `forumPostID` INT NOT NULL ) ENGINE = InnoDB; 


CREATE TABLE `account_creates_pokemon` (`email` TEXT NOT NULL , `pokemon_name` TEXT NOT NULL ) ENGINE = InnoDB; 

CREATE TABLE `Account` (`email` TEXT NOT NULL , `is_a_admin` TINYINT  NOT NULL,`password` TEXT NOT NULL ,`userID` INT NOT NULL , `username` TEXT NOT NULL, PRIMARY KEY (`email`(50))) ;      

-- Create new Account
INSERT INTO Account VALUES 
('e@email.com', 'psswrd', 'usrnm', 0);

-- Create new Forum Post
INSERT INTO ForumPost VALUES 
(0, 0, 'a', 'a');

-- Create new Comment
INSERT INTO comment VALUES 
(0, 0, 'a', 'a');

-- Find a pokemon's statistics
SELECT * FROM  Pokemon WHERE name = 'Absol'; 

-- Find a pokemon move
SELECT * FROM Moves WHERE moveID = '1';

-- Find a pokemon ability
SELECT * FROM Abilities WHERE AbilityName = 'Wonder Guard'; 

-- Find a forum post
SELECT * FROM ForumPost WHERE forumPostID = '1';

-- Find a team
SELECT * FROM `Pokemon Team` WHERE Team_name = 'team';
SELECT * FROM `Pokemon Team` WHERE Team_ID = '1';

-- Find a user
SELECT username FROM  Account WHERE username = 'test' OR userID = '0';

-- Delete a team
DELETE * FROM `Pokemon Team` WHERE Team_ID = '1';

-- Delete a forum post
DELETE * FROM ForumPost WHERE forumPostID = '1';

-- Delete a comment
DELETE * FROM comment WHERE commentID = '1';

-- Delete an account
DELETE * FROM Account WHERE userID = '1';

-- Update username
UPDATE Account SET username = 'username' WHERE userID = '1';

-- Change password
UPDATE Account SET password = 'strongpassword' WHERE userID = '0';

-- Update comment body
UPDATE comment SET body = 'b' WHERE commentID = '1';

-- Update forumPost body
UPDATE forumPost SET body = 'b' WHERE forumPostID = '1';


-- Advanced SQL statement:

DELIMITER $$
CREATE PROCEDURE UpdatePokemonTeam(
  IN teamID INT,
  IN teamName TEXT,
  IN pokemon1 TEXT,
  IN pokemon2 TEXT,
  IN pokemon3 TEXT,
  IN pokemon4 TEXT,
  IN pokemon5 TEXT,
  IN pokemon6 TEXT

)
BEGIN
UPDATE PokemonTeam
SET
      TeamName = teamName,
      Pokemon1 = pokemon1,
      Pokemon2 = pokemon2,
      Pokemon3 = pokemon3,
      Pokemon4 = pokemon4,
      Pokemon5 = pokemon5,
      Pokemon6 = pokemon6
WHERE TeamID = teamID;
END //
DELIMITER ;

ALTER TABLE `Pokemon Abilities`
ADD CONSTRAINT Check_PokemonAbilities_Description_Length CHECK (CHAR_LENGTH(Description) >= 5);

ALTER TABLE `Pokemon`
ADD CONSTRAINT Pokemon_Statistics_Greater_Than_Zero CHECK
( HP > 0 AND Attack > 0 AND Defense > 0 AND SpecialAttack > 0 AND SpecialDefense > 0 AND Speed > 0);
