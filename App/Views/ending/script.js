document.addEventListener("DOMContentLoaded", async () => {
  const character_id = localStorage.getItem("character_id");
  const ending_screen_div = document.getElementById("ending-screen");
  const ending_title = document.getElementById("ending-title");
  const ending_description = document.getElementById("ending-description");
  const ending_id = document.getElementById("ending-id");

  try {
    const { id, title, description, image_name } = await API.get(
      `/api/ending/${character_id}`
    );

    ending_screen_div.style.backgroundImage = `url(http://localhost/dungeons_and_dragons/assets/images/endings/${image_name})`;
    ending_title.innerText = title;
    ending_description.innerText = description;
    ending_id.innerText = id;

    console.log(ending_screen_div);
  } catch (error) {
    console.error(error);
  }
});
