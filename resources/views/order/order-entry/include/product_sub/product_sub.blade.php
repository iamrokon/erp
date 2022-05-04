@foreach($others as $other)
<tr  class="product_sub_name trfocus" tabindex="0"  id="{{$other->product_sub_cd ?? null}}{{$other->product_sub_name ?? null}}">
    <td>{{$other->product_sub_cd ?? null}}</td>
    <td>{{$other->product_sub_name ?? null}}</td>
</tr>
@endforeach
