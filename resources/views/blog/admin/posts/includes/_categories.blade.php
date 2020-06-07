@foreach ($categoryList as $categoryItem)
    <option value="{{ $categoryItem->id ?? '' }}"
    @isset ($item->id)
        @if ($categoryItem->id == $item->category_id)
            selected=""
        @endif

        @if ($categoryItem->id == $item->id)
            disabled=""
        @endif
    @endisset
    >
        {{ $delimiter ?? '' }}{{ $categoryItem->title ?? '' }}
    </option>

    @isset($categoryItem->children)
        @include('blog.admin.posts.includes._categories', [
            'categoryList' => $categoryItem->children,
            'delimiter' => ' - ' . $delimiter ?? ''
        ])
    @endisset
@endforeach
