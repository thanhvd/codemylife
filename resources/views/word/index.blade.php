@extends('layouts.app')

@section('content')
<style type="text/css">
  .panel-body {
    position: relative;
  }
  #myScrollspy {
    overflow-y: scroll;
    height: 400px;
  }
  #myScrollspy .nav {
    position: absolute;
    top: 0;
  }
  .meaning {
    padding-left: 20px;
    overflow-y: scroll;
    height: 400px;
  }
</style>

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
                          <nav class="col-sm-2" id="myScrollspy{{ $loop->index }}">
                            <ul class="nav nav-pills nav-stacked">
                              @foreach ($words as $word)
                                <li><a href="#{{ $word->word }}{{ $loop->index }}">{{ $loop->index + 1 }}. {{ $word->word }}</a></li>
                              @endforeach
                            </ul>
                          </nav>
                          <div class="meaning" class="col-sm-10" data-spy="scroll" data-target="#myScrollspy{{ $loop->index }}" data-offset="20">
                            @foreach ($words as $word)
                              <div id="{{ $word->word }}{{ $loop->index }}">
                                <h1>{{ $word->word }}</h1>
                                <p>{!! $word->meanings !!}</p>
                              </div>
                            @endforeach
                          </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
