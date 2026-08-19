<template>
  <PageHeader title="My bookmarks" />
  <section v-if="bookmarkedSections.length">
    <div v-for="section in bookmarkedSections" class="card mt-3">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h2>
            Chapter {{ section.chapter.number }} > Section
            {{
              section.chapter.sections.findIndex((s) => s.id == section.id) + 1
            }}. {{ section.heading }}
          </h2>
          <p>
            {{ section.content.substring(0, 60)
            }}{{ section.content.length > 60 ? "..." : "" }}
          </p>
        </div>
        <div class="d-flex gap-2">
          <RouterLink :to="`/${section.id}`" class="btn btn-primary">
            Go to
          </RouterLink>
          <button class="btn btn-danger" @click="deleteBookmark(section.id)">
            Remove
          </button>
        </div>
      </div>
    </div>
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
