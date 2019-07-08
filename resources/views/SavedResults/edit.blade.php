@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('Save Result')}}</div>
                <div class="card-body">
                    <form action="/saved_results/{{ $saved_result->id }}" method="post">
                        @csrf
                        @method('put')
                        @if(Session::has('success'))
                        <div class="alert alert-success mt-2">{{ Session::get('success') }}</div>
                        @endif
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
                        <div class="input-group">
                            <textarea maxlength="250" class="form-control" name="comment"> {{ $saved_result->comment }}</textarea>
                        </div>
                        @error('comment')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <hr />
                        <a class="btn btn-light" href="/saved_results/{{ $saved_result->id }}">{{ __('Back') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
