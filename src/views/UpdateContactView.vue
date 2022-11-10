<template>
    <section class="contact-us content">
     <div class="container">
       <div class="row">

         <div class="col-lg-12">
           <div class="down-contact">
             <div class="row">
               <div class="col-md-8">
                  <div class="sidebar-item contact-form">
                    <div class="sidebar-heading">
                      <h2>Edit the message</h2>
                    </div>
                    <div class="content">
                      <update-form @update="updateMessage" />
                    </div>
                  </div>
                </div>
               <div class="col-md-4"></div>
             </div>
           </div>
         </div>

         <div class="col-lg-12">
           <div id="map">
             <!-- <iframe src="https://maps.google.com/maps?q=Av.+L%C3%BAcio+Costa,+Rio+de+Janeiro+-+RJ,+Brazil&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen></iframe> -->
           </div>
         </div>

       </div>
     </div>
   </section>

   </template>

<script>

import UpdateForm from '@/components/UpdateForm';

import axios from 'axios';

export default {
  components: {
      UpdateForm
  },
  data() {
      return {
        allData: []
      }
  },
  methods: {

    async updateMessage(message) {

      axios.post('https://getyoursite.info/vue-demo/vue-actions.php',  {
        id: message.id,
        name: message.name,
        email: message.email,
        subject: message.subject,
        message: message.message,
        action:'updateMessage'
      })
      .then(function (response) {
        //alert(response.data.msg);
        window.location.href = '/show-messages';
      })
      .catch(function (error) {
        $(".error-messages").append('<h3>Connection lost. Please, reload the page!</h3>');
        //console.log(error);
      });
    }

  },
  mounted() {
    $(".content").fadeTo(500, 1);
  }
}
</script>

<style scoped>
.contact-us {
  margin-bottom: 7rem;
}
</style>
