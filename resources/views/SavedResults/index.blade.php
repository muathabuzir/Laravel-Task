@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('Save Result')}}</div>
                <div class="card-body">
                    @if(!count($saved_results))
                    <div class="alert alert-warning">{{ __('Oops there is no Saved Results') }}</div>  
                    @else
                    <table class="table table-hover w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Comment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($saved_results as $saved)
                            <tr>
                                <td>{{ $saved['id'] }}</td>
                                <td><a href="{{$saved['link']}}">{{ $saved['title'] }}</a></td>
                                <td>{{ ( mb_strlen($saved['desc']) > 50 ? mb_substr($saved['desc'], 0, 25).'...' :$saved['desc'] ) }}</td>
                                <td>{{ ( mb_strlen($saved['comment']) > 50 ? mb_substr($saved['comment'], 0, 25).'...' :$saved['comment'] ) }}</td>
                                <td><a href="saved_results/{{$saved['id']}}">{{__('View')}}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
