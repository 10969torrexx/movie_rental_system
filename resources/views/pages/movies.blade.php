@php
    use App\Http\Controllers\MoviesController;
    $moviesController = new MoviesController;
@endphp

<div class="container" data-aos="fade-up">

    <div class="section-header">
      <h2>Portfolio</h2>
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
                      <a href="{{ route('buyProduct', ['id' => $item->id]) }}" title="{{ ucwords($item->title) }}"><i class="bi bi-cart-fill"></i></a>
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