@extends('layouts.app')
@section('title')
    {{ __('Virtual Backgrounds') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            @include('layouts.errors')
        </div>
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>{{ __('messages.common.add_virtual_background') }}</h1>
            <a class="btn btn-outline-primary float-end"
                href="{{ route('virtual-backgrounds.index') }}">{{ __('messages.common.back') }}</a>
        </div>
        <div class="card">
            <form data-turbo="false" action="{{ route('download.ecard') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.vcard.vcard_name') }}</label>
                            <select id="e-vcard-id" name="vcard_id">
                                <option value="">{{ __('messages.vcard.select_vcard') }}</option>
                                @foreach ($vcards as $id => $vcard)
                                    <option value="{{ $id }}" @selected(old('vcard_id'))>{{ $vcard }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="mb-3" io-image-input="true">
                                <label for="exampleInputImage"
                                    class="form-label required">{{ __('messages.e_card.add_ecard') . ':' }}</label>
                                <span data-bs-toggle="tooltip" data-placement="top"
                                    data-bs-original-title="{{ __('messages.e_card.ecard_info') }}">
                                    <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                                </span>
                                <div class="d-block">
                                    <div class="image-picker">
                                        <div class="image previewImage" id="exampleInputImage"
                                            style="background-image: url('{{ asset('web/media/logos/infyom.png') }}')">
                                        </div>
                                        <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                            data-bs-toggle="tooltip" data-placement="top"
                                            data-bs-original-title="{{ __('messages.tooltip.profile') }}">
                                            <label>
                                                <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                <input type="file" id="e-card-logo" name="ecard-logo"
                                                    class="image-upload file-validation d-none" accept="image/*" />
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-text text-danger" id="logoImageValidationErrors"></div>
                        </div>
                    </div>
                    <input type="hidden" name="e-card-id" value="{{ $ecard }}">
                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.form.first_name') }}</label>
                            <input type="text" class="form-control" name="first_name" id="e-card-first-name" required
                                value="{{ old('first_name') }}" placeholder="{{ __('messages.form.f_name') }}"
                                maxlength="10">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.form.last_name') }}</label>
                            <input type="text" class="form-control" name="last_name" id="e-card-last-name" required
                                value="{{ old('last_name') }}" placeholder="{{ __('messages.form.l_name') }}"
                                maxlength="10">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.user.email') }}</label>
                            <input type="email" class="form-control" name="email" id="e-card-email" required
                                placeholder="{{ __('messages.form.enter_email') }}" value="{{ old('email') }}">
                        </div>
                        {{-- {{ \LaravelQRCode\Facades\QRCode::url(request()->url())->png() }} --}}
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.form.occupation') }}</label>
                            <input type="text" class="form-control" name="occupation" id="e-card-occupation" required
                                value="{{ old('occupation') }}" placeholder="{{ __('messages.form.occupation') }}"
                                maxlength="20">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.user.location') }}</label>
                            <input type="text" class="form-control" name="location" id="e-card-location" required
                                value="{{ old('location') }}" placeholder="{{ __('messages.form.location') }}">
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                {{ Form::label('phone', __('messages.user.phone') . ':', ['class' => 'form-label required']) }}
                                {{ Form::text('phone', null, ['class' => 'form-control', 'required', 'placeholder' => __('messages.form.phone'), 'id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                                {{ Form::hidden('region_code', null, ['id' => 'prefix_code']) }}
                            </div>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.social.website') }}</label>
                            <input type="text" class="form-control" name="website" id="e-card-website" required
                                value="{{ old('website') }}" placeholder="{{ __('messages.form.website') }}">
                        </div>
                    </div>

                    <div class="col-lg-12 d-flex mt-5">
                        <button type="submit" class="btn btn-primary me-3">
                            {{ __('messages.common.save') }}
                        </button>
                        <a href="{{ route('virtual-backgrounds.index') }}"
                            class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
