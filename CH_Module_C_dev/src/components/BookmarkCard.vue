<template>
  <div class="card mt-3">
      <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <div>
          <h2>
            Chapter {{ section.chapter.number }} > Section
            {{
              section.chapter.sections.findIndex((s) => s.id == section.id) + 1
            }}. {{ section.heading }}
          </h2>
          <p>
            {{ section.content.substring(0, 60)
            }}{{ section.content.length > 60 ? "..." : "" }}
          </p>
        </div>
        <div class="d-flex gap-2">
          <RouterLink :to="`/${section.id}`" class="btn btn-primary">
            Go to
          </RouterLink>
          <button class="btn btn-danger" @click="emit('delete')">
            Remove
          </button>
        </div>
      </div>
    </div>
</template>

<script setup>
const props = defineProps(["section"])
const emit = defineEmits(["delete"])
</script>