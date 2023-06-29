<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frameworks;
use Carbon\Carbon;

class FrameworkController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allFramework = Frameworks::orderBy('created_at','desc')->get();

        return view('admin.framework.index')->with([
            'allFramework'  => $allFramework,
            // 'allcategories'  => $allcategories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.framework.add');
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->name as $k=>$v){
            $data[] = array(
                'name' =>   $v,
                "created_at"=> Carbon::now(),
                "updated_at"=> Carbon::now(),
            );
        }

        Frameworks::insert($data);

        return back()->with('success', 'You have successfully added Frameworks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();

        $frameworks = Frameworks::find($input['id']);
        $frameworks->name = $input['name'];
        $frameworks->save();

        return back()->with('success', 'Framework updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $frameworks = Frameworks::find($id);
        $frameworks->delete();
        return back()->with('success', "Framework deleted successfully!");
    }
    
    public function status(Request $request)
    {   
        $frameworks = Frameworks::find($request->id);
        $frameworks->status = $request->status;
        if($frameworks->save())
        {
            echo "1";
        }else{
            echo "0";
        }
    }

    public function changeFrameworkStatus(Request $request){

        $input = $request->all();

       foreach($input['framework_Id'] as $framework_Id){

            $frameworks = Frameworks::find($framework_Id);
            $frameworks->status = $input['status'];
            $frameworks->save(); 
        }
        echo 1;
    }

    public function getFilterFramework(Request $request){
        // dd($request->all());

        $search =  $request->searchKeyword;
        $check_status =  $request->check_status;

        if($check_status == null  && $search !=null){
            $allFrameworks = Frameworks::where("name", "LIKE", "%{$search}%")->orderBy('id','desc')->get();
        }elseif($check_status != null  && $search ==null){
            $allFrameworks = Frameworks::where('status', $check_status)->get();
        }elseif($check_status != null  && $search != null){
            $allFrameworks = Frameworks::where("name", "LIKE", "%{$search}%")->where('status', $check_status)->get();
        }
        else{
            $allFrameworks = Frameworks::get();
        }

        return response()->json($allFrameworks);

        // $i=1;

        // $html['framework_count'] = $allFrameworks->count();

        // if($allFrameworks->count() > 0){
        //     foreach($allFrameworks as $p){
        //         if($p->status == 0){
        //             $status = '<button title="Status " class="btn ipfs-button" value="'.$p.'" onclick="change_status(\''.$p->id.'\',\'Deactive\',\'1\')"> Active</button>';
        //         }else{
        //             $status = '<button title="Status " class="btn ipfs-danger" value="'.$p.'" onclick="change_status(\''.$p->id.'\',\'Active\',\'0\')"> Deactive</button>';
        //         }

        //         $edit = '<button type="button" class="btn ipfs-button edit-framework"
        //             data-id="'.$p->id.'"
        //             data-name="'.ucfirst($p->name).'">
        //             <i class="fa fa-edit"></i>
        //         </button>';

        //         $delete = '<button type="submit" class="btn ipfs-button" data-toggle="tooltip" data-placement="top" title="Delete programming language" onclick="return confirm(\'Are you sure want to delete this programming language!\')"><i class="fa fa-trash"></i></button>' ; 

        //         $action = '<form action="'.route('programming_language.destroy', $p->id).'" method="POST"><input type="hidden" name="_token" value="'.csrf_token().'" /><input type="hidden" name="_method" value="DELETE">
        //         '.$edit.' '.$delete.'</form>';

        //         $index_data = '<div class="form-check1"><input class="form-check-input programmingLang-selected-Id table-td-list-SelectAll" type="checkbox" value="'.$p->id.'" name="p_id[]" onclick="checkBox();"></div>';

        //         $search_data[] =
        //               '<tr>
        //                  <td>' . $index_data. '</td>' .
        //                  '<td><label class="form-check-label">'.$i++ .'.</td>' .
        //                  '<td>' . ucfirst($p->name) . '</td>' .
        //                  '<td>'. $status.'</td>' .
        //                  '<td>'.$action.'</td>' .
        //               '</tr>';
        //     }
        // }else{
        //     $search_data[] =
        //               '<tr class="no-data-row"> <td colspan="5" rowspan="2" align="center"><div class="message"><p>No data available in table</p></div></td></tr>';
        // }

        // $html['search_data'] = $search_data;
     
        // return $html;
    }
}
