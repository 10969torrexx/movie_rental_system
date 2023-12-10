@php
    use App\Http\Controllers\MoviesController;
    $moviesController = new MoviesController;
@endphp

<div class="container" data-aos="fade-up">

    <div class="section-header">
      <h2>Movies</h2>
      <p>Quam sed id excepturi ccusantium dolorem ut quis dolores nisi llum nostrum enim velit qui ut et autem uia reprehenderit sunt deleniti</p>
    </div>

    <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

      <div>
        <ul class="portfolio-flters">
          <li data-filter="*" class="filter-active">All</li>
          @foreach ($moviesController->movieGenre() as $item)
          <li data-filter=".filter-{{ $loop->iteration }}">{{ ucfirst($item) }}</li>
        @endforeach
        </ul><!-- End Portfolio Filters -->
      </div>

      <div class="row gy-4 portfolio-container">

        @if (count($moviesController->index()) > 0)
          @foreach ($moviesController->index() as $item)
            <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $item->type }}">
              <div class="portfolio-wrap">
                <img src="{{ $item->image }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h3><a href="{{ $item->image }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{ ucwords($item->title) }}">{{ ucwords($item->title) }}</a></h3>
                  <div>
                    @guest
                      <a href="{{ $item->image }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{ ucwords($item->title) }}"><i class="bi bi-plus"></i></a>

                    @else
                      <a href="{{ route('rentMovie', ['id' => $item->id]) }}" title="{{ ucwords($item->title) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                          <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                        </svg>
                      </a>
                    @endguest
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        @else
            <div class="row justify-content-center">
              <h1 class="text-center">No posted products yet!</h1>
            </div>
        @endif

      </div><!-- End Portfolio Container -->

    </div>

  </div>