document.addEventListener("DOMContentLoaded", async function () {
  const character_id = parseInt(localStorage.getItem("character_id"));
  const { dialog: dialogData, character } = await API.get(
    `/api/game/${character_id}`
  );
  let currentDialogNode = null; // To track the current dialog object
  console.log(dialogData);

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
      try {
        const save = await API.put("/api/save-game", {
          character_id,
          current_chapter: currentDialogNode.next_chapter_id,
          current_dialogue_node: currentDialogNode.id, // Save the last node of the current chapter
        });
        console.log("Game progress saved:", save);
        // Redirect to the game or next chapter
        window.location.href = "game"; // Modify the URL if needed
      } catch (error) {
        console.error("Failed to save game progress:", error);
      }
    });
  }

  /**
   * Handles rendering the next button when no choices are available.
   */
  function renderNextButton() {
    createButton("Next", () => {
      const nextDialog = dialogData.find(
        (d) => d.id === currentDialogNode.id + 1
      );
      if (nextDialog) {
        renderDialog(nextDialog.id);
      } else {
        console.error("Next dialog not found");
      }
    });
  }

  /**
   * Renders dialog and choices for the current dialog ID.
   * @param {number} dialogId - The ID of the dialog to render.
   */
  function renderDialog(dialogId) {
    clearChoices();
    currentDialogNode = dialogData.find((d) => d.id === dialogId); // Update the current dialog node
    console.log(currentDialogNode);
    if (!currentDialogNode) {
      console.error(`Dialog with ID ${dialogId} not found`);
      return;
    }

    dialogContainer.textContent = currentDialogNode.text;

    if (currentDialogNode.is_final) {
      renderNextChapterButton();
      return; // Exit if final dialog
    }

    console.log(currentDialogNode.choices);

    if (currentDialogNode.choices && currentDialogNode.choices.length > 0) {
      currentDialogNode.choices.forEach((choice) => {
        createButton(choice.description, () => {
          renderDialog(choice.nextDialogId);
        });
      });
    } else {
      renderNextButton();
    }
  }

  // Initialize the dialog system
  renderDialog(character.current_dialog_node_id);
});
