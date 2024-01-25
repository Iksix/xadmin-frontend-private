import { createRouter, createWebHistory } from "vue-router";

const prefix = "/xadmin"

const routes = [
    {
        name : "home",
        path : `${prefix}/`,
        component : () => import("../components/pages/Home.vue")
    },
    {
        name : "bans",
        path : `${prefix}/bans`,
        component : () => import("../components/pages/Bans.vue")
    },
    {
        name : "mutes",
        path : `${prefix}/mutes`,
        component : () => import("../components/pages/Bans.vue")
    },
    {
        name : "gags",
        path : `${prefix}/gags`,
        component : () => import("../components/pages/Bans.vue")
    },
    {
        name : "profile",
        path : `${prefix}/profile`,
        component : () => import("../components/pages/Bans.vue")
    },
    {
        name : "NotFound",
        path : `${prefix}/*`,
        component : () => import("../components/pages/Home.vue")
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router