@extends('layouts.app')
@section('reportes')
    <main>
        <div class="d-flex justify-content-between mb-2">
            <h2 class="content-header-title float-start mb-0 text-dark">Reporte de compras</h2>
        </div>
        <section class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div id="compras" style="height: 350px;"></div>
                    </div>
                </div>
            </div>
        </section>
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        @endpush
        @push('js')
            <script>
                var datos = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

                @foreach ($compras as $c)
                    datos[{{ $c->mes - 1 }}] = {{ $c->monto }}
                @endforeach
                console.log(datos);
                var options = {
                    series: [{
                        name: 'Compras',
                        data: datos
                    }],
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    },
                    yaxis: {
                        title: {
                            text: 'S/ (soles)'
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return "S/ " + val + " soles"
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#compras"), options);
                chart.render();
            </script>
        @endpush

    </main>
@endsection
