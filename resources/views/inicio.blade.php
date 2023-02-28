@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

@if (session('message'))
    <div class="alert alert-success" role="alert">
        <center>{{ session('message') }}</center>
    </div>
@endif

      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
<script>
    var mes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    var data = [ {{ $users_ene }}, {{ $users_feb }}, {{ $users_mar }}, {{ $users_abr }}, {{ $users_may }}, {{ $users_jun }}, {{ $users_jul }}, {{ $users_ago }}, {{ $users_sep }}, {{ $users_oct }}, {{ $users_nov }}, {{ $users_dic }} ];


    var barChartData = {
        labels: mes,
        datasets: [{
            label: 'Usuarios creados',
            backgroundColor: "rgba(125,54,138,1)",
            data: data
        }],

    };


    window.onload = function() {
        var ctx = document.getElementById("myChart").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Usuarios creados por mes'
                }
            }
        });
    };
</script>

@endsection
