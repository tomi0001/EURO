@if (!isset($sizeFont) or $sizeFont == "" )
<div class="error ajax">
@else
<div class="error ajax" style="font-size: {{$sizeFont}}">
@endif
    @foreach ($message as $list)
        {{$list}} <br>
    @endforeach
</div>