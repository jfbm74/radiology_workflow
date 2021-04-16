
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><strong> Órdenes de Servicio</strong></h3>
        <div class="card-options">
            <span class="tag tag-azure">{{ $admission->delivery }}</span>
        </div>
    </div>

    <div class="card-footer">
        <h3 class="card-title">Confirme las ordenes de servicio que se realizarán:</h3>
        <div class="side-by-side clearfix">
            <form action="{{ route('order.store') }}" method="post">
                @csrf
                <input id="admission" name="admission" type="hidden" value="{{ $admission->id }}">
                <input id="user" name="user" type="hidden" value="{{ Auth::user()->id }}">

                <div>
                    <select data-placeholder="Escoja o Elimine una órden..." class="chosen-select" multiple name="orders[]"
                        tabindex="4">

                        <option value=""></option>

                        @foreach ($orders as $order)
                            <option value="{{ $order->id }}" selected>{{ $order->name }}</option>
                        @endforeach
                    </select>
                </div>
        </div>
    </div>
</div>
@if ($check_user != 1)
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><strong> Crear usuario en el Portal</strong></h3>
    </div>


    <div class="card-footer">
        <h3 class="card-title">Digite o confirme el correo del paciente al que llegará la Clave:</h3>
        <div class="side-by-side clearfix">
            <div>
                <input type="email" id="user_email" name="user_email" value="{{ $check_user }}" required>
            </div>
        </div>

@endif
        <button class="btn btn-secondary btn-sm ml-2">Guardar</button>
        </form>
    </div>
</div>
