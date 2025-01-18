document.addEventListener("DOMContentLoaded", () => {
  const startAdventureButton = document.getElementById("start-adventure");
  const deleteButton = document.getElementById("delete-file");
  const modal = document.getElementById("confirmation-modal");
  const confirmDelete = document.getElementById("confirm-delete");
  const cancelDelete = document.getElementById("cancel-delete");

  const gameFiles = document.querySelectorAll(".file-option");
  let selectedFile = null;

  if (gameFiles.length === 0) {
    startAdventureButton.style.display = "none";
    deleteButton.style.display = "none";
  }

  gameFiles.forEach((file) => {
    file.addEventListener("click", () => {
      gameFiles.forEach((file) => file.classList.remove("active"));
      file.classList.add("active");

      startAdventureButton.disabled = false;
      deleteButton.disabled = false;
      selectedFile = file.getAttribute("data-character-id");
      localStorage.setItem("character_id", selectedFile);
    });
  });

  deleteButton.addEventListener("click", () => {
    if (!selectedFile) return;
    modal.classList.remove("hidden");
  });

  cancelDelete.addEventListener("click", () => {
    modal.classList.add("hidden");
  });

  confirmDelete.addEventListener("click", async () => {
    try {
      const response = await API.delete(`/api/character/${selectedFile}`);
      if (response.success) {
        window.location.reload();
      }
    } catch (error) {
      console.error(error);
    }
  });
});

/**Music Logic */
document.addEventListener("DOMContentLoaded", () => {
  const play_button = document.getElementById("play_music");
  const pause_button = document.getElementById("pause_music");
  const less_volume = document.getElementById("less_volume");
  const more_volume = document.getElementById("more_volume");
  const mute_volume = document.getElementById("mute_volume");

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
});
