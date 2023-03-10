@extends('website.layout.master')
@push('css')
<style>
    .view_article_sec{padding-top: 22px}
</style>
@endpush
@section('content')
<div class="container view_article_sec">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            {!! $blogs !!}</div>
        <div class="col-2"></div>
    </div>
</div>
@endsection
@push('js')
@endpush