<template>
    <form @input="isDisabled()" @submit.prevent="submit">
        <card :title="'Kontakt'" :bodyClass="'form-body'" :cardClass="'w-120'">
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
                    <ul v-if="submitErrors.name">
                        <li v-for="message in submitErrors.name">{{ message }}</li>
                    </ul>
                </div>
                <div class="form-row">
                    <label for="subject">
                        Betreff
                    </label>
                    <input id="subject" type="text" placeholder="Betreff" v-model="subject" maxlength="50" required>
                    <ul v-if="submitErrors.subject">
                        <li v-for="message in submitErrors.subject">{{ message }}</li>
                    </ul>
                </div>
                <div class="form-row">
                    <label for="message">
                        Nachricht
                    </label>
                    <textarea id="message" v-model="message" required>Nachricht</textarea>
                    <ul v-if="submitErrors.message">
                        <li v-for="message in submitErrors.message">{{ message }}</li>
                    </ul>
                </div>
                <div class="form-row">
                    <label for="email">
                        E-Mail-Adresse
                    </label>
                    <input id="email" type="email" placeholder="E-Mail-Adresse" autocomplete="email" v-model="email" @keyup="mailConfirmed()" required>
                    <ul v-if="submitErrors.email">
                        <li v-for="message in submitErrors.email">{{ message }}</li>
                    </ul>
                </div>
                <div class="form-row">
                    <label for="email_confirmation">
                        E-Mail-Adresse bestätigen
                    </label>
                    <input id="email_confirmation" type="email" placeholder="E-Mail-Adresse bestätigen" v-model="email_confirmation" @keyup="mailConfirmed()" required>
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
        email_confirmation: String,
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
        submitErrors: [],
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
                email_confirmation: this.email_confirmation,
            }) .then(response => {
                this.sent = true
            }).catch((error) => {
                if (error.response && error.response.status === 422) {
                    this.sending = false
                    this.submitErrors = error.response.data.errors;
                } else {
                    if (window.confirm("An unknown error has occurred. Please try again at another time")) {
                        this.sending = false
                    }
                }
            })
        }, 10),
        isDisabled: function() {
            this.mailConfirmed()
            if (this.sending) {
                return this.disabled = true
            }
            if (this.subject && this.message && this.email && this.email_confirmation && this.confirmed) {
                return this.disabled = false
            }
            return this.disabled = true
        },
        mailConfirmed: function() {
            let email = this.email
            let confirm = this.email_confirmation

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
