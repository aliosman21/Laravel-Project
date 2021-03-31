@if($avatar_img == null)
<img src='{{ asset("img/defaultImg.jpg") }}' alt = "{{ $avatar_img }}" style="width:50px; height:50px ;border-radius: 50%;"/>
@else


<img src='{{ asset("img/$avatar_img") }}' alt = "{{ $avatar_img }}" style="width:50px; height:50px ;border-radius: 50%;"/>
@endif