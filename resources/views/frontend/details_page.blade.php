@extends('frontend.layout.master')
@section('title', $page->title)
@section('content')
    <div class="container mb-4">
        <div class="row my-4">
            <div class="col-lg-9 mx-auto">
                <h2 class="my-3"><strong>{{ $page->title }}</strong></h2>
                {!! $page->content !!}
            </div>
        </div>
    </div>
@endsection
