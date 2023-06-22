@extends('base')
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content mt-4">
        <div class="d-flex justify-content-around align-items-center mt-3">
            @foreach ($cats as $category)
                <div class="card category m-2">
                    @if ($user->id == $category->user_id || in_array($user->role, ['super-admin', 'admin']))
                        <div class="links text-start">
                            <a class="text-secondary edit-btn" href="#" data-cat-id="{{ $category->id }} "
                                data-cat-parent-id="" data-cat-name="{{ $category->name }}"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a class="text-secondary delete-btn" data-type="القسم"
                                href="{{ route('category.delete', $category->id) }}"><i class="fa-solid fa-trash"></i></a>
                        </div>
                        <form class="p-2 bg-light edit-category" action="{{ route('category.update') }}" method="POST">
                            <input type="hidden" class="category-id" name="category_id" value="{{ $category->id }}">
                            @csrf
                            @isset($categories)
                                @if (count($categories))
                                    <label for="" style="font-size:15px">اختر القسم الرئيسي</label>
                                    <select class="form-control mt-2 parent-id" name="parent_id" id="">
                                        <option value=""></option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('parent_id'))
                                        <span class="text-danger text-direction-rtl">{{ $errors->first('parent_id') }}</span>
                                    @endif
                                @endif
                            @endisset
                            <div class="form-group mt-3">
                                <label for="" style="font-size:15px">اسم القسم</label>
                                <input type="text" class="form-control mt-2 category-name" name="name"
                                    value="{{ $category->name }}" autocomplete="off">
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger text-direction-rtl">{{ $errors->first('name') }}</span>
                            @endif
                            <div class="form-group text-center">
                                <button class="btn ctm-btn mt-3">حفظ</button>
                            </div>
                        </form>
                    @endif
                    <a class="text-dark text-decoration-none" href="{{ route('categories.show', $category->id) }}">
                        <div class="category-img bg-dark text-center">
                            <img src="{{ asset('imgs/category.svg') }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body p-3">
                            <h5 class="card-title">{{ $category->name }} </h5>
                            <p class="card-text">{{ $category->description }}</p>
                        </div>
                    </a>
                    <div class="dropdown text-center">
                        <a class="btn btn-secondary w-100 dropdown-toggle " href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            الأقسام الفرعية
                        </a>
                        <ul class="dropdown-menu w-100 p-1" aria-labelledby="dropdownMenuLink">
                            @foreach ($category->subCats as $sub_cat)
                                <li>
                                    <a class="btn"
                                        href="{{ route('categories.show', $sub_cat->id) }}">{{ $sub_cat->name }}</a>
                                    @if ($user->id == $sub_cat->user_id || $user->role == 'admin')
                                        <div class="text-start">
                                            <a class="text-secondary edit-btn" href="#"
                                                data-cat-id="{{ $sub_cat->id }}"
                                                data-cat-parent-id="{{ $sub_cat->parent_id }}"
                                                data-cat-name="{{ $sub_cat->name }}"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="text-secondary delete-btn" data-type="القسم"
                                                href="{{ route('category.delete', $sub_cat->id) }}"><i
                                                    class="fa-solid fa-trash"></i></a>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{ $cats->links('vendor.pagination.bootstrap-4') }}
        </div>
        @include('includes.empty')
    </div>
@endsection
@section('js')
    <script>
        $('.edit-btn').on('click', function() {
            let thisBtn = $(this)
            let category = thisBtn.closest('.category');
            let editCategory = category.children('.edit-category');
            editCategory.fadeIn();
            category.css('height', editCategory.css('height'));
            editCategory.find('input.category-id').val(thisBtn.data('cat-id'))
            editCategory.find('input.category-name').val(thisBtn.data('cat-name'))
            editCategory.find('select.parent-id').val(thisBtn.data('cat-parent-id'))
        })
        $(document).on('click', function(e) {
            if (!e.target.closest('.card')) {
                $('.edit-category').fadeOut();
                $('.category').css('height', 'fit-content')
            }
        })
    </script>
@endsection
