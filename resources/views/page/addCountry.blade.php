@extends('Layout.index')

@section('content')
<div class="top2">
    
</div>
    <div class="add">
        @include ("Layout.hrefToMenu");
        <div class="title titleCountry" style="margin-bottom: 0;">
            DODAJ NOWE PAŃSTWO
        </div>
        
        <div class="pageCountry page">
            <br>
            <table class="table" style="background-color: rgba(0, 255, 0, 0.6); width: 80%; margin-left: auto; margin-right: auto;" >
                <form method="get" id='addCountry'>
                <tr>
                    <td class=" white" style="text-align: center; width: 50%">
                        Nazwa kraju
                    </td>
                    <td style="text-align: center;">
                        <input type="text" class="input is-large" name='country' placeholder="Wpisz" onkeypress="return addCountryEnter(event,'{{ route('addCountrySubmit')}}')">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type='button' class="button is-rounded is-large is-success" onclick="addCountry('{{route('addCountrySubmit')}}')"  id="loading">DODAJ</button>
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