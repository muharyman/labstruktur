<template>
  <div class="root">
    <div id="pengujian"> 
      <h1 class="title">Daftar Pengujian</h1>
      <TableView :headers="columns" :rows="items" :sort="sort1">
        <template v-slot:items="{ row }">
          <td>{{ row.first_name }}</td>
          <td>{{ row.last_name }}</td>
          <td>{{ row.email }}</td>
          <td>{{ row.age }}</td>
          <td>{{ row.country }}</td>
          <td>{{ row.category }}</td>
          <td>{{ row.last_update }}</td>
        </template>
        <template v-slot:no-data>
          <span>No data</span>
        </template>
      </TableView>
      <Footer></Footer>
    </div>
  </div>   
</template>
<script>
import TableView from "@/components/TableView";
export default {
  name: "listpengujian",
  components: {
    TableView
  },
  data() {
    return {
      columns: [
        {
          label: "No",
          field: "no",
          sortable: true,
          type: "Number"
        },
        {
          label: "Nomor Laporan",
          field: "nomor_laporan",
          sortable: true,
          type: "String"
        },
        {
          label: "Tanggal Buka",
          field: "tanggal_buka",
          sortable: true,
          type: "String"
        },
        {
          label: "Engineer",
          field: "engineer",
          sortable: true,
          type: "String"
        },
        {
          label: "Pemberi Tugas",
          field: "pemberi_tugas",
          sortable: true,
          type: "Number"
        },
        {
          label: "Nama Proyek",
          field: "nama_proyek",
          sortable: true,
          type: "String"
        },
        {
          label: "Status Persetujuan",
          field: "status_persetujuan",
          sortable: true,
          type: "String"
        },
        {
          label: "Status Pembayaran",
          field: "status_pembayaran",
          sortable: true,
          type: "String"
        },
        {
          label: "Status Pengeditan",
          field: "status_pengeditan",
          sortable: true,
          type: "String"
        },
        {
          label: "Laporan",
          field: "laporan",
          sortable: true,
          type: "String"
        },
        {
          label: "Info",
          field: "info",
          sortable: false,
          type: "String"
        }
      ],
      items: [],
      sort1: {
        field: "nomor_laporan",
        order: "asc"
      },
      sort2: {
        field: "engineer",
        order: "asc"
      },
      pagination: {
        itemsPerPage: 10,
        align: "center",
        visualStyle: "select"
      }
    };
  }
};
</script>
<style lang="scss" scoped>
@import url(http://fonts.googleapis.com/css?family=Roboto+Mono);
.root{
  background: #e9f5ec;
  min-height: 100vh;
  width: 100%;
  margin: 0;
  padding: 25px;
}
#pengujian {
  font-family: "Raleway", Helvetica, Arial, sans-serif;
  font-size: 12px;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  width: 100%;
  margin: 3% auto;
  background: white;
  border-radius:6px;
  box-shadow: 2px 2px 5px #9E9FA1;
}
h1 {
  margin:25px;
  color: black;
}
.separator {
  margin: 2em 0;
  text-align: center;
}
.custom-style {
  // Table styles
  .ozn-table {
    border-collapse: collapse;
    width: 100%;
    thead {
      th {
        border-bottom: 1px solid #ffffff;
        padding: 0 10px;
        height: 48px;
        text-align: left;
        font-size: 1em;
        color: #fff;
        background-color: #7cc3fd;
        cursor: pointer;
        &:hover {
          span {
            text-decoration: none;
            // text-decoration-style: dotted;
            color:#24D39B;
          }
        }
        i {
          color: #ffffff;
          &.active {
            color: #ff00aa;
            + span {
              color: #a9237c;
            }
          }
        }
      }
    }
    tbody {
      tr {
        &:nth-child(odd) {
          background-color: #e9f5ff;
        }
        &:nth-child(even) {
          background-color: #fafaeb;
        }
      }
      td {
        border-bottom: 1px solid #ffffff;
        padding: 0 10px;
        height: 48px;
        font-size: 1em;
      }
    }
  }
  // Paginator styles
  .ozn-paginator {
    margin-top: 0.5em;
    select {
      border: 1px solid #7cc3fd;
      border-radius: 8px;
      color: #ffffff;
      background-color: #7cc3fd;
      outline: none;
    }
    button {
      border: 1px solid #7cc3fd;
      border-radius: 8px;
      color: #ffffff;
      background-color: #7cc3fd;
      outline: none;
    }
  }
}
</style>
