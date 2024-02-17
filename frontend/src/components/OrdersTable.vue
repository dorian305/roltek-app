<template>
    <table>
        <tr>
            <td v-for="column in columnsOrder" @click="sortRows(column)">
                {{ column }} <input type="text" @input="filterRows(column, $event.target.value)" placeholder="filter..." />
            </td>
        </tr>
        <tr v-for="row in rowsOrder" @click="openRow(row)">
            <td>{{ row.anID }}</td>
            <td>{{ row.acOID }}</td>
            <td>{{ row.acDokumentenNr }}</td>
            <td>{{ row.anIDStatus }}</td>
            <td>{{ row.anPriority }}</td>
            <td>{{ row.addateInserted }}</td>
            <td>{{ row.addateUpdated }}</td>
            <td>{{ row.anIDTaskType }}</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td v-for="column in rowBackupOrder.columns">
                <td>{{ column }}</td>
            </td>
        </tr>
        <tr>
            <td v-for="value in rowBackupOrder.row">{{ value }}</td>
        </tr>
    </table>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
  setup() {
    const columnsOrder = [
      'anID',
      'acOID',
      'acDokumentenNr',
      'anIDStatus',
      'anPriority',
      'addateInserted',
      'addateUpdated',
      'anIDTaskType',
    ];
    const rowsOrder = ref([]);
    const filters = ref({});

    let sortedBy = "asc";
    let rowBackupOrder = ref({
        columns: [],
        row: [],
    });
    
    // Add columns to filters
    columnsOrder.forEach(column => {
        filters[column] = "";
    });

    // Runs when the component is rendered in the app
    onMounted(async () => {
      const responseData = await axios.get('http://127.0.0.1:8000/api/get-all-import-orders-queues');
      rowsOrder.value = responseData.data.queues;
    });

    // Filtering rows
    const filterRows = async (column, value) => {
        filters.value[column] = value;

        const response = await axios.post('http://127.0.0.1:8000/api/filter-import-queues', {
            filters: filters.value,
        });

        rowsOrder.value = response.data.orders;
    };


    // Sort rows by column
    const sortRows = column => {
        const order = sortedBy === 'asc' ? 1 : -1;

        rowsOrder.value = [...rowsOrder.value].sort((a, b) => {
        const valueA = Number(a[column]);
        const valueB = Number(b[column]);

        if (isNaN(valueA) && isNaN(valueB)) {
            // Both values are not numbers, use string comparison
            const strA = String(a[column]).toLowerCase();
            const strB = String(b[column]).toLowerCase();
            return strA.localeCompare(strB) * order;
        }

        // At least one value is a number, use numeric comparison
        return (valueA - valueB) * order;
        });

        // Toggle sort order for the next click
        sortedBy = sortedBy === 'desc' ? 'asc' : 'desc';
    };


    const openRow = async row => {
        if ([3, 5].includes(row.anIDStatus)){
            const response = await axios.get(`http://127.0.0.1:8000/api/get-order-status/${row.anID}`);

            const orderBackup = response.data.orderBackup;

            rowBackupOrder.value.columns = Object.keys(orderBackup);
            rowBackupOrder.value.row = Object.values(orderBackup);
        }
    };



    return {
      columnsOrder,
      rowsOrder,
      filterRows,
      sortRows,
      openRow,
      rowBackupOrder,
    };
  },
};
</script>
<style>
  table {
    width: 80%;
    margin: auto;
    border-collapse: collapse;
    margin-bottom: 20px;
  }

  th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #f2f2f2;
  }

  tr:hover {
    background-color: #52525265;
  }

  input {
    width: 80%;
    padding: 8px;
    box-sizing: border-box;
    margin-top: 5px;
  }

  .opened-row-table {
    width: 80%;
    margin: auto;
    border-collapse: collapse;
  }

  .opened-row-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
</style>
