<template>
    <div class="flex border-b border-40">
        <div class="w-1/4 py-4">
            <h4 class="font-normal text-80">Opciones</h4>
        </div>
        <div class="w-3/4 py-4">
            <button
                v-for="option in Object.values(JSON.parse(field.value))"
                class="btn btn-primary btn-default mr-5"
            >
                {{ option.name }}
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
}
</script>
