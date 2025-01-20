<?php

namespace App\Models;

use App\Database as DB;

class CharacterItem
{
    private $id;
    private $character_id;
    private $item_id;

    public function __construct($id, $character_id, $item_id)
    {
        $this->setId($id);
        $this->setCharacterId($character_id);
        $this->setItemId($item_id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCharacterId()
    {
        return $this->character_id;
    }

    public function setCharacterId($character_id)
    {
        $this->character_id = $character_id;
    }

    public function getItemId()
    {
        return $this->item_id;
    }

    public function setItemId($item_id)
    {
        $this->item_id = $item_id;
    }

    public static function insert($character_id, $item_id)
    {
        return DB::query("INSERT INTO character_items (character_id, item_id) VALUES (?, ?)", [$character_id, $item_id]);
    }

    public function save()
    {
        return DB::query("INSERT INTO character_items (character_id, item_id) VALUES (?, ?)", [$this->getCharacterId(), $this->getItemId()]);
    }

    public static function getItemsByCharacterId($character_id)
    {
        $items = [];
        $character_items = DB::query("SELECT * FROM character_items WHERE character_id = ?", [$character_id]);
        foreach ($character_items as $character_item) {
            $item = Item::findById($character_item['item_id']);
            array_push($items, $item);
        }
        return $items;
    }
}
