@extends('layouts.admin')




@section('content')


    <h2>Admin</h2>

    <div>
        <canvas id="myChart"></canvas>
    </div>

    <hr>
@stop


@section('scripts')




    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Posts', 'Categories', 'Comments'],
                datasets: [{
                    label: 'Data of CMS',
                    data: [{{$postsCount}},{{$categoriesCount}},{{$commentsCount}}],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>





@stop
