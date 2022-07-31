@extends('layouts.pianoapp')

@section('title','テスト前の質問')
@section('content')
<script>
    function createSelectBox() {
    //連想配列の配列
    var arr = [
        { val: '0', txt: 'C4' },
        { val: '1', txt: 'C#4' },
        { val: '2', txt: 'D4' },
        { val: '3', txt: 'D#4' },
        { val: '4', txt: 'E4' },
        { val: '5', txt: 'F4' },
        { val: '6', txt: 'F#4' },
        { val: '7', txt: 'G4' },
        { val: '8', txt: 'G#4' },
        { val: '9', txt: 'A4' },
        { val: '10', txt: 'A#4' },
        { val: '11', txt: 'B4' },
        { val: '12', txt: 'C5' },
        { val: '13', txt: 'C#5' },
        { val: '14', txt: 'D5' },
        { val: '15', txt: 'D#5' },
        { val: '16', txt: 'E5' },
        { val: '17', txt: 'F5' },
        { val: '18', txt: 'F#5' },
        { val: '19', txt: 'G5' },
        { val: '20', txt: 'G#5' },
        { val: '21', txt: 'A5' },
        { val: '22', txt: 'A#5' },
        { val: '23', txt: 'B5' },
        { val: '24', txt: 'C6' },
        { val: '25', txt: 'C#6' },
        { val: '26', txt: 'D6' },
        { val: '27', txt: 'D#6' },
        { val: '28', txt: 'E6' },
        { val: '29', txt: 'F6' },
        { val: '30', txt: 'F#6' },
        { val: '31', txt: 'G6' },
        { val: '32', txt: 'G#6' },
        { val: '33', txt: 'A6' },
        { val: '34', txt: 'A#6' },
        { val: '35', txt: 'B6' },
        { val: '999', txt: '無回答' }
    ];

    //連想配列をループ処理で値を取り出してセレクトボックスにセットする
    for (var j=0;j<35;j++){
        document.write('<span>',arr[j].txt,'</span><select name=',j,''>'', arr[j].txt)
        for (var i = 0; i < arr.length; i++) {
            document.write('<option value=', arr[i].val, '>', arr[i].txt, '</option>')
        }
        document.write('</select>')
        if(j%6==5){
            document.write('<br>')
        }
    }
                
};
</script>

<h1 class='mb-0'>
    <div class='row py-3 align-items-center'>
        <div class='col-sm-9'>
            自動メールテスト
        </div>
    </div>
</h1>
<!-- Buttons -->
<form method='POST' action='mail_sent'>
    @csrf
    <ul>
        <li><span>メールアドレス</span>
            <div>
                <div class='row'>
                    <div class='col-lg-4 col-sm-6'>
                        <div class='form-group'>
                            <input type='email' placeholder='メールアドレス' class='form-control' name='mail' required />
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <div>
            <div>
                <script>createSelectBox()</script>
            </div>
        </div>
        
        <button type='submit' class='btn btn-outline-default'>送る</button>
    </ul>
</form>
@endsection