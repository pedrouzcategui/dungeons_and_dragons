DROP DATABASE IF EXISTS dungeons_and_dragons;

CREATE DATABASE dungeons_and_dragons;
USE dungeons_and_dragons;

CREATE TABLE chapters (
  id INT AUTO_INCREMENT,
  name VARCHAR(255),
  description TEXT,
  background_image_name TEXT,
  music_file_name TEXT,
  PRIMARY KEY (id)
);

CREATE TABLE classes (
  id INT AUTO_INCREMENT,
  name VARCHAR(255),
  attack INT,
  defense INT,
  luck INT,
  honor INT,
  PRIMARY KEY (id)
);

CREATE TABLE items (
  id INT AUTO_INCREMENT,
  name TEXT,
  image_name TEXT,
  PRIMARY KEY (id)
);

CREATE TABLE endings (
    id INT AUTO_INCREMENT,
    name VARCHAR(255),
    description TEXT,
    image_name TEXT,
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
  is_dice_throw BOOLEAN DEFAULT FALSE,
  is_reward BOOLEAN DEFAULT FALSE,
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
  is_game_completed BOOLEAN DEFAULT FALSE,
  ending_id INT DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (class_id) REFERENCES classes(id),
  FOREIGN KEY (current_chapter) REFERENCES chapters(id),
  FOREIGN KEY (current_dialogue_node) REFERENCES dialogue(id),
  FOREIGN KEY (ending_id) REFERENCES endings(id)
);

-- TODO FOR TODAY::

CREATE TABLE dialogue_dice_throws (
  id INT AUTO_INCREMENT,
  dialogue_id INT,
  dice_threshold BOOLEAN DEFAULT NULL,
  next_dialogue_id_if_threshold_exceeded INT DEFAULT NULL,
  next_dialogue_id_if_threshold_failed INT DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (dialogue_id) REFERENCES dialogue(id),
  FOREIGN KEY (next_dialogue_id_if_threshold_exceeded) REFERENCES dialogue(id),
  FOREIGN KEY (next_dialogue_id_if_threshold_failed) REFERENCES dialogue(id)
);

CREATE TABLE rewards (
  id INT AUTO_INCREMENT,
  dialogue_id INT,
  is_item BOOLEAN DEFAULT FALSE,
  item_id INT,
  PRIMARY KEY (id),
  FOREIGN KEY (dialogue_id) REFERENCES dialogue(id),
  FOREIGN KEY (item_id) REFERENCES items(id)
);

CREATE TABLE character_items (
  id INT AUTO_INCREMENT,
  character_id INT,
  item_id INT,
  PRIMARY KEY (id),
  FOREIGN KEY (character_id) REFERENCES characters(id),
  FOREIGN KEY (item_id) REFERENCES items(id)
);

-- TODO FOR TODAY (END) 

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
