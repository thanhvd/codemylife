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
                <div class="col-md-12">
                    <div class="panel panel-{{ $loop->index == 0 ? 'primary' : 'success' }}">
                        <div class="panel-heading"><h3 class="panel-title">{{ Carbon\Carbon::parse($date)->toFormattedDateString() }}</h3></div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Word</th>
                                        <th>Phonetic</th>
                                        <th>Meanings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($words as $word)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $word->word }}</td>
                                            <td>{{ $word->phonetic }}</td>
                                            <td>{!! nl2br($word->meanings) !!}</td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
