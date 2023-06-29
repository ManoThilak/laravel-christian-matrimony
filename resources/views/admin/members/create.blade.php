@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Add New Member')}}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{translate('First Name')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <input type="text" name="first_name" class="form-control" placeholder="{{translate('First Name')}}" required>
                                @error('first_name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{translate('Last Name')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <input type="text" name="last_name" class="form-control" placeholder="{{translate('Last Name')}}" required>
                                @error('last_name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                       <!--  <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{translate('Email')}}</label>
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control" placeholder="{{translate('Email')}}">
                                @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{translate('Gender')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="gender" required>
                                    <option value="1">{{translate('Male')}}</option>
                                    <option value="2">{{translate('Female')}}</option>
                                </select>
                                @error('gender')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{translate('Date Of Birth')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <input type="text" class="aiz-date-range form-control" name="date_of_birth"  placeholder="Select Date" data-single="true" data-show-dropdown="true" autocomplete="off">
                            </div>
                            @error('date_of_birth')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                         <!--  <div class="form-group row">
                              <label class="col-md-2 col-form-label">{{translate('Phone Number')}}</label>
                              <div class="col-md-9">
                                <input type="tel" id="phone-code" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="{{ translate('Phone')}}" >
                                <input type="hidden" name="country_code" value="">
                                  @error('phone')
                                      <small class="form-text text-danger">{{ $message }}</small>
                                  @enderror
                              </div>
                          </div> -->

                           <div class="form-group row">
                              <label class="col-md-2 col-form-label">{{translate('Phone Number')}}</label>
                              <div class="col-md-9">
                                <input type="number" id="signinSrEmail"
                                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                         placeholder="Ex: 9993331234" maxlength="10" minlength="10" name="email"
                                                        autocomplete="off">


                                                        
                                 
                              </div>
                          </div>
                        
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{translate('On Behalf')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                @php $on_behalves = \App\Models\OnBehalf::all(); @endphp
                                <select class="form-control aiz-selectpicker" name="on_behalf" required>
                                    @foreach ($on_behalves as $on_behalf)
                                        <option value="{{$on_behalf->id}}">{{$on_behalf->name}}</option>
                                    @endforeach
                                </select>
                                @error('on_behalf')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{translate('Package')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                @php $packages = \App\Models\Package::where('active', 1)->get(); @endphp
                                <select class="form-control aiz-selectpicker" name="package" required>
                                    @foreach ($packages as $package)
                                        <option value="{{$package->id}}">{{$package->name}}</option>
                                    @endforeach
                                </select>
                                @error('package')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="member_religion_id">{{translate('Religion')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="member_religion_id" id="member_religion_id" data-live-search="true" required>
                                <option value="">{{translate('Select One')}}</option>
                                    @foreach ($religions as $religion)
                                    <option value="{{$religion->id}}"> {{ $religion->name }} </option>
                                    @endforeach
                                </select>
                                @error('member_religion_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                       
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="member_caste_id">{{translate('Caste')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="member_caste_id" id="member_caste_id" data-live-search="true" required>
                                
                                </select>
                                @error('member_caste_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="marital_status_id">Marital Status<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="marital_status" id="marital_status" data-live-search="true" required>
                                <option value="">{{translate('Select One')}}</option>
                                    @foreach ($marital_statuses as $marital_status)
                                    <option value="{{$marital_status->id}}" >{{$marital_status->name}}</option>
                                    @endforeach
                                </select>
                                @error('marital_status')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="complexion">{{translate('Complexion')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="complexion" id="complexion" data-live-search="true" required>
                                <option value="">{{translate('Select One')}}</option>
                                <option value="extremely_fair_skin">{{translate('Extremely fair skin')}}</option>
                                <option value="fair_skin">{{translate('Fair skin')}}</option>
                                <option value="medium_skin">{{translate('Medium skin')}}</option>
                                <option value="olive_skin">{{translate('Olive skin')}}</option>
                                <option value="brown_skin">{{translate('Brown skin')}}</option>
                                <option value="black_skin">{{translate('Black skin')}}</option>
                                </select>
                                @error('complexion')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>




                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="disability">{{translate('Disability')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="disability" id="disability" data-live-search="true" required>
                                <option value="no">{{translate('No')}}</option>
                                <option value="yes">{{translate('Yes')}}</option>
                                </select>
                                @error('disability')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        
                        <div class="form-group row" style="display:none;">
                            <label class="col-md-2 col-form-label" for="permanent_country_id">{{translate('Country')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="permanent_country_id" id="permanent_country_id" data-live-search="true" required>
                                <!-- <option value="">{{translate('Select One')}}</option> -->
                                    @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                            </select>
                            @error('permanent_country_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="permanent_state_id">{{translate('State')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="permanent_state_id" id="permanent_state_id" data-live-search="true" required>
                                
                                </select>
                                @error('permanent_state_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="permanent_city_id">{{translate('City')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="permanent_city_id" id="permanent_city_id" data-live-search="true" required>
                                
                                </select>
                                @error('permanent_city_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{translate('Job')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <input type="text" name="job" class="form-control" placeholder="{{translate('Job')}}" required>
                                @error('job')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{translate('Salary')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <input type="text" name="salary" class="form-control" placeholder="{{translate('Salary(Per Month)')}}" required>
                                @error('salary')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        





                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="signinSrEmail">{{translate('photo')}} <small>(800x800)</small></label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="photo" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{translate('Password')}}<span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <input type="password" name="password" id="new_password" class="form-control" placeholder="{{translate('Password')}}" required>
                                @error('password')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{translate('Confirm Password')}} <span class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="confirm_password" onkeyup="checkPasswordValidation(123)" id="confirm_password" placeholder="{{translate('Confirm Password')}}" required>
                                <small id="confirm_password_help" class="form-text text-muted" style="color: red; display: none;">{{ translate('Mismatch Password.') }}</small>
                                @error('confirm_password')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{translate('Member Verified')}}</label>
                            <div class="col-md-9 mt-2">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="member_verification" type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row text-right">
                            <div class="col-md-11">
                                <button type="submit" class="btn btn-primary" id="passSaveBtn" disabled>{{translate('Add Member')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

<script type="text/javascript">

	function checkPasswordValidation(confirm_password) {
        var new_password = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();
        $('#confirm_password_help').show();
        if(new_password === confirm_password) {
            $('#confirm_password_help').text('Password Matched');
            $('#passSaveBtn').prop("disabled", false);
        }else {
            $('#confirm_password_help').text('Mismatched Password');
            $('#passSaveBtn').prop("disabled", true);
        }
    }

    var isPhoneShown = true,
        countryData = window.intlTelInputGlobals.getCountryData(),
        input = document.querySelector("#phone-code");

    for (var i = 0; i < countryData.length; i++) {
        var country = countryData[i];
        if(country.iso2 == 'bd'){
            country.dialCode = '88';
        }
    }

    var iti = intlTelInput(input, {
        separateDialCode: true,
        utilsScript: "{{ static_asset('assets/js/intlTelutils.js') }}?1590403638580",
        onlyCountries: @php echo json_encode(\App\Models\Country::where('status', 1)->pluck('code')->toArray()) @endphp,
        customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
            if(selectedCountryData.iso2 == 'bd'){
                return "01xxxxxxxxx";
            }
            return selectedCountryPlaceholder;
        }
    });

    var country = iti.getSelectedCountryData();
    $('input[name=country_code]').val(country.dialCode);

    input.addEventListener("countrychange", function(e) {
        // var currentMask = e.currentTarget.placeholder;

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

    });

</script>
<script>
    $(document).ready(function(){
        get_castes_by_religion_for_member();
        get_states_by_country_for_permanent_address();
        get_cities_by_state_for_permanent_address();
    });
    $('#member_religion_id').on('change', function() {
        get_castes_by_religion_for_member();
    });
    $('#permanent_country_id').on('change', function() {
        get_states_by_country_for_permanent_address();
    });

    $('#permanent_state_id').on('change', function() {
        get_cities_by_state_for_permanent_address();
    });
    function get_castes_by_religion_for_member(){
        var member_religion_id = $('#member_religion_id').val();
        //alert("member_religion_id");
            $.post('{{ route('castes.get_caste_by_religion') }}',{_token:'{{ csrf_token() }}', religion_id:member_religion_id}, function(data){
                $('#member_caste_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#member_caste_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
               
                AIZ.plugins.bootstrapSelect('refresh');

                
            });
    }
    function get_states_by_country_for_permanent_address(){
    var permanent_country_id = $('#permanent_country_id').val();
        $.post('{{ route('statess.get_state_by_countrys') }}',{_token:'{{ csrf_token() }}', country_id:permanent_country_id}, function(data){
            $('#permanent_state_id').html(null);
            for (var i = 0; i < data.length; i++) {
                $('#permanent_state_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
            }


            AIZ.plugins.bootstrapSelect('refresh');

            get_cities_by_state_for_permanent_address();
        });
}
function get_cities_by_state_for_permanent_address(){
    var permanent_state_id = $('#permanent_state_id').val();
        $.post('{{ route('citiess.get_cities_by_states') }}',{_token:'{{ csrf_token() }}', state_id:permanent_state_id}, function(data){
            $('#permanent_city_id').html(null);
            for (var i = 0; i < data.length; i++) {
                $('#permanent_city_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
            }
         

            AIZ.plugins.bootstrapSelect('refresh');
        });
}
</script>  
@endsection
