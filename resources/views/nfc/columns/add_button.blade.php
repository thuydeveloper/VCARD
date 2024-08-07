@php
    $nfcCard = getNfcCard()->pluck('name','id')->toArray();
    $nfcCard['0'] = __('messages.nfc.all');
    ksort($nfcCard);
@endphp
<div>
    <div class="ms-auto"></div>
    <div class="dropdown d-flex align-items-center me-4 me-md-5" wire:ignore>
        <button
            class="btn btn btn-icon btn-primary text-white dropdown-toggle hide-arrow ps-2 pe-0"
            type="button" id="cardTypeFilterBtn" data-bs-auto-close="outside"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class='fas fa-filter'></i>
        </button>
        <div class="dropdown-menu py-0" aria-labelledby="dropdownMenuButton1" id="cardTypeFilter">
            <div class="text-start border-bottom py-4 px-7">
                <h3 class="text-gray-900 mb-0">{{__('messages.common.filter')}}</h3>
            </div>
            <div class="p-5">
                <div class="mb-5">
                    <label for="exampleInputSelect2" class="form-label">{{__('messages.nfc.card_type')}}</label>
                    {{ Form::select('type', $nfcCard, null,['class' => 'form-control form-select','data-control'=>"select2" ,'id' => 'cardType', 'wire:ignore']) }}
                </div>
                <div class="d-flex justify-content-end">
                    <button type="reset" id="cardTypeResetFilter" class="btn btn-secondary">{{__('messages.common.reset')}}</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div>
        <a type="button" class="btn btn-warning mt-5 mt-md-0" data-bs-target="#adminguideNfcModal" id="adminguideNfc" >{{ __('messages.nfc.How_it_works') }}</a>
    </div>
<div>
    <a type="button" class="btn btn-primary mt-5 mt-md-0 mx-2" data-bs-target="#addNfcModal" href="{{ route('order.nfc') }}"  data-turbo="false">{{ __('messages.nfc.order_nfc') }}</a>
</div>
