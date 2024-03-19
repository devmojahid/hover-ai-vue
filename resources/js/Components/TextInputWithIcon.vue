<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel(
    {
        type: String,
        required: true,
    }
);

const props = defineProps({
    placeholderHear: {
        type: String,
        default: '',
    },
    idHear: {
        type: String,
        required: false,
    },
    classHear: {
        type: String,
        default: '',
        required: false,
    },
    requiredHear: {
        type: Boolean,
        default: false,
        required: false,
    },
    typeHear: {
        type: String,
        default: 'text',
        required: false,
    },
    iconHear: {
        type: String,
        default: '',
        required: false,
    },

});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div class="input-group mb-3">
        <input :id="props.idHear" :type="props.typeHear" :class="props.classHear" :placeholder="props.placeholderHear"
            ref="input" :required="props.requiredHear" v-model="model" />
        <div class="input-group-append">
            <div class="input-group-text">
                <span :class="props.iconHear"></span>
            </div>
        </div>
    </div>
    <slot></slot>
</template>