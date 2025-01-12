document.addEventListener("DOMContentLoaded", () => {
  const startAdventureButton = document.getElementById("start-adventure");

  const gameFiles = document.querySelectorAll(".file-option");
  const characterId = 1;

  if (gameFiles.length === 0) {
    startAdventureButton.style.display = "none";
  }

  gameFiles.forEach((file) => {
    localStorage.setItem("character_id", "1");
    file.addEventListener("click", (e) => {
      // Remove "active" class from all files
      gameFiles.forEach((file) => {
        file.classList.remove("active");
      });
      // Add "active" class to selected file
      file.classList.add("active");

      startAdventureButton.disabled = false;
    });
  });
});
