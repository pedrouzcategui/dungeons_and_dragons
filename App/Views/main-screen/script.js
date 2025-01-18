document.addEventListener("DOMContentLoaded", () => {
  const play_button = document.getElementById("play_music");
  const pause_button = document.getElementById("pause_music");
  const less_volume = document.getElementById("less_volume");
  const more_volume = document.getElementById("more_volume");

  let music_filename =
    "http://localhost/dungeons_and_dragons/assets/music/main_theme.mp3";
  let audio = new GameAudio(music_filename);

  play_button.onclick = () => {
    audio.loopPlay();
  };

  pause_button.onclick = () => {
    audio.pause();
  };

  less_volume.onclick = () => {
    audio.lowerVolume();
  };

  more_volume.onclick = () => {
    audio.increaseVolume();
  };
});
