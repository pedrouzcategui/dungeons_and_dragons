<?php

namespace App\Models;

use App\Database as DB;
use App\Response;

class Dialogue
{
    private $id;
    private $title;
    private $description;

    // Constructor
    public function __construct($id, $title, $description)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setDescription($description);
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    // Insert a new dialogue
    public static function insert($is_character, $character_name, $chapter_id, $next_chapter_id, $text, $is_decision, $is_final, $is_ending = FALSE, $ending_id = NULL, $is_dice_throw = FALSE, $is_reward = FALSE)
    {
        DB::query(
            "INSERT INTO dialogue (is_character, character_name, chapter_id, next_chapter_id, text, is_decision, is_final, is_ending, ending_id, is_dice_throw, is_reward) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$is_character, $character_name, $chapter_id, $next_chapter_id, $text, $is_decision, $is_final, $is_ending, $ending_id, $is_dice_throw, $is_reward]
        );
    }

    // Get all dialogues
    public static function getAll()
    {
        return DB::query('SELECT * FROM chapters');
    }

    public static function getDialogueById($chapter_id)
    {
        return DB::query(
            "SELECT * FROM dialogue WHERE chapter_id = ? ORDER BY id ASC",
            [$chapter_id]
        );
    }

    // Get dialogues for a specific chapter
    public static function getChapterDialogue($chapterId)
    {
        // Fetch dialogues for the given chapter
        $dialogues = Dialogue::getDialogueById($chapterId);

        // Fetch options for decision dialogues in the chapter
        $options = DB::query(
            "SELECT o.dialogue_id, o.id AS option_id, o.text AS description, o.next_dialogue_id
             FROM dialogue_options o 
             JOIN dialogue d ON o.dialogue_id = d.id 
             WHERE d.chapter_id = ?",
            [$chapterId]
        );

        $dice_throws = DB::query(
            "SELECT d.id, do.id as dice_throw_id, do.dialogue_id, do.dice_threshold, do.next_dialogue_id_if_threshold_exceeded, do.next_dialogue_id_if_threshold_failed
             FROM dialogue_dice_throws do 
             JOIN dialogue d ON do.dialogue_id = d.id
             WHERE d.chapter_id = ?",
            [$chapterId]
        );

        // Format data into the desired structure
        $dialogData = [];
        foreach ($dialogues as $dialogue) {
            // Filter and map choices
            $choices = array_filter($options, function ($option) use ($dialogue) {
                return $option['dialogue_id'] == $dialogue['id'];
            });

            $choices = array_map(function ($option) {
                return [
                    'id' => $option['option_id'],
                    'description' => $option['description'],
                    'nextDialogId' => $option['next_dialogue_id']
                ];
            }, $choices);


            // Find the first matching dice throw as an object
            $dice_throw = null;
            foreach ($dice_throws as $throw) {
                if ($throw['dialogue_id'] == $dialogue['id']) {
                    $dice_throw = [
                        'id' => $throw['dice_throw_id'],
                        'threshold' => $throw['dice_threshold'],
                        'nextDialogIdSuccess' => $throw['next_dialogue_id_if_threshold_exceeded'],
                        'nextDialogIdDefault' => $throw['next_dialogue_id_if_threshold_failed']
                    ];
                    break; // Stop looping after finding the first match
                }
            }

            // Use $dice_throw (either an object or null)
            $dice_throw_paths = $dice_throw;


            // Add dialogue entry
            $dialogEntry = [
                'id' => $dialogue['id'],
                'name' => $dialogue['is_character'] ? $dialogue['character_name'] : 'Narrator',
                'text' => $dialogue['text'],
                'is_final' => (bool)$dialogue['is_final'],
                'is_ending' => (bool)$dialogue['is_ending'],
                'is_dice_throw' => (bool)$dialogue['is_dice_throw'],
                'ending_id' => $dialogue['ending_id'],
                'next_chapter_id' => $dialogue['next_chapter_id'],
                'choices' => array_values($choices), // Reset keys for proper JSON encoding,
                'dice_throw_info' => $dice_throw_paths
            ];

            $dialogData[] = $dialogEntry;
        }

        return $dialogData;
    }

    // Find the first dialogue of a chapter
    public static function findFirstDialogueOfChapter($chapter_id)
    {
        $dialogue = DB::query(
            "SELECT * FROM dialogue WHERE chapter_id = ? ORDER BY id ASC LIMIT 1",
            [$chapter_id]
        );

        return !empty($dialogue) ? $dialogue[0] : null;
    }

    // Utility function to validate JSON consistency
    public static function validateJson($data)
    {
        $json = json_encode($data);
        if ($json === false) {
            throw new \Exception('Invalid JSON structure.');
        }
        return $json;
    }
}
