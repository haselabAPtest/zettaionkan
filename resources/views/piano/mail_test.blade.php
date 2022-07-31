@extends('layouts.pianoapp')

@section('title','テスト前の質問')
@section('content')
<h1 class="mb-0">
    <div class="row py-3 align-items-center">
        <div class="col-sm-9">
            自動メールテスト
        </div>
    </div>
</h1>
<!-- Buttons -->
<form method="POST" action="mail_sent">
    @csrf
    <ul>
        <li><span>メールアドレス</span>
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
        
        <button type="submit" class="btn btn-outline-default">送る</button>
    </ul>
</form>
@endsection