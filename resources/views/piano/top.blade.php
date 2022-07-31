@extends('layouts.pianoapp')

@section('title','絶対音感テスト')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h2>宇都宮大学大学院 長谷川(光)・鶴田研究室 絶対音感テスト</h2>
            <h3>絶対音感テストへようこそ！</h3>
            <p>このサイトは絶対音感に関する研究のために，宇都宮大学大学院 長谷川(光)・鶴田研究室が管理・運営をしています．</p>

            <p>絶対音感とは『単独の音の音高を，ほかの音と参照することなく音楽的音名で同定することができる能力』*1*2と定義されており， 通常は幼少期の音楽経験によって形成されるといわれています．
            </p>

            <p>このサイトでは，まず音が鳴り，音に対応したピアノ鍵盤をクリックしていただくことで， あなたの絶対音感の正確さをチェックすることができます．</p>

            <p>テスト時間は前後半それぞれ10分であり，あいだに1時間以上の休憩を挟んでください．</p>

            <p>テストの都合上，結果をすぐに表示することはできませんが，ご希望いただければ，以下のようなテスト結果のシートを後日メールにて送付いたします．</p>

            <p>
            <img src="{{asset('assets/img/絶対音感テスト_シート_1-1.png')}}" style="width:49%;">
            <img src="{{asset('assets/img/絶対音感テスト_シート_1-2.png')}}" style="width:49%;">
            <img src="{{asset('assets/img/絶対音感テスト_シート_1-3.png')}}" style="width:49%;">
            <img src="{{asset('assets/img/絶対音感テスト_シート_1-4.png')}}" style="width:49%;">
            </p>

            <div class="startbutton">
            <button type="button" class="btn btn-outline-default" onclick="location.href='start'">テストを始める</button>
            </div>

            <br>
            <blockquote>
                <p><cite>*1藤原和香, 柏野牧夫, "絶対音感保持者の音程知覚特性", 日本音響学会誌, 57(12), pp759-767, 2001.</cite></p>
                <p><cite>*2宮崎謙一, "「絶対音感」はどこまで分かったか？", 日本音響学会誌, 60(11), pp682-688, 2004.</cite></p>
            </blockquote>
        </div>
    </div>
</div>
@endsection