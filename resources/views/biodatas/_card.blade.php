<article style="background: #ffffff; border: 1.5px solid #e5e0d3; border-radius: 16px; padding: 22px; box-shadow: 0 4px 15px rgba(6, 40, 32, 0.03); display: flex; flex-direction: column; justify-content: space-between; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='#cba135';" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#e5e0d3';">
    <div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
            <span style="background: #e6f4ea; color: #137333; font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px;">
                {{ __('site.gender_'.$biodata->gender) }}
            </span>
            <span style="font-size: 11px; font-weight: 700; color: #062820; background: #f1efe5; padding: 3px 8px; border-radius: 4px;">
                Bio No - {{ $biodata->id }}
            </span>
        </div>

        <div style="text-align: center; margin-bottom: 14px;">
            <div style="width: 60px; height: 60px; border-radius: 50%; background: #062820; border: 2px solid #cba135; color: #cba135; display: grid; place-items: center; font-size: 24px; margin: 0 auto 10px;">
                {{ $biodata->gender === 'groom' || $biodata->gender === 'male' ? '🧔' : '🧕' }}
            </div>
            <h3 style="font-family: var(--serif); font-size: 18px; font-weight: 700; color: #062820; margin: 0 0 4px;">
                {{ $biodata->display_name }}
            </h3>
            <span style="font-size: 12px; color: #69766f; font-weight: 600;">{{ $biodata->age }} বছর</span>
        </div>

        <div style="background: #fcfbf8; border: 1px solid #e5e0d3; padding: 12px; border-radius: 10px; font-size: 13px; color: #15382f; line-height: 1.8; margin-bottom: 16px;">
            <div>🎓 <strong>শিক্ষা:</strong> {{ $biodata->education }}</div>
            <div>📍 <strong>জেলা:</strong> {{ $biodata->city }}</div>
            <div>💼 <strong>পেশা:</strong> {{ $biodata->occupation }}</div>
        </div>
    </div>

    <a href="{{ route('biodatas.show', $biodata) }}" style="display: block; width: 100%; text-align: center; padding: 10px; background: #062820; color: #cba135; border: 1.5px solid #cba135; border-radius: 30px; font-size: 13px; font-weight: 700; text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='#0d493a'; this.style.color='#ffffff';" onmouseout="this.style.background='#062820'; this.style.color='#cba135';">
        {{ __('site.view_profile') }} ↗
    </a>
</article>
