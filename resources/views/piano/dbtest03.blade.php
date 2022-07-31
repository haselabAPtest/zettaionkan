@extends('layouts.pianoapp')

@section('title','アンケート')
@section('content')
<table>
    <tr><th>名前</th><th>Q55</th><th>Q56</th><th>Q57</th><th>Q58</th><th>Q59</th><th>A55</th><th>A56</th><th>A57</th><th>A58</th><th>A59</th></tr>
    @foreach($items as $item)
        <tr>
            <td>{{$item->namae}}</td>
            <td>{{$item->q55}}</td>
            <td>{{$item->q56}}</td>
            <td>{{$item->q57}}</td>
            <td>{{$item->q58}}</td>
            <td>{{$item->q59}}</td>
            <td>{{$item->a55}}</td>
            <td>{{$item->a56}}</td>
            <td>{{$item->a57}}</td>
            <td>{{$item->a58}}</td>
            <td>{{$item->a59}}</td>
        </tr>
    @endforeach
</table>
@endsection