<template>
  <PageHeader :title="book.title" />

  <div class="progress">
    <div
      class="progress-bar bg-primary"
      role="progressbar"
      :style="{ width: `${(100 / sections.length) * readSections.length}%` }"
      aria-valuenow="25"
      aria-valuemin="0"
      aria-valuemax="100"
    ></div>
  </div>
  <div class="d-flex justify-content-between align-items-center">
    <span>
      {{ Math.round((100 / sections.length) * readSections.length) }}% read
    </span>
    <button class="btn btn-danger mt-3" @click="resetReadSections">
      Reset reading progress
    </button>
  </div>

  <section>
    <ChapterCard
      v-for="chapter in chapters"
      :key="chapter.id"
      :chapter="chapter"
      :read-sections="getReadSections(chapter.sections)"
      :unread-sections="getUnreadSections(chapter.sections)"
    />
  </section>
</template>

<script setup>
import PageHeader from "@/components/PageHeader.vue";
import { useData } from "../composables/data";
import { useReadingProgress } from "@/composables/readingProgress";
import ChapterCard from "@/components/ChapterCard.vue";

const { book, chapters, sections } = useData();
const { readSections, resetReadSections, getReadSections, getUnreadSections } =
  useReadingProgress();
</script>
