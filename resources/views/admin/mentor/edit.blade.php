@extends('admin.layouts.app')

@section('content')

<!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
              <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Edit Mentor</h4>
                <div class="ms-auto text-end">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">
                       <a href="{{route('admin.mentor.pending.list')}}">Mentor</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Edit Mentor
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
          <!-- ============================================================== -->
          <!-- End Bread crumb and right sidebar toggle -->
          <!-- ============================================================== -->


          <div class="row">
              <div class="col-lg-12 mt-3">
                <div class="card">
                    <div class="row">
                        <div class="col-lg-12 mt-3 d-flex justify-content-end">
                            @if ($detail->status == 0)
                            <a href="{{route('admin.mentor.status.update',['status'=>1,'id'=>$detail->id])}}" class="btn btn-primary mb-4 me-3 ">Approve</a>
                            <a href="{{route('admin.mentor.status.update', ['status'=>2,'id'=>$detail->id])}}" class="btn btn-primary mb-4 me-3 ">Reject</a>
                            @elseif ($detail->status == 1)
                            <a href="{{route('admin.mentor.status.update', ['status'=>2,'id'=>$detail->id])}}" class="btn btn-primary mb-4 me-3">Reject</a>
                            @elseif ($detail->status == 2)
                            <a href="{{route('admin.mentor.status.update',['status'=>1,'id'=>$detail->id])}}" class="btn btn-primary mb-4 me-3">Approve</a>
                            @endif

                       </div>
                      </div>
                    <div class="card-body">
                        <h2>Featured Mentor</h2>

                        <div class="col-lg-12">
                            <form action="{{route('admin.mentor.update.feature')}}" method="post">
                                @csrf
                                    <input type="hidden" name="id" value="{{$detail->user_id}}">
                                    <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Feature</label>
                                        <select class="form-control"  name="is_featured" id="">
                                            <option {{$detail->is_featured==0?"selected":""}} value="0">No</option>
                                            <option {{$detail->is_featured==1?"selected":""}} value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <h2>Personal Info</h2>

                      <div class="col-lg-12">
                        <form action="{{route('admin.mentor.update')}}" enctype="multipart/form-data" method="post">
                            @csrf
                      <input type="hidden" name="id" value="{{$detail->user_id}}">
                      <div class="row">


                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" required name="first_name"  value="{{$detail->user->first_name}}" placeholder="Enter First Name">
                              </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" required name="last_name" value="{{$detail->user->last_name}}" placeholder="Enter Last Name">
                              </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>Father Name</label>
                                <input type="text" class="form-control"  name="father_name" value="{{$detail->user->father_name}}" placeholder="Enter Father Name">
                              </div>
                          </div>

                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" required name="email"  value="{{$detail->user->email}}" placeholder="Enter Email">
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>CNIC</label>
                                    <input type="text" class="form-control"  name="cnic" value="{{$detail->user->cnic}}" placeholder="Enter CNIC">
                                  </div>
                              </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" readonly class="form-control" required name="phone" value="{{$detail->user->phone}}" placeholder="Enter Phone">
                              </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>DOB</label>
                                <input type="date"  class="form-control"  id="birthday" value="{{$detail->user->dob}}" name="dob">
                              </div>
                          </div>

                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select aria-label="Default select example" name="gender" class="form-select">
                                 <option value="" selected="selected">Select Gender</option>
                                  <option {{$detail->user->gender=="male"?"selected":''}} value="male"> Male</option>
                                  <option {{$detail->user->gender=="female"?"selected":''}} value="female">Female</option>
                                  <option {{$detail->user->gender=="other"?"selected":''}} value="other">Other</option>
                                </select>
                              </div>
                          </div>

                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>Occupation</label>
                                <select aria-label="Default select example" name="occupation"  class="form-select"><option value="" selected="selected">
                                    Select Occupation
                                  </option>
                                  @foreach ($occupations as $occupation)
                                      <option {{$detail->user->occupation==$occupation->id?"selected":''}} value="{{$occupation->id}}">{{$occupation->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                          </div>

                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>Religion</label>
                                <select aria-label="Default select example" name="religion" class="form-select">
                                    <option value="" selected="selected">Select Religion</option>
                                    <option {{$detail->user->religion=="islam"?"selected":''}} value="islam">Islam</option>
                                    <option {{$detail->user->religion=="christian"?"selected":''}} value="christian">Christian</option>
                                    <option {{$detail->user->religion=="hindu"?"selected":''}} value="hindu">Hindu</option>
                                    <option {{$detail->user->religion=="sikh"?"selected":''}}  value="sikh">Sikh</option>
                                    <option {{$detail->user->religion=="jew"?"selected":''}} value="jew">Jew</option>
                                    <option {{$detail->user->religion=="buddist"?"selected":''}} value="buddist">Buddhist</option>
                                    <option {{$detail->user->religion=="other"?"selected":''}} value="other">Others</option></select>
                              </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control"  name="country" id="">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                    <option @if ($country->id == $detail->user->country)
                                        selected
                                    @endif value="{{$detail->user->country}}" > {{$country->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control" required name="city" value="{{$detail->user->city}}" placeholder="Enter City">
                              </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" required name="address"  value="{{$detail->user->address}}" placeholder="Enter Address">
                              </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>Postal Code</label>
                                <input type="number" class="form-control" value="{{$detail->user->postal_code}}"  name="postal_code"  placeholder="Enter Postal Code">
                              </div>
                          </div>

                          <div class="col-lg-6">
                            <div class="form-group">
                                <label>Profile Image</label> <br>
                                @if ($detail->user->image_path)
                                    <img src="{{asset($detail->user->image_path)}}" height="200" width="200" alt=""><br><br>
                                @endif
                                <input type="file" class="form-control " name="image">
                              </div>
                          </div>
                      </div>

                      <button class="btn btn-primary" type="submit">Update</button>

                    </form>
                      </div>
                    </div>
                  </div>
            </div>
          </div>

          <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                        <h2>SKills</h2>
                        {{-- @if ( count($detail->education) > 0) --}}
                        <form action="{{route('admin.mentor.skill.update')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$detail->id}}">
                                <div class="form-group">
                                    <label>Parent Category</label>
                                    <select class="form-control"  name="categories[]" id="parent_category">
                                       <option value="">Select Parent Category</option>
                                        @foreach ($mentor_parent_categories as $parent_category)
                                        <option
                                        @if (in_array($parent_category->id,$assignedCategories))

                                        {{-- @if (count($assignedCategories)>2 && $parent_category->id == $assignedCategories[2]->category_id) --}}
                                            selected
                                        @endif value="{{$parent_category->id}}" > {{$parent_category->name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                  @php
                                //   dd($detail->mentor_category_id);
                              @endphp
                              <div class="form-group">
                                <label>SubCategory</label>
                                <select class="form-control" name="categories[]" id="sub_category">
                                    {{-- {{$detail->mentor_category_id}} --}}
                                    @foreach ($child_categories as $child_category)
                                        <option
                                        @if (in_array($child_category->id,$assignedCategories))

                                            selected
                                        @endif value="{{$child_category->id}}" > {{$child_category->name}}</option>
                                        @endforeach

                                </select>
                              </div>
                              <div class="form-group">
                                <label>Child SubCategory



                                </label>
                                <select class="form-control" name="categories[]" id="child_sub_category">
                                    {{-- {{$detail->mentor_category_id}} --}}
                                    @foreach ($child_sub_categories as $child_sub_category)
                                        <option
                                        @if (in_array($child_sub_category->id,$assignedCategories))

                                            selected
                                        @endif value="{{$child_sub_category->id}}" > {{$child_sub_category->name}}</option>
                                        @endforeach

                                </select>
                              </div>
                              <button class="btn btn-primary" type="submit">Update</button>
                        </form>
                        {{-- @else
                        Not Available
                    @endif --}}
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                        <h2>Bank Account Details</h2>
                        {{-- @if ( isset($detail->bank)) --}}

                        <form action="{{route('admin.mentor.bank_detail.update')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$detail->user_id}}">

                              <div class="form-group">
                                <label>Account Holder Name</label>
                                <input type="text" class="form-control" required name="account_title"  value="{{isset($detail->bank)?$detail->bank->account_title:''}}" placeholder="Enter Account Title">
                              </div>
                              <div class="form-group">
                                <label>Account Number</label>
                                <input type="text" class="form-control" required name="account_number"  value="{{isset($detail->bank)?$detail->bank->account_number:''}}" placeholder="Enter Account Number">
                              </div>
                              <div class="form-group">
                                <label>Bank</label>
                                <select name="bank" class="form-control" id="">
                                    <option value=""> Select Bank</option>
                                    @foreach ($banks as $bank)
                                        <option @if (isset($detail->bank)&&$detail->bank->bank == $bank->name)
                                            selected
                                        @endif value="{{$bank->name}}">{{$bank->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                              <button class="btn btn-primary" type="submit">Update</button>
                        </form>
                        {{-- @else
                            Not Available
                        @endif --}}
                    </div>
                    </div>
                </div>
              </div>
          </div>




          <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                        <h2>Education</h2>
                        @if ( count($detail->education) > 0)
                        <form action="{{route('admin.mentor.education.update')}}" enctype="multipart/form-data" method="post">
                            @csrf

                            @foreach ($detail->education as $education)
                      <input type="hidden" name="id[]" value="{{$education->id}}">

                            <div class="form-group">
                                <label>Institue</label>
                                <input type="text" class="form-control" required name="institute[]"  value="{{$education->institute}}" placeholder="Enter Institue Name">
                              </div>
                              <div class="form-group">
                                <label>Degree</label>
                                <input type="text" class="form-control" required name="degree[]"  value="{{$education->degree}}" placeholder="Enter Discipline Name">
                              </div>
                              <div class="form-group">
                                <label>Subject</label>
                                <input type="text" class="form-control" required name="subject[]"  value="{{$education->subject}}" placeholder="Enter Subject Name">
                              </div>
                              <div class="form-group">
                                <label>Period</label>
                                <input type="text" class="form-control" required name="period[]"  value="{{$education->period}}" placeholder="Enter Period">
                              </div>
                              <div class="form-group">
                                <label>Degree</label> <br>
                                @if ($education->image_path)
                                    <img src="{{asset($education->image_path)}}" height="200" width="200" alt=""><br><br>
                                @endif
                                <input type="file" class="form-control " name="image[]">
                              </div>

                            @endforeach

                              <button class="btn btn-primary" type="submit">Update</button>
                        </form>
                        @else
                        Not Available
                    @endif
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                        <h2>Experience</h2>
                        @if ( count($detail->experience) > 0)

                        <form action="{{route('admin.mentor.experience.update')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            @foreach ($detail->experience as $experience)
                            <input type="hidden" name="id[]" value="{{$experience->id}}">

                              <div class="form-group">
                                <label>Company</label>
                                <input type="text" class="form-control" required name="company[]"  value="{{$experience->company}}" placeholder="Enter Company Name">
                              </div>
                              <div class="form-group">
                                <label>Period From</label>
                                <input type="text" class="form-control" required name="from[]"  value="{{$experience->from}}" placeholder="Enter Period From">
                              </div>
                              <div class="form-group">
                                <label>Period To</label>
                                <input type="text" class="form-control" required name="to[]"  value="{{$experience->to}}" placeholder="Enter Period To">
                              </div>
                              <div class="form-group">
                                <label>Degree</label> <br>
                                @if ($experience->image_path)
                                    <img src="{{asset($experience->image_path)}}" height="200" width="200" alt=""><br><br>
                                @endif
                                <input type="file" class="form-control " name="image[]">
                              </div>

                            @endforeach

                              <button class="btn btn-primary" type="submit">Update</button>
                        </form>
                        @else
                            Not Available
                        @endif
                    </div>
                    </div>
                </div>
              </div>
          </div>




        </div>

@endsection
@push('scripts')
     <script>
             $(document).ready(function() {
                $('#parent_category').on('change', function() {
                var parent_category_id = $(this).val();
                var base_url = "<?php echo URL::to('/'); ?>";
                if(parent_category_id) {
                    $.ajax({
                        url: base_url + '/api/mentorChildCategoriesList',
                        type: "GET",
                        data : {"token":"123",parent_id:parent_category_id},
                        dataType: "json",
                        success:function(data)
                        {
                            if(data){
                                $('#sub_category').empty();
                                $('#child_sub_category').empty();
                                $('#sub_category').append('<option>Choose SubCategory</option>');
                                $.each(data.data.mentorCategories, function(key, sub_category){
                                    $('#sub_category').append('<option value="'+ sub_category.id +'">' + sub_category.name + '</option>');
                                });
                            }else{
                                $('#sub_category').empty();
                                $('#child_sub_category').empty();
                            }
                        }
                    });
                }else{
                    $('#sub_category').empty();
                    // $('#child_sub_category').empty();
                }
                });
            $('#sub_category').on('change', function() {
               var parent_category_id = $(this).val();
               var base_url = "<?php echo URL::to('/'); ?>";
               if(parent_category_id) {
                   $.ajax({
                       url: base_url + '/api/mentorChildCategoriesList',
                       type: "GET",
                       data : {"token":"123",parent_id:parent_category_id},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#child_sub_category').empty();
                            // $('#sub_category').empty();
                            $('#child_sub_category').append('<option >Choose Child SubCategory</option>');
                            $.each(data.data.mentorCategories, function(key, sub_category){
                                $('#child_sub_category').append('<option value="'+ sub_category.id +'">' + sub_category.name + '</option>');
                            });
                        }else{
                            $('#child_sub_category').empty();
                            // $('#sub_category').empty();
                        }
                     }
                   });
               }else{
                 $('#sub_category').empty();
                 $('#child_sub_category').empty();
               }
            });
            });
        </script>
    @endpush
