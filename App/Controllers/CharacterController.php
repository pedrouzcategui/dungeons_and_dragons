<?php

//TODO: What are namespaces?
namespace App\Controllers;

//TODO: Why do you use namespaces like this?
use App\Views\View;
use App\Request;
use App\Models\Character;
use App\Utils;

class CharacterController extends BaseController
{
    public function index()
    {
        View::render('create-character');
    }

    public function create(Request $request)
    {

        $character_name = $request->input("character_name");
        $character_class = $request->input('character_class');
        try {
            $character = new Character(NULL, $character_name, $character_class);
            if ($character->create()) {
                echo "saving";
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
}
