// document.addEventListener("DOMContentLoaded", () => {
//   const FORM_STEPS = document.querySelectorAll("div.step");
//   let current_step = 0;
//   const CHARACTER_WINDOWS = document.querySelectorAll(".character-window");
//   let class_input = document.querySelector("#character_class");

//   //Step Functions
//   const showStep = (i) => {
//     FORM_STEPS.forEach((step) => {
//       step.classList.remove("active");
//     });
//     FORM_STEPS[i].classList.add("active");
//   };

//   const nextStep = () => {
//     showStep(++current_step);
//   };

//   const prevStep = () => {
//     showStep(--current_step);
//   };

//   //BUTTONS
//   document.getElementById("next-step-1").addEventListener("click", nextStep);

//   CHARACTER_WINDOWS.forEach((c) => {
//     c.addEventListener("click", () => {
//       removeSelectedClasses();
//       addSelectedClass(c);
//       assignClassInput();
//     });
//   });

//   function removeSelectedClasses() {
//     CHARACTER_WINDOWS.forEach((c) => {
//       c.classList.remove("selected");
//     });
//   }

//   function addSelectedClass(e) {
//     e.classList.add("selected");
//   }

//   function assignClassInput() {
//     const selectedClass = document.querySelector(".character-window.selected");
//     if (selectedClass) {
//       class_input.value = selectedClass.dataset.class;
//     }
//   }
// });
