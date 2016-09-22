<ul class="timeline">

    {{-- First comment = description --}}
    @include('issues.parts.timeline.description')

    {{-- Comments --}}
    @foreach($issue->comments as $comment)
        @include('issues.parts.comments.item')
    @endforeach

    {{-- Last comment = form --}}
    @include('issues.parts.comments.form')

    <li>
        <i class="fa fa-clock-o bg-gray"></i>
    </li>
</ul>

@push('scripts')
<script type="text/javascript">
$(function () {
    $('.markdown').find('img').each(function () {
        $(this).addClass('img img-responsive');
        $(this).wrap('<a href="' + $(this).prop('src') + '" class="swipebox" target="_blank"></div>');
    });
    $('.swipebox').swipebox();
});
</script>
@endpush
