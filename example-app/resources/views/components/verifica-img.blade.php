@props(['href', 'class', 'img', 'storage', 'id', 'alt', 'width', 'height'])
@if (isset($img->imagem) && $img->imagem != 'default_banner.jpeg')
    <img src="{{ url('storage/'.$storage.'/' . $img->imagem) }}" href="{{ $href ?? '' }}" {{ $attributes->merge(['class' => "$class"]) }}   id="{{ $id ?? '' }}" alt="{{ $alt ?? '' }}" width='{{ $width ?? '' }}' height='{{ $height ?? '' }}'>
@else
    <img src="{{ asset('img_produtos_users/default_produto.png') }}" href="{{ $href ?? '' }}"
        class="{{ $class }}" id="{{ $id ?? '' }}"  alt="{{ $alt ?? '' }}" width='{{ $width ?? '' }}' height='{{ $height ?? '' }}'>
@endif
