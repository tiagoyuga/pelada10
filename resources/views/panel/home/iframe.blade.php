<script>

    //parent.onCloseIframe({{ request('table_id') }}, '{{ request('table_reference') }}', '{{ request('table_text_data') }}');
    parent.postMessage(
        {
            'event': 'return-iframe-success',
            'data': {
                'table_id': "{{ request('table_id') }}",
                'table_reference': "{{ request('table_reference') }}",
                'table_text_data': "{{ request('table_text_data') }}",
            }
        }, '*');

</script>
