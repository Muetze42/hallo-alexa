@if($youtube)
    <h3 class="flex mb-3 text-base text-80 font-bold">
        {{ __('Current YouTube Video') }}:
    </h3>
    <div style=" position: relative; padding-bottom: 56.25%;">
        <iframe src="https://www.youtube.com/embed/{{ $youtube->provider_id }}?rel=0&"
                title=" {{ __('Current YouTube Video') }}"
                allowfullscreen id="player"
                style="border: 1; top: 0; left: 0; width: 100%; height: 100%; position: absolute;"
        ></iframe>
    </div>
    <div class="text-center mt-2">
        <a href="https://www.youtube.com/watch?v={{ $youtube->provider_id }}" class="no-underline dim text-primary font-bold" target="_blank" rel="noopener">https://www.youtube.com/watch?v={{ $youtube->provider_id }}</a>
    </div>
@endif
<div class="text-center mt-4">
    <a href="{{ route('social.youtube.latest-video') }}" class="btn btn-default btn-primary" onclick="return confirm('{{ __('Update video') }}?');">{{ __('Update video') }}</a>
</div>
