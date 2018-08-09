@if( count($errors))
    <div class="alert alert-danger">
        <ul>
            <li>{{ $errors->first() }}</li>
        </ul>
    </div>
    <div class="alert alert-danger">
        {{--只取第一条错误的数据--}}

        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
                @endforeach
        </ul>
    </div>
@endif