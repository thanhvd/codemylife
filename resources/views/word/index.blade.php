@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ url('words') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control" id="word" name="word" placeholder="Status" autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Find and Save</button>
    </form>
    <hr />
    @if (count($wordGroups) > 0)
        <div class="row">
            @foreach ($wordGroups as $date => $words)
                <div class="col-md-6">
                    <div class="panel panel-{{ $loop->index == 0 ? 'primary' : 'success' }}">
                        <div class="panel-heading"><h3 class="panel-title">{{ Carbon\Carbon::parse($date)->toFormattedDateString() }}</h3></div>
                        <div class="panel-body">
                            @foreach ($words as $word)
                                <p class="text-muted"><strong>{{ $word->created_at->format('H:i') }}</strong>: {{ $word->content }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
