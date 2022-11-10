<template>
    <form id="contact" @submit.prevent>
        <div class="row">
            <div class="col-md-6 col-sm-12">
            <fieldset>
                <input
                    v-model.trim="message['name']"
                    @input="checkInput(message.name, 'name')"
                    name="name"
                    type="text"
                    id="name"
                    maxlength="50"
                    placeholder="Name"
                    required autocomplete="off">
            </fieldset>
            </div>

            <div class="col-md-6 col-sm-12">
            <fieldset>
                <input
                    v-model.trim="message['email']"
                    @input="checkInput(message.email, 'email')"
                    name="email"
                    type="email"
                    id="email"
                    maxlength="50"
                    placeholder="Your email"
                    required autocomplete="off">
            </fieldset>
            </div>

            <div class="col-md-12 col-sm-12">
            <fieldset>
                <input
                    v-model.trim="message['subject']"
                    @input="checkInput(message.subject, 'subject')"
                    name="subject"
                    type="text"
                    id="subject"
                    maxlength="50"
                    placeholder="Subject"
                    required autocomplete="off">
            </fieldset>
            </div>

            <div class="col-lg-12">
            <fieldset>
                <textarea
                v-model.trim="message['message']"
                @input="checkInput(message.message, 'message')"
                name="message"
                rows="6" id="message"
                maxlength="300"
                placeholder="Your Message"></textarea>
            </fieldset>
            </div>

            <div class="col-lg-12">
            <fieldset>
                <app-button
                    @click="updateMessage"
                    type="submit"
                    id="send-message"
                    class="btn-dark-grey"
                >Save Message</app-button>
            </fieldset>
            </div>
        </div>
        <div class="error-messages"></div>
    </form>
</template>

<script>

import axios from 'axios';

export default {
    name: 'update-form',
    data() {
        return {
            message: {
                name: '',
                email: '',
                subject: '',
                message: ''
            },
        }
    },
    methods: {

        updateMessage() {

            $(".error-messages").empty();

            let errors = false;

            const testFields = ['name', 'email', 'subject', 'message'];

            const arrayLength = testFields.length;

            for (let i = 0; i < arrayLength; i++) {

                if (this.message[testFields[i]].length == 0) {
                    $(".error-messages").append("<span>The '" + testFields[i] + "' field is required</span>");

                    errors = true;
                }
            }

            // Check the email field
            const checkEmail = this.message.email.match(/^[\w.\-]{2,30}@[\w\-]{2,30}\.[A-Za-z]{2,8}$/);

            // If 'email' is not empty and pattern not match
            if (! checkEmail && this.message.email.length != 0) {
                $(".error-messages").append("<span>The 'email' pattern not match.</span>");
                errors = true;
            }

            if (errors) {
                return false;
            }

            this.id = this.$route.params.id;

            this.$emit('update', this.message)
            this.message = {
                id: this.id,
                name: '',
                email: '',
                subject: '',
                message: ''
            }
        },
        // Get the current message
        async fetchAllData() {

            try {

                this.id = this.$route.params.id;

                const response = await axios.post('https://getyoursite.info/vue-demo/vue-actions.php', {
                    action: 'getonerecord',
                    tableName: 'contact',
                    id: this.id
                });

                this.message = response.data;

            } catch (e) {
                $(".error-messages").append('<h3>Connection lost. Please, reload the page!</h3>');
                //console.log(e);
            }
        },
        checkInput(value, inputName) {

            // Check if there are 'bad' characters
            const checkData = value.match(/^[\w.А-Яа-я!?\, \-\'@]+$/);

            // If 'value' has 'bad symbols' cut it to 1 sybmbol and stop the script
            if (! checkData) {

                // Cut current input
                value = value.substring(0, 1);

                // Set new value for the currrent model
                this.message[inputName] = value;

                // Set new value for the current input
                $('#' + inputName).val(value);

                return false;
            }
        }
    },
    mounted() {
      this.fetchAllData();
    }
}
</script>

