<?php

namespace App\Controllers;

use App\Views\View;
use App\Request;
use App\Models\Character;
use App\Models\CharacterClass;
use App\Models\CharacterStat;
use App\Response;
use App\Utils;

class CharacterController
{
    public function index()
    {
        View::render('create-character');
    }

    /**Función que crea un personaje usando la información que viene del request. */
    public function create(Request $request)
    {

        $character_name = $request->input("character_name");
        $character_class = $request->input('character_class');
        try {

            $character = new Character(NULL, $character_name, $character_class);
            $character->create();

            $character_class = CharacterClass::findById($character->getClassId());

            CharacterStat::insert(
                $character->getId(),
                $character_class->getHealth(),
                $character_class->getAttack(),
                $character_class->getDefense(),
                $character_class->getLuck(),
                $character_class->getHonor()
            );

            if ($character) {
                header("Location: file-selection");
            } else {
                throw new \Exception("Failed to create character");
            }
        } catch (\Throwable $th) {
            Utils::prettyDump($th);
            echo "Error creating character";
            die();
        }
    }

    public function delete(Request $request)
    {
        $character_id = $request->getParam('id');
        try {
            Character::deleteById($character_id);
            return Response::json([
                'success' => true,
                'message' => "The character with id $character_id was deleted successfully."
            ]);
        } catch (\Throwable $th) {
            return Response::error($th);
        }
    }
}
