<option>اختار</option>
@if(!empty($universtes))
  @foreach($universtes as $key => $value)
    <option value="{{ $key }}">{{ $value }}</option>
  @endforeach
@endif