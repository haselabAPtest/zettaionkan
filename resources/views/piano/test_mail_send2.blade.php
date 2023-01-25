@extends('layouts.pianoapp')

@section('title','メール送信テスト')
@section('content')


               
<?php


//  $command ="python \C:\Users\music\Documents\xammpp\zettaionkan\app\Python\send_mail.py\ 2>&1";
//  exec($command, $output,$a);
//  print($command);
//  echo('<br>');
 $command ='python ' . config('app.pythonPATH') . 'send_mail.py 2>&1';
 exec($command, $output,$a);
 print($command);
 echo('<br>');

 print_r($output);
 
 echo('<br><br>');

exec($command ,$dum,$rtn); // 2>&1 で標準エラー出力も標準出力へ吐き出す
echo('<pre>'); // フォーマットを整える
var_dump($dum); // 標準出力 (標準エラー出力を含む) をブラウザに出力
echo('<pre>');
echo("return: $rtn\n"); // hoge 命令の返り値を "return: 返り値" の形で出力


echo(getenv("PATH"));



?>

@endsection
 