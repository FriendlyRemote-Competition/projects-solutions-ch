<template>
  <PageHeader :title="book.title" />

  <section>
    <template v-if="searchResults.length">
      <RouterLink
        v-for="result in searchResults"
        :key="result.section.id"
        class="card mt-3"
        to="/"
      >
        <div class="card-body">
          <h2>
            Chapter {{ result.section.chapter.number }} > Section
            {{
              result.section.chapter.sections.findIndex(
                (s) => s.id == result.section.id,
              ) + 1
            }}. {{ result.section.heading }}
          </h2>
          <p>
            {{ result.excerptBefore.length == 30 ? "..." : "" }}{{ result.excerptBefore
            }}<span class="bg-primary text-white">{{ result.excerptHighlight }}</span
            >{{ result.excerptAfter }}{{ result.excerptAfter.length == 30 ? "..." : "" }}
          </p>
          <small><i>Match found in the section {{ result.headingMatch ? "heading" : "text" }}</i></small>
        </div>
      </RouterLink>
    </template>
    <div v-else class="card mt-3">
      <div class="card-body">
        <h2>no results found</h2>
      </div>
    </div>
  </section>
</template>

<script setup>
import PageHeader from "@/components/PageHeader.vue";
import { useData } from "@/composables/data";
import { computed } from "vue";
import { useRoute } from "vue-router";

const { book, sections } = useData();
const route = useRoute();

const searchResults = computed(() => {
  if (!route.query.query || !sections.value.length) return [];

  return sections.value
    .filter((s) => {
      return (
        s.heading.toUpperCase().includes(route.query.query.toUpperCase()) ||
        s.content.toUpperCase().includes(route.query.query.toUpperCase())
      );
    })
    .map((s) => {
      const headingMatch = s.heading
        .toUpperCase()
        .includes(route.query.query.toUpperCase());
      const text = headingMatch ? s.heading : s.content;

      const index = text.toUpperCase().indexOf(route.query.query.toUpperCase());
      const excerptBefore = text.substring(index - 30, index);
      const excerptHighlight = text.substring(
        index,
        index + route.query.query.length,
      );
      const excerptAfter = text.substring(
        index + route.query.query.length,
        index + route.query.query.length + 30,
      );

      return {
        section: s,
        headingMatch,
        excerptBefore,
        excerptHighlight,
        excerptAfter,
      };
    });
});
</script>
