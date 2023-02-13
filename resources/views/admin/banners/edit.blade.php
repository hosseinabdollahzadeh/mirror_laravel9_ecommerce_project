@extends('admin.layouts.admin')

@section('title')
    edit banner
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش بنر: {{$banner->image}}</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{route('admin.banners.update', $banner->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row justify-content-center mb-3">
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{url(env('BANNER_IMAGES_UPLOAD_PATH').$banner->image)}}">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3">
                        <label for="primary_image">انتخاب تصویر</label>
                        <div class="custom-file">
                            <input type="file" name="image" id="banner_image" class="custom-file-input"/>
                            <label class="custom-file-label" for="banner_image"> انتخاب فایل </label>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="title">عنوان</label>
                        <input class="form-control" id="title" name="title" type="text" value="{{$banner->title}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="text">متن</label>
                        <input class="form-control" id="text" name="text" type="text" value="{{$banner->text}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="priority">اولویت</label>
                        <input class="form-control" id="priority" name="priority" type="number"
                               value="{{$banner->priority}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" {{$banner->getRawOriginal('is_active') == 1 ? 'selected' : ''}}>فعال</option>
                            <option value="0" {{$banner->getRawOriginal('is_active') == 0 ? 'selected' : ''}}>غیرفعال</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="type">نوع بنر</label>
                        <input class="form-control" id="type" name="type" type="text" value="{{$banner->type}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="button_text">متن دکمه</label>
                        <input class="form-control" id="button_text" name="button_text" type="text"
                               value="{{$banner->button_text}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="button_link">لینک دکمه</label>
                        <input class="form-control" id="button_link" name="button_link" type="text"
                               value="{{$banner->button_link}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="button_icon">آیکون دکمه</label>
                        <input class="form-control" id="button_icon" name="button_icon" type="text"
                               value="{{$banner->button_icon}}">
                    </div>
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{route('admin.banners.index')}}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // show file name
        $('#banner_image').change(function () {
            // get the file name
            var filename = $(this).val();
            // replace the "Choose s file" label
            $(this).next('.custom-file-label').html(filename)
        });
    </script>
@endsection
