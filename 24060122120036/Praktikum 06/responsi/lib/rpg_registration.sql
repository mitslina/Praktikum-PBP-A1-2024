-- Struktur dari tabel `tb_races`
CREATE TABLE `tb_races` (
    `race_id` INT AUTO_INCREMENT PRIMARY KEY,
    `race_name` VARCHAR(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Struktur dari tabel `tb_classes`
CREATE TABLE `tb_classes` (
    `class_id` INT AUTO_INCREMENT PRIMARY KEY,
    `class_name` VARCHAR(50) NOT NULL,
    `race_id` INT
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Struktur dari tabel `tb_characters`
CREATE TABLE `tb_characters` (
    `character_id` INT AUTO_INCREMENT PRIMARY KEY,
    `player_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `strength` INT NOT NULL,
    `agility` INT NOT NULL,
    `intelligence` INT NOT NULL,
    `profile_picture` VARCHAR(255),
    `race_id` INT,
    `class_id` INT
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Insert races
INSERT INTO `tb_races` (`race_id`, `race_name`) VALUES
(1, 'Human'),
(2, 'Elf'),
(3, 'Orc'),
(4, 'Goblin'),
(5, 'Dwarf'),
(6, 'Undead'),
(7, 'Beastkin'),
(8, 'Dragonkin');

-- Insert classes
INSERT INTO `tb_classes` (`class_id`, `class_name`, `race_id`) VALUES
(1, 'Warrior', 1), (2, 'Mage', 1), (3, 'Rogue', 1),
(4, 'Paladin', 2), (5, 'Druid', 2), (6, 'Sorcerer', 2),
(7, 'Shaman', 3), (8, 'Hunter', 3), (9, 'Bard', 3),
(10, 'Warlock', 4), (11, 'Monk', 4), (12, 'Berserker', 4),
(13, 'Knight', 5), (14, 'Cleric', 5), (15, 'Alchemist', 5),
(16, 'Assassin', 6), (17, 'Necromancer', 6), (18, 'Ranger', 6),
(19, 'Brawler', 7), (20, 'Beastmaster', 7),
(21, 'Elementalist', 8), (22, 'Dragon Knight', 8), (23, 'Psion', 8);


-- Alter tables to add foreign keys
ALTER TABLE `tb_classes`
  ADD CONSTRAINT `fk_tb_classes_race` FOREIGN KEY (`race_id`) REFERENCES `tb_races`(`race_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tb_characters`
  ADD CONSTRAINT `fk_tb_characters_race` FOREIGN KEY (`race_id`) REFERENCES `tb_races`(`race_id`)
  ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_characters_class` FOREIGN KEY (`class_id`) REFERENCES `tb_classes`(`class_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;
