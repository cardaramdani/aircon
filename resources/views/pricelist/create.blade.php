<!-- resources/views/posts/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div>
            <label>Title</label>
            <input type="hidden" name="id" value="">
            <input type="text" name="title" value="{{ old('title') }}">
        </div>
        <div>
            <label>Body</label>
            <textarea name="body">{{ old('body') }}</textarea>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
