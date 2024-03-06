<script>
import { isUrl, matchProvider } from '../helpers/validators.js'

export default {
    extends: 'k-url-input',
    props: {
        provider: String,
        media: Object,
    },
    mounted() {
        this.loadEmbedScripts()
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

            this.$emit('startLoading')
            this.$api
                .get('kirby-embed/get-data', { url: value })
                .then(response => {
                    if(response['status'] == 'success' && response['data']) {
                        if(response['data']['providerName'] == 'Vimeo') {
                            let iframe = response['data']['code']
                                iframe = this.htmlToElement(iframe)
                                iframe.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin')

                            response['data']['code'] = iframe.outerHTML
                        }
                        this.media = response['data']
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
        emitInput(value) {
            this.$emit("input", { input: value, media: this.media });
            this.$emit("setMedia", this.media)

            this.loadEmbedScripts()
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
        }
    },
};
</script>
