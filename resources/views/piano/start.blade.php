@extends('layouts.pianoapp')

@section('title','テスト前の質問')
@section('content')

<h2 class="mb-0">
    <div class="row py-3 align-items-center">
        <div class="col-sm-9">
            事前情報の入力
        </div>
    </div>
</h2>
<br>
<!-- Buttons -->
<form method="POST" action="confirm">
    @csrf
    <ul>
        <li>
            <span class="back">氏名</span>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="form-group">
                        <input type="text" placeholder="ニックネーム可" class="form-control" name="name" required>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <span class="back">性別　</span>
            <label>
            <div class="custom-control custom-radio mb-3">
                <input name="sex" class="custom-control-input" id="customRadio1" type="radio" value="男性" required>
                <label class="custom-control-label" for="customRadio1">
                <span class="back">男性</span>
                </label>
            </div>
            </label>
            <label>
            <div class="custom-control custom-radio mb-3">
                <input name="sex" class="custom-control-input" id="customRadio2" type="radio" value="女性">
                <label class="custom-control-label" for="customRadio2">
                <span class="back">女性</span>
                </label>
            </div>
            </label>
        </li>
        <li>
            <span class="back">年齢</span>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="form-group">
                        <input type="number" class="form-control" name="age" min="0" required>
                    </div>
                </div>
            </div>
        </li>
        <li><span class="back">ピアノによる音楽教育を何歳から何歳まで受けていましたか？(最大400字)</span></li>
        <div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="form-group">
                        <textarea rows="4" maxlength="400" placeholder="例：5歳から12歳まで" class="form-control" name="learnPiano"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <li><span class="back">音楽に携わる仕事や活動をしていますか？</span>
            <div>
            <label>
            <div class="custom-control custom-radio mb-3">
                <input name="musicJob" class="custom-control-input" id="customRadio3" type="radio" value="はい" required>
                <label class="custom-control-label" for="customRadio3">
                <span class="back">はい</span>
                </label>
            </div>
            </label>
            <label>
            <div class="custom-control custom-radio mb-3">
                <input name="musicJob" class="custom-control-input" id="customRadio4" type="radio" value="いいえ">
                <label class="custom-control-label" for="customRadio4">
                <span class="back">いいえ</span>
                </label>
            </div>
            </label>
            </div>
        </li>
        <li><span class="back">絶対音感は持っていますか？</span>
            <div>
            <label>
            <div class="custom-control custom-radio mb-3">
                <input name="absolutePitch" class="custom-control-input" id="customRadio5" type="radio" value="はい" required>
                <label class="custom-control-label" for="customRadio5">
                <span class="back">はい</span>
                </label>
            </div>
            </label>
            <label>
            <div class="custom-control custom-radio mb-3">
                <input name="absolutePitch" class="custom-control-input" id="customRadio6" type="radio" value="いいえ">
                <label class="custom-control-label" for="customRadio6">
                <span class="back">いいえ</span>
                </label>
            </div>
            </label>
            </div>
        </li>
        <li><span class="back">絶対音感を持っている方は能力の低下を感じたことはありますか？</span>
            <div>
            <label>
                <div class="custom-control custom-radio mb-3">
                    <input name="ability" class="custom-control-input" id="customRadio7" type="radio" value="はい" required>
                    <label class="custom-control-label" for="customRadio7">
                    <span class="back">はい</span>
                    </label>
                </div>
                </label>
                <label>
                <div class="custom-control custom-radio mb-3">
                    <input name="ability" class="custom-control-input" id="customRadio8" type="radio" value="いいえ">
                    <label class="custom-control-label" for="customRadio8">
                    <span class="back">いいえ</span>
                    </label>
                </div>
                </label>
                <label>
                    <div class="custom-control custom-radio mb-3">
                        <input name="ability" class="custom-control-input" id="customRadio9" type="radio" value="絶対音感を持っていない">
                        <label class="custom-control-label" for="customRadio9">
                        <span class="back">絶対音感を持っていない</span>
                        </label>
                    </div>
                    </label>
            </div>
        </li>
        <li><span class="back">絶対音感能力が低下した時期、どのような症状が出ましたか？(最大400字)</span></li>
        <div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="form-group">
                        <textarea rows="4" maxlength="400" placeholder="例：通常時よりも音が高く感じた" class="form-control" name="symptom"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <li><span class="back">絶対音感テストの結果をメールで受け取りますか？</span>
            <div>
            <label>
                <div class="custom-control custom-radio mb-3">
                    <input name="result" class="custom-control-input" id="customRadio10" type="radio" value="はい" required>
                    <label class="custom-control-label" for="customRadio10">
                    <span class="back">はい</span>
                    </label>
                </div>
                </label>
                <label>
                <div class="custom-control custom-radio mb-3">
                    <input name="result" class="custom-control-input" id="customRadio11" type="radio" value="いいえ">
                    <label class="custom-control-label" for="customRadio11">
                    <span>いいえ</span>
                    </label>
                </div>
                </label>
            </div>
        </li>
        <li><span class="back">結果の受け取りをご希望の方はメールアドレスをご記入ください。</span>
            <div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <input type="email" placeholder="メールアドレス" class="form-control" name="mail" />
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <div  class="back">
        <button type="submit" class="btn btn-outline-default">確認する</button>
        </div>
    </ul>
</form>

@endsection
