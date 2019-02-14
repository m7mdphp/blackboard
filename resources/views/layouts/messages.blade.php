@foreach($messages as $messages)
{{$messages->centers['name']}}
</br>
{{$messages->title}}
</br>
{{$messages->message}}
</br>
@endforeach