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
                            <h3>Category List</h3>
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Parent Name</th>
                                    <th scope="col" colspan="2">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($allCategories as $category)  
                                  <tr>
                                    <td>{{ $category->title }}</td>
                                    <td> @if($category->parent_id != 0) {{ $category->parent->title }}  @endif</td>
                                    <td>
                                        <a href="{{ route('edit-category',[$category->id]) }}" class="btn btn-primary" role="button" aria-pressed="true">Edit</a>
                                    </td>
                                    <td>
                                       {{--  <a href="#" class="btn btn-primary" role="button" aria-pressed="true">Delete</a> --}} 
                                        <form action="{{ route('delete-category',[$category->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                  </tr>
                                     @endforeach
                                </tbody>
                            </table>
                        </div>
                     </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection