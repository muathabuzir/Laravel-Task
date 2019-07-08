@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('Save Result')}}</div>
                <div class="card-body">
                    <h5 class="mb-0"><a class="text-primary" href="{{ $saved_result->link }}">{{ $saved_result->title }}</a></h5>
                    <h6 class="mb-0"><a class="text-success" href="{{ $saved_result->link }}">{{ $saved_result->link }}</a></h6>
                    <div class="text-muted">{{ $saved_result->desc }}</div>
                    <hr />
                    <div class="row">
                        <div class="col-6 text-black-50">
                            Create: {{ $saved_result->created_at }}
                        </div>
                        <div class="col-6 text-black-50 text-right">
                            Last Update: {{ $saved_result->updated_at }}
                        </div>
                    </div>
                    <hr />
                    <h6 class="mt-2 mb-0">{{ __('Comment') }}</h6>
                    <div class="text-muted">{{ $saved_result->comment }}</div>
                    <hr />
                    <a class="btn btn-light" href="/saved_results">{{ __('Back') }}</a>
                    <a class="btn btn-primary" href="/saved_results/{{ $saved_result->id }}/edit">{{ __('Edit') }}</a>
                    <button onclick="(confirm('are you sure to delete this item?') ? $('#delete_form').submit() : '');" type="button" class="btn btn-danger">{{ __('Delete') }}</button>
                    <form id="delete_form" class="w-0" action="/saved_results/{{ $saved_result->id }}" method="POST">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
