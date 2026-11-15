<template>
    <k-field v-bind="$props" :input="id || name" :link="undefined" :class="['k-embed-field', 'k-url-field', $attrs.class]" :style="$attrs.style">
        <div v-if="hasMedia" class="preview" :data-provider="providerName">
            <div class="preview-content" v-html="media.code"></div>
            <div class="preview-background"></div>
        </div>

        <k-input v-bind="$props" ref="input" :id="id || name" :value="inputValue" type="url" @input="onInput">
            <template #icon>
                <div class="k-embed-infos">
                    <div v-if="loading || hasMedia || syncFailed" class="k-embed-status">
                        <span v-if="loading" class="k-embed-status-loading"><span class="loader"></span></span>
                        <span v-else-if="hasMedia" class="k-embed-status-synced">{{ $t('embed.synced') }} <span class="checkmark"></span></span>
                        <span v-else-if="syncFailed" class="k-embed-status-failed">{{ $t('embed.failed') }} <span class="cross"></span></span>
                    </div>
                    <k-button v-if="link && inputValue"
                              :icon="icon"
                              :link="inputValue"
                              :title="$t('open')"
                              class="k-input-icon-button"
                              tabindex="-1"
                              target="_blank"
                              rel="noopener"/>
                    <span v-else class="k-embed-type-icon" aria-hidden="true">
                        <k-icon :type="icon || 'url'" />
                    </span>
                </div>
            </template>
        </k-input>
    </k-field>
</template>

<script>
import { isUrl, matchProvider } from '../helpers/validators.js'
import { processEmbed } from '../helpers/embedScripts.js'

export default {
    inheritAttrs: false,
    props: {
        id: String,
        name: String,
        label: String,
        type: String,
        help: [String, Object],
        disabled: Boolean,
        required: Boolean,
        autofocus: Boolean,
        translate: Boolean,
        hasDiff: Boolean,
        endpoints: Object,
        autocomplete: String,
        placeholder: String,
        spellcheck: Boolean,
        minlength: Number,
        maxlength: Number,
        pattern: String,
        font: String,
        counter: [Boolean, Object],
        before: String,
        after: String,
        icon: { type: String, default: 'url' },
        link: { type: Boolean, default: true },

        // specific props ↓
        provider: String,
        icons: Boolean,
        value: { type: [Object, String], default: '' },
    },
    emits: ['input'],
    data() {
        return {
            media: {},
            loading: false,
            requestId: 0,
        }
    },
    created() {
        this.setMediaFromValue(this.value)
    },
    mounted() {
        this.loadEmbedScripts()
    },
    beforeUnmount() {
        this.requestId++
    },
    watch: {
        value(value) {
            this.setMediaFromValue(value)
        },
        'media.code': {
            handler() {
                this.loadEmbedScripts()
            },
            flush: 'post',
        },
    },
    computed: {
        hasMedia() {
            return this.hasLength(this.media) > 0 && Boolean(this.media.code)
        },
        providerName() {
            return this.hasMedia && this.media.providerName ? this.media.providerName.toLowerCase() : null
        },
        syncFailed() {
            return this.inputValue !== '' && this.isEmbeddableUrl(this.inputValue) && !this.hasMedia
        },
        inputValue() {
            return typeof this.value === 'string' ? this.value : (this.value?.input || '')
        },
    },
    methods: {
        focus() {
            this.$refs.input?.focus()
        },
        setMediaFromValue(value) {
            this.media = value && typeof value === 'object' && value.media && this.hasLength(value.media) ? value.media : {}
        },
        onInput(value) {
            const request = ++this.requestId

            if(value === '' || !this.isEmbeddableUrl(value)) {
                this.media = {}
                this.emitInput(value)
                return
            }

            if(value.includes('https://www.instagram.com')) {
                value = value.split('?')[0].replace(/\/$/, '')
            }

            this.loading = true
            this.$api.get('kirby-embed/get-data', { url: value })
                .then(response => {
                    if(request !== this.requestId) return

                    this.media = response?.status === 'success' && response.data ? response.data : {}
                    this.emitInput(value)
                })
                .catch(() => {
                    if(request !== this.requestId) return
                    this.media = {}
                    this.emitInput(value)
                })
        },
        emitInput(value) {
            this.$emit('input', { input: value, media: this.media })
            this.loading = false
        },
        isEmbeddableUrl(value) {
            if(!isUrl(value)) return false
            if(this.provider && !matchProvider(value, this.provider)) return false
            return true
        },
        loadEmbedScripts() {
            this.$nextTick(() => {
                if(this.hasMedia) {
                    processEmbed(this.providerName)
                }
            })
        },
        hasLength(obj) {
            return obj && typeof obj === 'object' ? Object.keys(obj).length : 0
        },
    },
}
</script>

<style lang="scss">
    @import '../assets/css/styles.scss';
</style>
