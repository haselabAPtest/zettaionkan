@extends('layouts.pianoapp')

@section('title','確認ページ')
@section('content')
<h2 class="mb-0">
    <div class="row py-3 align-items-center">
        <div class="col-sm-9">
            事前情報の入力
        </div>
    </div>
</h2>
<!-- Buttons -->

<p class="message">それではテストの進め方の説明へすすみます。</p>
<HR>
    <p class="message">以下の内容でお間違いないですか？</p><br>
    <p class="message">氏名： {{$name}} </p>
    <p class="message">性別： {{$sex}} </p>
    <p class="message">年齢： {{$age}} </p>
    <p class="message">ピアノによる音楽教育を何歳から何歳まで受けていましたか？： {{$learnPiano}} </p>
    <p class="message">音楽に携わる仕事や活動をしていますか？： {{$musicJob}} </p>
    <p class="message">絶対音感は持っていますか？： {{$absolutePitch}} </p>
    <p class="message">絶対音感を持っている方は能力の低下を感じたことはありますか？： {{$ability}} </p>
    <p class="message">絶対音感能力が低下した時期、どのような症状が出ましたか？： {{$symptom}} </p>
    <p class="message">絶対音感テストの結果をメールで受け取りますか？： {{$result}} </p>
    <p class="message">メールアドレス： {{$mail}} </p>
    <p class="message">それではテストの進め方の説明へすすみます。</p>

    <button type="submit" class="btn btn-outline-default" onclick="location.href='instruct'">説明へすすむ</button>
    <span class="space">
    <button type="submit" class="btn btn-outline-default" onclick="location.href='start'">戻る</button>
@endsection