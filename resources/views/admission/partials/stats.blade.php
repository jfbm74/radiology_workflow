<div class="row">
    <div class="col-lg-2 col-md-6">
        <a href="{{ route('admission.today')}}">
            <div class="card">
                <div class="card-body w_sparkline">
                    <div class="details">
                        <span>Total Pacientes</span>
                        <h3 class="mb-0 counter">{{ $today_patients }}</h3>
                    </div>
                    <div class="w_chart">
                        <span id="mini-bar-chart1" class="mini-bar-chart"></span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-2 col-md-6">
        <div class="card">
            <div class="card-body w_sparkline">
                <div class="details">
                    <span>En Espera</span>
                    <h3 class="mb-0 counter">{{$waiting_room}}</h3>
                </div>
                <div class="w_chart">
                    <span id="mini-bar-chart2" class="mini-bar-chart"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-6">
        <div class="card">
            <div class="card-body w_sparkline">
                <div class="details">
                    <span>En Atención</span>
                    <h3 class="mb-0 counter">{{ $in_progress }}</h3>
                </div>
                <div class="w_chart">
                    <span id="mini-bar-chart3" class="mini-bar-chart"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-6">
        <div class="card">
            <div class="card-body w_sparkline">
                <div class="details">
                    <span>Sin Entregar</span>
                    <h3 class="mb-0 counter">{{ $penddings }}</h3>
                </div>
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
                    <span>Tiempo Atención</span>
                    @if(is_float($time_to_attend))
                        <h3 class="mb-0 counter">{{ number_format($time_to_attend, 1) ?? '' }}</h3>
                    @else
                        <h3 class="mb-0 counter">0</h3>
                    @endif
                </div>
                <div class="w_chart">
                    <span id="mini-bar-chart4" class="mini-bar-chart"></span>
                </div>
            </div>
        </div>
    </div>
</div>
