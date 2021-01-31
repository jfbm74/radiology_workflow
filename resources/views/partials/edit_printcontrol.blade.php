@isset($admission->serviceorder)
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
            <form action="{{route('printing.update' , $admission)}}" method="post">
                @csrf @method('PUT')
                <input id="admission" name="admission" type="hidden" value="">
                <input id="user" name="user" type="hidden" value="">
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
                        @foreach ($admission->serviceorder->serviceorderdetail as $order)
                            <tr>
                                <th scope="row">{{ $order->name }}</th>                               
                                    <td>
                                        <input  style="width:40px" 
                                                type="number"
                                                min="0"
                                                max="5"
                                                @foreach ($order->printing as $item)
                                                    @if ($item->type == "Virtual")
                                                        value="{{$item->quanty}}"
                                                    @endif                                                    
                                                @endforeach                                                
                                                name="print[{{$order->name}}][Virtual]">
                                    </td>
                                    <td>
                                        <input  style="width:40px" 
                                                type="number"
                                                min="0"
                                                max="5"
                                                @foreach ($order->printing as $item)
                                                    @if ($item->type == "Acetato")
                                                        value="{{$item->quanty}}"
                                                    @endif                                                    
                                                @endforeach   
                                                name="print[{{$order->name}}][Acetato]">
                                    </td>
                                    <td>
                                        <input  style="width:40px" 
                                                type="number"
                                                min="0"
                                                max="5"
                                                @foreach ($order->printing as $item)
                                                    @if ($item->type == "Foto")
                                                        value="{{$item->quanty}}"
                                                    @endif                                                    
                                                @endforeach   
                                                name="print[{{$order->name}}][Foto]">
                                    </td>
                                    <td>
                                        <input  style="width:40px" 
                                                type="number"
                                                min="0"
                                                max="5"
                                                @foreach ($order->printing as $item)
                                                    @if ($item->type == "P-cal")
                                                        value="{{$item->quanty}}"
                                                    @endif                                                    
                                                @endforeach   
                                                name="print[{{$order->name}}][P-cal]">
                                    </td>
                                    <td>
                                        <input  style="width:40px" 
                                                type="number"
                                                min="0"
                                                max="5"
                                                @foreach ($order->printing as $item)
                                                    @if ($item->type == "TRZ")
                                                        value="{{$item->quanty}}"
                                                    @endif                                                    
                                                @endforeach   
                                                name="print[{{$order->name}}][TRZ]">
                                    </td>
                                    <td>
                                        <input  style="width:40px" 
                                                type="number"
                                                min="0"
                                                max="5"
                                                @foreach ($order->printing as $item)
                                                    @if ($item->type == "ModEstudio")
                                                        value="{{$item->quanty}}"
                                                    @endif                                                    
                                                @endforeach   
                                                name="print[{{$order->name}}][ModEstudio]">
                                    </td>
                                    <td>
                                        <input  style="width:40px" 
                                                type="number"
                                                min="0"
                                                max="5"
                                                @foreach ($order->printing as $item)
                                                    @if ($item->type == "Modtrabajo")
                                                        value="{{$item->quanty}}"
                                                    @endif                                                    
                                                @endforeach   
                                                name="print[{{$order->name}}][Modtrabajo]">
                                    </td>
                                    <td>
                                        <input  style="width:40px" 
                                                type="number"
                                                min="0"
                                                max="5"
                                                @foreach ($order->printing as $item)
                                                    @if ($item->type == "ModSinMontar")
                                                        value="{{$item->quanty}}"
                                                    @endif                                                    
                                                @endforeach   
                                                name="print[{{$order->name}}][ModSinMontar]">
                                    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        <br>
        <button class="btn btn-secondary btn-sm ml-2">Modificar Órdenes</button>
        </form>
    </div>
    
@endisset