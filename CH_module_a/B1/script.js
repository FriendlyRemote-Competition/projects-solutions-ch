const startColors = document.getElementById("startColors");
const endColors = document.getElementById("endColors");
const startColor = document.getElementById("startColor");
const endColor = document.getElementById("endColor");
const gradientBox = document.getElementById("gradientBox");


const updateGradiant = () => {
  if (startColor.value.match(/^#[\da-fA-F]{6}$/) && endColor.value.match(/^#[\da-fA-F]{6}$/)) {
    gradientBox.style.background = `linear-gradient(to right, ${startColor.value}, ${endColor.value})`;
  }
}

const addButton = (container, input) => {
  const btn = document.createElement("button");
  btn.classList.add("color-button");
  const color = `#${(new Uint8Array([
    Math.random() * 255,
    Math.random() * 255,
    Math.random() * 255,
  ])).toHex()}`
  btn.dataset.color = color;
  btn.style.background = color;
  btn.addEventListener("click", () => {
    input.value = btn.dataset.color;
    updateGradiant();
  });
  container.appendChild(btn);
}

for (let i = 0; i < 12; i++) {
  addButton(startColors, startColor);
  addButton(endColors, endColor);
}

startColor.addEventListener("input", updateGradiant);
endColor.addEventListener("input", updateGradiant);
updateGradiant();
