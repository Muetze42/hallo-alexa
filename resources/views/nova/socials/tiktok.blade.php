@if($tiktok)
    <h3 class="flex mb-3 text-base text-80 font-bold">
        {{ __('Current TikTok') }}:
    </h3>
    <div class="text-center">
        <a href="https://www.tiktok.com/@{{ config('services.tiktok.user_name')l }}/video/{{ $tiktok->provider_id }}" target="_blank"  rel="noopener">
            <img src="{{ $tiktok->url }}" alt="{{ $tiktok->provider_id }}" style="max-height: 20rem">
        </a>
    </div>
@endif
<div class="text-center mt-4">
    <a href="{{ route('social.tiktok.latest-post') }}" class="btn btn-default btn-primary" onclick="return confirm('{{ __('Update post') }}?');">{{ __('Update post') }}</a>
</div>
