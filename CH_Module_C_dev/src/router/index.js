import { createRouter, createWebHistory } from 'vue-router'
import ChapterListView from '@/views/ChapterListView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: ChapterListView,
    },
    {
      path: '/:id',
      component: () => import('../views/ChapterView.vue'),
    },
    {
      path: '/search',
      component: () => import('../views/SearchView.vue'),
    },
    {
      path: '/bookmarks',
      component: () => import('../views/BookmarkView.vue'),
    },
  ],
})

export default router
