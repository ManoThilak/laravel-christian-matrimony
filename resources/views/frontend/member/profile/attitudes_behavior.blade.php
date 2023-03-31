<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Personal Attitude & Behavior')}}</h5>
    </div>
    <div class="card-body">
      <form action="{{ route('attitudes.update', $member->id) }}" method="POST">
          <input name="_method" type="hidden" value="PATCH">
          @csrf
          <div class="form-group row">
              <!-- <div class="col-md-6">
                  <label for="affection">{{translate('Affection')}}</label>
                  <input type="text" name="affection" value="{{ !empty($member->attitude->affection) ? $member->attitude->affection : "" }}" class="form-control" placeholder="{{translate('Affection')}}">
                  @error('affection')
                      <small class="form-text text-danger">{{ $message }}</small>
                  @enderror
              </div> -->





              <div class="col-md-6">
                    <label for="affection">{{translate('Affection')}}</label>
                    @php $affection = !empty($member->attitude->affection) ? $member->attitude->affection : ""; @endphp
                    <select class="form-control aiz-selectpicker" name="affection" >
                      <option value="">{{translate('Select One')}}</option>
                        <option value="yes" @if($affection ==  'yes') selected @endif >{{translate('Yes')}}</option>
                        <option value="no" @if($affection ==  'no') selected @endif >{{translate('No')}}</option>
                        @error('affection')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </select>
                </div>


                <div class="col-md-6">
                    <label for="humor">{{translate('Humor')}}</label>
                    @php $humor = !empty($member->attitude->humor) ? $member->attitude->humor : ""; @endphp
                    <select class="form-control aiz-selectpicker" name="humor" required>
                      <option value="">{{translate('Select One')}}</option>
                        <option value="yes" @if($humor ==  'yes') selected @endif >{{translate('Yes')}}</option>
                        <option value="no" @if($humor ==  'no') selected @endif >{{translate('No')}}</option>
                        @error('humor')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </select>
                </div>



              <!-- <div class="col-md-6">
                  <label for="humor">{{translate('Humor')}}</label>
                  <input type="text" name="humor" value="{{ !empty($member->attitude->humor) ? $member->attitude->humor : "" }}" placeholder="{{ translate('Humor') }}" class="form-control">
                  @error('humor')
                      <small class="form-text text-danger">{{ $message }}</small>
                  @enderror
              </div> -->
          </div>
          <div class="form-group row">
              <!-- <div class="col-md-6">
                  <label for="political_views">{{translate('Political Views')}}</label>
                  <input type="text" name="political_views" value="{{ !empty($member->attitude->political_views) ? $member->attitude->political_views : "" }}" class="form-control" placeholder="{{translate('Political Views')}}">
              </div> -->
              <div class="col-md-6">
                    <label for="political_views">{{translate('Political Views')}}</label>
                    @php $political_views = !empty($member->attitude->political_views) ? $member->attitude->political_views : ""; @endphp
                    <select class="form-control aiz-selectpicker" name="political_views" required>
                      <option value="">{{translate('Select One')}}</option>
                        <option value="yes" @if($political_views ==  'yes') selected @endif >{{translate('Yes')}}</option>
                        <option value="no" @if($political_views ==  'no') selected @endif >{{translate('No')}}</option>
                        @error('political_views')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </select>
                </div>


                <div class="col-md-6">
                    <label for="religious_service">{{translate('Religious Service')}}</label>
                    @php $religious_service = !empty($member->attitude->religious_service) ? $member->attitude->religious_service : ""; @endphp
                    <select class="form-control aiz-selectpicker" name="religious_service" required>
                      <option value="">{{translate('Select One')}}</option>
                        <option value="yes" @if($religious_service ==  'yes') selected @endif >{{translate('Yes')}}</option>
                        <option value="no" @if($religious_service ==  'no') selected @endif >{{translate('No')}}</option>
                        @error('religious_service')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </select>
                </div>
              <!-- <div class="col-md-6">
                  <label for="religious_service">{{translate('Religious Service')}}</label>
                  <input type="text" name="religious_service" value="{{ !empty($member->attitude->religious_service) ? $member->attitude->religious_service : "" }}" placeholder="{{ translate('Religious Service') }}" class="form-control">
              </div> -->
          </div>

          <div class="text-right">
              <button type="submit" class="btn btn-primary btn-sm">{{translate('Update')}}</button>
          </div>
      </form>
    </div>
</div>
