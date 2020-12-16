@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Post') }}</div>

                <div class="card-body">
                    
                      <form action="{{ route('post') }}" method="post">
                      @csrf
                      
 <div class=" @error('body') alert alert-danger @enderror ">
   @error('body')  {{ $message }}  @enderror
 </div>          
                              <div class="form-group">

                        <label for="comment">{{ __("What's on your mind") }}</label>

                        <textarea class="form-control" rows="5" id="comment" placeholder="write something to post" name="body"></textarea>
                             
                              </div>
                    
                  
                    <button type="submit" class="btn btn-outline-secondary">Post</button>

                      </form>

  @if($posts->count())

   @foreach($posts as $post)
              <div class="container mt-3">
                   <a href=" {{ route('users.posts' , $post->user->id ) }} " class="mr-1"> {{ $post->user->name }} </a>   <span> {{ $post->created_at->diffForHumans() }} </span>
                 
                   <p> {{ $post->body }} </p> 
                   
               <div class="d-flex flex-row">
                   @if(! $post->likedBy(auth()->user()))
                   <form action="{{ route('posts.likes' , $post->id ) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm mr-1">Like</button>
                   </form>
                   @else
                  <form action="{{ route('posts.likes' , $post->id ) }}" method="post">
                   @csrf
                   @method('delete')
                  <button type="submit" class="btn btn-light btn-sm ml-1">Unlike</button>
               </form>
               @endif

               @if( $post->user_id == auth()->user()->id )

               <form action="{{ route('post.delete' , $post->id ) }}" method="post">
                   @csrf
                   @method('delete')
                   <button type="submit" class="btn btn-light btn-sm mb-3">delete</button>
               </form>
               
               @endif

               <p class="ml-2 text-primary"> {{ $post->likes()->count() }} {{ Str::plural('Like', $post->likes()->count() ) }} </p>

               </div>    
              
              </div>
   @endforeach

   <p class="pagination"> {{ $posts->links() }} </p>

  @else

There are no posts
  @endif                    

                </div>
            </div>
        </div>
    </div>
</div>

@endsection