@extends('layouts.pianoapp')

@section('title','練習')
@section('content')
<p>画面の再生マークをタップすると、以下の3種類の音がC4~B6の範囲で再生されます。</p>
<h3>純音</h3>
<audio controls src="assets/sound/sound_{{$pure}}.mp3"></audio>
<h3>ピアノ音</h3>
<audio controls src="assets/sound/sound_{{$piano}}.mp3"></audio>
<h3>ギター音</h3>
<audio controls src="assets/sound/sound_{{$guitar}}.mp3"></audio>
<p>以下の鍵盤で回答を行います。鍵盤を押すと押した鍵盤の色が変わります。</p>
<div>
    <div id="piano-container">
        <div id="piano-wrap">
            <div class="piano-key white-key" data-key-num="0"><span class="pitch">C4</span></div><!-- C3 -->
            <div class="piano-key black-key" data-key-num="1"></div><!-- C3# -->
            <div class="piano-key white-key" data-key-num="2"></div><!-- D3 -->
            <div class="piano-key black-key" data-key-num="3"></div><!-- D#3 -->
            <div class="piano-key white-key" data-key-num="4"></div><!-- E3 -->
            <div class="piano-key white-key" data-key-num="5"></div><!-- F3 -->
            <div class="piano-key black-key" data-key-num="6"></div><!-- F#3 -->
            <div class="piano-key white-key" data-key-num="7"></div><!-- G3 -->
            <div class="piano-key black-key" data-key-num="8"></div><!-- G#3 -->
            <div class="piano-key white-key" data-key-num="9"></div><!-- A3 -->
            <div class="piano-key black-key" data-key-num="10"></div><!-- A#3 -->
            <div class="piano-key white-key" data-key-num="11"></div><!-- B3 -->
            <div class="piano-key white-key" data-key-num="12"><span class="pitch">C5</span></div><!-- C4 -->
            <div class="piano-key black-key" data-key-num="13"></div><!-- C#4 -->
            <div class="piano-key white-key" data-key-num="14"></div><!-- D4 -->
            <div class="piano-key black-key" data-key-num="15"></div><!-- D#4 -->
            <div class="piano-key white-key" data-key-num="16"></div><!-- E4 -->
            <div class="piano-key white-key" data-key-num="17"></div><!-- F4 -->
            <div class="piano-key black-key" data-key-num="18"></div><!-- F#4 -->
            <div class="piano-key white-key" data-key-num="19"></div><!-- G4 -->
            <div class="piano-key black-key" data-key-num="20"></div><!-- G#4 -->
            <div class="piano-key white-key" data-key-num="21"></div><!-- A4 -->
            <div class="piano-key black-key" data-key-num="22"></div><!-- A#4 -->
            <div class="piano-key white-key" data-key-num="23"></div><!-- B -->
            <div class="piano-key white-key" data-key-num="24"><span class="pitch">C6</span></div><!-- C5 -->
            <div class="piano-key black-key" data-key-num="25"></div><!-- C#5 -->
            <div class="piano-key white-key" data-key-num="26"></div><!-- D5 -->
            <div class="piano-key black-key" data-key-num="27"></div><!-- D#5 -->
            <div class="piano-key white-key" data-key-num="28"></div><!-- E5 -->
            <div class="piano-key white-key" data-key-num="29"></div><!-- F5 -->
            <div class="piano-key black-key" data-key-num="30"></div><!-- F#5 -->
            <div class="piano-key white-key" data-key-num="31"></div><!-- G5 -->
            <div class="piano-key black-key" data-key-num="32"></div><!-- G#5 -->
            <div class="piano-key white-key" data-key-num="33"></div><!-- A5 -->
            <div class="piano-key black-key" data-key-num="34"></div><!-- A#5 -->
            <div class="piano-key white-key" data-key-num="35"></div><!-- B5 -->
        </div>
    </div>
    <p>下の再生ボタンをタップすると音声が流れます。</p>
    <div>
        <img src="{{asset('assets/img/play.png')}}" width="100">
    </div>
</div>

<p>3回ほど練習してみましょう。<br>音は一度だけ鳴ります。回答時間は10秒間です。<br>
    <button type="submit" class="btn btn-outline-default" onclick="location.href='prac01'">練習へすすむ</button>
</p>
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/piano_prac.js')}}"></script>
@endsection