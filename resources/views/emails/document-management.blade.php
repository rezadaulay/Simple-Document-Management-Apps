
<p>{{$document->title}}</p>
<br>
<p>{{nl2br($document->content)}}</p>

<br>
Best Regard,
<br>
<img src="{{ $document->signing_type == 'upload' ? $message->embed(public_path(). '/storage/' . $document->signing_image) : $message->embedData(base64_decode(str_replace('data:image/png;base64,', '', $document->signing_manual)), 'signing_manual.png') }}" alt="">