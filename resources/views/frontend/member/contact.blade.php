@extends('frontend.layouts.member_panel')
@section('panel_content')
    <div class="card">
       <!--  <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('My Viewed Profile') }}</h5>
            <a href="{{ route('contact_requests') }}" class="mb-0 h6 btn btn-primary">{{ translate('Contact Requests') }}</a>
        </div> -->
        <div class="card-body">
            <table class="table aiz-table mb-0">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>{{translate('Image')}}</th>
                      <th>{{translate('Name')}}</th>
                      <th>{{translate('Phone No')}}</th>
                      <th>{{translate('Email')}}</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($interests as $key => $interest_id)
                       @php
                          $interest = \App\Models\ViewContact::where('id',$interest_id->id)->first();
                          
                      @endphp

                      <tr id="interested_member_{{ $interest->user_id }}">
                        <td>{{ ($key+1) + ($interests->currentPage() - 1)*$interests->perPage() }}</td>
                        <td>
                            <a
                                @if(get_setting('full_profile_show_according_to_membership') == 1 && Auth::user()->membership == 1)
                                    href="javascript:void(0);" onclick="package_update_alert()"
                                @else
                                    href="{{ route('member_profile', $interest->user_id) }}"
                                @endif
                                class="text-reset c-pointer"
                            >
                                @if(uploaded_asset($interest->user->photo) != null)
                                    <img class="img-md" src="{{ uploaded_asset($interest->user->photo) }}" height="45px"  alt="{{translate('photo')}}">
                                @else
                                    <img class="img-md" src="{{ static_asset('assets/img/avatar-place.png') }}" height="45px"  alt="{{translate('photo')}}">
                                @endif
                            </a>
                        </td>
                        <td>
                            <a
                                @if(get_setting('full_profile_show_according_to_membership') == 1 && Auth::user()->membership == 1)
                                    href="javascript:void(0);" onclick="package_update_alert()"
                                @else
                                    href="{{ route('member_profile', $interest->user_id) }}"
                                @endif
                                class="text-reset c-pointer"
                            >
                                {{ $interest->user->first_name.' '.$interest->user->last_name }}
                            </a>
                        </td>
                        <td>{{ $interest->user->phone }}</td>
                        <td>
                             {{ $interest->user->email }}
                        </td>

                      
                      </tr>

                  @endforeach
              </tbody>
            </table>
            <div class="aiz-pagination">
              
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('modals.package_update_alert_modal')
@endsection

@section('script')
<script type="text/javascript">
    function package_update_alert(){
      $('.package_update_alert_modal').modal('show');
    }
</script>
@endsection
