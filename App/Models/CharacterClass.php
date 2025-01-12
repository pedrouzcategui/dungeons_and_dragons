<?php

namespace App\Models;

use App\Database as DB;
use App\Utils;

class CharacterClass
{
    private $id;
    private $name;

    function __construct($id, $name)
    {
        $this->setId($id);
        $this->setName($name);
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
    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public static function findById($id)
    {
        $sql = "SELECT * FROM classes WHERE id = ?";
        $result = DB::query($sql, [$id])[0];

        if (!empty($result)) {
            return new self($result['id'], $result['name']);
        }

        return null;
    }
}
