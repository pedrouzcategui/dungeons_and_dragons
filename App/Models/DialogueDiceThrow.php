<?php

namespace App\Models;

use App\Database as DB;

class DialogueDiceThrow
{
    private $id;
    private $dialogue_id;
    private $dice_threshold;
    private $next_dialogue_id_if_threshold_exceeded;
    private $next_dialogue_id_if_threshold_failed;

    // Constructor
    public function __construct($id, $dialogue_id, $dice_threshold, $next_dialogue_id_if_threshold_exceeded, $next_dialogue_id_if_threshold_failed)
    {
        $this->setId($id);
        $this->setDialogueId($dialogue_id);
        $this->setDiceThreshold($dice_threshold);
        $this->setNextDialogueIdIfThresholdExceeded($next_dialogue_id_if_threshold_exceeded);
        $this->setNextDialogueIdIfThresholdFailed($next_dialogue_id_if_threshold_failed);
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getDialogueId()
    {
        return $this->dialogue_id;
    }

    public function getDiceThreshold()
    {
        return $this->dice_threshold;
    }

    public function getNextDialogueIdIfThresholdExceeded()
    {
        return $this->next_dialogue_id_if_threshold_exceeded;
    }

    public function getNextDialogueIdIfThresholdFailed()
    {
        return $this->next_dialogue_id_if_threshold_failed;
    }
    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDialogueId($dialogue_id)
    {
        $this->dialogue_id = $dialogue_id;
    }

    public function setDiceThreshold($dice_threshold)
    {
        $this->dice_threshold = $dice_threshold;
    }

    public function setNextDialogueIdIfThresholdExceeded($next_dialogue_id_if_threshold_exceeded)
    {
        $this->next_dialogue_id_if_threshold_exceeded = $next_dialogue_id_if_threshold_exceeded;
    }

    public function setNextDialogueIdIfThresholdFailed($next_dialogue_id_if_threshold_failed)
    {
        $this->next_dialogue_id_if_threshold_failed = $next_dialogue_id_if_threshold_failed;
    }

    public static function insert($dialogue_id, $dice_threshold, $next_dialogue_id_if_threshold_exceeded, $next_dialogue_id_if_threshold_failed)
    {
        $sql = "INSERT INTO dialogue_dice_throws (dialogue_id, dice_threshold, next_dialogue_id_if_threshold_exceeded, next_dialogue_id_if_threshold_failed) VALUES (?, ?, ?, ?)";
        $params = [$dialogue_id, $dice_threshold, $next_dialogue_id_if_threshold_exceeded, $next_dialogue_id_if_threshold_failed];
        return DB::query($sql, $params);
    }
}
