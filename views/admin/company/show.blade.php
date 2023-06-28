@extends('admin.layouts.layout')
@section('content')
<style>
.fa-fa-icon {
    width: 16px;
    text-align: center;
    margin-right: 5px;
    float: right;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Company Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('companies.index') }}" class="btn ipfs-button"><i
                                class="fa fa-arrow-left"></i>
                            Back</a>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
      
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center profile-user-div">
                                <a href="{{ $companyInfo->company_logo }}" target="_blank">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ $companyInfo->company_logo }}" alt="company logo">
                                    <input type="hidden" name="user_id" id="id_data" value="{{ $companyInfo->id }}">
                                </a>
                            </div>

                            <h3 class="profile-username text-center">
                                {{ !$companyInfo->company_name ? 'Company' : $companyInfo->company_name }}</h3>
                            <p class="text-muted text-center">{{ $companyInfo->company_email }}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                {{-- <li class="list-group-item">
                                <b>Company Name</b> <a class="float-right text-dark">{{ (!$companyInfo->company_name) ? "Company" :$companyInfo->company_name; }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Company Email</b> <a
                                        class="float-right text-dark">{{ $companyInfo->company_email }}</a>
                                </li> --}}
                                 <li class="list-group-item">
                                    <b>Register Date</b> <a
                                        class="float-right text-dark">{{date('M d, Y', strtotime($companyInfo->created_at))}}</a>
                                        
                                </li>
                                <li class="list-group-item">
                                    <b>Company Status</b> 
                                    <a class="float-right text-dark">
                                        @if($companyInfo->company_status == 'registered')
                                            @php $status = ipfs-primary;  @endphp
                                        @elseif($companyInfo->company_status == 'pending') 
                                            @php $status = 'ipfs-info';  @endphp
                                        @elseif($companyInfo->company_status == 'verified') 
                                            @php $status = 'ipfs-button'; @endphp
                                        @elseif($companyInfo->company_status == 'updated')
                                            @php $status = 'ipfs-success';  @endphp
                                            @elseif($companyInfo->company_status == 'blocked')
                                            @php $status = 'ipfs-danger';  @endphp
                                        @else
                                            @php $status = 'ipfs-warning'; @endphp
                                        @endif
                                        <span class="btn {{$status}}">{{ ucfirst($companyInfo->company_status) }}</span>
                                    </a>
                                </li>

                                <li class="list-group-item">
                                    <b>Listing Status</b> 
                                    <a class="float-right text-dark">
                                        @if ($companyInfo->listing_status == 'listed')
                                            <span class="btn ipfs-success">Listed</span>
                                        @else
                                            <span class="btn ipfs-danger">Unlisted</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Rating</b>
                                    @php $stars_count = $companyInfo->rating; @endphp

                                    <div class="float-right">
                                         @foreach(range(1,5) as $i)
                                        <span class="fa-stack" style="width:1em">
                                            <i class="far fa-star fa-stack-1x"></i>

                                            @if($stars_count >0)
                                                @if($stars_count >0.5)
                                                    <i class="fas fa-star fa-stack-1x" style="color:orange"></i>
                                                @else
                                                    <i class="fas fa-star-half fa-stack-1x" style="color:orange"></i>
                                                @endif
                                            @endif
                                            @php $stars_count--; @endphp
                                        </span>
                                        @endforeach
                                    </div>


                                </li>


                            </ul>

                        </div>

                    </div>



                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#companyDetails"
                                        data-toggle="tab">Company Details</a></li>
                                <li class="nav-item"><a class="nav-link" href="#location" data-toggle="tab">Location</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#listings" data-toggle="tab">Listings</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#serviceFocus" data-toggle="tab">Services
                                        focus</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#majorClient" data-toggle="tab">Major
                                        clients</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="companyDetails">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Company Status</label>
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ $companyInfo->company_status }}" disabled />
                                            </div>

                                            <div class="form-group">
                                                <label>Listing Status</label>
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ $companyInfo->listing_status }}" disabled />
                                            </div>
                                            <div class="form-group">
                                                <label>Employees Size</label>
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ !empty($companyInfo->employees_size->numbers) ? $companyInfo->employees_size->numbers : 'N/A' }}"
                                                    disabled />
                                            </div>
                                            <div class="form-group">
                                                <label>Client Focus</label>
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ !empty($companyInfo->client_focus->name)?$companyInfo->client_focus->name:'N/A' }}"
                                                    disabled />
                                            </div>
                                            <div class="form-group">
                                                <label>Year of foundation</label>
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ !empty($companyInfo->Year_of_foundation)?$companyInfo->Year_of_foundation:'N/A' }}"
                                                    disabled />
                                            </div>
                                            <div class="form-group">
                                                <label>Facebook Link</label>
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ !empty($companyInfo->facebook_link)?$companyInfo->facebook_link:'N/A' }}"
                                                    disabled />
                                            </div>
                                            <div class="form-group">
                                                <label>Twitter Link</label>
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ !empty($companyInfo->twitter_link)?$companyInfo->twitter_link:'N/A' }}"
                                                    disabled />
                                            </div>

                                            <div class="form-group">
                                                <label>Detailed Description</label>
                                                <textarea class="form-control" rows="5" id="description"
                                                    name="description"
                                                    disabled>{{ $companyInfo->detailed_description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Website link</label>
                                                <input type="text" name="websiteLink" class="form-control"
                                                    value="{{ $companyInfo->website_link }}" disabled />
                                            </div>
                                            <div class="form-group">
                                                <label>Average Hourly Rate</label>
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ !empty($companyInfo->average_hourly_rate->hourly_rate)?$companyInfo->average_hourly_rate->hourly_rate:'N/A' }}"
                                                    disabled />
                                            </div>
                                            <div class="form-group">
                                                <label>Minimal Project Size</label>
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ !empty($companyInfo->minimal_project_size->project_size)?$companyInfo->minimal_project_size->project_size:'N/A' }}"
                                                    disabled />
                                            </div>
                                            <div class="form-group">
                                                <label>Ready to start</label>
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ !empty($companyInfo->ready_to_start->ready_to)?$companyInfo->ready_to_start->ready_to:'N/A' }}"
                                                    disabled />
                                            </div>


                                            <div class="form-group">
                                                <label>LinkedIn link</label>
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ $companyInfo->linkedin_link }}" disabled />
                                            </div>
                                            <div class="form-group">
                                                <label>Video Link</label>
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ $companyInfo->video_link }}" disabled />
                                            </div>
                                            <div class="form-group">
                                                <label>Short Description</label>
                                                <textarea class="form-control" rows="5" id="description"
                                                    name="description"
                                                    disabled>{{ $companyInfo->short_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="location">
                                    <div class="row">
                                        @if ($companyInfo->locations->count() > 0)
                                            @foreach ($companyInfo->locations as $location)
                                                <div class="col-sm-4">
                                                    <div class="position-relative p-3 location_div"
                                                        style="height: 150px;background-color: #f2f6f9;border-radius: 30px;">
                                                        <label><span
                                                                class="flag-icon flag-icon-{{ strtolower($location->country->iso_code2) }} flag-icon-squared"></span>
                                                            {{ ucfirst($location->country->name) }} </label><br>
                                                            @if($location->street)
                                                                {{ $location->street }},<br>
                                                            @endif
                                                            
                                                            @if($location->city)
                                                                {{ ucfirst($location->city->name) }},<br>
                                                            @endif
                                                            
                                                            @if($location->state)
                                                             {{ ucfirst($location->state->name) }},
                                                            @endif
                                                            
                                                            @if($location->postal_code)
                                                             {{ $location->postal_code }},
                                                            @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <h3 style="margin: 0 auto;text-align: center!important;">No location Added</h3>
                                        @endif
                                    </div>

                                </div>
                                <!-- /.tab-pane -->

                                    <div class="tab-pane" id="listings">
                                        @if($companyInfo->companyListing->count() > 0)
                                        <input type="checkbox" id="selectall" style="margin: 6px;margin-bottom: 20px;">Select all
                                        @endif
                                            <div  align="right">
                                                <button  type="button" class="btn btn-danger show-delete" style="margin: 0 auto;margin-bottom: 10px;" onClick="deleteListing()">Delete</button>
                                               
                                                @if($companyInfo->companyListing->count() > 12)
                                                    <button  type="button" class="btn btn-primary show-more" style="margin: 0 auto;margin-bottom: 10px;">Show more</button>
                                                @endif
                                             </div>
                                            
                                            <div class="row">
                                                @if($companyInfo->companyListing->count() > 0)
                                                @foreach ($companyInfo->companyListing as $listing_data)
                                                    <div class="col-lg-3 ty-compact-list">
                                                        <div class="small-box-companyListing" style="background-color:#a8b4fc;">
                                                            <div class="inner">
                                                                <input type="checkbox" class="listing_checkbox" id="listing_{{ $listing_data->listing->id }}" name="listing_id" value="{{ $listing_data->listing->id }}" onclick="checkBox();">
                                                                <a target="_blank" class="text-underline-hover"
                                                                    href="{{ url('https://techreviewers.co/' . $listing_data->listing->slug) }}"
                                                                    style="color: #fff;">{{ $listing_data->listing->name }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @else
                                                 
                                                <h3 style="margin: 0 auto;text-align: center!important;">No listing Added</h3>
                                                
                                                
                                                @endif
                                            </div>
                                        </div>

                                  <div class="tab-pane" id="serviceFocus">

                                    <div class="categories-section">

                                        @if (is_iterable($companyInfo->service_focus))

                                        @for ($i = 0; $i < count($allKeys); $i++) <div class="category-block">

                                            <div class="category-block-header d-flex justify-content-between">
                                                <h6>{{ $allKeys[$i] }} </h6>

                                                <div class="btn btn-primary show-more-results_{{$allKeys[$i]  }}"
                                                    onclick="showMore('{{ $allKeys[$i] }}');">Show more</div>

                                            </div>
                                            <div id="service_lines-collapsible-content">
                                                <div class="category-block-content">

                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th id="category-name" scope="col">
                                                                    <strong><b>Name</b></strong>
                                                                </th>
                                                                <th id="category-percentage" scope="col">
                                                                    <strong><b>Share</b></strong>

                                                                </th>
                                                                <th id="category-progress" scope="col">
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($companyInfo->service_focus[$allKeys[$i]] as $val)

                                                            <tr
                                                                class="tr_{{$allKeys[$i]  }} panel panel-default event_tr">

                                                                <td class="category-name sub-menu "><a
                                                                        data-toggle="collapse"
                                                                        href="#dropdown-lvl2_{{$val['id']}}">
                                                                        {{ $val['name'] }}
                                                                        @if (array_key_exists("child",$val))
                                                                        <div class='fa fa-caret-down right fa-fa-icon'>
                                                                        </div>

                                                                        <span class="caret"></span>
                                                                        @endif
                                                                    </a>

                                                                </td>
                                                                <td class="category-percentage">
                                                                    {{ $val['percentage'] }}%
                                                                </td>
                                                                <td class="category-progress">
                                                                    <div class="progress">
                                                                        <div aria-valuemax="100" aria-valuemin="0"
                                                                            aria-valuenow="{{ $val['percentage'] }}"
                                                                            class="progress-bar" role="progressbar"
                                                                            style="width: {{ $val['percentage'] }}%">
                                                                        </div>
                                                                    </div>
                                                                </td>


                                                                <td class="subcategory_dropdown">
                                                                    <div id="dropdown-lvl2_{{$val['id']}}"
                                                                        class="panel-collapse collapse">
                                                                        <div class="panel-body">

                                                                            <ul class="nav navbar-nav">
                                                                                @if (array_key_exists("child",$val))
                                                                                @foreach ( $val['child'] as $se)
                                                                                <!-- <tr>
                                                                                 <td> {{ $se['name'] }} </td>  
                                                                               <td>  {{ $se['percentage'] }}% </td>
                                                                                <td>  <div class="progress">
                                                                                        <div aria-valuemax="100"
                                                                                            aria-valuemin="0"
                                                                                            aria-valuenow="{{ $se['percentage'] }}"
                                                                                            class="progress-bar"
                                                                                            role="progressbar"
                                                                                            style="width: {{ $se['percentage'] }}%">
                                                                                        </div>
                                                                                    </div> </td>
                                                                                    
                                                                                </tr> -->
                                                                                <li> {{ $se['name'] }}
                                                                                    {{ $se['percentage'] }}%</li>

                                                                                <li>
                                                                                    <div class="progress">
                                                                                        <div aria-valuemax="100"
                                                                                            aria-valuemin="0"
                                                                                            aria-valuenow="{{ $se['percentage'] }}"
                                                                                            class="progress-bar"
                                                                                            role="progressbar"
                                                                                            style="width: {{ $se['percentage'] }}%">
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                @endforeach
                                                                                @endif

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                            </tr>



                                                            @endforeach
                                                        </tbody>

                                                    </table>


                                                </div>
                                            </div>
                                    </div>

                                    @endfor

                                    @endif
                                </div>
                            </div>
                        <div class="tab-pane" id="majorClient">
                            <div class="row">

                                <div>
                                    <!-- <h2 class="section-header__title">Major clients</h2> -->
                                    @if($companyInfo->clients->count() > 0)
                                        @foreach ($companyInfo->clients as $majorClient)
                                        <div class="major-clients-body collapse show" id="collapsible-major-clients"
                                            style="">
                                            <div class="major-client-item">
                                                <div class="major-client-icon"></div>
                                                <div class="major-client-text text-break">
                                                    {{ $majorClient->name }}</div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="row">
                                            <div class="col-12" align="center">
                                                <p style="font-size: larger;margin-bottom: 2px;">No Major clients Added </p>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.card -->
                </div>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

        <!-- /.col -->
</div>
<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop
@section('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>



$('.show-delete').hide();
if ($('.ty-compact-list').length > 12) {
  $('.ty-compact-list:gt(11)').hide();
  $('.show-more').show();
}

$('.show-more').on('click', function() {
  //toggle elements with class .ty-compact-list that their index is bigger than 2
  $('.ty-compact-list:gt(11)').toggle();
  //change text of show more element just for demonstration purposes to this demo
  $(this).text() === 'Show more' ? $(this).text('Show less') : $(this).text('Show more');
});

var shownDefault = 7
var numShown = shownDefault; // Initial rows shown & index
var $table = $('.table').find('tbody');  // tbody containing all the rows
var numRows = $table.find('tr').length; // Total # rows
var moretext = "Show more";
var lesstext = "Show less";
$table.find('tr:gt(' + (numShown - 1) + ')').hide()             

function showMore(para) {
//   alert(para)
    $table.find('.tr_'+para+':gt(' + (numShown - 1) + ')').hide()                      
     if (numShown === numRows) {
          numShown = shownDefault;
          $table.find('.tr_'+para+':gt(' + (numShown - 1) + ')').hide()
          $('.show-more-results_'+para).text(moretext)                              
        } else {
        	numShown = numRows;
          $('.show-more-results_'+para).text(lesstext)                    
        }        
        $table.find('.tr_'+para+':lt(' + numShown + ')').show();
      
}


//Checkbox value in listing
function checkBox() {
    console.log(1);
    var listing_id = [];
    $.each($("input[name='listing_id']:checked"), function(){
      listing_id.push($(this).val());
    });
    
    var countchecked = listing_id.join(", ");
    console.log("listing_id.length",listing_id.length);
    
     if (countchecked == 0) {
         $('.show-delete').hide();
         $('#selectall').prop('checked', false);
    } else {
       $('.show-delete').show();
    }
    
}

    
function deleteListing(){
    swal({
            title: "Are you sure want to remove this listing?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $("#overlay").fadeIn(300);
                
                var listing_id = [];
                $.each($("input[name='listing_id']:checked"), function(){
                  listing_id.push($(this).val());
                });
                
                var listingId = listing_id.join(", ");
                var companies_id = $('#id_data').val();
                
                console.log("Selected say(s) are: ",listingId);
                console.log("company_id: ",companies_id);
                // alert(companies_id + '==' + listingId)
                $.ajax({
                    type: "POST",
                    url: "{{ route('deleteCompaniesListing') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        listing_id: listingId,
                        companies_id: companies_id
                    }
                }).done(function(data) {
                    console.log(data);
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                    },1000)
                    
                    if (data == 1) {
                        toastr.success("Listing remove from company");
                    } else {
                        toastr.error("Somethings went wrong");
                    }
                    location.reload();
                
                   
                    
                    // $(window).scrollTop(0);
                    // $("#showSuccessMessage").html("Companies add in listing successfully.")

                    // $("#showSuccessMessage").fadeTo(2000, 500).slideUp(500, function() {
                    //     $("#showSuccessMessage").hide();
                    // });
                    // window.location.reload();
                });

            }
            else {
                // swal("Your set status is safe!");
                window.location.reload();
            }
        });
    
}
$(document).ready(function () {
    $('#selectall').click(function () {
        console.log("1")
        $('.listing_checkbox').prop('checked', this.checked);
        
         var countchecked = $('.listing_checkbox').filter(":checked").length;
        
         console.log("checkcheckcheckcheck",countchecked);
          if (countchecked == 0) {
             $('.show-delete').hide();
          
        } else {
          $('.show-delete').show();
        }
         
    });

    // $('.listing_checkbox').change(function () {
    //     console.log("2")
    //     var check = ($('.listing_checkbox').filter(":checked").length == $('.listing_checkbox').length);
        
    //      console.log("checkcheckcheckcheck",check);
    //     $('#selectall').prop("checked", check);
    //     var countchecked = $('.listing_checkbox').length;
    //     console.log("listing_id.length",countchecked);
        
    //      if (countchecked == 0) {
    //          $('.show-delete').hide();
    //     } else {
    //       $('.show-delete').show();
    //     }
       
    // });
});

// function selectAllListing(){
// //     var inputs = document.querySelectorAll('.listing_checkbox');
// //   for (var i = 0; i < inputs.length; i++) {
// //     inputs[i].checked = true;
// //   }

// $(document).ready(function () {
//     $('#selectall').click(function () {
//         $('.listing_checkbox').prop('checked', this.checked);
//     });

//     $('.listing_checkbox').change(function () {
//         var check = ($('.listing_checkbox').filter(":checked").length == $('.listing_checkbox').length);
//         $('#selectall').prop("checked", check);
//     });
// });


    
// }




</script>
@stop