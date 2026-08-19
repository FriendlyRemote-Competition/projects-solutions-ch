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
    <div v-for="chapter in chapters" :key="chapter.id" class="card mt-3">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h2 class="card-title">
            Chapter {{ chapter.number }}. {{ chapter.title }}
          </h2>
          <div class="d-flex align-items-center gap-2">
            <div class="progress gap-2" style="width: 300px">
              <div
                class="progress-bar bg-primary"
                role="progressbar"
                :style="{
                  width: `${(100 / chapter.sections.length) * getReadSections(chapter.sections).length}%`,
                }"
                aria-valuenow="25"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>
            <small class="text-nowrap">{{
              getReadSections(chapter.sections).length == 0
                ? "Not started"
                : getReadSections(chapter.sections).length ==
                    chapter.sections.length
                  ? "Completed"
                  : `${Math.round((100 / chapter.sections.length) * getReadSections(chapter.sections).length)}% read`
            }}</small>
          </div>
          <small>{{ chapter.sections.length }} Sections</small>
        </div>
        <RouterLink
          :to="`/${getUnreadSections(chapter.sections).length ? getUnreadSections(chapter.sections)[0].id : chapter.sections[0].id}`"
          class="btn btn-primary"
        >
        {{ getReadSections(chapter.sections).length == 0 ? 'Start' : 'Continue' }} reading
        </RouterLink>
      </div>
    </div>
  </section>
</template>

<script setup>
import PageHeader from "@/components/PageHeader.vue";
import { useData } from "../composables/data";
import { useReadingProgress } from "@/composables/readingProgress";

const { book, chapters, sections } = useData();
const { readSections, resetReadSections, getReadSections, getUnreadSections } =
  useReadingProgress();
</script>
