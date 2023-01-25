@extends('layouts.pianoapp')

@section('title','入力エラー')
@section('content')
<p>入力にエラーがありました。<br>恐れ入りますが、もう一度入力をお願いします。</p><br>
<a href='start'>戻る(5秒経過すると自動で入力ページへ戻ります)</a>
<meta http-equiv='refresh' content='5;URL=start'>
@endsection