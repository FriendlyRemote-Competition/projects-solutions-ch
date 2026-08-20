const header = document.querySelector(".navbar");
const hero = document.getElementById("hero");

const updateHeaderBackground = () => {
  if (document.scrollingElement.scrollTop > hero.clientHeight * 0.2) {
    header.classList.add("header-background");
  } else {
    header.classList.remove("header-background");
  }
}

document.addEventListener("scroll", updateHeaderBackground);
updateHeaderBackground();
