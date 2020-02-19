<template>
  <div class="root">
    <div class="content">
        <b-container fluid>
        <!-- User Interface controls -->
        <b-row>
          <b-col lg="6" class="my-1">
            <b-form-group
              label="Filter"
              label-cols-sm="1"
              label-align-sm="right"
              label-size="sm"
              label-for="filterInput"
              class="mb-0"
            >
              <b-input-group size="sm">
                <b-form-input
                  v-model="filter"
                  type="search"
                  id="filterInput"
                  placeholder="Type to Search"
                ></b-form-input>
                <b-input-group-append>
                  <b-button :disabled="!filter" @click="filter = ''"
                    >Clear</b-button
                  >
                </b-input-group-append>
              </b-input-group>
            </b-form-group>
          </b-col>
        </b-row>

        <!-- Main table element -->
        <div class="container md-12">
          <b-table
            show-empty
            small
            striped
            stacked="md"
            responsive="true"
            head-variant="dark"
            :current-page="currentPage"
            :per-page="perPage"
            :filter="filter"
            :filterIncludedFields="filterOn"
            hover
            :items="items"
            :fields="fields"
            :sort-by.sync="sortBy"
            :sort-desc.sync="sortDesc"
            @filtered="onFiltered"
            class="table table-striped table-bordered"
          >
            <template v-slot:cell(info)>
              <a class="btn btn-info" role="button" @click="klik">detil</a>
            </template>
          </b-table>
        </div>
        <b-col sm="7" md="6" class="my-1">
          <b-pagination
            v-model="currentPage"
            :total-rows="totalRows"
            :per-page="perPage"
            align="fill"
            size="sm"
            class="my-0"
          ></b-pagination>
        </b-col>
      </b-container>
    </div>
    
  </div>
</template>
<style scoped>
.root{
  padding: 0;
  margin: 0;
  background: #e9f5ec;
  z-index: -1;
  min-height: 100vh;
  overflow-x: hidden;
}
.content{
  margin: 45px 45px;  
  background: white;
  border:2px solid white;
  width: inherit;
  border-radius: 6px;
  box-shadow: 2px 2px 5px #878788;
  padding: 15px; 
}
.container{
  margin:20px auto;
}
</style>
<script>
export default {
  data() {
    return {
      items: [],
      fields: [
        {
          key: "idinventaris",
          thClass: "d-none",
          tdClass: "d-none"
        },
        {
          key: "nama",
          label: "Nama Barang",
          sortable: true,
          class: "text-center"
        },
        {
          key: "deskripsi",
          label: "Deskripsi",
          sortable: false,
          class: "text-center"
        },
        {
          key: "jumlah",
          label: "Jumlah",
          sortable: false,
          class: "text-center"
        },
        {
          key: "catatan",
          label: "Catatan",
          sortable: false,
          class: "text-center"
        },
        {
          key: "file",
          label: "File",
          sortable: false,
          class: "text-center"
        },
        {
          key: "info",
          label: "Info"
        }
      ],

      totalRows: 1,
      currentPage: 1,
      perPage: 12,
      sortBy: "",
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      filterOn: []
    };
  },
  computed: {
    sortOptions() {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => {
          return { text: f.label, value: f.key };
        });
    }
  },
  mounted() {
    // Set the initial number of items
    this.axios
      .get("/inventaris/index/")
      .then(respone => {
        this.items = respone.data.data;
      })
      .catch(e => {
        this.error = e;
        this.showAlert = true;
      });
    this.totalRows = this.items.length;
  },
  methods: {
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    klik(event) {
      window.location.href = `/detailinventaris/${event.target.parentNode.parentNode.parentNode.firstChild.firstChild.innerHTML}`;
    }
  }
};
</script>
