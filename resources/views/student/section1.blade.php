@extends('layouts')

@section('header')
    @parent
    stop
    @stop
@section('sidebar')
    @parent
    sidebar1
@stop
@section('content')
    content
    <p>{{$name}}</p>
    <p>{{time()}}</p>
    <p>{{date('Y-m-d H:i:s',time())}}</p>
    <p>{{ in_array($name,$arr)? 'true':'false' }}</p>
    @if ($name == 'test')
        if test
        @elseif ( in_array($name,$arr))
        elseif test
        @else
        Who am I?
    @endif
    @unless($name != 'test')
        unless test0
        @endunless
    <br/>
    @for ($i=1;$i<3;$i++)
        {{ $i }}
        @endfor
    <br/>
    @foreach($students as $key=>$student)
        {{$key}}
        {{$student->name}}
        @endforeach
    @forelse($students as $key=>$student)
        {{$key}}
        {{$student->name}}
        @empty
        null

    @endforelse
    <br/>
    @include('student.common1',['msg'=>'Pass a msg'])
    @stop

@section('zoneA')
    aaa
@stop

@section('zoneB')
    bbb
@stop

@section('zoneC')
    ccc
@show
