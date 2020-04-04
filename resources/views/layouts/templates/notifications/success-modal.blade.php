<!-- Success Modal -->
<button id="success-modal-btn" type="button" data-toggle="modal" data-target="#modal-notification" style="display:none;">
    Notification
</button>

<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-success modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-success">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body" style="padding: 0;">
                <div class="py-3 text-center">
                    <i class="fas fa-check-circle" style="font-size: 5rem;"></i>
                    <h2 class="heading mt-4">¡ÉXITO!</h2>
                    <p>{{$message}}</p>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- End of success modal -->