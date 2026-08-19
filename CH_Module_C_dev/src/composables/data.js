import { onBeforeMount, ref } from "vue";

export function useData() {
  const book = ref({});
  const chapters = ref([]);
  const sections = ref([]);

  onBeforeMount(async () => {
    const data = await fetch("/CH_Module_C/assets/data.json").then((r) => r.json());
    book.value = data.book;
    chapters.value = data.chapters;
    sections.value = data.chapters.reduce((acc, curr) => {
      acc.push(...curr.sections.map((s) => ({...s, chapter: curr})))
      return acc
    }, []);
  });

  return { book, chapters, sections };
};
