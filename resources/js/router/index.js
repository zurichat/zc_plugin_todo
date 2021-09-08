import { createRouter, createWebHashHistory } from 'vue-router'
import Busy from '../pages/Busy.vue';
import Main from '../pages/Main.vue';
import Trash from '../pages/Trash.vue';
import Archive from '../pages/Archive';
const routes = [{
        path: '/',
        //this is main page where users land
        name: 'Busy',
        component: Busy
    }, {
        path: '/main',
        //this is where the main work lies
        name: 'Main',
        component: Main,
        children: [{
            path: 'details/:id',
            name: 'Details',
            component: () =>
                import ( /* webpackChunkName: "Transactions" */ '../pages/Details.vue')
        }]
    },
    {
        path: '/:pathMatch(.*)*',
        //this is where the main work lies
        name: 'PageNotFound',
        component: Busy
    },
    {
        path: '/trash',
        //this is the page that contains todo trash
        name: 'Trash' ,
        component: Trash
    },
    {
        path: '/archive',
        //this is the page that contains todo archive
        name: 'Archive',
        component: Archive
    }
]
const router = createRouter({
    history: createWebHashHistory(),
    routes,

})

export default router