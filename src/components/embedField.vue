<template>
    <k-field :input="id" v-bind="$props" class="k-embed-field k-url-field k-field" :style="$attrs.style">

        <div class="preview" v-if="hasMedia" :data-provider="providerName">
            <div class="preview-content" v-html="media.code"></div>
            <div class="preview-background"></div>
        </div>

        <k-input v-bind="$props" type="url" ref="input" :value="inputValue" @input="onInput">

            <div class="k-embed-infos" slot="icon">
                <div class="k-embed-status">
                    <span v-if="loading" class="k-embed-status-loading"><span class="loader"></span></span>
                    <span v-else-if="hasMedia" class="k-embed-status-synced">{{ $t('embed.synced') }} <span class="checkmark"></span></span>
                    <span v-else-if="syncFailed" class="k-embed-status-failed">{{ $t('embed.failed') }} <span class="cross"></span></span>
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
import { isUrl, matchProvider } from '../helpers/validators.js'

export default {
    extends: 'k-url-field',
    data() {
        return {
            media: Object,
            loading: false,
        }
    },
    props: {
        provider: String,
        nocookie: Boolean,
    },
    created() {
        if(this.value && this.value.media && this.hasLength(this.value.media)) {
            this.media = this.value.media
        }
    },
    watch: {
        value() {
            if(this.value && this.value.media && this.hasLength(this.value.media)) {
                this.media = this.value.media
            }
            else {
                this.media = {}
            }
        }
    },
    computed: {
        hasMedia() {
            return this.hasLength(this.media) && this.media.code
        },
        providerName() {
            return this.hasMedia && this.media.providerName ? this.media.providerName.toLowerCase() : null
        },
        syncFailed() {
            return this.inputValue != '' && this.isEmbeddableUrl(this.inputValue) && !this.hasMedia
        },
        inputValue() {
            return this.value && this.value.input ? this.value.input : ''
        }
    },
    methods: {
        onInput(value) {
            if(value == '' || !this.isEmbeddableUrl(value)) {
                this.media = {}
                this.emitInput(value)
                return false;
            }
            if(value.includes('https://www.instagram.com')) {
                value = value.split('?')[0].replace(/\/$/, "");
            }

            this.loading = true
            this.$api
                .get('kirby-embed/get-data', { url: value })
                .then(response => {
                    if(response['status'] == 'success' && response['data']) {
                        this.media = this.processResponseData(response)
                    }
                    else {
                        this.media = {}
                    }

                    this.emitInput(value)
                })
                .catch(error => {
                    this.media = {}
                    this.emitInput(value)
                })
        },
        processResponseData(response) {
            let providerName = response['data']['providerName']

            if(providerName == 'Vimeo') {
                let iframe = response['data']['code']
                    iframe = this.htmlToElement(iframe)
                    iframe.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin')

                response['data']['code'] = iframe.outerHTML
            }

            if(this.nocookie) {
                if(providerName == 'YouTube') {
                    response['data']['code'] = response['data']['code'].replace('youtube.com', 'youtube-nocookie.com')
                }
                else if(providerName == 'Vimeo') {
                    let iframe = response['data']['code']
                        iframe = this.htmlToElement(iframe)

                    let url = new URL(iframe.getAttribute('src'))
                        url.searchParams.append('dnt', 1)
                        iframe.setAttribute('src', url)

                    response['data']['code'] = iframe.outerHTML
                }
            }

            return response['data']
        },
        emitInput(value) {
            this.$emit('input', { input: value, media: this.media })
            this.loading = false

            this.loadEmbedScripts()
        },
        isEmbeddableUrl(value) {
            if(!isUrl(value)) return false
            if(this.provider && !matchProvider(value, this.provider)) return false
            return true
        },
        htmlToElement(html) {
            let template = document.createElement('template')
                html     = html.trim()

            template.innerHTML = html
            return template.content.firstChild
        },
        loadEmbedScripts() {
            if (window.twttr) {
                window.twttr.widgets.load();
            }
            else if (this.media && Object.keys(this.media).length && this.media.providerName.toLowerCase() == 'twitter') {
                const embed = document.createElement('script');
                      embed.src = 'https://platform.twitter.com/widgets.js';
                      document.body.appendChild(embed);
            }

            if (window.instgrm) {
                window.instgrm.Embeds.process();
            }
            else if (this.media && Object.keys(this.media).length && this.media.providerName.toLowerCase() == 'instagram') {
                const embed = document.createElement('script');
                      embed.src = 'https://www.instagram.com/embed.js';
                      document.body.appendChild(embed);
            }
        },
        hasLength(obj) {
            return Object.keys(obj).length
        },
    }
};
</script>

<style lang="scss">
    @import '../assets/css/styles.scss'
</style>
