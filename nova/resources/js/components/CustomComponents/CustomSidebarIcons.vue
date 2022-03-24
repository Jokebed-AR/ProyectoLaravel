<template>
    <div id="mySidebar" 
        class="sidebar min-h-screen flex-none"
        @mouseover="toggleSidebar"
        @mouseout="toggleSidebar"
        :class="mini ? 'isClose': 'isOpen'"
        :style="!mini ? 'width: 13.75rem;' : ''"
    >
        <slot/>
    </div>
</template>

<script>

export default {
    data () {
        return {
            mini: true
        }
    },
    computed: {
        
    },
    async mounted() {
        
    },
    methods: {
        toggleSidebar() {
            if (this.mini) {
                this.mini = false;
            } else {
                this.mini = true;
            }

            return
        }
    },
    watch: {
        
    }
}
</script>
<style scoped>
    .isClose {
        width: 45px
    }
    .sidebar {
        width: 45px;
        position: relative;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: rgb(255, 255, 255, 1);
        transition: 0.5s;
        overflow-x: hidden;
        padding-top: 60px;
    }

    .sidebar a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        /* font-size: 25px; */
        /* color: #818181; */
        display: block;
    }

    .sidebar a:hover {
        color: #f1f1f1;
    }

    main .sidebar {
        position: absolute;
        top: 0;
        right: 25px;
        /* font-size: 36px; */
        margin-left: 50px;
    }

    .material-icons,
    .icon-text {
        vertical-align: middle;
    }

    .material-icons {
        padding-bottom: 3px;
        margin-right: 30px;
    }

    #main {
        padding: 16px;
        margin-left: 85px;
        transition: margin-left 0.5s;
    }

    @media screen and (max-height: 450px) {
        .sidebar {
            padding-top: 15px;
        }
        /* .sidebar a {
            font-size: 18px;
        } */
    }
</style>