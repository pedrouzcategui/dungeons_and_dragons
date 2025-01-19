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
  let obtained_items = [];

  loadBackgroundImage(chapter.id);

  let characterNameSpan = document.getElementById("character_name");
  let currentDialogNode = null; // To track the current dialog object

  const dialogContainer = document.getElementById("dialog-container");
  const choicesContainer = document.getElementById("choices-container");
  const chapterNameSpan = document.getElementById("chapter_title");
  const chapterIdSpan = document.getElementById("chapter_id");
  const d20 = document.getElementById("d20");

  chapterIdSpan.innerText = chapter.id;
  chapterNameSpan.innerText = chapter.title;

  function clearChoices() {
    choicesContainer.innerHTML = "";
    d20.style.display = "none";
  }

  function createButton(text, onClick) {
    const button = document.createElement("button");
    button.textContent = text;
    button.addEventListener("click", onClick);
    choicesContainer.appendChild(button);
  }

  function renderNextChapterButton() {
    createButton("Siguiente Capítulo", async () => {
      try {
        const save = await API.put("/api/save-game", {
          character_id,
          current_chapter: currentDialogNode.next_chapter_id,
          current_dialogue_node: currentDialogNode.id,
          obtained_items,
        });
        console.log("Game progress saved:", save);
        window.location.href = "game";
      } catch (error) {
        console.error("Failed to save game progress:", error);
      }
    });
  }

  function renderEndingButton() {
    createButton("Fin", async () => {
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

  function renderDiceThrow() {
    d20.style.display = "block";
    createButton("Lanzar Dado", () => {
      let diceRolled = Dice.randomThrow();
      let { threshold, nextDialogIdSuccess, nextDialogIdDefault } =
        currentDialogNode.dice_throw_info;
      alert(`Obtuviste un ${diceRolled}`);
      if (diceRolled >= threshold) {
        renderDialog(nextDialogIdSuccess);
      } else {
        renderDialog(nextDialogIdDefault);
      }
    });
  }

  function renderNextButton() {
    createButton("Siguiente Diálogo", () => {
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

  function renderDialog(dialogId) {
    clearChoices();
    currentDialogNode = dialogData.find((d) => d.id === dialogId);
    characterNameSpan.innerHTML = currentDialogNode.name;
    console.log(currentDialogNode);

    if (!currentDialogNode) {
      console.error(`Dialog with ID ${dialogId} not found`);
      return;
    }

    dialogContainer.textContent = currentDialogNode.text;

    if (currentDialogNode.is_dice_throw) {
      renderDiceThrow();
      return;
    }

    if (currentDialogNode.is_ending) {
      renderEndingButton();
      return;
    }

    if (currentDialogNode.is_final) {
      renderNextChapterButton();
      return;
    }

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

  renderDialog(character.current_dialog_node_id);

  const play_button = document.getElementById("play_music");
  const pause_button = document.getElementById("pause_music");
  const less_volume = document.getElementById("less_volume");
  const more_volume = document.getElementById("more_volume");
  const mute_volume = document.getElementById("mute_volume");

  let music_filename = `http://localhost/dungeons_and_dragons/assets/music/${chapter.music_file_name}`;
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
