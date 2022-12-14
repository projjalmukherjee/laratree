@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if(!isset($category_id))
                    {{ __('Add Category') }}
                    @else
                    {{ __('Edit Category') }}
                    @endif
                    <a href="{{ route('adminhome')}}" style="text-align: right"> Back To Home </a>
                </div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            @if(!isset($category_id))
                             <form id="addcategory" name="addcategory" method="POST" action="{{ route('save-category') }}"> 
                            @else
                             <form id="editcategory" name="editcategory" method="POST" action="{{ route('update-category',[$category_id]) }}">
                            @endif
                                @csrf
                                <div class="form-group row">
                                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control" name="title" required @if(isset($category_id)) value="{{ $category->title }}" @endif>
                                    </div>

                                    @error('title')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>  
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
        
                                    <div class="col-md-6">
                                        <select id="category" name="parent_id" class="form-select" aria-label="Default select example">
                                            <option value="0"  @if(isset($category_id) && $category_id == 0) selected @else selected @endif>As Parent</option>
                                            @foreach($allCategories as $key => $value)
                                                <option value="{{ $value->id }}" @if(isset($category_id) && $category->parent_id == $value->id) selected @endif>{{ $value->title }}</option>
                                            @endforeach
                                            
                                        </select>
        
                                    </div>
                                    
                                </div>
                                <div class="form-group">
									<button class="btn btn-success">Add New</button>
								</div>
                            
                            </form>

                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection