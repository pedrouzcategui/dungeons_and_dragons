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
