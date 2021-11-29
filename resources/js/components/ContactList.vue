<template lang="">
    <div>
        <div class="container">
            <h2 class="text-center p-2 text-white bg-primary mt-5">Contacts</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(contact, index) in contacts" :key="index">
                        <td scope="row">{{ index + 1 }}</td>
                        <td scope="row">{{ contact.name }}</td>
                        <td scope="row">{{ contact.email }}</td>
                        <td scope="row">{{ contact.designation }}</td>
                        <td scope="row">{{ contact.contact_no }}</td>
                        <td scope="row">
                            <img
                                height="50px"
                                :src="'images/gallery/' + contact.image"
                                alt=""
                            />
                        </td>
                        <td scope="row">
                            <router-link
                                :to="{
                                    name: 'get_contact',
                                    params: { id: contact.id },
                                }"
                                class="btn btn-primary btn-sm"
                                >Edit</router-link
                            >
                            <button
                                class="btn btn-danger btn-sm"
                                @click.prevent="deleteContact(contact.id)"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    name: "contacts",
    data() {
        return {
            url: document.head.querySelector('meta[name="url"]').content,
            contacts: [],
        };
    },
    created() {
        this.loadData();
    },
    methods: {
        loadData() {
            let url = this.url + "/api/getcontacts";
            // const url = `http://127.0.0.1:8000/api/getcontacts`;
            this.axios.get(url).then((response) => {
                this.contacts = response.data;
                console.log(this.contacts);
            });
        },
        deleteContact(id) {
            if (confirm("are you sure?")) {
                let url = this.url + `/api/deleteContact/${id}`;
                this.axios.delete(url).then((response) => {
                    if (response.status) {
                        this.loadData();
                        this.$utils.showSuccess("success", response.message);
                    } else {
                        this.$utils.showError("Error", response.message);
                    }
                });
            }
        },
        mounted() {
            console.log("Contact List Component Mounted");
        },
    },
};
</script>
