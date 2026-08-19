import { onBeforeMount, ref } from "vue";

export function useSettings() {
  const fontSize = ref(16);
  const colorTheme = ref("light");
  const lineSpacing = ref(1.5);

  onBeforeMount(() => {
    fontSize.value = localStorage.getItem("settings.fontSize") || 16;
    colorTheme.value = localStorage.getItem("settings.colorTheme") || "light";
    lineSpacing.value = localStorage.getItem("settings.lineSpacing") || 1.5;

    document.documentElement.dataset.bsTheme = colorTheme.value;
    document.body.style.fontSize = fontSize.value + "px";
    document.body.style.lineHeight = lineSpacing.value;
  })

  const setFontSize = (newFontSize) => {
    fontSize.value = newFontSize;
    localStorage.setItem("settings.fontSize", newFontSize);
    document.body.style.fontSize = newFontSize + "px";
  }

  const setColorTheme = (newColorTheme) => {
    colorTheme.value = newColorTheme;
    localStorage.setItem("settings.colorTheme", newColorTheme);
    document.documentElement.dataset.bsTheme = colorTheme.value;
  }

  const setLineSpacing = (newLineSpacing) => {
    lineSpacing.value = newLineSpacing;
    localStorage.setItem("settings.lineSpacing", newLineSpacing);
    document.body.style.lineHeight = newLineSpacing;
  }

  return {
    fontSize,
    colorTheme,
    lineSpacing,
    setFontSize,
    setColorTheme,
    setLineSpacing,
  }
}