@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('blog.admin.posts.includes.result_messages')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar-toggler">
                    <a class="btn btn-primary" href="{{ route('blog.admin.posts.create') }}">Добавить</a>
                    <a class="btn btn-secondary" href="{{ route('blog.admin.categories.index') }}">Категории</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Заголовок</th>
                                    <th>Автор</th>
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
                                        {{ $item->title }}
                                    </td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d M Y H:i') : '' }}
                                    </td>
                                    <td class="admin_actions">
                                        <a class="btn btn-primary" href="{{ route('blog.admin.posts.edit', $item->id) }}">Редактировать</a>
                                        @include('blog.admin.posts.includes._delete')
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
