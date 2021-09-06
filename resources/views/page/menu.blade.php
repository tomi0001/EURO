@extends('Layout.index')

@section('content')

    <div class="top">
        
    </div>

    <div class="menu">
        <div class="left">
            &nbsp;
        </div>
        <div class="columns is-multiline">

            <div class="column is-4 is-4-fullhd is-4-desktop is-10-tablet is-10-mobile" >
                <a href="{{ route('addCountry')}}" onmouseover="menu('country')" onmouseout="menu2('country')"><p class="bd-notification is-green color-blue" id="country">DODAJ NOWE PAŃSTWO</p></a>
            </div>
            <div class="column is-4 is-4-fullhd is-4-desktop is-10-tablet is-10-mobile" >
                <a href="{{ route('addMatch')}}" onmouseover="menu('match')" onmouseout="menu2('match')"><p class="bd-notification is-blue color-blue" id="match">DODAJ NOWY MECZ</p></a>
            </div>
            <div class="column is-4 is-4-fullhd is-4-desktop is-10-tablet is-10-mobile" >
                <a href="{{ route('showGroups')}}" onmouseover="menu('groups')" onmouseout="menu2('groups')"><p class="bd-notification is-darkGreen color-blue" id="groups">POKAŻ GRUPY</p></a>
            </div>
            <div class="column is-4 is-4-fullhd is-4-desktop is-10-tablet is-10-mobile" >
                <a href="{{ route('showMatch')}}" onmouseover="menu('showMatch')" onmouseout="menu2('showMatch')"><p class="bd-notification is-purple color-blue" id="showMatch">POKAŻ MECZE</p></a>
            </div>            
            <div class="column is-4 is-4-fullhd is-4-desktop is-10-tablet is-10-mobile" >
                <a href="{{ route('addGroups')}}" onmouseover="menu('addGroups')" onmouseout="menu2('addGroups')"><p class="bd-notification is-yellow color-blue" id="addGroups">DODAJ GRUPĘ</p></a>
            </div>   
            <div class="column is-4 is-4-fullhd is-4-desktop is-10-tablet is-10-mobile" >
                <a href="{{ route('settingGroups')}}" onmouseover="menu('settingGroups')" onmouseout="menu2('settingGroups')"><p class="bd-notification is-gray color-blue" id="settingGroups">USTAWIENIA GRUPY</p></a>
            </div> 
        </div>

    </div>
@endsection