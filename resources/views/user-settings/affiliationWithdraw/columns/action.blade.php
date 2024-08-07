@if( $row->is_approved == \App\Models\Withdrawal::INPROCESS && !isAdmin())
		<div class="">
			<button class="btn btn-success dropdown-toggle" id="dropdownMenuLink"
			        data-bs-toggle="dropdown" aria-expanded="false" data-bs-boundary="viewport">
				{{ __('messages.affiliation.approval_status') }}
			</button>
			<ul class="dropdown-menu withdraw-approval-dropdown" aria-labelledby="dropdownMenuLink">
				<li><a class="dropdown-item" href="#" data-amount="{{ currencyFormat($row->amount,2) }}"
				       data-id="{{ $row->id }}" id="approveWithdrawalBtn">{{ __('messages.affiliation.approve') }}</a>
				</li>
				<li><a class="dropdown-item" href="#" data-id="{{ $row->id }}"
				       id="rejectWithdrawalBtn">{{ __('messages.affiliation.reject') }}</a>
				</li>
			</ul>
		</div>
	@else
		<span id="showAffiliationWithdrawBtn" data-id="{{ $row->id }}" type="button" data-bs-toggle="tooltip"
		      data-placement="top"
		      data-bs-original-title="{{__('messages.common.view')}}"><i class="fa-solid fa-eye text-info"></i></span>
	@endif
