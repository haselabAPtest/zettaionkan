@extends('layouts.pianoapp')

@section('title','途中休憩')
@section('content')
<div>
    <h3>半分が終了しました。一時間後にもう半分のテストをよろしくお願いします。</h3><br>
    <h3>ブラウザのタブは閉じずにお待ちください。</h3><br>
    <h3>ブラウザの更新ボタンを押すとタイマーが表示されます。</h3><br>

    <div id="log"></div>
    <script type="text/javascript" src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/countdown.js')}}"></script>
</div>
@endsection