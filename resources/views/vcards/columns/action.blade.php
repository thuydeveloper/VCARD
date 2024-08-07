<div class="action-btn option d-flex align-items-center text-center">
    <a href="{{ route('vcards.edit', $row->id) }}" title="{{ __('messages.common.edit') }}"
        class="btn p-1 fs-3">
        <i class="fa-solid fa-pen-to-square text-primary"></i>
    </a>
    <div class="dropdown">
        <button class="btn btn-sm dropdown-toggle hide-arrow" type="button" id="dropdownMenuButton1"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-ellipsis-vertical text-center text-primary fs-4"></i>
        </button>
        <ul class="dropdown-menu px-2" aria-labelledby="dropdownMenuButton1">
            <li>
                <div class="qr-code-image d-none">
                    {!! QrCode::size($row->qr_code_download_size)->format('svg')->generate(route('vcard.show', ['alias' => $row->url_alias])) !!}
                </div>
                <a title="{{ __('messages.vcard.qr_code') }}" class="d-flex align-items-center btn p-1 fs-6 vcard-qr-code-btn d-flex"
                    download="qr_code.png">
                    <i class="fa-solid fa-qrcode text-info me-2 fs-4"></i> <span>{{ __('messages.vcard.qr_code') }}</span>
                </a>
            </li>
            <li>
                <a title="{{ __('messages.vcard.download_vcard') }}" href="{{ route('add-contact', $row->id) }}"
                    class="btn p-1 fs-6 d-flex align-items-center" data-turbo="false">
                    <i class="fas fa-download text-info fs-4 me-2"></i>&nbsp;{{ __('messages.vcard.download_vcard') }}
                </a>
            </li>
            <li>
                @if (route('enquiry.index', $row->id))
                    <a title="{{ __('messages.enquiry') }}" href="{{ route('enquiry.index', $row->id) }}"
                        class="btn p-1 fs-6 d-flex align-items-center">
                        <i class="fa-solid fa-clipboard-question text-info fs-4 me-2"></i>&nbsp;{{ __('messages.contact_us.inquries') }}
                    </a>
                @endif
            </li>
            @if (checkTotalVcard())
            <li>
                <a href="javascript:void(0)" class="duplicate-vcard-btn btn p-1 fs-6 d-flex align-items-center"
                    data-id="{{ $row->id }}" title="{{ __('Duplicate VCard') }}">
                    <i class="fa-solid fa-copy text-secondary fs-4 me-2"></i>&nbsp;{{ str_replace('!', '', __('messages.vcard.duplicate_vcard')) }}
                </a>
                </a>
            </li>
            @endif
            <li>
                <a href="javascript:void(0)" data-id="{{ $row->id }}" title="{{ __('messages.common.delete') }}"
                    class="btn p-1 fs-6 d-flex align-items-center text-danger  vcard_delete-btn">
                    <i class="fa-solid fa-trash fs-4 me-2"></i>&nbsp;{{ __('messages.common.delete') }}
                </a>
            </li>
        </ul>
    </div>
</div>
