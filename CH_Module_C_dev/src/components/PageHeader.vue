<template>
  <header class="card">
    <div class="card-body d-flex justify-content-between align-items-center">
      <RouterLink v-if="section" to="/" class="btn btn-primary">&lt; Library</RouterLink>
      <h1 v-else>{{ title }}</h1>
      <div>
        <h1 v-if="section" class="small">
          Chapter {{ section.chapter.number }} > Section {{ section.chapter.sections.findIndex((s) => s.id == section.id) + 1 }} of {{ chapter.sections.length }}
        </h1>
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
            :value="$route.query.query"
          />
        </label>
      </div>
    </div>
  </header>
</template>

<script setup>
const props = defineProps(["title", "section", "chapter"]);
</script>