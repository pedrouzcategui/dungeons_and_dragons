<?php

namespace App\Components;

use App\Utils;

class AudioOptions
{
    public static function render()
    {

        $playButtonPath = Utils::getImagePath('icons/play-button.png');
        $pauseButtonPath = Utils::getImagePath('icons/pause.png');
        $volumeUpButtonPath = Utils::getImagePath('icons/volume-up.png');
        $volumeDownButtonPath = Utils::getImagePath('icons/volume-down.png');
        $muteButtonPath = Utils::getImagePath('icons/mute.png');

        // This is known as a heredoc
        echo <<<HTML
        <div class="audio-controls">
            <span class="audio_button" id="play_music">
                <img src="$playButtonPath" width="20px" height="20px" alt="Play Button">
            </span>
            <span class="audio_button" id="pause_music">
                <img src="$pauseButtonPath" width="20px" height="20px" alt="Pause Button">
            </span>
            <span class="audio_button" id="more_volume">
                <img src="$volumeUpButtonPath" width="20px" height="20px" alt="More Volume">
            </span>
            <span class="audio_button" id="less_volume">
                <img src="$volumeDownButtonPath" width="20px" height="20px" alt="More Volume">
            </span>
            <span class="audio_button" id="mute_volume">
                <img src="$muteButtonPath" width="20px" height="20px" alt="More Volume">
            </span>
        </div>
        HTML;
    }
}
