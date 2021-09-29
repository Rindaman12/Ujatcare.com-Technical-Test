<template>
    <div class="q-pa-md row items-start q-gutter-md">
        <q-card class="my-card">
            <q-card-section class="header text-white">
                <div class="text-h6" color="white">List Images</div>
            </q-card-section>

            <q-markup-table>
                <thead>
                    <q-tr>
                        <th>Images</th>
                        <th>Description</th>
                        <th>Resolution</th>
                        <th @click="sort('created_at')">Created At</th>
                    </q-tr>
                </thead>
                <tbody>
                    <q-tr v-for="image in sortedImages">
                        <td>
                            <img
                                class="img-responsive"
                                :src="'../images/uploads/' + image.image"
                            />
                        </td>

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
                            <q-badge color="primary">
                                {{image.created_at }}
                            </q-badge>
                        </td>
                    </q-tr>
                </tbody>
            </q-markup-table>
            <p>
  <button @click="prevPage">Previous</button> 
  <button @click="nextPage">Next</button>
  </p>
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

    data() {
        return {
            errors: [],
            images: [],
            currentSort:'created_at',
    currentSortDir:'desc',
    pageSize:5,
    currentPage:1
        };
    },
    created() {
        // Simple GET request using axios
        this.getImages();
    },
    computed:{
    sortedImages:function() {
      return this.images.sort((a,b) => {
        let modifier = 1;
        if(this.currentSortDir === 'desc') modifier = -1;
        if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
        if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
        return 0;
      }).filter((row, index) => {
        let start = (this.currentPage-1)*this.pageSize;
        let end = this.currentPage*this.pageSize;
        if(index >= start && index < end) return true;
      });
    }
  },
    methods: {
        showAlert(type, title, message) {
            Swal.fire({
                icon: type,
                title: title,
                text: message,
            });
        },

    sort:function(s) {
      //if s == current sort, reverse
      if(s === this.currentSort) {
        this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
      }
      this.currentSort = s;
    },
    nextPage:function() {
      if((this.currentPage*this.pageSize) < this.images.length) this.currentPage++;
    },
    prevPage:function() {
      if(this.currentPage > 1) this.currentPage--;
    },


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
.img-responsive{
    width: 100%;
    max-width: 200px;
    max-height: 200px;
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


</style>
