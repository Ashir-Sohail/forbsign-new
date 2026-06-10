@foreach ($categories as $cat)
    @if ($cat->id != $category->id)
        <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
            {{ str_repeat('--', $level) }} {{ $cat->name }}
        </option>
        
        @if ($cat->children->count())
            @include('admin.category.partial.category-option-update', [
                'categories' => $cat->children, 
                'level' => $level + 1, 
                'category' => $category
            ])
        @endif
    @endif
@endforeach
