import { createRouter, createWebHashHistory } from 'vue-router';
import Pending from '../views/Pending.vue';
import Main from '../views/Main.vue';
import Trash from '../views/Trash.vue';

import Archive from '../views/Archive.vue';
import Detail from '../views/Detail.vue';
import Test from '../views/Test.vue';

const routes = [{
  // landing page
  path: '',
  name: 'Main',
  component: Main,
  children: [{
    path: '',
    name: 'Pending',
    component: Pending,
  }, {
    path: '/archive',
    name: 'Archive',
    component: Archive,
  }, {
    path: '/trash',
    name: 'Trash',
    component: Trash,
  }],
},

{
  path: '/detail/:id',
  name: 'Detail',
  component: Detail,
},
{
  path: '/test',
  name: 'Test',
  component: Test,
},
{
  path: '/:pathMatch(.*)*',
  // wrong urls redirection
  name: 'PageNotFound',
  component: Main,
},
];
const router = createRouter({
  history: createWebHashHistory(),
  routes,
});
export default router;
