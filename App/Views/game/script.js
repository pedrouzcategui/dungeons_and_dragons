document.addEventListener("DOMContentLoaded", async function () {
  const character_id = parseInt(localStorage.getItem("character_id"));
  const dialogData = await API.get(`/api/game/${character_id}`);
  let currentDialogId = 1; // Starting dialog

  const dialogContainer = document.getElementById("dialog-container");
  const choicesContainer = document.getElementById("choices-container");

  /**
   * Clears the choices container.
   */
  function clearChoices() {
    choicesContainer.innerHTML = "";
  }

  /**
   * Creates and appends a button to the choices container.
   * @param {string} text - The button text.
   * @param {Function} onClick - The click event handler.
   */
  function createButton(text, onClick) {
    const button = document.createElement("button");
    button.textContent = text;
    button.addEventListener("click", onClick);
    choicesContainer.appendChild(button);
  }

  /**
   * Handles rendering the next chapter button.
   */
  function renderNextChapterButton() {
    createButton("Next Chapter", async () => {
      const save = await API.put("/api/save-game", {
        character_id,
        current_chapter: 2,
        current_dialogue_node: currentDialogId,
      });
      // If save is successful, redirect
      window.location.href = "game";
      // Add logic to load the next chapter
    });
  }

  /**
   * Renders dialog and choices for the current dialog ID.
   * @param {number} dialogId - The ID of the dialog to render.
   */
  function renderDialog(dialogId) {
    clearChoices();
    const dialog = dialogData.find((d) => d.id === dialogId);

    if (!dialog) {
      console.error(`Dialog with ID ${dialogId} not found`);
      return;
    }

    dialogContainer.textContent = dialog.text;

    if (dialog.is_final) {
      renderNextChapterButton();
      return; // Exit if final dialog
    }

    (dialog.choices || []).forEach((choice) => {
      createButton(choice.description, () => {
        currentDialogId = choice.nextDialogId;
        renderDialog(choice.nextDialogId);
      });
    });
  }

  // Initialize the dialog system
  renderDialog(currentDialogId);
});
