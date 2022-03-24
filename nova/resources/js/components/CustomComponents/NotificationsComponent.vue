<template>
    <div>
        <button @click="toggleNotifications" class="btn btn-default custom-space flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="white-xs" fill="none" width="25px" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <div v-if="notificationsNumber !== 0" class="btn btn-default button-toltip btn-danger">{{notificationsNumber !== 0 && notificationsNumber}}</div>
        </button>
        <transition name="fade">
            <div class="container-notifications flex flex-col items-center" v-show="visiblePanel">
                <div class="w-full">
                    <button @click="toggleNotifications" class="w-full rounded-none btn btn-default btn-primary flex justify-center items-center custom-height">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="25px" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="w-full p-3">
                    <div class="card card-notification flex items-center justify-between" v-for="(notification, index) in notificationsList" :key="index">
                        <div @click="goToDetail(notification.redirect, notification.id)" class="content-notification flex flex-col custom-border" :style="`border-color: ${colorNotification[notification.type]}`">
                            <span class="mt-1">{{notification.title}}</span>
                            <span class="mt-1">{{notification.text}}</span>
                            <span class="mt-1">{{notification.datetime}}</span>
                        </div>
                        <button @click="deleteNotification(notification.id)" class="btn flex justify-center items-center p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20px" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import { getNotifications, getNotificationsNotRead, deleteNotifications } from "./apiCalls";
export default {
    props: [],
    data () {
        return {
            visiblePanel: false,
            timer: null,
            notificationsList: [],
            notificationsNumber: 0,
            colorNotification: {
                error: 'var(--danger)',
                info: 'var(--info)',
                success:'limegreen'
            }
        }
    },
    
    async mounted() {
        this.initNotificationsNotRead()
        this.timer = setInterval(() => {
            this.initNotificationsNotRead()
        }, 30000)
    },
    
    methods: {
        toggleNotifications() {
            this.initNotifications()
            this.visiblePanel = !this.visiblePanel
        },
        async initNotifications() {
            let res = {}
            try {
                res = await getNotifications()
            } catch (error) {}
            this.notificationsList = res.data
            this.initNotificationsNotRead()
        },
        async initNotificationsNotRead() {
            let res = {}
            try {
                res = await getNotificationsNotRead()
            } catch (error) {}
            this.notificationsNumber = res.data
        },
        async deleteNotification(id) {
            let res = {}
            try {
                res = await deleteNotifications(id)
            } catch (error) {}
            this.initNotifications()
        },
        goToDetail(path, id) {
            this.visiblePanel = !this.visiblePanel
            if(this.$route.path !== path) {
                this.$router.push({ path: path, params: { id: id } })
            } else {
                window.location.reload(); 
            }
        },
    },
    beforeDestroy() {
        clearInterval(this.timer)
    }
}
</script>
<style>
    .container-notifications {
        background-color: var(--30);
        position: fixed;
        height: 100%;
        width: 25%;
        padding: 0px;
        top: 0;
        overflow: visible;
        border: 0px;
        z-index: 50;
        transition-duration: 250ms;
        transition-timing-function: cubic-bezier(0.645, 0.045, 0.355, 1);
        transition-property: opacity, top, bottom;
        right: 0;
    }
    @media (max-width: 992px) {
        .container-notifications {
            background-color: var(--30);
            position: fixed;
            height: 100%;
            width: 100%;
            padding: 0px;
            top: 0;
            overflow: visible;
            border: 0px;
            z-index: 50;
            transition-duration: 250ms;
            transition-timing-function: cubic-bezier(0.645, 0.045, 0.355, 1);
            transition-property: opacity, top, bottom;
            right: 0;
        }
        .white-xs {
            color: white !important;
        }
        .custom-space {
            margin-right: 0px !important;
        }
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
    .custom-height {
        height: 3rem;
    }
    .card-notification {
        width: 100%;
        padding: .8rem;
    }
    .custom-border {
        border-left-width: 5px
    }
    .content-notification {
        padding: .5rem;
        padding-left: 1rem;
    }
    .custom-toltip {
        height: auto;
        padding: 0;
    }
    .button-toltip {
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 1.7rem;
        padding-left: .5rem;
        padding-right: 0.5rem;
        margin-left: 54px;
        margin-top: -25px;
    }
    .custom-space {
        margin-right: 20px; 
        padding-left: 1rem; 
        padding-right: 1rem;
        -webkit-box-shadow: 0 2px 4px 0 rgb(255 255 255 / 5%);
        box-shadow: 0 2px 4px 0 rgb(255 255 255 / 5%);
        text-shadow: 0 1px 2px rgb(255 255 255 / 5%);
    }
</style>