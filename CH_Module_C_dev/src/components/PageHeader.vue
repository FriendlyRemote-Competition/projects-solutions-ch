<template>
  <header class="card">
    <div class="card-body d-flex justify-content-between align-items-center">
      <RouterLink v-if="section" to="/" class="btn btn-primary"
        >&lt; Library</RouterLink
      >
      <h1 v-else>{{ title }}</h1>
      <div>
        <h1 v-if="section" class="small">
          Chapter {{ section.chapter.number }} > Section
          {{
            section.chapter.sections.findIndex((s) => s.id == section.id) + 1
          }}
          of {{ section.chapter.sections.length }}
        </h1>
      </div>
      <div class="d-flex align-items-center gap-2">
        <label>
          <span class="visually-hidden">Search</span>
          <input
            placeholder="Search..."
            class="form-control"
            @keydown.enter="
              $router.push('/search?query=' + $event.target.value)
            "
            :value="$route.query.query"
          />
        </label>
        <button
          v-if="section && bookmarks != null"
          class="btn"
          :class="bookmarks.includes(section.id) ? 'btn-danger' : 'btn-primary'"
          @click="
            bookmarks.includes(section.id)
              ? deleteBookmark(section.id)
              : addBookmark(section.id)
          "
        >
          {{ bookmarks.includes(section.id) ? "Delete bookmark" : "Save bookmark" }}
        </button>
        <RouterLink v-else-if="$route.path != '/bookmarks'" class="btn btn-primary" to="/bookmarks">
          View bookmarks
        </RouterLink>
        <RouterLink v-else="" class="btn btn-primary" to="/">
          Back to library
        </RouterLink>
      </div>
    </div>
  </header>
</template>

<script setup>
import { useBookmarks } from "@/composables/bookmarks";

const props = defineProps(["title", "section", "chapter"]);
const { bookmarks, addBookmark, deleteBookmark } = useBookmarks();
</script>
