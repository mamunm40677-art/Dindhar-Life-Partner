<article class="profile-card">
    <div class="avatar" aria-hidden="true">{{ mb_substr($biodata->display_name, 0, 1) }}</div>
    <div>
        <div class="profile-meta"><span>{{ __('site.gender_'.$biodata->gender) }}</span><span>{{ __('site.age_years', ['age' => $biodata->age]) }}</span></div>
        <h3>{{ $biodata->display_name }}</h3>
        <p>{{ $biodata->education }}<br>{{ $biodata->city }} · {{ $biodata->occupation }}</p>
    </div>
    <a class="card-link" href="{{ route('biodatas.show', $biodata) }}">{{ __('site.view_profile') }} ↗</a>
</article>