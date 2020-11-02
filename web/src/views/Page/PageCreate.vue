<template>
    <section>
        <div class="row">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 offset-0 offset-sm-1 offset-md-2 offset-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">Create a new page</h4>
                        <form>
                            <div class="form-group">
                                <label for="page-title">Title</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid' : !isValidTitle && displayFormErrors }" id="page-title" @blur="displayFormErrors = true" v-model="title">
                            </div>
                            <button class="btn btn-primary" @click="save">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {apiCreatePage} from '@/api/popups.api.js';

export default {
    name: 'PageCreate',

    data() {
        return {
            title: '',
            displayFormErrors: false,
        };
    },

    computed: {
        isValidTitle() {
            return this.title.length > 0;
        }
    },

    methods: {
        save() {
            this.displayFormErrors = true;
            
            if (this.isValidTitle) {
                apiCreatePage(this.title).then(response => {
                    if (response.success) {
                        this.$router.push({ path: `/page/${response.result.id}` });
                    }
                });
            }
        }
    },

}
</script>

<style scoped>

</style>
