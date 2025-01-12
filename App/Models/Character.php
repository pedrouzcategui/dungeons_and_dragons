<?php

namespace App\Models;

use App\Database as DB;
use App\Utils;
use App\Models\CharacterClass;

class Character
{
    private $id;
    private $name;
    private $class_id;
    // Default chapter for new characters
    private $chapter = 1;
    private $dialogue_node = 1;

    function __construct($id, $name, $class, $chapter = 1, $dialogue_node = 1)
    {
        //Using setters in construct
        $this->setId($id);
        $this->setName($name);
        $this->setClass($class);
        $this->setChapter($chapter);
        $this->setDialogueNode($dialogue_node);
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getClassId()
    {
        return $this->class_id;
    }
    public function getCurrentChapter()
    {
        return $this->chapter;
    }
    public function getDialogueNode()
    {
        return $this->dialogue_node;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setClass($class_id)
    {
        $this->class_id = $class_id;
    }
    public function setChapter($chapter)
    {
        $this->chapter = $chapter;
    }
    public function setDialogueNode($dialogue_node)
    {
        $this->dialogue_node = $dialogue_node;
    }

    // Utils
    public static function getCharacterByID($id)
    {
        $result = DB::query("SELECT * FROM characters WHERE id = $id");
        return new self($result[0]['id'], $result[0]['name'], $result[0]['class_id'], $result[0]['current_chapter'], $result[0]['current_dialogue_node']);
    }

    public static function findById($id)
    {
        return DB::query("SELECT * FROM characters WHERE id = $id");
    }

    public function create(): bool|array
    {
        $result = DB::query(
            "INSERT INTO characters (name, class_id, current_chapter, current_dialogue_node) VALUES (?, ?, ?, ?)",
            [$this->getName(), $this->getClassId(), $this->getCurrentChapter(), $this->getDialogueNode()]
        );

        return $result;
    }

    public function update($currentChapter, $currentDialogueNode)
    {
        $this->setChapter($currentChapter);
        $this->setDialogueNode($currentDialogueNode);

        // Update the database record
        $query = "UPDATE characters SET current_chapter = ?, current_dialogue_node = ? WHERE id = ?";
        return DB::query($query, [$this->chapter, $this->dialogue_node, $this->id]);
    }

    public static function getAll()
    {
        $result = DB::query("SELECT * FROM characters ORDER BY id ASC");
        $characters = [];
        foreach ($result as $character) {
            array_push($characters, new self($character['id'], $character['name'], $character['class_id'], $character['current_chapter']));
        }
        return $characters;
    }

    public function getCharacterClassName()
    {
        return CharacterClass::findById($this->getClassId())->getName();
    }
}
