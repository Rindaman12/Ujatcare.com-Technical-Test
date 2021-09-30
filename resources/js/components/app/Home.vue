<template>
    <div class="q-pa-md row items-start q-gutter-md">
        <q-card class="my-card">
            <q-card-section class="header text-white">
                <div class="text-h6" color="white">List Images</div>
            </q-card-section>

            <!-- We use a table to show the images and the relevant data -->

            <q-markup-table>
                <thead>
        
                    <q-tr>
                        <th>Images</th>
                        <th>Description</th>
                        <th>Resolution</th>
                        <th>
                            
                        <!-- If we do click on the created_at header, this will sort the images in ASC or DESC -->

                            <q-badge
                                @click="sort('created_at')"
                                color="primary"
                            >
                                Created At
                            </q-badge>
                        </th>
                    </q-tr>
                </thead>
                <tbody class="tbody">
                  
                <!-- We use a v-for to show the images in the body of the table -->


                    <q-tr v-for="image in sortedImages">
                        <td>
                            <!-- We use the custom src of every image in the DB -->

                            <img
                                class="img-responsive"
                                :src="'../images/uploads/' + image.image"
                            />
                        </td>

                                    <!-- We set all the other data in the table body -->


                        <td>
                            <q-badge color="green">
                                {{ image.description }}
                            </q-badge>
                        </td>
                        <td>
                            <q-badge color="purple">
                                {{ image.resolution }}
                            </q-badge>
                        </td>
                        <td>
                            <q-badge color="orange">
                                {{ image.created_at }}
                            </q-badge>
                        </td>
                    </q-tr>
                </tbody>
            </q-markup-table>

                        <!-- We make use of a simple pagination arrows -->


            <button class="pagination" @click="prevPage">
                <q-icon name="arrow_back_ios" />
            </button>
            <button class="pagination" @click="nextPage">
                <q-icon name="arrow_forward_ios" />
            </button>
        </q-card>
    </div>
</template>

<script>
import Csfr from "./Csrf";
import Swal from "sweetalert2";

export default {
    components: {
        inputCsfr: Csfr,
    },

    //We set up the data to use

    data() {
        return {
            errors: [],
            images: [],
            //We setup the pagesize and the current page we are in
            currentSort: "created_at",
            currentSortDir: "desc",
            pageSize: 5,
            currentPage: 1,
        };
    },
    created() {
        // Simple GET request using axios to get all the images entries
        this.getImages();
    },
    computed: {

        //We use a computed property to make the sort in real time
        sortedImages: function () {
            return this.images
                .sort((a, b) => {
                    let modifier = 1;
                    if (this.currentSortDir === "desc") modifier = -1;
                    if (a[this.currentSort] < b[this.currentSort])
                        return -1 * modifier;
                    if (a[this.currentSort] > b[this.currentSort])
                        return 1 * modifier;
                    return 0;
                })
                .filter((row, index) => {
                    let start = (this.currentPage - 1) * this.pageSize;
                    let end = this.currentPage * this.pageSize;
                    if (index >= start && index < end) return true;
                });
        },
    },
    methods: {
        showAlert(type, title, message) {
            Swal.fire({
                icon: type,
                title: title,
                text: message,
            });
        },

        //We use the sort method to get the direction that we want to sort the table to
        sort: function (s) {
    
            if (s === this.currentSort) {
                this.currentSortDir =
                    this.currentSortDir === "asc" ? "desc" : "asc";
            }
            this.currentSort = s;
        },
        //Methods that we use for the pagination arrows
        nextPage: function () {
            if (this.currentPage * this.pageSize < this.images.length)
                this.currentPage++;
        },
        prevPage: function () {
            if (this.currentPage > 1) this.currentPage--;
        },

        //Method to get all the images entries of the api

        getImages: function () {
            axios
                .get("/api/images")
                .then((response) => {
                    setTimeout(() => {
                        this.images = response.data.images;
                    }, 1000);
                })

                .catch((err) => {
                    if (error.response && error.response.status === 401) {
                        location.reload();
                    }

                    console.log(err.response);
                    this.showAlert(
                        "error",
                        "List Couldn't be Loaded.",
                        ...Object.values(err.response.data)[0]
                    );
                });
        },
        exit() {
            this.errors = [];
        },
    },
};
</script>

<style scoped>

.img-responsive {
    width: 100%;
    max-width: 150px;
    max-height: 150px;
    margin: auto;
    margin-top: 4%;
    margin-bottom: 4%;
    align-self: center;
    justify-self: center;
    display: flex;
    flex-direction: column;
    border-radius: 15px;
    overflow: hidden;
}

.pagination {
    color: black;
    display: inline-block;
    float: left;
    padding: 8px 16px;
    align-self: center;
    justify-self: center;
    text-decoration: none;
}
</style>
