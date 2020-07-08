@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('blog.admin.comments.includes.result_messages')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar-toggler">
                    <a class="btn btn-secondary" href="{{ route('blog.admin.posts.index') }}">Записи</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>post_id</th>
                                    <th>Имя автора</th>
                                    <th>Email</th>
                                    <th>Дата публикации</th>
                                    <th>Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($paginator as $item)
                                @php
                                    /** @var \App\Models\BlogPost $post */
                                @endphp
                                <tr @if (!$item->is_published) style="background-color: #ccc" @endif>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a href="{{ route('blog.admin.posts.edit', $item->post->id) }}">
                                            {{ $item->post_id }}
                                        </a>
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d M Y H:i') : '' }}
                                    </td>
                                    <td class="admin_actions">
                                        <a class="btn btn-primary" href="{{ route('blog.admin.comments.edit', $item->id) }}">Редактировать</a>
                                        @include('blog.admin.comments.includes._delete')
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if ($paginator->total() > $paginator->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $paginator->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
