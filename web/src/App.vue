<template>
    <div id="app-layout">
        <header class="bg-white shadow-sm">
            <div class="container">
                <div class="py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-0">Popups Demo</h2>
                    </div>
                    <div>
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <router-link to="/">Home</router-link>
                            </li>
                            <li class="list-inline-item">
                                <router-link to="/page">Create page</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="container my-5">
                <router-view />
            </div>
        </main>
        <footer></footer>
    </div>
</template>

<script>
    export default {
        name: 'App',
    }
</script>

<style scoped>
</style>
