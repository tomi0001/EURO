@extends('Layout.index')

@section('content')
<div class="top2">
    
</div>
    <div class="add">
        @include ("Layout.hrefToMenu");
        <div class="title titleMatch" style="margin-bottom: 0;">
            DODAJ NOWE PAŃSTWO
        </div>
        
        <div class="pageMatch page">
            <br>
            <table class="table" style="background-color: rgba(131, 146, 245,0.6); width: 90%; margin-left: auto; margin-right: auto;" >
                <form method="get" id='addMatch'>
                <tr>
                    <td class=" white" style="text-align: center; width: 50%">
                        
                        <div class="select is-info is-rounded">
                            <select name="country1">
                                <option value="">Wybierz 1 kraj</option>
                                @foreach ($listCountry as $list)
                                    <option value="{{$list->id}}">{{$list->name}}</option>

                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td class=" white" style="text-align: center; width: 50%">
                        
                        <div class="select is-info is-rounded">
                            <select name="country2">
                                <option value="">Wybierz 2 kraj</option>
                                @foreach ($listCountry as $list)
                                    <option value="{{$list->id}}">{{$list->name}}</option>

                                @endforeach
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="white" style="text-align: center; width: 50%;">
                        DATA MECZU
                    </td>
                    <td colspan="2">
                        <input type="date" class="info input is-large" name="data">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class=" white" style="text-align: center; width: 25%; padding-top: 15px;">
                        Wynik bramek
                    </td>
                </tr>
                <tr>
                    
                    <td class=" white" style="text-align: center; width: 25%; ">
                        
                        <div style="margin-left: auto; margin-right: auto; width: 60%;">
                       
                            <input type="number" class="input is-large" placeholder="opcjonalnie"  min="0" max="40" name="result1" >
                        </div>
                    </td>
                    <td class=" white" style="text-align: center; width: 25%; ">
                        
                        <div style="margin-left: auto; margin-right: auto; width: 60%;">
                       
                            <input type="number" class="input is-large" placeholder="opcjonalnie"  min="0" max="40" name="result2">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type='button' class="button is-rounded is-large is-info" onclick="addMatch('{{route('addMatchSubmit')}}')"  id="loading">DODAJ</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 150px;">
                        <div id="ajax">
                            
                        </div>
                    </td>
                </tr>
                
                </form>
            </table>
        </div>
    </div>

@endsection