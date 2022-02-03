


<div class="modal fade bs-bebrooms-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" >REGISTRAR HABITACIÓN</h4>
            </div>
            <div class="modal-body">
                <div id="registerBedroom">
                    <bedroom-component title="Registrar Hab.." user_id = "{{Auth::user()->id}}"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
