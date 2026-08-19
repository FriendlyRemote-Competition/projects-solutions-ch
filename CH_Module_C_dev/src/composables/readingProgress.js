import { onBeforeMount, ref } from "vue";

export function useReadingProgress() {
  const ready = ref(false);
  const readSections = ref([]);
  const queuedReadSections = ref([]);

  onBeforeMount(() => {
    readSections.value = JSON.parse(localStorage.getItem("readSections")) || []
    queuedReadSections.value.forEach((s) => addReadSection(s));
    ready.value = true;
  })

  
  const addReadSection = (id) => {
    if (!ready.value) {
      queuedReadSections.value.push(id);
    } else if (!readSections.value.includes(id)) {
      readSections.value.push(id);
      localStorage.setItem("readSections", JSON.stringify(readSections.value));
    }
  }

  const resetReadSections = () => {
    readSections.value = [];
    localStorage.setItem("readSections", "[]");
  }

  const getReadSections = (sections) => {
    return sections.filter((s) => readSections.value.includes(s.id));
  }

  const getUnreadSections = (sections) => {
    return sections.filter((s) => !readSections.value.includes(s.id));
  }

  return { readSections, addReadSection, resetReadSections, getReadSections, getUnreadSections }
}