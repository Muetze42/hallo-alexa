<template>
    <form @input="isDisabled()" @submit.prevent="submit">
        <card :title="'Kontakt'" :bodyClass="'form-body'" :cardClass="'w-80'">
            <div v-if="sent" class="contact-success">
                <p>Vielen Dank für Deine Nachricht.</p>
                <i class="far fa-envelope fa-5x"></i>
            </div>
            <template v-if="!sent">
                <div class="form-row">
                    <label for="name">
                        Name
                    </label>
                    <input id="name" type="text" placeholder="Name" v-model="name" maxlength="50" required>
                </div>
                <div class="form-row">
                    <label for="subject">
                        Betreff
                    </label>
                    <input id="subject" type="text" placeholder="Betreff" v-model="subject" maxlength="50" required>
                </div>
                <div class="form-row">
                    <label for="message">
                        Nachricht
                    </label>
                    <textarea id="message" v-model="message" required>Nachricht</textarea>
                </div>
                <div class="form-row">
                    <label for="email">
                        E-Mail-Adresse
                    </label>
                    <input id="email" type="email" placeholder="E-Mail-Adresse" autocomplete="email" v-model="email" @keyup="mailConfirmed()" required>
                </div>
                <div class="form-row">
                    <label for="confirm">
                        E-Mail-Adresse bestätigen
                    </label>
                    <input id="confirm" type="email" placeholder="E-Mail-Adresse bestätigen" v-model="confirm" @keyup="mailConfirmed()" required>
                    <p v-if="!confirmed">Die eingegebenen E-Mail-Adressen stimmen nicht überein.</p>
                </div>
            </template>
            <template v-slot:footer v-if="!sent">
                <div class="confirmations">
                    <label for="confirmation">Datenschutzbestimmungen bestätigen</label>
                    <input id="confirmation" type="checkbox" v-model="confirmation">
                </div>
                <div class="submit-row">
                    <span class="ping-container">
                        <button type="submit" :disabled='disabled'>
                            Nachricht senden
                        </button>
                        <span class="ping-1" v-if='sending'>
                            <span class="ping-2"></span>
                            <span class="ping-3"></span>
                        </span>
                    </span>
                </div>
            </template>
        </card>
    </form>
</template>

<script>
import Default from '../Layout/Default'
import Card from '../Components/Card'

export default {
    layout: Default,
    name: "Index",
    props: {
        links: Object,
        subject: String,
        name: String,
        message: String,
        email: String,
        confirm: String,
        confirmation: Boolean,
    },
    components: {
        Card
    },
    data: () => ({
        confirmed: true,
        sending: false,
        disabled: true,
        sent: false,
    }),
    methods: {
        submit: _.debounce(function () {
            this.sending = true
            this.disabled = true

            axios.post(route("contact.store"), {
                _token: this._token,
                subject: this.subject,
                name: this.name,
                message: this.message,
                email: this.email,
                confirm: this.confirm,
            }) .then(response => {
                this.sent = true
            }).catch((error) => {
                if (error.response && error.response.status === 421) {
                    if (window.confirm(error.response.data)) {
                        this.sending = false
                    }
                } else {
                    if (window.confirm("Ein unbekannter Fehler ist aufgetreten. Bitte versuche es zu einem anderen Zeitpunkt nochmal")) {
                        this.sending = false
                    }
                }
                /*
                if (error.response) {
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                } else if (error.request) {
                    console.log(error.request);
                } else {
                    console.log('Error', error.message);
                }
                console.log(error.config);
                */
            })
        }, 10),
        isDisabled: function() {
            this.mailConfirmed()
            if (this.sending) {
                return this.disabled = true
            }
            if (this.subject && this.message && this.email && this.confirm && this.confirmed) {
                return this.disabled = false
            }
            return this.disabled = true
        },
        mailConfirmed: function() {
            let email = this.email
            let confirm = this.confirm

            if (!confirm || !email) {
                return this.confirmed = true
            }

            let checkEmail = email.trim()
            let checkConfirm = confirm.trim()

            if (checkEmail === checkConfirm) {
                return this.confirmed = true
            }

            return this.confirmed = false
        },
    },
}
</script>
