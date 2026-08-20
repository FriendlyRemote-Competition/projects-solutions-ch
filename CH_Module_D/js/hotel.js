const section = document.getElementById("hotel");
fetch("/CH_Module_D/media/content/hotel-copy.json").then((r) => r.json()).then((data) => {
  section.querySelector(".eyebrow").innerText = data.eyebrow;
  section.querySelector("h2").innerText = data.heading;
  section.querySelector("p:not(.eyebrow)").innerText = data.body;
  section.querySelector(".stats").innerHTML = data.stats.map((stat) => {
    return `<div>
      <span class="value">${stat.value}${stat.suffix}</span>
      <span class="label">${stat.label}</span>
    </div>`
  }).join("");
})
