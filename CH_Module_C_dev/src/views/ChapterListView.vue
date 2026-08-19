<template>
  <PageHeader :title="book.title" />

  <section>
    <div v-for="chapter in chapters" :key="chapter.id" class="card mt-3">
      <div class="card-body d-flex justify-content-between align-items-center">
        <h2 class="card-title">{{ chapter.title }}</h2>
        <RouterLink :to="`/${chapter.sections[0].id}`" class="btn btn-primary">
          Open
        </RouterLink>
      </div>
    </div>
  </section>
</template>

<script setup>
import PageHeader from "@/components/PageHeader.vue";
import { useData } from "../composables/data";

const { book, chapters } = useData();
</script>
