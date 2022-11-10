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
                  <h2>Send us a message</h2>
                </div>
                <contact-form @create="sendMessage" />
              </div>

            </div>
            <div class="col-md-4">
              <div class="sidebar-item contact-information">
                <div class="sidebar-heading">
                  <h2>contact information</h2>
                </div>
                <div class="contact-info">
                  <ul>
                    <li>
                      <h5><a href="tel:090-484-8080" class="contact-link">090-484-8080</a></h5>
                      <span>PHONE NUMBER</span>
                    </li>
                    <li>
                      <h5><a href="mailto:info@company.com" class="contact-link">info@company.com</a></h5>
                      <span>EMAIL ADDRESS</span>
                    </li>
                    <li>
                      <h5>123 Aenean id posuere dui,
                        <br>Praesent laoreet 10660</h5>
                      <span>STREET ADDRESS</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div id="map">
          <iframe src="https://maps.google.com/maps?q=Av.+L%C3%BAcio+Costa,+Rio+de+Janeiro+-+RJ,+Brazil&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
      </div>

    </div>
  </div>
</section>

</template>

<script>
import ContactForm from '@/components/ContactForm';

import axios from 'axios';

export default {
  components: {
    ContactForm
  },
  data() {
    return {
      message: []
    }
  },
  methods: {

    async sendMessage(message) {
        //console.log(message);

        axios.post('https://getyoursite.info/vue-demo/vue-actions.php',  {
          name: message.name,
          email: message.email,
          subject: message.subject,
          message: message.textMessage,
          action:'saveMessage'
        }).then(function (response) {
            //alert(response.data.msg);
            window.location.href = '/show-messages';
          })
          .catch(function (error) {
            $(".error-messages").append('<h3>Connection lost. Please, reload the page!</h3>');
            //console.log(error);
          });
    },

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

