@extends('layouts.dashborad')

@section('main')
    <H1>dashborad dd</H1>

    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header p-3">Laravel 11 Highcharts Chart Example - ItSolutionStuff.com</h3>
            <div class="card-body">
                <div id="container"></div>
            </div>
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var users = {{ Js::from($users) }};

        Highcharts.chart('container', {
            title: {
                text: 'New User Growth, 2022'
            },
            subtitle: {
                text: 'Source: itsolutionstuff.com.com'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Number of New Users'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'New Users',
                data: users
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>
@endsection
