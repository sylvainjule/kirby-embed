<template>
    <k-field :input="_uid" v-bind="$props" class="k-oembed-field k-url-field k-field">

        <div class="preview" v-if="hasMedia">
            <div class="preview-content" v-html="media.html"></div>
            <div class="preview-background"></div>
        </div>

        <k-input ref="input" :id="_uid" v-bind="$props" :value="inputValue" theme="field" v-on="$listeners" @setMedia="setMedia">
            <k-button v-if="link"
                      slot="icon"
                      :icon="icon"
                      :link="value"
                      :tooltip="$t('open')"
                      class="k-input-icon-button"
                      tabindex="-1"
                      target="_blank"
                      rel="noopener" />
        </k-input>

      </k-field>
</template>

<script>
export default {
    extends: 'k-url-field',
    data() {
        return {
            media: Object,
        }
    },
    created() {
        if(this.value.media && this.hasLength(this.value.media)) {
            this.media = this.value.media
        }
    },
    computed: {
        hasMedia() {
            return this.hasLength(this.media)
        },
        inputValue() {
            return this.value.input
        }
    },
    methods: {
        setMedia(media) {
            this.media = media
        },
        hasLength(obj) {
            return Object.keys(obj).length
        }
    }
};
</script>

<style lang="scss">
    @import '../assets/css/styles.scss'
</style>
