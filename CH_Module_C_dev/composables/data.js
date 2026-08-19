import { onBeforeMount, ref } from "vue";

export function useData() {
  const book = ref({});
  const chapters = ref([]);

  onBeforeMount(async () => {
    const data = await fetch("/CH_Module_C/data.json").then((r) => r.json());
    book.value = data.book;
    chapters.value = data.chapters;
  });

  return { book, chapters };
};
