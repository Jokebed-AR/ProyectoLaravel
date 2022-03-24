<template>
<!--    <panel-item :field="field" />-->

    <div class="py-8">
        <div class="flex px-8">
            <div class="bg-white rounded-t-lg overflow-hidden  border-gray-400 py-4 ">
                <ul class="flex border-b">
                    <li
                        v-for="(tab, index) in Object.values(tabs)"
                        class="-mb-px mr-1"
                    >
                        <a :class="{
                            'bg-white inline-block py-2 px-4 text-blue-dark border-l border-t border-r rounded-t font-semibold' : (index === activeIndex),
                            'bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold' : (index !== activeIndex)
                        }"
                           href="#"
                           @click.prevent="activeIndex = index"
                        >{{ tab.name }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <div
            v-if="activeCharacteristic"
            class="flex px-8"
        >
            <div v-html="activeCharacteristic.content"></div>
        </div>

    </div>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    data () {
        return {
            tabs: {},
            activeIndex: 0
        }
    },

    mounted () {
        this.tabs = JSON.parse(this.field.value)
    },
    computed: {
        activeCharacteristic () {
            if (Object.keys(this.tabs).length > 0) {
                return this.tabs[this.activeIndex.toString()]
            }
            return null
        }
    },
}
</script>
