<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListingBranch;
use App\Models\ListingCategory;
use App\Models\Category;
use App\Models\ListingCategoryBranch;
use App\Models\ListingSubcategory;

use App\Models\Listing;
use App\Models\HighlightListing;
use App\Models\RelatedListing;

use Carbon\Carbon;
use DB;
use Yajra\DataTables\DataTables;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $allListingCategory = ListingCategory::where('status',0)->orderBy('name')->get();
        $allListingCategory = ListingCategoryBranch::groupBy('listing_cat_id')->orderBy('created_at','desc')->get();

        $all_listing = Listing::orderBy('id','desc')->get();


        return view('admin.listings.index',compact('all_listing','allListingCategory'));
    }

    public function create()
    {
        $allListingCategory = ListingCategory::where('status',0)->orderBy('name')->get();

        $categories = Category::where('parent_id', '=', 0)->where('status',0)->get();

        $all_listing = Listing::where('status',1)->get();

        return view('admin.listings.add-new-listing',compact('allListingCategory','categories','all_listing'));
    }


    public function getCategoryBranch(Request $request){
        $allListingCategoryBranch = ListingCategoryBranch::where('listing_cat_id',$request->listingCategoryId)->get();

         if($allListingCategoryBranch ->count() > 0){
            $select_categroy_branch[] = '<option value="0">Select listing Branch</option>';

            foreach($allListingCategoryBranch as $cat){

                $select_categroy_branch[] = '<option value="'.$cat->id.'">'.ucfirst($cat->listingBranch->name).'</option>';
            }
        }else{
            $select_categroy_branch[] = '<option value="">no listing Branch</option>';
        }

        return $select_categroy_branch;
    }

    public function getSubcategory(Request $request){

        $listing_category_branch_list = ListingCategoryBranch::where('id',$request->listing_cat_branch_id)->first();

        $allListingCategoryBranch = ListingSubcategory::where('listing_cat_branchId',$request->listing_cat_branch_id)->get();

        if($allListingCategoryBranch ->count() > 0){
            $select_subcategory[] = '<option value="">Select subcategory listing</option>';

            foreach($allListingCategoryBranch as $cat){
                // if($listing_category_branch_list->listing_branch_id == 3){
                //     $name = ucfirst($cat->listingCountry->name);
                // }else if($listing_category_branch_list->listing_branch_id == 4){
                //     $name = ucfirst($cat->listingState->name);
                // }else if($listing_category_branch_list->listing_branch_id == 5){
                //     $name = ucfirst($cat->listingCity->name);
                // }else{
                //     $name = ucfirst($cat->name);
                // }

                $name = ucfirst($cat->name);

                $select_subcategory[] = '<option value="'.$cat->id.'">'.$name.'</option>';
            }

        }else{
            $select_subcategory[] = '<option value="">No subcategory listing</option>';
        }

        return $select_subcategory;


    }

    public function checkListing(Request $request){
        $input = $request->all();

        $getDataListing = Listing::where('listing_cat_id',$input['listingCategory'])->where('listing_cat_branchId',$input['listingCategoryBranch'])->where('listing_subcategoryId',$input['listingSubcategoryId'])->first();

        if(!empty($getDataListing)){
            echo 1;
        }else{
            echo 0;
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();

        $getDataListing = Listing::where('listing_cat_id',$input['listing-category'])->where('listing_cat_branchId',$input['listing-category-branch-id'])->where('listing_subcategoryId',$input['listing-subcategory-id'])->first();

        if(!empty($getDataListing)){
            return back()->with('success', "Listing added with same category")->withInput();
        }


        $listing_id = Listing::insertGetId([

            'listing_cat_id' =>  $input['listing-category']?$input['listing-category']:'',
            'listing_cat_branchId' =>  $input['listing-category-branch-id']?$input['listing-category-branch-id']:'',
            'listing_subcategoryId' =>  $input['listing-subcategory-id'],
            'name' =>  $input['listing_name'],
            // 'url' =>  $input['url'],
            'meta_title' =>  $input['metaTitle'],
            'meta_description' =>  $input['metaDescription'],
            'short_description' =>  $input['short_description'],
            'long_description' =>  $input['long_description'],
            'status' =>  $input['status']?$input['status']:0,
            "created_at"=> Carbon::now(),
            "updated_at"=> Carbon::now(),
         ]);

        foreach($input['highlight_listing'] as $hightlight){
            if($hightlight['cat_id'] != 0){

                $hightlight_listing = HighlightListing::insertGetId([
                    'listing_id' =>  $listing_id,
                    'categories_id' =>  $hightlight['cat_id'],
                    'other_name' =>  $hightlight['othername'],
                    'status' =>  $input['status'],
                    "created_at"=> Carbon::now(),
                    "updated_at"=> Carbon::now(),
                ]);
            }
        }

        foreach($input['related_listing'] as $related){
            if($related['related_listing_id'] != 0){

                $hightlight_listing = RelatedListing::insertGetId([
                    'listing_id' =>  $listing_id,
                    'related_listing_id' =>  $related['related_listing_id'],
                    'other_name' =>  $related['othername'],
                    'status' =>  $input['status'],
                    "created_at"=> Carbon::now(),
                    "updated_at"=> Carbon::now(),
                ]);
            }
        }

        return back()->with('success', "Listing created successfully!");


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;

        $allListingCategory = ListingCategory::where('status',0)->orderBy('name')->get();

        $categories = Category::where('parent_id', '=', 0)->where('status',0)->get();

        $all_listing = Listing::where('status',1)->get();

        $getListingDetail = Listing::where('id',$id)->first();

        $getHightlightListingDetail = HighlightListing::where('listing_id',$id)->first();
        $getRelatedListingDetail = RelatedListing::where('listing_id',$id)->first();

        return view('admin.listings.view-listing',compact('allListingCategory','categories','all_listing','getListingDetail'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allListingCategory = ListingCategory::where('status',0)->orderBy('name')->get();

        $categories = Category::where('parent_id', '=', 0)->where('status',0)->get();

        $all_listing = Listing::where('status',1)->get();

        $getListingDetail = Listing::where('id',$id)->first();
        $getHightlightListingDetail = HighlightListing::where('listing_id',$id)->first();
        $getRelatedListingDetail = RelatedListing::where('listing_id',$id)->first();

        $allListingCategoryBranch = ListingCategoryBranch::where('listing_cat_id',$getListingDetail->listing_cat_id)->get();

        $listing_category_branch_list = ListingCategoryBranch::where('id',$getListingDetail->listing_cat_branchId)->first();
        $allListingSubcategory = ListingSubcategory::where('listing_cat_branchId',$getListingDetail->listing_cat_branchId)->get();

        return view('admin.listings.edit-listing',compact('allListingCategory','categories','all_listing','getListingDetail','allListingCategoryBranch','allListingSubcategory','listing_category_branch_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $listing_id = Listing::find($id);
        $listing_id->listing_cat_id = $input['listing-category'];
        $listing_id->listing_cat_branchId = ($input['listing-category-branch-id'] == 0)?$input['listing-category-branch-id-edit']:$input['listing-category-branch-id'];
        $listing_id->listing_subcategoryId =($input['listing-subcategory'] == 0)?$input['listing-subcategory-edit']:$input['listing-subcategory'];
        $listing_id->name = $input['listing_name'];
        // $listing_id->url = $input['url'];
        $listing_id->meta_title =  $input['metaTitle'];
        $listing_id->meta_description = $input['metaDescription'];
        $listing_id->short_description = $input['short_description'];
        $listing_id->long_description = $input['long_description'];
        $listing_id->status =  $input['status'];
        $listing_id->updated_at = Carbon::now();


       if($listing_id->save()){
        if($listing_id->highlightListing->count() > 0){
            foreach($listing_id->highlightListing as $highlightListing){
                $getHightList = HighlightListing::find($highlightListing->id);
                $getHightList->delete();

            }
        }

        foreach($input['highlight_listing'] as $hightlight){
            if($hightlight['cat_id'] != 0){

                $hightlight_listing = HighlightListing::insertGetId([
                    'listing_id' =>  $id,
                    'categories_id' =>  $hightlight['cat_id'],
                    'other_name' =>  $hightlight['othername'],
                    'status' =>  $input['status'],
                    "created_at"=> Carbon::now(),
                    "updated_at"=> Carbon::now(),
                ]);
            }
        }

        if($listing_id->relatedListing->count() > 0){
            foreach($listing_id->relatedListing as $relatedListing){
                $getRelatedList = RelatedListing::find($relatedListing->id);
                $getRelatedList->delete();
            }
        }

        foreach($input['related_listing'] as $related){
            if($related['related_listing_id'] != 0){

                $hightlight_listing = RelatedListing::insertGetId([
                    'listing_id' =>  $id,
                    'related_listing_id' =>  $related['related_listing_id'],
                    'other_name' =>  $related['othername'],
                    'status' =>  $input['status'],
                    "created_at"=> Carbon::now(),
                    "updated_at"=> Carbon::now(),
                ]);
            }
        }


       }

        return back()->with('success', "Listing updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $listing_id = Listing::find($id);
        if($listing_id->delete())
        {
            if($listing_id->highlightListing->count() > 0){
                foreach($listing_id->highlightListing as $highlightListing){
                    $getHightList = HighlightListing::find($highlightListing->id);
                    $getHightList->delete();

                }
            }

            if($listing_id->relatedListing->count() > 0){
                foreach($listing_id->relatedListing as $relatedListing){
                    $getRelatedList = RelatedListing::find($relatedListing->id);
                    $getRelatedList->delete();
                }
            }
        }

        return back()->with('success', "Listing deleted successfully!");
    }

    public function searchByListingName(Request $request){
        $search =  $request->search;
        $status =  $request->status;
        $listing_cat_id =  $request->listing_cat_id;

        if($status == null  && $search !=null && $listing_cat_id == null){
            $all_listing = Listing::where("name", "LIKE", "%{$search}%")->orderBy('id','desc')->get();
        }elseif($status != null  && $search ==null  && $listing_cat_id == null){
            $all_listing = Listing::where('status', $status)->orderBy('id','desc')->get();
        }elseif($status == null  && $search == null  && $listing_cat_id != null){
            $all_listing = Listing::where('listing_cat_id', $listing_cat_id)->orderBy('id','desc')->get();
        }elseif($status == null  && $search != null  && $listing_cat_id != null){
            $all_listing = Listing::where("name", "LIKE", "%{$search}%")->where('listing_cat_id', $listing_cat_id)->orderBy('id','desc')->get();
        }elseif($status != null  && $search == null  && $listing_cat_id != null){
            $all_listing = Listing::where('listing_cat_id', $listing_cat_id)->where('status', $status)->orderBy('id','desc')->get();
        }elseif($status != null  && $search != null  && $listing_cat_id == null){
            $all_listing = Listing::where("name", "LIKE", "%{$search}%")->where('status', $status)->orderBy('id','desc')->get();
        }elseif($status != null  && $search != null  && $listing_cat_id != null){
            $all_listing = Listing::where("name", "LIKE", "%{$search}%")->where('listing_cat_id', $listing_cat_id)->where('status', $status)->orderBy('id','desc')->get();
        }else{
            $all_listing = Listing::get();
        }


        if($all_listing->count() > 0){
            foreach($all_listing as $row){
                if($row->status == 0){
                    $row_status = 'Unpublished';
                }else{
                    $row_status = 'Published';
                }

                $ata[]= array(
                    'id' => $row->id,
                    'listing_name' => ucfirst($row->name),
                    'listing_cat_id' => $row->listing_cat_id,
                    'listing_branch_id' => $row->listing_branch_id,
                    'listingCategory' => !empty($row->listingCategory->name) ? ucfirst($row->listingCategory->name) : 'N/A',
                    'listingBranch' => !empty($row->listingCategoryBranch->listingBranch->name) ? ucfirst($row->listingCategoryBranch->listingBranch->name) : 'N/A',
                    'listingSubcategory' => !empty($row->listingSubcategory->name) ? ucfirst($row->listingSubcategory->name) : 'N/A',
                    'status' => $row_status,
                    'company_count' => $row->companyInListing->count(),
                    'meta_title' => $row->meta_title,
                    'meta_description' => $row->meta_description,
                    'preview' =>  env('WEBSITEURL').$row->getSlugAttribute().'/',
                );
            }
            $d = $ata;
        }else{
            $d = $all_listing;
        }

        return response()->json($d);

        // return response()->json($all_listing);
        // $i=1;

        // $html['listing_count'] = $all_listing->count();

        // if($all_listing->count() > 0){
        //     foreach($all_listing as $row)
        //     {
        //         if($row->status == 0){
        //             $row_status = 'Unpublished';
        //         }else{
        //             $row_status = 'Published';
        //         }

        //         $view = "<a href='".route('listings.show',$row->id)."' type='button' class='btn ipfs-button'><i class='fa fa-eye'></i></a>";

        //         $edit = "<a href='".route('listings.edit',$row->id)."' type='button' class='btn ipfs-button'><i class='fa fa-edit'></i></a>";


        //         // '".$title."'
        //         $delete = '<button type="submit" class="btn ipfs-button" data-toggle="tooltip" data-placement="top" title="Delete Listing" onclick="return confirm(\'Are you sure want to delete this listing!\')"><i class="fa fa-trash"></i></button>' ;

        //         $preview = ' <a href="" class="btn ipfs-button" id="button1">Preview</a>';

        //         $action = '<form action="'.route('listings.destroy', $row->id).'" method="POST"><input type="hidden" name="_token" value="'.csrf_token().'" /><input type="hidden" name="_method" value="DELETE">
        //         '.$view.' '.$edit.' '.$delete.' '.$preview.'</form>';


        //         $listingCategory = !empty($listing->listingCategory->name) ? ucfirst($listing->listingCategory->name) : 'N/A';
        //         $listingCategoryBranch =  !empty($row->listingCategoryBranch->listingBranch->name) ? ucfirst($row->listingCategoryBranch->listingBranch->name) : 'N/A';
        //         $listing_subcategory = !empty($row->listingSubcategory->name) ? ucfirst($row->listingSubcategory->name) : 'N/A' ;

                

        //         $index_data = '<div class="form-check1"><input class="form-check-input listing-selected-Id table-td-list-SelectAll" type="checkbox" value="'.$row->id.'"  name="listing_id[]" onclick="checkBox();"></div>';

        //         $search_data[] =
        //               '<tr>
        //                  <td>' . $index_data . '</td>' .
        //                  '<td><label class="form-check-label">'.$i++ .'.</td>' .
        //                  '<td>' . ucfirst($row->name) . '</td>' .
        //                  '<td>' . $listingCategory . '</td>' .
        //                  '<td>' . $listingCategoryBranch . '</td>' .
        //                  '<td>' . $listing_subcategory . '</td>' .
        //                  '<td>' . $row_status . '</td>' .
        //                  '<td>'.$row->companyInListing->count().'</td>' .
        //                  '<td>' . $row->meta_title . '</td>' .
        //                  '<td>' . $row->meta_description . '</td>' .
        //                  '<td>'.$action.'</td>' .
        //               '</tr>';

        //     }
        // }else{
        //     $search_data[] =
        //               '<tr class="no-data-row"> <td colspan="8" rowspan="2" align="center"><div class="message"><p>No data available in table</p></div></td></tr>';
        // }

        // $html['search_data'] = $search_data;

        // return $html;
    }

    public function changeListingStatus(Request $request){
        // return $request->all();

        $input = $request->all();

        foreach($input['listing_id'] as $listingId){
            $listing_id = Listing::find($listingId);
            $listing_id->status = $input['listing_status'];
            $listing_id->save();
        }

        echo 1;
    }

    public function getListingCompany(Request $request){
        $id = $request->id;

        $getListingDetail = Listing::where('id',$id)->first();
        return view('admin.listings.ajax-listing-company-pages', compact('getListingDetail'));
    }

}
