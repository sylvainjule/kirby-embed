import embedField   from './components/embedField.vue'
import embedInput   from './components/embedInput.vue'
import embedPreview from './components/embedPreview.vue'

panel.plugin('sylvainjule/embed', {
    fields: {
        embed: embedField,
    },
    components: {
        'k-embed-input': embedInput,
        'k-embed-field-preview': embedPreview,
    }
});
