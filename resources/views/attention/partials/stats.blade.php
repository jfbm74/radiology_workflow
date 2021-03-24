
<div class="section-body">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-2 col-md-6">
                <div class="card">
                    <div class="card-body w_sparkline">
                        <div class="details">
                            <span>Pacientes Hoy</span>
                            <h3 class="mb-0 counter">{{ $today_patients ?? '' }}</h3>
                        </div>
                        <div class="w_chart">
                            <span id="mini-bar-chart1" class="mini-bar-chart"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="card">
                    <div class="card-body w_sparkline">
                        <a href="{{ route('attention.index') }}">
                            <div class="details">
                                <span>Sala de Espera</span>
                                <h3 class="mb-0 counter">{{ $waiting_room ?? '' }}</h3>
                            </div>
                        </a>
                        <div class="w_chart">
                            <span id="mini-bar-chart2" class="mini-bar-chart"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="card">
                    <div class="card-body w_sparkline">
                        <a href="{{ route('attention.attending') }}">
                            <div class="details">
                                <span>En Atención</span>
                                <h3 class="mb-0 counter">{{ $in_progress ?? '' }}</h3>
                            </div>
                        </a>
                        <div class="w_chart">
                            <span id="mini-bar-chart3" class="mini-bar-chart"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="card">
                    <div class="card-body w_sparkline">
                        <a href="{{ route('results.pendding') }}">
                            <div class="details">
                                <span>Pendientes</span>
                                <h3 class="mb-0 counter">{{ $penddings ?? ''}}</h3>
                            </div>
                        </a>
                        <div class="w_chart">
                            <span id="mini-bar-chart3" class="mini-bar-chart"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body w_sparkline">
                        <div class="details">
                            <span>Tiempo Espera</span>
                            <h3 class="mb-0 counter">{{ number_format($time_to_attend, 1) ?? '' }}</h3>
                        </div>
                        <div class="w_chart">
                            <span id="mini-bar-chart4" class="mini-bar-chart"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
