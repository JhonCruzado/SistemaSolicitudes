@extends('layouts.app')
@section('reportes')
    <main>
        <div class="d-flex justify-content-between mb-2">
            <h2 class="content-header-title float-start mb-0 text-dark">Reporte de ventas</h2>
        </div>
        <section class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div id="barchart_values" style="height: 350px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div id="productos" style="height: 350px;"></div>
                    </div>
                </div>
            </div>
        </section>
        @push('scripts')
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        @endpush
        @push('js')
            <script type="text/javascript">
                google.charts.load("current", {
                    packages: ["corechart"]
                });
                google.charts.setOnLoadCallback(draw_ingresos);
                google.charts.setOnLoadCallback(draw_productos);

                var chartArea = {
                    left: "10%",
                    top: "10%",
                    height: "100%",
                    width: "90%"
                };
                let ingresos = [
                    ["Mes", "Monto", {
                        role: "style"
                    }],
                    ['Enero', 0, '#1E88E5'],
                    ['Febrero', 0, '#C62828'],
                    ['Marzo', 0, '#3F51B5'],
                    ['Abril', 0, '#039BE5'],
                    ['Mayo', 0, '#009688'],
                    ['Junio', 0, '#FBC02D'],
                    ['Julio', 0, '#4CAF50'],
                    ['Agosto', 0, '#00C853'],
                    ['Septiembre', 0, '#CDDC39'],
                    ['Octubre', 0, '#3949AB'],
                    ['Noviembre', 0, '#FF7043'],
                    ['Diciembre', 0, '#607D8B']
                ];

                function draw_ingresos() {
                    @foreach ($ventas as $v)
                        var mes = {{ $v->mes }};
                        ingresos[mes][1]=parseFloat({{ $v->total }});
                    
                    @endforeach

                    var data = google.visualization.arrayToDataTable(ingresos);

                    var view = new google.visualization.DataView(data);

                    view.setColumns([0, 1,
                        {
                            calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation"
                        },
                        2
                    ]);

                    var options = {
                        title: "Ingresos por Mes del Año Actual",
                        chartArea,
                        bar: {
                            groupWidth: "95%"
                        },
                        legend: {
                            position: "none"
                        },

                    };
                    var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
                    chart.draw(view, options);
                }

                function draw_productos() {
                    var data = google.visualization.arrayToDataTable([
                        ['Productos', 'Cantidad'],
                        @foreach ($productos as $p)
                            [`{{ $p->producto }}`,{{ $p->importe }}],
                        @endforeach
                    ]);

                    var options = {
                        title: 'Top 10 productos más vendidos',
                        is3D: true,
                        chartArea,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('productos'));
                    chart.draw(data, options);
                }

                $(document).ready(function() {
                    $(window).resize(function() {
                        draw_ingresos();
                        draw_productos();
                    });
                });
            </script>
        @endpush

    </main>
@endsection
