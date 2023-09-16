<script>
import axios from "axios";

/**
 * Companies Component
 */
export default {
    data() {
        return {
            companies: [],
            apiUrl: '/companies/sales'
        };
    },
    computed: {
    },
    mounted() {
        this.loadCompanies();
    },
    methods: {
        loadCompanies() {
            let url = location.origin + this.apiUrl;
            axios.get(url)
                .then((response) => {
                    this.companies = response.data;
                });
        },
    }
};
</script>

<template>
    <div>
        <div class="container-fluid">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Company</th>
                        <th scope="col">Sales</th>
                        <th scope="col">Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table" v-for="company in companies">
                        <td>{{ company.id }}</td>
                        <td>{{ company.companyName }}</td>
                        <td>{{ company.sales }} </td>
                        <td>${{ company.amount }} in total </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<style>
    .table-title {
        margin-top: 20px;
    }
</style>