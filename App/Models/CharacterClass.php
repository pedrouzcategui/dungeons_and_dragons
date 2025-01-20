<?php

namespace App\Models;

use App\Database as DB;

class CharacterClass
{
    private $id;
    private $name;
    private $attack;
    private $defense;
    private $health;
    private $luck;
    private $honor;

    function __construct($id, $name, $attack, $defense, $health, $luck, $honor)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setAttack($attack);
        $this->setDefense($defense);
        $this->setHealth($health);
        $this->setLuck($luck);
        $this->setHonor($honor);
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

    public function getAttack()
    {
        return $this->attack;
    }

    public function getDefense()
    {
        return $this->defense;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function getLuck()
    {
        return $this->luck;
    }

    public function getHonor()
    {
        return $this->honor;
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
    public function setAttack($attack)
    {
        $this->attack = $attack;
    }

    public function setDefense($defense)
    {
        $this->defense = $defense;
    }

    public function setHealth($health)
    {
        $this->health = $health;
    }

    public function setLuck($luck)
    {
        $this->luck = $luck;
    }

    public function setHonor($honor)
    {
        $this->honor = $honor;
    }

    public static function getAll()
    {
        $classes = [];
        $sql = "SELECT * FROM classes";
        $results = DB::query($sql);
        foreach ($results as $class) {
            $class_object = new self(
                $class['id'],
                $class['name'],
                $class['attack'],
                $class['defense'],
                $class['health'],
                $class['luck'],
                $class['honor']
            );
            array_push($classes, $class_object);
        }
        return $classes;
    }

    public static function findById($id)
    {
        $sql = "SELECT * FROM classes WHERE id = ?";
        $result = DB::query($sql, [$id])[0];

        if (!empty($result)) {
            return new self(
                $result['id'],
                $result['name'],
                $result['attack'],
                $result['defense'],
                $result['health'],
                $result['luck'],
                $result['honor']
            );
        }

        return null;
    }
}
