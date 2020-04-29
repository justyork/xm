<fieldset class="form-group">
    @if ($label)
        <label for="{{$field}}">{{ $label }}</label>
    @endif

    @if ($type === 'input')
        <x-input :field="$field" :value="$value" />
    @elseif ($type === 'date')
        <x-date :field="$field" :value="$value" />
    @endif


    @error($field)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</fieldset>
