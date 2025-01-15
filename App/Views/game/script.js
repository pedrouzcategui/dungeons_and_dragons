document.addEventListener("DOMContentLoaded", async function () {
  const character_id = parseInt(localStorage.getItem("character_id"));
  const image_div = document.getElementById("chapter_image");
  const {
    dialog: dialogData,
    character,
    chapter,
  } = await API.get(`/api/game/${character_id}`);

  function loadBackgroundImage(chapterId) {
    image_div.style.backgroundImage = `url('http://localhost/dungeons_and_dragons/assets/images/chapters/chapter-${chapterId}.webp')`;
    image_div.style.backgroundSize = "cover";
  }

  loadBackgroundImage(chapter.id);

  let characterNameSpan = document.getElementById("character_name");
  let currentDialogNode = null; // To track the current dialog object

  const dialogContainer = document.getElementById("dialog-container");
  const choicesContainer = document.getElementById("choices-container");
  const chapterNameSpan = document.getElementById("chapter_title");
  const chapterIdSpan = document.getElementById("chapter_id");

  chapterIdSpan.innerText = chapter.id;
  chapterNameSpan.innerText = chapter.title;

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
   * Renders the ending button and handles the API call for the ending.
   */
  function renderEndingButton() {
    createButton("End", async () => {
      try {
        await API.post("/api/ending", {
          character_id,
          ending_id: currentDialogNode.ending_id,
        });
        console.log("Ending saved successfully.");
        const endingUrl = `ending`;
        window.location.href = endingUrl;
      } catch (error) {
        console.error("Failed to save ending:", error);
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
    characterNameSpan.innerHTML = currentDialogNode.name;
    console.log(currentDialogNode);
    if (!currentDialogNode) {
      console.error(`Dialog with ID ${dialogId} not found`);
      return;
    }

    dialogContainer.textContent = currentDialogNode.text;

    if (currentDialogNode.is_ending) {
      renderEndingButton();
      return; // Exit if ending dialog
    }

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
