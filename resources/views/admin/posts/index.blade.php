@extends('layouts.app')

@section('content')
@if (session('status'))
<p class="alert alert-success">{{ session('status') }}</p>
@endif

<table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Categoria</th>
        <th scope="col">Caricamento</th>
        <th scope="col">Option</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)

        <tr>
          <th scope="row">{{ $post->id }}</th>
          <td>{{ $post->title }}</td>
          <td class="badge text-bg-success d-inline">{{ $post->category->name }}</td>
          <td>{{ $post->added_at }}</td>
          <td
            class="d-flex gap-1">
            <a href="{{route('admin.posts.show', $post)}}" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square "></i></a>
            <form action="{{route('admin.posts.destroy', $post)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
            </form>
          </td>

        </tr>
        @endforeach

    </tbody>
  </table>
  {{ $posts->links() }}
@endsection
