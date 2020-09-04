@extends('layouts.app')

@section('content')
<div id="app">
	<gestionar-productos/>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/gestionarProductos.js') }}"></script>
@endpush