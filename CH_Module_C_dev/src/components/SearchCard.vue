<template>
  <RouterLink class="card mt-3" :to="`/${result.section.id}`">
    <div class="card-body">
      <h2>{{ title }}</h2>
      <p>
        {{ result.excerptBefore.length == 30 ? "..." : ""
        }}{{ result.excerptBefore
        }}<span class="bg-primary text-white">{{
          result.excerptHighlight
        }}</span
        >{{ result.excerptAfter
        }}{{ result.excerptAfter.length == 30 ? "..." : "" }}
      </p>
      <small>
        <i>
          Match found in the section
          {{ result.headingMatch ? "heading" : "text" }}
        </i>
      </small>
    </div>
  </RouterLink>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps(["result"]);

const title = computed(() => {
  return `Chapter ${props.result.section.chapter.number} > Section ${
    props.result.section.chapter.sections.findIndex(
      (s) => s.id == props.result.section.id,
    ) + 1
  }. ${props.result.section.heading}`;
});
</script>
