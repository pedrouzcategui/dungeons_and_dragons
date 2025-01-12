<?php

namespace App\Models;

use App\Database as DB;

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


    public static function insert($is_character, $character_name, $chapter_id, $next_chapter_id, $text, $is_decision, $is_final)
    {
        DB::query("INSERT INTO dialogue (is_character, character_name, chapter_id, next_chapter_id, text, is_decision, is_final) VALUES(?, ?, ?, ?, ?, ?, ?)", [$is_character, $character_name, $chapter_id, $next_chapter_id, $text, $is_decision, $is_final]);
    }

    public static function getAll()
    {
        $chapters = DB::query('SELECT * FROM chapters');
        return $chapters;
    }

    public static function getChapterDialogue($chapterId, $characterId)
    {
        // Fetch dialogues for the given chapter
        $dialogues = DB::query(
            "SELECT d.id, d.is_character, d.character_name, d.text, d.is_decision, d.is_final 
             FROM dialogue d 
             WHERE d.chapter_id = ? 
             ORDER BY d.id ASC",
            [$chapterId]
        );

        // Fetch options for decision dialogues in the chapter
        $options = DB::query(
            "SELECT o.dialogue_id, o.id AS option_id, o.text AS description, o.next_dialogue_id 
             FROM dialogue_options o 
             JOIN dialogue d ON o.dialogue_id = d.id 
             WHERE d.chapter_id = ?",
            [$chapterId]
        );

        // Format data into the desired structure
        $dialogData = [];
        foreach ($dialogues as $dialogue) {
            $dialogEntry = [
                'id' => $dialogue['id'], // Include the dialogue ID
                'name' => $dialogue['is_character'] ? $dialogue['character_name'] : 'Narrator',
                'text' => $dialogue['text'],
                'is_final' => (bool)$dialogue['is_final'], // Include is_final
            ];

            // If the dialogue is a decision point, add the associated options
            if ($dialogue['is_decision']) {
                $dialogEntry['choices'] = array_map(function ($option) {
                    return [
                        'id' => $option['option_id'],
                        'description' => $option['description'],
                        'nextDialogId' => $option['next_dialogue_id']
                    ];
                }, array_filter($options, function ($option) use ($dialogue) {
                    return $option['dialogue_id'] == $dialogue['id'];
                }));
            }

            $dialogData[] = $dialogEntry;
        }
        return $dialogData;
    }
}
