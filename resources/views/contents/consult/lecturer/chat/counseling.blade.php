<h4 style="font-size: 1rem; padding: 0rem 1.7rem;"><b>Konseling</b></h4>
<dl style="padding: 0rem 1.7rem;">
    @foreach ($counselings as $item)
    <dt>{{ $item->question->text }}</dt>
    <dd>{{ $item->answer }}</dd>
    <br>
    @endforeach
</dl>