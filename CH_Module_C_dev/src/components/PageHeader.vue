<template>
  <header class="card">
    <div class="card-body d-flex justify-content-between align-items-center">
      <RouterLink v-if="section" to="/" class="btn btn-primary">&lt; Library</RouterLink>
      <h1 v-else class="base">{{ title }}</h1>
      <div>
        <template v-if="chapter && section">
          Chapter {{ chapter.number }} > Section {{ chapter.sections.findIndex((s) => s.id == section.id) + 1 }} of {{ chapter.sections.length }}
        </template>
      </div>
      <div>
        <label>
          <span class="visually-hidden">Search</span>
          <input
            placeholder="Search..."
            class="form-control"
            @keydown.enter="
              $router.push('/search?query=' + $event.target.value)
            "
          />
        </label>
      </div>
    </div>
  </header>
</template>

<script setup>
const props = defineProps(["title", "section", "chapter"]);
</script>