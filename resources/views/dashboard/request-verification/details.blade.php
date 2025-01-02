@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')

@section('content')
            @php
                $count = 1;
            @endphp
            @foreach ($data_members as $data)
            <img src="" alt="">
                @php
                    $count++;
                @endphp
            @endforeach
    </table>
@endsection
