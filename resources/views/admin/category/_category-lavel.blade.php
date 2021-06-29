<div class="form-group">
    <label>Select Category Level</label>
    <select class="form-control" id="parent_id" name="parent_id">
    <option value="0" @if(isset($editcategory) && ($editcategory->parent_id == 0)) selected @endif>Main Category</option>
    @if(!empty($categories))
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if(isset($editcategory) && ($editcategory->parent_id == $category->id)) selected @endif >{{ $category->category_name }}</option>
            @if(!empty($category->subcategories))
                @foreach($category->subcategories as $subcategory)
                <option value="{{ $subcategory->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $subcategory->category_name }}</option>
                @endforeach
            @endif
        @endforeach
    @endif
    </select>
</div>
