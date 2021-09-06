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
            <form action="{{ url('showMatch')}}" method="get">
                <div>
                <span style="font-size: 28px; padding-top: 5px; padding-right: 16px; display: inline-block; color: white;">Szukaj państwa </span>
                <input type="text" name="nameCountry" class="input is-large" style="width: 20%;">
                <input type='submit' class="button is-rounded is-large is-primary" id="loading" value="SZUKAJ">
                </div>
            </form>
                
            <br>
            <table class="table" style="background-color: hsl(302, 84%, 42%,0.6); width: 90%; margin-left: auto; margin-right: auto;" >
                <tr>
                <th style="text-align: center; " class='fontTitle'>
                    Państwo 1
                </th>
                <th style="text-align: center; " class='fontTitle'>
                    Wynik
                </th>
                <th style="text-align: center; " class='fontTitle'>
                    Państwo 2 
                </th>
                <th style="text-align: center; " class='fontTitle'>
                    Data
                </th>
                <th style="text-align: center; " class='fontTitle'>
                    Data Rozegrania PES
                </th>
                <th>
                    
                </th>
                </tr>
                @foreach ($listMatch as $list)
                <tr>
                    <td  style="text-align: center; color: #DAD6AE;" class='font'>
                    {{App\Models\Countrie::selectNameIdMatch($list->country_one)->name}}
                    </td>
                    <td style="text-align: center; color: #DAD6AE; width: 20%;" id='Match_{{$list->id}}' class='font'>
                        @if ($list->result_one === null and ($list->result_one !== 0 and $list->result_two !== 0))
                        <span class="error">Nie rozegrano</span>
                        @else
                        {{$list->result_one}} : {{$list->result_two}}
                        @endif
                    </td>
                    <td style="text-align: center; color: #DAD6AE;" class='font'>
                    {{App\Models\Countrie::selectNameIdMatch($list->country_two)->name}}<br>
                    </td>
                    <td style="text-align: center; color: #DAD6AE; width:27%;" class='font'>
                    {{$list->date}}
                    </td>
                    <td style="text-align: center; color: #DAD6AE; width:20%;" class='font'>
                    @if ($list->result_one === null and ($list->result_one !== 0 and $list->result_two !== 0))
                        <span class="error">Nie rozegrano</span>
                    @else
                        {{$list->updated_at}}
                    @endif
                    </td>
                    <td style="text-align: center; color: #DAD6AE; width: 20%;" id='Edit_{{$list->id}}' class='font'>
                        @if ($list->result_one === null and ($list->result_one !== 0 and $list->result_two !== 0))
                            <a onclick="editMatch({{$list->id}},'{{ route('updateMatch')}}')" class="link">Edytuj</a>
                        @endif
                    </td>
                </tr>

                @endforeach
            </table>
            <div class='paginateAll'>
                <div class='leftPaginate'>
                    &nbsp;
                </div>
                <div class='paginate'>
                {{$listMatch->appends(['nameCountry'=>Request::get('nameCountry')])
                ->links("pagination::bootstrap-4")}}
                

                </div>
            </div>
        </div>
        <div id='div'>
            
        </div>
    </div>

@endsection