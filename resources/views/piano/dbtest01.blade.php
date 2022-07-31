@extends('layouts.pianoapp')

@section('title','アンケート')
@section('content')
<table>
    <tr><th>名前</th><th>性別</th><th>年齢</th><th>Q1</th><th>Q2</th><th>Q3</th><th>Q4</th><th>Q5</th><th>result</th><th>mail</th><th>date</th></tr>
    @foreach($items as $item)
        <tr>
            <td>{{$item->namae}}</td>
            <td>{{$item->seibetsu}}</td>
            <td>{{$item->nenrei}}</td>
            <td>{{$item->q1}}</td>
            <td>{{$item->q2}}</td>
            <td>{{$item->q3}}</td>
            <td>{{$item->q4}}</td>
            <td>{{$item->q5}}</td>
            <td>{{$item->result}}</td>
            <td>{{$item->mail}}</td>
            <td>{{$item->date}}</td>
        </tr>
    @endforeach
</table>
@endsection