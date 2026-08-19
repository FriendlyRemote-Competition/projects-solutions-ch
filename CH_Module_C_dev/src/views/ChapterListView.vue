<template>
  <header class="card">
    <div class="card-body d-flex justify-content-between align-items-center">
      <h1 class="base">{{ book.title }}</h1>
      <div>
        <label>
          <span class="visually-hidden">Search</span>
          <input placeholder="Search..." class="form-control" @keydown.enter="$router.push('/search?query=' + $event.target.value)" />
        </label>
      </div>
    </div>
  </header>

  <section>
    <div class="card mt-3" v-for="chapter in chapters" :key="chapter.id">
      <div class="card-body d-flex justify-content-between align-items-center">
        <h2 class="card-title">{{ chapter.title }}</h2>
        <RouterLink :to="`/${chapter.sections[0].id}`" class="btn btn-primary">Open</RouterLink>
      </div>
    </div>
    
  </section>
</template>

<script setup>
import { useData } from '../../composables/data';

const { book, chapters } = useData();
</script>