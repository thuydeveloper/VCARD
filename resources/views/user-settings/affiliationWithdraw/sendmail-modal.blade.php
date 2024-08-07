<div class="modal fade" id="sendRferralMail" tabindex="-1" aria-labelledby="sendRferralMail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.plan.sendemail') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="sendReferralForm" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label required">{{ __('messages.plan.email_address') }}</label>
                        <input type="email" class="form-control" name="email" id="email"
                            aria-describedby="emailHelp" required>
                        <div id="email" class="form-text">{{ __('messages.plan.We\'ll_never_share_your_email_with_anyone_else') }}</div>
                    </div>
                </div>
                    <div class="modal-footer pt-0">
                        <button type="submit" class="btn btn-primary sendmailbtn">{{ __('messages.plan.sendemail') }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('crud.cancel') }}</button>
                    </div>
            </form>
        </div>
    </div>
</div>
