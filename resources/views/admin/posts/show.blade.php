@extends('layouts.admin')

@section('pageTitle', $post->title)

@section('pageContent')
    <div class="container">
        <div class="mt-5 d-flex justify-content-between align-items-center text-white">
            <div class="mb-3">
                <h1>{{ $post->title }}</h1>
                <strong>{{ $post->user->name }}</strong> - -
                <strong>{{ $post->user->userInfo->phone }}</strong>
                <br>
                <strong>{{ $post->category->name }}</strong>
            </div>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-success float-right">Torna alla lista</a>
        </div>

        <div class="row">
            <div class="col-12 col-md-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                    <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">Creato il: {{ date('d/m/Y', strtotime($post->created_at)) }}</li>
                    <li class="list-group-item">Ultima modifica il: {{ date('d/m/Y', strtotime($post->updated_at)) }}</li>
                    </ul>

                    @if (Auth::user()->id === $post->user_id)
                        <div class="card-body">
                            <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->slug) }}">Modifica</a>
                            <button class="btn btn-danger btn-delete" data-id="{{ $post->slug }}">Cancella</button>
                        </div>
                    @endif

                </div>
            </div>
            <div class="col-12 offset-md-2 col-md-7 offset-lg-1 text-white">
                <h3 class="mt-3">Descrizione:</h3>
                <p class="pe-5">{{ $post->content }}</p>
                <h3 class="mt-3">Tag:</h3>
                <ul class="list-inline">
                    @foreach ($post->tags as $tag)
                        <li class="list-inline-item">#{{ $tag->name }}</li>
                    @endforeach
                </ul>
            </div>

        </div>

        <section id="confirmation-overlay" class="overlay d-none">
            <div class="popup">
                <h1>Sei sicuro di voler eliminare?</h1>
                <div class="d-flex justify-content-center">
                    <button id="btn-no" class="btn btn-primary me-3">NO</button>
                    <form method="POST" data-base="{{ route('admin.posts.destroy', 0) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">SI</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
