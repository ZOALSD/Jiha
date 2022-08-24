@foreach (explode(",", $colors) as $item)
@php
    $i = substr($item,4);
@endphp
<div class="box" style="background-color:#{{$i}} ;color:#{{$i}}">.</div>    
@endforeach

<style>
    .box{
        width: 40px;
        height: 30;
        margin: 5px;

    }
</style>