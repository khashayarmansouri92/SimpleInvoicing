<script setup>
import {onMounted, ref} from "vue";
import {useRouter} from "vue-router";

const router = useRouter();

let invoices = ref([])
let searchInvoice = ref([])

onMounted(async () => {
    getInvoices()
})

const getInvoices = async () => {
    let response = await axios.get("/api/get_all_invoices")
    invoices.value = response.data.invoices;
}

const search = async () => {
    let response = await axios.get("/api/search_invoice?s=" + searchInvoice.value)
    invoices.value = response.data.invoices;
}

const newInvoices = async () => {
    let from = await axios.get("/api/create_invoice");
    await router.push('/invoice/new')
}

const onShow = (id) => {
    router.push('/invoice/show/'+id)
}

</script>
<template>
    <div class="container">
        <div class="invoices">

            <div class="card__header">
                <div>
                    <h2 class="invoice__title">Invoices</h2>
                </div>
                <div>
                    <a class="btn btn-secondary" @click="newInvoices">
                        New Invoice
                    </a>
                </div>
            </div>

            <div class="table card__content">
                <div class="table--filter">
                <span class="table--filter--collapseBtn ">
                    <i class="fas fa-ellipsis-h"></i>
                </span>
                    <div class="table--filter--listWrapper">
                        <ul class="table--filter--list">
                            <li>
                                <p class="table--filter--link table--filter--link--active">
                                    All
                                </p>
                            </li>
                            <li>
                                <p class="table--filter--link ">
                                    Paid
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="table--search">
                    <div class="table--search--wrapper">
                        <select class="table--search--select" name="" id="">
                            <option value="">Filter</option>
                        </select>
                    </div>
                    <div class="relative">
                        <i class="table--search--input--icon fas fa-search "></i>
                        <input class="table--search--input" type="text" placeholder="Search invoice"
                               v-model="searchInvoice" @keyup="search()">
                    </div>
                </div>

                <div class="table--heading">
                    <p>ID</p>
                    <p>Date</p>
                    <p>Number</p>
                    <p>Customer</p>
                    <p>Due Date</p>
                    <p>Total</p>
                </div>

                <!-- item 1 -->
                <div class="table--items" v-for="item in invoices" :key="item.id" v-if="invoices.length > 0">
                    <a href="#" @click="onShow(item.id)" class="table--items--transactionId">#{{ item.id }}</a>
                    <p>{{ item.date }}</p>
                    <p>#{{ item.number }}</p>
                    <p v-if="item.customer">{{ item.customer.firstname }}</p>
                    <p v-else></p>
                    <p>{{ item.due_date }}</p>
                    <p> $ {{ item.total }}</p>
                </div>
                <div class="table--items" v-else>
                    <p>Invoice Not Found</p>
                </div>
            </div>

        </div>
    </div>

</template>
