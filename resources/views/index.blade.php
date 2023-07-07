
@extends('layouts.app')

@section('content')
@if(!empty($popular_places) && count($popular_places) > 0)
  <!-- popular-place-section -->
  <div class="popular-place-section">
    <div class="container">
      <div class="main-heading text-center"> <span>Best Holiday Packages</span> 
        <h2>Popular place</h2>
      </div>

      <div class="row popular-place-row">
        @if(count($popular_places) > 8)
        <div class="btn-box"> <a href="#" class="custom-btn">View All Destinations <i class="fa fa-angle-right"></i></a>
        </div>
        @endif

        @foreach($popular_places as $key => $place)
        <div class="col-lg-3 col-md-4 col-sm-6 ">
          <figure>
            <img src="images/holiday-packages-1.jpg" alt="holiday-packages">
            <figcaption><a href="#">{{ $place->name }}</a>
            </figcaption>
          </figure>
        </div>
        @endforeach

      </div>
    </div>
  </div>
  <!-- popular-place-section end -->
@endif

  <!-- best-hotel-section -->
  <div class="best-deal-section">
    <div class="container">
      <div class="main-heading">
        <h2>Best Hotel Deal</h2>
      </div>
      <div class="d-flex flex-wrap best-deal-contain">
        <div class="img-box">
          <img src="images/best-hotel.jpg" alt="best-hotel">
        </div>
        <div class="contain-box">
          <figure>
            <img src="images/best-hotel-sm.png" alt="best-hotel-sm">
          </figure>
          <h3 class="best-deal-title">St. Petersburg Hotel</h3> 
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpaqu.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> <a href="#" class="custom-btn blue-btn">Explore Deal</a>
        </div>
      </div>
    </div>
  </div>
  <!-- best-hotel-section -->
  <!-- popular-travel-section -->
  <div class="popular-travel-section">
    <div class="container">
      <div class="main-heading text-center">
        <h2>Most Popular Travel Destinations</h2>
        <p>Love travel? Plan and book your perfect trip with expert advice, travel tips, destination information and inspiration from Lonely Planet</p>
      </div>
    </div>
    <ul class="owl-carousel popular-travel-slider">
      <li class="items">
        <figure>
          <img src="images/popular-palce.jpg" alt="popular-palce">
        </figure>
        <div class="popular-place-box">
          <div class="popular-destination">Maldives</div>
          <ul class="d-flex">
            <li><a href="#"><i class="fa fa-eye"></i></a>
            </li>
            <li><a href="#"><i class="fa fa-heart"></i></a>
            </li>
            <li><a href="#"><i class="fa fa-comment"></i></a>
            </li>
            <li><a href="#"><i class="fas fa-share-alt"></i></a>
            </li>
            <li><a href="#"><i class="fas fa-video"></i></a>
            </li>
          </ul>
        </div>
      </li>
      <li class="items">
        <figure>
          <img src="images/popular-palce.jpg" alt="popular-palce">
        </figure>
        <div class="popular-place-box">
          <div class="popular-destination">Maldives</div>
          <ul class="d-flex">
            <li><a href="#"><i class="fa fa-eye"></i></a>
            </li>
            <li><a href="#"><i class="fa fa-heart"></i></a>
            </li>
            <li><a href="#"><i class="fa fa-comment"></i></a>
            </li>
            <li><a href="#"><i class="fas fa-share-alt"></i></a>
            </li>
            <li><a href="#"><i class="fas fa-video"></i></a>
            </li>
          </ul>
        </div>
      </li>
      <li class="items">
        <figure>
          <img src="images/popular-palce.jpg" alt="popular-palce">
        </figure>
        <div class="popular-place-box">
          <div class="popular-destination">Maldives</div>
          <ul class="d-flex">
            <li><a href="#"><i class="fa fa-eye"></i></a>
            </li>
            <li><a href="#"><i class="fa fa-heart"></i></a>
            </li>
            <li><a href="#"><i class="fa fa-comment"></i></a>
            </li>
            <li><a href="#"><i class="fas fa-share-alt"></i></a>
            </li>
            <li><a href="#"><i class="fas fa-video"></i></a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
  <!-- popular-travel-section -->
  <!-- last-offer-section -->
  <div class="last-offer-section">
    <div class="container">
      <div class="main-heading">
        <h2>Latest Offers</h2>
        <p>Love travel? Plan and book your perfect trip with expert advice, travel tips, destination information and inspiration from Lonely Planet</p>
      </div>
    </div>
    <ul class="owl-carousel last-offer-slider">
      <li class="items">
        <div class="last-offer-box">
          <figure>
            <a href="#">
              <img src="images/latest-offer-1.jpg" alt="latest-offer">
            </a>
            <div class="icon-box"> <a href="#"><i class="fas fa-share-alt"></i></a>
              <a href="#"><i class="far fa-heart"></i></a>  <a href="#"><i class="fa fa-camera"></i></a>
            </div>
          </figure>
          <div class="last-offer-dtl">
            <div class="contain-box">
              <div class="last-offer-title"><a href="#">Sri Lanka</a>
              </div>
              <div class="place-box">$560</div>
              <div class="time"><i class="far fa-clock"></i> 2 days 2 night</div>
              <p>There are a few very, very fine strands of PLA</p>
              <ul class="d-flex flex-wrap star-rating"></ul>
            </div>
            <div class="btn-box"><a href="#" class="custom-btn">More Details</a>
            </div>
          </div>
        </div>
      </li>
      <li class="items">
        <div class="last-offer-box">
          <figure>
            <a href="#">
              <img src="images/latest-offer-1.jpg" alt="latest-offer" />
            </a>
            <div class="icon-box"> <a href="#"><i class="fas fa-share-alt"></i></a>
              <a href="#"><i class="far fa-heart"></i></a>  <a href="#"><i class="fa fa-camera"></i></a>
            </div>
          </figure>
          <div class="last-offer-dtl">
            <div class="contain-box">
              <div class="last-offer-title"><a href="#">Sri Lanka </a>
              </div>
              <div class="place-box">$560</div> 
              <div class="time"><i class="far fa-clock"></i> 2 days 2 night</div>
              <p>There are a few very, very fine strands of PLA</p>
              <ul class="d-flex flex-wrap star-rating">
                <li><i class="fa fa-star"></i>
                </li>
                <li><i class="fa fa-star"></i>
                </li>
                <li><i class="fa fa-star"></i>
                </li>
                <li><i class="fa fa-star"></i>
                </li>
                <li><i class="fa fa-star"></i>
                </li>
              </ul>
            </div>
            <div class="btn-box"><a href="#" class="custom-btn">More Details</a>
            </div>
          </div>
        </div>
      </li>
      <li class="items">
        <div class="last-offer-box">
          <figure>
            <a href="#">
              <img src="images/latest-offer-1.jpg" alt="latest-offer">
            </a>
            <div class="icon-box"> <a href="#"><i class="fas fa-share-alt"></i></a>
              <a href="#"><i class="far fa-heart"></i></a>  <a href="#"><i class="fa fa-camera"></i></a>
            </div>
          </figure>
          <div class="last-offer-dtl">
            <div class="contain-box">
              <div class="last-offer-title"><a href="#">Sri Lanka</a>
              </div>
              <div class="place-box">$560</div>
              <div class="time"><i class="far fa-clock"></i> 2 days 2 night</div>
              <p>There are a few very, very fine strands of PLA</p>
              <ul class="d-flex flex-wrap star-rating">
                <li><i class="fa fa-star"></i>
                </li>
                <li><i class="fa fa-star"></i>
                </li>
                <li><i class="fa fa-star"></i>
                </li>
                <li><i class="fa fa-star"></i>
                </li>
                <li><i class="fa fa-star"></i>
                </li>
              </ul>
            </div>
            <div class="btn-box"><a href="#" class="custom-btn">More Details</a> 
            </div>
          </div>
        </div> 
      </li>
    </ul>
  </div>
  <!-- last-offer-section -->
  <!-- hot-month-section -->
  <div class="hot-month-section">
    <div class="container">
      <div class="hot-month-contain">
        <div class="discount"> <span>50<sup>%</sup></span> 
          <p>OFF Discount 10-30% Off</p>
        </div>
        <div class="hot-month-heading">What's Hot this Month</div>
        <p>Find your ideal holiday package whether you're travelling in Australia or around the World. Book Flights & Accommodation packages in one place with Escape Travel.</p> <a href="#" class="custom-btn">read more</a>
      </div>
      <ul class="owl-carousel hot-month-slider">
        <li class="items">
          <img src="images/hot-month.jpg" alt="hot-month">
        </li>
        <li class="items">
          <img src="images/hot-month.jpg" alt="hot-month">
        </li>
      </ul>
    </div>
  </div>
  <!-- hot-month-section -->
  <!-- last-offer-section -->
  <div class="famous-destination-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="text-left main-heading"> <span class="img-box">  
               <img src="images/destination-left.jpg" alt="destination">
              </span> 
            <h2>Famous <br> Destionations</h2>  <a href="#" class="custom-btn">See all</a>
          </div>
        </div>
        <div class="col-md-6">
          <ul class="destination-links">
            <li><a href="#">Toronto</a>
            </li>
            <li><a href="#">Houston</a>
            </li>
            <li><a href="#">Detroit</a>
            </li>
            <li><a href="#">Hamilton</a>
            </li>
            <li><a href="#">Dallas</a>
            </li>
            <li><a href="#">Ohio</a>
            </li>
            <li><a href="#">Bufallo</a>
            </li>
            <li><a href="#">Atlanta</a>
            </li>
            <li><a href="#">Virginia</a>
            </li>
            <li><a href="#">Sudbury</a>
            </li>
            <li><a href="#">Alabama</a>
            </li>
            <li><a href="#">Kansas</a>
            </li>
            <li><a href="#">Maryland</a>
            </li>
            <li><a href="#">Arkansas</a>
            </li>
            <li><a href="#">Kentucky</a>
            </li>
            <li><a href="#">Vermont</a>
            </li>
            <li><a href="#">Oklahoma</a>
            </li>
            <li><a href="#">Charlotte</a>
            </li>
            <li><a href="#">Ohio</a>
            </li>
            <li><a href="#">lowa</a>
            </li>
            <li><a href="#">Georgia</a>
            </li>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- last-offer-section -->
  <!-- lflight-deal-section -->
  <div class="flight-deal-section">
    <div class="container">
      <div class="text-center main-heading">
        <h2>Best Flight Deal <sub>30% Discount, stock limited</sub></h2>
        <p>The world's largest student and youth travel agency. Find cheap flights, tours, Spring Break packages and exclusive travel deals for students take full advantage of privileged discount rates.</p> <a href="#" class="custom-btn">Get Ticket <i class="fas fa-long-arrow-alt-right"></i></a>
      </div>
      <ul class="count-row">
        <li class="yellow-text"><strong>364</strong><span>Days</span>
        </li>
        <li class="light-red-text"> <strong>23</strong><span>Hours</span>
        </li>
        <li class="light-green-text"><strong>59</strong><span>Minutes</span>
        </li>
        <li class="brown-text"><strong>59</strong><span>Second</span>
        </li>
      </ul>
      <ul class="owl-carousel book-ticket-slider">
        <li class="items">
          <div class="book-ticket-contain">
            <figure class="img-box">
              <img src="images/flight-img.jpg" alt="flight-img">
            </figure>
            <div class="contain-box">
              <h4 class="country-name">Italy (Rome)</h4>
              <ul class="plan-list">
                <li>3 Days 2 Night</li>
                <li>Visit most 4 populer place</li>
              </ul> <span class="price">$1500</span>  <a href="#" class="custom-btn"><i class="fas fa-long-arrow-alt-right"></i> Get ticket</a>
            </div>
          </div>
        </li>
        <li class="items">
          <div class="book-ticket-contain">
            <figure class="img-box">
              <img src="images/flight-img.jpg" alt="flight-img">
            </figure>
            <div class="contain-box">
              <h4 class="country-name">Italy (Rome)</h4>
              <ul class="plan-list">
                <li>3 Days 2 Night</li>
                <li>Visit most 4 populer place</li>
              </ul> <span class="price">$1500</span>  <a href="#" class="custom-btn"><i class="fas fa-long-arrow-alt-right"></i> Get ticket</a>
            </div>
          </div>
        </li>
        <li class="items">
          <div class="book-ticket-contain">
            <figure class="img-box">
              <img src="images/flight-img.jpg" alt="flight-img">
            </figure>
            <div class="contain-box">
              <h4 class="country-name">Italy (Rome)</h4>
              <ul class="plan-list">
                <li>3 Days 2 Night</li>
                <li>Visit most 4 populer place</li>
              </ul> <span class="price">$1500</span>  <a href="#" class="custom-btn"><i class="fas fa-long-arrow-alt-right"></i> Get ticket</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <!-- lflight-deal-section -->
  <!-- testimonial-section -->
  <div class="testimonial-section">
    <div class="container">
      <div class="main-heading">
        <h2>Testimonials</h2>
      </div>
      <div class="d-flex flex-wrap testimonial-contain">
        <div class="d-flex flex-wrap testimonial-left">
          <div class="quot-box">
            <div class="img-box">
              <img src="images/quot-icon.png" alt="quot-icon">
            </div>
          </div>
          <div class="title-text">What
            <br>people
            <br>are <span>Say.. </span>
          </div>
        </div>
        <ul class="owl-carousel testimonial-slider">
          <li class="items">
            <div class="testimonial-box">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor laborum</p> <span>Mr John</span>
            </div>
          </li>
          <li class="items">
            <div class="testimonial-box">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor laborum</p> <span>Mr John</span>
            </div>
          </li>
          <li class="items">
            <div class="testimonial-box">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor laborum</p> <span>Mr John</span>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- testimonial-section -->
  <!-- testimonial-section -->
  <div class="news-letter-section">
    <div class="container">
      <div class="main-heading text-center">
        <h2>It’s a big deal!</h2>
        <p>subscribe our news letter</p>
      </div>
      <div class="news-letter-form">
        <div class="form-group">
          <input type="text" name="" class="form-control" placeholder="Enter your email">
          <button type="submit" class="custom-btn">Submit</button>
        </div>
      </div>
      <div class="video-box">
        <img src="images/video-img.jpg" alt="video-img">
        <a href="#" class="custom-btn"> <span class="icon"><i class="fas fa-play"></i></span> Watching video</a>
      </div>
    </div>
  </div>
  <!-- testimonial-section -->
  <!-- map-section -->
  <div class="map-section">
    <div class="container text-center">
      <div class="img-box">
        <img src="images/map.jpg" alt="map-img">
      </div>
    </div>
  </div>
  <!-- map-section -->
  @endsection