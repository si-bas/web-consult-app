<p class="text-bold-600">{{ $question->text }}</p>
@if ($question->answers()->exists())
<ul class="list-unstyled mb-0">
    @foreach ($question->answers as $answer)
    <li class="mb-1">
        <fieldset>
            <div class="custom-control custom-{{ $answer->type }}">
                <input type="{{ $answer->type }}" class="custom-control-input" id="{{ $answer->type }}_{{ $answer->id }}" name="answer">
                <label class="custom-control-label" for="{{ $answer->type }}_{{ $answer->id }}">{{ $answer->text }}</label>
            </div>
        </fieldset>
    </li>
    @endforeach
</ul>
@else
<fieldset class="form-group">
    <label>Jawaban</label>
    <textarea class="form-control" rows="3" placeholder="Tuliskan jawaban"></textarea>
</fieldset> 
@endif