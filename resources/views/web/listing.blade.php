@php(extract($data))
@extends('layouts.web')
@section('content')
<livewire:product-listing :gender="$gender"/>
@endsection
