@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header display-5">
                
                <h4 class="text-center m-3 shadow-sm"> {{ $user->name }}
                
                </h4>

                <h5 class=""> Posted <span class="text-primary"> {{ $user->posts->count() }} </span> {{ Str::plural( 'post' , $user->posts->count() ) }} and Received <span class="text-primary"> {{ $user->likesCount->count() }} </span> {{ Str::plural( 'like' , $user->likesCount->count() ) }} </h5>
             
                </div>

                <div class="card-body">
                    


                        <div>
                                @if($user->posts->count())
                                         
                                         @foreach($posts as $post)

                                            <div class="d-flex flex-center"> 
                                                <p class="text-primary"> {{ $user->name }} </p>  <span class="ml-3"> {{ $post->created_at->diffForHumans() }} </span>  <span class="text-primary ml-3"> <span class="text-dark"> got </span> {{ $post->likes->count() }} {{ Str::plural('like' , $post->likes->count() ) }} </span>
                                             </div>

                                             <div class="alert alert-primary"> {{ $post->body }} 
                                             @if($post->user_id == auth()->user()->id)
                                             <form action="{{ route('post.delete' , $post->id ) }}" method="post" class="float-right">
                                                @csrf
                                                @method('delete')
                                               <button type="submit" class="btn btn-outline-secondary btn-sm">delete</button>
                                               </form> 
                                            @endif
                                             </div>

                                             <hr>

                                         @endforeach

                                         <div class="pagination"> {{ $posts->links() }} </div>
                                
                                @else
                                   <p> {{ $user->name }} has not posted anything </p>
                                @endif 

                                
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection