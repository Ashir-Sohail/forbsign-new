<option value="{{ $category->id }}">
    {!! str_repeat('--', $category->depth) !!} {{ $category->name }}
</option>

@if ($category->children->count() > 0)
    @foreach ($category->children as $child)
        @include('admin.category.partial.category-option', ['category' => $child])
    @endforeach
@endif


