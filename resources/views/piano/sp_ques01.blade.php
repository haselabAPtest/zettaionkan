@extends('layouts.pianoapp')

@section('title','テスト前半')
@section('content')
<div>
    <p class="message">{{$count}}/53</p>
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
</div>

<p><a onClick="sound()"><input id="play_img" type="image" src="{{asset('assets/img/play.png')}}" alt="再生する" width="120" style="align-items: center;"></a></p>

<div class="css1">
    <div class="ans_time">回答時間</div>
    <div id="msg"></div>
</div>

<audio id="sound-file" preload="auto">
    <source src="assets/sound/sound_{{$soundNo}}.mp3"; ?>
</audio>

<script type="text/javascript">
    function sound() {
        var pics_src=new Array("assets/img/play.png","assets/img/play_now.png");
        var num = 0;

        function changeimg(){
            if(num==2){
                num=1;
            }else{
                num++;
            }
            document.getElementById("play_img").src=pics_src[num]
        }

    changeimg();
    // [ID:sound-file]の音声ファイルを再生[play()]する
    document.getElementById('sound-file').play();
    }
</script>
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/sp_piano_function.js')}}"></script>
<script src="{{asset('assets/js/piano_timer.js')}}"></script>
<script type="text/javascript">
    pianoWrap.addEventListener("mousedown", function () { mouseEvents(event) });
    setTimeout(() => {
        post('ques01', { val: selectedKey });
    }, 10000);
</script>
@endsection