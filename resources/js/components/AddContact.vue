<template>
    <div>
        <div class="container">
            <h2 class="text-center p-2 text-white bg-primary mt-5">
                Add Contact
            </h2>
            <div class="card-body">
                <div class="col-md-6 offset-md-3">
                    <form
                        id="validateForm"
                        @submit.prevent="saveContact"
                        enctype="multipart/form-data"
                        novalidate
                    >
                        <div class="alert alert-danger" v-if="errors.length">
                            <ul class="mb-0">
                                <li
                                    v-for="(error, index) in errors"
                                    :key="index"
                                >
                                    {{ error }}
                                </li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input
                                type="text"
                                id="name"
                                v-model="contact.name"
                                class="form-control"
                                placeholder="Enter Name"
                            />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input
                                type="email"
                                id="email"
                                v-model="contact.email"
                                class="form-control"
                                placeholder="Enter Email"
                            />
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input
                                type="text"
                                id="designation"
                                v-model="contact.designation"
                                class="form-control"
                                placeholder="Enter Designation"
                            />
                        </div>
                        <div class="form-group">
                            <label for="contact_no">Contact No</label>
                            <input
                                type="number"
                                id="contact_no"
                                v-model="contact.contact_no"
                                class="form-control"
                                placeholder="Enter Contact Number"
                            />
                        </div>
                        <div class="form-group">
                            <label for="bio">Biography</label>
                            <textarea
                                class="form-control"
                                v-model="contact.bio"
                                id="bio"
                                cols="20"
                                rows="5"
                            ></textarea>
                        </div>
                        <div class="custom-file mb-3">
                            <label for="validatedCustomFile" class="form-label"
                                >Choose Photo</label
                            >
                            <input
                                class="form-control"
                                type="file"
                                name="image"
                                id="validatedCustomFile"
                                v-on:change="saveImage"
                            />
                        </div>
                        <button class="btn btn-primary mt-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            url: document.head.querySelector('meta[name="url"]').content,
            contact: {},
            name: "",
            email: "",
            bio: "",
            designation: "",
            contact_no: "",
            errors: [],
        };
    },
    methods: {
        saveContact() {
            this.errors = [];
            if (!this.contact.name) {
                this.errors.push("Name is required");
            }
            if (!this.contact.email) {
                this.errors.push("Email is required");
            }
            if (!this.contact.designation) {
                this.errors.push("Designation is required");
            }
            if (!this.contact.contact_no) {
                this.errors.push("Contact Number is required");
            }
            if (!this.contact.bio) {
                this.errors.push("Biography is required");
            }
            if (!this.errors.length) {
                let formData = new FormData();
                formData.append("name", this.contact.name);
                formData.append("email", this.contact.email);
                formData.append("designation", this.contact.designation);
                formData.append("bio", this.contact.bio);
                formData.append("contact_no", this.contact.contact_no);
                formData.append("image", this.image);
                let url = this.url + "/api/save_contact";

                this.axios
                    .post(url, formData)
                    .then((response) => {
                        if (response.status) {
                            this.$utils.showSuccess(
                                "success",
                                response.message
                            );
                        } else {
                            this.$utils.showError("Error", response.message);
                        }
                    })
                    .catch((error) => {
                        this.errors.push(error.response.data.error);
                    });
            }
        },
        saveImage(e) {
            this.image = e.target.files[0];
            console.log(this.image);
        },
    },
    mounted: function () {
        console.log("Add Contact Component Loaded");
    },
};
</script>
<style></style>
