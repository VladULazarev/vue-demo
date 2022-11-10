<template>
  <form id="contact" @submit.prevent>
        <div class="row">
            <div class="col-md-6 col-sm-12">
            <fieldset>
                <input
                    v-focus
                    v-model.trim="message.name"
                    @input="checkInput(message.name, 'name')"
                    name="name"
                    type="text"
                    id="name"
                    maxlength="50"
                    placeholder="Name"
                    required  autocomplete="off">
            </fieldset>
            </div>

            <div class="col-md-6 col-sm-12">
            <fieldset>
                <input
                    v-model.trim="message.email"
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
                    v-model.trim="message.subject"
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
                v-model.trim="message.textMessage"
                @input="checkInput(message.textMessage, 'textMessage')"
                name="textMessage"
                rows="6" id="textMessage"
                maxlength="300"
                placeholder="Your Message"></textarea>
            </fieldset>
            </div>

            <div class="col-lg-12">
            <fieldset>
                <app-button
                    @click="createMessage"
                    type="submit"
                    id="send-message"
                    class="btn-dark-grey"
                >
                    Send Message
                </app-button>
            </fieldset>
            </div>
        </div>

        <div class="error-messages"></div>
  </form>
</template>

<script>

export default {
    name: 'contact-form',
    data() {
        return {
            message: {
                name: '',
                email: '',
                subject: '',
                textMessage: ''
            }
        }
    },
    methods: {
        createMessage() {

            // Check if there are empty fields
            $(".error-messages").empty();

            let errors = false;

            const testFields = ['name', 'email', 'subject', 'textMessage'];

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

            // If there are empty fields
            if (errors) {
                return false;
            }

            this.$emit('create', this.message)
            this.message = {
                name: '',
                email: '',
                subject: '',
                textMessage: ''
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
    }
}
</script>

<style>
.btn-dark-grey {
    background-color: #2c3e50!important;
    color: #ebebeb!important;
}

.btn-dark-grey:hover {
    color: #bdbdbd!important;
}
</style>
