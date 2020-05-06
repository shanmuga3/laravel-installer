@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.application.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    {!! trans('installer_messages.application.title') !!}
@endsection

@section('container')
    <div class="tabs tabs-full">

        <input id="tab1" type="radio" name="tabs" class="tab-input" checked/>
        
        <form method="post" action="{{ route('installer.database') }}" class="tabs-wrap">
            <div class="tab active" id="tab1content">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @foreach($envForm as $key => $formData)
                <div class="block">
                    <input type="radio" name="appSettingsTabs" id="appSettingsTab{{ $key }}" value="null" {{ ($key == '0') ? 'checked' :'' }} />
                    <label for="appSettingsTab{{ $key }}">
                        <span>
                            {{ $formData['name'] }}
                        </span>
                    </label>
                    <div class="info">
                        @foreach($formData['fields'] as $field)
                            <div class="form-group {{ $errors->has($field['key']) ? ' has-error ' : '' }}">
                                <label for="{{ $field['key'] }}">
                                    {{ $field['label'] }}
                                </label>
                                <input type="text" name="{{ $field['key'] }}" id="{{ $field['key'] }}" value="{{ $field['value'] }}" placeholder="{{ $field['placeholder'] ?? '' }}" />
                                @if ($errors->has($field['key']))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first($field['key']) }}
                                </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
                
                <div class="buttons">
                    <button class="button" type="submit">
                        {{ trans('installer_messages.environment.wizard.form.buttons.install') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection

@section('scripts')
@endsection
