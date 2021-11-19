<template>
    <div class="k-embed-field-preview">
        <div class="k-structure-table-text">{{ url }} <span class="k-embed-field-preview-icon" v-if="synced">✓</span></div>
    </div>
</template>

<script>
export default {
    props: {
        value: String,
    },
    computed: {
        url() {
            return this.value.input.replace(/^\/\/|^.*?:\/\//, '')
        },
        synced() {
            return Object.keys(this.value.media).length
        }
    },
};
</script>
