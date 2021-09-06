@extends('Layout.index')

@section('content')
<div class="top2">
   
</div>
    <div class="add">
        @include ("Layout.hrefToMenu");
        <div class="title titleShowMatch" style="margin-bottom: 0;">
            POKAŻ MECZE
        </div>
        
        <div class="pageShowMatch page">
            <br>
            <div class='nameGroup'>
                Grupa {{App\Models\Group::selectNameGroupId($idGroup)->name}}
            </div>
            <table class="table" style="background-color: hsl(302, 84%, 42%,0.6); width: 90%; margin-left: auto; margin-right: auto;" >
                <tr>
                <th style="text-align: center; width: 43%;" class='fontTitle'>
                    Państwo
                </th>
                <th style="text-align: center; width: 44%;">
                    
                </th>
                <th style="text-align: center; width: 5%" class='fontTitle'>
                    RM
                </th>
                <th style="text-align: center; width: 5%" class='fontTitle'>
                    W
                </th>
                <th style="text-align: center; width: 5%" class='fontTitle'>
                    R
                </th>
                <th style="text-align: center; width: 5%" class='fontTitle'>
                    P
                </th>
                <th style="text-align: center; width: 5%" class='fontTitle'>
                    BZ
                </th>
                <th style="text-align: center; width: 5%" class='fontTitle'>
                    BS
                </th>
                <th style="text-align: center; width: 5%" class='fontTitle'>
                    RB
                </th>
                <th style="text-align: center; width: 5%" class='fontTitle'>
                    Ptk
                </th>
                <th>
                    
                </th>
                </tr>
                @foreach ($listCountry as $list)
                <tr>
                    <td  style="text-align: center; color: #DAD6AE;" class='font'>
                    {{App\Models\Countrie::selectNameIdMatch($list["idCountry"])->name}}
                    </td>
                    <td>
                        
                    </td>
                    <td style="text-align: center; color: #DAD6AE;" class='font'>
                            {{$list["mcz"]}}
                    </td>
                    <td style="text-align: center; color: #DAD6AE; width:27%;" class='font'>
                            {{$list["W"]}}
                    </td>
                    <td style="text-align: center; color: #DAD6AE; width: 20%;" id='Edit_' class='font'>
                            {{$list["R"]}}
                    </td>
                    <td style="text-align: center; color: #DAD6AE;" class='font'>
                            {{$list["P"]}}
                    </td>
                    <td style="text-align: center; color: #DAD6AE; width:27%;" class='font'>
                        {{$list["BZ"]}}
                    </td>
                    <td style="text-align: center; color: #DAD6AE; width: 20%;" id='Edit_' class='font'>
                            {{$list["BS"]}}
                    </td>
                    <td style="text-align: center; color: #DAD6AE;" class='font'>
                            {{$list["RB"]}}
                    </td>
                    <td style="text-align: center; color: #DAD6AE; width:27%;" class='font'>
                            {{$list["ptk"]}}
                    </td>
                    
                    
                </tr>

                @endforeach
            </table>
            <div>

                <div style="width: 30%; margin-left: auto; margin-right: auto;">

                    <div class="select is-info is-rounded">
                        <select name="groups" onchange="loadGroups('{{route('showGroups')}}')">
                            @foreach (App\Models\Group::showGroups() as $nameGroups)
                                @if ($idGroup == $nameGroups->id)
                                    <option value="{{$nameGroups->name}}" selected>Grupa {{$nameGroups->name}}</option>
                                @else 
                                    <option value="{{$nameGroups->name}}">Grupa {{$nameGroups->name}}</option>
                                @endif
                            
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>
        <div id='div'>
            
        </div>
    </div>

@endsection