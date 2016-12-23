@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ url('diaries') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control" id="content" name="content" placeholder="Status" autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <hr />
    @if (count($diaryGroups) > 0)
        <div class="row">
            @foreach ($diaryGroups as $date => $diaries)
                <div class="col-md-6">
                    <div class="panel panel-{{ $loop->index == 0 ? 'primary' : 'success' }}">
                        <div class="panel-heading"><h3 class="panel-title">{{ Carbon\Carbon::parse($date)->toFormattedDateString() }}</h3></div>
                        <div class="panel-body">
                            @foreach ($diaries as $diary)
                                <p class="text-muted"><strong>{{ $diary->created_at->format('h:i A') }}</strong>: {{ $diary->content }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
