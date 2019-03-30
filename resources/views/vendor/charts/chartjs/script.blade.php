
@foreach ($chart->plugins as $plugin)
    @include($chart->pluginsViews[$plugin]);
@endforeach

<script {!! $chart->displayScriptAttributes() !!}>
var ctvChart = document.getElementById('{{ $chart->id }}').getContext('2d');
function {{ $chart->id }}_create(data) {
    {{ $chart->id }}_rendered = true;
    var loader_element = document.getElementById("{{ $chart->id }}_loader");
    loader_element.parentNode.removeChild(loader_element);
    document.getElementById("{{ $chart->id }}").style.display = 'block';
    window.{{ $chart->id }} = new Chart(document.getElementById("{{ $chart->id }}").getContext("2d"), {
        type: {!! $chart->type ? "'{$chart->type}'" : 'data[0].type' !!},
        data: {
            labels: {!! $chart->formatLabels() !!},
            datasets: data
        },
        options: {!! $chart->formatOptions(true) !!},
        plugins: {!! $chart->formatPlugins(true) !!}
    });
}
@include('charts::init')

</script>
