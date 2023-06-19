<!-- resources/views/like-form.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Like Form</h1>
    <form method="POST" action="{{ route('likes') }}">
        @csrf
        <div>
            <label for="comment_id">Comment ID:</label>
            <input type="text" name="comment_id" id="comment_id">
        </div>
        <div>
            <label for="user_id">User ID:</label>
            <input type="text" name="user_id" id="user_id">
        </div>
        <button type="submit">Submit</button>
    </form>
@endsection
