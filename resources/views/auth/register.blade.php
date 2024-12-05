@extends('layouts.app')

@section('content')
    <form action="{{ route('register') }}" method="POST" name="register" class="wrapper">
        @csrf
        <div class="text-container">
            <div class="mb-2 text-item">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" autofocus>
                {{-- <input type="number" name="id" hidden value=""> --}}
                <button type="button" class="next">next</button>
            </div>
            <div class="mb-2 text-item">
                <label for="business_name">Business_name</label>
                <input type="text" name="business_name" id="business_name" autofocus>
                <button type="button" class="next">next</button>
            </div>
            <div class="mb-2 text-item">
                <label for="category">Category</label>
                <select name="category" id="category" autofocus>
                    <option id="defaultCategory"></option>
                    <option value="fnb">F&B</option>
                    <option value="fashion">Fashion</option>
                </select>
                <button type="button" class="next">next</button>
            </div>
            <div class="mb-2 text-item">
                <label for="no_whatsapp">no_whatsapp</label>
                <input type="number" name="no_whatsapp" id="no_whatsapp" autofocus>
                <button type="button" class="next">next</button>
            </div>
            <div class="mb-2 text-item">
                {{-- <h4>Data</h4> --}}
                <button type="submit" class="btn btn-outline-primary mt-4">Submit</button>
            </div>
        </div>
    </form>
    {{-- <div class="wrapper">
        <div class="text-container">
            <div class="text-item big-text">
                Welcome, <span style="color: var(--second-color);">everyone</span>
            </div>
            <div class="text-item big-text">
                <span style="color: var(--second-color);">Introducing, </span>Our team
            </div>
            <div class="text-item container">
                <div class="box row justify-content-center">
                    <div class="col-md-4" style="width: max-content;">
                        <div class="img-profile profile-1"></div>
                    </div>
                    <div class="desc-profile col-md-8">
                        <div>Ahmad Kamaludin</div>
                        <div class="small-text">L300240074</div>
                    </div>
                </div>
            </div>
            <div class="text-item container">
                <div class="box row justify-content-center">
                    <div class="col-md-4" style="width: max-content;">
                        <div class="img-profile profile-2"></div>
                    </div>
                    <div class="desc-profile col-md-8">
                        <div>Ilham Dwi Prasetyo</div>
                        <div class="small-text">L300240080</div>
                    </div>
                </div>
            </div>
            <div class="text-item container">
                <div class="box row justify-content-center">
                    <div class="col-md-4" style="width: max-content;">
                        <div class="img-profile profile-3"></div>
                    </div>
                    <div class="desc-profile col-md-8">
                        <div>Dimas Satria MULYONO</div>
                        <div class="small-text">L300240082</div>
                    </div>
                </div>
            </div>
            <div class="text-item big-text fst-italic">
                Presenting.....
            </div>
        </div>
    </div> --}}
@endsection

@section('script')
    <script src="{{ asset('js/register.js') }}"></script>
@endsection