<div class="modal fade bs-checkin-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" >CHECK-IN HUÉSPED</h4>
            </div>
            <div class="modal-body">
                <div id="checkin">
                    <checkin-component title="Check-in" user_id = "{{Auth::user()->id}}"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
