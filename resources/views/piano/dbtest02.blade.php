@extends('layouts.pianoapp')

@section('title','アンケート')
@section('content')
<table>
    <tr><th>名前</th><th>Q1</th><th>Q2</th><th>Q3</th><th>Q4</th><th>Q5</th><th>A1</th><th>A2</th><th>A3</th><th>A4</th><th>A5</th></tr>
    @foreach($items as $item)
        <tr>
            <td>{{$item->namae}}</td>
            <td>{{$item->q1}}</td>
            <td>{{$item->q2}}</td>
            <td>{{$item->q3}}</td>
            <td>{{$item->q4}}</td>
            <td>{{$item->q5}}</td>
            <td>{{$item->a1}}</td>
            <td>{{$item->a2}}</td>
            <td>{{$item->a3}}</td>
            <td>{{$item->a4}}</td>
            <td>{{$item->a5}}</td>
        </tr>
    @endforeach
</table>
@endsection