<template>
    <section>
        <div class="row">
            <div class="col-12 col-sm-10 col-md-8 offset-0 offset-sm-1 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-4">{{ title }}</h4>
                            </div>
                            <div>
                                <router-link :to="`/page/${id}/popup`" class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-fw fa-plus mr-1"></i>Create new popup
                                </router-link>
                            </div>
                        </div>
                        <ul>
                            <li v-for="popup in popups" :key="popup.id">
                                <p class="mb-0 font-weight-bold">{{ popup.title }}</p>
                                <p>Timer: {{ popup.timer | displayPrettyNulls }} | Scroll: {{ popup.scroll | displayPrettyNulls }} | Exit-intent: {{ popup.exit_intent }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <template v-for="popup in popups">
            <popup :id="popup.id" :timer="popup.timer" :scroll="popup.scroll" :exit-intent="popup.exit_intent" :trigger-every="popup.trigger_every">
                <popup-content-centered>
                    <div class="d-flex justify-content-between">
                        <h5>{{ popup.title }}</h5>
                        <button class="btn btn-sm btn-danger">&times;</button>
                    </div>
                    <div v-html="popup.content"></div>
                </popup-content-centered>
            </popup>
        </template>
    </section>
</template>

<script>
import {apiGetSinglePage} from '@/api/popups.api.js';
import Popup from '@/views/Popup/Popup.vue';
import PopupContentCentered from '@/views/Popup/Content/PopupContentCentered.vue';

export default {
    name: 'Page',

    components: {
        PopupContentCentered,
        Popup
    },

    filters: {
        displayPrettyNulls(input) {
            return input === null ? 'N/A' : input;
        }
    },

    data() {
        return {
            id: this.$route.params.id,
            title: '',
            popups: [],
        };
    },

    mounted() {
        apiGetSinglePage(this.id).then(response => {
            if (response.success) {
                this.title = response.result.title;
                this.popups = response.result.popups;
            }
        });
    },

}
</script>

<style scoped>
section {
    height: 300vh;
}
</style>
