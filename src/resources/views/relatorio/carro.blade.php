@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Relatório de Carros</h2>
            </div>
            <div class="pull-right">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <div class="card">
            <div class="card-body">

                <table class="table table-bordered ">
                    <tr>
                        <th>Id</th>
                        <th>Proprietário</th>
                        <th>Placa</th>
                        <th>Modelo</th>
                    </tr>

                    @foreach ($carros as $carro)
                        <tr>
                            <td>{{ $carro->id }}</td>
                            <td>{{ $carro->pessoa->nome }}</td>
                            <td>{{ $carro->placa }}</td>
                            <td>{{ $carro->modelo }}</td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Maior qtd. de Carros</h5>
                                @if ($homens > $mulheres)
                                    <p class="card-text">Homens - {{ $homens }} carros</p>
                                @else
                                    <p class="card-text">Mulheres - {{ $mulheres }} carros</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered ">
                    <tr>
                        <th>Marca</th>
                        <th>Quantidade</th>
                    </tr>

                    @foreach ($marcas as $marca)
                        <tr>
                            <td>{{ $marca->nome }}</td>
                            <td>{{ $marca->total }}</td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Totais</h5>
                <div class="chart-container">
                    <div class="pie-chart-container">
                        <canvas id="pie-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                //get the pie chart canvas
                var cData = JSON.parse(`<?php echo $data['chart-data']; ?>`);
                var ctx = $("#pie-chart");

                //pie chart data
                var data = {
                    labels: cData.label,
                    datasets: [{
                        label: "Users Count",
                        data: cData.data,
                        backgroundColor: [
                            "#DEB887",
                            "#A9A9A9",
                            "#DC143C",
                            "#F4A460",
                            "#2E8B57",
                            "#1D7A46",
                            "#CDA776",
                        ],
                        borderColor: [
                            "#CDA776",
                            "#989898",
                            "#CB252B",
                            "#E39371",
                            "#1D7A46",
                            "#F4A460",
                            "#CDA776",
                        ],
                        borderWidth: [1, 1, 1, 1, 1, 1, 1]
                    }]
                };

                //options
                var options = {
                    responsive: true,
                    title: {
                        display: true,
                        position: "top",
                        text: "Maior quantidade de Carros",
                        fontSize: 18,
                        fontColor: "#111"
                    },
                    legend: {
                        display: true,
                        position: "bottom",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    }
                };

                //create Pie Chart class object
                var chart1 = new Chart(ctx, {
                    type: "pie",
                    data: data,
                    options: options
                });

            });
        </script>
    @endsection
