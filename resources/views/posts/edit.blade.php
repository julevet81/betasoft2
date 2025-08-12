@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">
    <h2>Edit post</h2>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- post Name --}}
        <div class="mb-3">
            <label for="title" class="form-label">post Title</label>
            <input type="text" name="title" id="title"
                   value="{{ old('title', $post->title) }}"
                   class="form-control" required>
        </div>

        

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update post</button>
    </form>
</div>
@endsection
@section('js')
@endsection