<div class="card-header bg-dark text-white">
    <h5 class="mb-0 h6">{{translate('Physical Attributes')}}</h5>
</div>
<div class="card-body">
    <form action="{{ route('physical-attribute.update', $member->id) }}" method="POST">
        <input name="_method" type="hidden" value="PATCH">
        @csrf
        <div class="form-group row">
            <div class="col-md-6">
                <label for="height">{{translate('Height')}} ({{ translate('In Feet') }})</label>
                <span class="text-danger">*</span>
                <input type="number" name="height" value="{{ !empty($member->physical_attributes->height) ? $member->physical_attributes->height : "" }}" step="any" class="form-control" placeholder="{{translate('Height')}}" required>
                @error('height')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="weight">{{translate('Weight')}} ({{ translate('In Kg')}})</label>
                <span class="text-danger">*</span>
                <input type="text" name="weight" value="{{ !empty($member->physical_attributes->weight) ? $member->physical_attributes->weight : "" }}" placeholder="{{ translate('Weight') }}" step="any" class="form-control" required>
                @error('weight')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="eye_color">{{translate('Eye color')}}</label>
                <input type="text" name="eye_color" value="{{ !empty($member->physical_attributes->eye_color) ? $member->physical_attributes->eye_color : "" }}" class="form-control" placeholder="{{translate('Eye Color')}}" >
                @error('eye_color')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="hair_color">{{translate('Hair Color')}}</label>
                <input type="text" name="hair_color" value="{{ !empty($member->physical_attributes->hair_color) ? $member->physical_attributes->hair_color : "" }}" placeholder="{{ translate('Hair Color') }}" class="form-control" >
                @error('hair_color')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <!-- <div class="col-md-6">
                <label for="complexion">{{translate('Complexion')}}</label>
                <input type="text" name="complexion" value="{{ !empty($member->physical_attributes->complexion) ? $member->physical_attributes->complexion : "" }}" class="form-control" placeholder="{{translate('Complexion')}}" >
                @error('complexion')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="blood_group">{{translate('Blood Group')}}</label>
                <input type="text" name="blood_group" value="{{ !empty($member->physical_attributes->blood_group) ? $member->physical_attributes->blood_group : "" }}" placeholder="{{ translate('Blood Group') }}" class="form-control" >
                @error('blood_group')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div> -->
            <div class="col-md-6">
                    <label for="complexion">{{translate('Complexion')}}</label>
                    @php $complexion = !empty($member->physical_attributes->complexion) ? $member->physical_attributes->complexion : ""; @endphp
                    <select class="form-control aiz-selectpicker" name="complexion" >
                      <option value="">{{translate('Select One')}}</option>
                        <option value="extremely_fair_skin" @if($complexion ==  'extremely_fair_skin') selected @endif >{{translate('Extremely fair skin')}}</option>
                        <option value="fair_skin" @if($complexion ==  'fair_skin') selected @endif >{{translate('Fair skin')}}</option>
                        <option value="medium_skin" @if($complexion ==  'medium_skin') selected @endif >{{translate('Medium skin')}}</option>
                        <option value="olive_skin" @if($complexion ==  'olive_skin') selected @endif >{{translate('Olive skin')}}</option>
                        <option value="brown_skin" @if($complexion ==  'brown_skin') selected @endif >{{translate('Brown skin')}}</option>
                        <option value="black_skin" @if($complexion ==  'black_skin') selected @endif >{{translate('Black skin')}}</option>

                        @error('complexion')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="blood_group">{{translate('Blood Group')}}</label>
                    @php $blood_group = !empty($member->physical_attributes->blood_group) ? $member->physical_attributes->blood_group : ""; @endphp
                    <select class="form-control aiz-selectpicker" name="blood_group" >
                      <option value="">{{translate('Select One')}}</option>
                        <option value="a+" @if($blood_group ==  'a+') selected @endif >{{translate('A(Positive)')}}</option>
                        <option value="a-" @if($blood_group ==  'a-') selected @endif >{{translate('A(Negative)')}}</option>
                        <option value="b+" @if($blood_group ==  'b+') selected @endif >{{translate('B(Positive)')}}</option>
                        <option value="b-" @if($blood_group ==  'b-') selected @endif >{{translate('B(Negative)')}}</option>
                        <option value="o+" @if($blood_group ==  'o+') selected @endif >{{translate('O(Positive)')}}</option>
                        <option value="o-" @if($blood_group ==  'o-') selected @endif >{{translate('O(Negative)')}}</option>
                        <option value="ab+" @if($blood_group ==  'ab+') selected @endif >{{translate('AB(Positive)')}}</option>
                        <option value="ab-" @if($blood_group ==  'ab-') selected @endif >{{translate('AB(Negative)')}}</option>

                        @error('blood_group')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </select>
                </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="body_type">{{translate('Body Type')}}</label>
                <input type="text" name="body_type" value="{{ !empty($member->physical_attributes->body_type) ? $member->physical_attributes->body_type : "" }}" class="form-control" placeholder="{{translate('Body Type')}}" >
                @error('body_type')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <!-- <div class="col-md-6">
                <label for="body_art">{{translate('Body Art')}}</label>
                <input type="text" name="body_art" value="{{ !empty($member->physical_attributes->body_art) ? $member->physical_attributes->body_art : "" }}" placeholder="{{ translate('Body Art') }}" class="form-control" >
                @error('body_art')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div> -->
            <div class="col-md-6">
                    <label for="disability">{{translate('Disability')}}</label>
                    <span class="text-danger">*</span>
                    @php $disability = !empty($member->physical_attributes->disability) ? $member->physical_attributes->disability : ""; @endphp
                    <select class="form-control aiz-selectpicker" name="disability" required>
                      <option value="no" @if($disability ==  'no') selected @endif >{{translate('No')}}</option>
                        <option value="yes" @if($disability ==  'yes') selected @endif >{{translate('Yes')}}</option>
                        
                        @error('disability')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </select>
                </div>
        </div>
        <div class="form-group row">
            <!-- <div class="col-md-6">
                <label for="disability">{{translate('Disability')}}</label>
                <input type="text" name="disability" value="{{ !empty($member->physical_attributes->disability) ? $member->physical_attributes->disability : "" }}" class="form-control" placeholder="{{translate('Disability')}}">
                @error('disability')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div> -->
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary btn-sm">{{translate('Update')}}</button>
        </div>
    </form>
</div>
