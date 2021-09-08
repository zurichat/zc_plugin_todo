import { createRouter, createWebHashHistory } from 'vue-router'
import Busy from '../pages/Busy.vue';
import Main from '../pages/Main.vue';
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
    }
]
const router = createRouter({
    history: createWebHashHistory(),
    routes,

})

export default router