DROP DATABASE IF EXISTS dungeons_and_dragons;

CREATE DATABASE dungeons_and_dragons;
USE dungeons_and_dragons;

CREATE TABLE chapters (
  id INT AUTO_INCREMENT,
  name VARCHAR(255),
  description TEXT,
  PRIMARY KEY (id)
);

CREATE TABLE classes (
  id INT AUTO_INCREMENT,
  name VARCHAR(255),
  PRIMARY KEY (id)
);


CREATE TABLE endings (
    id INT AUTO_INCREMENT,
    name VARCHAR(255),
    description TEXT,
    PRIMARY KEY (id)
);

CREATE TABLE dialogue (
  id INT AUTO_INCREMENT,
  is_character BOOLEAN DEFAULT FALSE,
  character_name TEXT DEFAULT NULL,
  chapter_id INT,
  next_chapter_id INT DEFAULT NULL,
  text TEXT,
  is_decision BOOLEAN DEFAULT FALSE,
  is_final BOOLEAN DEFAULT FALSE,
  is_ending BOOLEAN DEFAULT FALSE,
  ending_id INT DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (chapter_id) REFERENCES chapters(id),
  FOREIGN KEY (next_chapter_id) REFERENCES chapters(id),
  FOREIGN KEY (ending_id) REFERENCES endings(id)
);

CREATE TABLE dialogue_options (
  id INT AUTO_INCREMENT,
  dialogue_id INT,
  text TEXT,
  next_dialogue_id INT,
  PRIMARY KEY (id),
  FOREIGN KEY (dialogue_id) REFERENCES dialogue(id),
  FOREIGN KEY (next_dialogue_id) REFERENCES dialogue(id)
);

CREATE TABLE characters (
  id INT AUTO_INCREMENT,
  class_id INT NOT NULL,
  name VARCHAR(255),
  current_chapter INT,
  current_dialogue_node INT,
  PRIMARY KEY (id),
  FOREIGN KEY (class_id) REFERENCES classes(id),
  FOREIGN KEY (current_chapter) REFERENCES chapters(id),
  FOREIGN KEY (current_dialogue_node) REFERENCES dialogue(id)
);

CREATE TABLE character_stats (
    id INT AUTO_INCREMENT,
    character_id INT NOT NULL,
    health INT DEFAULT 0,
    attack INT DEFAULT 0,
    defense INT DEFAULT 0,
    charisma INT DEFAULT 0,
    honor INT DEFAULT 0,
    PRIMARY KEY (id),
    FOREIGN KEY (character_id) REFERENCES characters(id)
);



-- Seed Classes
INSERT INTO classes (name) VALUES ('Knight');
INSERT INTO classes (name) VALUES ('Archer');
INSERT INTO classes (name) VALUES ('Mage');

-- -- Seed Chapters

-- -- Seed Chapter 1
-- INSERT INTO chapters (name, description) VALUES ('Chapter 1', 'The beginning of your journey.');

-- -- Seed Dialogue for Chapter 1
-- INSERT INTO dialogue (chapter_id, is_character, character_name, text, is_decision)
-- VALUES
-- (1, FALSE, 'Narrator', 'What do you want to eat?', TRUE), -- Dialogue 1
-- (1, FALSE, 'Narrator', 'Great! I will serve you beans.', FALSE), -- Dialogue 2
-- (1, FALSE, 'Narrator', 'Great! I will serve you eggs.', FALSE); -- Dialogue 3

-- -- Seed Options for Dialogue 1
-- INSERT INTO dialogue_options (dialogue_id, text, next_dialogue_id)
-- VALUES
-- (1, 'Beans', 2), -- Option 1: Leads to Dialogue 2
-- (1, 'Eggs', 3);  -- Option 2: Leads to Dialogue 3

-- -- Continue with Chapter 2 to complete the story
-- INSERT INTO chapters (name, description) VALUES ('Chapter 2', 'A reflection of your choices.');

-- -- Seed Dialogue for Chapter 2
-- INSERT INTO dialogue (chapter_id, is_character, character_name, text, is_decision, is_final)
-- VALUES
-- (2, FALSE, 'Narrator', 'So you ate beans!', FALSE, TRUE), -- Dialogue 4
-- (2, FALSE, 'Narrator', 'So you ate eggs!', FALSE, TRUE); -- Dialogue 5
