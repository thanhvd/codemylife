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
        @foreach ($diaryGroups as $date => $diaries)
            <div class="panel panel-success">
                <div class="panel-heading"><h3 class="panel-title">{{ Carbon\Carbon::parse($date)->toFormattedDateString() }}</h3></div>
                <div class="panel-body">
                    @foreach ($diaries as $diary)
                        <p class="text-muted"><strong>{{ $diary->created_at->format('H:i') }}</strong>: {{ $diary->content }}</p>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif

</div>
@endsection
