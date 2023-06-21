@include('admin.common.header')
<section class="content">
<div class="" style=" height: 100vh">
    <header class="content__title">
      <h1>@lang('message.send notification list')</h1>
    </header>
    @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
    @endif
    @if(session('status_err'))
        <div class="alert alert-danger">
          {{ session('status_err') }}
        </div>
    @endif
    <form action="{{url('/admin/notification/list')}}" method="GET" data-parsley-validate>
      {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="usr"> @lang('message.usertype') : </label>
                    <select class="form-control" name="type" id="type" required data-parsley-required data-parsley-required-message="@lang('message.select user type')">
                        <option value=""> @lang('message.select type')  </option>
                        <option value="1" {{ $type == '1'? 'selected' : '' }}> @lang('message.multiuser_list')  </option>
                        <option value="2" {{ $type == '2'? 'selected' : '' }}> @lang('message.vendor_users')  </option>
                        <option value="3" {{ $type == '3'? 'selected' : '' }}> @lang('message.both_user')  </option>
                    </select>
                    @if ($errors->has('type'))
                       <div class="alert-danger">
                          {{ $errors->first('type') }}
                       </div>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="usr"> @lang('message.search') :</label>
                    <input type="text" name="search" id="search" placeholder="@lang('message.search by company_vendor')" class="form-control">
                    @if ($errors->has('search'))
                        <div class="alert-danger">
                          {{ $errors->first('search') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group ">
             <input type="submit" value="Search" class="btn btn-info" id="submit"> 
             <a href="{{ url('/admin/notification/list')}}" class="btn btn-info"> @lang('message.refresh')</a>
        </div>
    </form>
   <!-- show list after search-->
    @if (!empty($data))
        <div class="card">
            <div class="card-body">
                <div class="form-group ">
                    <form action="{{url('/admin/notification/send')}}" method="POST" data-parsley-validate id="validate_form">
                        {{ csrf_field() }}
                        <table class="table ">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th> <input id="checkbox1" type="checkbox" name="user[]" class="form-control-custom" onchange="checkAllUser(this)"> @lang('message.check user')
                                </th>

                                <th> @lang('message.full_name')</th>
                                <th> @lang('message.usertype')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                    @foreach($data as  $value)
                                        <tr>
                                            <td> {{$i}}</td>
                                            <td>
                                                <input id="{{$value->id}}" type="checkbox" value="{{$value->id}}" name="user_id[]" class="form-control-custom"  data-id ="{{ $value->id}}" data-parsley-required="true" data-parsley-trigger="click">
                                                <label for="{{$value->id}}"></label><br>
                                                <span id="errmsg" style="color: red;"></span>
                                            </td>
                                            <td>
                                                @if($value ->user_type == 1)
                                                    {{$value->company_name}}
                                                @else
                                                     {{$value->vendor_name}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($value ->user_type == 1)
                                                <span class="btn-success btn btn-sm">@lang('message.company_user')</span>
                                                @else
                                                <span class="btn-success btn btn-sm">@lang('message.vendor_users')</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @php $i++; @endphp
                                @endforeach
                                <input type="hidden" id="counting" name="counting" value="{{$i-1}}">
                            </tbody>
                        </table>
                        <div class="form-group ">
                            <input type="button" id="btnSubmit" name="save_value" value="@lang('message.send')" class="btn btn-info" onclick="checkValue()" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
<!-- Send Messgae -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="margin-left: 28%;"> @lang('message.message') </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addPoints" action="{{url('/admin/notification/send')}}" method="post" data-parsley-validate>
                <div class="modal-body">
                   <div class="preview-content">
                      @csrf
                      <input type="hidden" name="id" id="txtValue" >
                      <div class="form-group">
                         <label for="promo_code_desc">@lang('message.message') </label>
                         <input type="text" required class="form-control" name="message" aria-describedby="" id="message" required data-parsley-required data-parsley-required-message="@lang('message.enter message')" value="{{ old('message') }}">
                         @if ($errors->has('message'))
                         <span class="text-danger" role="alert">
                         <strong>{{ $errors->first('message') }}</strong>
                         </span>
                         @endif
                      </div>
                   </div>
                </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">@lang('message.close')</button>
                   <button type="submit" class="btn btn-info"> @lang('message.send')  </button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.common.footer')
<script type="text/javascript">
   // ----sidebar selected-----
            $(document).ready(function(){        
                $("#notification_list_li").addClass('nav-expanded');
                $("#notification_list").css('color', '#47a2ff');
            }); 
   
   //select checkbox
      $(document).ready(function () {
          $("#btnSubmit").click(function(){
            var selected_id = new Array();
      
            $('input[name="user_id[]"]:checked').each(function() {
      
               selected_id.push(this.value);
      
            });
      
            $('#txtValue').val(selected_id);
          });
      
        });
      
//select all checkbox
       function checkAllUser(ele) {
          $('input[name ="user_id[]"]').each( function() {
              if (ele.checked) {
                  $(this).prop('checked',true);
              } else {
                  $(this).prop('checked',false);
              } 
          });
       }
//set word in search box
    var word = '{{ $word }}';
    $('#search').val(word);

    function checkValue(){
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='user_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        if(selected_id.length == 0)
        {
            $("#errmsg").html("@lang('message.please check one check box')").show().fadeOut(5000);

            $('#myModal').modal('hide');

        }else
        {
            $('#myModal').modal('show');
        }

        // alert("My favourite sports are: " + selected_id.join(", "));
    }



</script>