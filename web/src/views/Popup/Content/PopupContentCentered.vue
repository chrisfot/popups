<template>
    <div class="h-100 d-flex justify-content-center align-items-center">
        <div class="card">
            <div class="card-body">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PopupContentCentered',

}
</script>

<style scoped>

.card {
    min-width: 35%;
    min-height: 30%;
}

</style>
