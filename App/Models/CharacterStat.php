<?php

namespace App\Models;

use App\Database as DB;

class CharacterStat
{
    private $id;
    private $character_id;
    private $health;
    private $attack;
    private $defense;
    private $luck;
    private $honor;

    public function __construct($id = null, $character_id, $health, $attack, $defense, $luck, $honor)
    {
        $this->setId($id);
        $this->setCharacterId($character_id);
        $this->setHealth($health);
        $this->setAttack($attack);
        $this->setDefense($defense);
        $this->setLuck($luck);
        $this->setHonor($honor);
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

    public function getHealth()
    {
        return $this->health;
    }

    public function setHealth($health)
    {
        $this->health = $health;
    }

    public function getAttack()
    {
        return $this->attack;
    }

    public function setAttack($attack)
    {
        $this->attack = $attack;
    }

    public function getDefense()
    {
        return $this->defense;
    }

    public function setDefense($defense)
    {
        $this->defense = $defense;
    }

    public function getLuck()
    {
        return $this->luck;
    }

    public function setLuck($luck)
    {
        $this->luck = $luck;
    }

    public function getHonor()
    {
        return $this->honor;
    }

    public function setHonor($honor)
    {
        $this->honor = $honor;
    }
    public static function getStatsByCharacterId($character_id)
    {
        $result = DB::query("SELECT * FROM character_stats WHERE character_id = ?", [$character_id]);

        if (!empty($result)) {
            $result = $result[0];
            return new self(
                $result['id'],
                $character_id,
                $result['health'],
                $result['attack'],
                $result['defense'],
                $result['luck'],
                $result['honor']
            );
        }

        return null;
    }

    public static function insert($character_id, $health, $attack, $defense, $luck, $honor)
    {
        $sql = "INSERT INTO character_stats (character_id, health, attack, defense, luck, honor) VALUES (?, ?, ?, ?, ?, ?)";
        $params = [
            $character_id,
            $health,
            $attack,
            $defense,
            $luck,
            $honor
        ];
        DB::query($sql, $params);
    }
}
