@foreach ($categories as $category)
    <li>
        @if ($category->children->count())
            <span class="toggle-children" style="cursor: pointer;">&#9654;</span>
        @else
            <span style="display: inline-block; width: 1em;"></span>
        @endif

        <input type="checkbox" class="category-filter" value="{{ $category->id }}" id="filter-{{ $category->id }}">
        <label for="filter-{{ $category->id }}">{{ $category->name }}</label>


        @if ($category->children->count())
            <ul class="child-category-list" style="display: none; margin-left: 15px;">
                @include('user.category-tree-filter', ['categories' => $category->children])
            </ul>
        @endif
    </li>
@endforeach
