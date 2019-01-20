@extends('layouts.app')

@section('content')






<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> User profile</div>

                <div class="card-body">




                    @if(count($errors)>0)
                    <ul class="navbar-nav mr-auto">
                            @foreach ($errors->all() as $error)
                            <li class="nav-item active">
                                     {{$error}}
                                  </li>
                            @endforeach
                            
                          </ul>
                          @endif



                          
                          <form action="{{route('users.profile.update')}}" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field()}}
    
                            <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" class="form-control-file" name="avatar">
                                  </div>
    
    
    
                            <div class="form-group">
                              <label for="name">User</label>
                              <input type="text" class="form-control" name="name"  value="{{$user->name}}">
                             </div>
                            
                             <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="text" class="form-control" name="email"  value="{{$user->email}}">
                                   </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" name="password"  value="{{$user->password}}">
                                </div>
    
                           
                           
                           @if ($user->profile)
                           <div class="form-group">
                            <label for="name">Facebook</label>
                            <input type="text" class="form-control" name="facebook"  value="{{$user->profile->facebook}}">
                            </div>


                        <div class="form-group">
                            <label for="name">Twitter</label>
                            <input type="text" class="form-control" name="twitter"  value="{{$user->profile->twitter}}">
                            </div>


                        <div class="form-group">
                            <label for="name">Github</label>
                            <input type="text" class="form-control" name="github"  value="{{$user->profile->github}}">
                            </div>


                        <div class="form-group">
                            <label for="name">About</label>
                            <textarea type="text" class="form-control" name="about"   >
                                    {{$user->profile->about}}
                            </textarea>
                            </div>
                           @else
                               

                           <div class="form-group">
                            <label for="name">Facebook</label>
                            <input type="text" class="form-control" name="facebook"   >
                            </div>


                        <div class="form-group">
                            <label for="name">Twitter</label>
                            <input type="text" class="form-control" name="twitter"  >
                            </div>


                        <div class="form-group">
                            <label for="name">Github</label>
                            <input type="text" class="form-control" name="github"  >
                            </div>


                        <div class="form-group">
                            <label for="name">About</label>
                            <textarea type="text" class="form-control" name="about"   >
                                    
                            </textarea>
                            </div>


                           @endif
                             
                        
                            <button type="submit" class="btn btn-primary">Update</button>
                          </form>  
                         
                         
                       
                              
                         
                          
                    

    
                    







                </div>
            </div>
        </div>
    </div>
</div>
@endsection
