@extends('layouts.app')

@section('content')






<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categories</div>

                <div class="card-body">
 


                        <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col"> No </th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                            <th scope="row">{{$category->name}}</th>
                                            <td> 
                                                <a class="" href="{{route('category.edit',['id' =>$category->id ])}}">
                                                        <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td> 
                                            <a class="" href="{{route('category.delete',['id' =>$category->id ])}}">
                                                    <i class="far fa-trash-alt"></i>
                                            </a>
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
@endsection
