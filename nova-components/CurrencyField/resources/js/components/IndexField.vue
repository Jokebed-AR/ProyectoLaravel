<template>
    <span>$ {{ value }}</span>
</template>

<script>
import { formatMoney } from "../utils";

export default {
    props: ['resourceName', 'field'],

    computed: {
        value() {
            return formatMoney(this.field.value, ',', '.')
        }
    }
}
</script>
