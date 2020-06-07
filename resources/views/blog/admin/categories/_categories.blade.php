@foreach ($paginator as $item)
    <tr>
        <td>
            {{ $delimiter ?? '' }}
            {{ $item->title }}
        </td>
        <td>
            {{ $item->slug }}
        </td>
        <td>
            {{ $item->description }}
        </td>
        <td class="admin_actions">
            <a class="btn btn-primary" href="{{ route('blog.admin.categories.edit', $item->id) }}">Редактировать</a>
            @include('blog.admin.categories.includes._delete')
        </td>
    </tr>

    @isset($item->children)
        @include('blog.admin.categories._categories', [
            'paginator' => $item->children,
            'delimiter' => ' - ' . $delimiter ?? ''
        ])
    @endisset
@endforeach
