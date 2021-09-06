<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Countrie as Country;
use App\Models\Match as Match;
use App\Models\Group as Group;
use App\Models\Group_forwarding as group_forwardings;
use Illuminate\Http\Request;
class MainController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $errors = [];
    private $idGroup = "";
    private $sumGoals = [];
    public function index() {
        return View("page.menu");
        
    }
    public function addCountry() {
        return View("page.addCountry");
    }
    public function settingGroups() {
        $listGroup = Group::showGroups();
        $listContry = Country::selectListCountry();
        return View("page.showGroup")->with("listGroup",$listGroup)->with("listCountry",$listContry);
    }
    public function addCountrySubmit(Request $request) {
        
        if ($request->get("country") == "") {
            return View("ajax.error")->with("message",["Uzupełnij pole nazwa"]);
        }
        $check = Country::selectCountry($request->get("country"));
        if (!empty($check->name )) {
            return View("ajax.error")->with("message",["Jest już państwo o takiej nazwie"])
                    ->with("sizeFont","18px");       
        }
        else  {
             $this->addCountryMysql($request->get("country"));
            return View("ajax.succes")->with("message","Pomyslnie dodano");
        }
    }
    private function addCountryMysql(string $name) {
        $Country =  new Country;
        $Country->name = $name;
        $Country->save();
    }
    public function addMatch(Request $request) {
        $listContry = Country::selectListCountry();
        return View("page.addMatch")->with("listCountry",$listContry);
    }
    public function addMatchSubmit(Request $request) {
        $this->checkErrors($request);
        if (count($this->errors) != 0 ) {
            return View("ajax.error")->with("message",$this->errors);
        }
        else {
            $this->saveMatch($request);
            return View("ajax.succes")->with("message","Pomyslnie dodano");
        }
    }
    private function saveMatch(Request $request) {
        $Match = new Match;
        $Match->country_one = $request->get("country1");
        $Match->country_two = $request->get("country2");
        $Match->date = $request->get("data");
        if ($request->get("result1") != "" and $request->get("result2") != "") {
            $Match->result_one = $request->get("result1");
            $Match->result_two = $request->get("result2");
        }
        $Match->save();
    }
    private function checkErrors(Request $request) {
        if ($request->get("country1") == "") {
            array_push($this->errors,"Uzupełnij pierwsze państwo");
        }
        if ($request->get("country2") == "") {
            array_push($this->errors,"Uzupełnij drugie państwo");
        }
        if ($request->get("data") == "") {
            array_push($this->errors,"Uzupełnij date");
        }
        if ($request->get("result1") != "" xor $request->get("result2") != "") {
           
            if ($request->get("result1") == "") {
                array_push($this->errors,"Uzupełnij 1 wynik");
            }
            if ($request->get("result2") == "") {
                array_push($this->errors,"Uzupełnij 2 wynik");
            }
        }
    }
    public function showMatch(Request $request) {
        if ($request->get("nameCountry") == "") {
            $listMatch = Match::selectListMatch();
        }
        else {
            $listMatch = Match::selectListMatchWhere($request->get("nameCountry"));
        }
        return View("page.showMatch")->with("listMatch",$listMatch);
    }
    
    public function updateMatch(Request $request) {
        $Match = new Match;
        $Match->where("id",$request->get("id"))->update(["result_one" => $request->get("value1"),"result_two" => $request->get("value2")]);
        
    }
    public function addGroups(Request $request) {
        return View("page.addGroups");
    }
    public function addGroupsSubmit(Request $request) {
        if ($request->get("groups") == "") {
            return View("ajax.error")->with("message",["Uzupełnij pole nazwa"]);
        }
        $check = Group::selectGroup($request->get("groups"));

        if (strlen($request->get("groups")) > 1) {
            return View("ajax.error")->with("message",["maksymalna liczba znaków to 1"])
                    ->with("sizeFont","19px");
        }
        else if (!empty($check->name )) {
            return View("ajax.error")->with("message",["Jest już Grupa o takiej nazwie"])
                    ->with("sizeFont","18px");
        }
        else  {
             $this->addGroupsMysql($request->get("groups"));
            return View("ajax.succes")->with("message","Pomyslnie dodano");
        }
    }
    private function addGroupsMysql(string $name) {
        $Group =  new Group;
        $Group->name = strtoupper($name);
        $Group->save();
    }
    
    
    public function updateGroups(Request $request) {
        var_dump(json_decode($request->get("array")));
        $this->updateGroupsMysql(json_decode($request->get("array")));
        
    }
    private function updateGroupsMysql( $array) {
        $Groups = new Group;
        $Country = new Country;
        for ($i=0;$i < count($array);$i++) {
            $substring = explode("_",$array[$i]);
            $CountryString = str_replace("*", " ", $substring[0]);
            $idGroups = $Groups->selectRaw("id as id")->where("name",$substring[1])->first();
            $idCountry = $Country->selectRaw("id as id")->where("name",$CountryString)->first();
            
            if (count($substring) != 3) {
                $group_forwardings = new group_forwardings;
                $group_forwardings->group_id = $idGroups->id;
                $group_forwardings->country_id = $idCountry->id;
                $group_forwardings->save();
            }
            else {
                $group_forwardings = new group_forwardings;
                $group_forwardings->where("group_id",$idGroups->id)->where("country_id",$idCountry->id)->delete();
            }

            
             
             
            
        }
    }
    
    public function showGroups($nameGroups = "") {
        $this->selectGroup($nameGroups);
        $listCountry = group_forwardings::showGroupsOne($this->idGroup->id);
        
        $array = $this->sumMatch($listCountry);
        array_multisort(array_column( $array, 'ptk' ), SORT_DESC, $array);
        return View("page.showGroups2")->with("listCountry",($array))->with("idGroup",$this->idGroup->id);
        
    }
    private function sumMatch( $listCountry) {
        $listGoal = [];
        $listGoalTwo = [];
        $i = 0;
        foreach ($listCountry as $list) {
            $Match = new Match;
            $listArray = $Match->where("country_one",$list->country_id)->where("result_one","!=",NULL)->get();
            $licz = 0;
            foreach ($listArray as $list2) {
                $listGoal[$list->country_id]["idCountry"] = $list->country_id;
                if (empty($listGoal[$list->country_id]["mcz"]) and $licz == 0) {
                    $listGoal[$list->country_id]["ptk"] = 0;
                    $listGoal[$list->country_id]["mcz"] = 0;
                    $listGoal[$list->country_id]["W"] = 0;
                    $listGoal[$list->country_id]["P"] = 0;
                    $listGoal[$list->country_id]["R"] = 0;
                    $listGoal[$list->country_id]["BS"] = 0;
                    $listGoal[$list->country_id]["BZ"] = 0;
                    $listGoal[$list->country_id]["RB"] = 0;
                }
                $listGoal[$list->country_id]["mcz"]++;
                if (($list2->result_one - $list2->result_two) > 0) {
                    $listGoal[$list->country_id]["ptk"] += 3;
                    $listGoal[$list->country_id]["W"]++;
                    
                }
                elseif (($list2->result_one - $list2->result_two) == 0 ) {
                    $listGoal[$list->country_id]["ptk"] += 1;
                    $listGoal[$list->country_id]["R"]++;
                }
                else {
                    $listGoal[$list->country_id]["P"]++;
                }
                $listGoal[$list->country_id]["BZ"] += $list2->result_one;
                $listGoal[$list->country_id]["BS"] += $list2->result_two;
                
                $licz++;
            }
            $Match = new Match;
            $listArray2 = $Match->where("country_two",$list->country_id)->where("result_one","!=",NULL)->get();
            //$licz = 0;
            foreach ($listArray2 as $list3) {
                $listGoal[$list->country_id]["idCountry"] = $list->country_id;
                if (empty($listGoal[$list->country_id]["mcz"]) and $licz == 0) {
                    $listGoal[$list->country_id]["ptk"] = 0;
                    $listGoal[$list->country_id]["mcz"] = 0;
                    $listGoal[$list->country_id]["W"] = 0;
                    $listGoal[$list->country_id]["P"] = 0;
                    $listGoal[$list->country_id]["R"] = 0;
                    $listGoal[$list->country_id]["BS"] = 0;
                    $listGoal[$list->country_id]["BZ"] = 0;
                    $listGoal[$list->country_id]["RB"] = 0;                    
                }
                $listGoal[$list->country_id]["mcz"]++;
                if (($list3->result_two - $list3->result_one) > 0) {
                    $listGoal[$list->country_id]["ptk"] += 3;
                    $listGoal[$list->country_id]["W"]++;                   
                }
                elseif (($list3->result_one - $list3->result_two) == 0 ) {
                    $listGoal[$list->country_id]["ptk"] += 1;
                    $listGoal[$list->country_id]["R"]++;
                }
                else {
                    $listGoal[$list->country_id]["P"]++;
                }
                $listGoal[$list->country_id]["BZ"] += $list3->result_two;
                $listGoal[$list->country_id]["BS"] += $list3->result_one;
                $licz++;
            }
            $listGoal[$list->country_id]["RB"] = $listGoal[$list->country_id]["BZ"] - $listGoal[$list->country_id]["BS"];
            $i++;
        }
        return $listGoal;
    }
    private function showGroupsOne(int $id) {
        
    }
    private function selectGroup($nameGroups) {
        if ($nameGroups == "") {
            $this->idGroup = Group::returnIdGroup();
        }
        else {
            $this->idGroup = Group::returnIdGroup($nameGroups);
        }
        
    }
}
