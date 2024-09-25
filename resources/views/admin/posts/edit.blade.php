@extends('layouts.app')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@endif

<form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="title" class="form-label">Titolo</label>
      <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp" value="{{old('title', $post->title)}}">
      @error('title')
        <small class="invalid-feedback">{{$message}}</small>
      @enderror
    </div>
    <div class="mb-3 d-flex flex-column">
      <label for="description" class="form-label">Descrizione</label>
      <textarea name="description" id="description" cols="30" rows="10">{{old('description', $post->description)}}</textarea>
      @error('description')
        <small class="invalid-feedback">{{$message}}</small>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

@endsection
