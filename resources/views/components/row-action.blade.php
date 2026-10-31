@props(['show' => null, 'edit' => null, 'delete' => null])
<div class="row-actions">
    @if($show)
        <a class="icon-btn" href="{{ $show }}" title="Xem"><i class="bi bi-eye"></i></a>
    @endif
    @if($edit)
        <a class="icon-btn" href="{{ $edit }}" title="Sửa"><i class="bi bi-pencil-square"></i></a>
    @endif
    @if($delete)
        <form method="POST" action="{{ $delete }}" onsubmit="return confirm('Bạn chắc chắn muốn xóa?')">
            @csrf @method('DELETE')
            <button type="submit" class="icon-btn danger" title="Xóa"><i class="bi bi-trash"></i></button>
        </form>
    @endif
</div>
