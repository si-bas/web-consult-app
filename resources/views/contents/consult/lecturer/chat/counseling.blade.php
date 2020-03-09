<h4 style="font-size: 1rem; padding: 0rem 1.7rem;"><b>Konseling</b></h4>
<dl style="padding: 0rem 1.7rem;">
    @foreach ($counselings as $item)
    <dd>{{ $item->question->text }}</dd>
    <dt>{{ $item->answer }}</dt>
    <br>
    @endforeach
</dl>