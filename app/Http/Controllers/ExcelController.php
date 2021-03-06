<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use App\City;
use App\District;
use App\Ward;
use Session;

class ExcelController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:admin');
    } 

    public function getImport()
    {
        $city = City::all();        
    	return view('importExcel',['city' => $city]);
    }    

    public function postImport(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $time = date('Y-m-d H:i:s');
        $validateImport = $request->location;
        $cityObj = new City();
        $districtObj = new District();
        $wardObj = new Ward();        

    	if($request->hasfile('file') && !empty($validateImport)){    		
    		$path =$request->file('file')->getRealPath();
    		$data = Excel::load($path, function($reader){})->get();    		   		     			  		
    		if(!empty($data) && $data->count()){
                $insert = array();
                if( $validateImport == 'City'){          
                    $arrData = $data->toArray()[0];
                    foreach($arrData as $value){
                        array_push($insert, ['name_city'=>$value['ten'],'code_city' =>$value['ma_tinh']]);
                    }
                    $cityObj->insert($insert);                    
                }

                elseif($validateImport == 'District'){
                    $arrData = $data->toArray()[1];                                  
                    foreach($arrData as $value){                            
                        
                    array_push($insert,['name_district'=>$value['ten'],'code_district'=>$value['ma_huyentpthi_xa'],'code_city'=>$value['ma_tinhtp']]);                
                    }
                    $districtObj->insert($insert);       
                }

                elseif($validateImport == 'Ward'){
                    $arrData = $data->toArray()[2];                    
                                        
                    foreach ($arrData as $value) {
                       array_push($insert,['name_ward'=>$value['ten'],'code_ward'=>$value['ma_xaphuongthi_tran'],'code_district'=>$value['ma_huyen']]);
                    }
                    $wardObj->insert($insert);
                }
                Session::flash('status','Successfull import ');
                return redirect()->route('import.excel');  			
    		}
    	} else{
            Session::flash('status','Error !! ');    		
    		return redirect()->route('import.excel');
    	}
    	
    }
    
}
?>
