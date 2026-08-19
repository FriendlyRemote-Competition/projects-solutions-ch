<template>
  <template v-if="section">

    <PageHeader :section="section" />
  
    <div class="progress">
      <div
        class="progress-bar bg-primary"
        role="progressbar"
        :style="{width: `${100 / section.chapter.sections.length * section.chapter.sections.filter((s) => readSections.includes(s.id)).length}%`}"
        aria-valuenow="25"
        aria-valuemin="0"
        aria-valuemax="100"
      >
        Chapter reading progress
      </div>
    </div>
  
    <div class="row mt-3">
      <div class="col-12 col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="text-uppercase">Table of contents</h2>
            <ol class="list-unstyled d-flex flex-column gap-2">
              <li v-for="(s, i) in section.chapter.sections">
                <RouterLink
                  :to="`/${s.id}`"
                  class="w-100 btn text-start"
                  :class="s.id == section.id ? 'btn-primary' : 'btn-light'"
                >
                  {{ i + 1 }}. {{ s.heading }} {{ readSections.includes(s.id) ? '(read)' : '' }}
                </RouterLink>
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-8">
        <div class="card h-100">
          <div class="card-body">
            <h2>{{ section.heading }}</h2>
            <p class="my-4">{{ section.content }}</p>
            <picture>
              <img
                :src="
                  section.image
                    ? '/CH_Module_C/' + section.image
                    : '/CH_Module_C/assets/images/cover.webp'
                "
                :alt="section.imagealt"
                class="w-100"
              />
            </picture>
            <div class="d-flex justify-content-between mt-3">
              <RouterLink
                :to="`/${sectionIndex != 0 ? sections[sectionIndex - 1].id : ''}`"
                class="btn btn-primary"
                :class="{ disabled: sectionIndex == 0 }"
              >
                Previous section
              </RouterLink>
              <RouterLink
                :to="`/${sectionIndex != sections.length - 1 ? sections[sectionIndex + 1].id : ''}`"
                class="btn btn-primary"
                :class="{ disabled: sectionIndex == sections.length - 1 }"
              >
                Next section
              </RouterLink>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  <section v-else>
    <h1>Invalid page</h1>
  </section>
</template>

<script setup>
import { useRoute } from "vue-router";
import { useData } from "../composables/data";
import { computed, onBeforeMount, watch } from "vue";
import PageHeader from "@/components/PageHeader.vue";
import { useReadingProgress } from "@/composables/readingProgress";

const route = useRoute();
const { sections } = useData();
const { readSections, addReadSection } = useReadingProgress();

const sectionIndex = computed(() =>
  sections.value.findIndex((s) => s.id == route.params.id),
);
const section = computed(() =>
  sections.value.find((s) => s.id == route.params.id),
);

onBeforeMount(() => {
  addReadSection(route.params.id);
})

watch(() => route.params.id, () => {
  addReadSection(route.params.id);
}, { immediate: true })
</script>
