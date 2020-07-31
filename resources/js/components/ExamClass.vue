<template>
    <div class="bg-success rounded-lg py-4 d-flex align-items-center flex-column justify-content-center">
        <a :href="url" class="block text-white">
            <div class="h2 font-weight-bold">
                {{ name }}
            </div>
        </a>
    </div>
</template>

<script>
export default {
    name: 'exam-class',
    props: {
        name: {
            type: String,
            required: true
        },
        url: {
            type: String,
            required: true
        }
    }
}
</script>

<style lang="scss" scoped>

</style>