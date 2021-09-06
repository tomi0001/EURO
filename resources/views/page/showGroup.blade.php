@extends('Layout.index')

@section('content')
<div class="top2">
   
</div>
    <div class="add">
        @include ("Layout.hrefToMenu");
        <div class="title titleSettingGroup" style="margin-bottom: 0;">
            POKAŻ MECZE
        </div>
        
        <div class="pageSettingGroup page">
            <br>
            <table class="table" style="background-color: hsl(184, 18%, 57%,0.6); width: 100%; margin-left: auto; margin-right: auto;" >
                <tr>
                <th style="text-align: center; " class='fontTitle'>
                    Nazwa Grupy
                </th>
                <th style="text-align: center; " class='fontTitle'>
                    Państwo 1
                </th>
                <th style="text-align: center; " class='fontTitle'>
                    Państwo 2 
                </th>
                <th style="text-align: center; " class='fontTitle'>
                    Państwo 3
                </th>
                <th style="text-align: center; " class='fontTitle'>
                    Państwo 4
                </th>
                <th style="text-align: center; " class='fontTitle'>
                    Państwo 5
                </th>
                <th style="text-align: center; " class='fontTitle'>
                    Państwo 6
                </th>

                <th>
                    
                </th>
                </tr>
                @foreach ($listGroup as $list)
                <tr>
                    <td  style="text-align: center; color: #DAD6AE;" class='Group{{$loop->iteration}}'>
                        Grupa {{$list->name}}
                    </td>
                    @php
                        $i = 1;
                    @endphp
                    @foreach (App\Models\Group::selectCountry($list->name) as $list2 )  

                      @if ($loop->iteration == 7) 
                        @break;
                      @endif
                     <td style="text-align: center; " id="{{   $i . "_" . $list->name}}" class='fontCountry' onclick="selectCountry('{{$list->name}}',{{$i}})">{{$list2->name}}</td>
                        @php
                        $i++;
                        @endphp
                    @endforeach
                    
                    
                    @for ($j=$i;$j < 7;$j++)
                    

                        <td style="text-align: center;" class='fontCountry' id="{{  $j . "_" . $list->name}}" onclick="selectCountry('{{$list->name}}',{{$j}})"></td>
                    
                    @endfor
                    <td>
                        <div class="select">
                            <select name="country_{{$list->name}}"  onchange="addCountryToGroup('{{$list->name}}',{{$i}})">
                                <option value="" selected>Dodaj państwo</option>
                                @foreach ($listCountry as $list3)
                                <option value="{{$list3->name}}">{{$list3->name}}</option>


                                @endforeach
                            </select>
                        </div>
                    </td>
                </tr>

                @endforeach
            </table>
            <div>
                <button type='button' class="button is-rounded is-large is-info" onclick="updateGroups('{{route('updateGroups')}}')"  id="update" disabled>UAKTUALNIJ</button>
                
            </div>
        </div>
        <div id='div'>
            
        </div>
    </div>

@endsection