<?php

namespace App\Models;

use App\Database as DB;
use App\Models\BaseModel;
use App\Models\CharacterClass;
use App\Models\CharacterItem;
use App\Response;

class Character extends BaseModel
{
    private $id;
    private $name;
    private $class_id;
    // Default chapter for new characters
    private $chapter;
    private $dialogue_node;
    private $is_game_completed;
    private $ending_id;

    function __construct($id, $name, $class, $chapter = 1, $dialogue_node = 1, $is_game_completed = FALSE, $ending_id = NULL)
    {
        //Using setters in construct
        $this->setId($id);
        $this->setName($name);
        $this->setClass($class);
        $this->setChapter($chapter);
        $this->setDialogueNode($dialogue_node);
        $this->setIsGameCompleted($is_game_completed);
        $this->setEndingId($ending_id);
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
    public function getIsGameCompleted()
    {
        return $this->is_game_completed;
    }
    public function getEndingId()
    {
        return $this->ending_id;
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
    public function setIsGameCompleted($isCompleted)
    {
        $this->is_game_completed = $isCompleted;
    }
    public function setEndingId($endingId)
    {
        $this->ending_id = $endingId;
    }

    // Utils
    public static function getCharacterByID($id)
    {
        try {
            $result = DB::query("SELECT * FROM characters WHERE id = $id")[0];
            return new self(
                $result['id'],
                $result['name'],
                $result['class_id'],
                $result['current_chapter'],
                $result['current_dialogue_node'],
                $result['is_game_completed'],
                $result['ending_id']
            );
        } catch (\Throwable $th) {
            Response::error($th);
        }
    }

    public static function findById($id)
    {
        // This should return the instance instead.
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

    public function update($currentChapter, $currentDialogueNode, $is_game_completed = FALSE, $ending_id = NULL)
    {
        $this->setChapter($currentChapter);
        $this->setDialogueNode($currentDialogueNode);
        $this->setIsGameCompleted($is_game_completed);
        $this->setEndingId($ending_id);

        // Update the database record
        $query = "UPDATE characters SET current_chapter = ?, current_dialogue_node = ?, is_game_completed = ?, ending_id = ? WHERE id = ?";
        return DB::query($query, [$this->getCurrentChapter(), $this->getDialogueNode(), $this->getIsGameCompleted(), $this->getEndingId(), $this->id]);
    }

    public static function deleteById($id)
    {
        try {
            $query = "DELETE FROM characters WHERE id = ?";
            return DB::query($query, [$id]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getAll()
    {
        $result = DB::query("SELECT * FROM characters ORDER BY id ASC");
        $characters = [];
        foreach ($result as $character) {
            array_push($characters, new self($character['id'], $character['name'], $character['class_id'], $character['current_chapter'], $character['current_dialogue_node'], $character['is_game_completed'], $character['ending_id']));
        }
        return $characters;
    }

    public function getCharacterClassName()
    {
        return CharacterClass::findById($this->getClassId())->getName();
    }

    public function getCollectedItems()
    {
        return CharacterItem::getItemsByCharacterId($this->id);
    }

    public function getCharacterStats()
    {
        return CharacterStat::getStatsByCharacterId($this->id);
    }

    public function toObject()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'class_id' => $this->getClassId(),
            'chapter' => $this->getCurrentChapter(),
            'dialogue_node' => $this->getDialogueNode(),
            'is_game_completed' => $this->getIsGameCompleted(),
            'ending_id' => $this->getEndingId()
        ];
    }
}
