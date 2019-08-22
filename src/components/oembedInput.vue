<script>
export default {
    extends: 'k-url-input',
    methods: {
        onInput(value) {
            this.$api
                .get('kirby-oembed/get-data', { url: value })
                .then(response => {
                    if(response['status'] == 'success' && response['data']) {
                        this.media = response['data']
                    }
                    else {
                        this.media = {}
                    }

                    this.$emit("input", {
                        input: value,
                        media: this.media
                    });
                    this.$emit("setMedia", this.media);
                })
                .catch(error => {})
        }
    }
};
</script>
