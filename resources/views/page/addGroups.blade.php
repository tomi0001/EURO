@extends('Layout.index')

@section('content')
<div class="top2">
    
</div>
    <div class="add">
        @include ("Layout.hrefToMenu");
        <div class="title titleAddGroups" style="margin-bottom: 0;">
            DODAJ NOWĄ GRUPĘ
        </div>
        
        <div class="pageAddGroups page">
            <br>
            <table class="table" style="background-color: hsl(67, 92%, 51%,0.8); width: 80%; margin-left: auto; margin-right: auto;" >
                <form method="get" id='addGroups'>
                <tr>
                    <td class=" white" style="text-align: center; width: 50%">
                        Nazwa Grupy
                    </td>
                    <td style="text-align: center;">
                        <input type="text" class="input is-large" name='groups' placeholder="Wpisz" onkeypress="return addGroupsEnter(event,'{{ route('addGroupsSubmit')}}')">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type='button' class="button is-rounded is-large is-success" style="background-color: #DCF900; color: white; " onclick="addGroups('{{route('addGroupsSubmit')}}')"  id="loading">DODAJ</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div id="ajax">
                            
                        </div>
                    </td>
                </tr>
                </form>
            </table>
        </div>
    </div>

@endsection