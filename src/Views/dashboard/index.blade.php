@extends('larapoll::layouts.app')
@section('title')
    Polls- Listing
@endsection
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Polls</li>
        </ol>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($polls->count() >= 1)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Options</th>
                    <th>Votes</th>
                    <th>State</th>
                    <th>Edit</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody>
                @forelse($polls as $poll)
                    <tr>
                        <th scope="row">{{ $poll->id }}</th>
                        <td>{{ $poll->question }}</td>
                        <td>{{ $poll->options_count }}</td>
                        <td>{{ $poll->votes_count }}</td>
                        <td>
                            @if($poll->isLocked())
                                <span class="label label-danger">Closed</span>
                            @else
                                <span class="label label-success">Open</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-default" href="{{ route('poll.edit', $poll->id) }}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('poll.remove', $poll->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <smal>No poll has been found. Try to add one <a href="{{ route('poll.create') }}">Now</a></smal>
        @endif
        {{ $polls->links() }}
    </div>
@endsection