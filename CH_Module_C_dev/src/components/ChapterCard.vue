<template>
  <div class="card mt-3">
    <div
      class="card-body d-flex flex-column gap-4 flex-md-row justify-content-between align-items-md-center"
    >
      <div class="w-100">
        <h2 class="card-title">
          Chapter {{ chapter.number }}. {{ chapter.title }}
        </h2>
        <div class="d-flex align-items-center gap-2">
          <div class="progress gap-2" style="width: 300px">
            <div
              class="progress-bar bg-primary"
              role="progressbar"
              :style="{
                width: `${(100 / chapter.sections.length) * readSections.length}%`,
              }"
              aria-valuenow="25"
              aria-valuemin="0"
              aria-valuemax="100"
            ></div>
          </div>
          <small class="text-nowrap">{{ readingStatus }}</small>
        </div>
        <small>{{ chapter.sections.length }} Sections</small>
      </div>
      <RouterLink
        :to="`/${unreadSections.length ? unreadSections[0].id : chapter.sections[0].id}`"
        class="btn btn-primary text-nowrap"
      >
        {{ readSections.length == 0 ? "Start" : "Continue" }} reading
      </RouterLink>
    </div>
  </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps(["chapter", "readSections", "unreadSections"]);

const readingStatus = computed(() => {
  if (props.readSections.length == 0) {
    return "Not started";
  }
  if (props.readSections.length == props.chapter.sections.length) {
    return "Completed";
  }
  return `${Math.round((100 / props.chapter.sections.length) * props.readSections.length)}% read`;
});
</script>
