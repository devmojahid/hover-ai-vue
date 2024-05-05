<script setup>
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onBeforeMount } from 'vue'
import { loadStripe } from '@stripe/stripe-js';
const stripePromise = loadStripe('pk_test_51N4eDoFNqndPjg2XgA6h2UbpIysYQmjOdVh8SaFxsYCPcwNxY5BnIWyuCSYKgxPqK3QhiCOZt6vCmf5rfmgsWPho00GyRSimvC');

const cardNumber = ref('');
const expMonth = ref('');
const expYear = ref('');
const cvc = ref('');

const processPayment = async () => {
    const stripe = await stripePromise;
    const { token, error } = await stripe.createToken('card', {
        card: {
            number: cardNumber.value,
            exp_month: expMonth.value,
            exp_year: expYear.value,
            cvc: cvc.value
        }
    });

    if (error) {
        alert('Error: ' + error.message);
        console.error(error);
        return;
    }

    console.log(token);
    try {
        const response = await axios.post('/subscription/process-payment', {
            token: token.id,
            amount: 1000, // example amount in cents
            currency: 'usd'
        });
        console.log(response.data); // handle success response
    } catch (err) {
        console.error(err); // handle error
    }
};
</script>

<template>

    <Head title="Payment Hear" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <div>
            <input v-model="cardNumber" placeholder="Card Number" />
            <input v-model="expMonth" placeholder="MM" />
            <input v-model="expYear" placeholder="YY" />
            <input v-model="cvc" placeholder="CVC" />
            <button @click="processPayment">Pay</button>
        </div>
    </AuthenticatedLayout>
</template>









<!-- <script setup>
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onBeforeMount } from 'vue'
const props = defineProps({
    product: {
        type: Object,
        required: true
    },
    intent: {
        type: String,
        required: true
    }
});
const token = ref(null)
const stripe = ref(null)
const elements = ref(null)

const clientSecret = ref(props.intent.client_secret);
onBeforeMount(() => {
    axios.post('/subscription/create-payment-intent', {
        items: [{ id: props.product.id, quantity: 1 }]
    }).then(data => {
        stripe.value = Stripe("pk_test_51N4eDoFNqndPjg2XgA6h2UbpIysYQmjOdVh8SaFxsYCPcwNxY5BnIWyuCSYKgxPqK3QhiCOZt6vCmf5rfmgsWPho00GyRSimvC")
        const options = {
            clientSecret: data.data.client_secret
        }
        elements.value = stripe.value.elements(options)
        const paymentElement = elements.value.create('payment')
        paymentElement.mount('#payment-element')

    }).catch(err => {
        console.log(err)
    })
});

const handleSubmit = async (e) => {
    e.preventDefault();
    console.log(elements.value)
    const { error } = await stripe.value.confirmPayment({
        elements: elements.value,
        redirect: "if_required"
    });

    if (error === undefined) {
        axios.post("PAYMENT_SUCCESS_API", {
            token: token.value,
        })
    } else {
        axios.post("PAYMENT_FAILURE_API", {
            token: token.value,
            code: error.code,
            description: error.message,
        })
    }
    // const result = await stripe.value.confirmCardPayment(clientSecret.value, {
    //     payment_method: {
    //         card: elements.value.getElement('payment'),
    //         billing_details: {
    //             name: 'Jenny Rosen'
    //         }
    //     }
    // });
    // if (result.error) {
    //     console.log(result.error.message);
    // } else {
    //     if (result.paymentIntent.status === 'succeeded') {
    //         console.log('success')
    //     }
    // }
}

</script>
<template>

    <Head title="Payment Hear" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <div>
            <h1>Subscribe</h1>
            <!-- <p>Subscribe to {{ product.name }}</p>
        <p>Subscribe to {{ product }}</p>
        <p>Subscribe to {{ intent }}</p>
            <form id="payment-form">
                <div id="payment-element">
                    <!-- Stripe will create form elements here 
                </div>
                <button type="submit" @click="handleSubmit">Pay via Stripe</button>
            </form>
        </div>
    </AuthenticatedLayout>
</template> -->