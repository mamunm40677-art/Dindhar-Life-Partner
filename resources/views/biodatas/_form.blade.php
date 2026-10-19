<form class="panel" method="post" action="{{ $biodata->exists ? route('my-biodata.update', $biodata) : route('my-biodata.store') }}">
    @csrf
    @if ($biodata->exists) @method('PUT') @endif
    @if ($errors->any())<div class="errors" role="alert"><strong>{{ __('site.validation_errors') }}</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <div class="form-grid">
        <label>{{ __('site.name') }}<input name="display_name" value="{{ old('display_name', $biodata->display_name) }}" maxlength="120" required></label>
        <label>{{ __('site.gender_label') }}<select name="gender" required><option value="">{{ __('site.all') }}</option><option value="groom" @selected(old('gender', $biodata->gender) === 'groom')>{{ __('site.groom') }}</option><option value="bride" @selected(old('gender', $biodata->gender) === 'bride')>{{ __('site.bride') }}</option></select></label>
        <label>{{ __('site.age') }}<input type="number" name="age" value="{{ old('age', $biodata->age) }}" min="18" max="80" required></label>
        <label>{{ __('site.marital_status') }}<select name="marital_status" required><option value="">{{ __('site.all') }}</option>@foreach (['never_married', 'divorced', 'widowed'] as $status)<option value="{{ $status }}" @selected(old('marital_status', $biodata->marital_status) === $status)>{{ __('site.'.$status) }}</option>@endforeach</select></label>
        <label>{{ __('site.city') }}<input name="city" value="{{ old('city', $biodata->city) }}" maxlength="100" required></label>
        <label>{{ __('site.education') }}<input name="education" value="{{ old('education', $biodata->education) }}" maxlength="160" required></label>
        <label class="full">{{ __('site.occupation') }}<input name="occupation" value="{{ old('occupation', $biodata->occupation) }}" maxlength="120" required></label>
        <label class="full">{{ __('site.about_you') }}<textarea name="about" maxlength="2000" required>{{ old('about', $biodata->about) }}</textarea></label>
    </div>
    <label class="check-row"><input type="checkbox" name="published" value="1" @checked(old('published', $biodata->published))>{{ __('site.publish_profile') }}</label>
    <p class="about-copy">{{ __('site.profile_form_copy') }}</p>
    <div class="actions"><button class="button" type="submit">{{ __('site.save_profile') }}</button><a class="button secondary" href="{{ route('dashboard') }}">{{ __('site.cancel') }}</a></div>
</form>