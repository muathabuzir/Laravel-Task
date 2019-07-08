@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Search</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <form class="needs-validation col-12" novalidate method="GET" action="/home">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="search" value="{{ old('search') }}" class="form-control" id="search" placeholder="Search" aria-describedby="inputGroupPrepend2" required>
                                <div class="input-group-append">
                                    <button class="input-group-text" type="submit" id="inputGroupPrepend2">Search</button>
                                </div>
                            </div>
                            @error('search')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </form>
                    </div>
                    <hr />
                    @if(!count($result))
                    @if(!empty(old('search')))
                    <div class="alert alert-danger">Opps No Data</div>
                    @endif
                    @else
                    @error('checked')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <form method="post" action="/saved_results">
                        @csrf
                        @foreach($result as $k => $res)
                        <div class="mb-3 border border-info rounded p-2">
                            <h5 class="mb-0"><input title="save" type="checkbox" name="checked[{{$k}}]" value="{{ $k }}" /> <a class="text-primary" href="{{ $res->link }}">{{ $res->title }}</a></h5>
                            <h6 class="mb-0"><a class="text-success" href="{{ $res->link }}">{{ $res->link }}</a></h6>
                            <div class="text-muted">{{ $res->snippet }}</div>
                            <input type="hidden" name="value[{{$k}}]" value="{{ json_encode($res) }}"  />
                            <textarea maxlength="250" title="comment" placeholder="Set Comment Here..." class="w-100 p-1" name="comment[{{$k}}]">{{ old('comment.'.$k)}}</textarea>
                        </div>
                        @endforeach
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
