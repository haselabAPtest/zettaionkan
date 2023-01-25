@extends('layouts.pianoapp')

@section('title','テスト開始前')
@section('content')
<h3>練習お疲れ様です！</h3><br>
<p class="message">テストは前半と後半に分かれています。前半の回答の後、1時間の間を空けて後半の回答を行っていただきます。回答の所要時間はそれぞれ10分ほどです。</p>
<button type="submit" class="btn btn-outline-default" onclick="location.href='ques01'">テストを開始する</button>
@endsection