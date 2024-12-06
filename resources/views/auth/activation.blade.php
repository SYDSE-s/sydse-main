@extends('layouts.app')

@section('content')
    <select name="city" class="select-city mt-5">
        @foreach ($regions as $region)
            @php
                $city = $region['kode'];
                $explodedCode = explode('.', $city);
            @endphp
            @if (count($explodedCode) == 2)
                <option value="{{ $region['nama'] }}" data-code="{{ $region['kode'] }}">{{ $region['nama'] }}</option>
            @endif
        @endforeach
    </select>
@endsection


@section('script')
    <script src="{{ asset('js/region.js') }}"></script>
@endsection