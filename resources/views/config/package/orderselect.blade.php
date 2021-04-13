
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><strong> Productos</strong></h3>
    </div>

    <div class="card-footer">
        <h3 class="card-title">Confirme los productos que tendrá el paquete:</h3>
        <div class="side-by-side clearfix">
            <form action="#" method="post">
                @csrf
                <input id="admission" name="admission" type="hidden" value="">
                <input id="user" name="user" type="hidden" value="">

                <div>
                    <select class="select" multiple data-mdb-filter="true">
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="4">Four</option>
                        <option value="5">Five</option>
                        <option value="6">Six</option>
                        <option value="7">Seven</option>
                        <option value="8">Eight</option>
                        <option value="9">Nine</option>
                        <option value="10">Ten</option>


                    </select>

                </div>
        </div>
            <button class="btn btn-secondary btn-sm ml-2">Guardar</button>
        </form>
    </div>
</div>
