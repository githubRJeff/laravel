@foreach( $students as $student)
    <h1>{{ $student->name }}</h1>
    <h2>{{ $student->age }}</h2>
    <h3>{{ $student->sex }}</h3>
    @endforeach