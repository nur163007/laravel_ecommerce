@extends('admin.master')
@section('header','Add Brand')
@section('title','Brand')

@section('main-content')
 <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="card">
                <div class="card-header">
                    <h3>Create Brand</h3>
                </div>
                @include('admin.includes.message')
                <div class="card-body">
                    <form method="post" action="{{ route('admin.storeBrand') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="category_id">Category Name</label>

                                <select id="" class="custom-select" name="category_id">
                                    <option value="">--select category name--</option>
                                    @foreach ($category as $categories)
                                    <option value="{{$categories->id}}">{{$categories->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subcat_id">Subcategory Name</label>
                                 <select id="" class="custom-select" name="subcat_id">
                                    <option value="">--select subcategory name--</option>
                                    @foreach ($subcat as $sub)
                                    <option value="{{$sub->id}}">{{$sub->sub_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('subcat_id'))
                                    <p class="text-danger">{{ $errors->first('subcat_id') }}</p>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="brand_name">Brand Name</label>
                                <input class="form-control" type="text" name="brand_name">
                                @if ($errors->has('brand_name'))
                                    <p class="text-danger">{{ $errors->first('brand_name') }}</p>
                                @endif
                            </div>
                             <div class="form-group col-md-6">
                                <label for="status">Status</label>

                                <select id="" class="custom-select" name="status">
                                    <option value="">--select--</option>
                                    <option value="1">Open</option>
                                    <option value="0">Close</option>
                                </select>
                                @if ($errors->has('status'))
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                @endif
                            </div>
							<div class="form-group col-md-6">
                                <label for="description">Description</label>
                                <textarea class="form-control" type="text" name="description"></textarea>
                                @if ($errors->has('description'))
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                @endif
                            </div>
                            <div class="form-group col-md-5">
                                <label for="image">Image</label>
                                <input class="form-control" type="file" name="image"id="image">

                                @if ($errors->has('image'))
                                    <p class="text-danger">{{ $errors->first('image') }}</p>
                                @endif
                            </div>

                            <div class="form-group col-md-1">
                                <!-- <label for="image">Image Preview</label> -->
                                <div id="image-preview"></div>
                            </div>
                        </div>
                        <button class="btn btn-success" type="submit">Submit</button>
                    </form>
                </div>
            </div>

            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>

@endsection

@section('custom_js')
   <script>
       $('input[type= "file"][name="image"]').val('');
       $('input[type= "file"][name="image"]').val('').on('change',function(){
       	var img_path = $(this)[0].value;
       	var preview = $('#image-preview');
       	var extention = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
       	// alert(extention);

       	if(extention == 'jpeg' || extention == 'jpg' || extention == 'png'){
       		if(typeof(FileReader) != 'undefined'){
       			preview.empty();
       			var reader = new FileReader();

       			reader.onload = function(e){
       				$('<img/>',{'src': e.target.result, 'class':'img-fluid','style':'width:80px;height:60px; margin-top:15px;'}).appendTo(preview);
       			}
       			preview.show();
       			reader.readAsDataURL($(this)[0].files[0]);
       		}else{
       			$(preview).html('not supported');
       		}
       	}
       	else{
       		$(preview).empty();
       	}
       });
    </script>
@endsection