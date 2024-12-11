-- Create the database
DROP DATABASE IF EXISTS rpg_registration;
CREATE DATABASE rpg_registration;

-- Use the database
USE rpg_registration;

-- Create races table
CREATE TABLE tb_races (
    race_id INT AUTO_INCREMENT PRIMARY KEY,
    race_name VARCHAR(50) NOT NULL
);

-- Insert races
INSERT INTO tb_races (race_id, race_name) VALUES
(1, 'Human'),
(2, 'Elf'),
(3, 'Orc'),
(4, 'Goblin'),
(5, 'Dwarf'),
(6, 'Undead'),
(7, 'Beastkin'),
(8, 'Dragonkin');

-- Create classes table
CREATE TABLE tb_classes (
    class_id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(50) NOT NULL,
    race_id INT,
    FOREIGN KEY (race_id) REFERENCES tb_races(race_id) ON DELETE CASCADE
);

-- Insert classes
INSERT INTO tb_classes (class_id, class_name, race_id) VALUES
(1, 'Warrior', 1),      -- Human
(2, 'Mage', 1),         -- Human
(3, 'Rogue', 1),        -- Human
(4, 'Paladin', 2),      -- Elf
(5, 'Druid', 2),        -- Elf
(6, 'Sorcerer', 2),     -- Elf
(7, 'Shaman', 3),       -- Orc
(8, 'Hunter', 3),       -- Orc
(9, 'Bard', 3),         -- Orc
(10, 'Warlock', 4),     -- Goblin
(11, 'Monk', 4),        -- Goblin
(12, 'Berserker', 4),   -- Goblin
(13, 'Knight', 5),      -- Dwarf
(14, 'Cleric', 5),      -- Dwarf
(15, 'Alchemist', 5),   -- Dwarf
(16, 'Assassin', 6),    -- Undead
(17, 'Necromancer', 6), -- Undead
(18, 'Ranger', 6),      -- Undead
(19, 'Brawler', 7),     -- Beastkin
(20, 'Beastmaster', 7), -- Beastkin
(21, 'Elementalist', 8),-- Dragonkin
(22, 'Dragon Knight', 8),-- Dragonkin
(23, 'Psion', 8);       -- Dragonkin

-- Create characters table
CREATE TABLE tb_characters (
    character_id INT AUTO_INCREMENT PRIMARY KEY,
    player_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    strength INT NOT NULL,
    agility INT NOT NULL,
    intelligence INT NOT NULL,
    profile_picture VARCHAR(255),
    race_id INT,
    class_id INT,
    FOREIGN KEY (race_id) REFERENCES tb_races(race_id) ON DELETE CASCADE,
    FOREIGN KEY (class_id) REFERENCES tb_classes(class_id) ON DELETE CASCADE
);
