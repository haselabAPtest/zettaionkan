@extends('layouts.pianoapp')

@section('title','途中休憩')
@section('content')
<div>
    <p class="message">半分が終了しました。一時間後にもう半分のテストをよろしくお願いします。</p><br>
    <p class="message">ブラウザのタブは閉じずにお待ちください。</p><br>
    <p class="message">ブラウザの更新ボタンを押すとタイマーが表示されます。</p><br>

    <div class="back">
    <center><div id="log"></div>
    <script type="text/javascript" src="{{asset('assets/js/jquery-3.6.0.min.js')}}" ></script>
    <script src="{{asset('assets/js/countdown.js')}}" ></script></center>
    </div>
</div>
@endsection