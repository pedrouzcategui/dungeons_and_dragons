// Battle Music and Victory Music
const battleMusic = document.getElementById("battleMusic");
const victoryMusic = new Audio("/assets/sounds/victory.mp3");
battleMusic.play();

// Player and Enemy Stats
const player = { hp: 100, defense: 5 };
const enemy = { hp: 100, attack: 12 };
let guardActive = false;

const playerHP = document.getElementById("playerHP");
const enemyHP = document.getElementById("enemyHP");
const rollText = document.getElementById("rollText");
const diceResult = document.getElementById("diceResult");
const rollDiceButton = document.getElementById("rollDiceButton");
const guardButton = document.getElementById("guardButton");
const inventoryButton = document.getElementById("inventoryButton");
const inventoryMenu = document.getElementById("inventoryMenu");

// Inventory Items
const inventoryItems = [
  { name: "Health Potion", effect: "heal", value: 30 },
  { name: "Attack Boost", effect: "boostAttack", value: 5 },
  { name: "Defense Boost", effect: "boostDefense", value: 5 },
];

// Update Stats
function updateStats() {
  playerHP.textContent = player.hp;
  enemyHP.textContent = enemy.hp;
}

// Roll Dice Function
function rollD20() {
  return Math.floor(Math.random() * 20) + 1;
}

// Player Turn (Attack)
async function playerTurn() {
  const playerRoll = rollD20();
  let damage = playerRoll;
  let isCritical = false;

  diceResult.textContent = playerRoll;

  if (playerRoll === 20) {
    damage += 10;
    isCritical = true;
  }

  enemy.hp -= damage;
  if (enemy.hp < 0) enemy.hp = 0;

  rollText.textContent = `Player rolled ${playerRoll}${
    isCritical ? " (Critical Hit!)" : ""
  } and dealt ${damage} damage.`;

  updateStats();

  if (enemy.hp <= 0) {
    rollText.textContent += " You defeated the enemy!";
    playVictoryMusic();
    rollDiceButton.disabled = true;
    guardButton.disabled = true;
    inventoryButton.disabled = true;
    return;
  }

  await delay(2000); // Pause before enemy turn
  enemyTurn();
}

// Play Victory Music
function playVictoryMusic() {
  battleMusic.pause(); // Stop the battle music
  battleMusic.currentTime = 0; // Reset battle music for replay if needed
  victoryMusic.play(); // Play the victory music
}

// Guard Action
async function guard() {
  guardActive = true;
  rollText.textContent = "Player is guarding! Reduced incoming damage.";
  diceResult.textContent = "--";

  await delay(2000); // Pause before enemy turn
  enemyTurn();
}

// Use Inventory
function toggleInventory() {
  inventoryMenu.classList.toggle("hidden");
}

function useItem(index) {
  const item = inventoryItems[index];
  inventoryMenu.classList.add("hidden");

  if (item.effect === "heal") {
    player.hp = Math.min(player.hp + item.value, 100);
    rollText.textContent = `Used ${item.name}! Restored ${item.value} HP.`;
  } else if (item.effect === "boostAttack") {
    rollText.textContent = `Used ${item.name}! Attack boosted by ${item.value}.`;
  } else if (item.effect === "boostDefense") {
    player.defense += item.value;
    rollText.textContent = `Used ${item.name}! Defense boosted by ${item.value}.`;
  }

  updateStats();
  rollDiceButton.disabled = true;
  guardButton.disabled = true;
  inventoryButton.disabled = true;

  setTimeout(() => {
    enemyTurn();
  }, 2000);
}

// Enemy Turn
async function enemyTurn() {
  guardActive = false; // Reset guard
  const enemyRoll = rollD20();
  const damage = guardActive
    ? Math.max(enemyRoll - player.defense * 2, 1)
    : Math.max(enemyRoll - player.defense, 1);

  diceResult.textContent = enemyRoll;
  player.hp -= damage;
  if (player.hp < 0) player.hp = 0;

  rollText.textContent = `Enemy rolled ${enemyRoll} and dealt ${damage} damage.`;

  updateStats();

  if (player.hp <= 0) {
    rollText.textContent += " The enemy defeated you!";
    rollDiceButton.disabled = true;
    guardButton.disabled = true;
    inventoryButton.disabled = true;
  } else {
    rollDiceButton.disabled = false;
    guardButton.disabled = false;
    inventoryButton.disabled = false;
  }
}

// Delay Function
function delay(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

// Event Listeners
rollDiceButton.addEventListener("click", () => {
  rollDiceButton.disabled = true;
  guardButton.disabled = true;
  inventoryButton.disabled = true;
  playerTurn();
});

guardButton.addEventListener("click", () => {
  rollDiceButton.disabled = true;
  guardButton.disabled = true;
  inventoryButton.disabled = true;
  guard();
});

inventoryButton.addEventListener("click", toggleInventory);
