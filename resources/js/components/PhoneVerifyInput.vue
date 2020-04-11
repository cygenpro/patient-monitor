<template>
    <div class="form-row mb-2">
        <p class="mb-1">
            Please check your phone, enter the verification code below and click the "Verify" button.
            <br>If you have not received the code, <span class="text-primary text-link" v-on:click="resend">click here</span> to resend.
        </p>
        <p class="text-info">
            {{ message }}
        </p>
        <input autofocus type="number" class="form-control" name="code" id="code" autocomplete="off" min="0" required>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data: function() {
          return {
              message: ''
          }
        },
        methods: {
            resend: function () {
                this.message = '';

                axios.post('/verify-phone/resend')
                    .then((response) => {
                        console.log('should now see the message')
                        console.log(response);
                        this.message = response.data.message;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
