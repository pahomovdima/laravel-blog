<form method="post" action="{{ route('blog.admin.comments.destroy', $item->id) }}">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger" >Удалить</button>
</form>
