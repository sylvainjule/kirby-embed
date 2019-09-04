<template>
    <k-field :input="_uid" v-bind="$props" class="k-oembed-field k-url-field k-field">

        <div class="preview" v-if="hasMedia">
            <div class="preview-content" v-html="media.code"></div>
            <div class="preview-background"></div>
        </div>

        <k-input ref="input" :id="_uid" v-bind="$props" :value="inputValue" theme="field" v-on="$listeners" @setMedia="setMedia" @startLoading="startLoading">
            <div class="k-embed-infos" slot="icon">
                <div class="k-embed-status">
                    <span v-if="loading" class="k-embed-status-loading"><span class="loader"></span></span>
                    <span v-else-if="hasMedia" class="k-embed-status-synced">Synced <span class="checkmark"></span></span>
                    <span v-else-if="syncFailed" class="k-embed-status-failed">Sync failed <span class="cross"></span></span>
                </div>
                <k-button v-if="link"
                          :icon="icon"
                          :link="inputValue"
                          :tooltip="$t('open')"
                          class="k-input-icon-button"
                          tabindex="-1"
                          target="_blank"
                          rel="noopener" />
            </div>

        </k-input>

      </k-field>
</template>

<script>
export default {
    extends: 'k-url-field',
    data() {
        return {
            media: Object,
            loading: false,
        }
    },
    created() {
        if(this.value && this.value.media && this.hasLength(this.value.media)) {
            this.media = this.value.media
        }
    },
    computed: {
        hasMedia() {
            return this.hasLength(this.media)
        },
        syncFailed() {
            return this.inputValue != '' && !this.hasMedia
        },
        inputValue() {
            return this.value && this.value.input ? this.value.input : ''
        }
    },
    methods: {
        setMedia(media) {
            this.media = media
            this.stopLoading()
        },
        hasLength(obj) {
            return Object.keys(obj).length
        },
        startLoading() {
            this.loading = true
        },
        stopLoading() {
            this.loading = false
        }
    }
};
</script>

<style lang="scss">
    @import '../assets/css/styles.scss'
</style>
