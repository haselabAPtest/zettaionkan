@extends('layouts.pianoapp')

@section('title','テスト前の質問')
@section('content')
<h1 class="mb-0">
    <div class="row py-3 align-items-center">
        <div class="col-sm-9">
            事前情報の入力
        </div>
    </div>
</h1>
<!-- Buttons -->
<form method="POST" action="confirm">
    @csrf
    <ul>
        <li>
            <span>氏名</span>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="form-group">
                        <input type="text" placeholder="ニックネーム可" class="form-control" name="name" required>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <span>性別　</span>
            <label>
            <div class="custom-control custom-radio mb-3">
                <input name="sex" class="custom-control-input" id="customRadio1" type="radio" value="男性" required>
                <label class="custom-control-label" for="customRadio1">
                <span>男性</span>
                </label>
            </div>
            </label>
            <label>
            <div class="custom-control custom-radio mb-3">　
                <input name="sex" class="custom-control-input" id="customRadio2" type="radio" value="女性">
                <label class="custom-control-label" for="customRadio2">
                <span>女性</span>
                </label>
            </div>
            </label>
        </li>
        <li>
            <span>年齢</span>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="form-group">
                        <input type="number" class="form-control" name="age" min="0" required>
                    </div>
                </div>
            </div>
        </li>
        <li><span>ピアノによる音楽教育を何歳から何歳まで受けていましたか？</span></li>
        <div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="form-group">
                        <textarea rows="4" maxlength="400" placeholder="例：5歳から12歳まで" class="form-control" name="learnPiano"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <li><span>音楽に携わる仕事や活動をしていますか？</span>
            <div>
            <label>
            <div class="custom-control custom-radio mb-3">　
                <input name="musicJob" class="custom-control-input" id="customRadio3" type="radio" value="はい" required>
                <label class="custom-control-label" for="customRadio3">
                <span>はい</span>
                </label>
            </div>
            </label>
            <label>
            <div class="custom-control custom-radio mb-3">　
                <input name="musicJob" class="custom-control-input" id="customRadio4" type="radio" value="いいえ">
                <label class="custom-control-label" for="customRadio4">
                <span>いいえ</span>
                </label>
            </div>
            </label>
            </div>
        </li>
        <li><span>絶対音感は持っていますか？</span>
            <div>
            <label>
            <div class="custom-control custom-radio mb-3">　
                <input name="absolutePitch" class="custom-control-input" id="customRadio5" type="radio" value="はい" required>
                <label class="custom-control-label" for="customRadio5">
                <span>はい</span>
                </label>
            </div>
            </label>
            <label>
            <div class="custom-control custom-radio mb-3">　
                <input name="absolutePitch" class="custom-control-input" id="customRadio6" type="radio" value="いいえ">
                <label class="custom-control-label" for="customRadio6">
                <span>いいえ</span>
                </label>
            </div>
            </label>
            </div>
        </li>
        <li><span>絶対音感を持っている方は能力の低下を感じたことはありますか？</span>
            <div>
            <label>
                <div class="custom-control custom-radio mb-3">　
                    <input name="ability" class="custom-control-input" id="customRadio7" type="radio" value="はい" required>
                    <label class="custom-control-label" for="customRadio7">
                    <span>はい</span>
                    </label>
                </div>
                </label>
                <label>
                <div class="custom-control custom-radio mb-3">　
                    <input name="ability" class="custom-control-input" id="customRadio8" type="radio" value="いいえ">
                    <label class="custom-control-label" for="customRadio8">
                    <span>いいえ</span>
                    </label>
                </div>
                </label>
                <label>
                    <div class="custom-control custom-radio mb-3">　
                        <input name="ability" class="custom-control-input" id="customRadio9" type="radio" value="絶対音感を持っていない">
                        <label class="custom-control-label" for="customRadio9">
                        <span>絶対音感を持っていない</span>
                        </label>
                    </div>
                    </label>
            </div>
        </li>
        <li><span>絶対音感能力が低下した時期、どのような症状が出ましたか？</span></li>
        <div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="form-group">
                        <textarea rows="4" maxlength="400" placeholder="例：通常時よりも音が高く感じた" class="form-control" name="symptom"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <li><span>絶対音感テストの結果をメールで受け取りますか？</span>
            <div>
            <label>
                <div class="custom-control custom-radio mb-3">　
                    <input name="result" class="custom-control-input" id="customRadio10" type="radio" value="はい" required>
                    <label class="custom-control-label" for="customRadio10">
                    <span>はい</span>
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
        <li><span>結果の受け取りをご希望の方はメールアドレスをご記入ください。</span>
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
        
        <button type="submit" class="btn btn-outline-default">確認する</button>
    </ul>
</form>
@endsection