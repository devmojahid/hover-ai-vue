<script setup>
import { loadStripe } from '@stripe/stripe-js'
import { StripeElements, StripeElement } from 'vue-stripe-js'
import { defineComponent, ref, onBeforeMount } from 'vue'
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

const comp = defineComponent({
    name: 'CardOnly',
    components: {
        StripeElements,
        StripeElement,
    },
})


const clientSecret = ref(props.intent.client_secret);
onBeforeMount(() => {
    // client_secret get from intent props

    const stripeLoaded = ref(false)
    const stripePromise = loadStripe(clientSecret.value)
    stripePromise.then(() => {
        stripeLoaded.value = true
    })
})

</script>
<template>
    <div>
        <h1>Subscribe</h1>
        <!-- <p>Subscribe to {{ product.name }}</p>
        <p>Subscribe to {{ product }}</p>
        <p>Subscribe to {{ intent }}</p> -->

        <StripeElements v-if="stripeLoaded" v-slot="{ elements, instance }" :stripe-key="stripeKey"
            :instance-options="instanceOptions" :elements-options="elementsOptions">
            <StripeElement ref="card" :elements="elements" :options="cardOptions" />
        </StripeElements>
        <button type="button" @click="pay">Pay</button>
        <!-- <form :action="route('subscription.process')" method="post">
            <input type="hidden" name="product" :value="product" />
            <input type="hidden" name="intent" :value="intent" />
            <button type="submit">Subscribe</button>
        </form> -->
    </div>
</template>