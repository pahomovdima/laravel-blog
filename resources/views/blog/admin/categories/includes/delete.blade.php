<br>
<form method="post" action="{{ route('blog.admin.categories.destroy', $item->id) }}">
    @method('DELETE')
    @csrf
    <div class="row justify-content">
        <div class="col-md-8">
            <div class="card card-block">
                <div class="card-body ml-auto">
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</form>
