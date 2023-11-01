@if (!App()->team->isEmpty())
    @php
        if (Route::currentRouteName() === 'team') {
            $team = App()->team;
        }else {
            $team = App()->team->take(4);
        }
    @endphp
  <!-- Start Team 
    ============================================= -->
    <div class="team-style-onea-rea default-padding-top pb-70 pb-xs-0 bg-contain-center bg-gray" style="background-image: url({{asset('/img/shape/18.png')}});">
        @if (Route::currentRouteName() !== 'team')
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4 class="sub-heading">{{__('frontend.team_members')}}</h4>
                        <h2 class="title">{{__('frontend.meet_our_experts')}}</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="container">
            <div class="row">
                @foreach ($team as $key => $member)
                <!-- Single Item -->
                <div class="col-xl-3 col-md-6">
                    <div class="team-style-one active"  style="height: 100%;">
                        <div class="thumb">
                            @if ($member->image && file_exists('storage/' . $member->logo))
                                <img style="height: 250px;overflow: hidden;object-fit: cover;width: 100%;" src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->image }}" title="{{ $member->image }}">
                            @endif
                            <div class="social">
                                <ul>
                                    <li class="facebook">
                                        <a href="{{ $member->facebook_link }}">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="twitter">
                                        <a href="{{ $member->twitter_link }}">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="linkedin">
                                        <a href="{{ $member->linkedin_link }}">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="info">
                            <span>{{ $member->position }}</span>
                            <h4><a href="#">{{ $member->name }}</a></h4>
                        </div>
                    </div>
                </div>
                <!-- End Single Item -->
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Team Area -->
@endif