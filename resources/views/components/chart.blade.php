
<div id="container"></div>
<script>
    Highcharts.stockChart('container', {
        rangeSelector: {
            selected: 5
        },
        navigation: {
            bindingsClassName: 'tools-container' // informs Stock Tools where to look for HTML elements for adding technical indicators, annotations etc.
        },
        stockTools: {
            gui: {
                enabled: false // disable the built-in toolbar
            }
        },
        series: @json($data)
    });
</script>
