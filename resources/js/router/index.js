import { createRouter, createWebHistory} from "vue-router";

import invoiceIndex from "../components/invoices/index.vue";
import invoiceNew from "../components/invoices/new.vue";
import invoiceShow from "../components/invoices/show.vue"
import invoiceEdit from "../components/invoices/edit.vue"
import notFound from "../components/NotFound.vue";

const routes = [
    {
        path: '/',
        name : 'InvoiceIndex',
        component: invoiceIndex
    },
    {
        path: '/invoice/new',
        name : 'InvoiceNew',
        component: invoiceNew
    },
    {
        path: '/invoice/show/:id',
        name : 'InvoiceShow',
        component: invoiceShow,
        props: true
    },
    {
        path: '/invoice/edit/:id',
        name : 'InvoiceEdit',
        component: invoiceEdit,
        props: true
    },
    {
        path: '/:pathMatch(.*)*',
        name : 'NotFound',
        component: notFound
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
