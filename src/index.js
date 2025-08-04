import embedField   from './components/embedField.vue'
import embedPreview from './components/embedPreview.vue'

panel.plugin('sylvainjule/embed', {
    fields: {
        embed: embedField,
    },
    components: {
        'k-embed-field-preview': embedPreview,
    }
});
