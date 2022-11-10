<template>
  <div class="show-messages content">
    <h1 class="mb-5">Messages</h1>
    <div class="table-responsive">

      <table class="table table-borderless table-striped">

        <thead>
          <tr>
          <th class="col-1 text-center">id</th>
          <th class="col-1">First Name</th>
          <th class="col-2">Last Name</th>
          <th class="col-1">Subject</th>
          <th class="col-3">Message</th>
          <th class="col-1">Contact IP</th>
          <th class="col-1">Date</th>
          <th class="col-1 text-center">Edit</th>
          <th class="col-1 text-center">Delete</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="row in allData">

            <td class="col-1 text-center">{{ row.id }}</td>
            <td class="col-1">{{ row.name }}</td>
            <td class="col-2">{{ row.email }}</td>
            <td class="col-1">{{ row.subject }}</td>
            <td class="col-3">{{ row.message }}</td>
            <td class="col-1">{{ row.contact_ip }}</td>
            <td class="col-1">{{ row.created_at}}</td>

            <td class="col-1 text-center">
              <app-button
                type="button"
                class="btn-green"
                @click="$router.push('/message/' + row.id + '/edit')">
                Edit
              </app-button>
            </td>

            <td class="col-1 text-center">
              <app-button
                type="button"
                class="btn-red"
                @click="deleteData(row.id)">
                Delete
              </app-button>
            </td>

          </tr>
        </tbody>
      </table>
    </div>
    <div class="error-messages"></div>
  </div>
</template>

<script>

import axios from 'axios';

export default {
  data() {
    return {
      allData: []
    }
  },
  methods: {

    async fetchAllData() {

      try {
        const response = await axios.post('https://getyoursite.info/vue-demo/vue-actions.php', {
          action: 'fetchall',
          tableName: 'contact'
        });

        this.allData = response.data;

      } catch (e) {
        $(".error-messages").append('<h3>Connection lost. Please, reload the page!</h3>');
        //console.log(e);
      }

    },

    // Delete a message
    deleteData(id){

      if (confirm("Are you sure you want to remove this data?"))
      {
        axios.post('https://getyoursite.info/vue-demo/vue-actions.php', {
          action:'delete',
          tableName: 'contact',
          id:id
        }).then(function(response){
          //alert(response.data.msg);
          location.reload();
        }).catch(function (error) {
          $(".error-messages").append('<h3>Connection lost. Please, reload the page!</h3>');
          //console.log(error);
        });
      }
    }
  },
  mounted() {
      this.fetchAllData();
      $(".content").fadeTo(500, 1);
  }
}
</script>

<style>
.btn-green {
  background-color: #54b881!important;;
}

.btn-red {
  background-color: #9c27b0!important;
}

.show-messages {
  margin-bottom: 8rem;
}

</style>
