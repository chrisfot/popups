export default [
    {
        path: '/',
        component: () => import(/* webpackChunkName: "home" */ '@/views/Home.vue'),
    },
    {
        path: '/page',
        component: () => import(/* webpackChunkName: "page-create" */ '@/views/Page/PageCreate.vue'),
    },
    {
        path: '/page/:id',
        component: () => import(/* webpackChunkName: "page" */ '@/views/Page/Page.vue'),
    },
    {
        path: '/page/:id/popup',
        component: () => import(/* webpackChunkName: "page-popup-create" */ '@/views/Popup/PopupCreate.vue'),
    },
    {
        path: '/error',
        component: () => import(/* webpackChunkName: "error-500" */ '@/views/Error/ErrorGeneral.vue')
    },
    {
        path: '/forbidden',
        component: () => import(/* webpackChunkName: "error-403" */ '@/views/Error/ErrorForbidden.vue')
    },
    {
        path: '*',
        component: () => import(/* webpackChunkName: "error-404" */ '@/views/Error/ErrorNotFound.vue')
    },
]
