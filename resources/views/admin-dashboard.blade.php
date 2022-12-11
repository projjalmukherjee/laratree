@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Category') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                     <div>
                        <a href="{{ route('add-category')}}">Add Category </a>
                        <a href="{{ route('category-list')}}">Category List</a>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                            <h3>Category Tree</h3>
                          <ul id="tree1">
                              @foreach($categories as $category)
                                  <li>
                                      {{ $category->title }}
                                      @if(count($category->childs))
                                          @include('managechild',['childs' => $category->childs])
                                      @endif
                                  </li>
                              @endforeach
                          </ul>
                        </div>
                     </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection