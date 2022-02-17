<div class="modal fade bs-sales-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" >REGISTRAR VENTAS</h4>
            </div>
            <div class="modal-body">


                <div id="registerSales">
                    <sales-component title="Registrar Hab.." user_id = "{{Auth::user()->id}}" authenticate = "{{$authenticate}}"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="return location.reload();">Cerrar</button>
            </div>
        </div>
    </div>
</div>
