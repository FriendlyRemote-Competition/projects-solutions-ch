import { onBeforeMount, ref } from "vue";

export function useBookmarks() {
  const bookmarks = ref([])

  onBeforeMount(() => {
    bookmarks.value = JSON.parse(localStorage.getItem("bookmarks")) || [];
  })

  const addBookmark = (id) => {
    bookmarks.value.push(id);
    localStorage.setItem("bookmarks", JSON.stringify(bookmarks.value))
  }

  const deleteBookmark = (id) => {
    bookmarks.value = bookmarks.value.filter((b) => b != id)
    localStorage.setItem("bookmarks", JSON.stringify(bookmarks.value))
  }

  return { bookmarks, addBookmark, deleteBookmark }
}