<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Json;

class UserController extends Controller
{
    public function index(Request $request){

        $limit = $request->get("limit") ? $request->get("limit") : 10;
        $page = $request->get("page") ? $request->get("page") : 1 ;
        $total = DB::select("SELECT COUNT(*) as count FROM users");

        $datas = DB::table('users')
        ->limit( $limit )
        ->offset( ( $page - 1 ) * $limit )
        ->orderBy("id")
        ->get();
        return view( "User" )->with(["datas"=>$datas])->with( [ "total" => $total[0]->count ] );
    }

    public function createUser( Request $request ){

        $request->validate([
            "firstname"=>"required|min:2",
            "lastname"=>"required|min:2",
            "date_of_birth"=>"required|min:2",
            "place_of_birth"=>"required|min:2",
            "email"=>"required|email",
        ]);

        try{
            DB::table("users")
                ->insert([
                    "firstname"=>$request->input("firstname"),
                    "lastname"=>$request->input("lastname"),
                    "email"=>$request->input("email"),
                    "date_of_birth"=>$request->input("date_of_birth"),
                    "place_of_birth"=>$request->input("place_of_birth"),
                    "created_at"=> new DateTime(),
                    "updated_at"=> new DateTime(),
                ]);
                return redirect("/?message=Added Successfully!");
        }
        catch(Exception $ex){
                return redirect("/?message=Added failed!");
        }
    }

    public function UpdateUserPage( Request $request , $id ){
        $datas = [];
        $dts = DB::select("SELECT * FROM users WHERE id = ".$id);
        if( count($dts) > 0 ){ 
            $datas = $dts;
        }else{
            $datas = [];
        }
        return view("Update")->with(["datas"=> $datas ]);
    }

    public function UpdateUser( Request $request, $id ){
        $request->validate([
            "firstname"=>"required|min:2",
            "lastname"=>"required|min:2",
            "date_of_birth"=>"required|min:2",
            "place_of_birth"=>"required|min:2",
            "email"=>"required|email",
        ]);

        try{
            DB::table("users")
                ->where("id", "=", $id)
                ->update([
                    "firstname"=>$request->input("firstname"),
                    "lastname"=>$request->input("lastname"),
                    "email"=>$request->input("email"),
                    "date_of_birth"=>$request->input("date_of_birth"),
                    "place_of_birth"=>$request->input("place_of_birth"),
                    "updated_at"=> new DateTime(),
                ]);
            return redirect("/update/".$id."?message=Updated successfully!");
        }
        catch( Exception $ex ){
            return redirect("/update/".$id."?message=Updated failed!");
        }

    }

    public function DeleteUser( Request $request , $id ){
        try{
            $data = DB::table('users')->where("id", $id)->get();
            if( count($data) > 0 ){
                DB::table("users")
                    ->where( "id", $id )
                    ->delete();
                return response()->json([
                    "message"=>"Deleted successfully."
                ]);
            }else{
                return response()->json(
                    [
                        "message"=>"Please select other id."
                    ],
                    404
                );
            }
        }
        catch(Exception $ex){
            return response()->json(
                [
                    "message"=>"Please select other id.",
                    "error"=>$ex
                ],
                400
            );
        }
    }

}
