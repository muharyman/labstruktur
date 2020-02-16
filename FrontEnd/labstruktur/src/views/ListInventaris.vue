<template>
  <div>
    <b-container>
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
        <b-col sm="1" md="6" class="my-1">
          <b-form-group
            label="Per page"
            label-cols-sm="4"
            label-cols-md="2"
            label-cols-lg="2"
            label-align-sm="right"
            label-size="sm"
            label-for="perPageSelect"
            class="mb-0"
          >
            <b-form-select
              v-model="perPage"
              id="perPageSelect"
              size="sm"
              :options="pageOptions"
            ></b-form-select>
          </b-form-group>
        </b-col>
      </b-row>

      <!-- Main table element -->
      <div class="container md-12">
        <table
          show-empty
          small
          stacked="md"
          :current-page="currentPage"
          :per-page="perPage"
          :filter="filter"
          :sort-by.sync="sortBy"
          :sort-desc.sync="sortDesc"
          id="dtBasicExample"
          class="table table-striped table-bordered"
        >
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Deskripsi</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Catatan</th>
              <th scope="col">File</th>
              <th scope="col">Info</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in items" :key="item.idinventaris">
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ item.nama }}</td>
              <td>{{ item.deskripsi }}</td>
              <td>user.website</td>
              <td>user.address.city</td>
              <td>catatan</td>
              <td>Info detil</td>
            </tr>
          </tbody>
        </table>
      </div>
      <b-col sm="6" md="6" class="my-1" right>
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
</template>

<script>
import axios from "axios";
export default {
  name: "listinventaris",
  data() {
    return {
      items: [],
      totalRows: 1,
      currentPage: 1,
      perPage: 10,
      pageOptions: [10, 25, 50, 100, 150],
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      infoModal: {
        id: "info-modal",
        title: "",
        content: ""
      }
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
    // eslint-disable-next-line no-undef
    axios
      .get("http://192.168.1.43:8000/api/inventaris/index/")
      .then(response => {
        this.items = response.data.data;
        // eslint-disable-next-line no-console
        console.log(response);
      })
      .catch(error => {
        // eslint-disable-next-line no-console
        console.log(error);
      });
    // Set the initial number of items
    this.totalRows = this.items.length;
  },
  methods: {
    info(item, index, button) {
      this.infoModal.title = `Row index: ${index}`;
      this.infoModal.content = JSON.stringify(item, null, 2);
      this.$root.$emit("bv::show::modal", this.infoModal.id, button);
    },
    resetInfoModal() {
      this.infoModal.title = "";
      this.infoModal.content = "";
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    }
  }
};
</script>

<script>
$(document).ready(function() {
  $("#dtBasicExample").DataTable();
  $(".dataTables_length").addClass("bs-select");
});
</script>
