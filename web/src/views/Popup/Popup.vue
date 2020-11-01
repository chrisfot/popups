<template>
    <transition name="fade">
        <div class="popup" v-if="show">
            <div class="backdrop" @click="show = false">
                <slot></slot>
            </div>
        </div>
    </transition>
</template>

<script>
import Cookies from 'js-cookie';
import {getVerticalScrollPercentage} from '@/utils/scroll.js';

export default {
    name: 'Popup',

    props: {
        id: {
            type: Number,
            required: true,
        },
        timer: {
            type: Number,
            default: null,
        },
        scroll: {
            type: Number,
            default: null,
        },
        exitIntent: {
            type: Boolean,
            default: null,
        },
        triggerEvery: {
            type: Number,
            default: null,
        }
    },

    data() {
        return {
            show: false,
            shownAlready: false,
            isExitIntentActive: false,
        };
    },

    mounted() {
        if (this.timer) {
            this.initTimer();
        }
        if (this.scroll) {
            this.initScroll();
        }
        if (this.exitIntent) {
            this.initExitIntent();
        }
    },

    methods: {

        isEnabled() {
            return Cookies.get('popup-' + this.id) === undefined;
        },

        showPopup() {
            if (this.triggerEvery) {
                Cookies.set('popup-' + this.id, 'hide', { expires: this.triggerEvery });
            }
            this.show = true;
            this.shownAlready = true;
        },

        initTimer() {
            const time = this.timer * 1000; // Convert sec to ms

            setTimeout(() => {
                if (this.isEnabled()) {
                    if (this.exitIntent) {
                        this.isExitIntentActive = true;
                    } else {
                        this.showPopup();
                    }
                }
            }, time);
        },

        initScroll() {
            let position, timeoutHandle;
            window.addEventListener('scroll', (e) => {
                clearTimeout(timeoutHandle);

                timeoutHandle = setTimeout(() => {
                    position = getVerticalScrollPercentage();
                    if (position >= this.scroll) {
                        if (this.isEnabled() && !this.shownAlready) {
                            if (this.exitIntent) {
                                this.isExitIntentActive = true;
                            } else {
                                this.showPopup();
                            }
                        }
                    }
                }, 100);
            })
        },

        initExitIntent() {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                this.initExitIntentMobile();
            } else {
                this.initExitIntentDesktop();
            }
        },

        initExitIntentDesktop() {
            document.addEventListener('mouseleave', (e) => {
                // if cursor leaves towards the address bar
                if (e.y < 250) {
                    if (this.isEnabled() && !this.shownAlready) {
                        if (this.timer || this.scroll) {
                            if (this.isExitIntentActive) {
                                this.showPopup();
                            }
                        } else {
                            this.showPopup();
                        }
                    }
                }
            });
        },

        initExitIntentMobile() {
            let position, lastPosition, timeoutHandle;
            document.addEventListener('scroll', (e) => {
                clearTimeout(timeoutHandle);

                timeoutHandle = setTimeout(() => {
                    position = getVerticalScrollPercentage();
                    // if the user scrolled upwards
                    if (position < lastPosition) {
                        if (this.isEnabled() && !this.shownAlready) {
                            if (this.timer || this.scroll) {
                                if (this.isExitIntentActive) {
                                    this.showPopup();
                                }
                            } else {
                                this.showPopup();
                            }
                        }
                    }

                    lastPosition = position;
                }, 100);
            });
        }

    }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity .25s;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>
