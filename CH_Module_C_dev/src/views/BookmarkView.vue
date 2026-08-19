<template>
  <PageHeader title="My bookmarks" />
  <section v-if="bookmarkedSections.length">
    <BookmarkCard v-for="section in bookmarkedSections" :key="section.id" :section="section" @delete="deleteBookmark(section.id)" />
  </section>
  <section v-else>
    <div class="card mt-3">
      <div class="card-body">
        <h2>You don't have any bookmarks yet.</h2>
        <p>Go to a section and click "Save bookmark" in the header</p>
      </div>
    </div>
  </section>
</template>

<script setup>
import BookmarkCard from "@/components/BookmarkCard.vue";
import PageHeader from "@/components/PageHeader.vue";
import { useBookmarks } from "@/composables/bookmarks";
import { useData } from "@/composables/data";
import { computed } from "vue";

const { sections } = useData();
const { bookmarks, deleteBookmark } = useBookmarks();

const bookmarkedSections = computed(() =>
  sections.value.filter((s) => bookmarks.value.includes(s.id)),
);
</script>
