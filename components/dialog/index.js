// Dialog Data
const dialogData = [
  {
    name: "X",
    face: "/assets/images/megaman-face.png",
    text: "Zero! Do you copy me?",
    color: "#00FFFF",
  },
  {
    name: "Zero",
    face: "/assets/images/zero-face.png",
    text: "Affirmative X, joining the battle soon.",
    color: "#FF0000",
  },
  {
    name: "X",
    face: "/assets/images/megaman-face.png",
    text: "Thanks god Zero! I was starting to worry. Do you want to defeat Sigma or Lumine?",
    color: "#00FFFF",
    choices: [
      {
        id: 1,
        description: "Defeat Sigma",
        nextDialog: 3,
      },
      {
        id: 2,
        description: "Defeat Lumine",
        nextDialog: 4,
      },
    ],
  },
  {
    name: "X",
    face: "/assets/images/megaman-face.png",
    text: "Let's take down Sigma together!",
    color: "#00FFFF",
  },
  {
    name: "X",
    face: "/assets/images/megaman-face.png",
    text: "Lumine doesn't stand a chance!",
    color: "#00FFFF",
  },
];

let currentDialogIndex = 0;
let isAnimating = false;
let typingSpeed = 10;

const characterFace = document.getElementById("character-face");
const characterName = document.getElementById("character-name");
const dialogText = document.getElementById("dialog-text");
const dialogContainer = document.getElementById("dialog-container");
const choicesContainer = document.getElementById("choices-container");
const nextButton = document.getElementById("next-button");
const okButton = document.getElementById("ok-button");

// Function to type text with sound effect
async function typeText(element, text) {
  element.textContent = "";
  for (let i = 0; i < text.length; i++) {
    if (!isAnimating) {
      element.textContent = text; // Skip animation if interrupted
      return;
    }
    element.textContent += text[i];
    await new Promise((resolve) => setTimeout(resolve, typingSpeed));
  }

  enableChoices(); // Enable choices after typing finishes

  if (
    !dialogData[currentDialogIndex].choices &&
    currentDialogIndex < dialogData.length - 1
  ) {
    showNextButton(); // Show "Next" button if no choices exist and not at the end
  } else if (currentDialogIndex === dialogData.length - 1) {
    showOkButton(); // Show "OK" button if at the end of the dialog
  }

  // Fade out the typing sound at the end of the dialog
}

// Function to show dialog
async function showDialog(index) {
  const dialog = dialogData[index];
  const { name, face, text, color, choices } = dialog;

  characterName.textContent = name;
  characterName.style.color = color;
  characterFace.src = face;
  dialogContainer.style.borderColor = color;

  isAnimating = true;

  hideNextButton(); // Hide "Next" button at the start
  hideOkButton(); // Hide "OK" button at the start
  if (choices) {
    renderChoices(choices); // Render choices immediately
    disableChoices(); // Disable choices until text animation finishes
  } else {
    choicesContainer.style.display = "none"; // Hide choices if none exist
  }

  await typeText(dialogText, text); // Animate text
  isAnimating = false;
}

// Function to render choices
function renderChoices(choices) {
  choicesContainer.innerHTML = "";
  choicesContainer.style.display = "flex";

  choices.forEach((choice) => {
    const choiceElement = document.createElement("div");
    choiceElement.classList.add("choice");
    choiceElement.textContent = choice.description;
    choiceElement.addEventListener("click", () =>
      handleChoice(choice.nextDialog)
    );
    choiceElement.setAttribute("disabled", "true"); // Initially disable choice buttons
    choicesContainer.appendChild(choiceElement);
  });
}

// Function to enable choices
function enableChoices() {
  const choiceButtons = document.querySelectorAll(".choice");
  choiceButtons.forEach((button) => button.removeAttribute("disabled"));
}

// Function to disable choices
function disableChoices() {
  const choiceButtons = document.querySelectorAll(".choice");
  choiceButtons.forEach((button) => button.setAttribute("disabled", "true"));
}

// Function to handle choice selection
function handleChoice(nextDialog) {
  choicesContainer.style.display = "none";
  showDialog(nextDialog);
}

// Function to handle the "Next" button
function handleNext() {
  const currentDialog = dialogData[currentDialogIndex];
  if (currentDialog.choices) return; // Prevent skipping choices

  currentDialogIndex++;
  if (currentDialogIndex >= dialogData.length) {
    currentDialogIndex = 0; // Loop back to the start
  }
  showDialog(currentDialogIndex);
}

// Function to handle the "OK" button
function handleOk() {
  alert("Thank you for playing!"); // You can replace this with any final action
}

// Function to show the "Next" button
function showNextButton() {
  nextButton.style.display = "block";
}

// Function to hide the "Next" button
function hideNextButton() {
  nextButton.style.display = "none";
}

// Function to show the "OK" button
function showOkButton() {
  okButton.style.display = "block";
}

// Function to hide the "OK" button
function hideOkButton() {
  okButton.style.display = "none";
}

// Add event listener for the "Next" button
nextButton.addEventListener("click", handleNext);

// Add event listener for the "OK" button
okButton.addEventListener("click", handleOk);

// Initialize dialog
showDialog(currentDialogIndex);
