document.addEventListener("DOMContentLoaded", () => {
  const play_button = document.getElementById("play_music");
  const pause_button = document.getElementById("pause_music");
  const less_volume = document.getElementById("less_volume");
  const more_volume = document.getElementById("more_volume");
  const mute_volume = document.getElementById("mute_volume");
  const roleOptions = document.querySelectorAll(".role-options label");

  let music_filename =
    "http://localhost/dungeons_and_dragons/assets/music/file_select.mp3";
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

  mute_volume.onclick = () => {
    audio.mute();
  };

  roleOptions.forEach((label) => {
    label.addEventListener("click", () => {
      // Remove "selected" class from all labels
      roleOptions.forEach((option) => option.classList.remove("selected"));

      // Add "selected" class to the clicked label
      label.classList.add("selected");
    });
  });
});
