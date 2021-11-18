@extends('layout')

@section('content')
    @foreach($posts as $item)
            <article>
                <h1>
                    <a href="/posts/{{ $item->slug }}">
                        
                        {{ $item->title }}
                    </a>
                    
                </h1>
                <div>
                    {{ $item->excerpt }}
                </div>
                
            </article>
    @endforeach
@endsection