🎹🎵🎸

# 絶対音感テスト
研究の実験において使用する被験者の音高同定能力を測るためのWebアプリです.

前年までの実験に使用していたWebアプリがFlashを用いたものであったため,2020年12月のAdobe Flashサポート終了に伴い一から開発を行いました.

ピアノ音,ギター音,純音の3種類のC4~B6までの3オクターブ分合計108音をランダムな順番で呈示し,該当する音高を回答してもらうというものです.

## DEMO

![piano_demo](https://user-images.githubusercontent.com/90432856/150243351-c760eef1-5541-41e3-9cc3-c10199db9852.gif)

# 機能概要
![概要](https://user-images.githubusercontent.com/90432856/152507381-8afe2b08-6d6c-4617-a3e5-d0f99d00250d.png)

# 使用技術
Laravelを軸として開発を行いました.

## フロントエンド

* Blade
* Javascript(🎹の押下処理など)

## バックエンド
* PHP7.4
* Python3.6.0(実装予定のテスト結果のメール自動送信機能部分)

## データベース
* MySQL8.0

## Requirement Python Package
* google-api-python-client
* google-auth-httplib2
* google-auth-oauthlib
* oauth2client
* matplotlib

## URL
絶対音感をお持ちの方は是非実験にご協力をお願いします！

※matplotlibを使用した結果のグラフ化及びGmail APIでのテスト結果の自動送信は近いうちに本実装予定です.(ただいまテスト中😑)

http://music.is.utsunomiya-u.ac.jp/

## Authors
hirataipenguin
