<template>
    <div class="k-embed-field-preview">
        <k-tags-field-preview
            v-if="url"
            class="k-embed-field-preview k-models-field-preview k-pages-field-preview"
            :field="{}"
            :column="{}"
            :value="previewTags" />
    </div>
</template>

<script>
export default {
    props: {
        value: { type: [Object, String], default: '' },
        field: { type: Object, default: () => ({}) },
        column: Object,
    },
    computed: {
        url() {
            const input = typeof this.value === 'object' ? this.value?.input : this.value
            return (input || '').replace(/^\/\/|^.*?:\/\//, '').replace('www.', '')
        },
        isSynced() {
            const media = typeof this.value === 'object' && this.value?.media
            return Boolean(media && Object.keys(media).length && media.code !== null)
        },
        iconSrc() {
            return this.$panel.urls.site + '/media/plugins/sylvainjule/embed/svg/' + this.providerIcon
        },
        previewTags() {
            return this.url ? [{ text: this.url, image: this.previewImage }] : []
        },
        previewImage() {
            // Use Kirby's native k-item image rendering, like the pages list.
            // Keep the same provider / success / failure icon selection.
            return {
                src: this.iconSrc,
                cover: false,
                back: 'pattern',
            }
        },
        providerIcon() {
            if (this.isSynced) {
                if (this.field.icons) {
                    const provider = this.value.media.providerName
                    const icons = ['Vimeo', 'Flickr', 'Instagram', 'SoundCloud', 'Spotify', 'Twitter', 'YouTube']
                    return icons.includes(provider)
                        ? 'embed-icon-' + provider.toLowerCase() + '.svg'
                        : 'embed-icon-synced.svg'
                }
                return 'embed-icon-synced.svg'
            }
            return 'embed-icon-failed.svg'
        },
    },
}
</script>
