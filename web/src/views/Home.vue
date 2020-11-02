<template>
    <section>
        <div class="row">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 offset-0 offset-sm-1 offset-md-2 offset-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-4">Available pages</h4>
                            </div>
                            <div>
                                <router-link to="/page" class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-fw fa-plus mr-1"></i>Create new page
                                </router-link>
                            </div>
                        </div>
                        <ul class="list-unstyled">
                            <li v-for="page in pages">
                                <router-link :to="`/page/${page.id}`">{{ page.title }}</router-link>
                                <p>
                                    <template v-for="popup in page.popups">
                                        <span class="badge badge-primary mr-1" >{{ popup.title }}</span>
                                    </template>
                                </p>
                            </li>
                        </ul class="list-unstyled">
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {apiGetPages} from '@/api/popups.api.js';

export default {
    name: 'Home',

    data() {
        return {
            pages: [],
        };
    },

    beforeRouteEnter(to, from, next) {
        apiGetPages().then(response => {
            if (response.success) {
                next(vm => {
                    vm.pages = response.result;
                });
            }
        }).catch(error => {
            console.error(error);
        });
    },

}
</script>

<style scoped>

</style>
