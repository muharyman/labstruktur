<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
      <b-col lg="6" class="my-1">
        <b-form-group
          label="Filter"
          label-cols-sm="3"
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
    <b-table
      show-empty
      small
      stacked="md"
      :items="items"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :filterIncludedFields="filterOn"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
    >
      <template v-slot:cell(name)="row">
        {{ row.value.first }} {{ row.value.last }}
      </template>

      <template v-slot:row-details="row">
        <b-card>
          <ul>
            <li v-for="(value, key) in row.item" :key="key">
              {{ key }}: {{ value }}
            </li>
          </ul>
        </b-card>
      </template>
    </b-table>

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

    {{ items }}
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      items: [],
      fields: [
        {
          key: "no",
          label: "No",
          sortable: true,
          sortDirection: "asc"
        },
        {
          key: "nomor_laporan",
          label: "Nomor Laporan",
          sortable: true,
          class: "text-center"
        },
        {
          key: "tanggal_buka",
          label: "Tanggal Buka",
          sortable: true,
          class: "text-center"
        },
        {
          key: "engineer",
          label: "Engineer",
          sortable: true,
          class: "text-center"
        },
        {
          key: "pemberi_tugas",
          label: "Pemberi Tugas",
          sortable: true,
          class: "text-center"
        },
        {
          key: "nama_proyek",
          label: "Nama Proyek",
          sortable: true,
          class: "text-center"
        },
        {
          key: "status_pengeditan",
          label: "Status Pengeditan",
          sortable: true,
          class: "text-center"
        },
        {
          key: "status_pembayaran",
          label: "Status Pembayaran",
          sortable: true,
          class: "text-center"
        },
        {
          key: "status_persetujuan",
          label: "Status Persetujuan",
          sortable: true,
          class: "text-center"
        },
        {
          key: "laporan",
          label: "Laporan",
          sortable: true,
          class: "text-center"
        },
        {
          key: "info",
          label: "Info",
          sortable: false,
          class: "text-center"
        }
      ],
      totalRows: 1,
      currentPage: 1,
      perPage: 20,
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
    this.totalRows = this.items.length;
    this.axios
      .get("/pengujian/filter/")
      .then(respone => {
        this.items = respone.data.data;
      })
      .catch(e => {
        this.error = e;
        this.showAlert = true;
      });
  },
  methods: {
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    }
  }
};
</script>
