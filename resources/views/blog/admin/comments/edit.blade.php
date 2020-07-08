@extends('layouts.admin')

@section('content')
    @php /** \App\Models\BlogCategory $item */ @endphp
    <div class="container">
        <nav class="navbar-toggler">
            <a class="btn btn btn-secondary" href="{{ route('blog.admin.comments.index') }}">Назад</a>
        </nav>

        @include('blog.admin.posts.includes.result_messages')

        @if ($item->exists)
            <form method="post" action="{{ route('blog.admin.comments.update', $item->id) }}">
                @method('PATCH')
                @csrf

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @include('blog.admin.comments.includes.item_edit_main_col')
                    </div>
                    <div class="col-md-4">
                        @include('blog.admin.comments.includes.item_edit_add_col')
                    </div>
                </div>
            </form>

            @include('blog.admin.posts.includes.delete')
        @endif
    </div>
@endsection
