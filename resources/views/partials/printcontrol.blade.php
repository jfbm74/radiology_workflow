<div class="card">
    <div class="card-header">
        <h3 class="card-title"><strong> Órdenes de Servicio</strong></h3>
        <div class="card-options">
            <span class="tag tag-azure">{{ $admission->delivery }}</span>
        </div>
    </div>

    <div class="card-footer">
        <h3 class="card-title"><strong>Control de Impresiones</strong></h3>
        <div class="table-responsive">
            <form action="{{route('printing.store')}}" method="post">
                @csrf
                <input id="admission" name="admission" type="hidden" value="{{ $admission->id }}">
                <input id="user" name="user" type="hidden" value="{{ $user->id }}">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>VTR</th>
                            <th>ACET</th>
                            <th>FOTO</th>
                            <th>PCal</th>
                            <th>TRZ</th>
                            <th>M. Est</th>
                            <th>M. Tra</th>
                            <th>M. SinM</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($admission->serviceorder->serviceorderdetail as $order)

                                <th scope="row">{{ $order->product->name }}</th>
                                <td>
                                    <input  style="width:40px"
                                            type="number"
                                            min="0"
                                            max="5"
                                            @if ($order->product->default == "Virtual")
                                                value="1"
                                            @else
                                                value="0"
                                            @endif

                                            name="print[{{$order->product_id}}][Virtual]">
                                </td>
                                <td>
                                    <input  style="width:40px"
                                            type="number"
                                            min="0"
                                            max="5"
                                            @if ($order->product->default == "Acetato")
                                                value="1"
                                                @else
                                                    value="0"
                                            @endif
                                            name="print[{{$order->product_id}}][Acetato]">
                                </td>
                                <td>
                                    <input  style="width:40px"
                                            type="number"
                                            min="0"
                                            max="5"
                                            @if ($order->product->default == "Foto")
                                            value="1"
                                            @else
                                            value="0"
                                            @endif
                                            name="print[{{$order->product_id}}][Foto]">
                                </td>
                                <td>
                                    <input  style="width:40px"
                                            type="number"
                                            min="0"
                                            max="5"
                                            @if ($order->product->default == "P-cal")
                                            value="1"
                                            @else
                                            value="0"
                                            @endif

                                            name="print[{{$order->product_id}}][P-cal]">
                                </td>
                                <td>
                                    <input  style="width:40px"
                                            type="number"
                                            min="0"
                                            max="5"
                                            @if ($order->product->default == "TRZ")
                                            value="1"
                                            @else
                                            value="0"
                                            @endif
                                            name="print[{{$order->product_id}}][TRZ]">
                                </td>
                                <td>
                                    <input  style="width:40px"
                                            type="number"
                                            min="0"
                                            max="5"
                                            @if ($order->product->default == "ModEstudio")
                                            value="1"
                                            @else
                                            value="0"
                                            @endif
                                            name="print[{{$order->product_id}}][ModEstudio]">
                                </td>
                                <td>
                                    <input  style="width:40px"
                                            type="number"
                                            min="0"
                                            max="5"
                                            @if ($order->product->default == "Modtrabajo")
                                            value="1"
                                            @else
                                            value="0"
                                            @endif
                                            name="print[{{$order->product_id}}][Modtrabajo]">
                                </td>
                                <td>
                                    <input  style="width:40px"
                                            type="number"
                                            min="0"0
                                            max="5"
                                            @if ($order->product->default == "ModSinMontar")
                                            value="1"
                                            @else
                                            value="0"
                                            @endif
                                            name="print[{{$order->product_id}}][ModSinMontar]">
                                </td>

                            </tr>
                            @endforeach
                    </tbody>
                </table>
        </div>
        <br>
        <button class="btn btn-secondary btn-sm ml-2">Llamar Paciente</button>
        </form>
    </div>
</div>
