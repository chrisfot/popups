<template>
    <section>
        <div class="row">
            <div class="col-12 col-sm-10 col-md-8 offset-0 offset-sm-1 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">Create a new popup</h4>
                        <form>

                            <h5 class="mb-2 pb-2 border-bottom">Content</h5>
                            <div class="form-group">
                                <label for="popup-page">Page</label>
                                <select class="form-control" id="popup-page" v-model="popup.page" disabled>
                                    <option v-for="page in pages" :key="page.id" :value="page.id">{{ page.title }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="popup-title">Title</label>
                                <input type="text" class="form-control" id="popup-title" v-model="popup.title">
                            </div>
                            <div class="form-group">
                                <label for="popup-content">Content</label>
                                <textarea class="form-control" id="popup-content" rows="5" v-model="popup.content"></textarea>
                                <small class="form-text text-muted"><i class="fa fa-fw fa-info-circle mr-1"></i>HTML is allowed.</small>
                            </div>

                            <h5 class="mb-2 pb-2 border-bottom">Settings</h5>
                            <p class="text-muted mb-0">If exit-intent is enabled it is going to be the action required to show the popup.</p>
                            <p class="text-muted">If timer or scroll are enabled too they are going to be required for the exit-intent to be triggered.</p>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="popup-exit-intent" v-model="popup.exitIntent">
                                    <label class="custom-control-label" for="popup-exit-intent">Show on exit-intent</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="popup-toggle-timer" v-model="isTimerSet">
                                    <label class="custom-control-label" for="popup-toggle-timer">Show on a timer</label>
                                    <transition name="fade">
                                        <div class="w-25" v-show="isTimerSet">
                                            <select class="form-control form-control-sm" id="popup-timer" v-model="popup.timer">
                                                <option value="5">After 5 seconds</option>
                                                <option value="30">After 30 seconds</option>
                                                <option value="60">After 1 minute</option>
                                                <option value="300">After 5 minutes</option>
                                                <option value="600">After 10 minutes</option>
                                            </select>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="popup-toggle-scroll" v-model="isScrollSet">
                                    <label class="custom-control-label" for="popup-toggle-scroll">Show after scrolling</label>
                                    <transition name="fade">
                                        <div class="w-25" v-show="isScrollSet">
                                            <select class="form-control form-control-sm" id="popup-scroll" v-model="popup.scroll">
                                                <option value="25">25% of page</option>
                                                <option value="50">50% of page</option>
                                                <option value="75">75% of page</option>
                                                <option value="100">100% of page</option>
                                            </select>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="popup-trigger-every">Trigger at most every</label>
                                <select class="form-control" id="popup-trigger-every" v-model="popup.triggerEvery">
                                    <option value="0">always</option>
                                    <option v-for="step in triggerOptions" :value="step">{{ step }} days</option>
                                </select>
                            </div>

                            <button class="btn btn-primary my-4" @click="save">Save</button>

                            <div class="alert alert-danger" v-if="errors.length > 0">
                                <p class="mb-0" v-for="error in errors">{{ error }}</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {apiGetPages, apiCreatePopup} from '@/api/popups.api.js';

export default {
    name: 'PopupCreate',

    data() {
        return {
            pages: [],
            popup: {
                title: '',
                content: '',
                page: '',
                timer: '5',
                scroll: '25',
                exitIntent: false,
                triggerEvery: 0,
            },
            isTimerSet: false,
            isScrollSet: false,
            triggerOptions: [1,2,3,4,5,6,7,15,30,60,90,180,365],
            errors: [],
        };
    },

    beforeRouteEnter(to, from, next) {
        apiGetPages().then(response => {
            if (response.success) {
                next(vm => {
                    vm.pages = response.result;
                    vm.popup.page = to.params.id;
                });
            }
        });
    },

    methods: {

        save() {
            // Order matters
            const data = [
                this.$route.params.id,
                this.popup.title,
                this.popup.content,
                this.isTimerSet ? this.popup.timer : null,
                this.isScrollSet ? this.popup.scroll : null,
                this.popup.exitIntent,
                this.popup.triggerEvery,
            ];

            this.errors = [];

            apiCreatePopup(...data).then(response => {
                if (response.success) {
                    this.$router.push({ path: `/page/${response.result.page_id}` });
                } else {
                    for (const field in response.result) {
                        response.result[field].forEach(error => {
                            this.errors.push(error);
                        });
                    }
                }
            });
        },

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
