<template>
    <div class="k-embed-field-preview">
        <div class="k-embed-field-preview-inner k-bubble" data-has-text="true">
            <div class="k-embed-icon k-frame">
                <img :src="iconSrc">
            </div>
            <div class="k-embed-url">
                {{ url }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: String,
        field: Object
    },
    computed: {
        url() {
            return this.value.input.replace(/^\/\/|^.*?:\/\//, '')
        },
        isSynced() {
            return Object.keys(this.value.media).length && this.value.media.code !== null
        },
        iconSrc() {
            return this.$panel.$urls.site +'/media/plugins/sylvainjule/embed/svg/'+ this.providerIcon;
        },
        providerIcon() {
            if(this.isSynced) {
                if(this.field.icons) {
                    let provider = this.value.media.providerName
                    let icons    = ['Vimeo', 'Flickr', 'Instagram', 'SoundCloud', 'Spotify', 'Twitter', 'YouTube'];

                    if(icons.includes(provider)) {
                        return 'embed-icon-'+ provider.toLowerCase() +'.svg'
                    }
                    else {
                        return 'embed-icon-synced.svg';
                    }
                }
                else {
                    return 'embed-icon-synced.svg'
                }
            }
            else {
                return 'embed-icon-failed.svg'
            }
        }
    },
};
</script>
