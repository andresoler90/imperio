@extends('layouts.master')

@section('content')

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            @include("Dashboard.partials.board")
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        google.charts.load('current', {
            'packages': ['geochart'],
            // Note: you will need to get a mapsApiKey for your project.
            // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
            'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
        });
        google.charts.setOnLoadCallback(drawRegionsMap);

        function drawRegionsMap() {
            var data = google.visualization.arrayToDataTable([
                ['Country', 'Suscripción'],
                ['', 0],
                    @foreach($mapCountry->mapCount as $country => $total)
                        ["{{$country}}", parseInt('{{$total}}')],
                    @endforeach
                ['', '{{$mapCountry->totalMemberships}}'],
                // ['Germany', 200],
                // ['United States', 300],
            ]);
            var options = {
                colorAxis: {colors: ['#3f79f1', '#3f79f1']},
                backgroundColor: 'gray'
            };
            var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
            chart.draw(data, options);
        }

        function confirmPay() {
            return confirm("{{__("Se realizará el cobro de la membresía")}}");
        }

        $('.custom-file input').change(function () {
            var fieldVal = $(this).val();

            // Change the node's value by removing the fake path (Chrome)
            fieldVal = fieldVal.replace("C:\\fakepath\\", "");

            if (fieldVal != undefined || fieldVal != "") {
                $(this).next(".custom-file-label").attr('data-content', fieldVal);
                $(this).next(".custom-file-label").text(fieldVal);
            }
        });
    </script>
@endsection
