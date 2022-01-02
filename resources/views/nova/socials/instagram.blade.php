@if($instagram)
    <h3 class="flex mb-3 text-base text-80 font-bold">
        {{ __('Current Instagram Post') }}:
    </h3>
    <div class="text-center">
        <a href="https://www.instagram.com/p/{{ $instagram->provider_id }}" target="_blank"  rel="noopener">
            <img src="data:image/jpg;base64, {{ base64_encode(file_get_contents($instagram->url)) }}" alt="{{ $instagram->provider_id }}" style="max-height: 20rem">
        </a>
    </div>
@endif
<div class="text-center mt-4">
    <a href="{{ route('social.instagram.latest-post') }}" class="btn btn-default btn-primary" onclick="return confirm('{{ __('Update post') }}?');">{{ __('Update post') }}</a>
</div>
